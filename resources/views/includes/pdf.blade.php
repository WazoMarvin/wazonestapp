@extends('layouts.pdf')
@push("css-script")
    <link href="{{ public_path('css/pdf/statement.css') }}" rel="stylesheet">
    @endpush
@section('content')



<div class="text-center mb-4">
    <h4>{{$heading}}</h4>
</div>

<table class="table table-sm table-bordered ">
    <thead>
        <tr>
            <th>Name</th>
            <th class="text-center">DOB</th>
            <th class="text-center">Phone</th>
            <th class="text-center">Email</th>
            <th class="text-center">Created On</th>
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


@stop
