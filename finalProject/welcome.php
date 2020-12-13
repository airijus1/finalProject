<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: C:\xampp\htdocs\login.php");	
    exit;
}

    $conn = new mysqli('localhost', 'root', '', 'demo');

    if (isset($_POST['save'])) {
        $uID = $conn->real_escape_string($_POST['uID']);
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $ratedIndex++;

        if (!$uID) {
            $conn->query("INSERT INTO stars (rateIndex) VALUES ('$ratedIndex')");
            $sql = $conn->query("SELECT id FROM stars ORDER BY id DESC LIMIT 1");
            $uData = $sql->fetch_assoc();
            $uID = $uData['id'];
        } else
            $conn->query("UPDATE stars SET rateIndex='$ratedIndex' WHERE id='$uID'");

        exit(json_encode(array('id' => $uID)));
    }

    $sql = $conn->query("SELECT id FROM stars");
    $numR = $sql->num_rows;

    $sql = $conn->query("SELECT SUM(rateIndex) AS total FROM stars");
    $rData = $sql->fetch_array();
    $total = $rData['total'];

    $avg = $total / $numR;
?>


 <!DOCTYPE html>
<html>
<head>
<script
			src="https://code.jquery.com/jquery-3.5.1.min.js"
			integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			crossorigin="anonymous"></script>
			<link rel="stylesheet" href="av.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
			
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			
			
			<script src="https://kit.fontawesome.com/a076d05399.js"></script>			
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
			
</head>
<body>
<div class="container-fluid banner">
				<div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
							<a class="navbar-brand" href="#">
							<img src="AvocadoLogo1.JPG">
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
		 <!-- Masthead-->
		 
        <div class="col-md-12 text-center">
	<h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Avocado says Hello.</h1>
		</div>
		
		
		<div class="col-md-6 offset-md-3 info">
			<h1 class="text-center"> Welcome to Avocado Music</h1>
			<p class="text-center">
			Listen until your ears fall off
			</p>
			<br>
			<a type="button" class="btn btn-outline-light btn-lg" href="#listen">Listen Now</a>
		</div>
	</div>
</div>

<div id="listen">
				
				<div class="row padding">
					<div class="col-md-6">
						
							 <h1><iframe src="https://open.spotify.com/embed/artist/2tppd6KkhK4ULAd217Ecq1" width="100%" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe></h1>
							
						 
					</div>
					<div class="col-md-6">
						
							<h1><iframe src="https://open.spotify.com/embed/artist/5KNNVgR6LBIABRIomyCwKJ" width="100%" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe><h1>
							
						
					</div>
					
						
					
				</div>
			</div>
		
		<div id="listen2">
				
				<div class="row padding">
					<div class="col-md-6">
						
							 <h1><iframe src="https://open.spotify.com/embed/artist/6kiGJNxa3SvcQWfCrqL1sb" width="100%" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe></h1>
							
						
					</div>
					<div class="col-md-6">
						
							<h1><iframe src="https://open.spotify.com/embed/artist/6K0yc6ZGiwc7sSwrWra0UT" width="100%" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe><h1>
							<div class="div-body">
								
							
						 </div>
					</div>
				</div>
			</div>
			<div id="testOutput">
			</div>
			<div class="row padding">
				<div class = "col-md-12">
					<form>
					<center>
					<label><h4>Give us a Review</h4></label>
					<br></br>
						<i class="fa fa-star fa-2x" data-index="0"></i>
									<i class="fa fa-star fa-2x" data-index="1"></i>
									<i class="fa fa-star fa-2x" data-index="2"></i>
									<i class="fa fa-star fa-2x" data-index="3"></i>
									<i class="fa fa-star fa-2x" data-index="4"></i>
					<br></br>
						
				</div>
			</div>
			
			
	

	
	
	<script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js"></script>
	<script src="script.js"></script>
	<script>
	//Searialize
	serialize = function(obj) {
		var str = [];
		for (var p in obj)
			if(obj.hasOwnProperty(p)){
				str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
			}
			return str.join("&")
	}
	//Searialize
	//start auth for spotify and set it in a var called spotifyToken
		var spotifyToken = null;
		var  searchTerms = null;
		var settings = {
		"async": true,
		"crossDomain": true,
		"url": "https://accounts.spotify.com/api/token",
		"method": "POST",
		"headers": {
		"cookie": "__Host-device_id=AQBYn5YLaq9bovDweWT-n6g5ZlKPviq7qoSZArl6n7dOqsbKLGI4ikuNDAXXtlxwudgGXlremDZykK2iXJRdiGQIVD6Nsc_UZ_Q",
		"authorization": "Basic Y2Q0MjU2MmZlMDNhNDFjM2IxY2UxYThhOTk0ZTQzNzE6NDVjZDBkOGZlNTE4NDE2YTlkNDk2NjhjMDUxODc0ZTA=",
		"content-type": "application/x-www-form-urlencoded"
		},
		"data": {
		"grant_type": "client_credentials"
		}
		}

		$.ajax(settings).done(function (response) {
			spotifyToken = response.access_token;
		console.log(spotifyToken);
		});
	// end of getting spotify token		
	//Search Bar Script
	const songListSearch = document.getElementById('searchBoxId');
	songListSearch.addEventListener('keyup', (e) => {
		searchTerms = serialize({
			q: e.target.value.toLowerCase(),
			type: "track"
		})
		console.log(searchTerms);
	});
	// End Search Bar
	// Search Spotify
	function searchSpotify(){
		var settings = {
  "async": true,
  "crossDomain": true,
  "url": "https://api.spotify.com/v1/search?"+searchTerms,
  "method": "GET",
  "headers": {
    "authorization": "Bearer "+spotifyToken
  }
}

$.ajax(settings).done(function (response) {
	//Output For Search is 
  console.log(response);
  response.tracks.items.forEach(element => getTrackById(element.href));
});
	}
	//End Search Spotify
	//Get Specific Track
