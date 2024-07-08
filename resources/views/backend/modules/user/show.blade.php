@extends('backend.layouts.master')
@section('page_title', 'User')
@section('page_sub_title', 'Details')
@section('content')
    <div class="row  d-flex justify-content-center">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-heading with-border px-3 pt-3">
                    <h4 class="d-flex my-0 align-items-center justify-content-between">User Details
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-step-backward" aria-hidden="true"></i> Back</a>
                    </h4>
                </div>
                    <div class="box-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Image : </th>
                            @if($user->image)
                            <td><img src="{{ asset($user->image) }}"  style="height:100px; width:100px;" class="img-thumbnail"></td>
                            @else
                            <td><img src="{{ asset('img/user.jpg') }}"  style="height:100px; width:100px;" class="img-thumbnail"></td>
                            @endif
                        </tr>
                        {{-- <tr>
                            <th scope="col">Image</th>
                            <td><img src="{{ asset($user->image) }}"  style="height:100px; width:100px;" class="img-thumbnail"></td>
                               
                        </tr> --}}

                        <tr>
                            <th scope="col">Name</th>
                            <td>{{  ucfirst($user->name) }}</td>
                        </tr>

                        <tr>
                            <th scope="col">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th scope="col">Phone no</th>
                            <td>{{ $user->phone_no }}</td>
                        </tr>

                        <tr>
                            <th scope="col">Role type</th>
                            <td>{{ $user->role_type }}</td>
                        </tr>

                        <tr>
                            <th scope="col">Status</th>
                            <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                        </tr>


                        <tr>
                            <th scope="col">Created_at</th>
                            <td>{{ date('d-m-Y',strtotime($user->created_at )) }}</td>
                        </tr>

                        <tr>
                            <th scope="col">Updated_at</th>
                            <td>{{ $user->updated_at != $user->updated_at ? $user->updated_at->toDayDateTimeString() : 'Not Updated' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>



        {{-- <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>User details </h4>
                    <a href="{{ route('user.index') }}"><button class="btn btn-success btn-sm">Back</button></a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>

                            

                            <tr>
                                <th scope="col">Image</th>
                                <td><img src="{{ asset($user->image) }}"  style="height:100px; width:100px;" class="img-thumbnail"></td>
                                   
                            </tr>

                            <tr>
                                <th scope="col">Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Phone no</th>
                                <td>{{ $user->phone_no }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Role type</th>
                                <td>{{ $user->role_type }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Status</th>
                                <td>{{ $user->status }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Created_at</th>
                        
                                <td>{{ date('d-m-Y',strtotime($user->created_at )) }}</td>
                            </tr>

                            <tr>
                                <th scope="col">Updated_at</th>
                                <td>{{ $user->updated_at != $user->updated_at ? $user->updated_at->toDayDateTimeString() : 'Not Updated' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
