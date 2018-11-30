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

    <title>Registration</title>

</head>
<body>
<center>
<h1 style="color: black">Registration..!!!</h1>
<p>********************************************************************************</p>

<h2 style="color: #c7254e">{{ Session::has('errorMsg') ? Session::get("errorMsg") : '' }}</h2>


<div>
    <p style="color:darkred">Required Fields *</p>
    <form method="post" action="/reg" id="1">
        {{csrf_field()}}
        Name:<input type="text" name="name" placeholder="Enter your name" value="{!! old('name') !!}" ><span class="error" style="color:darkred">{{$errors->first('name')}}</span><br><br>
        Email:<input type="text" name="email" placeholder="Enter your email" value="{!! old('email') !!}" ><span class="error" style="color:darkred">{{$errors->first('email')}}</span><br><br>
        Password:<input type="password" name="password" placeholder="Enter your password" ><span class="error" style="color:darkred">{{$errors->first('password')}}</span><br><br>
        <button type="submit">Register</button>
    </form>


    <p>
</div>

<script src="/js/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function () {


    });

</script>
</center>

</body>

</html>