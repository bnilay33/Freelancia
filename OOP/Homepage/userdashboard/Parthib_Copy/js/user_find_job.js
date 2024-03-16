/*function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
  
    if (dots.style.display === "none") {
      dots.style.display = "inline";
      btnText.innerHTML = "Read more"; 
      moreText.style.display = "none";
    } else {
      dots.style.display = "none";
      btnText.innerHTML = "Read less"; 
      moreText.style.display = "inline";
    }
  }
*/
const boxes = document.querySelectorAll('.box');
window.addEventListener('scroll',checkbox);
checkbox();
function checkbox(){
    const triggerBottom = window.innerHeight / 5 * 4;
    boxes.forEach(box => {
        const boxTop = box.getBoundingClientRect().top;
        if(boxTop < triggerBottom){
            box.classList.add('show');
        }else{
           box.classList.remove('show');
        }
    });  
  }


window.onscroll = function() {
  if(document.documentElement.scrollTop > 20){
    arrow.style.display = "block";
  }else{
    arrow.style.display = "none";
  }
}