@extends('layouts.admin')
@section('title') {{__('Quick Feedbacks')}}@endsection
@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
   <style>
       
   </style>
@endsection

@section('content')
   <div class="travel_variation_area py-2">
        <div class="container">

            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="display-4 mb-0">{{__('Quick Feedbacks')}}</h2>
                </div>
                {{-- <div class="col-md-3 text-right">
                    <button class="boxed-btn4 px-3 py-2">
                        <a href="subscribers/broadcast_message" class="text-light">{{__('Send Broadcast')}}</a></button>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-md-12 border-top rounded p-3">
                    <table style="font-family: 'Lora', serif;" id="table" class="table table-bordered table-hover table-sm text-center table-md-responsive" style="width:100%">
                        <thead class="table-header bg-danger text-white">
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Visitor Name')}}</th>
                                <th>{{__('Language')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Updated At')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="FeedbackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Update Feedback')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <section class="form-contact comment_form mb-3 row">
                        <aside class="col-md-9">
                            <label for="">{{__('Visitor Name')}}:</label>
                            <input type="text" disabled v-model="visitor_name" class="form-control">
                        </aside>
                        <aside class="col-md-3">
                            <label for="">{{__('Status')}}:</label>
                            <div class="switch-wrap d-flex justify-content-between">
								<div class="primary-switch">
									<input type="checkbox" :checked="activo == 1" id="default-switch">
									<label for="default-switch"></label>
								</div>
							</div>
                        </aside>
                    </section>
                    <section class="form-contact comment_form row">
                        <div class="col-12">
                            <div class="">
                                <textarea disabled v-model="visitor_feedback" class="form-control w-100" cols="30" rows="6"></textarea>
                            </div>
                        </div>
                    </section>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Close')}}</button>
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
    var feedbacks = {!! json_encode($feedbacks); !!}

    var main = new Vue({
        el : '.travel_variation_area',
        data : {
            dt : null,
            feedbacks : feedbacks,
            visitor_name : null,
            visitor_feedback : null,
            current_feedback : null,
            activo: null,
        },
        mounted: function(){
            var _this = this;
            this.initDataTable();
            $('#default-switch').on('change', function(){
                var _this_ = _this;
                axios.post( homepath + '/admin/maintenance/layouts/update/' + _this.current_feedback).then(function(response){
                    _this.feedbacks = response.data;
                    _this.closeModal('FeedbackModal');
                    $.toast({
                        heading: 'Success',
                        text: '{{__("The feedback was updated")}}',
                        showHideTransition: 'fade',
                        icon: 'success',
                        position : 'top-right'
                    })
                }).catch(function(error){
                    $.toast({
                        heading: 'Error',
                        text: '{{__("There was an error updating the feedback")}}',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position : 'top-right'
                    })
                });
            })
        },
        watch: {
            feedbacks : function(val){
                this.dt.clear()
                this.dt.rows.add(val);
                this.dt.draw();
            },
            'CurrentFeedback': function(val){
                let feedback = val[0];
                if(feedback){
                    this.visitor_name = feedback.visitor_name;
                    this.visitor_feedback = feedback.visitor_feedback;
                    if(feedback.status == 0){
                        this.activo = 0
                    }else{
                        this.activo = 1
                    }
                }
            }
        },
        computed: {
            CurrentFeedback: function(){
                var _this = this;
                return this.feedbacks.filter(function(feedback){
                   return feedback.id == _this.current_feedback;
                }) 
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
            editSubscriber: function(id){
                this.current_feedback = id;
                this.openModal('FeedbackModal');
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
                    data : this.feedbacks,
                    columns: [
                        {data : 'id'},
                        {data : 'visitor_name'},
                        {data : 'language'},
                        {data : 'created_at'},
                        {data : 'updated_at'},
                        {
                            data : 'status',
                            render: function(data){
                                if(data == 1){
                                    return "<div class='d-flex justify-content-around'><div class='text-success' style='font-size: 1.5em;'><i class='fa fa-square' aria-hidden='true'></i></div>"
                                }else{
                                    return "<div class='d-flex justify-content-around'><div class='text-secondary' style='font-size: 1.5em;'><i class='fa fa-square' aria-hidden='true'></i></div>"
                                }
                            }
                        },
                        {
                            data : 'id',
                            render: function(data, row){
                                return "<div class='d-flex justify-content-around'><div class='text-info' style='font-size: 1.5em;'><i onclick='main.editSubscriber("+data+")' style='cursor:pointer' class='fa fa-pencil-square-o' aria-hidden='true'></i></div>"
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