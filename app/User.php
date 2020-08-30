<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\UserConnect;
use Laravel\Cashier\Billable;
use App\ResetPasswordNotification;
use App\BusinessImages;
use App\Conversation;
use App\Review;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable,CanResetPassword,Notifiable;
    use Billable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','name', 'remember_token', 'profession', 'school','degree', 'city', 'state', 'bio', 'occupation', 'user_type', 'uid', 'provider','password-confirm','confirmation_code','firstname','lastname'
    ]; 
    protected $dates = ['trial_ends_at', 'subscription_ends_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'password-confirm'
    ];
    public function subscriptions(){
      return $this->hasOne('App\Subscription');
    }
    public function user_courses()
    {
      return $this->hasMany('App\UserCourse');
    }
    public function user_course_videos()
    {
      return $this->hasMany('App\UserCourseVideo');
    }
    public function user_course_sections()
    {
      return $this->hasMany('App\UserCourseSection');
    }
    public function comments() {
      return $this->hasMany('App\CourseComment');
    }
    public function experiences() {
      return $this->hasMany('App\UserExperience');
    }
    public function notifications() {
      return $this->hasMany('App\Notification');
    }
    public function settings() {
      return $this->hasOne('App\UserSetting');
    }
    public function connectedUsers($id) {
      $users = array();
      $a_users = UserConnect::where('user_id_a', '=', $id)->get();
      foreach ($a_users as $user) {
        $users[] = $user->user_b;
      }
      return $users;
    }
    public function isConnected($id1, $id2) {
      $isFound = false;
      $user_connect_a = UserConnect::where('user_id_a', '=', $id1)->Where('user_id_b', '=', $id2)->first();
      $user_connect_b = UserConnect::where('user_id_a', '=', $id2)->Where('user_id_b', '=', $id1)->first();
      $isFound = isset($user_connect_a) || isset($user_connect_b);

      return $isFound;

    }
    public function business(){
      return $this->hasOne('App\Business');
    }

    public function reviews(){
      return $this->hasMany('App\Review');
    }

    public function business_reviews(){
      return Review::where('reviewer_id', $this->id)
        ->where('business_id', '!=', 0);
    }

    public function stacks(){
      return $this->hasMany('App\Stack');
    }

    public function stack_images(){
      return BusinessImages::select('business_images.id as id', 'business_images.link', 'business_id', 'business_images.caption')
        ->join('stacks', 'business_images.id', '=', 'stacks.business_image_id')
        ->where('stacks.user_id', '=', $this->id);
    }

    public function business_image_likes(){
      return $this->hasMany('App\BusinessImageLike');
    }

    public function liked_business_images(){
      return BusinessImages::join('business_image_likes', 'business_images.id', '=', 'business_image_likes.business_image_id')
        ->where('business_image_likes.user_id', '=', $this->id);
    }

    public function business_image_comments(){
      return $this->hasMany('App\BusinessImageComment')
        ->select('business_image_comments.id', 'business_image_comments.comment', 'business_images.id as business_image_id', 'business_images.link')
        ->join('business_images', 'business_image_comments.business_image_id', '=', 'business_images.id');
    }

    public function conversations() {
      return Conversation::where('user_id_a', $this->id)
        ->orWhere('user_id_b', $this->id)
        ->orderBy('updated_at', 'desc');
    }

    public function has_conversation_with_user($user_id) {
      return Conversation::where('user_id_a', $this->id)
        ->where('user_id_b', $user_id)
        ->orWhere('user_id_a', $user_id)
        ->where('user_id_b', $this->id)->first() != null;
    }

    public function get_conversation_with_user($user_id) {
      return Conversation::where('user_id_a', $this->id)
        ->where('user_id_b', $user_id)
        ->orWhere('user_id_a', $user_id)
        ->where('user_id_b', $this->id)
        ->first();
    }

    // public function sendPasswordResetNotification($token){
    //   $this->notify(new ResetPasswordNotification($token));
    // }
}
?>
