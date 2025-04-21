<?php
session_start();
unset($_SESSION['carrito']);
header("Location: ../pages/carrito.php");
exit;
