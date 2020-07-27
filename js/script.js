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
      url = $('#lien_fonction').val()

      if($("#"+id_star).hasClass("add_favoris") === false)
      {
        $("#"+id_star).removeClass("none_favoris")
        $("#"+id_star).addClass("add_favoris")
        id_annonce = id_star.substr(5)
        data = {id_annonce: id_annonce}
        add_favoris()
      }
      else
      {
        $("#"+id_star).removeClass("add_favoris")
        $("#"+id_star).addClass("none_favoris")
        id_annonce = id_star.substr(5)
        var del = true
        data = {id_annonce: id_annonce, del: del}
        add_favoris()
      }
    });

  $("body").on("click", ".image_profil", function () {

    // element
    var id_annonce = $(this).attr('id');
    window.location.href = "sources/annonce.php?id="+id_annonce+""; 
  });

  $("body").on("click", ".liste_annonces_poste", function () {

    id= $(this).attr("id")
    location.href = "annonce.php?id="+id+"";
  });

  $("body").on("click", ".send_message", function () {

    id_annonce = $(this).attr("id")
    window.location.href = "envoie_messages.php?annonce="+id_annonce+""; 
  });
  
  $("body").on("mouseover", ".liste_annonces_poste", function () {

    id_annonce = $(this).attr('id')
    $('#type_'+id_annonce).css({"text-decoration":"underline", "color": "#17A681", "transition" : "0.2s"})
  });
   
  $("body").on("mouseout", ".liste_annonces_poste", function () {

    id_annonce = $(this).attr('id')
    $('#type_'+id_annonce).css({"text-decoration":"none", "color": "black"})
  });

  // PARTAGER PROFIL USER VIA EMAIL
  $("body").on("click", "#partager_email", function () {

      if($("#email").val() != "")
      {
        email = $("#email").val()
        url_user = $("#url_user").val()

        if(checkEmail(email) === true)
        {
            $.ajax({
            url: '../fonctions/fonction_share.php',
            type: 'POST', 
            data: {email: email, url_user: url_user},  

            success: function(data){  
              document.location.reload(true);
            }
          }); 
        }
        else
        {
          $('#email').css({"border":"1px solid #C0392B"})
          $("#email").val("")
          $('#email').attr("placeholder", "*Veuillez entrer un format correct (ex: dupont@gmail.com)")
          $('#email').addClass("erreur_form")
        }
      }
      else
      {
        $('#email').css({"border":"1px solid #C0392B"})
      }
  });
});


function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}


function add_favoris(){

   $.ajax({
        url: url,
        type: 'POST',  
        data: data,  
                   
        success: function(data){ 
        }
    });
}


function checkEmail(email) {
             var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
             return re.test(email);
}

function validate(email) {
         
    if (checkEmail(email)) {
        alert('Adresse e-mail valide');
    }
    else
    {
        alert('Adresse e-mail non valide');
    }
        return false;
}
