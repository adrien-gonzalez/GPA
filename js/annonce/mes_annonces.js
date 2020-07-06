$( document ).ready(function() {
	
	mes_annonces()
	$("body").on("click", ".liste_annonces_poste", function () {

		id= $(this).attr("id")
		location.href = "annonce.php?id="+id+"";
	});
	$("body").on("click", ".button_design", function () {

		id=$(this).attr("id")

		$("body").on("click", "#delete_ok", function () {

			 $.ajax({
		        url: '../fonctions/fonction_mes_annonces.php',
		        type: 'POST',  
		        data: {id_annonce: id_annonce},  
		                   
		        success: function(data){ 
                     document.location.reload(true);
		        }
		    });
		});
	});
});

function mes_annonces(){

	login = $(".nom_user").attr("id")
	$.ajax({
        url: '../fonctions/fonction_mes_annonces.php',
        type: 'POST',
        data: {login: login},
        
            success: function(data){ 
            	if(data != "0")
            	{
            		$("#nombre_annonce").text("Annonces en ligne ("+JSON.parse(data).length+")")
            		for(i=0; i < JSON.parse(data).length; i++)
					{		
						var result = JSON.parse(data)[i];   	
						for(j=0; j < Object.keys(result).length; j++)
						{
							var id = Object.keys(result)[0]
							var login = Object.keys(result)[1]
							var profil = Object.keys(result)[2]
							var type = Object.keys(result)[3]
							var region = Object.keys(result)[4]
							var prix = Object.keys(result)[5]
							var verif = Object.keys(result)[6]
							var date = Object.keys(result)[7]
						}
					
						var timestamp = Math.round(new Date().getTime() / 1000);
						var timestamp2 =  parseInt(Date.parse(result[date])/1000)
						date_diff = timestamp - timestamp2
						jours_restant = 60-parseInt(date_diff/86400)

						$(".nombre").after('<div id="'+result[id]+'" class="w-75 liste_annonces_poste shadow"></div>')
						$("#"+result[id]).append('<div id="image_user_'+result[id]+'" class="image_user"></div>')
						$("#image_user_"+result[id]).append('<img width="100px" height="100px" src="../img/profil/'+result[profil]+'">')
						$("#image_user_"+result[id]).after('<div id="detail_annonce_'+result[id]+'" class="detail_annonce"></div>')
						$("#detail_annonce_"+result[id]).append('<h6 id="type_'+result[id]+'">'+result[type]+'</h6>')
						$("#type_"+result[id]).after('<p class="prix_annonce_'+result[id]+'" id="prix_annonce">'+result[prix]+' €</p>')
						$(".prix_annonce_"+result[id]).after('<div id="login_'+result[id]+'">'+result[login]+'</div>')
						$("#login_"+result[id]).after('<div id="region_'+result[id]+'">'+result[region]+'</div>')	

						$("#"+result[id]).after('<div id="div_message_'+result[id]+'" class="w-75 d-flex justify-content-end p-40"></div>')
						$("#div_message_"+result[id]).append('<div id="button_del_'+result[id]+'" class="d-flex button_supprm">')	
						$("#button_del_"+result[id]).append('<form id="form_'+result[id]+'" action="" method="post"></form>')
						$("#form_"+result[id]).append('<input type="button" id="'+result[id]+'" name="delete" class="button_design w-10" value="Supprimer" data-toggle="modal" data-target="#delete">')
						
						// AFFICHAGE NOMBRE DE JOUR
						if(result[verif] === "0")
						{
							verif = "En attente";
							color = "orange";
							$("#detail_annonce_"+result[id]).after('<div class="'+color+'">'+verif+'</div>')
						}
						else
						{
							verif = "Validé";
							color = "vert";
							$("#detail_annonce_"+result[id]).after('<div class="verif_temps" id="verif_temps_'+result[id]+'"></div>')
							$("#verif_temps_"+result[id]).append('<div id="verif_'+result[id]+'" class="'+color+'">'+verif+'</div>')

							$("#verif_"+result[id]).after('<p>'+jours_restant+" jours restants"+'</p>')
						}							
					}
            	}
            	else
            	{
            		$("#nombre_annonce").text("Annonces en ligne (0)")
            		$(".nombre").after('<div class="w-75 liste_annonces"></div>')
            		$(".liste_annonces").append("<h4>Vous n’avez aucune annonce en ligne</h4>")
            	}           	
        }
    });
}
