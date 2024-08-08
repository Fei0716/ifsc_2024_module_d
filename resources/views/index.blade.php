@extends('layout.main')
@section('content')
    <div class="card col-6 justify-content-center m-5 mx-auto">
        <div class="card-body">
            <h1 class="text-center mb-3">Admin Login <br>(Martin Deliver)</h2>
                <form action="{{route('login-admin')}}" method="post">
                    @csrf
                    @if(Session::has('error'))
                        <div class=" text-center alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                    @endif
                    <div class="mb-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"
                               class="form-control @error('username') is-invalid @enderror"
                               required>
                        @error('username')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <button class="btn btn-primary" type="submit">Login</button>
                        <button class="btn btn-outline-primary" type="reset">Reset</button>
                    </div>
                </form>
        </div>
    </div>
@endsection
