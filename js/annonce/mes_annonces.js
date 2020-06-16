$( document ).ready(function() {
	
	mes_annonces()
	$("body").on("click", ".liste_annonces_poste", function () {

		id= $(this).attr("id")
		location.href = "annonce.php?id="+id+"";
	});
});

function mes_annonces(){

	 $.ajax({
        url: '../fonctions/fonction_mes_annonces.php',
        type: 'POST',
        
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
							var type = Object.keys(result)[2]
							var region = Object.keys(result)[3]
							if(Object.keys(result)[4] > 140)
							{
								var descriptif = Object.keys(result)[4].substr(0,140)
							}
							else
							{
								var descriptif = Object.keys(result)[4]
							}
							var prix = Object.keys(result)[6]
						}
						$(".nombre").after('<div id="'+result[id]+'" class="w-75 liste_annonces_poste"></div>')
						$("#"+result[id]).append('<h6 id="type_'+result[id]+'"">'+result[type]+' ('+result[region]+') '+result[prix]+' €</h6>')
						$("#type_"+result[id]).after('<p id="descriptif_'+result[id]+'">'+result[descriptif]+'</p>')		
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