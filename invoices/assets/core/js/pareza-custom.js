/* Parezapay custom js*/
//var dropdown = document.getElementsByClassName("dropdown-btn");
//var i;
//
//for (i = 0; i < dropdown.length; i++) {
//	debugger;
//  dropdown[i].addEventListener("click", function() {
//  this.classList.toggle("active");
//  var dropdownContent = this.nextElementSibling;
//  if (dropdownContent.style.display === "block") {
//  dropdownContent.style.display = "none";
//  } else {
//  dropdownContent.style.display = "block";
//  }
//  });
//}

$(document).ready(function(){
  $(".dropdown-btn").click(function(){
	  $(this).parent().find('.dropdown-menu').toggleClass('showHeight');
  });
});