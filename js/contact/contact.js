$( document ).ready(function() {

    $("body").on("click", "#send_message", function () { 

    	contact()
    });

});

function contact(){

	$("#nom").css({"border": "1px solid #E6E6E6"})
    $("#prenom").css({"border": "1px solid #E6E6E6"})
    $("#message").css({"border": "1px solid #E6E6E6"})
    $("#sujet").css({"border": "1px solid #E6E6E6"})
    $("#email").css({"border": "1px solid #E6E6E6"})

    if($("#nom").val() != "" && $("#prenom").val() != "" && $("#message").val() != "" && $("#sujet").val() != "" && $("#email").val() != "")
    {
    	nom = $("#nom").val()  
        prenom = $("#prenom").val()   
        message = $("#message").val()  
        email = $("#email").val() 
        sujet = $("#sujet").val() 

        $.ajax({
            url: '../fonctions/fonction_contact.php',
            type: 'POST',
            data: {nom: nom, prenom: prenom, message: message, sujet: sujet, email: email},        
                       
                success: function(data){ 

                    $(".limiter ").remove()
                    $("#content").append('<div class="confirm_message w100 d-flex justify-content-center"></div>')
                    $(".confirm_message").append('<div class="alert alert-success w-50" role="alert">Le message a bien été envoyé !</div>')
                }
        });
    }
    else
    {
    	if($("#nom").val() == "")
    	{
        	$('#nom').css({"border":"1px solid #C0392B"})
    	}
    	if($("#prenom").val() == "")
    	{
        	$('#prenom').css({"border":"1px solid #C0392B"})
    	}
    	if($("#message").val() == "")
    	{
        	$('#message').css({"border":"1px solid #C0392B"})
    	}
    	if($("#sujet").val() == "")
    	{
        	$('#sujet').css({"border":"1px solid #C0392B"})
    	}
        if($("#email").val() == "")
        {
            $('#email').css({"border":"1px solid #C0392B"})
        }
        $(".champ_vide").remove()
        $(".login100-form-title").after('<div class="champ_vide">*Des champs sont vides</div>')
    }
}