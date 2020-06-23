$( document ).ready(function() {

	$("body").on("click", ".image_profil", function () {

		// element
		var id_annonce = $(this).attr('id');
		console.log(id_annonce)
		window.location.href = "sources/annonce.php?id="+id_annonce+"";
	});
});
