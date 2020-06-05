$( document ).ready(function() {
	
	affichages_conversation()
	setTimeout(affichages_messages, 100);
	
	$("body").on("click", ".msg_send_btn", function () {

		if($(".write_msg").val() != "" && $(".write_msg").val().length <= 255)
  		{
			insert_message()
			$(".write_msg").val("")
		}
	});
	$(window).on('keydown', function(e) {
		if (e.which == 13) {
  			if($(".write_msg").val() != "" && $(".write_msg").val().length <= 255)
  			{
  				insert_message()
				$(".write_msg").val("")
			}
		}
	});
	$("body").on("click", ".chat_list", function () {

		$(".outgoing_msg").remove()
       	$(".incoming_msg").remove()
		id_conv = $(this).attr("id")
		$(".chat_list").removeClass("active_chat")
		$("#"+id_conv).addClass("active_chat")
	});
	$("body").on("click", "svg", function () {

		id_message = $(this).attr("id")
		id_message = id_message.substr(4)
		
		$.ajax({
        	url: '../fonctions/fonction_messages.php',
        	type: 'POST', 
        	data: {id_message: id_message},  

        	success: function(data){  

        		$("#outgoing_msg_"+id_message).remove()
        	}
        });
	});
});


var timeout = 5000;
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
				
				for(i=0; i < JSON.parse(data).length; i++)
				{						
					var result = JSON.parse(data)[i];   	
					for(j=0; j < Object.keys(result).length; j++ )
					{
						var id = Object.keys(result)[0]
						var profil = Object.keys(result)[3]
						var nom = Object.keys(result)[4]
					}
					if($('#chat_list_'+result[nom]).length === 0)
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
					}
				}		
  			}
        }
    });
		setTimeout(affichages_conversation, timeout);
}


var timeout = 1500;
function affichages_messages(){

       	var conv_user = $('.active_chat').attr('id').substr(10) 

		$.ajax({
        url: '../fonctions/fonction_messages.php',
        type: 'POST', 
        data: {conv_user: conv_user},   
                   
        success: function(data){  

        	if(document.getElementsByClassName('outgoing_msg').length + document.getElementsByClassName('incoming_msg').length >  JSON.parse(data).length)
        	{
        		$(".outgoing_msg").remove()
       			$(".incoming_msg").remove()
        	}
			for(i=0; i < JSON.parse(data).length; i++)
			{	
				var result = JSON.parse(data)[i];   	
				for(j=0; j < Object.keys(result).length; j++ )
				{
					var id 		= Object.keys(result)[0]
					var login 	= Object.keys(result)[1]
					var profil 	= Object.keys(result)[2]
					var message = Object.keys(result)[3]
					var date 	= Object.keys(result)[4]
					var user_on = Object.keys(result)[5]
				}
				if(result[login] === result[user_on] && $('#outgoing_msg_'+result[id]).length === 0)
				{
					$(".msg_history").append('<div id="outgoing_msg_'+result[id]+'" class="outgoing_msg"></div>')
					$("#outgoing_msg_"+result[id]).append('<div id="sent_msg_'+result[id]+'" class="sent_msg"></div>')
					$("#sent_msg_"+result[id]).append('<p id="message_'+result[id]+'">'+result[message]+'</p>')
					$("#message_"+result[id]).after('<span id="time_date_'+result[id]+'" class="time_date">'+result[date]+'</span>')
					$("#time_date_"+result[id]).append('<svg id="svg_'+result[id]+'" class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>')					
					var div = $('.msg_history');
					var height = div[0].scrollHeight;
					div.scrollTop(height);
				}
				else if(result[login] != result[user_on] && $('#incoming_msg_'+result[id]).length === 0)
				{
					$(".msg_history").append('<div id="incoming_msg_'+result[id]+'" class="incoming_msg"></div>')
					$("#incoming_msg_"+result[id]).append('<div id="incoming_msg_img_'+result[id]+'" class="incoming_msg_img"></div>')
					$("#incoming_msg_img_"+result[id]).append('<img src="../img/profil/'+result[profil]+'" alt="sunil">')
					$("#message_"+result[id]).after('<span id="time_date_'+result[id]+'" class="time_date">'+result[date]+'</span>')
					$("#incoming_msg_img_"+result[id]).after('<div id="received_msg_'+result[id]+'" class="received_msg"></div>')
					$("#received_msg_"+result[id]).append('<div id="received_withd_msg_'+result[id]+'" class="received_withd_msg"></div>')
					$("#received_withd_msg_"+result[id]).append('<p id="message_'+result[id]+'">'+result[message]+'</p>')
					$("#message_"+result[id]).after('<span class="time_date">'+result[date]+'</span>')
					var div = $('.msg_history');
					var height = div[0].scrollHeight;
					div.scrollTop(height);
				}
			}	
        }
    });
		setTimeout(affichages_messages, timeout);
};

function insert_message(){

	var id_utilisateur_prive = $(".active_chat").attr('id')
	id_utilisateur_prive = id_utilisateur_prive.substr(10)
	message = $(".write_msg").val()
	$.ajax({
	        url: '../fonctions/fonction_messages.php',
	        type: 'POST', 
	        data: {message: message, id_utilisateur_prive: id_utilisateur_prive},   
	                   
	        success: function(data){             	
	        }
	    });
}