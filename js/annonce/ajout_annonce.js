var nbr_lettre_max = 2000

$( document ).ready(function() {
	
	$(".nombre_caractere").text("0/"+nbr_lettre_max)
	var input = document.getElementById ("descriptif");
    input.maxLength = nbr_lettre_max
	$('#descriptif').keyup(function() {
 		$('#descriptif').css({"border" : "1px solid #e6e6e6"})

 		text = $('#descriptif').val().replace(/ /g,"")
	    nombreCaractere = text.length;
	    // var nombreMots = jQuery.trim($(this).val()).split(' ').length;
	    // if($(this).val() === '') {
	    //  	nombreMots = 0;
	    // }
		$(".nombre_caractere").text(nombreCaractere+"/"+nbr_lettre_max)

	});

	$("body").on("click", "#delete_fichier", function () {

		$('#name_fichier').remove()
		$('#delete_fichier').remove()
		$('#uploadImg').attr('src', "")
		$('#uploadImg').addClass("hidden")
		$("#label_image").css({"display" : "inherit"})
		$("#label_image").text("Mon attestation (obligatoire) :")
		$("#upload").attr("value", "Télécharger mon attestation")
		$('#fileToUpload').val("")
		
	});

	$("body").on("click", "#validate_annonce", function () {
		
		ajout_annonce()
	});
	$("body").on("focus", "input", function () { 

        $(window).on('keydown', function(e) {
          if (e.which == 13) {
            ajout_annonce()
          }
        });
    }); 
});


// AFFICHAGE FICHIER PDF 
$(function(){
		
		var container = $('#container2'), inputFile = $('#fileToUpload'), img, btn, txt = 'Télécharger mon attestation', txtAfter = "Changer de fichier";
				
		if(!container.find('#upload').length){
			container.find('.input').append('<input type="button" value="'+txt+'" id="upload">');
			btn = $('#upload');
			$(".affichage_image").append('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="80">');
			img = $('#uploadImg');
		}			
		btn.on('click', function(){
			inputFile.click();

		});
		inputFile.on('change', function(e){

			taille = $('#fileToUpload').val().length
			
			if(taille > 0)
			{
				name = document.getElementById('fileToUpload').files[0].name
				type = document.getElementById('fileToUpload').files[0].type
				file_info = $('#fileToUpload')[0].files[0];
			}

			valid_extensions = $('#fileToUpload').attr("accept");


			if(type == valid_extensions)
			{		
				$("#label_image").css({"display" : "none"})	
				$("#erreur_format").remove()
				$("#name_fichier").remove()
				$("#delete_fichier").remove()
				if(name.length > 30)
				{
					$('#uploadImg').after("<div id='name_fichier'>"+name.substr(0,30)+"</div>")
				}
				else
				{
					$('#uploadImg').after("<div id='name_fichier'>"+name+"</div>")
				}
				$("#name_fichier").after('<input id="delete_fichier" type="button" class="responsive_button login100-form-btn" value="Supprimer">')
				container.find('label').html( inputFile.val() );
				var i = 0;
				for(i; i < e.originalEvent.srcElement.files.length; i++) {
					
					var file = e.originalEvent.srcElement.files[i], 
					reader = new FileReader();
					reader.onloadend = function(){
						img.attr('src', "../img/attestations/logo_pdf.png").animate({opacity: 1}, 700);
					}
					reader.readAsDataURL(file);
					img.removeClass('hidden');
				}		
					btn.val( txtAfter );
				}
			else
			{
				$("#name_fichier").remove()
				$("#label_image").text("Mauvais format")
				$("#label_image").css({"display" : "inherit"})
				img.addClass('hidden');
			}
		});
});

function validatePhone(num){
				
	if(num.indexOf('+33')!=-1) num = num.replace('+33', '0');
		var re = /^0[1-7]\d{8}$/;
		return re.test(num)
}


