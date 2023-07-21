@extends('layouts.app-master')

@section('content')

<style>
    
    label.cabinet{
	display: block;
	cursor: pointer;
}

label.cabinet input.file{
	position: relative;
	height: 100%;
	width: auto;
	opacity: 0;
	-moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}

#upload-demo{
	width: 340px;
	height: 340px;
  padding-bottom:15px;
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
            </div>
            <div class="form-group">
                <label for="doctors code">Doctors Code:</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $doctor->email }}">
            </div>

            <div class="form-group">
                <label for="croppedPhoto" class="form-label">Dr. Photo</label>
                <input value="{{ $doctor->croppedPhoto }}" 
                type="hidden" 
                class="form-control" 
                name="croppedPhoto" 
                id="photo-cropped"
                placeholder="Dr. Photo" >
            </div>
            
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <label class="cabinet center-block">
                            <figure>
                                @if ($doctor->croppedPhoto)
                                    <img src="{{ asset($doctor->croppedPhoto) }}" class="gambar img-responsive img-thumbnail" name="croppedPhoto" id="item-img-output" />
                                @else
                                    <img src="" class="gambar img-responsive img-thumbnail" name="croppedPhoto" id="item-img-output" />
                                @endif
                                <figcaption><i class="fa fa-camera"></i></figcaption>
                            </figure>
                            <input type="file" class="item-img file center-block" name="file_photo"/>
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
            </div>

            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        </div>

    </div>


@endsection