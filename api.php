<html>
<body>

<?php

$database = array("24hCardiovascularN8"=>array("crouch end cardio 1", "crouch end cardio 2"), "24hCardiovascularN10"=>array("umpaland cardio 1"));
// consturct rudimentary database

$dob = $postcode = $timeFrame = $sgGroup = $gender = "";
// define variables obtained from requests
$dobError = $postError = $timeError = "";
// define errors 

function validateParameters($parameter) {
	$parameter = trim($parameter);
	$parameter = stripslashes($parameter);
	$parameter = htmlspecialchars($parameter);
	return $parameter;
}

?>

</body>
</html>