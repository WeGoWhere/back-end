<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ActivityMemberController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\MasterActivityController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PrivateChatController;
use App\Http\Controllers\Api\UserActivityController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//chat
// Route::post('message', [PrivateChatController::class, 'message']);
// Route::get('/all-rooms', [PrivateChat::class, 'getAllrooms']);
// Route::get('getMessage/{roomId}', [PrivateChat::class, 'getMessage']);
// Route::post('createMessage/{roomID}', [PrivateChat::class, 'newMessage']);

//from  https://pusher.com/tutorials/how-to-build-a-chat-app-with-vue-js-and-laravel/#defining-routes
Route::get('/fetchMessages', [ChatController::class, 'fetchMessages']);
Route::post('/messageStore', [ChatController::class, 'messageStore']);


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::get('/getOnlineUser', [UserController::class, 'getOnlineUser']);
Route::get('/getUserImage', [UserController::class, 'getUserImage']);
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::put('/editUser', [UserController::class, 'editUser']);
Route::get('/myActivities', [UserController::class, 'myActivities']);
Route::get('/myJoinActivities', [UserController::class, 'myJoinActivities']);

Route::get('getActiveActivities', [ActivityController::class, 'getActiveActivities']);
Route::put('editActivity/{id}', [ActivityController::class, 'editActivity']);
Route::post('createActivity', [ActivityController::class, 'createActivity']);
Route::get('getActivity/{id}', [ActivityController::class, 'getActivity']);
Route::get('getAllActivities', [ActivityController::class, 'getAllActivities']);
Route::post('joinActivity/{id}', [ActivityMemberController::class, 'joinActivity']);

Route::get('myFriends', [FriendController::class, 'showFriend']);
Route::post('statusFriend', [FriendController::class, 'statusFriend']);
Route::post('addFriend', [FriendController::class, 'addFriend']);
Route::delete('deleteFriend', [FriendController::class, 'deleteFriend']);

Route::get('allActivities', [MasterActivityController::class, 'allActivities']);
Route::post('selectActivities', [MasterActivityController::class, 'selectActivities']);

Route::get('userActivities', [UserActivityController::class, 'showUserActivities']);
Route::post('addUserActivity', [UserActivityController::class, 'addUserActivities']);
Route::delete('deleteUserActivity', [UserActivityController::class, 'deleteUserActivities']);

Route::get('myNotification', [NotificationController::class, 'myNotification']);