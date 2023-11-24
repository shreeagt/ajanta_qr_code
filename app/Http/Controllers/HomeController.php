<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        if (Auth::user()->hasRole('admin')) {
            $doctors = Doctors::all()->count();
            $approve_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)->count();
            $print_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 0)->count();
            $dispatch_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)->count();
            $live_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)->count();
        } elseif (Auth::user()->hasRole('rsm')) {
            $doctors = Doctors::where('approval_status', '=', 0)
                ->where('doctors.rsm_id', '=', $id)
                ->count();
            $print_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors.rsm_id', '=', $id)
                ->where('doctors_dispatch', '=', 0)
                ->count();
            $approve_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)
                ->where('doctors.rsm_id', '=', $id)->count();
            $dispatch_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)
                ->where('doctors.rsm_id', $id)->count();
            $live_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)
                ->where('doctors.rsm_id', $id)->count();
        } elseif (Auth::user()->hasRole('team_lead')) {
            $doctors = Doctors::where('approval_status', '=', 0)
                ->where('doctors.teamlead_id', '=', $id)->count();
            $print_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors.teamlead_id', '=', $id)
                ->where('doctors_dispatch', '=', 0)
                ->count();
            $approve_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)
                ->where('doctors.teamlead_id', '=', $id)->count();
            $dispatch_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)
                ->where('doctors.teamlead_id', $id)->count();
            $live_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)
                ->where('doctors.teamlead_id', $id)->count();
        } elseif (Auth::user()->hasRole('so')) {
            $doctors = Doctors::where('doctors.soid', '=', $id)->count();
            $print_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors.soid', '=', $id)
                ->where('doctors_dispatch', '=', 0)
                ->count();
            $approve_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)
                ->where('doctors.soid', '=', $id)->count();
            $dispatch_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)
                ->where('doctors.soid', $id)->count();
            $live_doctors = Doctors::where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)
                ->where('doctors.soid', $id)->count();
        }
        return view('home.index', compact('doctors', 'approve_doctors', 'print_doctors', 'dispatch_doctors', 'live_doctors'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
