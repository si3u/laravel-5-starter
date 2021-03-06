var BUTTON;
function initTitan()
{
    BUTTON = new ButtonClass();

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
        }
    });

    $('.input-generate-slug').change(function ()
    {
        var v = convertStringToSlug($(this).val());
        $("form input[name='slug']").val(v);
    })

    $('.btn-submit').attr('data-loading-text', "<i class='fa fa-spin fa-refresh'></i>");
    $('.btn-submit').on('click', function ()
    {
        $(this).button('loading');
    });

    function convertStringToSlug(text)
    {
        return text.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/&/g, '-and-')         // Replace & with 'and'
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '')             // Trim - from end of text
            .replace(/-$/, '');             // Remove last floating dash if exists
    }

    getHeaderNotifications();
}

function doAjax(url, data, callback)
{
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: "json",
        timeout: 30000,
        error: function (x, t, m)
        {
	    console.log('Erreur de requête XHR sur : '+url+' (Voir /routes/api.php)');
	    console.log(x);
            notifyError('Pardon', 'Une erreur système s\'est produite<br> à l\'appel de '+url+' (Voir la console).');
        },
        success: function (response)
        {
            if (typeof callback == 'function') {
                callback(response);
            }
        }
    });
}

/**
 * In Header of Box, the toolbox daterange icon
 * Dropdown with the selected dates to select from
 * @param selector
 * @param callback
 */
function initToolbarDateRange(selector, callback)
{
    $(selector).daterangepicker({
        ranges: {
            'Les 7 derniers jours': [moment().subtract(6, 'days'), moment()],
            'Les 30 derniers jours': [moment().subtract(29, 'days'), moment()],
            'Ce mois': [moment().startOf('month'), moment().endOf('month')],
            'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Les 3 derniers mois': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')],
            'Les 6 derniers mois': [moment().subtract(5, 'month').startOf('month'), moment().endOf('month')],
            'Sur Une année': [moment().subtract(1, 'year').startOf('month'), moment().endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function (start, end) {
        //window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        if(typeof callback === 'function') {
            callback(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        }
    });
}

/**
 * Give from and to datetimepicker inputs,
 * This will automatically set min / max date on the fields
 */
function setDateTimePickerRange(from, to)
{
    $(from).datetimepicker();
    $(to).datetimepicker({useCurrent: false});

    $(from).on("dp.change", function (e)
    {
        $(to).data("DateTimePicker").minDate(e.date);
    });
    $(to).on("dp.change", function (e)
    {
        $(from).data("DateTimePicker").maxDate(e.date);
    });
}

/*function initSummerNote(selector)
{
    $(selector).summernote({
        height: 120,
        focus: false,
        tabsize: 2,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['color', ['color']],
            ['layout', ['ul', 'ol', 'paragraph']],
           // ['insert', ['link', 'picture', 'video', 'hr']],
            ['insert', ['hr']],
            ['misc', ['fullscreen', 'codeview', 'undo']]
        ]
    });
}*/

function isFunction(variable) {
    var getType = {};
    return variable && getType.toString.call(variable) === '[object Function]';
}