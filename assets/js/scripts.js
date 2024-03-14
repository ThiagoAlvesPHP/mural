$(function () {
    setTimeout(() => {
        $('.loading').hide();
    }, 1500);

    $("[name='whatsapp']").mask("(99)99999-9999");

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

    $(document).on('click', '.colors .radio-inline', function(e) {
        let divs = $(this).parent().find('.radio-inline');
        $(divs).removeClass('active');
        $(this).addClass('active');

        preview();
    });

    function preview() {
        let name = $('#name').val();
        let email = $('#email').val();
        let city = $('#city').val();
        let whatsapp = $('#whatsapp').val();
        let age = $('#age').val();
        var age_text = $('input[name="age_text"]').val();
        let guidance = verify($("[name='guidance']"));
        let interest = verify($("[name='interest']"));
        let color = verify($("[name='color']"));
        
        age = age ? age : age_text;
        
        if (name != '' && email != '' && whatsapp != '' && age != '' && guidance && interest && color) {
            let guidance = valueChecked($("[name='guidance']"));
            let interest = valueChecked($("[name='interest']"));
            let color = valueChecked($("[name='color']"));

            let params = {
                name: name,
                email: email, 
                city:city, 
                whatsapp: whatsapp, 
                age: age, 
                guidance: guidance, 
                interest: interest, 
                color: color
            }
            
            $.ajax({
                method: "POST",
                url: `${url}home/ajax`,
                dataType: "json",
                data: params,
                beforeSend : function(){
                    $('.loading').show();
                }
            })
            .done(function( data ) {
                if (data.status) {
                    let html = `<div class="alert alert-info"><span style="color: ${data.data.colorHex};">${data.data.message}</span></div>`;
                    $('#result').html(html);
                    setTimeout(() => {
                        $('.loading').hide();
                    }, 1000);   
                }
            })
            .fail(function(jqXHR, textStatus, msg){
                setTimeout(() => {
                    $('.loading').hide();
                }, 1000);
            });

            $('.complement').css('display', 'flex')
            $('.btn-success').attr('disabled', false)
        } else {
            if (!guidance && !interest) {
                $('.error').addClass('alert alert-warning');
                $('.error').text('Preencha todos os campos!');   
            }
        }
    }

    /**
     * verify
     */
    function verify(props) {
        if (props) {
            let status = false;

            for (let i = 0; i < props.length; i++) {
                const element = props[i];
                if ($(element).prop('checked')) {
                    status = true;
                }
            }
            return status;
        }
    }
    /**
     * value checked
     */
    function valueChecked(props) {
        if (props) {
            let value = '';

            for (let i = 0; i < props.length; i++) {
                const element = props[i];
                if ($(element).prop('checked')) {
                    value = $(element).val();
                }
            }
            return value;   
        }
    }

    /**
     * complement
     */
    // $(document).on('keyup', '#complement', function(){
    //     let text = $(this).val();
    //     let result = $('#result span').text();

    //     result += `${text}`;

    //     $('#result span').text(result);
    // });
});