var noErrors;

function checkRegExp(field, regExp) {
    if(field.val().match(regExp)) fieldCorrect(field);
    else fieldIncorrect(field);
}

function fieldCorrect(field) {
    $(field).addClass('borderYellow');
    $(field).removeClass('borderRed');
    $(field).siblings('.errorMessage').slideUp();
}

function fieldIncorrect(field) {
    $(field).addClass('borderRed');
    $(field).removeClass('borderYellow');
    $(field).siblings('.errorMessage').slideDown();
    noErrors = false;
}

function fieldNeutral(field) {
    $(field).removeClass('borderRed');
    $(field).removeClass('borderYellow');
    $(field).siblings('.errorMessage').slideUp();
}

function submitForm(checkFunctions, form = false, message = false) {
    noErrors = true;
    for(var f of checkFunctions) {
        f();
    }
    if(noErrors) {
        if(form) clearForm(form);
        if(message) openModal(message);
    }
}

function clearForm(form) {
    $(form).find('.textField').val('').removeClass('borderYellow');
}

function openModal(message) {
    $('body').append(`<div class="successModal"><div class="cover"><div class="modalContent"><span class="font-small">${message}</span><button class="font-medium btnCloseModal"><i class="fas fa-times"></i></button></div></div></div>`);
    $('.successModal, .modalContent').hide();
    $('.successModal .cover, .btnCloseModal').click(closeModal);
    $('.modalContent').click(function(e) {
        e.stopPropagation();
    });
    $('.successModal').fadeIn('fast', function() {
        $('.modalContent').fadeIn('fast');
    });
}

function closeModal() {
    $('.modalContent').fadeOut('fast', function() {
        $('.successModal').fadeOut('fast', function() {
            $('.successModal').remove();
        });
    });
}