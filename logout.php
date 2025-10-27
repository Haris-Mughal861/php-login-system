
<?php
require 'config.php';

session_start();


$_SESSION = [];


if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(session_name(), '', time() - 42000,

        $params["path"], $params["domain"],

        $params["secure"], $params["httponly"]
        
    );
}


session_destroy();

flash('success', 'You have logged out.');

header('location: login.php');


exit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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



</style>


    
</body>
</html>



