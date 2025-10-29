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
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px 40px;
    border-radius: 10px;
    color: #fff;
    font-weight: 500;
    animation: fadeOut 3s forwards;
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
    100% {opacity: 0;}
  }

  body {
    background-color: lightblue;
    font-family: Arial, sans-serif;
    padding: 120px;
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
    padding: 30px;
    width: 250px;
  }

  button {
    padding: 10px 20px;
    border: none;
    background-color: darkblue;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
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
  }

  img {
    display: block;
    margin: 0 auto 20px;
  }
   h1 {
      text-align: center;
      padding: 30px;
    }
  </style>
</head>
<body>

  <h1>REGISTER NOW</h1>
  <img src="reg.png" width="80" height="65">

  <form id="registerForm" method="POST">
    <div class="form-group">
      <label>Username:</label>
      <input type="text" name="username">
    </div>

    <div class="form-group">
      <label>Email:</label>
      <input type="email" name="email">
    </div>

    <div class="form-group">
      <label>Password:</label>
      <input type="password" name="password">
    </div>

    <div class="form-group">
      <label>Age:</label>
      <input min="1" max="120" type="number" name="age">
    </div>

    <button type="submit">Register</button>
    <a href="login.php">Already have account?</a>
  </form>

  <div id="regMsg" class="popup" style="display:none;"></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
  $("#registerForm").submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: "ajax/ajax_register.php",
      type: "POST",
      data: $(this).serialize(),
      success: function(response) {
        let msgBox = $("#regMsg");
        msgBox.show().text(response);

        if (response === "success") {
          msgBox.removeClass("error").addClass("success").text("Registered successfully! Redirecting...");
          setTimeout(() => window.location.href = "login.php", 2000);
        } else {
          msgBox.removeClass("success").addClass("error");
        }
      }
    });
  });
  </script>

</body>
</html>
