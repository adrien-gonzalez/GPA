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
    $("body").on("click", ".bi-star-fill", function () {

      id_star = $(this).attr('id')

      if($("#"+id_star).hasClass("add_favoris") === false)
      {
        $("#"+id_star).removeClass("none_favoris")
        $("#"+id_star).addClass("add_favoris")
        id_annonce = id_star.substr(5)
        data = {id_annonce: id_annonce}
        console.log("favori")
        add_favoris()
      }
      else
      {
        $("#"+id_star).removeClass("add_favoris")
        $("#"+id_star).addClass("none_favoris")
        id_annonce = id_star.substr(5)
        var del = true
        data = {id_annonce: id_annonce, del: del}
        console.log("non favori") 
        add_favoris()
      }
    });

    $("body").on("click", ".image_profil", function () {

    // element
    var id_annonce = $(this).attr('id');
    console.log(id_annonce)
    window.location.href = "sources/annonce.php?id="+id_annonce+"";




   
  });
});


function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}


function add_favoris(){

   $.ajax({
        url: 'fonctions/fonction_favoris.php',
        type: 'POST',  
        data: data,  
                   
        success: function(data){ 
        }
    });
}
