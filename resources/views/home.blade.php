@extends('layouts.app')

@section('style')
{{--    <style>--}}
{{--        img {--}}
{{--            object-fit: cover;--}}
{{--            object-position: 0 100%;--}}
{{--        }--}}
{{--    </style>--}}
@endsection

@section('content')
<div class="">

{{--    carousel--}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="https://www.homezoomer.com/wp-content/uploads/2019/01/Polis-Condo-Suksawat-64_8_resize.jpg"
                     class="d-block w-100" alt="1" height="500">
            </div>
            <div class="carousel-item active">
                <img src="{{asset('/images/home1.jpg')}}"
                     class="d-block w-100" alt="1" height="500">
            </div>
            <div class="carousel-item">
                <img src="https://www.terrabkk.com/images/project/0000036066/06c4475eb9228a9513a11a64a3493ea8.jpg"
                     class="d-block w-100" alt="1" height="500">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container">
        <section class="container-fluid sec2  text-dark">
            <div class="row">
                <div class="container-fluid col-6">
                    <h3 class="text-center display-4   head">STUDIO ROOM</h3>
                    <p>Littering a dark and dreary road lay the past relics of browser-specific tags, incompatible DOMs, broken CSS support, and abandoned browsers. We must clear the mind of the past.</p>
                    <p>Web enlightenment has been achieved thanks to the tireless efforts of folk like the W3C,WaSP, and the major browser creators.</p>
                    <p>The CSS Zen Garden invites you to relax and meditate on the important lessons of the masters. Begin to see with clarity. Learn to use the time-honored techniques in new and invigorating fashion. Become one with the web.</p>

                </div>
                <div class=" container col-6">
                    <img src="{{asset('images/studio/room1.jpg')}}" width="500">

                </div>
            </div>

        </section>
    </div>

    <div class="container">
        <section class="container-fluid sec2 bg-white text-dark">
            <div class="row">
                <div class=" container col-6">
                    <img src="{{asset('images/bedroom/room1.jpg')}}" width="500">
                </div>
                <div class="container-fluid col-6">
                    <h3 class="text-center display-4 head ">1 Bedroom</h3>
                    <p>There is a continuing need to show the power of CSS. The Zen Garden aims to excite, inspire, and encourage participation. To begin, view some of the existing designs in the list. Clicking on any one will load the style sheet into this very page. The HTML remains the same, the only thing that has changed is the external CSS file. Yes, really.</p>
                    <p>CSS allows complete and total control over the style of a hypertext document. The only way this can be illustrated in a way that gets people excited is by demonstrating what it can truly be, once the reins are placed in the hands of those able to create beauty from structure. Designers and coders alike have contributed to the beauty of the web; we can always push it further.</p>


                </div>
            </div>

        </section>

    </div>


    <section class="page-section  text-dark ">
        <div class="container">
            <h3 class="page-section-heading text-center text-uppercase">แนวคิด</h3>
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon">
                    <i class="fas fa-lightbulb" style="color: #FFD700"></i>
                </div>
                <div class="divider-custom-line"></div>
            </div>
            <div>
                <p>Why participate? For recognition, inspiration, and a resource we can all refer to showing people how amazing CSS really can be. This site serves as equal parts inspiration for those working on the web today, learning tool for those who will be tomorrow, and gallery of future techniques we can all look forward to.</p>
            </div>
        </div>
    </section>

    <!-- Paragraph 5 -->
    <section class="page-section text-white bg-dark">
        <div class="container">
            <h3 class="page-section-heading text-center text-uppercase">ส่วนกลาง</h3>
            <!-- star icon -->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon">
                    <i class="far fa-heart" style="color: red"></i>
                </div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="">
                <section class="container-fluid sec2  text-white">
                    <div class="row">
                        <div class="container-fluid col-6">
                            <h3 class="text-center display-4   head">Fitness</h3>
                            <p>Littering a dark and dreary road lay the past relics of browser-specific tags, incompatible DOMs, broken CSS support, and abandoned browsers. We must clear the mind of the past.</p>
                            <p>Web enlightenment has been achieved thanks to the tireless efforts of folk like the W3C,WaSP, and the major browser creators.</p>
                            <p>The CSS Zen Garden invites you to relax and meditate on the important lessons of the masters. Begin to see with clarity. Learn to use the time-honored techniques in new and invigorating fashion. Become one with the web.</p>

                        </div>
                        <div class=" container col-6">
                            <img src="{{asset('images/fitness.jpg')}}" width="500">

                        </div>
                    </div>

                </section>
            </div>
        </div>
    </section>


</div>
@endsection
