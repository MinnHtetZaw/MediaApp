@extends('admin.layout.app')



@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              {{-- alert start --}}
              @if (Session::has('updateSuccess'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('updateSuccess')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              {{-- alert end --}}
              <form class="form-horizontal" method="POST" action="{{ route('admin#update') }}">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="adminName" class="form-control" id="inputName" value="{{ old('adminName',$user->name) }}" placeholder="Enter Name">
                    @error('adminName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="adminEmail" class="form-control" id="inputEmail" value="{{ old('adminEmail',$user->email) }}" placeholder="Enter Email">
                      @error('adminEmail')
                      <div class="text-danger">{{ $message }}</div>
                  @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" name="adminPhone" class="form-control" id="inputPhone" value="{{ $user->phone }}" placeholder="Enter Phone">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                     <select name="adminGender" id="" class="form-control">
                        @if ($user->gender=='male')
                        <option value="empty">Choose Your Options</option>
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>

                        @elseif ($user->gender =='female')
                        <option value="empty">Choose Your Options</option>
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>

                        @else
                        <option value="empty" selected>Choose Your Options</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>

                        @endif
                     </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea name="adminAddress" cols="20" rows="5" class="form-control" placeholder="Enter Address">{{ $user->address }}</textarea>
                    </div>
                  </div>



                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>

              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <a href="{{ route('admin#password') }}">Change Password</a>
                </div>
              </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