function getTrackById(id){
	var settings = {
  "async": true,
  "crossDomain": true,
  "url": id,
  "method": "GET",
  "headers": {
    "authorization": "Bearer "+spotifyToken
  }
}

$.ajax(settings).done(function (response) {
	console.log(response);
	var url = response.album.images[1].url;
	var height = response.album.images[1].height;
	var width = response.album.images[1].width;
	var name = response.name;
	var artist = response.artists[0].name;
	var link = response.external_urls.spotify;
  document.getElementById("testOutput").innerHTML += `<div><img class="myimg" onclick=${link} src=${url} width=${width} height=${height}><a href=${link}>${artist} - ${name}</a></div>`;
});
}
	//End Specific Track
	

	

	var ratedIndex = -1, uID = 0;

        $(document).ready(function () {
            resetStarColors();
				
				if (localStorage.getItem('ratedIndex') != null) {
                setStars(parseInt(localStorage.getItem('ratedIndex')));
                uID = localStorage.getItem('uID');
            }
           
            

           
			$('.fa-star').on('click', function () {
               ratedIndex = parseInt($(this).data('index')); 
				localStorage.setItem('ratedIndex', ratedIndex);			   
			      saveToTheDB();

            });

            $('.fa-star').mouseover(function () {
                resetStarColors();
                var currentIndex = parseInt($(this).data('index'));
                setStars(currentIndex);
            });

            $('.fa-star').mouseleave(function () {
                resetStarColors();

                if (ratedIndex != -1)
                    setStars(ratedIndex);
            });
        });

        function saveToTheDB() {
            $.ajax({
               url: "welcome.php",
               method: "POST",
               dataType: 'json',
               data: {
                   save: 1,
                   uID: uID,
                   ratedIndex: ratedIndex
               }, success: function (r) {
                    uID = r.id;
                    localStorage.setItem('uID', uID);
               }
            });
        }

        function setStars(max) {
            for (var i=0; i <= max; i++)
                $('.fa-star:eq('+i+')').css('color', 'green');
        }

        function resetStarColors() {
            $('.fa-star').css('color', 'white');
        }
	
	</script>
	    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
	
</body>

</html>


