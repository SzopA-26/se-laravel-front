@extends('layouts.app')

@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            /*font-family: "Asap", sans-serif;*/
            color:#989898;
            /*margin:10px;*/
            /*font-size:16px;*/
        }
        .thumb{
            margin-bottom: 30px;
        }
        .page-top{
            margin-top:85px;
        }


        img.zoom {
            width: 100%;
            height: 200px;
            border-radius:5px;
            object-fit:cover;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
        }

        .zoom:hover {
            -ms-transform: scale(0.5); /* IE 9 */
            -webkit-transform: scale(0.5); /* Safari 3-8 */
            transform: scale(1.2);
        }

    </style>
@endsection



@section('content')
    <div class="container page-top">
        <h1 class="text-center" style="padding-bottom: 2rem">รูปภาพหอพัก</h1>


        <div class="row">


            <div id="imagemodal" class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/62307/air-bubbles-diving-underwater-blow-62307.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  id="imagepreview" src="{{asset('images/bedroom/room1.jpg')}}" class="zoom img-fluid"  alt="">

                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/38238/maldives-ile-beach-sun-38238.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"  class="fancybox" rel="ligthbox">
                    <img  id="imagepreview" src="{{asset('images/studio/room2.jpg')}}" class="zoom img-fluid"  alt="">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/158827/field-corn-air-frisch-158827.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  id="imagepreview" src="{{asset('images/studio/room1.jpg')}}" class="zoom img-fluid"  alt="">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/302804/pexels-photo-302804.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  id="imagepreview" src="{{asset('images/bedroom/room6.jpg')}}" class="zoom img-fluid"  alt="">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/1038914/pexels-photo-1038914.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  id="imagepreview" src="{{asset('images/bedroom/room5.jpg')}}" class="zoom img-fluid"  alt="">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/414645/pexels-photo-414645.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  id="imagepreview" src="{{asset('images/bedroom/room4.jpg')}}" class="zoom img-fluid"  alt="">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/56005/fiji-beach-sand-palm-trees-56005.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  id="imagepreview" src="{{asset('images/bedroom/room3.jpg')}}" class="zoom img-fluid"  alt="">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/1038002/pexels-photo-1038002.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  id="imagepreview" src="{{asset('images/bedroom/room2.jpg')}}" class="zoom img-fluid"  alt="">
                </a>
            </div>




        </div>
        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" data-dismiss="modal">
                <div class="modal-content"  >
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <img src="" class="imagepreview" style="width: 100%;" >
                    </div>
                    <div class="modal-footer">
                        <div class="col-xs-12">
                            <p class="text-left">1. line of description<br>2. line of description <br>3. line of description</p>
                        </div>
                    </div>
                </div>
            </div>


@endsection
