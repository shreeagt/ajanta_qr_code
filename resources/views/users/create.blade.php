@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
       <h1>Add new user</h1>
        <div class="lead">
            Add new user and assign role.
        </div>

        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('firstname') }}" 
                        type="text" 
                        class="form-control" 
                        name="firstname" 
                        placeholder="Name" required>

                    @if ($errors->has('firstname'))
                        <span class="text-danger text-left">{{ $errors->first('firstname') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Lastname</label>
                    <input value="{{ old('lastname') }}" 
                        type="text" 
                        class="form-control" 
                        name="lastname" 
                        placeholder="Lastname" required>
                    @if ($errors->has('lastname'))
                        <span class="text-danger text-left">{{ $errors->first('lastname') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    {{-- <label for="name" class="form-label">Password</label> --}}
                    <input value="bidinls" 
                        type="hidden" 
                        class="form-control" 
                        name="password" 
                        placeholder="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>

               
                <div class="mb-3">
                    <label for="email" class="form-label">Employee Id</label>
                    <input value="{{ old('email') }}"
                        type="text" 
                        class="form-control" 
                        name="email" 
                        placeholder="Employee Id" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="division" class="form-label">Division</label>
                    <input value="{{ old('division') }}" 
                        type="text" 
                        class="form-control" 
                        name="division" 
                        placeholder="Division" required>

                    @if ($errors->has('division'))
                        <span class="text-danger text-left">{{ $errors->first('division') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="headquarter" class="form-label">Headquarter</label>
                    <input value="{{ old('headquarter') }}" 
                        type="text" 
                        class="form-control" 
                        name="headquarter" 
                        placeholder="Headquarter" required>

                    @if ($errors->has('headquarter'))
                        <span class="text-danger text-left">{{ $errors->first('headquarter') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="designer" class="form-label">Designer</label>
                    <input value="{{ old('designer') }}" 
                        type="text" 
                        class="form-control" 
                        name="designer" 
                        placeholder="Designer" required>

                    @if ($errors->has('designer'))
                        <span class="text-danger text-left">{{ $errors->first('designer') }}</span>
                    @endif
                </div>
<?php //echo"<pre>";print_r();echo"</pre>";?>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" 
                        name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" >{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>
                   {{-- <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="{{ old('username') }}"
                        type="text" 
                        class="form-control" 
                        name="username" 
                        placeholder="Username" required>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div> --}}

               

                <button type="submit" class="btn btn-success">Save user</button>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </form>
        </div>

    </div>
@endsection