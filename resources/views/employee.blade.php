<!DOCTYPE html>
<html>
 <head>
  <title>Simple Login System in Laravel</title>
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


   <form method="post" action="{{ url('/application/submit') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <label>Date From</label>
     <input type="date" name="date_from" class="form-control" />
     @if ($errors->has('date_from'))
    <div class="alert alert-danger danger-block">{{ $errors->first('date_from') }}</div>
    @endif
    </div>
    <div class="form-group">
     <label>Date To</label>
     <input type="date" name="date_to" class="form-control" />
     @if ($errors->has('date_to'))
    <div class="alert alert-danger danger-block">{{ $errors->first('date_to') }}</div>
    @endif
    </div>
    <div class="form-group">
     <label>Reason</label>
     <input type="text" name="reason" class="form-control" />
     @if ($errors->has('reason'))
    <div class="alert alert-danger danger-block">{{ $errors->first('reason') }}</div>
    @endif
    </div>
    <div class="form-group">
      <input hidden type='text' name='user' value ="{{Auth::user()->id}}" />
     <input type="submit" name="vacation" class="btn btn-primary" value="vacation" />
    </div>
   </form>
  </div>
 </body>
</html>