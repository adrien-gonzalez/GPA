// function myFunction() {
//   document.getElementById("myDropdown").classList.toggle("show");
// }

// // Close the dropdown if the user clicks outside of it
// window.onclick = function(event) {
//   if (!event.target.matches('.dropbtn')) {
//     var dropdowns = document.getElementsByClassName("dropdown-content");
//     var i;
//     for (i = 0; i < dropdowns.length; i++) {
//       var openDropdown = dropdowns[i];
//       if (openDropdown.classList.contains('show')) {
//         openDropdown.classList.remove('show');
//       }
//     }
//   }
// }




// A $( document ).ready() block.
$( document ).ready(function() {
/*Dropdown Menu*/
$('.dropdown2').click(function () {
  console.log("ok")
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.dropdown2-menu').slideToggle(300);
    });
    $('.dropdown2').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.dropdown2-menu').slideUp(300);
    });
    $('.dropdown2 .dropdown2-menu li').click(function () {
        $(this).parents('.dropdown2').find('span').text($(this).text());
        $(this).parents('.dropdown2').find('input').attr('value', $(this).attr('id'));
    });
});