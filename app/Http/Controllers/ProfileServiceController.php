<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\UserExperience;
use App\User;
use App\UserConnect;
use App\UserSetting;
use App\Conversation;
use App\Message;
use App\Review;
use App\Customer;
use App\BusinessImages;
use Carbon\Carbon;
use Log;

class ProfileServiceController extends Controller
{
  
 	public function __construct(){
     //will have to add a middleware to this ontroller to ensure it is not accessible unless logged in
	 $this->middleware('auth');
	}
  public function getProfile(Request $request){
    $us_states = array(
      'AL'=>'ALABAMA','AK'=>'ALASKA','AS'=>'AMERICAN SAMOA','AZ'=>'ARIZONA','AR'=>'ARKANSAS','CA'=>'CALIFORNIA','CO'=>'COLORADO','CT'=>'CONNECTICUT','DE'=>'DELAWARE','DC'=>'DISTRICT OF COLUMBIA','FM'=>'FEDERATED STATES OF MICRONESIA','FL'=>'FLORIDA','GA'=>'GEORGIA','GU'=>'GUAM GU','HI'=>'HAWAII','ID'=>'IDAHO','IL'=>'ILLINOIS','IN'=>'INDIANA','IA'=>'IOWA','KS'=>'KANSAS','KY'=>'KENTUCKY','LA'=>'LOUISIANA','ME'=>'MAINE','MH'=>'MARSHALL ISLANDS','MD'=>'MARYLAND','MA'=>'MASSACHUSETTS','MI'=>'MICHIGAN','MN'=>'MINNESOTA','MS'=>'MISSISSIPPI','MO'=>'MISSOURI','MT'=>'MONTANA','NE'=>'NEBRASKA','NV'=>'NEVADA','NH'=>'NEW HAMPSHIRE','NJ'=>'NEW JERSEY','NM'=>'NEW MEXICO',
      'NY'=>'NEW YORK','NC'=>'NORTH CAROLINA','ND'=>'NORTH DAKOTA','MP'=>'NORTHERN MARIANA ISLANDS','OH'=>'OHIO','OK'=>'OKLAHOMA','OR'=>'OREGON','PW'=>'PALAU','PA'=>'PENNSYLVANIA','PR'=>'PUERTO RICO','RI'=>'RHODE ISLAND',
      'SC'=>'SOUTH CAROLINA','SD'=>'SOUTH DAKOTA','TN'=>'TENNESSEE','TX'=>'TEXAS','UT'=>'UTAH','VT'=>'VERMONT','VI'=>'VIRGIN ISLANDS','VA'=>'VIRGINIA','WA'=>'WASHINGTON','WV'=>'WEST VIRGINIA','WI'=>'WISCONSIN','WY'=>'WYOMING', 'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST','AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)','AP'=>'ARMED FORCES PACIFIC'
    );

  	if ($request->user()->user_type == "admin" && $request->user()->confirmation_code == null)
    {
  		$view = view('profile.adminprofile');

      $current_course = 75;
      $overall = 92;

      $view->with('current_course', "" . $current_course . "");
      $view->with('current_course_value', "width:" . $current_course . "%;");
      $view->with('overall', "" . $overall . "");
      $view->with('overall_value', "width:" . $overall . "%;");
            // Auth::user() returns an instance of the authenticated user...
    }
    else if ($request->user()->user_type == "Business Owner") {
      $view = view('profile.businessowner');

      if ($request->user()->business()->first() == null) {
        $request->user()->business()->create([
          'name' => '', 
          'industry' => '',
          'tags' => ''
        ]);
      }

      # retrieve business
      $business = $request->user()->business()->first();

      # set default values
      $business_tags = "";
      $customers = Customer::where('business_id', 0)->get();
      $business_images = BusinessImages::where('business_id', 0)->get();

      # check if user has an exising business
      if ( $business != null ) {
        if ( $business->tags != "" ) {
          # retrieve business tags
          $business_tags = explode(',', $business->tags);
        }
        
        # retrieve business customer
        $customers = Customer::select('users.id', 'users.name', 'users.image', 'users.profession')
          ->join('users', 'users.id', '=', 'customers.user_id')
          ->where('business_id', '=', $business->id)
          ->get();

        # retrieve business images
        $business_images = $business->images()->offset(0)->limit(12)->get();
      }

      

      # data for contact listings
      $users = User::where('id', '<>', $request->user()->id)->offset(0)->limit(5)->get();
      $view->with('users', $users);
      $view->with('customers', $customers);
      $view->with('business', $business);
      $view->with('business_tags', $business_tags);
      $view->with('business_images', $business_images);
    }
    else if ($request->user()->user_type == 'Customer') {
      $view = view('profile.customer');

      $users = User::where('id', '<>', $request->user()->id)->offset(0)->limit(5)->get();
      $stacks = $request->user()->stack_images()->offset(0)->limit(12)->get();

      $view->with('users', $users);
      $view->with('stacks', $stacks);
      
    }
    else {
      // else if($request->user()->confirmation_code == null){
      $view = view('profile.profile');

      $courses = array();

      $user_courses = $request->user()->user_courses;
      foreach ($user_courses as $user_course) {
        $courses[] = $user_course->course;
      }

      $assignments = $request->user()->user_course_videos->take(3);

      $connected_users = $request->user()->connectedUsers($request->user()->id);

      $notifications = $request->user()->notifications->where('is_read', '=', false)->sortByDesc('created_at');

      $view->with('courses', $courses);
      $view->with('assignments', $assignments);
      $view->with('connected_users', $connected_users);
      $view->with('notifications', $notifications);
    }
    // else{
    //   return view('errors.confirmation');
    // }

    $data = array(
      "ENTREPRENEURSHIP 1",
      "INTRODUCTION TO BUSINESS",
      "WORK LIFE BALANCE",
      "BUSINESS FINANCE",
      "BUDGET AND FINANCIAL MANAGEMENT",
      "BUSINESS LAW",
      "DOING BUSINESS PROFESSIONALLY",
      "BUSINESS PLAN DEVELOPMENT",
      "SMALL BUSNESS: WHAT'S NEXT",
      "BUSINESS EXECUTION"
      );
    $view->with('data', $data);

    $view->with('page_type', 'user');
    $view->with('user_name', $request->user()->name);
    $view->with('current_user', $request->user());
    $view->with('user', $request->user());
    $view->with('us_states', $us_states);  
    $view->with('user_business', $request->user()->business()->first());

    return $view;
  }

  public function getPublicProfile(Request $request, $id) {
    $view = view('profile.publicprofile');

    $userModel = User::where('id' , '=', $id)->first();
    if(isset($userModel)) {

      if ($userModel->user_type != 'Business Owner') {
        $courses = array();

        $user_courses = $userModel->user_courses;
        foreach ($user_courses as $user_course) {
          $courses[] = $user_course->course;
        }

        // $connected_users = $userModel->connectedUsers($userModel->id);
        $connected_users = UserConnect::where('user_id_a', '=', $userModel->id)->orWhere('user_id_b', '=', $userModel->id)->get();
        
        $is_found = $userModel->isConnected($userModel->id, $request->user()->id);


        $notifications = $request->user()->notifications->where('is_read', '=', false)->sortByDesc('created_at');

        $view->with('courses', $courses);

        $view->with('user_name', $request->user()->name);
        $view->with('current_user', $request->user());
        $view->with('user', $userModel);
        $view->with('connected_users', $connected_users);
        $view->with('is_found', $is_found);
        $view->with('notifications', $notifications);
      } else {
        $view = view('profile.businessowner');

        $business = $userModel->business()->first();

        # retrieve business tags
        $business_tags = "";

        if ( $business->tags != "" ) {
          $business_tags = explode(',', $business->tags);
        }

        # retrieve business customer
        $customers = Customer::select('users.id', 'users.name', 'users.image', 'users.profession')
          ->join('users', 'users.id', '=', 'customers.user_id')
          ->where('business_id', '=', $business->id)
          ->get();

        # data for contact listings
        $users = User::where('id', '<>', $userModel->id)->offset(0)->limit(5)->get();
        $view->with('users', $users);
        $view->with('customers', $customers);
        $view->with('business', $business);
        $view->with('business_tags', $business_tags);
        $view->with('business_images', $business->images()->offset(0)->limit(12)->get());
      }

      $view->with('user_name', $request->user()->name);
      $view->with('current_user', $request->user());
      $view->with('user', $userModel);

      return $view;
    }
    else {
      return redirect()->route('root');
    }
  }

