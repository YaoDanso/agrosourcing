<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top p-3 shadow-sm bg-white">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('web/img/agro.jpg') }}" alt="" height="50px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.home') }}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('web.home')}}#our-skills">Our Skills</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('web.about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#what-we-do">What We Do</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#partners">Partners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#our-team">Our Team</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
