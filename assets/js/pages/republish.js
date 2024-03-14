$(function () {
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

    $(document).on('click', '.interests-primary label', function(el){
        //el.preventDefault();
        let value = $(this).find('input').val();
        let interest_primary_id = value.split(':')[0];
        let labels = $(`.interests-primary-select${interest_primary_id}`);

        let interests = $('.interests label');

        for (let i = 0; i < interests.length; i++) {
            const element = interests[i];
            $(element).removeClass('active-blue');            
        }

        for (let i = 0; i < labels.length; i++) {
            const element = labels[i];
            $(element).addClass('active-blue');
        }

        console.log($(interests));
    });
});