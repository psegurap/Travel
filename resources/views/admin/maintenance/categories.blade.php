@extends('layouts.admin')
@section('title') {{__('Categories')}}@endsection
@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
   <style>
       
   </style>
@endsection

@section('content')
   <div class="travel_variation_area py-2">
        <div class="container">

            <div class="row mb-3">
                <div class="col-12 text-right">
                    <button @click="addCategory()" class="boxed-btn4 px-3 py-2">{{__('Create Category')}}</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 border-top rounded p-3">
                    <table style="font-family: 'Lora', serif;" id="table" class="table table-bordered table-hover table-sm text-center table-md-responsive" style="width:100%">
                        <thead class="table-header bg-danger text-white">
                            <tr>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Category ES')}}</th>
                                <th>{{__('Category EN')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 v-if="view == 'create'" class="modal-title">{{__('Create Category')}}</h5>
                    <h5 v-if="view == 'edit'" class="modal-title">{{__('Update Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <section class="form-contact comment_form row">
                        <aside class="col-md-6">
                            <label for="">{{__('Category Name (ES)')}}:</label>
                            <input type="text" v-validate="'required'" v-model="category.category_name_es" name="category es" class="form-control" placeholder="{{__('Type the name')}}...">
                            <span class="text-danger" style="font-size: 12px;" v-show="errors.has('category es')">* @{{ errors.first('category es') }}</span>
                        </aside>
                        <aside class="col-md-6">
                            <label for="">{{__('Category Name (EN)')}}:</label>
                            <input type="text" v-validate="'required'" v-model="category.category_name_en" name="category en" class="form-control" placeholder="{{__('Type the name')}}...">
                            <span class="text-danger" style="font-size: 12px;" v-show="errors.has('category en')">* @{{ errors.first('category en') }}</span>
                        </aside>
                    </section>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Close')}}</button>
                    <button v-if="view == 'create'" type="button" @click="validate(saveCategory)" class="btn btn-success">{{__('Save Category')}}</button>
                    <button v-if="view == 'edit'" type="button" @click="validate(updateCategory)" class="btn btn-info">{{__('Update Category')}}</button>
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
    var categories = {!! json_encode($categories); !!}

    var main = new Vue({
        el : '.travel_variation_area',
        data : {
            dt : null,
            categories : categories,
            category : {
                category_name_es : null,
                category_name_en : null,
            },
            view : 'create',
            current_category : null,
        },
        mounted: function(){
            this.initDataTable();
        },
        watch: {
            categories : function(val){
                this.dt.clear()
                this.dt.rows.add(val);
                this.dt.draw();
            },
            'CurrentCategory': function(val){
                let category = val[0];
                if(category){
                    this.category.category_name_es = category.category_name_es;
                    this.category.category_name_en = category.category_name_en;
                }
            }
        },
        computed: {
            CurrentCategory: function(){
                var _this = this;
                return this.categories.filter(function(category){
                   return category.id == _this.current_category;
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
            addCategory:function(){
                this.view = 'create';
                this.category.category_name_es = '';
                this.category.category_name_en = '';
                this.openModal('CategoryModal');
            },
            saveCategory: function(){
                var _this = this;
                axios.post( homepath + '/admin/maintenance/categories/store', this.category).then(function(response){
                    _this.categories = response.data;
                    _this.closeModal('CategoryModal');
                    $.toast({
                        heading: 'Success',
                        text: '{{__("The category was created")}}',
                        showHideTransition: 'fade',
                        icon: 'success',
                        position : 'top-right'
                    })
                    _this.category.category_name_es = '';
                    _this.category.category_name_en = '';
                }).catch(function(error){
                    $.toast({
                        heading: 'Error',
                        text: '{{__("There was an error saving the category")}}',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position : 'top-right'
                    })
                });
            },
            editCategory: function(id){
                this.current_category = id;
                this.view = 'edit';
                this.openModal('CategoryModal');
            },
            updateCategory: function(){
                var _this = this;
                axios.post( homepath + '/admin/maintenance/categories/update/' + this.current_category, this.category).then(function(response){
                    _this.categories = response.data;
                    _this.closeModal('CategoryModal');
                    $.toast({
                        heading: 'Success',
                        text: '{{__("The category was updated")}}',
                        showHideTransition: 'fade',
                        icon: 'success',
                        position : 'top-right'
                    })
                }).catch(function(error){
                    $.toast({
                        heading: 'Error',
                        text: '{{__("There was an error updating the category")}}',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position : 'top-right'
                    })
                });
            },
            deleteCategory: function(id){
                var _this = this;
                Swal.fire({
                    title: "{{__('Are you sure?')}}",
                    text: "{{__('You won\'t be able to revert this!')}}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{__('Yes, delete it!')}}",
                    cancelButtonText: "{{__('Cancel')}}",
                    }).then(function(result) {
                        var _this_ = _this;
                        if (result.value) {
                            axios.post( homepath + '/admin/maintenance/categories/delete/' + id).then(function(response){
                                _this.current_category = null;
                                _this_.categories = response.data;
                                $.toast({
                                    heading: 'Success',
                                    text: '{{__("The category was deleted")}}',
                                    showHideTransition: 'fade',
                                    icon: 'success',
                                    position : 'top-right'
                                })
                            }).catch(function(error){
                                $.toast({
                                    heading: 'Error',
                                    text: '{{__("There was an error deleting the category")}}',
                                    showHideTransition: 'fade',
                                    icon: 'error',
                                    position : 'top-right'
                                })
                            });
                        }
                        // )
                    })  
            },
            initDataTable: function(){
                this.dt = $('#table').DataTable({
                    data : this.categories,
                    columns: [
                        {data : 'id'},
                        {data : 'category_name_es'},
                        {data : 'category_name_en'},
                        {data : 'created_at'},
                        {
                            data : 'id',
                            render: function(data, row){
                                return "<div class='d-flex justify-content-around'><div class='text-info' style='font-size: 1.5em;'><i onclick='main.editCategory("+data+")' style='cursor:pointer' class='fa fa-pencil-square-o' aria-hidden='true'></i></div><div class='text-danger' style='font-size: 1.5em';><i onclick='main.deleteCategory("+data+")' style='cursor:pointer' class='fa fa-trash' aria-hidden='true'></i></div></div>"
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