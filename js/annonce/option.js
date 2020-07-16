$( document ).ready(function() {

	$("body").on("click", "#refuse", function () {

		info_annonce = JSON.parse(localStorage.getItem('annonce'))

		type 		= info_annonce['type']
		region 		= info_annonce['region']
		descriptif 	= info_annonce['descriptif']
		tel 		= info_annonce['tel']
		prix 		= info_annonce['prix']
		disponibilite = info_annonce['disponibilite']
		statut = info_annonce['statut']
		file_info = info_annonce['file']
		file_name = info_annonce['file_name']
	
		data = {type: type, region: region, descriptif: descriptif, tel: tel, prix: prix, disponibilite: disponibilite, statut: statut, file_name: file_name} 
		add_annonce()
		// document.location.reload(true);
	});

});

function add_annonce()
{
	$.ajax({
        
        url: '../fonctions/fonction_ajout_annonce.php',
        type: 'POST',
        data: data,
                   
        success: function(data){ 

            localStorage.clear();
        }
    });  
}