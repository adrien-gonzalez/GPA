$(document).ready(function (){
    $("body").on("click", "#validate_connect", function () { 

        connexion()
    });
    $("body").on("focus", "input", function () { 

        $(window).on('keydown', function(e) {
          if (e.which == 13) {
            connexion()
          }
        });
    }); 
});


function connexion(){

    if ($("#login").val() != "" && $("#password").val() != "")
    {
        login = $("#login").val()  
        password = $("#password").val()          
        $.ajax({
            url: '../fonctions/fonction_connexion.php',
            type: 'POST',
            data: {login: login, password: password},        
                       
                success: function(data){ 

                     data=data.trim()
                    if(data == "erreur")
                    {                      
                        $(".champ_vide").remove()
                        $(".login100-form-title").after('<div class="champ_vide">*Login ou mot de passe inccorrect</div>')
                    }
                    else
                    {
                        document.location.href="../"; 
                    }
                }
        });
    }
    else
    {
        $('#login').css({"border":"1px solid #C0392B"})
        $('#password').css({"border":"1px solid #C0392B"})
        $(".champ_vide").remove()
        $(".login100-form-title").after('<div class="champ_vide">*Des champs sont vides</div>')
    }
}