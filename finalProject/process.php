<?php

session_start();

$mysqli = new mysqli('localhost', 'root','','demo') or die(mysqli_error($mysqli));

if (isset($_POST['save'])){
$artist = $_POST['artist'];
$song = $_POST['song'];
$platform = $_POST['platform'];
$review = $_POST['review'];

$mysqli->query("INSERT INTO data (artist, song, platform, review) VALUES('$artist', '$song', '$platform','$review')")or
	die($mysqli->error);
	
	$_SESSION['message'] = "Review has been saved!";
	$_SESSION['msg_type'] = "success";
	
	header("location: discover.php");

}
?>