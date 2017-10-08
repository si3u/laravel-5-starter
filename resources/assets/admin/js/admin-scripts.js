
// Vérification du chargement du DOM éffectué dans le layout.admin

$(document).ajaxStart(function() { Pace.restart(); });

function initAdmin()
{
    initTitan();
	
	// SELECT2
	$(".select2")
	 .addClass('form-control input-md')
	 .select2({
		tags: true
		,createTag: function (params) { /* pour en créer dans la liste automatiquement*/
			var term = $.trim(params.term);
			if (term === '') { return null; }
			return { id: term, text: term, newTag: true };/* add additional parameters*/
		}
		,tokenSeparators: [',']
		,multiple: true
		,closeOnSelect: false
//			,maximumSelectionLength: 200
//			,language: "fr"
//			,allowClear: true // pour pouvoir vider le champ complet
//			,insertTag: function (data, tag) {// Insert the tag at the end of the results
//				data.push(tag);
//			}
	});
		
	// TOOLTIPS
    $('[data-toggle="tooltip"]').tooltip();
}
