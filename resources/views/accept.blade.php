@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center mb-3 mt-4">Invitation Accept</h4>
                <p class="text-muted text-center mb-4 pb-2">Thanks for accept invitation, please login and enjoy use this apps.</p>
                <div class="container">  
                    <div class="row text-center">
                        <a href="{{ route('login') }}" class="btn btn-info">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
