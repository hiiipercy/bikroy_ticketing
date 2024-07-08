@extends('backend.layouts.master')
@section('page_title', 'Ticket')
@section('page_sub_title', 'Details')
@section('content')
    <div class="row  d-flex justify-content-center">
        <div class="col-md-8">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">Ticket Details
                        <a href="{{ route('ticket.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-step-backward" aria-hidden="true"></i> Back</a>
                    </h4>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Image : </th>
                                @if($ticket->attach_file)
                                <td><img src="{{ asset($ticket->attach_file) }}"  style="height:100px; width:100px;" class="img-thumbnail"></td>
                                @else
                                <td><img src="{{ asset('img/user.jpg') }}"  style="height:100px; width:100px;" class="img-thumbnail"></td>
                                @endif
                            </tr>


                            <tr>
                                <th scope="col">Subject : </th>
                                <td>{{ $ticket->subject->name }}</td>
                            </tr>

                            <tr>
                                <th  scope="col"> Status : </th>
                                <td>{{ $ticket->ticket_status == 1 ? 'Open' : ($ticket->ticket_status == 2 ? 'Process' : 'Close') }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Description:</th>
                                <td>{{ strip_tags($ticket->description) }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Video Link : </th>
                                <td>{{ $ticket->video_link }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Created_at</th>
                                <td>{{ ($ticket->created_at)->format('Y-m-d') }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Updated_at</th>
                                <td>{{ $ticket->updated_at != $ticket->updated_at ? $ticket->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
