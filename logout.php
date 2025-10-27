<?php
require 'config.php';



unset($_SESSION['id']);

unset($_SESSION['username']);


flash('success', 'logged out successfully.');



header('Location: login.php');

exit;

?>
