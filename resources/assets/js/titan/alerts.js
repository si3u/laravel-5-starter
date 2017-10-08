/**
 * Validate the ajax response from the server
 * If an ajax error occurred - show error alert
 * @param response
 * @returns {boolean}
 */
function validateAjaxResponse(response)
{
    updateUserCredit(response); // update credit if needed

    if (!(response.success || response.data)) {
        $('#page-feedback-alert').slideDown();
        if (response.data && response.data['description'] && response.data['description'].length > 5) {
            notifyError(response.data['title'], response.data['description']);
            $('#page-feedback-alert').find('.content').html(response.data['title'] + ' ' + response.data['description']);
        } else {
            notifyError('Pardon', 'Une erreur système s\'est produite. Veuillez réessayer ou contactez nous directement.');
            $('#page-feedback-alert').find('.content').html('Désolé, une erreur système est survenue. Veuillez réessayer ou contacter nous directement.');
        }

        return false;
    }

    hideSpinner();
    return true;
}

/**
 * Validate the purchase response
 * It will show page error or insufficient funds it missing
 * @param response
 * @param key
 * @param credit
 * @returns {boolean}
 */
function validatePurchaseResponse(response, key, credit)
{
    if (!validateAjaxResponse(response)) {
        return false;
    }

    credit = (credit ? credit : 1);

    if (!response.data[key]) {

        $('#page-feedback-alert').slideDown();
        if (response.data && response.data['description'] && response.data['description'].length > 5) {
            notifyError(response.data['title'], response.data['description']);
            $('#page-feedback-alert').find('.content').html(response.data['title'] + ' ' + response.data['description']);
        } else {
            notifyError('Pardon', 'Une erreur système s\'est produite. Veuillez réessayer ou contactez nous directement.');
            $('#page-feedback-alert').find('.content').html('Désolé, une erreur système est survenue. Veuillez réessayer ou contacter nous directement.');
        }

        if (response.data['credit'] < credit) {
            $('#page-feedback-alert').find('.content').html('Vous n\'avez pas suffisamment de crédit !')
        }
        return false;
    }
    return true;
}