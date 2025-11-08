jQuery(document).ready(function ($) {
    $('.contact-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: support.admin_url,
            data: {
                action: 'support_form',
                nonce: support.nonce,
                form_data: $(this).serialize(),
            },
            success: function (response) {
                console.log(response.data);
                 $('.contact-form').trigger('reset');
                alert(response.data.message)
            },
            error: function(error){
                console.log(error); 
            }
        })
    })
})