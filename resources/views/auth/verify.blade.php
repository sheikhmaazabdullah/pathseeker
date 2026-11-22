@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verify Your Email</div>

                <div class="card-body">
                    @if (session('verified'))
                        <div class="alert alert-success">
                            {{ session('verified') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <p>Check your email for the OTP sent to {{ auth()->user()->email }}.</p>
                    <form method="POST" action="{{ route('verify.otp') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="otp" class="col-md-4 col-form-label text-md-right">Enter OTP</label>
                            <div class="col-md-6">
                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="off" autofocus>
                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Verify
                                </button>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('verification.resend') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-link">Resend OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection