$( document ).ready(function() {
	
	mes_annonces()
	$("body").on("click", ".liste_annonces_poste", function () {

		id= $(this).attr("id")
		location.href = "annonce.php?id="+id+"";
	});
});

function mes_annonces(){

	login = $(".nom_user").attr("id")
	 $.ajax({
        url: '../fonctions/fonction_mes_annonces.php',
        type: 'POST',
        data: {login: login},
        
            success: function(data){ 
            	console.log(data)
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
						}
						$(".nombre").after('<div id="'+result[id]+'" class="w-75 liste_annonces_poste shadow"></div>')
						$("#"+result[id]).append('<div id="image_user_'+result[id]+'" class="image_user"></div>')
						$("#image_user_"+result[id]).append('<img width="100px" height="100px" src="../img/profil/'+result[profil]+'">')
						$("#image_user_"+result[id]).after('<div id="detail_annonce_'+result[id]+'" class="detail_annonce"></div>')
						$("#detail_annonce_"+result[id]).append('<h6 id="type_'+result[id]+'">'+result[type]+'</h6>')
						$("#type_"+result[id]).after('<p class="prix_annonce_'+result[id]+'" id="prix_annonce">'+result[prix]+' €</p>')
						$(".prix_annonce_"+result[id]).after('<div id="login_'+result[id]+'">'+result[login]+'</div>')
						$("#login_"+result[id]).after('<div>'+result[region]+'</div>')


							
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
