window.onload = function(){
    var artThumbsInputs = document.querySelectorAll(".artThumb");
    
    for (var i = 0; i < artThumbsInputs.length; i++) {
        artThumbsInputs[i].addEventListener("mouseover",function(){
            var largerimg = document.createElement('span');
            var img = document.createElement('img');
            var temp = "";
            var path = "";
            var index=this.src.length-1;
            
            while (this.src[index] != '/'){
                temp+=this.src[index]
                index-=1
            }

            for (var j=temp.length-1; j>=0; j--){
                path+=temp[j]
            }

            img.setAttribute('src', './images/art/'+path)
            largerimg.appendChild(img)
            largerimg.style.margin = "1.5em";
            largerimg.style.padding = "0.5em";
            largerimg.style.border = "0.1em solid";
            largerimg.style.borderColor = "black";
            largerimg.style.backgroundColor = "white";
            largerimg.style.position = "absolute";

            this.parentNode.appendChild(largerimg)
        });
        artThumbsInputs[i].addEventListener("mouseout",function(){
            var largerimg = this.parentElement.getElementsByTagName('span');
            this.parentNode.removeChild(largerimg[0]);
        });
    }
}