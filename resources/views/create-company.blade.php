@extends('layout.main')
@section('content')
    <div class="card col-6 justify-content-center m-5 mx-auto">
        <div class="card-body">
            <h1 class="text-center mb-3">Define New Company</h2>
                <form action="{{route('company.store')}}" method="post">
                    @csrf
                    @if(Session::has('success'))
                        <div class=" text-center alert alert-success">
                            {{Session::get('success')}} <br> Api-Key: {{Session::get('api_key')}}
                        </div>
                    @endif

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
                        <label for="webhook_address">Webhook Address</label>
                        <input type="text" name="webhook_address" id="webhook_address"
                               class="form-control @error('webhook_address') is-invalid @enderror"
                               autocomplete="off" placeholder="eg: https://McDermott Ltd.com/webhook" required>
                        @error('webhook_address')
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
