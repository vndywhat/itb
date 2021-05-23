require('./bootstrap');

$(document).ready(function () {
    $("#upload-form").submit(function () {
        event.preventDefault();

        removeValidationMessages();

        let countErrors = 0;

        let title = $('#input-title');
        let description = $('#input-description');
        let image = $("#input-image");

        if (title.val().length < 5) {
            countErrors += 1;
            title.addClass('is-invalid');
            title.after('<div id="validationTitleFeedback" class="invalid-feedback">\n' +
                '        Title must be more than 5 symbols.\n' +
                '      </div>');
        }

        if (!image[0].files.length) {
            countErrors += 1;
            image.addClass('is-invalid');
            image.after('<div id="validationImageFeedback" class="invalid-feedback">\n' +
                '        Image file is required.\n' +
                '      </div>');
        }

        if (countErrors) return;

        let formData = new FormData();
        formData.append('title', title.val());
        formData.append('description', description.val());
        formData.append('upload_file', image[0].files[0]);

        axios.post('/images', formData)
            .then(function (response) {
                resetForm();
                $('.toast').toast('show')
            })
            .catch(function (error) {
                if(error.response.data.errors) {
                    let errorsBag = $('#errorsBag');
                    Object.entries(error.response.data.errors).forEach(function (error) {
                        errorsBag.append('<li>' + error[1][0] + '</li>')
                    })
                    errorsBag.show();
                }
            })
    });

    function removeValidationMessages() {
        if ($('#input-title').hasClass('is-invalid')) $('#input-title').removeClass('is-invalid');
        $('#validationTitleFeedback').remove();
        if ($("#input-image").hasClass('is-invalid')) $("#input-image").removeClass('is-invalid');
        $('#validationImageFeedback').remove();
        $('#errorsBag').html('').hide();
    }

    function resetForm() {
        $('form#upload-form').trigger('reset');
    }
});
