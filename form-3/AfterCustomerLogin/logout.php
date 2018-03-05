<?php 
unset($_SESSION['user']); 
session_destroy();
header('location: /Movie-Recommendation-System/index.html');
?>
