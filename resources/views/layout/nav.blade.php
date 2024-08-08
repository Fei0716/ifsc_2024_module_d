@auth
    <nav class="navbar  navbar-expand-lg text-bg-primary d-flex justify-content-between align-items-center">
        <div class="container">
            <div class="navbar-brand text-white">Martin Deliver Web Panel</div>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white text-decoration-underline" href="{{route('order')}}">Orders</a>
                </li>
                <li class="nav-item"><a class="nav-link text-white text-decoration-underline"
                                        href="{{route('courier.index')}}">Couriers</a></li>
                <li class="nav-item"><a class="nav-link text-white  text-decoration-underline"
                                        href="{{route('courier.create')}}">Define
                        Courier</a></li>
                <li class="nav-item"><a class="nav-link text-white  text-decoration-underline"
                                        href="{{route('company.create')}}">Define
                        Company</a></li>
            </ul>
            <div class="navbar-text d-flex align-items-center gap-2">
                <form action="{{route('logout')}}" method="post" id="form-logout">
                    @csrf
                </form>
                <div class="text-white">{{Auth::user()->username}}</div>
                <a class="text-white btn btn-dark" href="#"
                   onclick="(e)=>e.preventDefault(); document.getElementById('form-logout').submit();">Logout</a>
            </div>
        </div>

    </nav>

@endauth
