<!DOCTYPE html>
<html>
 <head>
  <title>Internal Vacation System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Make a vacation request</h3><br />
  
   @if(isset(Auth::user()->email))
    <div class="alert alert-success success-block">
     <strong>Welcome {{ Auth::user()->email }}</strong>
     <br />
     <a href="{{ url('/main/logout') }}">Logout</a>
    </div>
   @else
    <script>window.location = "/main";</script>
   @endif


   <form method="post" action="{{ url($form_action) }}">
    {{ csrf_field() }}
    @php
    foreach($form_data as $key=>$value){
    @endphp
    <div class="form-group">
      <label>{{ucfirst($key)}}</label>
      <input type="{{$value}}" name="{{$key}}" class="form-control" />
     @if ($errors->has($key))
      <div class="alert alert-danger danger-block">{{ $errors->first($key) }}</div>
    @endif
    </div>
    @php
    }

    @endphp

    
    <div class="form-group">
      <input hidden type='text' name='user' value ="{{Auth::user()->id}}" />
     <input type="submit" name="submit" class="btn btn-primary" value="submit" />
    </div>
   </form>
  </div>
 </body>
</html>