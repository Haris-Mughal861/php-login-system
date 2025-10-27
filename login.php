<<?php
require 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!empty($_SESSION['id'])) {

    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {

        flash('error', 'Enter email and password.');
        header('Location: login.php');
        exit;
    }

    $stmt = $mysqli->prepare("SELECT id, username, password FROM logins WHERE email = ? LIMIT 1");


    $stmt->bind_param('s', $email);

    $stmt->execute();

    $stmt->bind_result($id, $username, $hash);


    if ($stmt->fetch()) {

        if (password_verify($password, $hash)) {

            $_SESSION['id'] = $id;

            $_SESSION['username'] = $username;


            flash('success', 'Login successful.');

            header('Location: index.php');
            exit;
        }
    }

    $stmt->close();

    flash('error', 'Invalid email or password.');

    header('Location: login.php');
    exit;



    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <link rel="icon" type="png" href="login.png">

</head>
<body>

<?php if ($msg = flash('error')): ?>
  <div class="popup error"><?= htmlspecialchars($msg) ?></div>
<?php elseif ($msg = flash('success')): ?>
  <div class="popup success"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>

<style>

    .popup {
  position: fixed;
  top: 20px;
  right: 20px;
  padding: 15px 25px;
  border-radius: 10px;
  color: #fff;
  font-weight: 500;
  animation: fadeOut 4s forwards;
  box-shadow: 0 3px 8px rgba(0,0,0,0.3);
  z-index: 9999;
}
.popup.success { background-color: #4CAF50; } 
.popup.error { background-color: #f44336; }

@keyframes fadeOut {
  0% {opacity: 1;}
  80% {opacity: 1;}
  100% {opacity: 0; display: none;}
}
    body{
        background-color: lightblue;
    }

    .container{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 35px;
        margin: 10px;
        padding: 50px;
        border-radius: 10px;
        background-color: white;
        width: 90%;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        

        


    }
    .name{
        gap: 20px;
        width: 270px;
        height: 40px;
        padding: 5px;
        border: 1px solid gray;
        border-radius: 5px;
         &:hover {
        transform: scale(1.05);
    }

        
    }
    .number{
        gap: 10px;
        width: 400px;
        height: 40px;
        padding: 5px;
        border: 1px solid gray;
        border-radius: 5px;
         &:hover {
        transform: scale(1.05);
    }

    }
    h1{
        padding: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;

    }
    button{
        width: 150px;
        background-color: blue;
        color: white;
        height: 50px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
         &:hover {
        transform: scale(1.05);
        
    }

    }

    a {
      text-decoration: none;
      color: darkblue;
      font-weight: bold;
      cursor: pointer;
      padding: 5px;
      border: 1px solid darkblue;
        border-radius: 5px;
        background-color: lightblue;
         &:hover {
        transform: scale(1.05);
    }

    }

     label {
      font-weight: bold;
      margin-right: 30px;
      text-align: center;
      

    }
    img{
      display: block;
  margin-left: auto;
  margin-right: auto;
  

    }


</style>

<h1>Enter login Details</h1>

<img src="lock.png" alt="Description" width="100" height="65">


<?php if ($e = flash('error')): ?>

    <div style="color:red"><?=htmlspecialchars($e)?></div>

  <?php endif; ?>

  <?php if ($s = flash('success')): ?>

    <div style="color:green"><?=htmlspecialchars($s)?></div>
  <?php endif; ?>





<form action="login.php" method="POST" class="container">


<div>
    <label>Email:</label>
    <input type="email" name="email" require class="name">
</div>
<div>
    <label>Password:</label>
    <input type="password" name="password" require class="number">
</div>

<button type="submit">Login</button>

<a href="register.php">Don't have account?</a>

</form>
    
</body>
</html>



