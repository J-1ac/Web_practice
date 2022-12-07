
var allImages; 
var imageIndex=0;

$(document).ready(function(){
	
	allImages = $(".galleryImage");
	var canvas = $("#gallery");
	
	canvas.append("<div id='leftGallery'></div><div id='rightGallery'></div>");
	canvas.append("<div id='picLeft' class='galleryPic'></div><div id='picCenter' class='galleryPic'></div><div id='picRight' class='galleryPic'></div>");	
	
	var leftButton = $('#leftGallery');
	var rightButton = $('#rightGallery');
	leftButton.on("click",goRight);
	rightButton.on("click",goLeft);
	moveToIndex();
	
	function goLeft(){
		// decrease imageIndex value + add sliding animation
		if (imageIndex!=0) imageIndex--;
		else imageIndex=3;
		
		$("#picRight").fadeOut("slow", function(){
			$("#picLeft").animate({
				left: '27%'
			}, 1500, 'linear' );
			$("#picCenter").animate({
				left: '27%'
			}, 1500, 'linear', function(){
				$("#picLeft").wrap("<div id='picLeft' class='galleryPic'></div>");
				$("#picCenter").wrap("<div id='picCenter' class='galleryPic'></div>");
				$("#picRight").wrap("<div id='picRight' class='galleryPic'></div>");
				moveToIndex();
			});
		});
	}
	function goRight(){
		// increase imageIndex value + add sliding animation
		if (imageIndex!=3) imageIndex++;
		else imageIndex=0;
		
		$("#picLeft").fadeOut("slow", function(){
			$("#picLeft").wrap("<div id='picLeft' class='galleryPic' style='visibility: hidden; vertical-align: middle;'></div>");
			$("#picLeft").animate({
				right: '27%'
			}, 1500, 'linear' );
			$("#picRight").animate({
				right: '27%'
			}, 1500, 'linear' );
			$("#picCenter").animate({
				right: '27%'
			}, 1500, 'linear', function(){
				$("#picLeft").wrap("<div id='picLeft' class='galleryPic'></div>");
				$("#picCenter").wrap("<div id='picCenter' class='galleryPic'></div>");
				$("#picRight").wrap("<div id='picRight' class='galleryPic'></div>");
				moveToIndex();
			});
		});
	}	
	function moveToIndex(){
		// display the 3 images + add span to print "title" of a center image
		$("#picLeft").empty();
		$("#picCenter").empty();
		$("#picRight").empty();
		var imageindex_left=imageIndex;
		var imageindex_right=imageIndex;
		var myimage=allImages.clone()

		if (imageIndex==0){
			imageindex_left=3; imageindex_right++;
		}else if (imageIndex==3){
			imageindex_right=0; imageindex_left--;
		}else{
			imageindex_left--; imageindex_right++;
		}

		$("#picLeft").append(myimage[imageindex_left]);
		$("#picCenter").append(myimage[imageIndex]);
		$("#picCenter").append("<br><span style='background-color:white; padding: 0.5em;'>" + myimage[imageIndex].title + "</span>");
		$("#picRight").append(myimage[imageindex_right]);

		$(".galleryPic").css('text-align', 'center');
		$(".galleryPic").css('vertical-align', 'middle');
		$(".galleryPic").css('top', '5em');		
 	}
	
});

