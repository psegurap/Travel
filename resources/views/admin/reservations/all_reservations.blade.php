@extends('layouts.admin')
@section('title') {{__('Reservations')}}@endsection
@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
   <style>
       .modal-body {
            overflow-y: auto;
            max-height: calc(100vh - 200px);
        }
   </style>
@endsection

@section('content')
   <div class="travel_variation_area py-2">
        <div class="container">

            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="display-4 mb-0">{{__('Reservations')}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 border-top rounded p-3">
                    <table style="font-family: 'Lora', serif;" id="table" class="table table-bordered table-hover table-sm text-center table-md-responsive" style="width:100%">
                        <thead class="table-header bg-danger text-white">
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Customer Name')}}</th>
                                <th>{{__('Booking Date')}}</th>
                                <th>{{__('Trip Name')}}</th>
                                <th>{{__('Trip Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="DetailsModal" tabindex="-1" role="dialog" aria-labelledby="DetailsModal" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div  class="modal-content" style="border-radius:0px">
                    <div class="modal-header row mx-0 align-items-center">
                        <div class="col-md-6">
                            <h4 class="font-weight-bold mb-0" style="">{{__('Update Status')}}:</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <select v-model="reservation_status" name="category" class="selectpicker">
                                <option value="1">{{__('Pending')}}</option>
                                <option value="2">{{__('Payment made')}}</option>
                                <option value="3">{{__('Complete')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-body" v-if="CurrentReservation.length > 0">
                        <div class="row">
                            <div class="col-12">
                                <span class="font-weight-light h5" style="color:#FF4A52">{{__('Customer Information')}}:</span>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 my-1">
                                        <span class="border d-block px-2 py-1 rounded"><strong>{{__('Full Name')}}:</strong> <br/>@{{CurrentReservation[0].customer.customer_name}}</span>
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <span class="border d-block px-2 py-1 rounded"><strong>{{__('Email')}}:</strong> <br/>@{{CurrentReservation[0].customer.customer_email}}</span>
                                    </div>
                                    <div class="col-md-12 my-1">
                                        <span  class="border d-block px-2 py-1 rounded"><strong>{{__('Address')}}:</strong> <br/>@{{CurrentReservation[0].customer.customer_adddress}}</span>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <span class="border d-block px-2 py-1 rounded"><strong>{{__('City')}}:</strong> <br/>@{{CurrentReservation[0].customer.customer_city}}</span>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <span class="border d-block px-2 py-1 rounded"><strong>{{__('Zip Code')}}:</strong> <br/>@{{CurrentReservation[0].customer.customer_zipCode}}</span>
                                    </div>
                                    <div class="col-md-4 my-1">
                                        <span class="border d-block px-2 py-1 rounded"><strong>{{__('Country')}}:</strong> <br/>
                                            @if(App::getlocale() == 'es')
                                                @{{CurrentReservation[0].customer.country.country_es}}
                                            @else
                                                @{{CurrentReservation[0].customer.country.country_en}}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <span class="border d-block px-2 py-1 rounded"><strong>{{__('Cell Phone')}}:</strong> <br/>@{{CurrentReservation[0].customer.customer_cellphone}}</span>
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <span class="border d-block px-2 py-1 rounded"><strong>{{__('Home Phone')}}:</strong> <br/>
                                            <span>@{{CurrentReservation[0].customer.customer_homephone}}</span>
                                            {{-- <span v-else>---</span> --}}
                                        </span>
                                    </div>
                                    <div class="col-md-12 my-1">
                                        <span class="border d-block px-2 py-1 rounded text-justify"><strong>{{__('Additional Notes')}}:</strong> <br/>
                                            <span>@{{CurrentReservation[0].customer.customer_notes}}</span>
                                            {{-- <span v-else>---</span> --}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="bg-danger">
                        <div class="row">
                            <div class="col-12">
                                <span class="font-weight-light h5" style="color:#FF4A52">{{__('Trip Information')}}:</span>
                            </div>
                            <div class="col-md-12 my-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <aside class="border p-1 post_category_widget rounded single_sidebar_widget">
                                            <div class="row align-items-center">
                                                <div class="col-12 col-md-4 col-lg-3">
                                                    <img style="width:100%" :src="homepath + '/tripsImages/' + CurrentReservation[0].trip.picture_path + '/' + CurrentReservation[0].trip.img_thumbnail" alt="">
                                                </div>
                                                <div class="col-12 col-md-8 col-lg-9">
                                                    <div class="info">
                                                        <p style="color:#ff4a52!important" class="text-left mt-1">
                                                            @if(App::getlocale() == 'es')
                                                                @{{CurrentReservation[0].trip.title_es}}
                                                            @else
                                                                @{{CurrentReservation[0].trip.title_en}}
                                                            @endif
                                                        </p>
                                                        <p class="small text-justify" style="line-height: 20px;">
                                                            @if(App::getlocale() == 'es')
                                                                @{{CurrentReservation[0].trip.short_description_es}}
                                                            @else
                                                                @{{CurrentReservation[0].trip.short_description_en}}
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </aside>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 my-1">
                                <table class="table table-bordered table-hover table-sm text-center table-md-responsive" style="width:100%">
                                    <thead class="table-header bg-danger text-white">
                                        <tr>
                                            <th></th>
                                            <th>{{__('Quantity')}}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold">{{__('Adults')}}</td>
                                            <td>@{{CurrentReservation[0].adults_amount}}</td>
                                            <td>US$ @{{CurrentReservation[0].adults_total}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">{{__('Kids')}}</td>
                                            <td>@{{CurrentReservation[0].kids_amount}}</td>
                                            <td>US$ @{{CurrentReservation[0].kids_total}}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Total</td>
                                            <td></td>
                                            <td class="font-weight-bold">US$ @{{CurrentReservation[0].total_amount}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn d-none d-sm-block btn-confirm-booking btn-danger px-4">{{__('Update Status')}}</button>
                        <button type="button" class="btn d-block d-sm-none btn-confirm-booking btn-danger px-4">{{__('Update')}}</button>
                        <button type="button" class="btn btn-default px-4" data-dismiss="modal">{{__('Close')}}</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


<script>
    Vue.use(VeeValidate);
    var reservations = {!! json_encode($reservations); !!}

    var main = new Vue({
        el : '.travel_variation_area',
        data : {
            dt : null,
            reservations : reservations,
            visitor_name : null,
            visitor_feedback : null,
            current_reservation : null,
            reservation_status: 1,
        },
        mounted: function(){
            var _this = this;
            this.initDataTable();
            // $('#default-switch').on('change', function(){
            //     var _this_ = _this;
            //     axios.post( homepath + '/admin/maintenance/layouts/update/' + _this.current_feedback).then(function(response){
            //         _this.feedbacks = response.data;
            //         _this.closeModal('FeedbackModal');
            //         $.toast({
            //             heading: 'Success',
            //             text: '{{__("The feedback was updated")}}',
            //             showHideTransition: 'fade',
            //             icon: 'success',
            //             position : 'top-right'
            //         })
            //     }).catch(function(error){
            //         $.toast({
            //             heading: 'Error',
            //             text: '{{__("There was an error updating the feedback")}}',
            //             showHideTransition: 'fade',
            //             icon: 'error',
            //             position : 'top-right'
            //         })
            //     });
            // })
        },
        watch: {
            reservations : function(val){
                this.dt.clear()
                this.dt.rows.add(val);
                this.dt.draw();
            },
            reservation_status: function(val){
                console.log(this.reservation_status)
                $('.selectpicker').selectpicker('refresh');
                console.log(this.reservation_status)
            },
            'CurrentReservation': function(val){
                let reservation = val[0];
                if(reservation){
                    this.reservation_status = reservation.reservation_status;
                }
            }
        },
        computed: {
            CurrentReservation: function(){
                var _this = this;
                return this.reservations.filter(function(reservation){
                   return reservation.id == _this.current_reservation;
                }); 
            }
        },
        methods : {
            openModal: function(modal){
                $('#'+modal).modal('show');
            },
            closeModal: function(modal){
                $('#'+modal).modal('hide');
            },
            // addCategory:function(){
            //     this.view = 'create';
            //     this.category.category_name_es = '';
            //     this.category.category_name_en = '';
            //     this.openModal('FeedbackModal');
            // },
            // saveCategory: function(){
            //     var _this = this;
            //     axios.post( homepath + '/admin/maintenance/categories/store', this.category).then(function(response){
            //         _this.categories = response.data;
            //         _this.closeModal('FeedbackModal');
            //         $.toast({
            //             heading: 'Success',
            //             text: '{{__("The category was created")}}',
            //             showHideTransition: 'fade',
            //             icon: 'success',
            //             position : 'top-right'
            //         })
            //         _this.category.category_name_es = '';
            //         _this.category.category_name_en = '';
            //     }).catch(function(error){
            //         $.toast({
            //             heading: 'Error',
            //             text: '{{__("There was an error saving the category")}}',
            //             showHideTransition: 'fade',
            //             icon: 'error',
            //             position : 'top-right'
            //         })
            //     });
            // },
            editReservation: function(id){
                this.current_reservation = id;
                this.openModal('DetailsModal');
            },
            // updateCategory: function(){
            //     var _this = this;
            //     axios.post( homepath + '/admin/maintenance/categories/update/' + this.current_category, this.category).then(function(response){
            //         _this.categories = response.data;
            //         _this.closeModal('FeedbackModal');
            //         $.toast({
            //             heading: 'Success',
            //             text: '{{__("The category was updated")}}',
            //             showHideTransition: 'fade',
            //             icon: 'success',
            //             position : 'top-right'
            //         })
            //     }).catch(function(error){
            //         $.toast({
            //             heading: 'Error',
            //             text: '{{__("There was an error updating the category")}}',
            //             showHideTransition: 'fade',
            //             icon: 'error',
            //             position : 'top-right'
            //         })
            //     });
            // },
            // deleteCategory: function(id){
            //     var _this = this;
            //     Swal.fire({
            //         title: "{{__('Are you sure?')}}",
            //         text: "{{__('You won\'t be able to revert this!')}}",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: "{{__('Yes, delete it!')}}",
            //         cancelButtonText: "{{__('Cancel')}}",
            //         }).then(function(result) {
            //             var _this_ = _this;
            //             if (result.value) {
            //                 axios.post( homepath + '/admin/maintenance/categories/delete/' + id).then(function(response){
            //                     _this.current_category = null;
            //                     _this_.categories = response.data;
            //                     $.toast({
            //                         heading: 'Success',
            //                         text: '{{__("The category was deleted")}}',
            //                         showHideTransition: 'fade',
            //                         icon: 'success',
            //                         position : 'top-right'
            //                     })
            //                 }).catch(function(error){
            //                     $.toast({
            //                         heading: 'Error',
            //                         text: '{{__("There was an error deleting the category")}}',
            //                         showHideTransition: 'fade',
            //                         icon: 'error',
            //                         position : 'top-right'
            //                     })
            //                 });
            //             }
            //             // )
            //         })  
            // },
            initDataTable: function(){
                this.dt = $('#table').DataTable({
                    data : this.reservations,
                    columns: [
                        {data : 'id'},
                        {data : 'customer.customer_name'},
                        {data : 'created_at'},
                        {
                            render: function(data, type, row){
                                if(lang == 'es'){
                                    return row.trip.title_es;
                                }else{
                                    return row.trip.title_en;
                                }
                            }
                        },
                        {data : 'trip.available_date'},
                        {
                            data : 'reservation_status',
                            render: function(data){
                                if(data == 1){
                                    return "<div class='d-flex justify-content-around'><div class='text-danger' style='font-size: 1.5em;'><i class='fa fa-square' aria-hidden='true'></i></div>"
                                }
                                if(data == 2){
                                    return "<div class='d-flex justify-content-around'><div class='text-warning' style='font-size: 1.5em;'><i class='fa fa-square' aria-hidden='true'></i></div>"
                                }
                                if(data == 3){
                                    return "<div class='d-flex justify-content-around'><div class='text-success' style='font-size: 1.5em;'><i class='fa fa-square' aria-hidden='true'></i></div>"
                                }
                            }
                        },
                        {
                            data : 'id',
                            render: function(data, row){
                                return "<div class='d-flex justify-content-around'><div class='text-info' style='font-size: 1.5em;'><i onclick='main.editReservation("+data+")' style='cursor:pointer' class='fa fa-pencil-square-o' aria-hidden='true'></i></div>"
                            }
                        }
                        
                    ]
                });
            },
            validate: function(callback){
                    var _this = this;
                    this.$validator.validateAll().then(function(result){
                        if(result){
                            callback();
                        }else{
                            $.toast({
                                heading: 'Error',
                                text: '{{__("You need to fix the errors")}}',
                                showHideTransition: 'fade',
                                icon: 'error',
                                position : 'top-right'
                            })
                        }
                    })
                }
        }
    });
</script>

@endsection