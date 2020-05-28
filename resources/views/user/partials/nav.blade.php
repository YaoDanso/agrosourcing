<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <img src="{{ asset('img/logo.png') }}" height="50px"/>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="{{ route('user.view.cart') }}">
                <i class="fa fa-shopping-cart"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-success badge-counter">{{ \Cart::getContent()->count() }}</span>
            </a>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{ auth()->user()->unReadNotifications->count() }}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    All Notifications
                </h6>
                @if(auth()->user()->notifications->count())
                    @foreach(auth()->user()->unReadNotifications as $notification)
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div>
                                <div class="small text-gray-500">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</div>
                                <span class="font-weight-bold">{{ $notification->data["title"] }}</span><br>
                                <span class="font-weight-normal">{{ \Illuminate\Support\Str::limit($notification->data["message"], 40, '...') }}</span>
                            </div>
                        </a>
                    @endforeach
                    <a class="dropdown-item text-center small text-gray-500" href="{{ route('user.mark.notify') }}">
                        Mark All As Read
                    </a>
                @else
                    <a class="dropdown-item text-center small text-gray-500" href="#">No notifications available</a>
                @endif
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                               {{ auth()->user()->name }}
                            </span>
                <img class="img-profile rounded-circle" src="{{ asset('img/profile/'.auth()->user()->profile->pic) }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('user.profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
