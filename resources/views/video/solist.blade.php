@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Doctors List</h1>


    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-striped">
        <thead>
            @if(Auth::user()->hasRole('team_lead'))
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Division</th>
                <th>Headquarter</th>
                <th>Designer</th>
            </tr>
            @endif

        </thead>
        <tbody>
            @if(Auth::user()->hasRole('team_lead'))
            @foreach($so_list as $so)
            <tr>
                <td>{{$so->id}}</td>
                <td>{{$so->firstname}}</td>
                <td>{{$so->lastname}}</td>
                <td>{{$so->username}}</td>
                <td>{{$so->division}}</td>
                <td>{{$so->headquarter}}</td>
                <td>{{$so->designer}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection