<!DOCTYPE html>
<html>
<body>

<h1>Welcome to LevPress</h1><br />
<h2>Create a new page!</h2><br />

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
Page name: <input type="text" name="pageName">
<input type="submit">
</form>

<?php

$pages = array();

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$pageName = $_POST['pageName'];
	if (strlen($pageName) > 0) {
	$newPage = new page($pageName);
	echo json_encode($newPage);
	array_push($pages, $newPage); 
	//echoArray($pages);
	}
 }
 /*if post request is recieved, gets pageName parameter and uses it to create a new page
  which is stored in pages array*/

function echoArray($array){
	foreach($array as $item){
		echo json_encode($item);
	}
}

 class page {
	public $pageName;
	public $passwordProtected;
	public $style;
	public function _constructor ($pageName, $passwordProtected = false, $style = "standard") {
		$this->pageName = $pageName;
		$this->passwordProtected = $passwordProtected;
		$this->style = $style;
	}
	public function showPageName () {
		echo $this->pageName;
	}
 }
 // page class

?>

</body>
</html>