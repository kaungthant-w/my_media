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
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Enter Email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPhone" placeholder="Enter Phone">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea name="" class="form-control" id="inputAddress" cols="30" rows="5" placeholder="Enter Address"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10 col-md-4">
                            <select name="" id="" class="form-control">
                                <option value="">Choose Gender...</option>
                                <option value="">male</option>
                                <option value="">female</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <a href="">Change Password</a>
                    </div>
                    </div>
                    <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn bg-dark text-white">Submit</button>
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
