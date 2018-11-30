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
    <title>Dshboard</title>

</head>
<body>
<center>
<h1 style="color: black">Dashboard..!!!</h1><br><br>


<div>
    <form method="post" action="/search" id="1">
        {{csrf_field()}}
        Enter name to search friends:<input type="text" name="name" placeholder="Enter your name" value="{!! old('name') !!}" >
        <button class="btn btn-xs btn-success">Search Friends</button><br>
        <h4 style="color: darkred">{{ Session::has('emsg') ? Session::get("emsg") : '' }}</h4>
        <h4 style="color: darkred">{{ Session::has('msg') ? Session::get("msg") : '' }}</h4>
        <h4 style="color: green">{{ Session::has('smsg') ? Session::get("smsg") : '' }}</h4>

    </form><br>
    <a class="btn  btn-xs btn-success"  href="/friendList">Friend List </a>
    <a   class="btn  btn-xs btn-info" href="/requestData">Request List </a>
    <a  class="btn  btn-xs btn-success"  href="/pendingData">Pending Friend List </a>
    <a  class="btn  btn-xs btn-success"  href="/logout">Logout</a>
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