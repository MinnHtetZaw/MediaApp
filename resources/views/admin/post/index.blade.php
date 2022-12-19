@extends('admin.layout.app')

@section('content')

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('admin#createPost') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label >Title</label>
              <input type="text" name="postTitle" class="form-control" placeholder="Enter Category Name" value="{{ old('postTitle') }}">
              @error('postTitle')
              <div class="text-danger">{{ $message }}</div>
          @enderror
            </div>
            <div class="form-group">
              <label >Category</label>
              <select name="postCategory" class="form-control">
                <option value="">Choose Categories</option>
                @foreach ( $categoryData as $item)

                  <option value="{{ $item['category_id'] }}">{{ $item['title'] }}</option>

                @endforeach
              </select>
              @error('postCategory')
              <div class="text-danger">{{ $message }}</div>
          @enderror
            </div>
            <div class="form-group">
              <label >Image</label>
              <input type="file" name="postImage" class="form-control" placeholder="Enter Image">
              @error('postImage')
              <div class="text-danger">{{ $message }}</div>
          @enderror
            </div>
            <div class="form-group">
              <label >Description</label>
             <textarea name="postDescription" id="" cols="20" rows="5" class="form-control" placeholder="Enter Description">{{ old('postDescription') }}</textarea>
             @error('postDescription')
             <div class="text-danger">{{ $message }}</div>
         @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
      </div>
    </div>
  </div>
  <div class="  col-7">
    @if (Session::has('deleteSuccess'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{Session::get('deleteSuccess')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Posts</h3>

        <div class="card-tools">
          <form action="{{ route('admin#categorySearch') }}" method="Post">
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
              <th>title</th>
              <th>Image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          @foreach ( $post as $item )
          <tr>
            <td>{{$item['post_id'] }}</td>
            <td>{{$item['title']}}</td>
            <td><img class="rounded shadow-sm" width="100px"
                @if ($item['image']==null)
                src="{{ asset('defaultImage/Default.png')}}"
                @else
                src="{{ asset('postImage/'.$item['image'])}}"
                @endif
              alt=""></td>

            <td>
              <a href="{{ route('admin#updatePost',$item['post_id']) }}">
                <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
              </a>
              <a href="{{ route('admin#deletePost',$item['post_id'] ) }}">
                <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
              </a>
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
