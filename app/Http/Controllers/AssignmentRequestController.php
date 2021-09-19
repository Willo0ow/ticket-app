<?php

namespace App\Http\Controllers;

use App\Models\AssignmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentRequestController extends Controller
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
        $saveData = $request->all();
        return AssignmentRequest::create($saveData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignmentRequest  $assignmentRequest
     * @return \Illuminate\Http\Response
     */
    public function show(AssignmentRequest $assignmentRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignmentRequest  $assignmentRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignmentRequest $assignmentRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignmentRequest  $assignmentRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return AssignmentRequest::where('id', $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignmentRequest  $assignmentRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignmentRequest $assignmentRequest)
    {
        //
    }
    public function getDeptRequests($id){
        // return AssignmentRequest::where('dept_id', $id)->get();
        return DB::table('assignment_requests')
        ->join('users', 'assignment_requests.request_user_id', 'users.id')
        ->join('tickets', 'assignment_requests.ticket_id', 'tickets.id')
        ->select('assignment_requests.*', 'tickets.title', 'tickets.content', 'tickets.assignees','users.name as request_user')
        ->get();
    }
}
