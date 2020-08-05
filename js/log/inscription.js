$(document).ready(function (){
	$("body").on("click", "#validate_register", function () {

		inscription()
	});
	$("body").on("focus", "input", function () { 

        $(window).on('keydown', function(e) {
          if (e.which == 13) {
            inscription()
          }
        });
    }); 
	$("body").on("click", "#delete_fichier", function () {

		$('#name_fichier').remove()
		$('#delete_fichier').remove()
		$('#uploadImg').attr('src', "")
		$('#uploadImg').addClass("hidden")
		$("#label_image").css({"display" : "inherit"})
		$("#label_image").text("Sélectionner une image")
		$("#upload").attr("value", "Rechercher")
		$('#fileToUpload').val("")
		
	});
});


// AFFICHAGE IMAGE 
$(function(){
		
		var container = $('.container2'), inputFile = $('#fileToUpload'), img, btn, txt = 'Rechercher', txtAfter = "Changer d'image";
			
		if(!container.find('#upload').length){
			container.find('.input').append('<input type="button" value="'+txt+'" id="upload">');
			btn = $('#upload');
			container.prepend('<img src="" class="hidden m-b-20" alt="Uploaded file" id="uploadImg" width="80" height="80">');
			img = $('#uploadImg');
		}			
		btn.on('click', function(){
			img.animate({opacity: 0}, 300);
			inputFile.click();
		});
		inputFile.on('change', function(e){

			$("#image_none").remove()
			var upload = 0
			taille = $('#fileToUpload').val().length

			if(taille > 0)
			{
				type = document.getElementById('fileToUpload').files[0].type
			}
			else
			{
				container.prepend("<div id='image_none'>Aucne image</div>")
			}
			image_size = document.getElementById('fileToUpload').files[0].size
			valid_extensions = $('#fileToUpload').attr("accept");
			if(type.substr(0, 5) == valid_extensions.substr(0, 5))
			{
				upload = 1
			}
			if(upload  == 1 && image_size < 1000000)
			{		
				$("#label_image").css({"display" : "none"})	
				$("#erreur_format").remove()

				container.find('label').html( inputFile.val() );
				var i = 0;
				for(i; i < e.originalEvent.srcElement.files.length; i++) {
					var file = e.originalEvent.srcElement.files[i], 
						reader = new FileReader();

					reader.onloadend = function(){
						img.attr('src', reader.result).animate({opacity: 1}, 700);
					}
					reader.readAsDataURL(file);
					img.removeClass('hidden');
				}		
				btn.val( txtAfter );
			}
			else
			{
				if(upload != 1)
				{
					$("#label_image").text("Mauvais format")
					$("#image_none").remove()
					$("#label_image").css({"display" : "inherit"})
					img.addClass('hidden');
				}
				else if(image_size > 1000000)
				{
					$("#label_image").text("Image trop grosse !")
					$("#image_none").remove()
					$("#label_image").css({"display" : "inherit"})
					img.addClass('hidden');
				}
			}
		});
});

