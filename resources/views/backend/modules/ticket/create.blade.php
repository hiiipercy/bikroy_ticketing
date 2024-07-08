@extends('backend.layouts.master')
@section('page_title', 'Ticket')
@section('page_sub_title', 'Create')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">Create Ticket
                        <a href="{{ route('ticket.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-step-backward" aria-hidden="true"></i>

                            Back</a>
                    </h4>
                </div>
                    <div class="box-body">

                                <form action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf


                                    <div class="form-group">
                                        <label for="subject_id">Subject <span class="red">*</span></label>
                                        <select class="form-select form-control" id="subject_id" name="subject_id">
                                            <option value="">Select Subject</option>
                                            @foreach ($subject as $key => $value)
                                                @if (old('subject_id')==$key)
                                                    <option value={{$key}} selected>{{ $value }}</option>
                                                @else
                                                    <option value={{$key}} >{{ $value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="description">Description <span class="red">*</span></label>
                                        <textarea class="summernote form-control" id="description" name="description" rows="4" cols="50">{{ old('description') }}</textarea>
                                        @error('description')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="attach_file">Attach file:</label><br>
                                        <input type="file" class="mb-5 form-control" id="attach_file" name="attach_file">
                                        @error('attach_file')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <span class="infoo">Support : jpeg,png,jpg,gif,svg</span>
                                    </div>


                                    <div class="form-group">
                                        <label for="video_link">Video link:</label><br>
                                        <input class="form-control" type="text" id="video_link" name="video_link" value="{{ old('video_link') }}"
                                            placeholder="https://example.com">
                                        @error('video_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    @php
                                    $status = ['1' => 'Open', '2' => 'Process', '3' => 'Close'];
                                    @endphp
                                    <div class="form-group">
                                        <label for="ticket_status">Status <span class="red">*</span></label>
                                        <select class="form-select form-control" id="ticket_status" name="ticket_status">
                                            <option value="">Select status</option>
                                            @foreach ($status as $key => $value)
                                                @if (old('ticket_status')==$key)
                                                    <option value={{$key}} selected>{{ $value }}</option>
                                                @else
                                                    <option value={{$key}} >{{ $value }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('ticket_status')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-sm btn-primary" id="save-btn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
        </div>
    </div>
@endsection
