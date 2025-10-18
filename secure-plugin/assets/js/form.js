jQuery(document).ready(function ($) {
    $('#user_info_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: siteInfo.ajaxUrl,
            data: {
                action: 'secure_plugin_form',
                nonce: siteInfo.nonce,
                form_data: $(this).serialize()
            },
            success: function (response) {
                console.log(siteInfo);
                if (response.success) {
                    $('#user_info_form').trigger('reset')
                    // $(this).trigger('reset')
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
            },
            error: function (eror) {
                 Toastify({
                        text: eror,
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