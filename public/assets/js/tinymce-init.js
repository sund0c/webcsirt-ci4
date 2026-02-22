document.addEventListener("DOMContentLoaded", function () {

    const editors = document.querySelectorAll('[data-tinymce="true"]');
    if (editors.length === 0) return;

    const csrfNameMeta = document.querySelector('meta[name="csrf-token-name"]');
    const csrfHashMeta = document.querySelector('meta[name="csrf-token-hash"]');

    const csrfName = csrfNameMeta ? csrfNameMeta.content : null;
    const csrfHash = csrfHashMeta ? csrfHashMeta.content : null;

    editors.forEach(function (el) {

        if (!el.id) {
            el.id = 'tinymce_' + Math.random().toString(36).substr(2, 9);
        }

        if (tinymce.get(el.id)) return;

        tinymce.init({

            selector: "#" + el.id,
            height: el.dataset.height || 500,
            license_key: 'gpl',

            plugins: [
                'lists',
                'link',
                'image',
                'table',
                'code',
                'fullscreen'
            ],

            toolbar:
                'undo redo | styles | bold italic underline | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist | link image table | code fullscreen',

            menubar: false,
            branding: false,

            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,

            automatic_uploads: true,
            images_upload_credentials: true,

            formats: {
                alignleft:  { selector: 'img', classes: 'img-left' },
                aligncenter:{ selector: 'img', classes: 'img-center' },
                alignright: { selector: 'img', classes: 'img-right' }
            },

            invalid_styles: {
                '*': 'margin margin-left margin-right display'
            },

            images_upload_handler: function (blobInfo, progress) {

                return new Promise(function (resolve, reject) {

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/portal-internal-x83fj9/pages/upload-image');
                    xhr.withCredentials = true;

                    xhr.upload.onprogress = function (e) {
                        progress(e.loaded / e.total * 100);
                    };

                    xhr.onload = function () {

                        if (xhr.status !== 200) {
                            reject('HTTP Error: ' + xhr.status);
                            return;
                        }

                        let json;

                        try {
                            json = JSON.parse(xhr.responseText);
                        } catch (e) {
                            reject('Invalid JSON response');
                            return;
                        }

                        if (!json || typeof json.location !== 'string') {
                            reject('Invalid upload response');
                            return;
                        }

                        resolve(json.location);
                    };

                    xhr.onerror = function () {
                        reject('Image upload failed.');
                    };

                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    if (csrfName && csrfHash) {
                        formData.append(csrfName, csrfHash);
                    }

                    xhr.send(formData);
                });
            }
        });

    });

});