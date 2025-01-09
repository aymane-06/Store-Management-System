<?php	
session_start();
session_unset();
session_destroy();
header("location:/Store-Management-System/public/index.php");
exit();