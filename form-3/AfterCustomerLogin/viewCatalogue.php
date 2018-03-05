<?php

if(isset($_GET['regid'])){
    $regid=$_GET['regid'];
}else{
    $regid=6789;
}

echo "<!DOCTYPE html>

<html lang='en'>
	<head>
    	<link rel='stylesheet' type='text/css' href='viewCatalogue.css'>
      	<meta charset='UTF-8'>
      	<title>view catalogue</title>
      	
      	<!-- CSS Styles -->
		<style>
			.speech {border: 1px solid #DDD; width: 300px; padding: 0; margin: 0}
  			.speech input {border: 0; width: 240px; display: inline-block; height: 30px;}
  			.speech img {float: right; width: 40px }
		</style>
      	
      	<script type='text/javascript' src='validateRatingForm.js'></script>
      	<script type='text/javascript' src='validatePlaylist.js'></script>
      	<script type='text/javascript' src='validateViewPlaylist.js'></script>
      	
      	<!-- HTML5 Speech Recognition API -->
<script>
  function startDictation() {

    if (window.hasOwnProperty('webkitSpeechRecognition')) {

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = 'en-US';
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('labnol').submit();
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }

    }
  }
</script>
      	
    </head>
    
    <body>";

      	$host = 'localhost';
		$user = 'root';
 		$pass = '';
 		
 		$con=mysqli_connect($host, $user, $pass,'Movie_System');
 		if(mysqli_connect_errno())
 		{
			echo "Error while connecting ".mysqli_connect_error()."<br/>";
		}
		
 		$sql="SELECT movieId,title,genres FROM movies;";
 		
      echo "
      
      <div id='tfheader'>
		<form id='tfnewsearch' method='get' action='searchCatalogue.php'>
		<div class='speech'>
		        
		        <input type='text' name='searchQuery' id='transcript' placeholder='Search / Speak' />
		        <img onclick='startDictation()' src='voiceSearch.png' />
		        <input type='submit' value='>' class='tfbutton2' name='submit_searchCatalogue'/>
		        
    			
 		 </div>
		</form>
		<div class='tfclear'></div>
	</div><br />
	
	
	
	<!--<form>
  <label for='fname'>First Name</label>
  <input type='text' id='fname' name='fname'>
  <label for='lname'>Last Name</label>
  <input type='text' id='lname' name='lname'>
</form>-->
      
   <form role = 'form' action='getRating.php' method='post' class='login-form' onsubmit='return validate();' id='form1'>
   <div class = 'form-group'>
      <input type = 'text' class = 'form-control' id = 'name' placeholder = 'Enter the movie ID here' name='movieIDtextbox' />
      <input type='number' class='form-control' placeholder='Enter your registration ID here' value='".$regid."' name='regid' id='regid'/>
      <input id='ratingValue' type='number' min='1' max='5' step='1' placeholder='Rate this movie (1 - 5)' name='ratingValue'/>
      <input type='submit' value='Rate this movie now  >>' class='tfbutton7' name='submitRatingButton'/><br />
      <label class='tip'><strong>Tip : Please verify your registration ID before proceeding</strong></label>
      <strong><p id='error_para' class='tip'></p></strong>
   </div>
   </form>
   
   <form role = 'form' action='addToPlaylist.php' method='post' class='login-form' onsubmit='return validate1();' id='form2'>
   <div class = 'form-group'>
      <input type = 'text' class = 'form-control' id = 'title' placeholder = 'Enter the movie ID here' name='movieIDtextbox' />
      <input type='number' class='form-control' placeholder='Enter your registration ID here' value='".$regid."' name='songregid' id='movieregid'/>
      <input type='submit' value='Add to Favourites  >>' class='tfbutton7' name='addTofavorites'/><br />
      <label class='tip'><strong>Tip : Please verify your registration ID before proceeding</strong></label>
      <strong><p id='error_para1' class='tip'></p></strong>
   </div>
   </form>
   
    <form role = 'form' action='viewPlaylist.php' method='post' class='login-form' onsubmit='return validate2();' id='form3'>
   <div class = 'form-group'>
      <input type='number' class='form-control' placeholder='Enter your registration ID here' value='".$regid."' name='playlistregid' id='playlistregid'/>
      <input type='submit' value='View my favourites  >>' class='tfbutton7' name='viewfavouritesbutton'/><br />
      <label class='tip'><strong>Tip : Please verify your registration ID before proceeding</strong></label>
      <strong><p id='error_para2' class='tip'></p></strong>
   </div>
   </form>
   
   
      <div style='overflow-x:auto;'>
      <table>
        <tr>
          <th>Movie ID</th>
          <th>Movie Title</th>
          <th>Genres</th>
        </tr>";
        
        
        	if ($result=mysqli_query($con,$sql))
          	{
          		while($row=mysqli_fetch_row($result))
            	{        
            		echo
            			"<tr>
              			<td>".$row[0]."</td>
              			<td>".$row[1]."</td>
              			<td>".$row[2]."</td>
            			</tr>\n";
            	}
            	mysqli_free_result($result);
          	}
    mysqli_close($con);
          
    echo "</table>
    </div>
    
    
    </body>
</html>";
?>
