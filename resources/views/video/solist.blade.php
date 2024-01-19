@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded" style="overflow-x: auto;">
    <h1>SO List</h1>


    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-striped"  id="brivex-table" style="width:100%">
        <thead>
            @if(Auth::user()->hasRole('rsm'))
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Division</th>
                <th>Headquarter</th>
                <th>Designation</th>
            </tr>
            @endif
            @if(Auth::user()->hasRole('team_lead'))
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Division</th>
                <th>Headquarter</th>
                <th>Designation</th>
            </tr>
            @endif

        </thead>
        <tbody>
            @if(Auth::user()->hasRole('rsm'))
            @foreach($so_list as $so)
            <tr>
                <td>{{$so->id}}</td>
                <td>{{$so->firstname}}</td>
                <td>{{$so->division}}</td>
                <td>{{$so->headquarter}}</td>
                <td>{{$so->designation}}</td>
            </tr>
            @endforeach
            @endif
            @if(Auth::user()->hasRole('team_lead'))
            @foreach($so_list as $so)
            <tr>
                <td>{{$so->id}}</td>
                <td>{{$so->firstname}}</td>
                <td>{{$so->division}}</td>
                <td>{{$so->headquarter}}</td>
                <td>{{$so->designation}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection