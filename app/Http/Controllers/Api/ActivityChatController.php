<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityChat;
use App\Models\ActivityMember;
use Illuminate\Http\Request;

class ActivityChatController extends Controller
{
    public function __construct()
   {
       $this->middleware('auth');
   }


   public function fetchGroupMessages(Request $request)
   {
    $request->validate([
        "activity_id" => "required"
    ]);
    $activity_id = $request->input('activity_id');

    $isMember = ActivityMember::where('user_id', auth()->user()->id)->where('activity_id', $activity_id)->first();

    if (!$isMember) {
        return response()->json([
            'message' => 'You are not member',
            'success' => false,
        ]);
    }
  
    // $result = ActivityChat::whereIn('activity_id', function($query) use ($user_id, $activity_id) {
    //   $query->select('id')
    //     ->from('activities')
    //     ->where(function ($subquery) use ($user_id, $activity_id) {
    //       $subquery->where('user_id', $user_id)
    //         ->where('activity_id', $activity_id);
    //     });
    // })->get();
    $result = ActivityChat::where('activity_id', $activity_id)
    ->join('users as us', 'us.id', '=', 'activity_chats.user_id')
    ->get();

    return response()->json([
      "chats" => $result,
      "result" => true
    ]);
   }
   

   public function groupMessageStore(Request $request)
   {
    $request->validate([
        "activity_id" => "required",
        "message" => "required"
    ]);
    
      $user = auth()->user();
      $activity_id = $request->input('activity_id');
      $messageText = $request->input('message');

      $existingMember = ActivityMember::where('user_id', auth()->user()->id)->where('activity_id', $activity_id)->first();

    if (!$existingMember) {
        return response()->json([
            'message' => 'You are not member',
            'success' => false,
        ]);
    }
        
      $message = new ActivityChat();
      $message->activity_id = $activity_id;
      $message->user_id = $user->id;
      $message->message = $messageText;
      $message->save();

    //   broadcast(new SendPrivateChat($message))->toOthers();
    
      return ['status' => 'Message Sent!'];
   }
}
