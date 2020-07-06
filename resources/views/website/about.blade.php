@extends('website.website-master')
@section('web-content')
    <main class="pt-5">

        <!-- About Us-->
        <section class="pt-5 pb-5 mt-5 mb-5" id="about-us"mas>
            <div class="container">
                <h3 class="display-4">About Agrosourcing Ltd</h3>
                <p class="lead pb-3">Our greatness has always supported our push.</p>
                <div class="row mt-4 mb-4">
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
                <h2 class="font-weight-light pt-5">Our approach to achieving these objectives is two-fold, namely;</h2>
                <div class="row pt-4">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="shadow-sm mb-5 bg-white p-4">
                            <h4 class="card-title text-uppercase font-weight-normal p-2">DEVELOPMENT OF SUPPLY CHAIN TECHNOLOGIES</h4>
                            <p class="card-text lead">
                                We develop and offer robust, efficient and innovative supply chain technologies in the
                                agricultural sector that are capable of eliminating the bottlenecks that exists between
                                agricultural production and consumption.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="shadow-sm mb-5 bg-white p-4">
                            <h4 class="card-title text-uppercase font-weight-normal p-2">VALUE ADDITION/ UPCYCLING OF PRODUCE AND RESIDUE</h4>
                            <p class="card-text lead">
                                We develop business models around agriculturally based waste as an alternative to traditional
                                waste disposal. We transform by-products and waste materials of agricultural production and
                                processing into new materials which can be used as inputs of other production activities.
                            </p>
                        </div>
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
        </section>'


        <section class="py-5 mt-5 mb-5" id="partners">
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

    </main>
@endsection
