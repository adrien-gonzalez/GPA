$(document).ready(function (){
	
	var old_image = $("#new_image").attr("src")

	// PARAMETRE USER
    var id_annonce = $("#panel").val()
    if(id_annonce != "")
    {
      $('.list-group-item').removeClass("active")
      $('#'+id_annonce).addClass("active")
    }

    // MODIF INFO PERSO
    $("body").on("click", "#change_information", function () { 
    	if($("#nom").val() != "" && $("#prenom").val() != "" && $("#adresse").val() != "")
    	{
    		nom = $("#nom").val()
    		prenom = $("#prenom").val()
    		adresse = $("#adresse").val()
    		naissance = $("#naissance").val()
    		genre = document.querySelector('input[name="genre"]:checked').value;

    		$.ajax({
		      	url : '../fonctions/fonction_parametre.php',
		       	type: 'POST',
		       	data: {nom: nom, prenom: prenom, adresse: adresse, naissance: naissance, genre: genre},
		     	
			    success:function(data)
				{
                    $(".form1").remove()
                    $(".limiter").append('<div class="confirm_message w-100 d-flex justify-content-center parametre_form"></div>')
                    $(".confirm_message").append('<div class="alert alert-success w-50" role="alert">Les informations ont bien été modifiées !</div>')
				}
			});
    	}
    	else
    	{
			if($("#nom").val() === "")
			{
				$('#nom').css({"border":"1px solid #C0392B"})
				$('#nom').attr("placeholder","*Veuillez entrer un nom")
            	$('#nom').addClass("erreur_form")
			}
			if($("#prenom").val() === "")
			{
				$('#prenom').css({"border":"1px solid #C0392B"})
				$('#prenom').attr("placeholder","*Veuillez entrer un prenom")
           		$('#prenom').addClass("erreur_form")
			}
			if($("#adresse").val() === "")
			{
				$('#adresse').css({"border":"1px solid #C0392B"})
				$('#adresse').attr("placeholder","*Veuillez entrer une adresse")
           		$('#adresse').addClass("erreur_form")
			}
    	}

    });
    // AFFICHAGE FORM MODIF EMAIL
    $("body").on("click", "#change_email", function () { 

        $(".form2-1").remove()
        $(".input-email").after('<div class="form2-1 email_change wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20 m-t-40"></div>')
        $(".email_change").append('<input id="email_update" class="form1 input100" type="email" name="email_update" placeholder="Nouvelle adresse" value="">')
        $("#email_update").after('<span class="form1 focus-input100"></span>')
        $(".email_change").after('<div class="form1 password_confirm login wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20"></div>')
        $(".password_confirm").append('<input id="password1" class="input100" type="password" name="password" placeholder="Mot de passe" value="">')
        $("#password1").after('<span class="form1 focus-input100"></span>')
        $(".password_confirm").after('<div class="form1 validate_modif login wrap-input100 rs1-wrap-input100 validate-input taille1"></div>')
        $(".validate_modif").append('<input type="button" id="modif_email" class="form1  login100-form-btn" value="Modifier">')

    });
    // CONFIRM MODIF
    $("body").on("click", "#modif_email", function () { 

      	if($("#email_update").val() != "" && $("#password1").val()) 
    	{
    		email = $("#email_update").val()
    		password = $("#password1").val()

    		if(checkEmail(email) == true)
    		{
    			$.ajax({
			      	url : '../fonctions/fonction_parametre.php',
			       	type: 'POST',
			       	data: {email: email, password: password},
			     	
				    success:function(data)
					{
						if(data === "wrong_pass")
						{
							$('#password1').css({"border":"1px solid #C0392B"})
							$('#password1').val("")
							$('#password1').attr("placeholder","*Mauvais mot de passe")
			            	$('#password1').addClass("erreur_form")		
						}
						if(data === "email already use")
						{
							$('#email_update').css({"border":"1px solid #C0392B"})
							$('#email_update').val("")
							$('#email_update').attr("placeholder","*Email déjà utilisé")
			            	$('#email_update').addClass("erreur_form")	
						}
						if(data === "")
						{
							$(".form2").remove()
	                    	$(".limiter").append('<div class="confirm_message w-100 d-flex justify-content-center parametre_form"></div>')
	                    	$(".confirm_message").append("<div class='alert alert-success w-50' role='alert'>L'adresse a bien été modifiée !</div>")
						}
					}
				});
    		}
    		else
    		{
    			$('#email_update').css({"border":"1px solid #C0392B"})
    			$("#email_update").val("")
				$('#email_update').attr("placeholder","*Format non valide")
            	$('#email_update').addClass("erreur_form")
    		}

    	}
    	else
    	{
			if($("#email_update").val() === "")
			{
				$('#email_update').css({"border":"1px solid #C0392B"})
				$('#email_update').attr("placeholder","*Veuillez remplir le champ")
            	$('#email_update').addClass("erreur_form")
			}
			if($("#password1").val() === "")
			{
				$('#password1').css({"border":"1px solid #C0392B"})
				$('#password1').attr("placeholder","*Veuillez remplir le champ")
            	$('#password1').addClass("erreur_form")
			}
    	}
    });

    // AFFICHAGE FORM MODIF PASSWORD
    $("body").on("click", "#change_password", function () { 

        $(".form3-1").remove()
        $(".input-password").after('<div class="form3-1 password_change wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20 m-t-40"></div>')
        $(".password_change").append('<input id="password_update" class="form1 input100" type="password" name="password_update" placeholder="Nouveaux mot de passe" value="">')
        $("#password_update").after('<span class="form1 focus-input100"></span>')
        $(".password_change").after('<div class="form1 password_confirm wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20"></div>')
        $(".password_confirm").append('<input id="password2" class="input100" type="password" name="password" placeholder="Ancien mot de passe" value="">')
        $("#password2").after('<span class="form1 focus-input100"></span>')
        $(".password_confirm").after('<div class="form1 validate_modif wrap-input100 rs1-wrap-input100 validate-input taille1"></div>')
        $(".validate_modif").append('<input type="button" id="modif_password" class="form1  login100-form-btn" value="Modifier">')
    });

    // CONFIRM PASSWORD CHANGE
    $("body").on("click", "#modif_password", function () { 

      	if($("#password_update").val() != "" && $("#password2").val() != "") 
    	{
    		password_update = $("#password_update").val()
    		password2 = $("#password2").val()

    		$.ajax({
		      	url : '../fonctions/fonction_parametre.php',
		       	type: 'POST',
		       	data: {password_update: password_update, password2: password2},
			     	
			    success:function(data)
				{
					if(data === "password to short")
					{
						$('#password2').css({"border":"1px solid #C0392B"})
						$('#password2').val("")
						$('#password2').attr("placeholder","*Mot de passe trop court")
			           	$('#password2').addClass("erreur_form")
					}
					if(data === "wrong_pass")
					{
						$('#password2').css({"border":"1px solid #C0392B"})
						$('#password2').val("")
						$('#password2').attr("placeholder","*Mauvais mot de passe")
			           	$('#password2').addClass("erreur_form")
					}
					if(data === "")
					{
						$(".form3").remove()
	                   	$(".limiter").append('<div class="confirm_message w-100 d-flex justify-content-center parametre_form"></div>')
	                   	$(".confirm_message").append("<div class='alert alert-success w-50' role='alert'>Le mot de passe a bien été modifié !</div>")
					}
				}
			});
    	}
    	else
    	{
			if($("#password_update").val() === "")
			{
				$('#password_update').css({"border":"1px solid #C0392B"})
				$('#password_update').attr("placeholder","*Veuillez remplir le champ")
            	$('#password_update').addClass("erreur_form")
			}
			if($("#password2").val() === "")
			{
				$('#password2').css({"border":"1px solid #C0392B"})
				$('#password2').attr("placeholder","*Veuillez remplir le champ")
            	$('#password2').addClass("erreur_form")
			}
    	}
    });

    // DELETE ACCOUNT
    $("body").on("click", "#delete_account", function () { 
    	
    	delete_account = true

    	$.ajax({
		      	url : '../fonctions/fonction_parametre.php',
		       	type: 'POST',
		       	data: {delete_account: delete_account},
			     	
			    success:function(data){
			    }
		});
    });
    // MODIF PHOTO PROFIL
    $("body").on("click", "#reset_change", function () { 

    	$("#new_image").attr("src",old_image)
  		$(".button_valid").remove()
  		$("#error_size").remove()
	});
	$("body").on("click", "#fileToUpload", function () { 
  		$("#error_size").remove()

	});
	$("body").on("click", "#valid_change", function () { 

  		$(".button_valid").remove()
  		$("#error_size").remove()
    	var fd = new FormData();
		var files = $('#fileToUpload')[0].files[0];
		fd.append('file',files);
		image_delete = old_image.substr(14)

		if(files != undefined)
		{
			$.ajax({
				url: '../fonctions/update_image.php',
				type: 'post',
				data: fd,
				contentType: false,
				processData: false,
				success: function(response){
						
						if(response === "too large")
						{
							$("#new_image").attr("src", "../img/profil/"+image_delete+"")
							$(".form_new_image").after("<div id='error_size' class='mt-3 alert alert-danger' role='alert'>Image trop grosse !</div>")
						}
						else
						{
							if(image_delete != "profil_defaut")
							{
								$.ajax({
									url:'../fonctions/update_image.php',
									type:'POST',
									data:{image_delete: image_delete},
									success:function(response){	
                    					document.location.reload(true);
									}
								});	
							}
						}
				}
			});
		}
	});
    $("#fileToUpload").change(function(){
 	
  		readURL(this);
  		$(".button_valid").remove()
  		$(".form_new_image").after('<div class="button_valid"></div>')
  		$(".button_valid").append('<button id="valid_change" class="button_design">Valider</button>')
  		$("#valid_change").after('<button id="reset_change" class="button_design">Annuler</button>')
	});
});


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#new_image').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
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