@extends('layouts.app')
@section('title') {{__('All Trips')}}@endsection
@section('content')
    

    
    
    <div class="popular_places_area py-5">
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-6">
                    <div class="section_title text-start mb-4">
                        <h3>{{__('All Trips')}}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-for="trip in trips" class="col-lg-3 col-md-4">
                    <div class="single_place">
                        <div class="thumb">
                            <img style="width: 100%;" :src="homepath + '/tripsImages/' + trip.picture_path + '/' + trip.img_thumbnail" :alt="trip.img_thumbnail">

                            {{-- <img src="img/place/1.png" alt=""> --}}
                            {{-- <a href="#" class="prise">$500</a> --}}
                        </div>
                        <div class="place_info">
                            <a :href="homepath + '/blog/' + trip.id">
                                @if(App::getlocale() == 'es')
                                    <h3 style="font-size:16px">@{{trip.title_es}}</h3>
                                @else
                                    <h3 style="font-size:16px">@{{trip.title_en}}</h3>
                                @endif
                            </a>
                            <p>{{__('Modified')}}: @{{moment(trip.updated_at, "YYYYMMDD  hh:mm").fromNow()}}</p>
                            <div class="rating_days d-flex justify-content-between align-items-center">
                                <a :href="homepath + '/destinations/' + trip.id" target="_blank">
                                    <button class="btn btn-sm btn-outline-info" style="border-radius:100%">
                                        <i style="font-size:15spx;" class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </a>
                                <span>
                                    <span class="inline rounded px-1" :class="[trip.title_es != null && trip.content_es != null && trip.short_description_es != null ? 'bg-success text-light' : 'border text-secondary']">es</span>
                                    <span class="inline rounded px-1" :class="[trip.title_en != null && trip.content_en != null && trip.short_description_en != null ? 'bg-success text-light' : 'border text-secondary']">en</span>
                                </span>
                                <a :href="homepath + '/admin/trips/edit/' + trip.id">
                                    <button class="btn btn-sm btn-outline-warning" style="border-radius:100%">
                                        <i style="font-size:15spx;" class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="more_place_btn text-center">
                        <a class="boxed-btn4" href="#">{{__('More Places')}}</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>

    
@endsection

@section('scripts')
    <script>

        var trips = {!! json_encode($trips) !!}

        var main = new Vue({
            el: '.popular_places_area',
            data: {
                trips : trips,
            }
        });
    </script>
@endsection