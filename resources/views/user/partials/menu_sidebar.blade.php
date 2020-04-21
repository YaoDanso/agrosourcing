<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">Agro Sourcing</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.welcome') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Activities
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.profile') }}"
           data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span>
        </a>
    </li>

    @foreach(auth()->user()->roles as $role)
        @if($role->id == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Manage Farm</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('user.view.farm') }}">View Farm</a>
                        <a class="collapse-item" href="{{ route('user.add.farm') }}">Add Farm</a>
                    </div>
                </div>
            </li>
        @elseif($role->id == 2)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFunding" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Product</span>
                </a>
                <div id="collapseFunding" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('user.add.product') }}">Add Product</a>
                    </div>
                </div>
            </li>
        @elseif($role->id == 3)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAggregator" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Aggregator</span>
                </a>
                <div id="collapseAggregator" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('user.add.warehouse') }}">Add Warehouse</a>
                        <a class="collapse-item" href="{{ route('user.view.warehouse') }}">View Warehouse</a>
                    </div>
                </div>
            </li>
        @endif
    @endforeach
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.view.orderList') }}">
            <i class="fa fa-shopping-cart"></i>
            <span>Place Order</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-power-off"></i>
            <span>Logout</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
