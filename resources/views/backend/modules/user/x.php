@extends('backend.layouts.master')
@section('page_title', 'User')
@section('page_sub_title', 'Dashboard')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12 widget-header-item">
            <div class="box box-solid">
                <div class="box-heading d-flex align-items-center justify-content-between m-4">
                    <h4>User List</h4>
                    <a href="{{ route('user.create') }}"><button class="btn btn-danger btn-sm">+ Add</button></a>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone no</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">image</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $sl = 1;
                            @endphp

                            @foreach ($user as $row)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone_no }}</td>
                                    <td>{{ $row->role_type }}</td>
                                    <td>{{ $row->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td><img src="{{ asset($row->image) }}" style="height:30px; width:50px;"
                                            class="img-thumbnail"></td>
                                    <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                                    <td>{{ $row->updated_at != $row->created_at ? $row->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('user.show', $row->id) }}">
                                                <button class="btn btn-info btn-sm mr-2"> <i
                                                        class="fa-solid fa-eye"></i></button></a>

                                            <a href="{{ route('user.edit', $row->id) }}">
                                                <button class="btn btn-warning btn-sm mr-2"> <i
                                                        class="fa-solid fa-edit"></i></button></a>

                                            <form action="{{ route('user.destroy', $row->id) }}"
                                                id="form_{{ $row->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" data-id="{{ $row->id }}"
                                                    class="delete btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="footer d-flex align-items-center justify-content-end">
                        {!! $user->links() !!}
                    </div>
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
            $('.delete').on('click', function() {
                let id = $(this).attr('data-id')
                // console.log(id);
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
                        $(`#form_${id}`).submit()
                    }
                });
            })


            $('#name').on('input', function() {
                let name = $(this).val()
                let slug = name.replaceAll(' ', '-')
                $('#slug').val(slug.toLowerCase());
            })
        </script>
    @endpush
@endsection
