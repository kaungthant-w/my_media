@extends("admin.layouts.app")
@section("content")
<div class="col-12">
    <div class="col-3 offset-9">
        {{-- alrt start  --}}
        @if (Session::has('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{Session::get('deleteSuccess')}}
            <button class="close"><span>&times;</span></button>
        </div>
    @endif
    {{-- alert end  --}}
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List Table</h3>

        <div class="card-tools">

          <form action="{{route('admin#listSearch')}}" method="POST">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="adminListSearchKey" class="form-control float-right" placeholder="Search" value="{{old('adminListSearchKey')}}">
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
              <th>User ID</th>
              <th>Name</th>
              <th>Pizza Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($userData as $item)
            <tr>
                <td>{{$item['id']}}</td>
                <td>{{$item['name']}}</td>
                <td>{{$item['email']}}</td>
                <td>{{$item['phone']}}</td>
                <td>{{$item['address']}}</td>
                <td>{{$item['gender']}}</td>
                <td>
                    @if (auth()->user()->id != $item['id'])
                        <a @if (count($userData) == 1)
                            href="#"
                            @else
                            href="{{route('admin#accountDelete', $item['id'])}}"
                            @endif
                            class="btn btn-sm bg-danger text-white" disabled><i class="fas fa-trash-alt"></i>
                        </a>
                    @endif
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
