@extends('frontend.main_master')
@section('content')

<!-- php  this is query builder method for image show
user  DB::table'user'->where'id', Auth::user->id->first;
endphp -->


<div class="body-content">
    <div class="container">
        <div class="row">

            <div class="col-md-2"> <br>
                <img src="{{(!empty($user->profile_photo_path))? url('upload/user_images/' .$user->profile_photo_path): url('upload/no_image.jpg')}}" class="card-img-top" style="border-radius:50%; height:100%; width:100%;">
                <br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>

                </ul>
            </div>

            <div class="col-md-2">

            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                        <strong>Update Your Password</strong>
                    </h3>

                    <div class="card-body">
                        <form action="{{route('user.password.update')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current Password <span>*</span></label>
                                <input type="password" name="oldpassword" id="current_password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New Password <span>*</span></label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password<span>*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection