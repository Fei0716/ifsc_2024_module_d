@extends('layout.main')
@section('content')
    <div class="card col-6 justify-content-center m-5 mx-auto">
        <div class="card-body">
            <h1 class="text-center mb-3">Define New Courier</h2>
                <form action="{{route('courier.store')}}" method="post">
                    @csrf
                    @if(Session::has('success'))
                        <div class=" text-center alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <div class="mb-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username"
                               class="form-control @error('username') is-invalid @enderror"
                               autocomplete="off" required>
                        @error('username')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="Name">Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               required>
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               autocomplete="off" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <button class="btn btn-primary" type="submit">Create</button>
                        <button class="btn btn-outline-primary" type="reset">Reset</button>
                    </div>
                </form>
        </div>
    </div>

@endsection
