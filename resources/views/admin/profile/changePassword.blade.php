@extends('admin.layouts.app')
@section("content")
    <div class="col-10 offset-3 mt-5">
        <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
            <legend class="text-center">User Profile</legend>
            </div>
            <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                    {{-- alrt start  --}}
                    @if (Session::has('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{Session::get('updateSuccess')}}
                            <button class="close"><span>&times;</span></button>
                        </div>
                    @endif
                    {{-- alert end  --}}
                <form class="form-horizontal" method="post" action="{{route('admin#changePassword')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="oldPassword" class="col-sm-3 col-form-label">Old Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="oldPassword" class="form-control" id="oldPassword" placeholder="Enter old password">

                            @error('oldPassword')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="newPassword" class="form-control" id="newPassword" placeholder="Enter new password">
                            @error('newPassword')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirmPassword" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Enter confirm password">
                            @error('confirmPassword')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                    <div class="offset-sm-3 col-sm-9">
                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
                    </div>
                    </div>
                </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
