<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Change Password</title>
</head>

<body>

Welcome <?php echo $_POST["identifier"]; ?><br>
Your old password is: <?php echo $_POST["password1"] ?><br>
Your new password is: <?php echo $_POST["password2"]; ?>

</body>
</html>