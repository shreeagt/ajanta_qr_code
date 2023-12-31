@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    <h1>Update user</h1>
    <div class="lead">

    </div>

    <div class="container mt-4">
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">First Name</label>
                <input value="{{ $user->firstname }}" type="text" class="form-control" name="firstname" placeholder="first Name" required>

                @if ($errors->has('firstname'))
                <span class="text-danger text-left">{{ $errors->first('firstname') }}</span>
                @endif
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Last Name</label>
                <input value="{{ $user->firstname }}" type="text" class="form-control" name="lastname" placeholder="last Name" required>
                @if ($errors->has('lastname'))
                <span class="text-danger text-left">{{ $errors->first('lastname') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ $user->email }}" class="form-control" name="email" placeholder="Email address">
                @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            {{-- <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="{{ $user->username }}"
            type="text"
            class="form-control"
            name="username"
            placeholder="Username" required>
            @if ($errors->has('username'))
            <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
    </div> --}}
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-control" name="role" id="role" required>
            <option value="">Select role</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ in_array($role->name, $userRole) 
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('role'))
        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
        @endif
    </div>
    @if(isset($team_leads))
    <div class="mb-3" id="additionalDiv" style="display: none;">
        <label for="role" class="form-label">Select Team Lead for SO</label>
        <select class="form-control" name="teamlead" id="teamlead">
            <option value="">Please select Team Lead</option>
            @foreach($team_leads as $tl)
            <option value="{{$tl->id}}">{{$tl->firstname}}</option>
            @endforeach
        </select>
    </div>
    @endif
    @if(isset($rsm))
    <div class="mb-3" id="additionalDiv1" style="display: none;">
        <label for="role" class="form-label">Select Team Lead for SO</label>
        <select class="form-control" name="rsm" id="rsm">
            <option value="">Please select Team Lead</option>
            @foreach($team_leads as $tl)
            <option value="{{$tl->id}}">{{$tl->firstname}}</option>
            @endforeach
        </select>
    </div>
    @endif

    <button type="submit" class="btn btn-primary">Update user</button>
    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
        </form>
</div>

</div>

<script>
    $(document).ready(function() {
        // Listen for changes in the role dropdown
        $('#role').change(function() {
            // Check if the selected value is 6
            if ($(this).val() == 3) {
                // Show the additional div
                $('#additionalDiv').show();
            } else {
                // Hide the additional div
                $('#additionalDiv').hide();
            }
            if($this.val() == 6){
                $('#additionalDiv1').show();
            }else{
                $('#additionalDiv1').hide();
            }
        });
    });
</script>
@endsection