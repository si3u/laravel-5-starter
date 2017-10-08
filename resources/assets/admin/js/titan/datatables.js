/* Set the defaults for DataTables initialisation */
$.extend(true, $.fn.dataTable.defaults, {
    "oClasses": {
        "sFilter": 'dataTables_filter input-group',
    },
    "oLanguage": /*{
        "sLengthMenu": "_MENU_",
        "sInfo": "Affichage de l'élement <span class='txt-color-darken'>_START_</span> à <span class='txt-color-darken'>_END_</span> sur <span class='text-primary'>_TOTAL_</span> éléments",
        "sInfoEmpty": "<span class='text-danger'>Affichage de l'élement 0 à 0 sur 0 éléments</span>",
        "sSearch": "<span class='input-group-addon'><i class='glyphicon glyphicon-search'></i></span> "
    }*/
		{
			"sProcessing":     "Traitement en cours...",
			"sSearch":         "Rechercher&nbsp;:",
			"sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
			"sInfo":           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
			"sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
			"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
			"sInfoPostFix":    "",
			"sLoadingRecords": "Chargement en cours...",
			"sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
			"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
			"oPaginate": {
				"sFirst":      "Premier",
				"sPrevious":   "Pr&eacute;c&eacute;dent",
				"sNext":       "Suivant",
				"sLast":       "Dernier"
		},
		"oAria": {
			"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
			"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
		}
}
});

$(function ()
{
    $('.dt-table').each(function ()
    {
        var id = $(this).attr('id');
        var ajax = $(this).attr('data-server');
        if (ajax == 'false') {
            var pageLength = $(this).attr('data-page-length');
            initDataTables('#' + id, {
                iDisplayLength : pageLength ? 25 : pageLength
            });
        }
    })

    initActionDeleteClick();
});

function initDatatablesAjax(selector, url, columns, displayLength)
{
    displayLength = (displayLength ? displayLength : 25);
    return initDataTables(selector, {
        ajax: url,
        processing: true,
        serverSide: true,
        columns: columns,
        iDisplayLength: (displayLength ? displayLength : 25),
        aLengthMenu: [[displayLength, 25, 50, -1], [displayLength, 25, 50, "All"]]
    });
}

function initDataTables(selector, options)
{
    var options = (options ? options : {});
    options.responsive = true;
    options.order = getOrderBy(selector);
    // options.aLengthMenu = [[15, 25, 50, -1], [15, 25, 50, "All"]];
    // options.iDisplayLength = 15; // original
     options.iDisplayLength = 25;
//	options.language =  { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json" }; // Directement dans les options au début
//	options.language =  { "url": "https://www.mvbois-vosges.fr/js/datatable-language-fr.json" };
    options.sDom = "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
        "t" +
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>";
    options.drawCallback = function(settings) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // datatable
    var table = $(selector).DataTable(options);

    // reregister the tooltip events on table
    table.$('[data-toggle="tooltip"]').tooltip();

    return table;
}

function getOrderBy(element)
{
    var orderByVal = $(element).attr('data-order-by');

    var orderBy = [0, 'asc'];
    if (!(orderByVal == 'false' || orderByVal == false || orderByVal == undefined)) {
        var pieces = orderByVal.split('|');
        if (pieces.length == 1) {
            orderBy = [pieces[0], 'asc'];
        }
        else if (pieces.length == 2) {
            orderBy = [pieces[0], pieces[1]];
        }
    }

    return orderBy;
}

function initActionDeleteClick(element)
{
    $('.dt-table').off('click', '.btn-delete-row');
    $('.dt-table').off('click', '.btn-confirm-modal-row');
    if(element) {
        element.off('click', '.btn-delete-row');
        element.off('click', '.btn-confirm-modal-row');
    }

    // DELETE ROW LINK
    $('.dt-table').on('click', '.btn-delete-row', onActionDeleteClick);
    $('.dt-table').on('click', '.btn-confirm-modal-row', onConfirmRowlick);

    if(element) {
        element.on('click', '.btn-delete-row', onActionDeleteClick);
        element.on('click', '.btn-confirm-modal-row', onConfirmRowlick);
    }

    function onActionDeleteClick(e)
    {
        e.preventDefault();
        var formId = $(this).attr('data-form');
        var title = $(this).attr('data-original-title');
        if (title.length > 7) {
//            title = '<strong>' + title.substring(0, 6).toLowerCase() + '</strong> le <strong>' + title.slice(7) + '</strong>';
            title = '<strong>' + title + '</strong>';
        }

        var content = "&Ecirc;tes-vous sur de vouloir " + title + " cette entrée ? ";
        $('#modal-confirm').find('.modal-body').find('p').html(content);
        $('#modal-confirm').find('.modal-footer').find('.btn-primary').on('click', function (e)
        {
            $('#' + formId).submit();
        });
        $('#modal-confirm').modal('show');

        return false;
    }

    function onConfirmRowlick(e)
    {
        e.preventDefault();
        var formId = $(this).attr('data-form');
        var title = $(this).attr('data-original-title');
        title = '<strong>' + title + '</strong>';

        var content = "&Ecirc;tes-vous sur de vouloir " + title + " ? ";
        $('#modal-confirm').find('.modal-body').find('p').html(content);
        $('#modal-confirm').find('.modal-footer').find('.btn-primary').on('click', function (e)
        {
            $('#' + formId).submit();
        });
        $('#modal-confirm').modal('show');
        return false;
    }
}