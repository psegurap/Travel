@extends('layouts.app')
@section('title') {{__('Registered')}}@endsection
@section('content')

    <!-- ================ contact section start ================= -->
    <section class="contact-section">
            <div class="container">
                <div class="row my-5">
                    <div class="col-12 text-center">
                        <p class="display-1">{{__('Your register request has been sent. Wait for approval.')}}</p>
                    </div>
                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->

@endsection