  function getSettings(Request $request) {

    $notifications = $request->user()->notifications->where('is_read', '=', false)->sortByDesc('created_at');

    $settings = $request->user()->settings;

    if(!isset($settings)) {
      $settings = UserSetting::create([
        'user_id' => $request->user()->id
      ]);
    }

    $view = view('profile.usersettings');

    $view->with('page_type', 'user');
    $view->with('user_name', $request->user()->name);
    $view->with('current_user', $request->user());
    $view->with('user', $request->user());
    $view->with('notifications', $notifications);
    $view->with('settings', $settings);

    return $view;
  }

  function getMessages(Request $request) {
    $view = view('profile.usermessages');

    $notifications = $request->user()->notifications->where('is_read', '=', false)->sortByDesc('created_at');

    $view->with('page_type', 'user');
    $view->with('user_name', $request->user()->name);
    $view->with('current_user', $request->user());
    $view->with('user', $request->user());
    $view->with('notifications', $notifications);

    // $conversations = Conversation::where('user_id_a' , '=', $request->user()->id)->OrWhere('user_id_b' , '=', $request->user()->id)->get();
    $conversations = $request->user()->conversations()->get();

    $messages = array();
    $users = array();

    $curUser = $request->user();

    foreach ($conversations as $conversation) {
      $count = count($conversation->inbox($request->user()->id));
      if($conversation->user_a->id != $curUser->id) {
        $users[] = ['user' => $conversation->user_a, 'count' => $count];
        $messages[] = ['convId' => $conversation->id, 'messages' => $conversation->messages, 'send_id' => $conversation->user_a->id];
      }
      else {
        $users[] = ['user' => $conversation->user_b, 'count' => $count];
        $messages[] = ['convId' => $conversation->id, 'messages' => $conversation->messages, 'send_id' => $conversation->user_b->id];
      }
    }

    $view->with('conv_users', $users);
    $view->with('conv_messages', $messages);

    if (isset($request->conversation_id)) {
      $view->with('existing_conversation', Conversation::where('id', $request->conversation_id)->first());
    } else {
      $view->with('existing_conversation', null);
    }

    return $view;
  }

  public function getProfileNetworks(Request $request){

    $notifications = $request->user()->notifications->where('is_read', '=', false)->sortByDesc('created_at');

    // $connected_users = $request->user()->connectedUsers($request->user()->id);
    $connected_users = UserConnect::where('user_id_a', '=', $request->user()->id)->orWhere('user_id_b', '=', $request->user()->id)->get();

    $view = view('profile.usernetworks');
    $view->with('current_user', $request->user());
    $view->with('page_type', 'user');
    $view->with('user_name', $request->user()->name);
    $view->with('user', $request->user());
    $view->with('connected_users', $connected_users);
    $view->with('notifications', $notifications);

    return $view;
  }


  public function getPublicNetworks(Request $request, $id){

    $notifications = $request->user()->notifications->where('is_read', '=', false)->sortByDesc('created_at');

    $user = User::where('id', '=', $id)->first();

    // $connected_users = $request->user()->connectedUsers($user->id);
    
    $connected_users = UserConnect::where('user_id_a', '=', $user->id)->orWhere('user_id_b', '=', $user->id)->get();

    $view = view('profile.usernetworks');
    $view->with('current_user', $request->user());
    $view->with('page_type', 'user');
    $view->with('user_name', $request->user()->name);
    $view->with('user', $user);
    $view->with('connected_users', $connected_users);
    $view->with('notifications', $notifications);

    return $view;
  }

  public function services(Request $request) {
    $view = view('profile.services');
    $view->with('current_user', $request->user());
    $view->with('user_name', $request->user()->name);

    return $view;
  }

