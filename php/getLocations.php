<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$con = mysqli_connect("localhost", "towns536_tsb11oc", "tsb11oct13!", "towns536_tsb11oct13");

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, "SELECT * FROM locations");

$rows = array();
while ($r = mysqli_fetch_assoc($result)) {
	$rows[] = $r;
}

echo json_encode($rows);

mysqli_close($con);

?>