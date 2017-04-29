<?php
// Start the session
session_start();
session_destroy(); 
header("refresh:0;url=../owner_login.html");
?>