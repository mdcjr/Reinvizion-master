<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Input;
use DateTime;
use Validator;
use App\Course;
use App\CourseComment;
use App\SubSection;
use App\UserCourseSection;
use App\UserCourseVideo;
use App\UserSubSection;

class CourseServicesController extends Controller
{
        //Contructor
  public function __construct(){
     //will have to add a middleware to this ontroller to ensure it is not accessible unless logged in
   $this->middleware('auth');
  }

  //Index function to call index page
  public function index(Request $request, $name){
     
    //If user is not subcribe only show intro
    
     //Call the view page
     //$request->user()->admin == 1 &&
    // if($request->user()->subscriber === 1){
    //   $view = view('course.createcourse');
      // $data = array(
      //   "ENTREPRENEURSHIP 1",
      //   "INTRODUCTION TO BUSINESS",
      //   "WORK LIFE BALANCE",
      //   "BUSINESS FINANCE",
      //   "BUDGET AND FINANCIAL MANAGEMENT",
      //   "BUSINESS LAW",
      //   "DOING BUSINESS PROFESSIONALLY",
      //   "BUSINESS PLAN DEVELOPMENT",
      //   "SMALL BUSNESS: WHAT'S NEXT",
      //   "BUSINESS EXECUTION"
      //   );
      
      // $data = array(
      //   "INTRODUCTION",
      //   "ACTIVITY",
      //   "WHAT'S AN ENTREPRENEUR?",
      //   "WHO SHOULD BE AN ENTREPRENEUR",
      //   "BENEFITS OF BEING AN ENTREPRENEUR",
      //   "RISKS OF BEING AN ENTREPRENEUR",
      //   "SELF AWARENESS",
      //   "MINDSET SHIFT",
      //   "WAR ATTRITION",
      //   "NETWORKING IS THE KEY",
      //   "TAKE ACTION",
      //   "WHEN SHOULD YOU START",
      //   "UNDERSTANDING SUCCESS",
      //   "RECAP");
      // $view->with('data', $data);
    // }  
    // else
    // {
      if($request->user()->confirmation_code == null){
        // if($request->user()->subscriber === 0){
        //   //Show Subscriber Content

        // }else{
        //   //Show Only Intro Content
        // }
        $view = view('course.viewcourse');

        $users = array();

        $id = $name;

        $column = 'name';

        $courseModel = Course::where($column , '=', $id)->first();

         if(\Auth::user()->subscriber === 1 && $courseModel->name != "BUSINESS ACADEMY INTRODUCTION"){
        //if(isset($courseModel)) {

           //if($request->user()->subscriber === 0 )
          //if(\Auth::user()->subscriber === 1 && $courseModel->name != "Introduction")
        //  {
            $user_courses = $courseModel->user_courses->Where('user_id', '!=', $request->user()->id);
            foreach ($user_courses as $user_course) {
              if(isset($user_course->user)) {
                $users[] = $user_course->user;
              }
            }

            $user_course = $courseModel->user_courses->Where('user_id', '=', $request->user()->id)->first();

            $date1=strtotime($user_course->created_at);
            $date2=strtotime((new DateTime)->format('Y-m-d H:i:s'));
            $date = (new DateTime)->format('Y-m-d H:i:s');
            $interval  = abs($date2 - $date1) / (60 * 60 * 24);

            // error_log("date1:{{$user_course->created_at}} date2:{{$date}}");

            // error_log("interval " .$interval);

            $index = $interval / 7;

            if($index < 1) 
              $index = 1;

            // $sections = $courseModel->sections->Where('section_index', '<=', $index)->sortBy('section_index')->sortBy('id');
            // $sections = $courseModel->sections->Where('section_index', '<=', $index)->sortBy('section_index');
            $sections = $courseModel->sections->sortBy('section_index');

            $sect_array = array();

            $temp_sect = array();

            foreach ($sections as $section) {
              $temp_sect[] = $section;
              $sect_array[] = $section;
            }

            // $section_counter = 0;
            // foreach ($temp_sect as $section) {
            //   // error_log("section " .$section->name ." " .$section_counter);
            //   if($section->section_index > 1 && $section_counter > 0) {
            //     $prevSection = $temp_sect[$section_counter - 1];
            //     $secUser = $prevSection->user_course_sections->Where("user_id", "=", $request->user()->id)->first();
            //     // error_log(count($secUser->id) ." something");
            //     if(isset($secUser)) {
            //       // error_log(count($secUser->user_id) ." something " .$prevSection->id ." " .$section_counter);
            //       $sect_array[] = $section;
            //     }
            //   }
            //   else {
            //     $sect_array[] = $section;
            //   }
            //   $section_counter = $section_counter + 1;
            // }

            $comments = $courseModel->course_comments->Where('reply_id', '=', 0)->take(10);
            $assignments = $courseModel->user_course_videos;

            $notifications = $request->user()->notifications->where('is_read', '=', false)->sortByDesc('created_at');

            $view->with('users', $users);
            $view->with('sections', $sect_array);
            $view->with('comments', $comments);
            $view->with('assignments', $assignments);
            $view->with('course', $courseModel);
            $view->with('notifications', $notifications);
            $view->with('sectIndex', $index);
            $view->with('userInterval', $interval);
          }
          else {
            //Show only first video
            // $user_courses = $courseModel->user_courses->Where('user_id', '!=', $request->user()->id)->first();
            // // foreach ($user_courses as $user_course) {
            // //   if(isset($user_course->user)) {
            // //     $users[] = $user_course->user;
            // //   }
            // // }

            // $user_course = $courseModel->user_courses->Where('user_id', '=', $request->user()->id)->first();

            // // $date1=strtotime($user_course->created_at);
            // // $date2=strtotime((new DateTime)->format('Y-m-d H:i:s'));
            // // $interval  = abs($date2 - $date1) / (60 * 60 * 24);

            // // // error_log("interval " .$interval);

            // // $index = $interval / 7;

            // // if($index < 1) 
            // //   $index = 1;
             
             $sections = $courseModel->sections->Where('id','=',1);
             $comments = $courseModel->course_comments->Where('reply_id', '=', 0)->take(10);
             $assignments = $courseModel->user_course_videos;

             $notifications = $request->user()->notifications->where('is_read', '=', false)->sortByDesc('created_at');

             $view->with('users', $users);
             $view->with('sections', $sections);
             $view->with('comments', $comments);
             $view->with('assignments', $assignments);
             $view->with('course', $courseModel);
             $view->with('notifications', $notifications);
          }
        }
        // else {
        //   return redirect()->route('root');
        // }
      //}
      else{
        return view('errors.confirmation');
      }
  //  }

    $view->with('current_user', $request->user());

    $view->with('user_name', $request->user()->name);
    $view->with('user_image', $request->user()->image);
    $view->with('page_type', 'course');

    return $view;
  }

