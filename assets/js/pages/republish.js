$(function () {
    console.log(url);
    $(document).on('click', '.republish form button', function (el) {
        el.preventDefault();

        let email = $('.republish form').find('input').val();

        $.ajax({
            type: 'POST',
            url: `${url}home/muralUpdate`,
            data: { email: email },
            success: function (response) {
                data = JSON.parse(response);
                alert(data.message);

                if (data.status) {
                    location.href = url + "?id=" + data.id;
                }
            },
            error: function (error) {
                console.log('Erro na requisição AJAX:', error);
            }
        });
    });
});