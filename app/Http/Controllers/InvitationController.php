<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Helpers\FunctionHelper;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invitedUsers = $this->formatData($request->all());
        try {
            Invitation::insert($invitedUsers);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        return back()->with('success', 'Invitation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();
        return response()->json(['success'=>'Invitation deleted successfully.']);
    }

    /**
     * Returns only valid emailIds with details.
     *
     */
    public function formatData($data)
    {
        $emailIds       = explode(',', str_replace(' ', '', $data['userEmails']));
        if(is_array($emailIds)) {
            foreach($emailIds as $emailId) {
                if(FunctionHelper::isValidEmail($emailId)) {
                    $invitedUsers[] = array('email' => $emailId, 'event_id' => $data['eventID'], 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now());
                }  
            }
        }
        return $invitedUsers;
    }
}
