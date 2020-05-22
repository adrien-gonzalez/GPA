var nbr_lettre_max = 2000

$( document ).ready(function() {
	
	$(".nombre_caractere").text("0/"+nbr_lettre_max)
	var input = document.getElementById ("descriptif");
    input.maxLength = nbr_lettre_max
	$('#descriptif').keyup(function() {
 
	    var nombreCaractere = $(this).val().length;
	    var nombreMots = jQuery.trim($(this).val()).split(' ').length;
	    if($(this).val() === '') {
	     	nombreMots = 0;
	    }
		$(".nombre_caractere").text(nombreCaractere+"/"+nbr_lettre_max)
	});

	$("body").on("click", "#delete_fichier", function () {

		$('#name_fichier').remove()
		$('#delete_fichier').remove()
		$('#uploadImg').attr('src', "")
		$('#uploadImg').addClass("hidden")
		$("#label_image").css({"display" : "inherit"})
		$("#label_image").text("Mon attestation :")
		$("#upload").attr("value", "Télécharger mon attestation")
		
	});

	$("body").on("click", "#validate_annonce", function () {

		if($("#attestation").val() != "0" && $("#region").val() != "0" && $("#descriptif").val().length >= 100)
		{
			console.log($("#attestation").val())
		}
	});
});


// AFFICHAGE FICHIER PDF 
$(function(){
		
		var container = $('#container2'), inputFile = $('#fileToUpload'), img, btn, txt = 'Télécharger mon attestation', txtAfter = "Changer de fichier";
				
		if(!container.find('#upload').length){
			container.find('.input').append('<input type="button" value="'+txt+'" id="upload">');
			btn = $('#upload');
			$(".affichage_image").append('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="100">');
			img = $('#uploadImg');
		}			
		btn.on('click', function(){
			inputFile.click();
		});
		inputFile.on('change', function(e){

			var upload = 0
			taille = $('#fileToUpload').val().length
			name = document.getElementById('fileToUpload').files[0].name
			type = document.getElementById('fileToUpload').files[0].type
			valid_extensions = $('#fileToUpload').attr("accept");

			if(type == valid_extensions)
			{
				upload = 1
			}
			if(upload  == 1)
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

