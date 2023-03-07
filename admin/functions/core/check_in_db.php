<?php
function DatainDB($connection,$type,$value){
	$query = mysqli_query($connection,
	"SELECT * FROM users WHERE $type = '$value'"
	);

	if(mysqli_num_rows($query) > 0){
	  return true;
	} else {
	  return false;
	}

}
?>
