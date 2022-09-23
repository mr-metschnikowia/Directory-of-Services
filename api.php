<html>
<body>

<?php

$response = array();
// query result 

$username = "root";

$password = "";

$dbname = "nhs";

$servername = "localhost";

$conn = new mysqli($servername, $username, $password, $dbname);
// construct MySQL database connection 

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// check database connection 

$tempDob = $tempPost = $tempTime = $tempSg = $tempGend = "";
// define interim variables from from parameters, used before form is completed

$dob = $postcode = $timeFrame = $sgGroup = $gender = "";
// define final variables, set once form is complete

$dobError = $postError = $timeError = $genderError = "";
// define errors 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//check if post request is made 
	$lock = 0;
	if (empty($_POST['dob'])) {
		$dobError = "DOB is required!";
	} else {
		$tempDob = validateParameter($_POST["dob"]);
		// general parameter validation 
	}  
	if (empty($_POST['postcode'])) {
		$postError = "Postcode is required!";
	} else {
		$tempPost = validateParameter($_POST["postcode"]);
	}
	if (empty($_POST['gender'])) {
		$genderError = "Gender is required!";
	} else {
		$tempGend = validateParameter($_POST["gender"]);
		$lock += 1;
	}
	if (empty($_POST['timeFrame'])) {
		$timeError = "Timeframe is required!";
	} else {
		$tempTime = validateParameter($_POST["timeFrame"]);
	}
	$tempSg = validateParameter($_POST["sgGroup"]);
	// set temp variables - before number of required variables completed is calculated

	if (preg_match("*^(0[1-9]|[1-2][0-9]|3[0-1])/(0[1-9]|1[0-2])/[0-9]{4}$*", $tempDob)) {
	//if (!preg_match("*^[0-9]{4}/(0[1-9]|1[0-2])/(0[1-9]|[1-2][0-9]|3[0-1])$*",$date)) {
		$lock += 1;
	} else {
		$dobError = "Invalid format!";
	}
	if (!preg_match("/^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$/", $tempPost)) {
	    $postError = "Invalid format!";
	} else {
		$lock += 1;
	}
	if (!preg_match("/^([0-9]){1,2}$/",$tempTime)) {
	    $timeError = "Invalid format!";
	} else {
		$lock += 1;
	}
	//specific validation - DOB, postcode, timeframe -> if not exit script -> if yes write output 

	if ($lock == 4) {

		$stmt = $conn->prepare("SELECT serviceName FROM services WHERE timeFrame=? AND postcode=? and sgGroup=?");
		// create sql prepared statement

		$stmt->bind_param("iss", $timeFrame, $postcode, $sgGroup);
		// bind variables to prepared statement

		$dob = $tempDob;
		$postcode = substr($tempPost, 0, 2);
		$gender = $tempGend;
		$timeFrame = (int)$tempTime;
		$sgGroup = $tempSg;
		// set final query parameters

		$stmt->execute();
		// execute prepared statement

		$result = $stmt->get_result();
		// get query result 

		while ($row = $result->fetch_assoc()) {
			array_push($GLOBALS["response"], $row['serviceName']);
		}
		// get specific column from rows of result 

		$stmt->close();
		$conn->close();
		// close database connection and prepared statement 
	}
}

/*
function specificValidation ($regex, $cleanParameter, $error, $finalParameter) {
	if (!preg_match($regex, $cleanParameter)) {
	    $error = "Invalid format!";
		exit()
	} else {
		$finalParameter = $cleanParameter;
	}
}
// specific regex validation function
*/

function validateParameter($parameter) {
	$parameter = trim($parameter);
	$parameter = stripslashes($parameter);
	$parameter = htmlspecialchars($parameter);
	return $parameter;
}
// General validation function 

/*
function queryDatabase($query, $database) {
	global $result;
	foreach ($database as $key=>$value) {
		if ($key == $query) {
			$result = $value;
			break;
		}
	}
}
// simple database query function 
*/

?>

</body>
</html>