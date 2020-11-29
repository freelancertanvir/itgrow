<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/log.css">
</head>

<body>
    <div id="log">
        <h1>Login</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="addForm">
            <label for="email">Email:</label>
            <input type="email" value="demo@gmail.com" name="email" id="email"><br><br>
            <label for="password">Password:</label>
            <input type="password" value="demo" name="password" id="password"><br><br>
            <input type="submit" name="save-button" value="Login">
        </form>
    </div>

    <?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (($email == 'demo@gmail.com') && ($password == 'demo')) {
        echo header('Location: homepage.php');
    } else {
        echo "<p id='result'>Wrong Credentials</p>";
    }
}
?>

</body>
</html>