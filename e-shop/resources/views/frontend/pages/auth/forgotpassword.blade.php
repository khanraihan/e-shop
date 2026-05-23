@extends('frontend.layouts.master')

@section('title', 'Home')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('public/front/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/front/styles/responsive.css') }}">
<style>
</style>
@endsection
@section('content')


<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="col-md-6">
			@if(session()->get('token'))
				<form action="{{ route('changepass') }}" method="post">
					@csrf
					<div class="card mt-5 mb-5">
						<div class="card-header">Create New Password</div>
						<div class="card-body">
							<div class="row d-flex justify-content-center">
								@if ($errors->any())
								    <div class="alert alert-danger">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li>{{ $error }}</li>
								            @endforeach
								        </ul>
								    </div>
								@endif
								<div class="col-md-10">
									<div class="form-group">
										<label for="new">New Password</label>
										<input type="text" placeholder="Enter New Password" class="form-control" name="password" required>
									</div>
									<div class="form-group">
										<label for="new">Confirm Password</label>
										<input type="text" placeholder="Confirm Password" class="form-control" name="confirm_password" required>
									</div>
									<div class="form-group">
										<input type="hidden" name="username" value="{{ old('username') }}">
										<input type="submit" value="Change" class="btn btn-success float-right">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			@else
				<form action="{{ route('user_check') }}" method="post">
					@csrf
					<div class="card mt-5 mb-5">
					<div class="card-header">Forgot Password</div>
					@if ( Session::has('login_error') )
                        <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {!! Session::get('login_error') !!}
                        </div>
                        @endif
						<div class="card-body">
							@if(session()->get('wrog_code'))
							<div class="w-100 alert-warning p-2 mb-2 text-center" style="margin-top: -13px;">
								<span>{{ session()->get('wrog_code') }}</span>
							</div>
							@endif
							<div class="row d-flex justify-content-center">
								<div class="col-md-10">
									<div class="form-group d-flex">
										<input type="text" name="username" placeholder="Enter Username" class="form-control" required>
										<input type="submit" value="Submit" class="btn btn-success float-right">
									</div>
									<!--<a href="{{ route('user_register') }}" class="float-right">Again send verification code</a>-->
								</div>
							</div>
						</div>
					</div>
				</form>
			@endif
		</div>
	</div>
</div>


@endsection

@section('scripts')

@endsection