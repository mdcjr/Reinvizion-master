<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Customer;
use App\User;
use App\BusinessImages;
use App\BusinessImageComment;
use App\Stack;
use App\Review;
use Log;
use Mail;

class BusinessController extends Controller
{

	public function __construct(){
     //will have to add a middleware to this ontroller to ensure it is not accessible unless logged in
	 $this->middleware('auth');
	}
  
	public function index(Request $request){
		$view = view('business.index');

    $attributes = ['businesses.id', 'businesses.user_id', 'businesses.name', 'businesses.industry', 'users.image'];
		$businesses = Business::select($attributes)->join('users', 'users.id', '=', 'businesses.user_id')->limit(12)->get();

		$view->with('businesses', $businesses);
		$view->with('current_user', $request->user());
		$view->with('user_name', $request->user()->name);

		return $view;
	}

  public function search(Request $request){
    $current_user = $request->user();
  	$businesses = Business::select('*');
  	$keyword = $request->input('keyword');
  	$state = $request->input('state');
  	$city = $request->input('city');

  	if ($keyword != "") {
  		 $businesses = $businesses->where('businesses.tags', 'LIKE', '%'.$keyword.'%');
  	}

  	if ($state != "") {
  		 $businesses = $businesses->where('businesses.state', '=', $state);
  	}

  	if ($city != "") {
  		 $businesses = $businesses->where('businesses.city', '=', $city);
  	}

  	$businesses = $businesses
      ->select('businesses.*', 'users.id as user_id', 'users.image')
      ->join('users', 'users.id', '=', 'businesses.user_id')
      ->offset(0)
      ->limit(12)
      ->get();

    foreach($businesses as $key => $business) {
      $businesses[$key]['is_connected'] = $business->isUserCustomer($current_user->id);
    }

    return response()->json([
  		'businesses' => $businesses,
      'current_user_id' => $current_user->id
  	]);
  }

  public function addCustomer(Request $request){
    $customer = null;
    $user_id = $request->input('user_id');

    if ($user_id == null) {
      $user_id = $request->user_id;
    }

    $business_id = $request->input('business_id');
    if ($business_id == null) {
      $business_id = $request->business_id;
    }

    $user = User::where('id', '=', $user_id)->first();
    $business = Business::where('id', '=', $business_id)->first();
    $is_existing_customer = Customer::where('user_id', '=', $user_id)->where('business_id', '=', $business_id)->first() != null;

    if ($user != null && $user->user_type == 'Customer' && $business != null && $is_existing_customer == false) {
      $customer = Customer::create(['user_id' => $user_id, 'business_id' => $business_id]);
    }

    return response()->json([
      'customer' => $customer
    ]);
  }

  public function images(Request $request) {
    $view = view('business.gallery');

    $page = $request->page;

    if ($page == null) {
      $page = 1;
    }

    $offset = ($page-1) * 20;

    $business = Business::where('id', $request->id)->first();

    if ($business != null) {
      $images = $business->images()->offset($offset)->limit(20)->get();
      $total_pages = $business->images()->count() / 20 + 1;
      $user = $business->user()->first();
      $url = "/business/".$business->id."/gallery";
    } else {
      $images = BusinessImages::where('business_id', 0)->offset($offset)->limit(20)->get();
      $total_pages = BusinessImages::where('business_id', 0)->count() / 20 + 1;
      $user = null;
      $url = "";
    }        
    
    $next_page = $url;
    $previous_page = $url;

    if ($url != "") {
      if ($page < $total_pages && (int)$total_pages != 1) {
        $np = $page+1;
        $next_page = $url."?page={$np}";
      }

      if ($page > 1 && $total_pages > 1) {
        $pp = $page-1;
        $previous_page = $url."?page={$pp}";
      }
    }

    $pagination = [
      'current_page' => $page,
      'total_pages' => (int)$total_pages,
      'next_page' => $next_page,
      'previous_page' => $previous_page
    ];

    $view->with('current_user', $request->user());
    $view->with('user', $user);
    $view->with('business', $business);
    $view->with('user_name', $request->user()->name);
    $view->with('images', $images);
    $view->with('pagination', $pagination);
    $view->with('title', 'GALLERY');

    return $view;    
  }

