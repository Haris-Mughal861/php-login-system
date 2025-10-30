<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);




require 'config.php';

if (empty($_SESSION['id'])) {




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
        color: white;
  }
  a{

     text-decoration: none;
      color: black;
      font-weight: bold;
      cursor: pointer;
      padding: 5px;
      border: 1px solid white;
        border-radius: 5px;
        background-color: white;
         text-align: center;
         padding: 12px 24px;
        
     
         &:hover {
        transform: scale(1.05);
         }
        left: 50%;
        width: 50px;
  }

    .popup {
  position: fixed;
  top: 20%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #4CAF50;
  color: white;
  padding: 15px 30px;
  border-radius: 8px;
  font-size: 18px;
  font-weight: bold;
  box-shadow: 0 3px 10px rgba(0,0,0,0.3);
  z-index: 9999;
  opacity: 0.9;
}

.popup.success { background-color: #4CAF50; } 
.popup.error { background-color: #f44336; }

@keyframes fadeOut {
  0% {opacity: 1;}
  80% {opacity: 1;}
  100% {opacity: 0; display: none;}
}
p{


    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 10px;
   
}
   body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f8fb;
      background-color: black;
    }

    .navbar {
      background-color: lightsalmon;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 5px 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      height: 130px;
    }

    .navbar h2 {
      margin: 0;
      font-size: 22px;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      gap: 20px;
      margin: 0;
      padding: 0;
    }

    .navbar ul li {
      display: inline;
    }

    .navbar ul li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
      background-color: black;
    }

    .navbar ul li a:hover {
      text-decoration: underline;
    }

    .content {
      padding: 40px;
      text-align: center;
      color: white;
    }

    #logoutBtn {
      background-color: lightblue;
      color: black;
      padding: 8px 15px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.3s, color 0.3s;
    }

    .logout-btn:hover {
      background-color: lightcoral;
      color: white;
    }

     footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      background: lightsalmon;
      color: black;
      text-align: center;
      padding: 30px 0;
      height: 50px;
    }



</style>

 <div class="navbar">
    <h2>Welcome, to the Web</h2>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
      <li><a href="#">Info</a></li>
     
    </ul>
  </div>

  <div class="content">
    <h1>Welcome to the Dashboard</h1>
   
  </div>


  <body>





  <footer>
    © 2025 Login.com | All Rights Reserved
  </footer>






  <h2>Welcome, <?=htmlspecialchars($username)?></h2>

 <button id="logoutBtn">Logout</button>
<div id="logoutMsg"></div>



<div id="loginMsg"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$("#logoutBtn").click(function(e) {
  e.preventDefault(); 

  $.ajax({
    url: "ajax/ajax_logout.php",
    type: "POST",
    success: function(response) {
      if (response.trim() === "success") {
        
        const popup = $('<div class="popup success">Logout successful!</div>');
        $("body").append(popup);
        setTimeout(() => {
          popup.fadeOut(500, () => popup.remove());
          window.location.href = "login.php";
        }, 1500);
      } else {
        alert("Logout failed. Try again.");
      }
    },
    error: function() {
      alert("Server error. Please try again.");
    }
  });
});
</script>

<div id="popup" style="
   
  position: fixed;
  top: 20%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #4CAF50;
  color: white;
  padding: 15px 30px;
  border-radius: 8px;
  font-size: 18px;
  font-weight: bold;
  box-shadow: 0 3px 10px rgba(0,0,0,0.3);
  z-index: 9999;
  opacity: 0.9;
">Login Successful!</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  if (localStorage.getItem("loginSuccess") === "true") {
    const popup = document.getElementById("popup");
    popup.style.display = "block";

    setTimeout(() => {
      popup.style.display = "none";
      localStorage.removeItem("loginSuccess");
    }, 2000);
  }
});
</script>





  

  
</body>
</html>