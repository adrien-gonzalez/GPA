$(document).ready(function (){

    $("body").on("click", "#categorie", function () { 

    $("#durée_avantage").remove()
    $("#duree").remove()
    categorie = $("#categorie").val()

        if(categorie == "Annonce")
        {
             $(".categorie").after('<div id="durée_avantage" class="d-flex flex-column rs1-wrap-input100 validate-input m-b-20 taille1"></div>')
             $("#durée_avantage").before('<label id="duree">Durée du service :</label>')
             $("#durée_avantage").append('<select id="liste_durée" class="input100 wrap-input100">')
             $("#liste_durée").append('<option id="7days" value="7">7 Jours</option>')
             $("#7days").after('<option id="30days" value="30">30 Jours</option>')
             $("#30days").after('<option id="60days" value="60">60 Jours</option>')
             $("#liste_durée").after('<span class="focus-input100"></span>')
        }
    });

	var id_annonce = $("#panel").val()
	if(id_annonce != "")
	{
		$('.list-group-item').removeClass("active")
		$('#'+id_annonce).addClass("active")
	}
    // AFFICHE DETAIL D'UNE ANNONCE SELECTIONEE
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
    // VALIDE UNE ANNONCE 
	$("body").on("click", ".validate", function () {

		id_annonce_validate = $(this).attr("id").substr(6)
        email = $("#"+id_annonce_validate+"email").val()

		$.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'POST',
            data: {id_annonce_validate: id_annonce_validate, email: email},        
                       
                success: function(data){ 
                    document.location.reload(true);
            }
        });
	});
    // SUPPRIME UNE ANNONCE SI NON VALIDEE
	$("body").on("click", ".delete", function () {

		id_annonce_delete = $(this).attr("id").substr(7)
        email = $("#"+id_annonce_delete+"email").val()

        $("body").on("click", "#envoie_note", function () {

            if($("#note_annonce").val() != "")
            {
                note = $("#note_annonce").val()

                $.ajax({
                url: 'fonctions/fonction_administration.php',
                type: 'POST',
                data: {id_annonce_delete: id_annonce_delete, note: note, email: email},        
                       
                    success: function(data){ 
                     // SUPPRIMER DOC PDF DU DOSSIER
                        document.location.reload(true);
                    }
                });
            }
            else
            {
                 $('#note_annonce').css({"border":"1px solid #C0392B"})  
            }
        });
	});
    // AFFICHE INFO UTILISATEUR
    $("body").on("click", ".info_user", function () { 

        id_user = $(this).attr("id")
        $.ajax({
        url: 'fonctions/fonction_administration.php',
        type: 'POST',
        data: {id_user: id_user},        
                       
            success: function(data){ 

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
    // BAN UN UTILISATEUR (30 JOURS)
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
    // BAN UN UTILISATEUR (PERMANENT = DELETE)
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
    // AFFICHE FORM CHANGE LOGIN ADMIN
    $("body").on("click", "#change_login", function () { 

        $(".form1").remove()
        $(".form2").remove()
        $(".erreur").remove()
        $(".input-pass").after('<div class="form1 login_change login wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20 m-t-40"></div>')
        $(".login_change").append('<input id="login_form1" class="form1 input100" type="text" name="login" placeholder="Nouveau login" value="">')
        $("#login_form1").after('<span class="form1 focus-input100"></span>')
        $(".login_change").after('<div class="form1 password_confirm login wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20"></div>')
        $(".password_confirm").append('<input id="password_form1" class="form1 input100" type="password" name="password" placeholder="Mot de passe" value="">')
        $("#password_form1").after('<span class="form1 focus-input100"></span>')
        $(".password_confirm").after('<div class="form1 validate_modif login wrap-input100 rs1-wrap-input100 validate-input taille1"></div>')
        $(".validate_modif").append('<input type="button" id="modif_login" class="form1  login100-form-btn" value="Modifier">')
    });
    // AFFICHE FORM CHANGE PASSWORD ADMIN
    $("body").on("click", "#change_pass", function () { 

        $(".form1").remove()
        $(".form2").remove()
        $(".erreur").remove()
        $(".input-pass").after('<div class="form2 login_change login wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20 m-t-40"></div>')
        $(".login_change").append('<input id="password_form2" class="form2 input100" type="password" name="password" placeholder="Nouveau mot de passe" value="">')
        $("#password_form2").after('<span class="form2 focus-input100"></span>')
        $(".login_change").after('<div class="form2 password_confirm login wrap-input100 rs1-wrap-input100 validate-input taille1 m-b-20"></div>')
        $(".password_confirm").append('<input id="password1_form2" class="form2 input100" type="password" name="password1" placeholder="Ancien mot de passe" value="">')
        $("#password1_form2").after('<span class="form2 focus-input100"></span>')
        $(".password_confirm").after('<div class="form2 validate_modif login wrap-input100 rs1-wrap-input100 validate-input taille1"></div>')
        $(".validate_modif").append('<input type="button" id="modif_pass" class="form2 login100-form-btn" value="Modifier">')
    });
    // CHANGE LOGIN ADMIN
    $("body").on("click", "#modif_login", function () { 

        login = $("#login").val()
        new_login = $("#login_form1").val()
        password = $("#password_form1").val()

        if(password === "" || new_login === "")
        {
            if(password === "")
            {
                $('#password_form1').css({"border":"1px solid #C0392B"})
            }
            if(new_login === "")
            {
                $('#login_form1').css({"border":"1px solid #C0392B"})
            }
        }
        else
        {
            $.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'POST',
            data: {login: login, new_login: new_login, password: password},        
                           
                success: function(data){ 
                    console.log(data)
                    if(data === "wrong_pass")
                    {
                        $(".login100-form-title").after('<div class="erreur">*Mot de passe inccorrect</div>')
                        $('#password_form1').css({"border":"1px solid #C0392B"})
                    }
                    else
                    {
                        document.location.reload(true);  
                    }
                }
            }); 
        }
    });
    // CHANGE PASSWORD ADMIN
    $("body").on("click", "#modif_pass", function () { 

        login = $("#login").val()
        new_pass = $("#password_form2").val()
        password = $("#password1_form2").val()

        if(password === "" || new_pass === "")
        {
            if(password === "")
            {
                $('#password1_form2').css({"border":"1px solid #C0392B"})
            }
            if(new_pass === "")
            {
                $('#password_form2').css({"border":"1px solid #C0392B"})
            }
        }
        else
        {
            $.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'POST',
            data: {login: login, new_pass: new_pass, password: password},        
                           
                success: function(data){ 
                    console.log(data)
                    if(data === "wrong_pass")
                    {
                        $(".login100-form-title").after('<div class="erreur">*Mot de passe inccorrect</div>')
                        $('#password1_form2').css({"border":"1px solid #C0392B"})
                    }
                    else
                    {
                        document.location.reload(true);  
                    }
                }
            }); 
        }
    });
    // AJOUTER UN PRODUIT
    $("body").on("click", "#valid_ajout", function () {

    $("#nom_produit").css({"border": "1px solid #E6E6E6"})
    $("#description_produit").css({"border": "1px solid #E6E6E6"})
    $("#prix").css({"border": "1px solid #E6E6E6"})
    $("#categorie").css({"border": "1px solid #E6E6E6"})

    if($("#nom_produit").val() != "" && $("#description_produit").val() != "" && $("#prix").val() != "" && $("#categorie").val() != "")
    {
        nom_produit = $("#nom_produit").val()
        description_produit = $("#description_produit").val()
        prix = $("#prix").val()
        categorie = $("#categorie").val()

        console.log(categorie)
       
            if($("#liste_durée").val() == undefined)
            {
                duree = false;
            }
            else
            {
                duree = $("#liste_durée").val()
            }        
        $.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'POST',
            data: {nom_produit: nom_produit, description_produit: description_produit, prix: prix, categorie: categorie, duree: duree},        
                           
                success: function(data){ 
                    document.location.href="?panel=mes_produits";    
                }
            });   
    }
    else
    {
        if($("#nom_produit").val() == "")
        {
            $('#nom_produit').css({"border":"1px solid #C0392B"})
            $('#nom_produit').attr("placeholder","*Veuillez entrer un nom")
            $('#nom_produit').addClass("erreur_form")
        }
        if($("#description_produit").val() == "")
        {
            $('#description_produit').css({"border":"1px solid #C0392B"})
            $('#description_produit').attr("placeholder","*Veuillez entrer une description")
            $('#description_produit').addClass("erreur_form")
        }
        if($("#prix").val() == "")
        {
            $('#prix').css({"border":"1px solid #C0392B"})
            $('#prix').attr("placeholder","*Veuillez entrer un prix")
            $('#prix').addClass("erreur_form")
        }
        if($("#categorie").val() == "")
        {
            $('#categorie').css({"border":"1px solid #C0392B"})
        }
    }
    });

    // AJOUTER PRODUIT
    $("body").on("click", ".add_product", function () {

         document.location.href="?panel=ajout_produit";  
    });

    // AFFICHE UN PRODUIT SELECTIONNE
    $("body").on("click", ".affiche_produit", function () {

        $("#produit_update").removeClass("erreur_update")
        $("#prix_update").removeClass("erreur_update")
        $("#description_update").removeClass("erreur_update")

        id_produit = $(this).attr("id")

        $.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'POST',
            data: {id_produit: id_produit},        
                           
                success: function(data){ 
                    for(i=0; i < JSON.parse(data).length; i++)
                    {       
                        var result = JSON.parse(data)[i];
                        for(j=0; j < Object.keys(result).length; j++)
                        {
                            var id_produit = Object.keys(result)[1]
                            var nom = Object.keys(result)[2]
                            var description = Object.keys(result)[3]
                            var prix = Object.keys(result)[4]
                            var categorie = Object.keys(result)[5]

                        }
                    }
                    $("#produit_update").val(result[nom])
                    $("#prix_update").val(result[prix])
                    $("#description_update").val(result[description])  
                    $("#id_produit").val(result[id_produit])
                }
        });  
    });
    // UPDATE PRODUIT
    $("body").on("click", "#update", function () {

        if($("#produit_update").val() != "" && $("#prix_update").val() != "" && $("#description_update").val() != "")
        {   
            update_nom = $("#produit_update").val()
            update_prix = $("#prix_update").val()
            update_description = $("#description_update").val()
            id_produit = $("#id_produit").val()

            $.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'GET',
            data: {update_nom: update_nom, update_prix: update_prix, update_description: update_description, id_produit: id_produit},        
                           
                success: function(data){ 
                    document.location.reload(true); 
                }
            });  
        }
        else
        {
            if($("#produit_update").val() == "")
            {
                $('#produit_update').addClass("erreur_update")
                $('#produit_update').attr("placeholder","*Veuillez entrer un nom")
                $('#produit_update').addClass("erreur_form")
            }
            if($("#prix_update").val() == "")
            {
                $('#prix_update').addClass("erreur_update")
                $('#prix_update').attr("placeholder","*Veuillez entrer un prix")
                $('#prix_update').addClass("erreur_form")
            }
            if($("#description_update").val() == "")
            {
                $('#description_update').addClass("erreur_update")
                $('#description_update').attr("placeholder","*Veuillez entrer une description")
                $('#description_update').addClass("erreur_form")
            }
            
        }
    });
    $("body").on("click", ".delete_produit", function () {

        id_product_delete = $(this).attr("id")



        $("body").on("click", "#delete", function () {

            $.ajax({
                url: 'fonctions/fonction_administration.php',
                type: 'GET',
                data: {id_product_delete: id_product_delete},        
                               
                    success: function(data){ 
                        document.location.reload(true);  
                    }
            });  
        });
       
    });
    $("body").on("click", ".info_paiement", function () {

        id_paiement = $(this).attr("id")

        $.ajax({
            url: 'fonctions/fonction_administration.php',
            type: 'GET',
            data: {id_paiement: id_paiement},        
                               
                success: function(data){ 

                    for(i=0; i < JSON.parse(data).length; i++)
                    {       
                        var result = JSON.parse(data)[i];
                    }
                        card = result.payment_method_details.card.brand
                        origine = result.payment_method_details.card.country
                        dernier_chiffre = result.payment_method_details.card.last4
                        description_paiement = result.description

                    
                        $("#moyen_paiement").text("Moyen de paiement : "+card)
                        $("#origine").text("Origine du paiement : "+origine)
                        $("#dernier_chiffre").text("Numéro : ... "+dernier_chiffre)
                        $("#description_paiement").text(description_paiement)
                }
        });  
    });
    $("body").on("click", ".rembourser", function () {

        id_paiement_rembouser = $(this).attr('id')

        $("body").on("click", "#rembourser", function () {

             $.ajax({
                url: 'fonctions/fonction_administration.php',
                type: 'POST',
                data: {id_paiement_rembouser: id_paiement_rembouser},        
                               
                    success: function(data){ 
                        document.location.reload(true);  
                    }
            });  
        });
    });
});

function getAge(date) { 
    var diff = Date.now() - date.getTime();
    var age = new Date(diff); 
    return Math.abs(age.getUTCFullYear() - 1970);
}