function ajout_annonce(){

	$("svg").remove()
	$("#attestation").css({"border":"1px solid #e6e6e6"})
	$("#region").css({"border":"1px solid #e6e6e6"})
	$("#tel").css({"border":"none"})
	$("#prix").css({"border":"none"})
	$("#label").css({"color":"#1a4756"})
	$('.dispo').css({"color":"#1a4756"})
	$("#dispo_annonce").css({"color":"#1a4756"})
	$('.statut').css({"color":"#1a4756"})
	$("#statut_annonce").css({"color":"#1a4756"})


		if($("#attestation").val() != "0" && $("#region").val() != "0" && $("#descriptif").val().length >= 150 &&
		   $("#name_fichier").text() != "" && $("#tel").val() != "" && $("#prix").val() != "" && ($('#immediate').is(':checked') || $('#3mois').is(':checked'))
		    && ($('#associe').is(':checked') || $('#salarie').is(':checked') || $('#externe').is(':checked')))
		{
			if(validatePhone($("#tel").val()) == true)
			{
				$(".wrap-login100").remove()


				// var chemin = window.location.pathname
				sessionStorage.setItem("option","ok")
				document.location.href="option.php"

				// type 		= $("#attestation").val()
				// region 		= $("#region").val()
				// descriptif 	= $("#descriptif").val()
				// tel 		= $("#tel").val()
				// prix 		= $("#prix").val()
				// disponibilite = document.querySelector('input[name="dispo"]:checked').value;
				// statut = document.querySelector('input[name="statut"]:checked').value;

				// $.ajax({
    //                 url: '../fonctions/fonction_ajout_annonce.php',
    //                 type: 'POST',
    //                 data: {type: type, region: region, descriptif: descriptif, tel: tel, prix: prix, disponibilite: disponibilite, statut: statut},        
                   
    //                 success: function(data){             	
    //                 	if(data == "ok")
				// 		{
				// 			var fd = new FormData();
				// 		    var files = file_info;
				// 		    fd.append('file',files);

				// 		    if(files != undefined)
				// 		    {
				// 		    	$.ajax({
				// 				    url: '../fonctions/upload_documentpdf.php',
				// 			        type: 'post',
				// 			        data: fd,
				// 			        contentType: false,
				// 			        processData: false,
				// 			        success: function(response){
				// 			        console.log(response)			        	
				// 			        }
				// 				});
				// 		    }
				// 		    window.location.href = "../";
				// 		}  
    //                 }
    //             });
			}
			else
			{
				$('#tel').css({"border":"1px solid #C0392B"})
				$("#tel").after('<svg  type="button"  data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Veuillez entrer un bon format" class="bi bi-info-circle-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>')
				$('[data-toggle="popover"]').popover()
			}
		}
		else
		{
			$("svg").remove()
			$(".login100-form-title").after('<div class="champ_vide">*Veuillez compléter les champs</div>')
			if($('#associe').is(':checked') || $('#salarie').is(':checked') || $('#externe').is(':checked')){
			}
			else
			{
				$('.statut').css({"color":"#C0392B"})
				$("#statut_annonce").css({"color":"#C0392B"})
			}
			if($('#3mois').is(':checked') || $('#immediate').is(':checked')){
			}
			else
			{
				$('.dispo').css({"color":"#C0392B"})
				$("#dispo_annonce").css({"color":"#C0392B"})
			}
			if($("#attestation").val() === "0")
			{
				$("#attestation").css({"border":"1px solid #C0392B"})
			}
			if($("#region").val() === "0")
			{
				$("#region").css({"border":"1px solid #C0392B"})
			}
			if($("#descriptif").val().length < "150")
			{
				$('#descriptif').css({"border":"1px solid #C0392B"})
				$("#span_descriptif").after('<svg  type="button"  data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="150 caractères minimum" class="bi bi-info-circle-fill" width="1.2em" height="1.2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 16A8 8 0 108 0a8 8 0 000 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>')
				$('[data-toggle="popover"]').popover()
			}
			if($("#name_fichier").text() === "")
			{
				$('#label_image').css({"color" : "#C0392B"})
			}
			if($("#tel").val() === "")
			{
				$('#tel').css({"border":"1px solid #C0392B"})
			}
			if($("#prix").val() === "")
			{
				$('#prix').css({"border":"1px solid #C0392B"})
			}
		}
}