  public function uploadFileToS3(Request $request) {
    $image = $request->file('image');
    $imageFileName = time() . '.' . $image->getClientOriginalExtension();
    $s3 = \Storage::disk('s3');
    $filePath = 'Reinvizion/businesses/' . $imageFileName;

    try{
      $s3->put($filePath, file_get_contents($image), 'public');
      $link = $s3->url($filePath);

      Log::info('link: '.$link);

      $user = $request->user();
      $business_image = BusinessImages::create(array(
        'business_id' => $request->user()->business()->first()->id,
        'link' => $link,
        'caption' => $request->caption
      ));

      Log::info('business image link: '.$business_image->link);

      return response()->json($s3->url($filePath), 200);
      return response()->json('');
    } catch(\Exception $e) {
      $message = "Error: {$e->getMessage()}";
      error_log("message: " .$message);
      return response()->json($e->getMessage(), 300);
    }
  }

  public function removeService(Request $request) {
    $service_name = $request->service;
    $business = $request->user()->business()->first();
    $service_array = explode(',', $business->tags);
    // $index = array_search($service_name, $service_array);

    for ($i=0; $i < count($service_array); $i++) {
      if (trim($service_array[$i]) == trim($service_name)) {
        unset($service_array[$i]);
        $business->tags = implode(',', $service_array);
        $business->save();
        $service_array = explode(',', implode(',', $service_array));

        $i == count($service_array);
        Log::info('service removed.');
      } else {
        Log::info('searching.');
      }
    }

    return response()->json($service_array);
  }

  public function likeUnlikeImage(Request $request) {
    $success = true;
    // default message
    $message = "Failed to like/unlike image. Validation failed.";
    $likes_count = '-1';
    $comments_count = '-1';

    // retrieve signed in user
    $user = $request->user();
    // retrieve image to like / unlike
    $image = BusinessImages::where('id', '=', $request->image_id)->first();

    // check if image exists
    if ($image != null) {
      // check if signed in user has liked the image
      if ($image->is_liked_by_user($user->id)) {
        // // unlike image
        if ($image->unlike($user->id)) {
          // unlike successful message
          $message = "Image has been unliked.";
        }
      } else {
        // if signed user has not liked the image, goes here
        // like image and check if liking has succeeded
        if ($image->like($user->id)) {
          // like successful message
          $message = 'Image has been liked.';
        }
      }

      $likes_count = $image->likes()->count();
      $comments_count = $image->comments()->count();
    } else {
      // if image to like/unlike is not found, goes here

      $success = false;

      // error message
      $message = "Failed to process your request. Image does not exist or have been removed.";
    }

    return response()->json([
      'success'=>$success, 
      'message'=>$message, 
      'user_id'=>$user->id, 
      'comments_count'=> $comments_count,
      'likes_count'=> $likes_count
    ]);
  }

  public function stackImages(Request $request){
    $view = view('business.gallery');

    $page = $request->page;

    if ($page == null) {
      $page = 1;
    }

    $offset = ($page-1) * 20;

    $stack_images = $request->user()->stack_images();
    $images = $stack_images->offset($offset)->limit(20)->get();
    $total_pages = $stack_images->count() / 20 + 1;
    
    $url = "/stacks";
    $next_page = $url."?page=".$total_pages;
    $previous_page = $url;

    if ($page < $total_pages) {
      $np = $page+1;
      $next_page = $url."?page={$np}";
    }

    if ($page > 1) {
      $pp = $page-1;
      $previous_page = $url."?page={$pp}";
    }

    $pagination = [
      'current_page' => $page,
      'total_pages' => (int)$total_pages,
      'next_page' => $next_page,
      'previous_page' => $previous_page
    ];

    $view->with('current_user', $request->user());
    $view->with('user_name', $request->user()->name);
    $view->with('images', $images);
    $view->with('pagination', $pagination);
    $view->with('title', 'STACKS');

    return $view;    
  }

