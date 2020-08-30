<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\User;
use App\Conversation;
use App\Message;
use App\Notification;

class MessagesController extends Controller
{
  public function sendMessage(Request $req) {
    // error_log("comment " . $req->comment);
    try{
      $curUser = $req->user();
      $recUser = User::where('id', '=', $req->receiver_id)->first();
      // error_log("User: " .$recUser->id);
      $convo = Conversation::where('user_id_a', '=', $recUser->id)->where('user_id_b', '=', $curUser->id)->first();
      if(!isset($convo)){
        $convo = Conversation::where('user_id_a', '=', $curUser->id)->where('user_id_b', '=', $recUser->id)->first();
      }

      $message = Message::create([
        'sender_id' => $curUser->id,
        'receiver_id' => $recUser->id,
        'body' => $req->comment,
        'conversation_id' => $convo->id
      ]);

      $notification = Notification::create([
        'user_id' => $recUser->id,
        'notif_type' => 'direct',
        'conversation_id' => $convo->id
      ]);

      $convo->updated_at = $message->created_at;
      $convo->save();
      
    } catch(\Exception $e) {
      $message = "Error: {$e->getMessage()}";
      error_log($message);
    }
    return response()->json('Succesfully sent.', 200);
  }

  public function findUsers(Request $req) {
    $user = $req->user();
    $usersA = Conversation::where("user_id_a", '=', $user->id)->get();
    $usersB = Conversation::where("user_id_b", '=', $user->id)->get();
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

  public function createConversation(Request $req) {
    $user = $req->user();
    $other_id = $req->user_id;
    
    $conversation = Conversation::create([
      'user_id_a' => $user->id,
      'user_id_b' => $other_id
    ]);

    return response()->json([
      'message' => 'Succesfully created conversation.',
      'conversation' => $conversation
      ], 200);
  }

  public function readMessages(Request $req) {
    try{
      $conversation = Conversation::where('id', '=', $req->convId)->first();

      $messages = $conversation->messages->Where('sender_id', '!=', $req->user()->id)->Where('is_read', '=', false);

      $ids = array();
      foreach ($messages as $message) {
        // error_log("id " .$message->id);
        $ids[] = $message->id;
      }

      $messagesRead = Message::whereIn('id', $ids)->update(array('is_read' => true));

      $notifications = Notification::where('conversation_id', '=', $req->convId)->where('is_read', '=', false)->where('user_id', '=', $req->user()->id)->update(array('is_read' => true));

      // $messages;

      // error_log("messages: " .count($messages));
    } catch(\Exception $e) {
      $message = "Error: {$e->getMessage()}";
      error_log($message);
    }

    return response()->json('Succesfully read messages.', 200);
  }
}