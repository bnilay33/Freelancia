// document.getElementById("openpopup").addEventListener("click",function() {
//   document.getElementById("myForm").style.display = "block";
// });

// function closeForm() {
//   document.getElementById("myForm").style.display = "none";
// }

$(document).ready(function(){
  $('.open-button').click(function(){
    $('.modal-box').toggleClass("show-modal");
    $('.open-button').toggleClass("show-modal");
  });
  $('.fa-times').click(function(){
    $('.modal-box').toggleClass("show-modal");
    $('.open-button').toggleClass("show-modal");
  });
  $('.closeForm').click(function(){
    $('.modal-box').toggleClass("show-modal");
    $('.open-button').toggleClass("show-modal");
  });

});



