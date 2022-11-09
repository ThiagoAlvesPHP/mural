$(function () {
    setTimeout(() => {
        $('.loading').hide();
    }, 1500);

    $("[name='whatsapp']").mask("(99)99999-9999");
});