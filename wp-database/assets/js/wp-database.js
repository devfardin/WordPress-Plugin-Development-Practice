jQuery(document).ready(function ($) {
    $('.employee-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: siteInfo.admin_url,
            data: {
                action: 'wp_databases',
                nonce: siteInfo.nonce,
                form_data:  $(this).serialize(),
            },
        
            success: function (response) {
                $('.employee-form').trigger('reset');
                console.log(response);
                Toastify({
                    text: response.data.message || "Form submitted successfully!",
                    duration: 3000,
                    close: true,
                    gravity: "top", // top or bottom
                    position: "right", // left, center or right
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    stopOnFocus: true
                }).showToast();
            },
            error: function (eror) {
                console.log(eror);
                
                Toastify({
                    text: eror.message,
                    duration: 3000,
                    close: false,
                    gravity: "top", // top or bottom
                    position: "right", // left, center or right
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    stopOnFocus: true
                }).showToast();
            }
        })
    })
})