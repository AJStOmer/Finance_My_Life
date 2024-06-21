<?php
    session_start();
    session_destroy();
    header('Location: /CalgaryHacks24/login/loginForm.php');
?>