<?php

//header('Content-Type: application/json' );
	if(isset( $_POST['viewPlaylistButton']))
	{
		echo "<!DOCTYPE html>

<html lang='en'>
    <head>
    	<link rel='stylesheet' type='text/css' href='viewCatalogue.css'>
      	<meta charset='UTF-8'>
      	<title>database connections</title>
      	
      	<style>
      		html { 
  background: url(Cream.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
      	</style>

	<!-- Load c3.css -->
	<link href='c3.css' rel='stylesheet' type='text/css'>
	
	<!-- Load d3.js and c3.js -->
	<script src='https://d3js.org/d3.v3.min.js' charset='utf-8'></script>
	<script src='c3.min.js'></script>

    </head>
    
    <body>";
 		function validate_data($data)
 		{
 	 		$data = trim($data);
  			$data = stripslashes($data);
  			$data = strip_tags($data);
  			$data = htmlspecialchars($data);
  			/*$data = mysqli_real_escape_string($data);*/
  			return $data;    
 		}

		$regid = validate_data( $_POST['playlistregid'] );
		//$searchQuery = validate_data( $_POST['searchQuery'] );		

 		$host = 'localhost';
 		$user = 'root';
 		$pass = '';
 		
 		$con=mysqli_connect($host, $user, $pass,'Movie_System');
 		if(mysqli_connect_errno())
 		{
			echo "Error while connecting ".mysqli_connect_error()."<br/>";
		}

		//Check if the song id is valid
		$query="SELECT title,genres FROM Playlist WHERE Customer_ID =".$regid;
    /*
		$rock = 0;
		$pop = 0;
		$jazz = 0;
		$funk = 0;
		$hiphop = 0;
		*/
		
		echo "
		<div style='overflow-x:auto;'>
      <table>
        <tr>
          <th>Movie Title</th>
          <th>Genre</th>
        </tr>";
        
        if ($result=mysqli_query($con,$query))
  		{
  			// Fetch one and one row
  			while ($row=mysqli_fetch_row($result))
    		{
    		
    			echo
            			"<tr>
              			<td>".$row[0]."</td>
              			<td>".$row[1]."</td>
            			</tr>\n";
            	if ($row[1]=="Rock")
            	{
            		$rock = $rock + 1;
            	}
            	elseif ($row[1]=="Pop")
            	{
            		$pop = $pop + 1;
            	}
            	elseif ($row[1]=="Jazz")
            	{
            		$jazz = $jazz + 1;
            	}
            	elseif ($row[1]=="Funk")
            	{
            		$funk = $funk + 1;
            	}
            	else
            	{
            		$hiphop = $hiphop + 1;
            	}
    		}
    		$data = array();
    		array_push($data,$rock);
    		array_push($data,$pop);
    		array_push($data,$jazz);
    		array_push($data,$funk);
    		array_push($data,$hiphop);
  			// Free result set
  			mysqli_free_result($result);
		}
		
		$visualize = json_encode($data);
 		mysqli_close($con);
 		echo "</table>
    </div>
    </body>
    </html>
    ";
	}	
?>

<html>
<body>
<br/><br/><br/>
<b>Performance Graph</b>
<br/><br/>
<div id='chart'></div>

	<script>
	var data = '<?= $visualize; ?>';
	var fdata = JSON.parse(data);
	
	//window.alert(fdata);

	var dt=[];

		dt.push(fdata[0]);
		dt.push(fdata[1]);
		dt.push(fdata[2]);
		dt.push(fdata[3]);
		dt.push(fdata[4]);

	 </script>	
	<script type='text/javascript' src='playlistGraph.js'> </script>

</body>
</html>




























