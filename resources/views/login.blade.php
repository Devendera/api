@extends('Layout.layout')
 
@section('content')


<style>
      .container {
    margin-right: -105px !important;
   
      }
    </style>
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center ">User Login</h3>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('loginPost') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                    autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
 
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                             
 
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                                <br/>
                            </div>
                        </form>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection