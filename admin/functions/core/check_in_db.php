<?php

function DatainDB($connection,$table,$type,$value){
	$query = mysqli_query($connection,
	"SELECT * FROM $table WHERE $type = '$value'"
	);

	if(mysqli_num_rows($query) > 0) {
	  return 'TRUE';
	} else {
	  return 'FALSE';
	}

}
?>
