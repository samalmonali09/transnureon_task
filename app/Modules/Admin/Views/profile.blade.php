<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link rel="icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
</head>
<body>
<center>

<h1 style="color: #0b414d">User Profile</h1><hr>

<p>Name: &nbsp;<?php echo $userData['name'] ?></p>
<p>Email:&nbsp; <?php echo $userData['email'] ?></p>

<a class="btn  btn-xs btn-success" href="/mutual/<?php echo $userData['id'] ?>"> Mutual Friend</a>
    <a class="btn btn-xs btn-default" href="/dashboard"><button>Home</button></a>


</center>
</body>
</html>
