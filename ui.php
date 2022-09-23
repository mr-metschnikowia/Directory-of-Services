<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styleSheet.css">
</head>
<body>

<?php include "api.php"; ?>

<h1>Welcome to Lev's Directory of Services</h1><br /><br />
<h2>Make a query:</h2><br /><br />

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
DOB: <input type="text" name="dob" value="<?php echo $tempDob;?>">
<span class="error"> * <?php echo $dobError;?></span>
<br /><br />
Postcode: <input type="text" name="postcode" value="<?php echo $tempPost;?>">
<span class="error"> * <?php echo $postError;?></span>
<br /><br />
Time frame: <input type="text" name="timeFrame" value="<?php echo $tempTime;?>">
<span class="error"> * <?php echo $timeError;?></span>
<br /><br />

Symptom group:
<select name="sgGroup">
<option value="Cardiovascular" <?php if ($tempSg == "Cardiovascular") echo "selected"; ?>>Cardiovascular</option>
<option value="GI" <?php if ($tempSg == "GI") echo "selected"; ?>>GI</option>
<option value="Oncology" <?php if ($tempSg == "Oncology") echo "selected"; ?>>Oncology</option>
<option value="A&E" <?php if ($tempSg == "A&E") echo "selected"; ?>>A&E</option>
</select><br /><br />

Gender:
<input type="radio" <?php if (isset($tempGend) && $tempGend == "Male") { echo "checked"; } ?> name="gender" value="Male">Male
<input type="radio" <?php if (isset($tempGend) && $tempGend == "Female") { echo "checked"; } ?> name="gender" value="Female">Female
<input type="radio" <?php if (isset($tempGend) && $tempGend == "Other") { echo "checked"; } ?> name="gender"  value="Other">Other
<span class="error"> * <?php echo $genderError;?></span>
<br /><br /><br /><br />
<input type="submit"><br />
</form>
<!-- UI -->

<br /><br />
<h2>Best Services:</h2> 
<br />

<?php

foreach ($response as $service) { echo $service . "<br />"; }
// get best service based on database search
?>

</body>
</html>