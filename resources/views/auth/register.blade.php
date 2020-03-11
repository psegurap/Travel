@extends('layouts.app')
@section('title') {{__('Register')}}@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="">
                <div class="card-header"><h2 class="mb-1 contact-title">{{ __('Register') }}</h2></div>
                <div class="row justify-content-center">
                    <div class="col-md-12 mt-4">
                        <form class="form-contact contact_form" method="POST" action="{{ route('register') }}">
                            @csrf
    
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('Enter your name')}}'" placeholder="{{__('Enter your name')}}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('Enter your email')}}'" placeholder="{{__('Enter your email')}}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
    
                            
    
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('Enter your password')}}'" placeholder="{{__('Enter your password')}}" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{__('Confirm your password')}}'" placeholder="{{__('Confirm your password')}}" required autocomplete="new-password">
                                </div>
                            </div>
    
                            
    
                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="button button-contactForm boxed-btn">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
