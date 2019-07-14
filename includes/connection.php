<?php
	require("constants.php");

	$conn_string = "host=".DB_SERVER." port=5432 dbname=".DB_NAME." user=".DB_USER." password=".DB_PASS;
	$dbconn = pg_connect($conn_string);
	
	if (!$dbconn) {
		echo "Произошла ошибка.\n";
		exit;
	}

?>