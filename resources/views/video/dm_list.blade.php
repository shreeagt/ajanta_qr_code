@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>DM List</h1>


    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <table class="table table-striped">
        <thead>
            @if(Auth::user()->hasRole('rsm'))
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Division</th>
                <th>Headquarter</th>
                <th>Designation</th>
            </tr>
            @endif

        </thead>
        <tbody>
            @if(Auth::user()->hasRole('rsm'))
            @foreach($dm_list as $dm)
            <tr>
                <td>{{$dm->id}}</td>
                <td>{{$dm->firstname}}</td>
                <td>{{$dm->division}}</td>
                <td>{{$dm->headquarter}}</td>
                <td>{{$dm->designation}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection