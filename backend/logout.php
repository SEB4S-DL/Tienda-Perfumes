<?php
session_start();
session_unset();
session_destroy();
header("Location: /TIENDA-PERFUMES/index.php");
exit();