  public function commentImage(Request $request) {
    $success = false;
    $image_id = $request->image_id;
    $image = BusinessImages::where('id', '=', $image_id)->first();
    $comments = BusinessImageComment::where('business_image_id', 0)->get();
    $message = "Failed to comment image.";
    $likes_count = '-1';
    $comments_count = '-1';    
    $next_page = "";
    $total_pages = 0;

    $page = $request->page;

    if ($page == null) { $page = 1; }
    
    $offset = ($page-1) * 5;

    if ($image_id != null || $image != null) {
      $success = $image->comment($request->comment, $request->user()->id);

      if ($success == true) {
        $message = "You have commented on the image.";
      }

      $likes_count = $image->likes()->count();
      $comments_count = $image->comments()->count();

      $comments = $image->comments()
        ->join('users', 'business_image_comments.user_id', '=', 'users.id')
        ->select('business_image_comments.comment', 'business_image_comments.created_at', 'users.name as user_name')
        ->orderBy('business_image_comments.id', 'desc')
        ->offset($offset)
        ->limit(5)
        ->get();

      $total_pages = (int) ($image->comments()->count() / 5);

      if ($image->comments()->count()%5 != 0) { 
        $total_pages += 1;
      }
    }

    if ($total_pages > 1 && ($page+1) <= $total_pages) {
      $next_page = $page+1;
    }

    $pagination = [
      'page' => $page,
      'next_page' => $next_page,
      'total_pages' => $total_pages
    ];

    return response()->json([
      'success'=>$success, 
      'message'=>$message, 
      'comment'=>$request->comment, 
      'comments_count'=> $comments_count,
      'likes_count'=> $likes_count,
      'comments' => $comments,
      'pagination' => $pagination,
      'image_id' => $request->image_id
    ]);
  }

  public function updateImageCaption(Request $request) {
    $success = false;
    $message = "Failed to update caption.";
    $image_id = $request->image_id;
    $image = BusinessImages::where('id', $image_id)->first();

    if ($image_id != null && $image != null) {
      $image->caption = $request->caption;
      $success = $image->save();
      
      if ($success) {
        $message = "Caption updated.";
      }
    }

    return response()->json(['success'=>$success, 'message'=>$message, 'caption'=>$request->caption]);
  }

  public function removeImage(Request $request){
    $success = false;
    $message = '';
    $image_id = $request->image_id;
    $image = BusinessImages::where('id', $image_id);

    if ($image_id != null && $image != null) {
      $success = $image->delete();

      if ($success) {
        $message = 'POST HAS BEEN REMOVED';
      }
    }

    return response()->json(['success'=>$success]);
  }

  public function stackImage(Request $request) {
    $success = false;
    $business_image_exists = BusinessImages::where('id', $request->image_id)->first() != null;

    if ($business_image_exists) {
      $success = Stack::create([
        'user_id'=>$request->user()->id, 
        'business_image_id'=>$request->image_id
      ]);
    }

    return response()->json(['success'=>$success]);
  }

  public function sendEmail(Request $request) {
    $success = true;

    $data = [
      'subject' => $request->subject,
      'content'=> $request->message,
      'receiver' => $request->to,
      'sender'=> $request->user()->email
    ];

    // $response = Mail::send('emails.business_email', ['data' => $data], function($m) use ($data) {
    //   $m->from($data['sender']);
    //   $m->to($data['receiver'])->subject($data['subject']);
    // });    

    // Log::info($response);

    return response()->json(['success'=>$success]);
  }

