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
                    <form action="" method="GET">
                        <div class="row">

                            <div class="col-md-3">
                                <label>Select date</label>
                                <input type="text" id="daterange" class="form-control" placeholder="Select date..."/>
                                <input type="hidden" name="start_date">
                                <input type="hidden" name="end_date">
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user_id">Filter by user</label>
                                    <select class="form-select form-control" id="user_id" name="user_id">
                                        <option value="">Select User</option>
                                        @foreach ($user as $key => $value)
                                            @if (old('user_id')==$key)
                                                <option value={{$key}} selected>{{ $value }}</option>
                                            @else
                                                <option value={{$key}} >{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="subject_id">Filter by Subject</label>
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
                                </div>
                            </div>

                            @php
                                $ticket = ['1' => 'Open', '2' => 'Process', '3' => 'Close'];
                            @endphp
                            <div class="col-md-3">
                                <label>Filter by Status</label>
                                <div class="form-group">
                                    <select class="form-select form-control" id="ticket_status" name="ticket_status">
                                        <option value="">Select status</option>
                                        @foreach ($ticket as $key => $value)
                                            @if (old('ticket_status')==$key)
                                                <option value={{$key}} selected>{{ $value }}</option>
                                            @else
                                                <option value={{$key}} >{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="filter-btn" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <hr/>

                    <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>User</th>
                                <th>Subject</th>
                                <th>Video Link</th>
                                <th>Status</th>
                                <th>Created at</th>
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

    @push('js')
        <script>

            @if (session('msg'))
                Swal.fire({
                    position: "top-end",
                    icon: "{{ session('cls') }}",
                    toast: true,
                    title: "{{ session('msg') }}",
                    showConfirmButton: false,
                    timer: 5000
                });
            @endif

            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [], //Initial no order
                bInfo: true, //TO show the total number of data
                bFilter: false, //For datatable default search box show/hide
                ordering: false,
                lengthMenu: [
                    [5, 10, 15, 25, 50, 100, -1],
                    [5, 10, 15, 25, 50, 100, "All"]
                ],
                pageLength: 10, //number of data show per page
                ajax: {
                    url: "{{ route('ticket.index') }}",
                    type: 'get',
                    dataType: "JSON",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.start_date = $('input[name="start_date"]').val();
                        d.end_date = $('input[name="end_date"]').val()
                        d.user_id = $('select[name="user_id"]').val();
                        d.subject_id = $('select[name="subject_id"]').val();
                        d.ticket_status = $('select[name="ticket_status"]').val();
                    },
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'user_id'},
                    {data: 'subject_id'},
                    {data: 'video_link'},
                    {data: 'ticket_status'},
                    {data: 'created_at'},
                    {data: 'action'},
                ],
            });  

            $(document).on('click','.delete_data',function(){
                let id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    // text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirm!"
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

            $(document).on('click','#filter-btn',function(){
                table.ajax.reload();
            })

            $('#daterange').daterangepicker({
                opens: 'right',
                showDropdowns: true,
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },
                ranges: {
                    'Today'       : [moment(), moment()],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                }
            });

            $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                $('input[name="start_date"]').val(picker.startDate.format('YYYY-MM-DD'));
                $('input[name="end_date"]').val(picker.endDate.format('YYYY-MM-DD'));
            });

            $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                $('input[name="start_date"]').val('');
                $('input[name="end_date"]').val('');
            });
        </script>
    @endpush
@endsection
