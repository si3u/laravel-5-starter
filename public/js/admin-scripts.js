$(function(){

	/* AJAX PACE restart */
	$(document).ajaxStart(function() { Pace.restart(); });

	(function initAdmin()
	{
		initTitan();

		/* SELECT2 - SANS possibilité d'ajouter de mots */
		$(".select2.select2notags").addClass('form-control input-md').select2({closeOnSelect: false});
		
		/* SELECT2 - AVEC possibilité d'ajouter des mots */
		$(".select2.select2tags").addClass('form-control input-md').select2({
			tags: true
			,tokenSeparators: [',']
			,closeOnSelect: false
			,insertTag: function (data, tag) {/* Insert the tag at the end of the results */
				data.push(tag);
			}
		});
 
		/* TOOLTIPS */
		$('[data-toggle="tooltip"]').tooltip();
		
		/* FANCYBOX */
		if ($(".fancybox").length > 0) {
			$(".fancybox").fancybox({
				closeBtn: true,
				helpers: {
					title: {type: 'inside'},/* 'over'  'outside'  'float'   'inside' */
					thumbs: {
						width: 50,
						height: 50
					},
					buttons: {},
					media: {}
				}
			});
		}
	
	
	})();
	
});
/*
//
//function linkAjax(url)
//{
//	if(url) {
//		var xhr = $.ajax( { 
//			url: url,
//			success: function(res){
//				notify('Succès', res);
//				//$('#btn-create-new-dir').fadeOut(400); 
//			},
//			error: function(){
//				notifyError('Erreur', "Une erreur est survenue à l'appel Ajax");
//			}
//		});
//	} else {
//		notifyError('Oops', 'Aucune URL fournie');
//	}
//}
*/