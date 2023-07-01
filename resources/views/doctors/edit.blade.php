@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
        <h1>Edit Doctors</h1>
        <div class="lead">
            Edit Doctors.
        </div>

        <div class="container mt-4">
        <form action="{{ route('doctors.update', ['doctor' => $doctor->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="firstname">Dr. Name:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $doctor->firstname }}">
            </div>
            <div class="form-group">
                <label for="lastname">Clinic Name:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $doctor->lastname }}">
            </div>
            <div class="form-group">
                <label for="contacno">Contact No</label>
                <input type="contacno" name="contacno" id="contacno" class="form-control" value="{{ $doctor->contacno }}">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="city" name="city" id="city" class="form-control" value="{{ $doctor->city }}">
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" name="logo" id="logo" class="form-control" value="logo">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $doctor->email }}">
            </div>
            <!-- <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" name="role" id="role" class="form-control" value="{{ $doctor->role }}">
            </div> -->
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        </div>

    </div>


@endsection