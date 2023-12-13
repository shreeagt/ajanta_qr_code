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
    <h1>Add Doctors</h1>

    <div class="container mt-4">
        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="firstname" class="form-label">Doctor Name (Text, 1-50 characters):</label>
                <input value="{{ old('firstname') }}" type="text" class="form-control" name="firstname" placeholder="Doctor Name" required>

                @if ($errors->has('firstname'))
                <span class="text-danger text-left">{{ $errors->first('firstname') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Clinic Name (Text, 1-50 characters):</label>
                <input value="{{ old('lastname') }}" type="text" class="form-control" name="lastname" placeholder="Clinic Name" required>
                @if ($errors->has('lastname'))
                <span class="text-danger text-left">{{ $errors->first('lastname') }}</span>
                @endif
            </div>

            <!-- <div class="mb-3">
                    <label for="name" class="form-label">Password</label>
                    <input value="{{ old('password') }}" 
                        type="text" 
                        class="form-control" 
                        name="password" 
                        placeholder="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div> -->


            <!-- <div class="mb-3">
                    <label for="email" class="form-label">Doctors Code</label>
                    <input value="{{ old('email') }}"
                        type="text" 
                        class="form-control" 
                        name="email" 
                        placeholder="Doctors Code" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div> -->

            <!-- <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" name="role" required>
                        <option value="select_role">Select Role</option>
                        <option value="doctor">Doctor</option>
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div> -->

            <div class="mb-3">
                <label for="contacno" class="form-label">Specialty (Text, 1-50 characters):</label>
                <input value="{{ old('contacno') }}" type="text" class="form-control" name="contacno" placeholder="Speciality" required>
                @if ($errors->has('contacno'))
                <span class="text-danger text-left">{{ $errors->first('contacno') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City (Text, 1-30 characters):</label>
                <input value="{{ old('city') }}" type="text" class="form-control" name="city" placeholder="City" required>
                @if ($errors->has('city'))
                <span class="text-danger text-left">{{ $errors->first('city') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Doctor Profile Photo (Image, JPG/PNG format):</label>
                <input value="{{ old('logo') }}" type="file" class="form-control" name="logo" placeholder="Logo" required>
                @if ($errors->has('logo'))
                <span class="text-danger text-left">{{ $errors->first('logo') }}</span>
                @endif
            </div>

            <!-- partial:index.partial.html -->
            <!-- <div class="mb-3">
                    <label for="croppedPhoto" class="form-label">Dr. Photo</label>
                        <input value="{{ old('croppedPhoto') }}" 
                        type="hidden" 
                        class="form-control" 
                        name="croppedPhoto" 
                        id="photo-cropped"
                        placeholder="Dr. Photo" required>
                    @if ($errors->has('croppedPhoto'))
                        <span class="text-danger text-left">{{ $errors->first('croppedPhoto') }}</span>
                    @endif
                </div> -->

            <!-- <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <label class="cabinet center-block">
                            <figure>
                                <img src="" class="gambar img-responsive img-thumbnail" name="croppedPhoto" id="item-img-output" />
                                <figcaption><i class="fa fa-camera"></i></figcaption>
                            </figure>
                            <input type="file" class="item-img file center-block" name="file_photo" />
                        </label>
                    </div>
                </div>

            </div>

            <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div id="upload-demo" class="center-block"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="mb-3">
                <label for="firstname" class="form-label">Facebook Page Profile Link</label>
                <input type="text" class="form-control" name="facebook_link" placeholder="Facebook Page Profile Link" >
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">Instagram Profile Link (Clinic/Individual)</label>
                <input type="text" class="form-control" name="insta_link" placeholder="Instagram Profile Link (Clinic/Individual)" >
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">YouTube Channel</label>
                <input type="text" class="form-control" name="youtube_link" placeholder="YouTube Channel" >
            </div>

            <div class="mb-3">
                <label for="firstname" class="form-label">Clinic/Individual Website</label>
                <input type="text" class="form-control" name="website_link" placeholder="Clinic/Individual Website" >
            </div>
            <button type="submit" class="btn btn-primary">Save Doctor</button>
        </form>
    </div>

</div>
@endsection