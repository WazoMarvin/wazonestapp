@extends('layouts.loginlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 mt-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class=" text-primary">Wazonest App</h2>
                </div>

                <div class="card-body">
                   <form action="/save-contact" method="post">
                       @csrf
                       <div class=" form-group">
                            <label for="">Name</label>
                            <input required name="name" type="text" class="form-control">
                       </div>

                        <div class=" form-group">
                            <label for="">Date of Birth</label>
                            <input required name="dob" type="date" class="form-control">
                        </div>

                        <div class=" form-group">
                            <label for="">Phone Number</label>
                            <phone-input name="phone" input-id="phone"></phone-input>
                            {{-- <input required name="phone" type="date" class="form-control"> --}}
                        </div>

                        <div class=" form-group">
                            <label for="">Email</label>
                            <input required name="email" type="email" class="form-control">
                        </div>

                        <div class=" form-group text-center mt-5">
                            <button type="submit" class="btn btn-primary px-6">SAVE</button>
                        </div>

                        
                   </form>
                </div>
            </div>
            <div class=" text-center mt-4">
                <a class="text-lgn" href="/login"> Login</a>
            </div>
        </div>
    </div>

    @if(session()->has('success'))
        <nice-alert swal-icon="success" swal-message="{{session()->get('success')}}" ></nice-alert>
    @elseif(session()->has('error'))
        <nice-alert swal-icon="error" swal-message="{{session()->get('error')}}" ></nice-alert>
    @endif
</div>
@endsection
