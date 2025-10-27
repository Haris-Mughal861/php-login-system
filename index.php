<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);




require 'config.php';

if (empty($_SESSION['id'])) {


    flash('error', 'Please login first.');


    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'] ?? 'Guest';
?>





<!doctype html>
<html>
<head><meta charset="utf-8"><title>Home</title></head>
<body>

<style>

  h2{
     padding: 220px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
  }
  a{

     text-decoration: none;
      color: white;
      font-weight: bold;
      cursor: pointer;
      padding: 5px;
      border: 1px solid red;
        border-radius: 5px;
        background-color: red;
         align-items: center;
         text-align: center;
         justify-content: center;
         display: flex;
         &:hover {
        transform: scale(1.05);
         }
        
  }

    .popup {
 position: fixed;
  top: 13%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px 40px;
  border-radius: 5px;
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



</style>

<?php if ($msg = flash('error')): ?>
  <div class="popup error"><?= htmlspecialchars($msg) ?></div>
<?php elseif ($msg = flash('success')): ?>
  <div class="popup success"><?= htmlspecialchars($msg) ?></div>
<?php endif; ?>


  <h2>Welcome, <?=htmlspecialchars($username)?></h2>

  <p><a href="logout.php">Logout</a></p>
  

  
</body>
</html>