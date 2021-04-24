@extends('layouts.boots')

@section('content')
    <div>
        <div class="row mb-3">
            <div class="col-md-6">
                <p class="text-lg mb-0">Customers</p>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-primary btn-sm" href="/download-pdf">Export List</a>
            </div>
        </div>
        <table class="table ">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>DOB</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>CreatedOn</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contactInfo as $record)
                <tr>
                    <td>{{$record->name}}</td>
                    <td>{{$record->dob}}</td>
                    <td>{{$record->phone}}</td>
                    <td>{{$record->email}}</td>
                    <td>{{$record->created_at}}</td>
                </tr>
                @endforeach
                
               
            </tbody>
        </table>
        <div>
            {{ $contactInfo->links() }}
        </div>
    </div>
@endsection