  public function unstackImage(Request $request) {
    $success = false;

    $image_id = $request->image_id;
    $stack = Stack::where('user_id', $request->user()->id)
      ->where('business_image_id', $image_id)
      ->first();

    if ($stack != null) {
      $stack->delete();
      $success = true;
    }

    return response()->json(['success' => $success]);
  }

  public function getImageComments(Request $request) {
    $success = false;
    $image = BusinessImages::where('id', $request->image_id)->first();
    $comments = BusinessImageComment::where('business_image_id', 0)->get();
    $next_page = "";
    $total_pages = 0;

    $page = $request->page;

    if ($page == null) { $page = 1; }
    
    $offset = ($page-1) * 5;

    if ($image != null) { 
      $success = true;
      $comments = $image->comments()
        ->join('users', 'business_image_comments.user_id', '=', 'users.id')
        ->select('business_image_comments.comment', 'business_image_comments.created_at', 'users.name as user_name')
        ->orderBy('business_image_comments.id', 'desc')
        ->offset($offset)
        ->limit(5)
        ->get();
      $total_pages = (int) ($image->comments()->count() / 5);

      if ($image->comments()->count()%5 != 0) { 
        $total_pages += 1;
      }
    }

    if ($total_pages > 1 && ($page+1) <= $total_pages) {
      $next_page = $page+1;
    }

    $pagination = [
      'page' => $page,
      'next_page' => $next_page,
      'total_pages' => $total_pages
    ];
    
    return response()->json([
      'success' => $success,
      'pagination' => $pagination, 
      'comments' => $comments,
      'image_id' => $request->image_id
    ]);
  }

  public function createReview(Request $request) {
    Log::info('Create Business Review');
    Log::info('rating: '.$request->rating);
    Log::info('review: '.$request->review);
    Log::info('business_id: '.$request->business_id);

    $success = false;
    $message = 'Failed to create review. Please try again later.';
    $rating = 0;
    $business = Business::where('id', $request->business_id)->first();

    if ($business != null) {      
      $review = Review::create([
        'reviewer_id' => $request->user()->id,
        'business_id' => $business->id,
        'rating' => $request->rating,
        'message' => $request->review
      ]);

      if ($review) {
        $success = true;
        $message = "";
      }
    }

    return response()->json([
      'success' => $success,
      'message' => $message,
      'rating' => $rating
    ]);
  }

  public function reviews(Request $request) {
    $view = view('profile.customerreviews');

    $current_page = 1;
    $offset = 0;
    $next_url = "";
    $previous_url = "";

    $current_user = $request->user();
    $business = Business::where('id', $request->id)->first();
    $business_reviews = Review::where('business_id', $request->id)->orderBy('created_at', 'desc');

    if ($business_reviews->count() % 5 == 0) {
      $total_page = (int)($business_reviews->count() / 5);
    } else if ($business_reviews->count() % 5 > 0) {
      $total_page = (int)($business_reviews->count() / 5) + 1;
    }

    if ($request->page != null && ((int)$request->page) > 1) {
      $current_page = $request->page;
      $offset = ($current_page*5) - 5;
    }

    if ($current_page < $total_page) {
      $next_url = "/business/".$request->id."/reviews?page=".($current_page+1);
    }

    if ($current_page > 1) {
      if ($current_page - 1 == 1) {
        $previous_url = "/business/".$request->id."/reviews"; 
      } else {
        $previous_url = "/business/".$request->id."/reviews?page=".($current_page-1); 
      }
    }

    $pagination = [
      'current_page' => $current_page,
      'total_page' => $total_page,
      'next_url' => $next_url,
      'previous_url' => $previous_url,
      'offset' => $offset
    ];

    Log::info($pagination);

    $business_reviews = $business_reviews->offset($offset)->limit(5)->get();

    $view->with('current_user', $current_user);
    $view->with('business', $business);
    $view->with('business_reviews', $business_reviews);
    $view->with('user_name', $current_user->name);
    $view->with('pagination', $pagination);

    return $view;

  }
 
}
