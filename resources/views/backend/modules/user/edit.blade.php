@extends('backend.layouts.master')
@section('page_title', 'User')
@section('page_sub_title', 'Edit')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">Edit User
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-step-backward" aria-hidden="true"></i> Back</a>
                    </h4>
                </div>
                    <div class="box-body">
                    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="update_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="name">Name <span class="red">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ ucfirst($user->name) }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="red">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{old('email', $user->email )}}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="phone_no">Phone Number <span class="red">*</span></label>
                            <input type="text" class="form-control" id="phone_no" name="phone_no"
                                value="{{ $user->phone_no }}">
                            @error('phone_no')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        @php
                            $status = ['1' => 'Active', '2' => 'Inactive'];
                        @endphp
                        <div class="form-group">
                            <label for="status">Status <span class="red">*</span></label>
                            <select class="form-select form-control" id="status" name="status">
                                <option value="">Select status</option>
                                @foreach ($status as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $user->status ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        @php
                            $role = ['Admin', 'User'];
                        @endphp
                        <div class="form-group">
                            <label for="role_type">Role <span class="red">*</span></label>
                            <select class="form-select form-control" id="role_type" name="role_type">
                                <option value="">Select role </option>
                                @foreach ($role as $value)
                                    <option value="{{ $value }}" {{ $value == $user->role_type ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span class="red">*</span></label>
                            <input type="password" class="form-control" id="password" name="password"  value="{{ $user->password }}">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3 mt-2">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="mb-5 form-control">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            @if($user->image)
                                <img src="{{ asset($user->image) }}"  style="height:70px; width:70px;" class="img-thumbnail">
                            @else
                                <img src="{{ asset('img/user.jpg') }}"  style="height:30px; width:30px;" class="img-thumbnail">
                            @endif
                            <span class="infoo">Support : jpeg,png,jpg,gif,svg</span>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-sm btn-primary" id="save-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
