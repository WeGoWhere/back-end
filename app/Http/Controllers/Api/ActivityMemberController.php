<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActivityMemberRequest;
use App\Http\Requests\UpdateActivityMemberRequest;
use App\Models\ActivityMember;
use Illuminate\Support\Facades\Auth;

class ActivityMemberController extends Controller
{
    public function joinActivity($id)
    {
        $user_id = Auth::id();

        $activityMember = new ActivityMember();
        $activityMember->user_id = $user_id;
        $activityMember->activity_id = $id;
        $activityMember->create_date = now();
        $activityMember->delete_date = null; // Assuming the user has not left the activity
        $activityMember->save();

        return response()->json([
            'message' => 'You have joined the activity successfully',
            'success' => true,
            'activity_member' => $activityMember
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivityMember $activityMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityMemberRequest $request, ActivityMember $activityMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityMember $activityMember)
    {
        //
    }
}