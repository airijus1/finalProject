<!DOCTYPE html>
<html>
<head>
<script
			src="https://code.jquery.com/jquery-3.5.1.min.js"
			integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			
			
			
			<script src="https://kit.fontawesome.com/a076d05399.js"></script>			
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container-fluid banner">
				<div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-expand-lg navbar-light fixed-top">
							<a class="navbar-brand" href="#">
							<img src="reviewsystem\AvocadoLogo.png">
							</a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#"> Home<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="playList.html">Playlists</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="discover.php">Reviews</a>
						</li>
						<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Moods
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="happy.html">Happy</a>
          <a class="dropdown-item" href="sad.html">Sad</a>
          <a class="dropdown-item" href="calm.html">Calm</a>
		  <a class="dropdown-item" href="energetic.html">Energetic</a>
        </div>
      </li>
						<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Settings
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">Logout</a>
		  <a class="dropdown-item" href="settings.html">Settings</a>
          
        </div>
      </li>
					</ul>
					<form class="form-inline my-2 my-lg-0">
						<input class="form-control mr-sm-2" type="search" id="searchBoxId" placeholder="Search" aria-label="Search">
						<a class="btn btn-outline-success my-2 my-sm-0" onclick="searchSpotify()">Search</a>
					</form>
				</div>
			</nav>
		</div>
		<br></br>
		<br></br>
<?php require_once 'process.php';?>

<?php 
if(isset($_SESSION['message'])):?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php 
echo $_SESSION['message'];
unset($_SESSION['message']);
?>
</div>
<?php endif ?>


<div class="container">
<?php
	$mysqli = new mysqli('localhost', 'root','','demo') or die(mysqli_error($mysqli));
	$result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
	
	
	?>
	
	<div class="row justify-content-center">
		<table class="table">
			<thead>
				<tr>
					<th>Artist</th>
					<th>Song</th>
					<th>Platform</th>
					<th>Review</th>
				</tr>
			</thead>
			<?php
			while ($row = $result->fetch_assoc()):?>
			<tr>
				<td><?php echo $row['artist'];?></td>
				<td><?php echo $row['song'];?></td>
				<td><?php echo $row['platform'];?></td>
				<td><?php echo $row['review'];?></td>
			</tr>
			<?php endwhile; ?>
		</table>
	</div>
	
	<?php
	function pre_r($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	}

?>
<br></br>
<div class="row justify-content-center">
	<form action="process.php" method="POST">
	<div class="form-group">
	<label>Artist</label>
		<input type="text" name="artist" class="form-control" value="Enter artists name">
	</div>
	<div class="form-group">
	<label>Song</label>
		<input type="text" name="song" class="form-control" value="Enter artists song">
	</div>
	<div class="form-group">
	<label>Platform</label>
		<input type="text" name="platform" class="form-control" value="Enter Platforms you listened on">
	</div>
	<div class="form-group">
	<label>Review</label>
		<input type="text" name="review" class="form-control" value="Enter your Review">
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-primary" name="save">Save</button>
	</div>
	</form>
	</div>
	</div>
</body>
</html>