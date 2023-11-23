@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Doctors Printer List</h1>

    @if(Auth::user()->hasRole('admin'))
    <a href="{{ route('doctors.generate-pdf') }}" class="btn btn-primary">Download QR Code</a>
    @endif

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-striped">
        <thead>
            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('team_lead'))
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Clinick Name</th>
                <th>Speciality</th>
                <th>City</th>
                <th>Doctors Code</th>
                <th>Team Lead</th>
                <th>RSM</th>
                <th>So</th>
                <th>Logo</th>
                @if(Auth::user()->hasRole('admin'))
                <th>Approve Doctors</th>
                @endif
            </tr>
            @endif

        </thead>
        <tbody>
            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('team_lead'))
            @foreach($videos as $video)
            <tr>
                <td>{{$video->id}}</td>
                <td>{{$video->firstname}}</td>
                <td>{{$video->lastname}}</td>
                <td>{{$video->contacno}}</td>
                <td>{{$video->city}}</td>
                <td>{{$video->email}}</td>
                <td>{{$video->teamlead_firstname}}</td>
                <td>{{$video->rsm_firstname}}</td>
                <td>{{$video->user_firstname}}</td>
                <td>@if ($video->logo)
                    <img src="{{ asset('logos/'.$video->logo) }}" alt="Logo" width="50" height="50">
                    @else
                    No Logo
                    @endif
                </td>
                <td><a href="#" class="btn btn-sm btn-primary">
                        @if($video->approval_status !=1)
                        Approval Pending
                        @elseif($video->assign_printer !=1)
                        Under Printing
                        @elseif($video->doctors_dispatch !=1)
                        Dispatching Doctor
                        @elseif($video->live_status !=1)
                        Not Live
                        @else
                        Live
                        @endif
                    </a></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection