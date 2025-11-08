document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('ajax-demo-btn').addEventListener('click', async function (event) {
        console.log(ajdm.create_nonce);
        
        const formData = new FormData();
        formData.append('action', 'demo')
        formData.append('verify_nonce', ajdm.create_nonce);
        const response = await fetch(ajdm.ajax_url, {
            method: 'POST',
            body: formData,
        })
        const jsonData = await response.json();
        console.log(jsonData);
        alert(jsonData.data)
    })

    const contactForm = document.getElementById('ajax-contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', async function (e) {
            e.preventDefault();
           const formData = new FormData(this);
           formData.append('action', 'contact_form_ajax');
           formData.append('contact_form_ajax', ajdm.contact_nonce);
           const response = await fetch(ajdm.ajax_url, {
            method: 'POST',
            body: formData,
           })
           const result = await response.json();
           const resultDiv = document.getElementById('ajax-contact-result')
           if(result.success) {
            resultDiv.innerHTML = `<p> ${result.data} </p>`
            this.reset();
           } else {
             resultDiv.innerHTML = `<p>  ${result.data} </p>`
           }
        })
    }
})