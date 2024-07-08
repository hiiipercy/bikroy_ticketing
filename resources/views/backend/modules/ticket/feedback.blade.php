@extends('backend.layouts.master')
@section('page_title', 'Ticket')
@section('page_sub_title', 'Feedback')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">Ticket's Feedback
                        <a href="{{ route('ticket.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </h4>
                </div>
                <div class="box-body">
                    <form action="{{ route('ticket.feedback_store') }}" method="post">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <div class="form-group">
                            <label for="description">Description <span class="red">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4" cols="50"></textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                        </div>
                            <div class="form-group">
                                <label for="ticket_status">Status <span class="red">*</span></label>
                                <select class="form-select form-control" id="ticket_status" name="ticket_status">
                                    <option value="">Select status</option>
                                    @foreach (STATUS as $key => $value)
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
                                <button type="submit" class="btn btn-sm btn-primary" id="save-btn">Save</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
