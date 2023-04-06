<!DOCTYPE html>
<html>
<head>
    <title>Student App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <style type="text/css">
      body {
        margin-left: 100px;
        margin-right: 100px;
        margin-top: 20px;
      }
    </style>
</head>
<body>
  <br />

<div class="container" id="main-container">
@if(Auth::user() != null)
  <p class="text-right p-10">
  <span class="pr-5">Hello  {{ Auth::user()->name }}</span> <span class="pr-5"><a href="{{ route('logout') }}">Sign Out</a></span>
</p>
<hr />
  @endif

  
    @yield('content')
</div>
   
</body>
</html>