@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Doctors Printer List</h1>
    @if(Auth::user()->hasRole('admin'))
    <a href="{{ route('doctors.generate-pdf', 'printing_doctors') }}" class="btn btn-primary">Download QR Code</a>
    @endif 

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-striped">
        <thead>
            @if(Auth::user()->hasRole('admin'))
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Clinick Name</th>
                <th>Speciality</th>
                <th>City</th>
                <th>Doctors Code</th>
                <th>RSM</th>
                <th>Team Lead</th>
                <th>So</th>
                <th>Logo</th>
                <th>Approve Doctors</th>
            </tr>
            @endif
            @if(Auth::user()->hasRole('team_lead'))
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Clinick Name</th>
                <th>Speciality</th>
                <th>City</th>
                <th>Doctors Code</th>
                <th>So</th>
                <th>Logo</th>
            </tr>
            @endif
            @if(Auth::user()->hasRole('so'))
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Clinick Name</th>
                <th>Speciality</th>
                <th>City</th>
                <th>Designation</th>
                <th>Logo</th>
            </tr>
            @endif
            @if(Auth::user()->hasRole('rsm'))
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Clinick Name</th>
                <th>Speciality</th>
                <th>City</th>
                <th>Email</th>
                <th>DM</th>
                <th>SO</th>
                <th>Logo</th>
            </tr>
            @endif
        </thead>
        <tbody>
            @if(Auth::user()->hasRole('admin'))
            @foreach($videos as $video)
            <tr>
                <td>{{$video->id}}</td>
                <td>{{$video->firstname}}</td>
                <td>{{$video->lastname}}</td>
                <td>{{$video->contacno}}</td>
                <td>{{$video->city}}</td>
                <td>{{$video->email}}</td>
                <td>{{$video->rsm_firstname}}</td>
                <td>{{$video->user_firstname}}</td>
                <td>{{$video->teamlead_firstname}}</td>
                <td>@if ($video->logo)
                    <img src="{{ asset('logos/'.$video->logo) }}" alt="Logo" width="50" height="50">
                    @else
                    No Logo
                    @endif
                </td>
                <td><a href="{{route('get.dispatch.doctors', $video->id)}}" class="btn btn-sm btn-primary">Dispatch Doctors</a></td>
            </tr>
            @endforeach
            @endif
            @if(Auth::user()->hasRole('team_lead'))
            @foreach($videos as $video)
            <tr>
                <td>{{$video->id}}</td>
                <td>{{$video->firstname}}</td>
                <td>{{$video->lastname}}</td>
                <td>{{$video->contacno}}</td>
                <td>{{$video->city}}</td>
                <td>{{$video->email}}</td>
                <td>{{$video->user_firstname}}</td>
                <td>
                    @if ($video->logo)
                    <img src="{{ asset('logos/'.$video->logo) }}" alt="Logo" width="50" height="50">
                    @else
                    No Logo
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
            @if(Auth::user()->hasRole('so'))
            @foreach($videos as $video)
            <tr>
                @if(Auth::user()->hasRole('so'))
                <td>{{$video->id}}</td>
                @endif
                <td>{{$video->firstname}}</td>
                <td>{{$video->lastname}}</td>
                <td>{{$video->contacno}}</td>
                <td>{{$video->city}}</td>
                <td>{{$video->email}}</td>
                <td>@if ($video->logo)
                    <img src="{{ asset('logos/'.$video->logo) }}" alt="Logo" width="50" height="50">
                    @else
                    No Logo
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
            @if(Auth::user()->hasRole('rsm'))
            @foreach($videos as $video)
            <tr>
                <td>{{$video->id}}</td>
                <td>{{$video->firstname}}</td>
                <td>{{$video->lastname}}</td>
                <td>{{$video->contacno}}</td>
                <td>{{$video->city}}</td>
                <td>{{$video->email}}</td>
                <td>{{$video->user_firstname}}</td>
                <td>{{$video->teamlead_firstname}}</td>
                <td>@if ($video->logo)
                    <img src="{{ asset('logos/'.$video->logo) }}" alt="Logo" width="50" height="50">
                    @else
                    No Logo
                    @endif
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection