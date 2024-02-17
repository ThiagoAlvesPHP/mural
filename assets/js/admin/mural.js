$(function () {
    $(document).on('change', '.photo_valid', function () {
        let photo_valid = $(this).val();
        let id = $(this).parent().find('.id').val();
        location.href = `?photo_valid=${photo_valid}&id=${id}`;
    });
});