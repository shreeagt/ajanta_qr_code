<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoModel;
use App\Models\Doctors;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

// use FFMpeg\Filters\Video\VideoFilters;
class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->leftJoin('users as rsm_user', 'teamlead_so_map.rsm_id', '=', 'rsm_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                    'rsm_user.firstname as rsm_firstname',
                    'rsm_user.lastname as rsm_lastname'
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 0)
                ->get();
        } elseif (Auth::user()->hasRole('rsm')) {
            $id = Auth::user()->hasRole('rsm');
            $id = Auth::user()->id;

            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 0)
                ->where('doctors.rsm_id', '=', $id)
                ->get();
        } elseif (Auth::user()->hasRole('so')) {
            $id = Auth::user()->hasRole('so');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->where('doctors.so_id', '=', $id)
                ->where('approval_status', '=', 0)
                ->get();
        } elseif (Auth::user()->hasRole('team_lead')) {
            $id = Auth::user()->hasRole('team_lead');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('doctors.teamlead_id', '=', $id)
                ->where('approval_status', '=', 0)
                ->get();
        }

        return view('video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $video = $request->file('video');
        // Generate a custom name for the video
        $customName = 'video_' . time() . '.' . $video->getClientOriginalExtension();
        // Store the video in the public folder with the custom name
        // $video->storeAs('public/videos', $customName);    
        $destinationPath = 'uploads/videos';
        $video->move($destinationPath, $customName);

        $video_insert = VideoModel::create([
            "video_path" => $customName,
            "created_by" => auth()->id(),
            "created_at" => date("Y-m-d H:i:s")
        ]);

        $request->session()->flash('success', 'Data inserted successfully.');
        return redirect()->route('videocreate');
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


        $status = $request->input("status");

        $video = VideoModel::where("video_id", $id)->first();
        $video->status = $status;
        $video->save();
        // $video->update($input);

        return redirect()->route('videoList')
            ->with('success', 'Video updated successfully');
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
    public function updatevideo(Doctors $doctor)
    {
        //echo"done";
        //dd($request);
        return redirect()->route('videoList');
    }


    public function getSoList()
    {
        $id = Auth::user()->id;
        if (Auth::user()->hasRole('team_lead')) {
            $so_list = DB::table('teamlead_so_map')->join('users', 'teamlead_so_map.so_id', '=', 'users.id')->where('teamlead_id', $id)->get();
        } elseif (Auth::user()->hasRole('rsm')) {
            $so_list = DB::table('teamlead_so_map')->join('users', 'teamlead_so_map.so_id', '=', 'users.id')->select('users.*')->where('users.designation', 'SO')->where('rsm_id', $id)->distinct()->get();
        }
        return view('video.solist', compact('so_list'));
    }

    public function getDmList()
    {
        $id = Auth::user()->id;
        $dm_list = DB::table('teamlead_so_map')->join('users', 'teamlead_so_map.teamlead_id', '=', 'users.id')->select('users.*')->where('rsm_id', $id)->distinct()->get();
        return view('video.dm_list', compact('dm_list'));
    }

    public function approveDoctors($doctor_id)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        DB::table('doctors')->where('id', $doctor_id)->update(['approval_status' => 1, 'approval_time' => $current_date_time]);
        return redirect()->route('videoList');
    }

    public function getApproveDoctors()
    {
        if (Auth::user()->hasRole('admin')) {
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->leftJoin('users as rsm_user', 'teamlead_so_map.rsm_id', '=', 'rsm_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                    'rsm_user.firstname as rsm_firstname',
                    'rsm_user.lastname as rsm_lastname'
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)
                ->get();
        } elseif (Auth::user()->hasRole('rsm')) {
            $id = Auth::user()->hasRole('rsm');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)
                ->where('doctors.rsm_id', '=', $id)
                ->get();
        } elseif (Auth::user()->hasRole('so')) {
            $id = Auth::user()->hasRole('so');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)
                ->where('soid', '=', $id)
                ->get();
        } elseif (Auth::user()->hasRole('team_lead')) {
            $id = Auth::user()->hasRole('team_lead');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 0)
                ->where('doctors.teamlead_id', '=', $id)
                ->get();
        }

        return view('video.approve_doctors', compact('videos'));
    }

    public function assignPrinter($id)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        DB::table('doctors')->where('id', $id)->update(['assign_printer' => 1, 'print_time' => $current_date_time]);
        return redirect()->route('getapprove.doctors');
    }

    public function getDoctorsPrinter()
    {
        if (Auth::user()->hasRole('admin')) {
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->leftJoin('users as rsm_user', 'teamlead_so_map.rsm_id', '=', 'rsm_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                    'rsm_user.firstname as rsm_firstname',
                    'rsm_user.lastname as rsm_lastname'
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 0)
                ->get();
        } elseif (Auth::user()->hasRole('so')) {
            $id = Auth::user()->hasRole('so');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('doctors.soid', '=', $id)
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 0)
                ->get();
        } elseif (Auth::user()->hasRole('team_lead')) {
            $id = Auth::user()->hasRole('team_lead');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 0)
                ->where('doctors.teamlead_id', '=', $id)
                ->get();
        } elseif (Auth::user()->hasRole('rsm')) {
            $id = Auth::user()->hasRole('rsm');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 0)
                ->where('doctors.teamlead_id', '=', $id)
                ->get();
        }

        return view('video.printing_doctors', compact('videos'));
    }

    public function getDoctorsDispatch($id)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        DB::table('doctors')->where('id', $id)->update(['doctors_dispatch' => 1, 'dispatch_time' => $current_date_time]);
        return redirect()->route('get.doctors.printer');
    }

    public function getDispatchedDoctors()
    {
        if (Auth::user()->hasRole('admin')) {
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->leftJoin('users as rsm_user', 'teamlead_so_map.rsm_id', '=', 'rsm_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                    'rsm_user.firstname as rsm_firstname',
                    'rsm_user.lastname as rsm_lastname'
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)
                ->get();
        } elseif (Auth::user()->hasRole('so')) {
            $id = Auth::user()->hasRole('so');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->leftJoin('users as rsm_user', 'teamlead_so_map.rsm_id', '=', 'rsm_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                    'rsm_user.firstname as rsm_firstname',
                    'rsm_user.lastname as rsm_lastname'
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('doctors.soid', '=', $id)
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)
                ->get();
        } elseif (Auth::user()->hasRole('team_lead')) {
            $id = Auth::user()->hasRole('team_lead');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)
                ->where('doctors.teamlead_id', '=', $id)
                ->get();
        } elseif (Auth::user()->hasRole('rsm')) {
            $id = Auth::user()->hasRole('rsm');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 0)
                ->where('doctors.rsm_id', $id)
                ->get();
        }
        return view('video.dispatch_doctors', compact('videos'));
    }

    public function makeDoctorLive($id)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        DB::table('doctors')->where('id', $id)->update(['live_status' => 1, 'live_time' => $current_date_time]);
        return redirect()->route('get.dispatched.doctors');
    }

    public function liveDoctors()
    {
        if (Auth::user()->hasRole('admin')) {
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->leftJoin('users as rsm_user', 'teamlead_so_map.rsm_id', '=', 'rsm_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                    'rsm_user.firstname as rsm_firstname',
                    'rsm_user.lastname as rsm_lastname'
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)
                ->get();
        } elseif (Auth::user()->hasRole('so')) {
            $id = Auth::user()->hasRole('so');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('doctors.soid', '=', $id)
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)
                ->get();
        } elseif (Auth::user()->hasRole('team_lead')) {
            $id = Auth::user()->hasRole('team_lead');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)
                ->where('doctors.teamlead_id', $id)
                ->get();
        } elseif (Auth::user()->hasRole('rsm')) {
            $id = Auth::user()->hasRole('rsm');
            $id = Auth::user()->id;
            $videos = DB::table('doctors')
                ->join('users', 'doctors.soid', '=', 'users.id')
                ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
                ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
                ->select(
                    'doctors.*',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'teamlead_so_map.teamlead_id',
                    'teamlead_user.firstname as teamlead_firstname',
                    'teamlead_user.lastname as teamlead_lastname',
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->where('approval_status', '=', 1)
                ->where('assign_printer', '=', 1)
                ->where('doctors_dispatch', '=', 1)
                ->where('live_status', '=', 1)
                ->where('doctors.rsm_id', $id)
                ->get();
        }
        return view('video.live_doctors', compact('videos'));
    }



    public function allDoctors()
    {
        $videos = DB::table('doctors')
            ->join('users', 'doctors.soid', '=', 'users.id')
            ->leftJoin('teamlead_so_map', 'doctors.soid', '=', 'teamlead_so_map.so_id')
            ->leftJoin('users as teamlead_user', 'teamlead_so_map.teamlead_id', '=', 'teamlead_user.id')
            ->leftJoin('users as rsm_user', 'teamlead_so_map.rsm_id', '=', 'rsm_user.id')
            ->select(
                'doctors.*',
                'users.firstname as user_firstname',
                'users.lastname as user_lastname',
                'teamlead_so_map.teamlead_id',
                'teamlead_user.firstname as teamlead_firstname',
                'teamlead_user.lastname as teamlead_lastname',
                'rsm_user.firstname as rsm_firstname',
                'rsm_user.lastname as rsm_lastname'
            )
            ->whereNotNull('teamlead_so_map.teamlead_id')
            ->get();

        return view('video.alldoctors', compact('videos'));
    }
}
