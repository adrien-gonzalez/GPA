$(document).ready(function (){
    $("body").on("click", "#validate_connect", function () { 


      if ($("#login").val() != "" && $("#password").val() != "")
      

{
    login = $("#login").val()  
    password = $("#password").val()  

    
    $.ajax({
            url: 'fonction_connexion.php',
            type: 'post',
            data: {login: login, password: password} ,

           
            success: function(response){ console.log(response)   
            }
        });
    }
    else{$('#login').css({"border":"1px solid #C0392B"})
   {$('#password').css({"border":"1px solid #C0392B"})
}
}
    }); 


});

