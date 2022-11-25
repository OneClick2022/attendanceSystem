<!DOCTYPE html>
<html>
 <head>
  <title>Attendance System</title>
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
 <script> HTML::style('D:\attendanceSystem\resources\css\style2.css'); </script>
  <link href="/css/style2.css" rel="stylesheet">
 </head>
 <body>
  <br />
  <div class="container-box">
        <div class="left">
            <div class="overlay">
                
                <img src="{{url('images\oneclick.png')}}">
               
            </div>
        </div>
    

   @if(isset(Auth::user()->email))
    <script>window.location="/main/successlogin";</script>
   @endif

   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif
   <div class="right">
        <form method="post" action="{{ url('/main/checklogin') }}">
            {{ csrf_field() }}
            <h1 style="text-align:center"> Login</h1>
            <div class="form-group">
                
                <input type="email" name="email" class="form-control" placeholder="user name" />
                <br>
                <input type="password" name="password" class="form-control" placeholder="password" />
                <br><br>
                <h4>Select Field</h4><br>
                
                    <input type="radio" name="user_type" value="faculty" />
                    <span class="text-checkbox">Faculty</span>
                    <input type="radio" name="user_type" value="admin"/>
                    <span class="text-checkbox">Admin</span>
               
                <br>
                <br>
                <input type="submit" name="login" class="btn-primary" value="Login" />
        
            </div>
        </form>
    </div>
  </div>
 </body>
</html>
  
