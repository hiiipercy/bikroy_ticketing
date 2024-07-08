@extends('backend.layouts.master')
@section('page_title', 'Subject')
@section('page_sub_title', 'Edit')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">Edit Subject
                        <a href="{{ route('subject.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-step-backward"
                                aria-hidden="true"></i> Back</a>
                    </h4>
                </div>
                <div class="box-body">
                    <form action="{{ route('subject.update', $subject->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <input type="hidden" name="update_id" value="{{ $subject->id }}">

                            <div class="form-group">
                                <label for="name">Name <span class="red">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $subject->name) }}">
                                @error('name')
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
                                        <option value="{{ $key }}"
                                            {{ $key == $subject->status ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-sm btn-primary" id="save-btn">Update</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