  public function updateProfile(Request $request){
    if($request->user()->user_type == "admin"){
      return view('profile.adminprofile');
    }
    else {
      return view('profile.profile');
    }
  }
  public function updateUser(Request $request) {
    $user = $request->user();
    if ( $user->email != $request->email ) {
      $user->email = $request->email;
    }
    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->occupation = $request->occupation;
    $user->profession = $request->profession;
    $user->school = $request->school;
    $user->degree = $request->degree;
    $user->city = $request->city;
    $user->state = $request->state;
    $user->website = $request->website;
    $user->phone = $request->phone;
    $user->addr = $request->addr;
    $user->bio = $request->bio;
    $user->birthdate = $request->birthdate;
    $user->gender = $request->gender;
    $user->save();

    // start business processing for business owner user

    

    // check if user is a business owner and if business company name, industry or services is given.
    if ( $user->user_type == 'Business Owner' && ($request->company_name != '' || $request->industry != '' || $request->services != '') ) {

      // check if business owner has no existing business
      if ($user->business()->first() == null ) {
        // create new business
        $user->business()->create([
          'name' => $request->company_name, 
          'industry' => $request->industry,
          'tags' => $request->services
        ]);
      } else {
        // business owner has existing business, goes here

        // retrieve business
        $business = $user->business()->first();
        // set business name
        $business->name = $request->company_name;
        // set business industry
        $business->industry = $request->industry;

        // retrieve the number of existing services / tags
        $current_services_count = count(explode(",", $business->tags));
        $new_services_count = count(explode(',', $request->services));

        // check if services is given and the current business services / tags has not reached the limit
        if ( $request->services != '' && $current_services_count < 12 ) {
          // check if adding the new services / tags to the existing ones is less or equal to 12 (limit)
          if ($new_services_count + $current_services_count <= 12 ) {
            # check if business has no existing services
            if ($business->tags == '') {
              # set services
              $business->tags = $request->services;
            } else {
              # business has existing services, goes here

              # add the new services to the existing services
              $business->tags = $business->tags.",".$request->services;
            }  
          } else {
            // if adding next tags/services to existing exceeds the limit, goes here
            $services_array = explode(',', $request->services);
            $max_count = 12 - $current_services_count;

            $tags = [];
            for($i = 0; $i < $max_count; $i++) {
              $tags[] = $services_array[$i];
            }

            $business->tags = $business->tags.','.implode(',', $tags);
          }
        }
        
        $business->save();
      }
    }

    // return response()->json('Successfully updated user.', 200);
    return redirect('profile');
  }
  public function updateUserContact(Request $request) {
    $user = $request->user();
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->city = $request->city;
    $user->state = $request->state;
    $user->addr = $request->addr;
    $user->save();
    return response()->json('Successfully updated user contact.', 200);
  }
  public function updateUserSettings(Request $request) {
    $settings = $request->user()->settings;
    $settings->direct = $request->direct;
    $settings->feedback = $request->feedback;
    $settings->comment = $request->comment;
    $settings->connect = $request->connect;
    $settings->classmate = $request->classmate;
    $settings->save();
    return response()->json('Successfully updated user settings.', 200);
  }
  public function saveUpdateExperience(Request $request) {
    $exps = $request->ids;
    $newExps = $request->newExps;
    try
    {
      if(isset($exps)) {
        foreach($exps as $exp) {
          $user_experience = UserExperience::where('id' , '=', $exp['id'])->first();
          // error_log('something ' .$exp['is_current']);

          $is_current = 0;
          if($exp['is_current'] == 'true')
            $is_current = 1;

          if(isset($user_experience)) {
            $user_experience->title = $exp['title'];
            $user_experience->field = $exp['field'];
            $user_experience->comp_name = $exp['comp_name'];
            $user_experience->start_date = $exp['start_date'];
            if(!$exp['is_current'])
              $user_experience->end_date = $exp['end_date'];
            else
              $user_experience->is_current = $is_current;
            $user_experience->save();
          }
        }
      }
      if(isset($newExps)) {
        foreach($newExps as $exp) {
          if(trim($exp['title'] != '')) {
            $is_current = 0;
            if($exp['is_current'] == 'true')
              $is_current = 1;
            $user_experience = UserExperience::create([
              'title' => $exp['title'],
              'field' => $exp['field'],
              'comp_name' => $exp['comp_name'],
              'start_date' => $exp['start_date'],
              'end_date' => $exp['end_date'],
              'is_current' => $is_current,
              'user_id' => $request->user()->id
            ]);
          }
        }
      }
    } catch(\Exception $e) {
      $message = "Error: {$e->getMessage()}";
      error_log($message);
    }

    return response()->json('Successfully updated User Professional Experience.', 200);
  }

