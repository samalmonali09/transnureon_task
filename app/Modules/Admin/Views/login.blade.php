<!doctype html>
<html>
<head>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link rel="icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <style type="text/css">
        body {
            background-image: url("/images/3402.jpg");
        }

    </style>
    <title>Login</title>

</head>
<body>
<center>
<h1 style="color: black">Login..!!!</h1>
<p>********************************************************************************</p>

<?php
if(isset($data)){?>
<p style="color:green">{{$data}}</p>
<?php }
?>
<h2 style="color: #c7254e">{{ Session::has('errorMsg') ? Session::get("errorMsg") : '' }}</h2>
<div>
    <p style="color:darkred">Required Fields *</p>
    <form method="post" action="/login" id="1">
        {{csrf_field()}}
        Email:<input type="text" name="email" placeholder="Enter your email" value="{!! old('email') !!}" ><span class="error" style="color:darkred">{{$errors->first('email')}}</span><br><br>
        Password:<input type="password" name="password" placeholder="Enter your password" ><span class="error" style="color:darkred">{{$errors->first('password')}}</span><br><br>
        <button class="btn btn-xs btn-success">Login</button><br><br>
    </form>
    <a class="btn btn-xs btn-primary" href="/reg">Registration</a>

</div>
</center>
<script>

    $(document).ready(function () {

        window.history.pushState(null, "", window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, "", window.location.href);
        };
    })


</script>
</body>
</html>