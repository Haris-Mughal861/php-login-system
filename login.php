<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="icon" type="png" href="login.png">
  <style>
    body {
      background-color: lightgray;
      padding: 80px;
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      gap: 25px;
      padding: 50px;
      background: white;
      border-radius: 10px;
      width: 90%;
      max-width: 500px;
      margin: auto;
    }
    input, button {
      width: 80%;
      height: 40px;
      border-radius: 5px;
      border: 1px solid gray;
      padding: 5px;
    }
    button {
      background-color: blue;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }
    #loginMsg {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
    }
     img{
      display: block;
  margin-left: auto;
  margin-right: auto;
  padding: 20px;
  

    }
  </style>
</head>
<body>

<h1 style="text-align:center;">Entre login Details</h1>
<img src="lock.png" alt="Description" width="100" height="65">

<form id="loginForm" class="container">
  <label>Email:</label>
  <input type="email" name="email" required>
  <label>Password:</label>
  <input type="password" name="password" required>
  <button type="submit">Login</button>
  <a href="register.php">Dont have Account?</a>
</form>



<div id="loginMsg"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$("#loginForm").submit(function(e) {
  e.preventDefault();

  $.ajax({
    url: "ajax/ajax_login.php",  
    type: "POST",
    data: $(this).serialize(),
    success: function(response) {
      if (response.trim() === "success") {
        $("#loginMsg").css("color", "green").text("Login successful! Redirecting...");
        setTimeout(() => window.location.href = "index.php", 1500);
      } else {
        $("#loginMsg").css("color", "red").text(response);
      }
    },
    error: function() {
      $("#loginMsg").css("color", "red").text("Server error. Please try again.");
    }
  });
});
</script>
</body>
</html>
