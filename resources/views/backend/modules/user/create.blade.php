@extends('backend.layouts.master')
@section('page_title', 'User')
@section('page_sub_title', 'Create')
@section('content')

 <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">Create User
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-step-backward" aria-hidden="true"></i> Back</a>
                    </h4>
                </div>
                    <div class="box-body">
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="red">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        

                        <div class="form-group">
                            <label for="email">Email <span class="red">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone_no">Phone Number <span class="red">*</span></label>
                            <input type="i" class="form-control" id="phone_no" name="phone_no" value="{{ old('phone_no') }}">
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
                                    @if (old('status')==$key)
                                    <option value={{$key}} selected>{{ $value }}</option>
                                @else
                                    <option value={{$key}} >{{ $value }}</option>
                                @endif
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
                                <option value="">Select role type</option>
                                    @foreach ($role as $value)
                                        @if (old('role_type')==$value)
                                            <option value={{$value}} selected>{{ $value }}</option>
                                        @else
                                            <option value={{$value}} >{{ $value }}</option>
                                        @endif
                                    @endforeach

                            </select>
                            @error('role_type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password <span class="red">*</span></label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="mb-5 form-control" id="image" name="image">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                           <span class="infoo">Support : jpeg,png,jpg,gif,svg</span>
                        </div>
                        <br>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-sm btn-primary" id="save-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection