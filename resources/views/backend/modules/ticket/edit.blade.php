@extends('backend.layouts.master')
@section('page_title', 'Ticket')
@section('page_sub_title', 'Edit')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">Edit Ticket
                        <a href="{{ route('ticket.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-step-backward" aria-hidden="true"></i> Back</a>
                    </h4>
                </div>
                    <div class="box-body">

                            <form action="{{ route('ticket.update', $ticket->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="subject_id">Subject <span class="red">*</span></label>
                                    <select class="form-select form-control" id="subject_id" name="subject_id">
                                        <option value="">Select Subject</option>

                                        @foreach ($subject as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == $ticket->subject_id ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                            <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description <span class="red">*</span></label>
                                    <textarea class="summernote form-control" id="description" name="description" rows="4" cols="50">{{ $ticket->description }}</textarea>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="mb-3 mt-2">
                                    <label for="attach_file">Attach File:</label><br>
                                    <input class="form-control" type="file" id="attach_file" name="attach_file">
                                    
                                    @error('attach_file')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    @if($ticket->attach_file)
                                    <img src="{{ asset($ticket->attach_file) }}"  style="height:50px; width:50px;" class="img-thumbnail">
                                    @else
                                    <img src="{{ asset('img/user.jpg') }}"  style="height:50px; width:50px;" class="img-thumbnail">
                                    @endif
                                    <span class="infoo">Support : jpeg,png,jpg,gif,svg</span>
                                </div>


                                <div class="form-group">
                                    <label for="video_link">Video link:</label><br>
                                    <input class="form-control" type="text" id="video_link" name="video_link"
                                        placeholder="https://example.com" value="{{$ticket->video_link}}">
                                    @error('video_link')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                @php
                                $status = ['1' => 'Open', '2' => 'Process', '3' => 'Close'];
                                @endphp
                                <div class="form-group">
                                    <label for="ticket_status">Status</label>
                                    <select class="form-select form-control" id="ticket_status" name="ticket_status">
                                        <option value="">Select status</option>
                                        @foreach ($status as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == $ticket->ticket_status ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ticket_status')
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
@endsection
