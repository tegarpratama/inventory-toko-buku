<?php
session_unset('login');
session_start();
$_SESSION = [];
session_unset();
session_destroy();
session_destroy();
header('Location: login.php');
