$(document).ready(function (){

	var id_annonce = $("#panel").val()
	if(id_annonce != "")
	{
		$('.list-group-item').removeClass("active")
		$('#'+id_annonce).addClass("active")
	}

	$("body").on("click", ".info_annonce", function () { 

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
    $("body").on("click", ".info_user", function () { 

        id_user = $(this).attr("id")
        $.ajax({
        url: 'fonctions/fonction_administration.php',
        type: 'POST',
        data: {id_user: id_user},        
                       
            success: function(data){ 
                // console.log(data)
            
            var result = JSON.parse(data);
            id = result[0].id
            login = result[0].login
            nom = result[0].nom
            prenom = result[0].prenom
            adresse = result[0].adresse
            email = result[0].email
            date = result[0].date
            profil = result[0].profil
            ban = result[0].ban



            // <--- AGE --->
            annee = result[0].naissance.substr(0, 4)
            mois = parseInt(result[0].naissance.substr(5, 2))
            jour = parseInt(result[0].naissance.substr(8, 2))
            age = getAge(new Date(annee, mois, jour))
            // <--- --->

            $('#login').text(login)
            $('#nom_prenom').text('Nom / Prénom: '+nom+" "+prenom)
            $("#age").text('Age: '+age)
            $("#inscription_date").text('Inscrit le: '+date)
            $('#profil_user').attr("src", "../img/profil/"+profil)
            $('#id_user_hidden').attr("value", id)

            if(ban === "oui")
            {
                $("#ban").text("Déban")
            }
            else
            {
                $("#ban").text("Ban 30 jours")
            }
            }
        });
    });
    $("body").on("click", "#ban", function () { 

        valeur = $("#ban").text()

        if(valeur === "Déban")
        {
            $("#ban").text("Ban 30 jours")
        }
        else
        {
            $("#ban").text("Déban")
        }

        id_user_ban = $("#id_user_hidden").attr("value")
        $.ajax({
        url: 'fonctions/fonction_administration.php',
        type: 'POST',
        data: {id_user_ban: id_user_ban},        
                       
            success: function(data){ 
            }
        }); 
    });
    $("body").on("click", "#ban_perm", function () { 

        id_user_ban_perm = $("#id_user_hidden").attr("value")
        if (confirm("Voulez-vous vraiment ban l'utilisateur de façon définitive ?"))
        {
               $.ajax({
                url: 'fonctions/fonction_administration.php',
                type: 'POST',
                data: {id_user_ban_perm: id_user_ban_perm},        
                           
                success: function(data){ 
                    document.location.reload(true);  
                }
            }); 
        }
    });
});

function getAge(date) { 
    var diff = Date.now() - date.getTime();
    var age = new Date(diff); 
    return Math.abs(age.getUTCFullYear() - 1970);
}