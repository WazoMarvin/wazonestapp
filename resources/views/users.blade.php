@extends('layouts.boots')

@section('content')
    <div>
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="text-lg mb-0">Users</p>
            </div>
            <div class="col-md-6 text-right">
                <button @click.prevent="newUser" class="btn btn-sm btn-primary">New User</button>
            </div>
        </div>
        <table class="table ">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>CreatedOn</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->user_role}}</td>
                    <td> <a href="" class=" fa fa-edit"></a> <a href="" class=" fa fa-trash"></a> </td>
                </tr>
                @endforeach
               
            </tbody>
        </table>
        @include('models.add_users')
        <div>
        </div>

        @if(session()->has('success'))
        <nice-alert swal-icon="success" swal-message="{{session()->get('success')}}" ></nice-alert>
        @elseif(session()->has('error'))
            <nice-alert swal-icon="error" swal-message="{{session()->get('error')}}" ></nice-alert>
        @endif
    </div>
@endsection