  public function uploadFileToS3(Request $request)
  {
    $image = $request->file('image');
    $imageFileName = time() . '.' . $image->getClientOriginalExtension();
    $s3 = \Storage::disk('s3');
    $filePath = '/Reinvizion/users/' . $imageFileName;
    try{
      $s3->put($filePath, file_get_contents($image), 'public');

      $user = $request->user();
      $user->image = $s3->url( 'Reinvizion/users/'.$imageFileName);
      $user->save();
    } catch(\Exception $e) {
      $message = "Error: {$e->getMessage()}";
      error_log("message: " .$message);
      return response()->json($e->getMessage(), 300);
    }

    return response()->json($s3->url( 'Reinvizion/users/'.$imageFileName), 200);
  }

  public function connectUsers(Request $request)
  {
    $user = $request->user();
    $otherUser = User::where('id' , '=', $request->id)->first();
    try {
      if(isset($otherUser)) {
        $user_connect = null;
        error_log("isConnet: " .$request->isConnect);
        if($request->isConnect == "true") {
          error_log("connect 1");
          $is_found = $user->isConnected($user->id, $otherUser->id);
          if($is_found != 1) {
            $user_connect = UserConnect::create([
              'user_id_a' => $user->id,
              'user_id_b' => $otherUser->id
            ]);
          }
        }
        else {
          error_log("connect 2");
          $user_connect_a = UserConnect::where('user_id_a', '=', $user->id)->Where('user_id_b', '=', $otherUser->id)->first();
          $user_connect_b = UserConnect::where('user_id_a', '=', $otherUser->id)->Where('user_id_b', '=', $user->id)->first();
          if(isset($user_connect_a)) {
            $user_connect_a->delete();
          }
          if(isset($user_connect_b)) {
            $user_connect_b->delete();
          }
        }
        return response()->json($user_connect, 200);
      }
      else {
        return response()->json('Something went wrong', 200);
      }
    } catch(\Exception $e) {
      $message = "Error: {$e->getMessage()}";
      error_log("message: " .$message);
      return response()->json($e->getMessage(), 300);
    }
  }

  public function findUsers(Request $request) {
    $user = $request->user();
    $usersA = UserConnect::where("user_id_a", '=', $user->id)->get();
    $usersB = UserConnect::where("user_id_b", '=', $user->id)->get();
    $ids= array();

    $ids[] = $user->id;

    foreach($usersA as $uA) {
      $ids[] = $uA->user_id_b;
    }
    foreach($usersB as $uB) {
      $ids[] = $uB->user_id_a;
    }

    $users=User::whereNotIn('id', $ids)->Where("user_type", "!=", "consultant")->Where("user_type", "!=", "admin")->get()->take(15);

    return response()->json($users, 200);
  }

  public function businessReviews(Request $request) {
    $current_page = 1;
    $offset = 0;
    $next_url = "";
    $previous_url = "";

    $view = view('profile.customerreviews');
    $current_user =  $request->user();
    
    if($current_user->business_reviews()->count() % 5 == 0){
      $total_page = (int)($current_user->business_reviews()->count() / 5);
    } else {
      $total_page = (int)($current_user->business_reviews()->count() / 5) + 1;
    }

    Log::info('total business reviews: '.$current_user->business_reviews()->count());

    if ($request->page != null && ((int)$request->page) > 1) {
      $current_page = $request->page;
      $offset = ($current_page*5) - 5;
    }

    Log::info('offset: '.$offset);

    if ($current_page < $total_page) {
      $next_url = "/reviews/business?page=".($current_page+1);
    }

    if ($current_page > 1) {
      if ($current_page - 1 == 1) {
        $previous_url = "/reviews/business"; 
      } else {
        $previous_url = "/reviews/business?page=".($current_page-1); 
      }
    }

    $pagination = [
      'current_page' => $current_page,
      'total_page' => $total_page,
      'next_url' => $next_url,
      'previous_url' => $previous_url
    ];
    
    $business_reviews = $current_user->business_reviews()
      ->orderBy('created_at', 'desc')
      ->offset($offset)
      ->limit(5)
      ->get();

    Log::info('business reviews count: '.count($business_reviews));

    $view->with('current_user', $current_user);
    $view->with('business_reviews', $business_reviews);
    $view->with('user_name', $current_user->name);
    $view->with('pagination', $pagination);

    return $view;
  }
}
