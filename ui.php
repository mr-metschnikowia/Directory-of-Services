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
DOB: <input type="text" name="dob" value="<?php echo $dob;?>">
<span class="error"> * <?php echo $dobError;?></span>
<br /><br />
Postcode: <input type="text" name="postcode" value="<?php echo $postcode;?>">
<span class="error"> * <?php echo $postError;?></span>
<br /><br />
Time frame: <input type="text" name="timeFrame" value="<?php echo $timeFrame;?>">
<span class="error"> * <?php echo $timeError;?></span>
<br /><br />

Symptom group:
<select name="sgGroup">
<option value="Cardiovascular" <?php if ($sgGroup == "Cardiovascular") echo "selected"; ?>>Cardiovascular</option>
<option value="GI" <?php if ($sgGroup == "GI") echo "selected"; ?>>GI</option>
<option value="Oncology" <?php if ($sgGroup == "Oncology") echo "selected"; ?>>Oncology</option>
<option value="A&E" <?php if ($sgGroup == "A&E") echo "selected"; ?>>A&E</option>
</select><br /><br />

Gender:
<input type="radio" <?php if (isset($gender) && $gender == "Male") echo "checked"; ?> name="gender">Male
<input type="radio" <?php if (isset($gender) && $gender == "Female") echo "checked"; ?> name="gender">Female
<input type="radio" <?php if (isset($gender) && $gender == "Other") echo "checked"; ?> name="gender">Other<br /><br /><br /><br />
<input type="submit"><br />
</form>
<!-- UI -->

</body>
</html>