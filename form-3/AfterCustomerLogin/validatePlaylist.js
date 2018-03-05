function validate1()
{
	var error="";
	var name = document.getElementById("title");
	if(name.value == "")
	{
		error = "Enter movie id";
  		document.getElementById( "error_para1" ).innerHTML = error;
  		return false;
 	}

 	var regid=document.getElementById("movieregid");
 	if(regid.value == "") 
 	{
 		error = "Enter your registration ID";
 		document.getElementById("error_para1").innerHTML = error;
  		return false;
 	}
}
