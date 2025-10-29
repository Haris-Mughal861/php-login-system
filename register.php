<?php
require 'config.php'; 

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $age = intval($_POST['age'] ?? 0);

    if ($username === '' || $email === '' || $password === '' || $age <= 0) {
        flash('error', 'All fields are required.');
        header('Location: register.php');
        exit;
    }

      if ($age <= 10) {
      flash('error', 'You must be older than 10 to register.');
      header('Location: register.php');
       exit;
     }

    
    $check = $mysqli->prepare("SELECT id FROM logins WHERE email = ? LIMIT 1");
    $check->bind_param('s', $email);
    $check->execute();
    $check->store_result();


    if ($check->num_rows > 0) {
        flash('error', 'Email already registered.');
        header('Location: register.php');
        exit;
    }
 


    $check->close();

   
    $hash = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $mysqli->prepare("INSERT INTO logins (username, email, password, age, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param('sssi', $username, $email, $hash, $age);

    if ($stmt->execute()) {

        flash('success', 'Registration successful. You can now log in.');
        header('Location: login.php');
        exit;


    } else {
        flash('error', 'Registration failed. Try again.');
        header('Location: register.php');
        exit;
    }

}




?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="icon" type="image/png" href="reg.png">
  <style>


 .popup {
   position: fixed;
  top: 13%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px 40px;
  border-radius: 10px;
  color: #fff;
  font-weight: 500;
  animation: fadeOut 2s forwards;
  box-shadow: 0 3px 10px rgba(0,0,0,0.4);
  z-index: 9999;
  font-size: 18px;
  text-align: center;
}
.popup.success { background-color: #4CAF50; } 
.popup.error { background-color: #f44336; }

@keyframes fadeOut {
  0% {opacity: 1;}
  80% {opacity: 1;}
  100% {opacity: 0; display: none;}
}


    body {
      background-color: lightblue;
      font-family: Arial, sans-serif;
      padding: 120px;

    }



    h1 {
      text-align: center;
      padding: 30px;
    }



    form {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
      background-color: white;
      padding: 25px;
      border-radius: 10px;
      width: 90%;
      max-width: 1000px;
      margin: 0 auto;

    }



    label {
      font-weight: bold;
      margin-right: 20px;

    }



    input {
      height: 35px;
      padding: 5px;
      border: 1px solid gray;
      border-radius: 5px;
      width: 200px;
      transition: border-color 0.3s;

    }



    .form-group {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 70px;
      width: 250px;
      transition: transform 0.3s;
      &:hover {
        transform: scale(1.05);
    }

    }




    button {
      padding: 10px 20px;
      border: none;
      background-color: darkblue;
      color: white;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s;
      &:hover {
        background-color: blue;
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

     img{
      display: block;
  margin-left: auto;
  margin-right: auto;
  padding: 30px;
  

    }



  </style>
</head>
<body>


<?php if ($msg = flash('error')): ?>
  <div class="popup error"><?= htmlspecialchars($msg) ?></div>
<?php elseif ($msg = flash('success')): ?>
  <div class="popup success"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>




  <h1>REGISTER NOW</h1>
  

<img src="reg.png" alt="Description" width="80" height="65">



  <form action="register.php" method="POST">
    <div class="form-group">
      <label>Username:</label>
      <input type="text" name="username">
    </div>



    <div class="form-group">
      <label>Email:</label>
      <input type="email" name="email" >
    </div>



    <div class="form-group">
      <label>Password:</label>
      <input type="password" name="password">
    </div>



    <div class="form-group">
      <label>Age:</label>
      <input  min= "1" max="120" type="number" name="age">
    </div>



    <button type="submit">Register</button>

    <a href="login.php">Already have account?</a>
  </form>

</body>
</html>
