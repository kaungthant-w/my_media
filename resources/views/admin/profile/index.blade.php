@extends('admin.layouts.app')
@section("content")
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
            <legend class="text-center">User Profile</legend>
            </div>
            <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">
                <form class="form-horizontal" method="post" action="{{route('admin#update')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Enter Name" value="{{$user->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" placeholder="Enter Email" value="{{$user->email}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPhone" placeholder="Enter Phone" value="{{$user->phone}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea name="" class="form-control" id="inputAddress" cols="30" rows="5" placeholder="Enter Address">{{$user->address}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10 col-md-4">
                            <select name="" id="" class="form-control">
                                @if($user->gender == "male")
                                    <option value="empty">Choose Gender...</option>
                                    <option value="male" selected>male</option>
                                    <option value="female">female</option>
                                @elseif ($user->gender == 'female')
                                    <option value="empty">Choose Gender...</option>
                                    <option value="male">male</option>
                                    <option value="female" selected>female</option>
                                @else
                                    <option value="empty" selected>Choose Gender...</option>
                                    <option value="male">male</option>
                                    <option value="female">female</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn bg-dark text-white">Submit</button>
                    </div>
                    </div>
                </form>

                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <a href="">Change Password</a>
                    </div>
                </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection
