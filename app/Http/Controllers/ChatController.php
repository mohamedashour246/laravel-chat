<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('users',compact('users'));
    }

    public function chat($receiverId)
    {
        $receiver = User::find($receiverId);

        $messages = Message::where(function ($query) use ($receiverId) {
              $query->where('sender_id',Auth::id())->where('receiver_id',$receiverId);
        })->orWhere(function ($query) use ($receiverId) {
                $query->where('sender_id',$receiverId)->where('receiver_id',Auth::id());
        })->get();

        return view('chat',compact('receiver','messages'));
    }

//    public function sendMessage(Request $request,$receiverId)
//    {
////       $message = Message::create([
////                 'sender_id' => Auth::id(),
////                 'receiver_id' => $receiverId,
////                 'message' => $request->message,
////        ]);
////
////        broadcast(new MessageSent($message))->toOthers();
////
////        return response()->json(['status' => 'message sent'],200);
//
//        $message = $request->message;
//
//        MessageSent::dispatch($message);
//
//        return response()->json([
//              'msg' => 'message sent successfully'
//        ],201);
//    }

    public function typing()
    {
        broadcast(new UserTyping(Auth::id()))->toOthers();
        return response()->json(['status' => 'typing'],200);
    }

    public function setOnline()
    {
        Cache::put('user-is-online-' .Auth::id(),true,now()->addMinutes(5));
        return response()->json(['status' => 'online'],200);
    }

    public function setOffline()
    {
        Cache::forget('user-is-online-' .Auth::id());
        return response()->json(['status' => 'offline'],200);
    }

    public function fetchMessages(Request $request)
    {
        $userId = session('LoggedUserInfo');
        $receiverId = $request->query('receiver_id');

        $messages = Chat::where(function ($query) use($userId,$receiverId){
            $query->where('sender_id',$userId)->where('$receiver_id',$receiverId);
        })->orWhere(function ($query) use ($userId,$receiverId){
            $query->where('sender_id',$receiverId)->where('receiver_id',$userId);
        })->orderBy('created_at','asc')->get();

        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $userId = session('LoggedUserInfo');
        $receiverId = $request->receiver_id;

        $message = $request->message;

        Chat::create([
            'sender_id' => $userId,
            'receiver_id' => $receiverId,
            'message' => $message,
        ]);

      //  event(new MessageSent($message));

        return response()->json([
            'success' => true,
            'message' => 'Message send successfully'
        ]);
    }
}
