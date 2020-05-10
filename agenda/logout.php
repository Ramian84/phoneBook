<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["username"]);
unset($_SESSION["password"]);
unset($_SESSION["role"]);
header("Location: login.php");
?>