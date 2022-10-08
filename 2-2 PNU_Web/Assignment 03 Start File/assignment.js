window.onload = function(){
    var artThumbsInputs = document.querySelectorAll(".artThumb");

    for (var i = 0; i < artThumbsInputs.length; i++) {
        artThumbsInputs[i].addEventListener("mouseover",function(){
            console.log(artThumbsInputs[i].replace(/^.*\//, ''))

        });
    }
    for (var i = 0; i < artThumbsInputs.length; i++) {
        artThumbsInputs[i].addEventListener("mouseout",function(){
            this.src="images/art/6.jpg"
        });
    }
    

}