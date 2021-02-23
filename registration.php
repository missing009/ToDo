<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <a class="navbar-brand" href="https://sourcecodester.com">Sourcecodester</a>
    </div>
</nav>
<div class="col-md-3"></div>
<div class="col-md-6 well">
    <h3 class="text-primary">PHP - PDO Login and Registration</h3>
    <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="form">
            <form method="post" class="register-form"  action="register_query.php" >
                <input type="text" name="name" placeholder="name"/>
                <input type="password" name="pass" placeholder="password"/>
                <input type="text" name="email" placeholder="email address"/>
                <button type="submit" name="signup" >create</button>
                <a href="index.php">Login</a>

            </form>
    </div>
</div>
</body>
</html>