  public function getCourse(Request $request){

  }
  public function addCourse(){
      $input = Input::all();

      $rules = array(
          'files' => '',
      );

      $validation = Validator::make($input, $rules);

      if($validation->fails()){
          return Redirect::to('/')->with('message', $validation->error->first());
      }

      $file = array_get($input, 'file');
      $destinationPath = 'uploads';
      $extension = $file->getClientOriginalExtension();
      $fileName = 'video' . '.' . $extension;
      $upload_success = $file->move($destinationPath,$fileName);

      if($upload_success){
        return Redirect::to('/')-> with('message','Video Upload Successfully');
      }
  }

  public function addComment(Request $request) {
    $courseModel = Course::where('name' , '=', $request->course_id)->first();
    if(isset($courseModel)) {
      $course_comment = CourseComment::create([
        'body' => $request->comment,
        'reply_id' => $request->reply_id,
        'course_id' => $courseModel->id,
        'is_reply' => false,
        'user_id' => $request->user()->id,
        'sub_section_id' => $request->sub_id
      ]);
      return response()->json($course_comment, 200);
    }
    else {
      return response()->json('Something went wrong', 200);
    }
  }

  public function fetchSectionVideo(Request $request) {
    $courseModel = Course::where('name' , '=', $request->course_id)->first();
    if(isset($courseModel)) {
      if($request->section_index <= $courseModel->sections->count()) {
        try {
          $section = $courseModel->sections[$request->section_index];
          $user_course_section = UserCourseSection::where('course_section_id', '=', $section->id)->where('user_id', '=', $request->user()->id)->first();
          if(!(isset($user_course_section))) {
            $user_course_section = UserCourseSection::create([
              'user_id' => $request->user()->id,
              'course_section_id' => $section->id,
              'is_finished' => '1'
            ]);

            $prevSectionIndex = $request->section_index - 1;
            $prevSection = $courseModel->sections[$prevSectionIndex];
            $prev_user_course_section = UserCourseSection::where('course_section_id', '=', $prevSection->id)->where('user_id', '=', $request->user()->id)->first();
            $dt = new DateTime;
            $prev_user_course_section->finished_at = $dt->format('Y-m-d H:i:s');
            $prev_user_course_section->save();
          }
        } catch(\Exception $e) {
          return response()->json($e->getMessage(), 300);
        }
        return response()->json($section, 200);
      }
      else {
        return response()->json('Already surpassed last section.', 300);
      }
    }
    else {
      return response()->json('Course does not exist', 300);
    }
  }

  public function fetchComments(Request $request) {
    $courseModel = Course::where('name' , '=', $request->course_id)->first();
    if(isset($courseModel)) {
      $index = $request->index;
      $count = $courseModel->course_comments->Where('reply_id', '=', 0)->count();
      if($index <= $count) {
        $max = 10;
        if(($index + $max) > $count) {
          $max = $count - $index;
        }

        $comments = array();
        $replies = array();

        try{
          // $comments = $courseModel->course_comments->Where('reply_id', '=', 0)->take(10);
          $tempComments = $courseModel->course_comments->Where('reply_id', '=', 0)->take($index + 10);

          $count = count($tempComments);

          $commentArray = array();
          foreach ($tempComments as $comment) {
            $commentArray[] = $comment;
          }

          // error_log("max: {$count}");
          for ($ctr = 0; $ctr < $max; $ctr++) {
            $sumIndex = $index + $ctr;
            // error_log("index: {$sumIndex}");
            $currentComment = $commentArray[$sumIndex];
            $comments[] = array('comment'=>$currentComment, 'name' => $currentComment->user->name, 'image' => $currentComment->user->image);
          }
          foreach ($comments as $comment ) {
            
            $tempReplies = array();
            $replyArray = $comment['comment']->replies();
            foreach($replyArray as $reply) {
              $tempReplies[] = array('reply' => $reply, 'name' => $reply->user->name, 'image' => $reply->user->image);
            }

            $replies[] = $tempReplies;
            // $count= count($comment->replies());
            // error_log("reply count: {$count}");
          }
          return response()->json(array('comments'=> $comments, 'replies'=> $replies), 200);
        } catch(\Exception $e) {
          $message = "Error: {$e->getMessage()}";
          error_log($message);
          return response()->json($e->getMessage(), 300);
        }
      }
      else {
        return response()->json('There are no more comments to return.', 300);
      }
    }
    else {
      return response()->json('Course does not exist.', 300);
    }
  }

  public function fetchSubComments(Request $request) {
    $subSection = SubSection::where('id' , '=', $request->sub_id)->first();
    if(isset($subSection)) {
      $index = $request->index;
      $count = $subSection->comments->Where('reply_id', '=', 0)->count();
      if($index <= $count) {
        $max = $count;
        if(($index + $max) > $count) {
          $max = $count - $index;
        }

        $comments = array();
        $replies = array();

        try{
          // $comments = $courseModel->course_comments->Where('reply_id', '=', 0)->take(10);
          $tempComments = $subSection->comments->Where('reply_id', '=', 0)->take($index + 10);

          $count = count($tempComments);

          $commentArray = array();
          foreach ($tempComments as $comment) {
            $commentArray[] = $comment;
          }

          // error_log("max: {$count}");
          for ($ctr = 0; $ctr < $max; $ctr++) {
            $sumIndex = $index + $ctr;
            // error_log("index: {$sumIndex}");
            $currentComment = $commentArray[$sumIndex];
            $comments[] = array('comment'=>$currentComment, 'name' => $currentComment->user->name, 'image' => $currentComment->user->image);
          }
          foreach ($comments as $comment ) {
            
            $tempReplies = array();
            $replyArray = $comment['comment']->replies();
            foreach($replyArray as $reply) {
              $tempReplies[] = array('reply' => $reply, 'name' => $reply->user->name, 'image' => $reply->user->image);
            }

            $replies[] = $tempReplies;
            // $count= count($comment->replies());
            // error_log("reply count: {$count}");
          }

          $video_url = $subSection->video_url;

          if($request->subIndex > 0) {
            $section = $subSection->section;
            $subSections = $section->sub_sections;

            $sub = $subSections[$request->subIndex - 1];

            $user_sub_section = UserSubSection::where('sub_section_id', '=', $sub->id)->where('user_id', '=', $request->user()->id)->first();

            if(!isset($user_sub_section)) {
              $video_url = '';
            }
            else {
              $date1=strtotime($user_sub_section->created_at);
              $date2=strtotime((new DateTime)->format('Y-m-d H:i:s'));
              $curMin = round(abs($date2 - $date1) / 60,2);

              // error_log($curMin ." minutes");

              if($curMin < $section->delay_time) {
                $video_url = '';
              }
            }
          }

          $subObj = array('summary' => $subSection->summary, 'video_url' => $video_url);

          return response()->json(array('subSection' => $subObj, 'comments'=> $comments, 'replies'=> $replies), 200);
        } catch(\Exception $e) {
          $message = "Error: {$e->getMessage()}";
          error_log($message);
          return response()->json($e->getMessage(), 300);
        }
      }
      else {
        return response()->json('There are no more comments to return.', 300);
      }
    }
    else {
      return response()->json('Course does not exist.', 300);
    }
  }

  public function fetchReplies(Request $request) {
    $courseComment = CourseComment::where('id' , '=', $request->comment_id)->first();
    if(isset($courseComment)) {
      $index = $request->index;
      $count = $courseComment->replies()->count();
      $max = 5;
      if(($index + $max) > $count) {
        $max = $count - $index;
      }
      // error_log("values: {$index} {$count} {$max}");

      $replies = array();

      try{
        // $comments = $courseModel->course_comments->Where('reply_id', '=', 0)->take(10);
        $tempReplies = $courseComment->replies()->take($index + 5);

        $replyArray = array();
        foreach ($tempReplies as $reply) {
          $replyArray[] = $reply;
        }

        for ($ctr = 0; $ctr < $max; $ctr++) {
          $sumIndex = $index + $ctr;
          // error_log("index: {$sumIndex}");
          $currentReply = $replyArray[$sumIndex];
          $replies[] = array('reply' => $currentReply, 'name' => $currentReply->user->name, 'image' => $currentReply->user->image);
        }

        return response()->json($replies, 200);
        // foreach($replyArray as $reply) {
        //   $replies[] = array('reply' => $reply, 'name' => $reply->user->name);
        // }

      } catch(\Exception $e) {
        $message = "Error: {$e->getMessage()}";
        error_log($message);
        return response()->json($e->getMessage(), 300);
      }
    }
    else {
      return response()->json('Comment does not exist.', 300);
    }
  }

  public function addUserVideo(Request $request) {
    $user = $request->user();
    $courseModel = Course::where('name' , '=', $request->course_id)->first();
    if(isset($courseModel)) {
      $user_video = UserCourseVideo::create([
        'video_url' => $request->url,
        'course_id' => $courseModel->id,
        'user_id' => $user->id
      ]);
      return response()->json($user_video, 200);
    }
    else {
      return response()->json('Something went wrong', 200);
    }
  }

  public function viewSubsection(Request $request) {
    $user_sub_section = UserSubSection::where('sub_section_id', '=', $request->sub_section_id)->where('user_id', '=', $request->user()->id)->first();

    $is_last = "false";

    try{
      if(!isset($user_sub_section)) {
        $user_sub_section = UserSubSection::create([
          'user_id' => $request->user()->id,
          'sub_section_id' => $request->sub_section_id,
          'is_finished' => '1'
        ]);

        $subSection = SubSection::where("id", "=", $request->sub_section_id)->first();
        $section = $subSection->section;
        // $subSections = $section->sub_sections->first(['id']);
        $subSections = SubSection::select('id')->where("section_id", "=", $section->id)->get();

        $subArr = array();
        foreach($subSections as $sub) {
          $subArr[] = $sub->id;
        }

        $userSubs = UserSubSection::whereIn('sub_section_id', $subArr)->get();

        error_log(count($subSections) ." " .count($userSubs));

        if(count($subSections) == count($userSubs)) {
          $user_course_section = UserCourseSection::create([
            'user_id' => $request->user()->id,
            'course_section_id' => $section->id,
            'is_finished' => '1'
          ]);
          $is_last = "true";
        }
      }
    } catch(\Exception $e) {
      $message = "Error: {$e->getMessage()}";
      error_log($message);
    }

    return response()->json(array("is_last" => $is_last), 200);
  }
  
}