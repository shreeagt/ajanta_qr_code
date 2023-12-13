@extends('layouts.app-master')

@section('content')

<style>
    label.cabinet {
        display: block;
        cursor: pointer;
    }

    label.cabinet input.file {
        position: relative;
        height: 100%;
        width: auto;
        opacity: 0;
        -moz-opacity: 0;
        filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
        margin-top: -30px;
    }

    #upload-demo {
        width: 340px;
        height: 340px;
        padding-bottom: 15px;
    }
</style>
<div class="bg-light p-4 rounded">
    <h1>Edit Doctors</h1>
    {{-- <div class="lead">
            Edit Doctors.
        </div> --}}

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
                <label for="contacno">Speciality</label>
                <input type="contacno" name="contacno" id="contacno" class="form-control" value="{{ $doctor->contacno }}">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="city" name="city" id="city" class="form-control" value="{{ $doctor->city }}">
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" name="logo" id="logo" class="form-control" value="logo">
                <input type="hidden" name="logo" value="{{$doctor->logo}}">
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">Facebook Page Profile Link</label>
                <input type="text" value="{{$doctor->facebook_link}}" class="form-control" name="facebook_link" placeholder="Facebook Page Profile Link">
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">Instagram Profile Link (Clinic/Individual)</label>
                <input type="text" value="{{$doctor->insta_link}}" class="form-control" name="insta_link" placeholder="Instagram Profile Link (Clinic/Individual)">
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">YouTube Channel</label>
                <input type="text" value="{{$doctor->youtube_link}}" class="form-control" name="youtube_link" placeholder="YouTube Channel">
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">Clinic/Individual Website</label>
                <input type="text" value="{{$doctor->website_link}}" class="form-control" name="website_link" placeholder="Clinic/Individual Website">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</div>


@endsection