<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Course;
use App\CourseSection;
use App\UserCourse;
use App\UserCourseSection;
use App\SubSection;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Mail;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Business;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    // protected function redirectTo(){
    //   $validator = Validator;
    //   if($validator->fails()){
    //     Session::flash('status','Register Error');
    //     return Redirect::route('/')->with('status','Register Error')
    //                             ->withInput()
    //                             ->withErrors($validator);
    //     //return Redirect::back()->withErrors($validator)->withInput()->with('error_code',5);
    //   } else {
    //     return Redirect::route('/profile')->with('status', 'Success');
    //   }
    // }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   $messages = ['password.regex' => "Your password must contain one lower case character, one upper case character, and one number.",
                     'same' => "Your password must match re-enter password.",
                     'required' => "This is required.",];
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
            'password-confirm' => 'min:8|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/|same:password',
            'remember_token' => 'nullable',
            'profession' => 'nullable',
            'occupation' => 'max:255',
            'user_type' => 'max:255',
            'birthdate' => 'required|max:255',
            'school' => 'nullable',
            'degree' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'confirmation_code' => 'nullable',
            //'aggreement' => 'required|confirmed'
        ],$messages);
        // if($validator->fails()){
        //   return Redirect::back()->with('status','Register Error')
        //                           ->withInput()
        //                           ->withErrors($validator);
        // } else {
        //   return Redirect::route('profile')->with('status','Register Success');
        // }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
      $confirmation_code = str_random(30);
      $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        //'password-confirm' => bcrypt($data['password-confirm']),
        //'confirmation_code' => $data[$confirmation_code],
        'remember_token' => $data['_token'],
        'profession' => '',
        // 'occupation' => $data['occupation'],
        'birthdate' => $data['birthdate'],
        'school' => '',
        'degree' => '',
        'city' => '',
        'state' => ''
      ]);
      $user->confirmation_code = $confirmation_code;
      $user->birthdate = $data['birthdate'];
      $user->save();
      $input = Input::only(
          'name',
          'email'
      );
      //Verification Email
      $emailData = ['confirmation_code' => $user->confirmation_code];
      Mail::send('emails.send',$emailData, function($message) {
      $message->to(Input::get('email'), Input::get('name'))
          ->subject('Verify your email address');
      });

      //Welcome Email
      Mail::send('emails.welcome',$emailData, function($message) {
      $message->to(Input::get('email'), Input::get('name'))
          ->subject('Welcome to Reinvizion!');
      });      

      if($user->email == "michael.chapman@reinvizion.com") {
        $user->user_type="consultant";
        $user->save();
      }
      else {
        $user->user_type=$data['user_type'];

        if ( $data['user_type'] != 'Business Owner' ) {
          $user->occupation = $data['occupation'];
        } else {
          Business::create([
            'user_id' => $user->id,
            'industry' => $data['occupation']
          ]);
        }

        $user->save();


        $course = Course::take(1)->first();

        if(isset($course)) {
          $user_course = UserCourse::create([
            'user_id' => $user->id,
            'course_id' => $course->id
          ]);

          $sections = $course->sections;
          $ctr = 0;
          foreach($sections as $section) {
            $is_finished = false;
            if($ctr == 0)
              $is_finished = true;
            $ctr++;
            
            $user_course_sesction_1 = UserCourseSection::create([
              'course_section_id' => $section->id, 
              'user_id' => $user->id, 
              'is_finished' => $is_finished
            ]);
          }
        }
        else {
          $course = Course::create([
            'name' => 'ENTREPRENEURSHIP 1',
            'summary' => 'Entrepreneurs who are willing to assume the risks and create new business ventures are at the heart of economic growth. This course is designed for you to explore basic entrepreneurial concepts through the blending of theory, hands-on practical, and step-by-step guidelines for developing a business plan. This course is intended to help you transform your ideas into entrepreneurial success.'
          ]);

          $course_section_intro = CourseSection::create([
            'name' => '1. Business Academy Introduction',
            'course_id' => $course->id,
            'video_url' => '217718250',
            'section_index' => 0
          ]);

          $course_section_1 = CourseSection::create([
            'name' => '1. Introduction',
            'course_id' => $course->id,
            'video_url' => '218011540',
            'section_index' => 1
          ]);
          $course_section_2 = CourseSection::create([
            'name' => '2. Whats an entrepreneur?',
            'course_id' => $course->id,
            'video_url' => '218057062',
            'section_index' => 2
          ]);
          $course_section_3 = CourseSection::create([
            'name' => '3. Who should be an entrepreneur?',
            'course_id' => $course->id,
            'video_url' => '216104270',
            'section_index' => 3
          ]);

          // $course_section_5 = CourseSection::create([
          //   'name' => '5. Benefits of being an Entrepreneur',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_6 = CourseSection::create([
          //   'name' => '6. Risks of being an Entrepreneur',
          //   'course_id' => $course->id,
          //   'video_url' => '214779115'
          // ]);
          // $course_section_7 = CourseSection::create([
          //   'name' => '7. Self Awareness',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_8 = CourseSection::create([
          //   'name' => '8. Mindset Shift',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_9 = CourseSection::create([
          //   'name' = '9. War of Attrition',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);          
          // $course_section_10 = CourseSection::create([
          //   'name' = '10. Networking is the key',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_11 = CourseSection::create([
          //   'name' => '11. Take Action',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_12 = CourseSection::create([
          //   'name' => '12. When should you start',
          //   'course_id' => $course->id,
          //   'video_url' => '214779115'
          // ]);
          // $course_section_13 = CourseSection::create([
          //   'name' => '13. Understanding Success',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_14 = CourseSection::create([
          //   'name' => '14. Recap',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // 



          $user_course = UserCourse::create([
            'user_id' => $user->id,
            'course_id' => $course->id
          ]);

          $user_course_section_intro = UserCourseSection::create([
            'course_section_id' => $course_section_intro->id, 
            'user_id' => $user->id, 
            'is_finished' => true
          ]);
          $user_course_section_1 = UserCourseSection::create([
            'course_section_id' => $course_section_1->id, 
            'user_id' => $user->id, 
            'is_finished' => true
          ]);
          $user_course_section_2 = UserCourseSection::create([
            'course_section_id' => $course_section_2->id, 
            'user_id' => $user->id, 
            'is_finished' => false
          ]);
          $user_course_section_3 = UserCourseSection::create([
            'course_section_id' => $course_section_3->id, 
            'user_id' => $user->id, 
            'is_finished' => false
          ]);

          //Bussiness Academy Intro Sub
          $course_sub_section_intro = SubSection::create([
            'name' => 'Introduction',
            'section_id' => $user_course_section_intro->id,
            'video_url' => '217718250'
            ]);


          //Introduction
          $course_sub_section_1_1 = SubSection::create([
            'name' => 'Introduction',
            'section_id' => $user_course_section_1->id,
            'video_url' => '218011540'
            ]);

          //What's an Entrepreneur
          $course_sub_section_2_1 = SubSection::create([
            'name' => 'Whats an Entrepreneur',
            'section_id' => $user_course_section_2->id,
            'video_url' => '218057062'
            ]);

          //Who Should be an Entrepreneur
          $course_sub_section_4_1 = SubSection::create([
            'name' => 'Who should be an Entrepreneur?',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218067153'
            ]);
          $course_sub_section_4_2 = SubSection::create([
            'name' => 'Fear',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218092823'
            ]);
          $course_sub_section_4_3 = SubSection::create([
            'name' => 'Patience',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218098196'
            ]);
          $course_sub_section_4_4 = SubSection::create([
            'name' => 'My Transition',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218179487'
            ]);
          $course_sub_section_4_5 = SubSection::create([
            'name' => 'Students',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218179401'
            ]);
          $course_sub_section_4_6 = SubSection::create([
            'name' => 'Activity',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218024341'
            ]);
        }
      }

      session()->flash('alert-success', 'User was successful added!');
      
      return $user;
    }

    public function fbProvider()
    {
      return Socialite::driver('facebook')->redirect();
    }
    public function googleProvider()
    {
      return Socialite::driver('google')->redirect();
    }

    public function fbCallback()
    {
      try{
        $fbUser = Socialite::driver('facebook')->user();

        // error_log("image " .$fbUser->getAvatar());

      } catch(\Exception $e) {
        $message = "Error: {$e->getMessage()}";
        error_log($message);
        return redirect('/');
      }

      $user = User::Where('uid', $fbUser->getId())->first();

      if(!$user) {
        $user = User::Where('email', $fbUser->getEmail())->first();
        if($user){
          $user->uid = $fbUser->getId();
          $user->name = $fbUser->getName();
          $user->save();
        }
        else { 
          $user=User::create([
            'uid' => $fbUser->getId(),
            'name' => $fbUser->getName(),
            'email' => $fbUser->getEmail()
          ]);
        }
        $s3 = \Storage::disk('s3');
        $imageFileName = time() . '.' . $user->name . '.png';
        $filePath = '/Reinvizion/users/' . $imageFileName;

        $s3->put($filePath, file_get_contents($fbUser->getAvatar()), 'public');

        $user->image = $s3->url( 'Reinvizion/users/'.$imageFileName);
        $user->save();

        $course = Course::take(1)->first();

        if(isset($course)) {
          $user_course = UserCourse::create([
            'user_id' => $user->id,
            'course_id' => $course->id
          ]);

          $sections = $course->sections;
          $ctr = 0;
          foreach($sections as $section) {
            $is_finished = false;
            if($ctr == 0)
              $is_finished = true;
            $ctr++;
            
            $user_course_section_1 = UserCourseSection::create([
              'course_section_id' => $section->id, 
              'user_id' => $user->id, 
              'is_finished' => $is_finished
            ]);
          }
        }
        else {
          $course = Course::create([
            'name' => 'ENTREPRENEURSHIP 1',
            'summary' => 'Entrepreneurs who are willing to assume the risks and create new business ventures are at the heart of economic growth. This course is designed for you to explore basic entrepreneurial concepts through the blending of theory, hands-on practical, and step-by-step guidelines for developing a business plan. This course is intended to help you transform your ideas into entrepreneurial success.'
          ]
          );
          $course_section_intro = CourseSection::create([
            'name' => '1. Business Academy Introduction',
            'course_id' => $$course->id,
            'video_url' => '217718250',
            'section_index' => 0
          ]);

          $course_section_1 = CourseSection::create([
            'name' => '1. Introduction',
            'course_id' => $course->id,
            'video_url' => '218011540',
            'section_index' => 1
          ]);
          $course_section_2 = CourseSection::create([
            'name' => '2. Whats an entrepreneur?',
            'course_id' => $course->id,
            'video_url' => '218057062',
            'section_index' => 2
          ]);
          $course_section_3 = CourseSection::create([
            'name' => '3. Who should be an entrepreneur?',
            'course_id' => $course->id,
            'video_url' => '216104270',
            'section_index' => 3
          ]);

          // $course_section_5 = CourseSection::create([
          //   'name' => '5. Benefits of being an Entrepreneur',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_6 = CourseSection::create([
          //   'name' => '6. Risks of being an Entrepreneur',
          //   'course_id' => $course->id,
          //   'video_url' => '214779115'
          // ]);
          // $course_section_7 = CourseSection::create([
          //   'name' => '7. Self Awareness',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_8 = CourseSection::create([
          //   'name' => '8. Mindset Shift',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_9 = CourseSection::create([
          //   'name' = '9. War of Attrition',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);          
          // $course_section_10 = CourseSection::create([
          //   'name' = '10. Networking is the key',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_11 = CourseSection::create([
          //   'name' => '11. Take Action',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_12 = CourseSection::create([
          //   'name' => '12. When should you start',
          //   'course_id' => $course->id,
          //   'video_url' => '214779115'
          // ]);
          // $course_section_13 = CourseSection::create([
          //   'name' => '13. Understanding Success',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // $course_section_14 = CourseSection::create([
          //   'name' => '14. Recap',
          //   'course_id' => $course->id,
          //   'video_url' => '207263942'
          // ]);
          // 



          $user_course = UserCourse::create([
            'user_id' => $user->id,
            'course_id' => $course->id
          ]);
          $user_course_section_intro = UserCourseSection::create([
            'course_section_id' => $course_section_intro->id, 
            'user_id' => $user->id, 
            'is_finished' => true
          ]);
          $user_course_section_1 = UserCourseSection::create([
            'course_section_id' => $course_section_1->id, 
            'user_id' => $user->id, 
            'is_finished' => true
          ]);
          $user_course_section_2 = UserCourseSection::create([
            'course_section_id' => $course_section_2->id, 
            'user_id' => $user->id, 
            'is_finished' => false
          ]);
          $user_course_section_3 = UserCourseSection::create([
            'course_section_id' => $course_section_3->id, 
            'user_id' => $user->id, 
            'is_finished' => false
          ]);

          //Bussiness Academy Intro Sub
          $course_sub_section_intro = SubSection::create([
            'name' => 'Introduction',
            'section_id' => $user_course_section_intro->id,
            'video_url' => '217718250'
            ]);

          //Introduction
          $course_sub_section_1_1 = SubSection::create([
            'name' => 'Introduction',
            'section_id' => $user_course_section_1->id,
            'video_url' => '218011540'
            ]);

          //What's an Entrepreneur
          $course_sub_section_2_1 = SubSection::create([
            'name' => 'Whats an Entrepreneur',
            'section_id' => $user_course_section_2->id,
            'video_url' => '218057062'
            ]);

          //Who Should be an Entrepreneur
          $course_sub_section_4_1 = SubSection::create([
            'name' => 'Who should be an Entrepreneur?',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218067153'
            ]);
          $course_sub_section_4_2 = SubSection::create([
            'name' => 'Fear',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218092823'
            ]);
          $course_sub_section_4_3 = SubSection::create([
            'name' => 'Patience',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218098196'
            ]);
          $course_sub_section_4_4 = SubSection::create([
            'name' => 'My Transition',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218179487'
            ]);
          $course_sub_section_4_5 = SubSection::create([
            'name' => 'Students',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218179401'
            ]);
          $course_sub_section_4_6 = SubSection::create([
            'name' => 'Activity',
            'section_id' => $user_course_section_3->id,
            'video_url' => '218024341'
            ]);


          // $user_course = UserCourse::create([
          //   'user_id' => $user->id,
          //   'course_id' => $course->id
          // ]);

          // $user_course_section_1 = UserCourseSection::create([
          //   'course_section_id' => $course_section_1->id, 
          //   'user_id' => $user->id, 
          //   'is_finished' => true
          // ]);

        }
      }

      auth()->login($user);

        // return $user->email;
      return redirect('/profile');

        // $user->token;
    }
    public function googleFeedback()
    {
      try{
        $gUser = Socialite::driver('google')->user();

      } catch(\Exception $e) {
        $message = "Error: {$e->getMessage()}";
        error_log($message);
        return redirect('/');
      }

      $user = User::Where('uid', $gUser->getId())->first();

      if(!$user) {
        $user=User::create([
          'uid' => $gUser->getId(),
          'name' => $gUser->getName(),
          'email' => $gUser->getEmail()
        ]);
      }

      auth()->login($user);

        // return $user->email;
      return redirect('/profile');

        // $user->token;
    }
}
