document.addEventListener('DOMContentLoaded', function () {
    
    const button = document.getElementById('currency-converter-btn');
    if (button) {
        button.addEventListener('click', async function () {
            const formData = new FormData();
            const animation = document.getElementById('animation')
            animation.classList.add('loader')
            formData.append('action', 'currency')
            formData.append('verify_none', currency.create_nonce)
            const response = await fetch(currency.ajax_url, {
                method: 'post',
                body: formData,
            })
            const data = await response.json();

            if (data.success) {
                let html = '<ul class="rates_items_wrap">'
                document.getElementById('currency-converter-btn').disabled = true;
                for (const currency in data.data) {
                    html += `<li>BDT to ${currency} = <span>${data.data[currency]}</span></li>`
                }
                document.getElementById('currency-converter-result').innerHTML = html;
                animation.classList.remove('loader');
                html += '</ul>'
            }
            else {
                const errorMessage = document.getElementById('error_message')
                errorMessage.innerText = data.data;
            }
        })
    }


  

})

// jQuery(document).ready(function ($) {
//     $('#currency-converter-btn').on('click', async function () {
//         const formData = new FormData();
//         const animation = document.getElementById('animation')
//         animation.classList.add('loader')
//         formData.append('action', 'currency')
//         const response = await fetch(currency.ajax_url, {
//             method: 'post',
//             body: formData,
//         })
//         const data = await response.json();

//         let html = '<ul class="rates_items_wrap">'
//         if (data.success) {
//             document.getElementById('currency-converter-btn').disabled = true;
//             for (const currency in data.data) {
//                 html += `<li>BDT to ${currency} = <span>${data.data[currency]}</span></li>`
//             }
//             document.getElementById('currency-converter-result').innerHTML = html;
//             animation.classList.remove('loader');
//         }
//         html += '</ul>'

//     })

//
// })
