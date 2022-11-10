$(function () {
    setTimeout(() => {
        $('.loading').hide();
    }, 1500);

    $("[name='whatsapp']").mask("(99)99999-9999");

    $(document).on('click', '.colors .radio-inline', function(e) {
        let divs = $(this).parent().find('.radio-inline');
        $(divs).removeClass('active');
        $(this).addClass('active');
    });
    $(document).on('click', '.guidances .radio-inline', function(e) {
        let divs = $(this).parent().find('.radio-inline');
        $(divs).removeClass('active');
        $(this).addClass('active');
    });
    $(document).on('click', '.interests .radio-inline', function(e) {
        let divs = $(this).parent().find('.radio-inline');
        $(divs).removeClass('active');
        $(this).addClass('active');
    });
});