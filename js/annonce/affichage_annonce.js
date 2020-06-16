var attestation = null
var region = null
setTimeout(affichage_annonce(attestation, region), 100);

function affichage_annonce(attestation, region){

    $.ajax({
        url: 'fonctions/fonction_affichage_annonces.php',
        type: 'POST',      
        data: {attestation: attestation, region: region},
    	
        success: function(data){  

			$(".liste_profil").remove()
			for(i=0; i < JSON.parse(data).length; i++)
			{	
				var result = JSON.parse(data)[i];   	
				for(j=0; j < Object.keys(result).length; j++ )
				{
					var id 					= Object.keys(result)[0]
					var profil 				= Object.keys(result)[1]
					var nom 				= Object.keys(result)[2]
					var prenom 				= Object.keys(result)[3]
					var region 				= Object.keys(result)[4]
					var type_attestation	= Object.keys(result)[5]
					var tel					= Object.keys(result)[6]
					var email 				= Object.keys(result)[7]
					var tarif 				= Object.keys(result)[8]
				}
				if($('#affichage_profil_'+result[id]).length === 0)
				{
					$('#affichage_annonces').append('<div class="liste_profil '+result[type_attestation]+'" id="affichage_profil_'+result[id]+'"></div>')
					$("#affichage_profil_"+result[id]).append('<img class="image_profil rounded-circle" id="profil_'+result[id]+'" src="img/profil/'+result[profil]+'" width="125">')
					$("#profil_"+result[id]).after('<div id="name_'+result[id]+'">'+result[nom]+' '+result[prenom]+'</div>')
					$("#name_"+result[id]).after('<div id="region_'+result[id]+'">'+result[region]+'</div>')
					$("#region_"+result[id]).after('<div class="attestation" id="attestation_'+result[id]+'">'+result[type_attestation]+'</div>')
					$("#attestation_"+result[id]).after('<div id="tel_'+result[id]+'">'+result[tel]+'</div>')
					$("#tel_"+result[id]).after('<div id="email_'+result[id]+'">'+result[email]+'</div>')
					$("#email_"+result[id]).after('<div id="tarif_'+result[id]+'">'+result[tarif]+' €</div>')
				}
			}	
        }
    });
}



$( document ).ready(function() {

	$("body").on("click", ".image_profil", function () {

		// element
		var id_annonce = $(this).attr('id');

		// id annonce et type d'attestation
		id = id_annonce.substr(7)
		type_attestation = $("#attestation_"+id).text().replace(/ /g, '')
		window.location.href = "sources/annonce.php?id="+id+"";
	});
	$("body").on("click", "#recherche_accueil", function () {
		
		attestation = $("#attestation").text()
		region = $("#region").text()


		if(attestation === "Type d'attestation" || attestation ==="Tout")
		{
			attestation = null
		}
		if(region === "Région" || region ==="Tout" )
		{
			region = null
		}
		affichage_annonce(attestation, region)
	});
	// $("body").on("click", "span", function () {
	// 	console.log("ok")
	// });
});
