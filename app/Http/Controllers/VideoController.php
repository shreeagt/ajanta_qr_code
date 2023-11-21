<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoModel;
use App\Models\Doctors;
use App\Models\User;
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
            //  $videos =DB::table('users')->get(); 
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
                    'teamlead_user.lastname as teamlead_lastname'
                )
                ->whereNotNull('teamlead_so_map.teamlead_id')
                ->get();
            /* VideoModel::select('video.*',"video_user.firstname as videouserfirstname","video_user.lastname as videouserlastname","approvebyuser.firstname as approvebyuserfirstname","approvebyuser.lastname as approvebyuserlastname")
            ->join('mapping_user', 'video.created_by', '=', 'mapping_user.user_id')
            ->join('users as video_user', 'video.created_by', '=','video_user.id')
            ->join('users as approvebyuser', 'video.created_by', '=','approvebyuser.id')            
            ->latest()
            ->paginate(10);*/
        } elseif (Auth::user()->hasRole('so')) {
            $id = Auth::user()->hasRole('so');
            $id = Auth::user()->id;
            // $videos = VideoModel::latest()->paginate(10);
            //$videos=DB::select('select * from doctors inner join users on doctors.soid = users.id where doctors.soid=?',[$id]);
            $videos = DB::table('users')
                ->select('users.*', 'doctors.*')
                ->leftJoin('doctors', 'users.id', '=', 'doctors.soid')
                ->where('users.id', '=', $id)
                ->get();
            // dd($videos);
            // $vid=DB::select('select * from users inner join doctors On users.id = doctors.soid where doctors.soid=?',[$id]);
            // $videos = DB::table('doctors')// ->selectRaw()// ->where('id','=',1)// ->get();/*VideoModel::select('video.*')/*->join('mapping_user', 'video.created_by', '=', 'mapping_user.user_id')->where('mapping_user.mapping_user_id', \Auth::user()->id)->latest()  ->paginate(10);*/

        } elseif (Auth::user()->hasRole('team_lead')) {
            $id = Auth::user()->hasRole('team_lead');
            $id = Auth::user()->id;
            $videos = DB::table('teamlead_so_map')
                ->select('teamlead_so_map.*', 'doctors.*')
                ->join('doctors', 'teamlead_so_map.so_id', '=', 'doctors.soid')
                ->where('teamlead_so_map.teamlead_id', '=', $id)
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
        $so_list = DB::table('teamlead_so_map')->join('users', 'teamlead_so_map.so_id', 'users.id')->where('teamlead_id', $id)->get();
        return view('video.solist', compact('so_list'));
    }
}
