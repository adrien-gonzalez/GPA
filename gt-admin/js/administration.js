$(document).ready(function (){

	var id_annonce = $("#panel").val()
	if(id_annonce != "")
	{
		$('.list-group-item').removeClass("active")
		$('#'+id_annonce).addClass("active")
	}

	$("body").on("click", ".button_card", function () { 

		id_annonce=$(this).attr("id")

		    $.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'POST',
            data: {id_annonce: id_annonce},        
                       
                success: function(data){ 

                var result = JSON.parse(data);
                type_attestation = result[0].type_attestation
                description = result[0].descriptif
                documentpdf = result[0].document
                region = result[0].region
                tarif = result[0].prix
                prenom = result[0].prenom
                nom = result[0].nom

				$('#ModalLabel').text(type_attestation)
				$('#region').text('Region: '+region)
				$("#tarif").text('Tarif: '+tarif+' €')
				$("#user").text('Utilisateur: '+nom+' '+prenom)
				$('.descriptif').text(description)
				$(".document_pdf").attr("href", "../img/attestations/"+documentpdf+"")
            }
        });
	});
	$("body").on("click", ".validate", function () {

		id_annonce_validate = $(this).attr("id").substr(6)
		$.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'POST',
            data: {id_annonce_validate: id_annonce_validate},        
                       
                success: function(data){ 
                    document.location.reload(true);
            }
        });


	});
	$("body").on("click", ".delete", function () {

		id_annonce_delete = $(this).attr("id").substr(7)
		$.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'POST',
            data: {id_annonce_delete: id_annonce_delete},        
                       
                success: function(data){ 
                	// SUPPRIMER DOC PDF DU DOSSIER
                    document.location.reload(true);
            }
        });
	});
});


