@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Appointment Request</div>

                <div class="card-body">
                    @if ($code == 200)
                        <div class="alert alert-success" role="alert">
                            Your appointment request has been completed. You will be contacted shortly.
                        </div>

                    @else
                    		<div class="alert alert-danger" role="alert">
                            Your appointment request has failed. Please try again.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
