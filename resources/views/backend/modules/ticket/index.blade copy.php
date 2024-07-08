@extends('backend.layouts.master')
@section('page_title', 'Ticket')
@section('page_sub_title', 'Dashboard')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">Ticket List
                        <a href="{{ route('ticket.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add New</a>
                    </h4>
                </div>
                    <div class="box-body">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Subject</th>
                                    <th>Video Link</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

    @if (session('msg'))
        @push('js')
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "{{ session('cls') }}",
                    toast: true,
                    title: "{{ session('msg') }}",
                    showConfirmButton: false,
                    timer: 5000
                });
            </script>
        @endpush
    @endif

    @push('js')


        <script>
 var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ticket.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_id'},
                    {data: 'subject_id'},
                    {data: 'video_link'},
                    {data: 'ticket_status'},
                    {data: 'action'},
                ],
            });  


              $(document).on('click','.delete_data',function(){
            let id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({  
                        type: "post",
                        url: "{{ route('ticket.delete') }}",
                        data: {
                            _token: "{{ csrf_token() }}",id:id
                        },
                        dataType: "json",
                        success: function (response) {
                            Swal.fire({
                                position: "top-end",
                                icon: response.status,
                                toast: true,
                                title: response.message,
                                showConfirmButton: false,
                                timer: 5000
                            });
                            table.ajax.reload();
                        }
                    });
                }
            });
        })
        </script>
    @endpush
@endsection
