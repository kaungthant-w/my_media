@extends("admin.layouts.app")
@section("content")
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin#updatePost', $updatePost['post_id'])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Post Name</label>
                    <input type="text" name="postTitle" value="{{old('postTitle',$updatePost['title'])}}" class="form-control" placeholder="Enter post Title">
                    @error('postTitle')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="postDescription" class="form-control" placeholder="Enter Post description">{{old('postDescription',$updatePost['description'])}}</textarea>
                    @error('postDescription')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for=""Image</label>
                        <input type="file" name="postImage" class="form-control mb-3" id="">
                        <img style="width:80px;height:60px"
                        @if ($updatePost['image'] == null) src="{{asset ('default/default.png')}}"
                        @else
                        src="{{asset('postImage/'.$updatePost['image'])}}"
                        @endif>
                </div>
                <div class="form-group">
                    <label for="">Category</label>
                    <select name="postCategory" class="form-control" id="">
                        <option value="">Select Category</option>
                        @foreach ($category as $item)
                            <option value="{{$item['category_id']}}"
                            @if ($item['category_id'] == $updatePost['category_id']) selected
                            @endif>{{$item['title']}}</option>
                        @endforeach
                    </select>

                    @error('postCategory')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-primary">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>
<div class="offset-1 col-7">
    @if (Session::has('deleteSuccess'))
    <div class="alert alert-warning alert-dismissible fade show">
        {{Session::get('deleteSuccess')}}
        <button class="close"><span>&times;</span></button>
    </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Post List</h3>

        <div class="card-tools">
            <form action="{{route('admin#categorySearch')}}" method="post">
                @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="categorySearch" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
            </form>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Post ID</th>
              <th>Post Name</th>
              <th>Description</th>
              <th>Post Image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($post as $item )
            <tr>
                <td>{{$item['post_id']}}</td>
                <td>{{$item['title']}}</td>
                <td> {{$item['description']}} </td>
                <td>
                    <img style="width:80px;height:60px"
                    @if ($item['image'] == null) src="{{asset ('default/default.png')}}"
                    @else
                    src="{{asset('postImage/'.$item['image'])}}"
                    @endif>
                </td>
                <td>
                    <a href="{{route('admin#updatePostPage', $item['post_id'])}}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                    </a>

                  <a href="{{route('admin#postDelete', $item['post_id'])}}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
