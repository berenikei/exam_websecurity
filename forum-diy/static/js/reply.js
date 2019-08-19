const contentTextbox = new SimpleMDE({element: $("#content")[0]});
contentTextbox.value("Write down your thoughts here... We support markdown syntax here.");

$(document).on('click', '#btnSubmit', function (event) {
    event.preventDefault();
    // Check if fields are empty or valid
    try{
        if(contentTextbox.value()=='') throw 'Write something';

        if(contentTextbox.value().length < 5) throw 'Reply content should be at least 5 characters';
    } catch (e) {
        displayError(e)
        return;
    }
    var form = $('#reply-form');
    var formData = new FormData(form[0]);
    formData.append('content', contentTextbox.value())

    $.ajax({
        url: 'api-reply',
        type: 'POST',
        data: formData,
        dataType: 'json',
        // cache: false,
        contentType: false,
        processData: false
    }).always(function (response) {
        if (response.status == 1) {
            console.log(response);
            // redirect to the proper page
            displaySuccess();
            window.location.href = response.location;
        } else if(response.status == 0){
            displayError(response.message);
        } else{
            console.log(response);
            displayError('Internal Server error')
        }
    });
})