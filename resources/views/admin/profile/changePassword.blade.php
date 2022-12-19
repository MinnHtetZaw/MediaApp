@extends('admin.layout.app')



@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
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

              <form class="form-horizontal" method="POST" action="{{ route('admin#changePassword') }}">
                @csrf
                <div class="form-group row">
                  <label for="inputOldPassword" class="col-sm-4 col-form-label">Old Password</label>
                  <div class="col-sm-6">
                    <input type="password" name="oldPassword" class="form-control" id="inputOldPassword" value="" placeholder="Enter Name">
                    @error('oldPassword')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputNewPassword" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-6">
                      <input type="password" name="newPassword" class="form-control" id="inputNewPassword" value="" placeholder="Enter New Password">
                      @error('newPassword')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputconfirmedPassword" class="col-sm-4 col-form-label">Confirmed Password</label>
                    <div class="col-sm-6">
                      <input type="password" name="confirmedPassword" class="form-control" id="inputconfirmedPassword" value="" placeholder="Enter Confirmed Password">
                      @error('confirmedPassword')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>




                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
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
@endsection
