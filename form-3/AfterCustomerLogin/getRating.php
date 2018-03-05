<?php
//session_start();

	if(isset( $_POST['submitRatingButton']))
	{
 		function validate_data($data)
 		{
 	 		$data = trim($data);
  			$data = stripslashes($data);
  			$data = strip_tags($data);
  			$data = htmlspecialchars($data);
  			/*$data = mysqli_real_escape_string($data);*/
  			return $data;    
 		}
 		
 		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml' lang='en'>
	<head>
      	<meta charset='UTF-8'>
      	<title>database connections</title>
      	<style>
      	html { 
  background: url(headphones.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
      	</style>
    </head>
    
    <body>";

 		$movieId = validate_data( $_POST['movieIDtextbox'] );
 		$regid = validate_data( $_POST['regid'] );
 		$rating = validate_data( $_POST['ratingValue'] );

 		$host = 'localhost';
 		$user = 'root';
 		$pass = '';
 		
 		$con=mysqli_connect($host, $user, $pass,'Movie_System');
 		if(mysqli_connect_errno())
 		{
			echo "Error while connecting ".mysqli_connect_error()."<br/>";
		}

		//Check if the movie id is valid
		$query="SELECT title FROM movies WHERE movieId = '".$movieId."'";
		if($result=mysqli_query($con,$query))
 		{
 			$row=mysqli_fetch_row($result);
 			//echo "row[0] = ".$row[0];
 			if($row[0]=="")
 			{
 				echo "You have entered a wrong movie id.<br /><br />Please go back and enter a correct one.";
 			}
 			else
 			{

 		$que="INSERT INTO Rating VALUES ('$regid','$movieId','$rating')";
 
 		if(mysqli_query($con,$que))
 		{
			header("Location: /Movie-Recommendation-System/form-3/AfterCustomerLogin/successRatingPage.php?regid=".urlencode($regid));
		}	

		else
		{
			echo "<strong>You have already rated this movie.<br/>Go back and rate some other movie.</strong>";
		}
		}
		}
		else
		{
			echo "<strong>You have entered a wrong movie id.<br /><br />Please go back and enter a correct one.</strong>";
		}
 		mysqli_close($con);
 		echo "
    </body>
</html>";
	}
?>




