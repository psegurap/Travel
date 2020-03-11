<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Confraternidad De Jóvenes Fuente De Agua Viva </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no"/>

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/img/confra/favicon.ico')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('/css/tippy.css')}}">
    <link rel="stylesheet" href="{{asset('/css/summernote.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-select.css')}}">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lemonada&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.css">

    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <style>
        .coming-events{
            cursor: pointer;
        }
        .coming-events:hover{
            opacity: 0.8;
        }
        .swal-title {
            font-size: 14px;
        }
        
    </style>
</head>
{{-- <body style="background-image: url('{{asset('/img/confra/54-547807_cyberspace-lines-network-connection-network-connection.jpg')}}'); height: 100%; --}}
<body style="background-image: url('{{asset('/img/confra/SQBvfW.jpg')}}'); height: 100%;
background-position: center;
background-repeat: no-repeat;
background-size: cover;">
    <main>
        <!-- bradcam_area  -->
        <div class="bradcam_area py-0" style="box-shadow: 0px 23px 54px black;">
            <div class="container">
                <div class="row">
                    <div class="col-12 py-2 d-block d-md-none text-center">
                        <div class="logo">
                            <a href="#">
                                <img style="width:100%" src="{{asset('/img/confra/Logo_Confra2.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center d-none d-md-flex">
                    <div class="col-xl-4 col-lg-4">
                        <div class="logo">
                            <a href="#">
                                <img src="{{asset('/img/confra/Logo_Confra.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 text-center">
                        <div class="logo">
                            <a href="#">
                                <img src="{{asset('/img/confra/Logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 text-right">
                        <div class="logo">
                            <a href="#">
                                <img src="{{asset('/img/confra/Cojefav.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bradcam_area  -->
        
        <!-- ================ contact section start ================= -->
        <section class="contact-section my-1 py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-12 mb-4">
                                <div class="text-center d-block d-md-none">
                                    <h3 class="mb-0 text-white" style="text-shadow: 4px 3px #000000;font-family: 'Lemonada', cursive; font-size:2.2em">La Depresión</h3>
                                    <p class="text-white" style="text-shadow: 4px 3px #000000;font-family: 'Noto Serif JP', serif; font-size:1.2em;">¿Qué es y cómo enfrentarla?</p>
                                </div>
                                <div class="text-center d-none d-md-block">
                                    <h3 class="display-4 mb-0 text-white" style="text-shadow: 4px 3px #000000;font-family: 'Lemonada', cursive;">La Depresión</h3>
                                    <p class="text-white" style="text-shadow: 4px 3px #000000;font-family: 'Noto Serif JP', serif; font-size:2em;">¿Qué es y cómo enfrentarla?</p>
                                </div>
                            </div>
                            <div class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea style="color:white; background: #005afd26;
                                            box-shadow: 0px 0px 16px 2px black;" v-validate="'required'" class="form-control w-100" v-model="pregunta.pregunta" name="message" id="message" cols="30" rows="6" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Escribe tu pregunta'" placeholder="Escribe tu pregunta"></textarea>
                                            <span class="text-white" style="font-size: 12px;" v-show="errors.has('message')">* @{{ errors.first('message') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input style="color:white; background: #005afd26;
                                            box-shadow: 0px 0px 16px 2px black;" v-validate="'required'" class="form-control valid" :disabled="pregunta.anonimo" v-model="pregunta.nombre" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nombre'" placeholder="Nombre">
                                            <span class="text-white" style="font-size: 12px;" v-show="errors.has('name')">* @{{ errors.first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input style="color:white; background: #005afd26;
                                            box-shadow: 0px 0px 16px 2px black;" v-validate="'required'" class="form-control valid" :disabled="pregunta.anonimo" v-model="pregunta.apellido" name="last name" id="apellido" type="test" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Apellido'" placeholder="Apellido">
                                            <span class="text-white" style="font-size: 12px;" v-show="errors.has('last name')">* @{{ errors.first('last name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="switch-wrap d-flex align-items-center">
                                            <div class="confirm-checkbox">
                                                <input type="checkbox" v-model="pregunta.anonimo" id="confirm-checkbox">
                                                <label for="confirm-checkbox" style="border: 1px solid #020202"></label>
                                            </div>
                                            <p style="margin-left:5px">Marcar como anónimo</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="button" @click="validate(guardarPregunta)" class="button btn-block button-contactForm boxed-btn4">Enviar Pregunta</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex">
                            <div class="row align-content-center">
                                <div class="col-12 mb-3">
                                    <div class="text-center">
                                        <h3 class="display-4 text-white" style="font-family: 'Great Vibes', cursive;">Eventos Próximos</h3>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <img style="width:100%; box-shadow: 0px 0px 16px 2px white;" @click="showPicture('{{asset('/img/confra/Promo_3.png')}}')" class="rounded coming-events" src="{{asset('/img/confra/Promo_3.png')}}" alt="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <img style="width:100%; box-shadow: 0px 0px 16px 2px white;" @click="showPicture('{{asset('/img/confra/Promo_Intercambio_de_Ideas.png')}}')" class="rounded coming-events" src="{{asset('/img/confra/Promo_Intercambio_de_Ideas.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- ================ contact section end ================= -->
        
        <footer class="" style="box-shadow: 0px 7px 35px 14px black;">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6 text-center my-2">
                            <p class="mb-1" style="font-family: 'Lemonada', cursive; font-size: 1em; color:white;">Irainel Martínez / (849) 260-1928</p>
                            <span class="text-secondary">Presidente</span>
                        </div>
                        <div class="col-md-6 text-center my-2">
                            <p class="mb-1" style="font-family: 'Lemonada', cursive; font-size: 1em; color:white;">Rafael Molina / (849) 828-2118</p>
                            <span class="text-secondary">Secretario</span>
                        </div>
                    </div>
                </div>
        </footer>
        
        <!-- Modal -->
        <div class="modal" id="showPicture" tabindex="-1" role="dialog" aria-labelledby="showPicture" aria-hidden="true">
            <button type="button" class="close text-white mt-1" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div v-if="current_picture != null" class="modal-dialog modal-dialog-centered" role="document">
                <img style="width:100%;" class="rounded" :src="current_picture" alt="">
            </div>
        </div>
        
    </main>
    <!-- link that opens popup -->
<!--     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script> -->
    <!-- JS here -->
    <script src="{{asset('/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <script src="{{asset('/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('/js/popper.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('/js/ajax-form.js')}}"></script>
    <script src="{{asset('/js/waypoints.min.js')}}"></script>
    <script src="{{asset('/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('/js/scrollIt.js')}}"></script>
    <script src="{{asset('/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('/js/wow.min.js')}}"></script>
    <script src="{{asset('/js/nice-select.min.js')}}"></script>
    <script src="{{asset('/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('/js/plugins.js')}} "></script>
    <script src="{{asset('/js/gijgo.min.js')}}"></script>
    <script src="{{asset('/js/slick.min.js')}}"></script>
    <script src="{{asset('/js/tippy.js')}}"></script>
    <script src="{{asset('/js/summernote.min.js')}}"></script>
    <script src="{{asset('/js/vue.js')}}"></script>
    <script src="{{asset('/js/bootstrap-select.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vee-validate@<3.0.0/dist/vee-validate.js"></script>
    <script src="{{asset('/js/axios.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!--contact js-->
    {{-- <script src="{{asset('/js/contact.js')}}"></script> --}}
    <script src="{{asset('/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('/js/jquery.form.js')}}"></script>
    {{-- <script src="{{asset('/js/jquery.validate.min.js')}}"></script> --}}
    <script src="{{asset('/js/mail-script.js')}}"></script>
    <script src="{{asset('/js/main.js')}}"></script>
    <script>
        
        Vue.use(VeeValidate);
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
        });

        var homepath = "{{url('/')}}";
        // const axios = require('axios');

        var main = new Vue({
            el : 'main',
            data : {
                current_picture : null,
                pregunta: {
                    nombre : null,
                    apellido : null,
                    pregunta : null,
                    anonimo : false
                },
            },
            mounted: function(){

            },
            watch : {
                'pregunta.anonimo' : function(val){
                    if(val){
                        this.pregunta.nombre = '----';
                        this.pregunta.apellido = '----';
                    }else{
                        this.pregunta.nombre = null;
                        this.pregunta.apellido = null;
                    }
                }
            },
            methods: {
                showPicture: function(picture){
                    this.current_picture = picture; 
                    $('#showPicture').modal('show');
                },
                guardarPregunta:  function(){
                    var _this = this;
                    axios.post(homepath + '/cojefavsomostodos/create', this.pregunta).then(function(response){
                        Swal.fire({
                            icon: 'success',
                            title: 'Tu pregunta ha sido registrada. ¡Gracias!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        _this.pregunta = {
                            nombre : '',
                            apellido : '',
                            pregunta : '',
                            anonimo : false
                        }
                    }).catch(function(err){
                        $.toast({
                                heading: 'Error',
                                text: 'Ha existido un error',
                                showHideTransition: 'fade',
                                icon: 'error',
                                position : 'top-right'
                            })
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
                                text: 'Existen campos vacíos',
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
    
</body>

</html>