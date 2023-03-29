@extends("admin.layouts.app")
@section("content")
<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin#createCategory')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" name="categoryName" class="form-control" placeholder="Enter category name">
                    @error('categoryName')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="categoryDescription" class="form-control"></textarea>
                    @error('categoryDescription')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    Create
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
        <h3 class="card-title">Category List</h3>

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
              <th>Category ID</th>
              <th>Category Name</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($category as $item )
            <tr>
                <td>{{$item['cateogry_id']}}</td>
                <td>{{$item['title']}}</td>
                <td> {{$item['description']}} </td>
                <td>
                  <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                  <a href="{{route('admin#deleteCategory', $item['category_id'])}}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
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