function inscription(){

		$(".wrap-input100").css({"border": "solid 1px #E6E6E6"})
		$(".genre").css({"color" : "black"})
		if($("#nom").val() != "" && $("#prenom").val() != "" && $("#adresse").val() != "" && 
		   checkEmail($("#email").val()) == true && $("#naissance").val() != "" && $("#login").val() != "" && 
		   $("#password1").val() != "" && $("#password2").val() != "" && 
		   $('#homme').is(':checked') || $('#femme').is(':checked') )
		{
				$(".champ_vide").remove()
				genre     = document.querySelector('input[name="genre"]:checked').value;
				nom 	  = $("#nom"      ).val()
				prenom    = $("#prenom"   ).val()
				adresse   = $("#adresse"  ).val()
				email  	  = $("#email"    ).val()
				naissance = $("#naissance").val()
				login     = $("#login"    ).val()
				password1 = $("#password1").val()
				password2 = $("#password2").val()
			
				$.ajax({
		      	url : '../fonctions/fonction_inscription.php',
		       	type: 'POST',
		       	data: {genre: genre, nom: nom, prenom: prenom, adresse: adresse, email: email, naissance: naissance,
		       			login: login, password1: password1, password2: password2},
		     	
			    success:function(data)
				{
					if(data == "ok")
					{
						var fd = new FormData();
					    var files = $('#fileToUpload')[0].files[0];
					    fd.append('file',files);

					    if(files != undefined)
					    {
					    	$.ajax({
							    url: '../fonctions/upload_inscription.php',
						        type: 'post',
						        data: fd,
						        contentType: false,
						        processData: false,
						        success: function(response){		        	
						        }
							});
					    }
                        document.location.href="connexion.php"; 
					}
					else
					{
						var nbr_erreurs=1;
						for(i=0; i<Object.keys(data).length;i++)
						{
							if(data[i] === ",")
							    {
							        nbr_erreurs++;
							    }
						}
						var result = JSON.parse(data); 
						$("svg").remove()
						for(j=0;j < nbr_erreurs; j++ )
						{
							var champ = Object.keys(result)[j]								
							if(champ == "Character")
							{
								$("#login").val("");
								$('.login').css({"border":"1px solid #C0392B"})
								$("#login").after('<svg  type="button"  data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Caractères spéciaux non autorisés." class="bi bi-info-circle-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>')
								$('[data-toggle="popover"]').popover()
							}
							if(champ == "Login_exist")
							{
								$("#login").val("");
								$('.login').css({"border":"1px solid #C0392B"})
								$("#login").after('<svg  type="button"  data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Login déjà existant." class="bi bi-info-circle-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>')
								$('[data-toggle="popover"]').popover()
							}
							if(champ == "Email")
							{
								$("#email").val("");
								$('.email').css({"border":"1px solid #C0392B"})
								$("#email").after('<svg  type="button"  data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Cet email est déjà utilisé." class="bi bi-info-circle-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>')
								$('[data-toggle="popover"]').popover()
							}
							if(champ == "Login_short")
							{
								$("#login").val("");
								$('.login').css({"border":"1px solid #C0392B"})
								$("#login").after('<svg  type="button"  data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Login trop court (5 caractères minimum)." class="bi bi-info-circle-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>')
								$('[data-toggle="popover"]').popover()
							}
							if(champ == "Password1")
							{
								$("#password1").val("");
								$('.password1').css({"border":"1px solid #C0392B"})
								$("#password1").after('<svg  type="button"  data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Mot de passe trop court (8 caractères minimum)." class="bi bi-info-circle-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>')
								$('[data-toggle="popover"]').popover()
							}
							if(champ == "Password2")
							{
								$("#password2").val("");
								$('.password2').css({"border":"1px solid #C0392B"})
								$("#password2").after('<svg  type="button"  data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Les mots de passe sont différents" class="bi bi-info-circle-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>')
								$('[data-toggle="popover"]').popover()
							}
						}
					}
				}	
		    });
		}
		else
		{
			$("svg").remove()
			$(".champ_vide").remove()
			$(".login100-form-title").after('<div class="champ_vide">*Des champs sont vides</div>')
			if($('#homme').is(':checked') || $('#femme').is(':checked')){
			}
			else
			{
				$('.genre').css({"color":"#C0392B"})
			}
			if($("#nom").val() === "")
			{
				$('.nom').css({"border":"1px solid #C0392B"})
			}
			if($("#prenom").val() === "")
			{
				$('.prenom').css({"border":"1px solid #C0392B"})
			}
			if($("#adresse").val() === "")
			{
				$('.adresse').css({"border":"1px solid #C0392B"})
			}
			if(checkEmail($("#email").val()) === false)
			{
				$('.email').css({"border":"1px solid #C0392B"})
				$('#email').val("")
				$('#email').attr("placeholder","*Mauvais format d'email")
			}
			if($("#naissance").val() === "")
			{
				$('.naissance').css({"border":"1px solid #C0392B"})
			}
			if($("#login").val() === "")
			{
				$('.login').css({"border":"1px solid #C0392B"})
			}
			if($("#password1").val() === "")
			{
				$('.password1').css({"border":"1px solid #C0392B"})
			}
			if($("#password2").val() === "")
			{
				$('.password2').css({"border":"1px solid #C0392B"})
			}
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