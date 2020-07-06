@extends('website.website-master')

@section('web-content')
    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" style="background-image: url('{{ asset('web/img/slider1.jpg') }}')">
                    <div class="carousel-caption d-none d-md-block">
                        <h3 class="display-4">Curtailing Agricultural Wastage</h3>
                        <p class="lead">By Innovative Supply Chain Technologies and Value Addition.</p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('{{ asset('web/img/slider2.jpg') }}')">
                    <div class="carousel-caption d-none d-md-block">
                        <h3 class="display-4">Second Slide</h3>
                        <p class="lead">This is a description for the second slide.</p>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" style="background-image: url('{{ asset('web/img/slider3.jpg') }}')">
                    <div class="carousel-caption d-none d-md-block">
                        <h3 class="display-4">Third Slide</h3>
                        <p class="lead">This is a description for the third slide.</p>
                    </div>
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
    </header>
    <!-- Page Content -->
    <main class="pt-5">
        <!-- What we do-->
        <section class="pt-5 pb-5" id="our-skills">
            <div class="container">
                <h3 class="display-4">Get The Best Of Us</h3>
                <p class="lead">Agro Sourcing Limited is working to curtail Agricultural wastage in Sub- Saharan Africa</p>
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                        <div class="shadow">
                            <div class="card-body text-center">
                                <img src="{{ asset('web/img/location.svg') }}" alt="agric" height="100px" width="70px"/>
                                <h4 class="card-title text-uppercase font-weight-bold">ACCESS MAPS</h4>
                                <p class="card-text lead">Are you a researcher, policy maker, bulk buyer or agricultural Processing company?
                                    Access maps showing the precise quantities of agricultural produce/residue in specified geographic zones.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                        <div class="shadow">
                            <div class="card-body text-center">
                                <img src="{{ asset('web/img/order.svg') }}" alt="agric" height="100px" width="70px"/>
                                <h4 class="card-title text-uppercase font-weight-bold">MAKE AN ORDER</h4>
                                <p class="card-text lead">Make an instant order for specified agricultural produce/residue for convenient, timely delivery.Or schedule an order for future delivery (terms and conditions apply)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                        <div class="shadow">
                            <div class="card-body text-center">
                                <img src="{{ asset('web/img/tractor.svg') }}" alt="agric" height="100px" width="70px"/>
                                <h4 class="card-title text-uppercase font-weight-bold">ADD A FARM </h4>
                                <p class="card-text lead">Get your farm found by bulk buyers, Processing companies, and other stakeholders with ease and convenience.It's time to get digitally included. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                        <div class="shadow">
                            <div class="card-body text-center">
                                <img src="{{ asset('web/img/delivery.svg') }}" alt="agric" height="100px" width="70px"/>
                                <h4 class="card-title text-uppercase font-weight-bold">ADD A WAREHOUSE </h4>
                                <p class="card-text lead">
                                    Do you have an existing Warehouse for agricultural storage?
                                    Or do you own a space that can be converted into an agricultural storage space?
                                    Get it listed here and play your in ensuring future food security</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us-->
        <section class="pt-5 pb-5 mt-5 mb-5" id="about-us">
            <div class="container">
                <h3 class="display-4">About Agrosourcing Ltd</h3>
                <p class="lead pb-3">Our greatness has always supported our push.</p>
                <div class="row mt-4">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            <div class="item"><img src="{{ asset('web/img/vegetables.jpg') }}" class="img-fluid" alt="veg"></div>
                            <div class="item"><img src="{{ asset('web/img/vegetables.jpg') }}" class="img-fluid" alt="veg"></div>
                            <div class="item"><img src="{{ asset('web/img/vegetables.jpg') }}" class="img-fluid" alt="veg"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p class="font-weight-light about-text">
                            Agro Sourcing Limited is a Ghanaian based Agricultural enterprise that is leveraging on technology to
                            curtail agricultural wastage in Africa and subsequently work with other agricultural companies to offer
                            sustainable, cost effective and environmentally friendly alternatives to traditional waste disposal
                            methods.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories -->
        <section class="py-5 mt-5" id="what-we-do" style="background-color: #f1f1f1">
            <div class="container">
                <h2 class="font-weight-light">What We Offer</h2>
                <p class="mb-5 lead">The categories we provide</p>

                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="shadow-sm mb-5 bg-white p-4">
                            <h4 class="card-title text-uppercase font-weight-normal p-2">CONNECTIVITY</h4>
                            <p class="card-text lead">
                                Our Logistics management system connects Processing Companies and Produce Exporters to consistent, timely and cost-efficient supply of their needed agricultural produce or residue
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="shadow-sm mb-5 bg-white p-4">
                            <h4 class="card-title text-uppercase font-weight-normal p-2">GREENCOAL</h4>
                            <p class="card-text lead">
                                Our brand of eco-friendly briquette Charcoal is made from Coconut Husk and Rice Husk. GreenCoal is made to burn for long and produce very little smoke.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="shadow-sm mb-5 bg-white p-4">
                            <h4 class="card-title text-uppercase font-weight-normal p-2">POTASSIUM CARBONATE SALT</h4>
                            <p class="card-text lead">
                                We use Cocoa Pods to produce Potassium Carbonate Salt for delivery to local cosmetics companies who use it to Produce the African Black Soap
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 mt-5" id="partners">
            <div class="container">
                <h2 class="font-weight-light">Our Partners</h2>
                <p class="mb-5 lead">The trust partners we have got</p>
                <section class="customer-logos slider">
                    <div class="slide">
                        <img src="{{ asset('web/img/partner1.jpg') }}">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('web/img/partner2.jpg') }}">
                    </div>
                    <div class="slide">
                        <img src="{{ asset('web/img/partner3.jpg') }}">
                    </div>
                </section>
            </div>
        </section>

        <section class="py-5 mt-5" id="our-team" style="background-color: #f1f1f1">
            <div class="container">
                <h2 class="font-weight-light" >Our Team</h2>
                <p class="mb-5 lead">Below are the capable hands behind Agro Sourcing Limited</p>
                <div class="row mt-4">
                    <div class="col-xl-4 col-md-4 col-lg-4 mb-4">
                        <div class="card border-0 shadow">
                            <img src="{{ asset('web/img/team1.jpg') }}"
                                 class="card-img-top">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-0">Richmond Zissu Nutsuglo</h5>
                                <div class="card-text text-black-50 pb-2">CHIEF EXECUTIVE OFFICER</div>
                                <p class="lead">Studied Agricultural Science at the University of Ghana and majored in Post Harvest Technology. He worked as a farm advisor at the Tema Naval Base of the Ghana Armed Forces. Afterwards, Richmond became a farm manager for 2 private Greenhouse farms at Asesewa-Akateng in the Eastern Region of Ghana. In 2016 he began work at the British Council Ghana as a project assistant. Richmond's vast knowledge on post harvest technologies has been invaluable to the Agro Sourcing team</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4 mb-4">
                        <div class="card border-0 shadow">
                            <img src="{{ asset('web/img/team2.jpg') }}"
                                 class="card-img-top">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-0">Joseph Bryden</h5>
                                <div class="card-text text-black-50 pb-2">CHIEF OPERATIONS OFFICER</div>
                                <p class="lead">Joseph Bryden is a technokrat from the Kwame Nkrumah University of Science and Technology and majored in Metallurgy. He continued to attain a diploma in Fire Engineering from the Institute of Fire Engineers, UK. Joseph worked with the Ghana National Fire Service for 8 years as a senior officer and left with the rank of Assistant Divisional Officer Grade 1. Joe Bryden is bent on revolutionizing the use and value addition of agro residues that go waste after every harvest period</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-lg-4 mb-4">
                        <div class="card border-0 shadow">
                            <img src="{{ asset('web/img/team3.jpeg') }}"
                                 class="card-img-top">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-0">Isaac Danso Asiedu</h5>
                                <div class="card-text text-black-50 pb-2">CHIEF TECHNICAL OFFICER</div>
                                <p class="lead">Isaac Danso Asiedu is a trained Aerospace Engineer from the Kwame Nkrumah University of Science and Technology. He received a certificate from the Ghana Air Force School of Trade Training for his Aircraft Systems training. Isaac developed a love for software development and nurtured a dream of building scalable solutions to the many problems in the Ghanaian society. Isaac's experience in systems design and product development has been of immense benefit to the Agro Sourcing team.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
