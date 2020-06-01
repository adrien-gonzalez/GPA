$( document ).ready(function() {

    // MENU DEROULANT ACCUEIL
    $('.dropdown2').click(function () {

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


        image = getRandomInt(13)
        if(image < 10)
        {
            image = "0" + image
        }
        $("#background_log").css({"background-image" : "url(../img/formulaire/bg-"+image+".jpg)"})


    $("body").on("click", "#envoyer_message", function () {

        window.location.href = "messages.php";
    });
});


function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}

