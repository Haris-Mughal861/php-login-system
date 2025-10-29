<?php
require 'config.php';



unset($_SESSION['id']);

unset($_SESSION['username']);


flash('seccess', 'logged out successfully.');



header('Location: login.php');

exit;

?>
