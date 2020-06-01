$( document ).ready(function() {
	
	affichages_conversation()

	$("body").on("click", ".msg_send_btn", function () {

		console.log("ok")
	});
	$("body").on("click", ".chat_list", function () {

		$(".chat_list").removeClass("active_chat")
		id_conv = $(this).attr("id")
		$("#"+id_conv).addClass("active_chat")
		conv_user = id_conv.substr(10) 
		affichages_messages()
	});
});


var tab_user=[]
var user_exist = 0
function affichages_conversation(){

	$.ajax({
        url: '../fonctions/fonction_messages.php',
        type: 'POST',    
                   
        success: function(data){  
  			if(data === "0")
  			{
  				$(".aucun_message").removeClass("d-none")

  			}
  			else
  			{
  				$(".bloc_message").removeClass("d-none")
  				$(".aucun_message").addClass("d-none")
  				$(".chat_list").remove()
  				var nbr_conv=0;
				for(i=0; i<Object.keys(data).length;i++)
				{
					if(data[i] =="{")
					{
						nbr_conv++;
					}
				}
				for(i=0; i < nbr_conv; i++)
				{						
					var result = JSON.parse(data)[i];   	
					for(j=0; j < Object.keys(result).length; j++ )
					{
						var id = Object.keys(result)[0]
						var profil = Object.keys(result)[3]
						var nom = Object.keys(result)[4]
					}
					for(p= 0; p<tab_user.length; p++)
					{
						if(result[nom] == tab_user[0])
						{
							user_exist = 1
						}
						else
						{
							user_exist = 0
						}
					}
					if(user_exist == 0)
					{
						if($(".active_chat").text().trim() == "")
						{
						$(".inbox_chat").append('<div id="chat_list_'+result[nom]+'" class="chat_list active_chat"></div>')
						}
						else
						{
							$(".inbox_chat").append('<div id="chat_list_'+result[nom]+'" class="chat_list"></div>')
						}
						$("#chat_list_"+result[nom]).append('<div id="chat_people_'+result[id]+'" class="chat_people"></div>')
						$("#chat_people_"+result[id]).append('<div id="chat_img_'+result[id]+'" class="chat_img"></div>')
						$("#chat_img_"+result[id]).append('<img src="../img/profil/'+result[profil]+'">')
						$("#chat_img_"+result[id]).after('<div id="chat_ib_'+result[id]+'" class="chat_ib"></div>')
						$("#chat_ib_"+result[id]).append('<h5 id="login_'+result[id]+'">'+result[nom]+'</h5>')
						tab_user.push(result[nom])
					}
				}		
  			}
        }
    });
}


function affichages_messages(){

		$.ajax({
        url: '../fonctions/fonction_messages.php',
        type: 'POST', 
        data: {conv_user: conv_user},   
                   
        success: function(data){                	

        	console.log(data)
  			var nbr_messages=0;
			for(i=0; i<Object.keys(data).length;i++)
			{
				if(data[i] =="{")
				{
					nbr_messages++;
				}
			}
			console.log(nbr_messages)	
        }
    });
}
