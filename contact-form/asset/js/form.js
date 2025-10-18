jQuery(document).ready(function($){
    $('.contact-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: siteInfo.ajaxUrl,
            data: {
                action: 'contact_form',
                nonce: siteInfo.nonce,
                form_data: $(this).serialize(),
            },
            success: function(response) {
                if(response.success) {
                    $('.contact-form').trigger('reset');
                        Toastify({
                        text: response.data.message || "Form submitted successfully!",
                        duration: 3000,
                        close: true,
                        gravity: "top", // top or bottom
                        position: "right", // left, center or right
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true
                    }).showToast();
                } else {
                    Toastify({
                        text: response.data.message,
                        duration: 3000,
                        close: true,
                        gravity: "top", // top or bottom
                        position: "right", // left, center or right
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true
                    }).showToast();
                }
            }
            
        })
    })
})