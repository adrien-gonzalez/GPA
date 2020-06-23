$( document ).ready(function() {

    image = getRandomInt(13)
    if(image < 10)
    {
        image = "0" + image
    }
    $("#background_log").css({"background-image" : "url(../img/formulaire/bg-"+image+".jpg)"})

    $("body").on("click", "#envoie_message_button", function () {

        if($("textarea").val() != "")
        {
           id_utilisateur_prive = $(".profil_user").attr("id")
           message = $("textarea").val()

           $.ajax({
            url: '../fonctions/fonction_messages.php',
            type: 'POST', 
            data: {message: message, id_utilisateur_prive: id_utilisateur_prive},  

            success: function(data){  
                location.href = "messages.php";
            }
        });
           $("textarea").val("")
        }
    });
    $("body").on("click", ".nom_prenom", function () {

        id_user = $(this).attr('id')
        window.location.href = "profil.php?id="+id_user+"";
    });
});




function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}

