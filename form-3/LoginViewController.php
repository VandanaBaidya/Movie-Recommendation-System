<?php
//header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
echo "session variable : ".$_SESSION['user'];
if (!isset($_SESSION['user'])) {
    header('Location: /Movie-Recommendation-System/form-3/AfterCustomerLogin/CustomerPage.html');
    //echo "Session not set";
    exit();
}
else
{
	header('Location: /Movie-Recommendation-System/AfterCustomerLogin/CustomerPage.html');
}
/*echo 'You have successfully logged as '.$_SESSION['user']*/

?>
