/*!
    * Start Bootstrap - Grayscale v6.0.2 (https://startbootstrap.com/themes/grayscale)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-grayscale/blob/master/LICENSE)
    */
	
	
    (function ($) {
    "use strict"; // Start of use strict

    // Smooth scrolling using jQuery easing
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (
            location.pathname.replace(/^\//, "") ==
                this.pathname.replace(/^\//, "") &&
            location.hostname == this.hostname
        ) {
            var target = $(this.hash);
            target = target.length
                ? target
                : $("[name=" + this.hash.slice(1) + "]");
            if (target.length) {
                $("html, body").animate(
                    {
                        scrollTop: target.offset().top - 70,
                    },
                    1000,
                    "easeInOutExpo"
                );
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $(".js-scroll-trigger").click(function () {
        $(".navbar-collapse").collapse("hide");
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $("body").scrollspy({
        target: "#mainNav",
        offset: 100,
    });

    // Collapse Navbar
    var navbarCollapse = function () {
        if ($("#mainNav").offset().top > 100) {
            $("#mainNav").addClass("navbar-shrink");
        } else {
            $("#mainNav").removeClass("navbar-shrink");
        }
    };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
})(jQuery); // End of use strict

var tracks,players=[];
	
	document.addEventListener("DOMContentLoaded",function(event){
		//1.play button
		document.getElementbyId("playBtn").addEventListener("click",function(){
			playTrack(currentSong);
			console.log("test")
		});

		//2.pause button
		document.getElementById("pauseBtn").addEventListener("click",function(){
			players[currentSong].pause();
		});
		
		//3.stop button
		document.getElementById("stopBtn").addEventListener("click",function(){
			players[currentSong].pause();
			players[currentSong].seek(0);
		});
		
		//4.next button
		document.getElementById("forwardBtn").addEventListener("click",function(){
			currentSong++;
			if(currentSong>=tracks.length){
				currentSong=0;
			}
				playTrack(currentSong);
			});
		
		//5.previous button
		document.getElementById("rewindBtn").addEventListener("click",function(){
			currentSong--;
			if(currentSong<0){
				currentSong=tracks.length-1;
			}
			playTrack(currentSong);
		});
	});
	
		//6.Soundcloud API Streaming of songs
		
		SC.initialize({
			client_id:'2876adf40e30f73eb3cfe0af77f33a77d'
		});
		
		document.addEventListener("DOMContentLoaded",function(){
			console.log("content loaded")
			document.querySelector("form").addEventListener("submit",function(event){
				event.preventDefault()
				console.log(event)
				SC.get("/tracks",{
					q:document.getElementById("input").value
				}).then(function(response){
					console.log(response);
					tracks=response;
				document.getElementById("description").innerHTML=tracks[currentSong].title+tracks[currentSong].genre+tracks[currentSong].permalink+tracks[currentSong].description
				document.getElementById("artwork").src=tracks[currentSong].artwork_url||"http://"+q+".jpg.to"
				playTrack(currentSong);
				});
			});
		});
		
		var localTracks=[46833586,46834546]
		var currentSong=0;
		function playTrack(songId){
			document.getElementById("description").innerHTML=tracks[currentSong].title+"."+"Genre:"+tracks[currentSong].genre+"."+tracks[currentSong]permalink + tracks[currentSong].description
			
			if(!players[songId]){
				SC.stream('/tracks/'+tracks[songId].Id).then(function(player){
					console.log(player);
					players.log(player);
					players[songId]=player;
					players[songId].play();
				});
			}else{
				players[songId].play();
			}
		}
		
		//stop
		function stopAudio2(){
			players[currentSong].seek(0);
			players[currentSong].pause();
		}
		
		//play
		function playAudio2(){
			players[currentSong].play();
		};
		
		//forward
		function forwardAudio2(){
			stopAudio2();
			currentSong+=1;
			players[currentSong].play();
		};
		
		//rewind
		function rewindAudio(){
			stopAudio();
			currentSong=-1;
			players[currentSong].play();
		}
		
		//volume slider
		function SetVolume(val){
			var player=tracks[currentSong];
			player.volume=val/100;
			console.log('After:'player.volume);
			players[currentSong].setVolume(player.volume);
			
		}
