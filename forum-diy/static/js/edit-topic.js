const contentTextbox = new SimpleMDE({element: $("#content")[0]});
const receivedContentValue = $('#currentContent').val();

contentTextbox.value(receivedContentValue);


/*
onSubmit() is called by reCaptcha. We get a token in return, that needs
to be send to the server to get verified.
 */
$(document).on('click', '#btnSubmit', function (event) {
    event.preventDefault();
    // Check if fields are empty and valid
    try{
        if($('#topic_name').val()=='') throw 'Add topic name';
        if($('#category_id').val()=='') throw 'Choose category';
        if(contentTextbox.value()=='') throw 'Write some content for your topic';

        if($('#topic_name').val().length < 5) throw 'Topic name should be at least 5 characters';
        if($('#topic_name').val().length > 255) throw 'Topic name should be less than 255 characters';
        if(contentTextbox.value().length < 5) throw 'Topic content should be at least 5 characters';
    } catch (e) {
        displayError(e)
        return;
    }
    var form = $('#new-topic-form');
    var formData = new FormData(form[0]);
    formData.append('content', contentTextbox.value())
    // Make an ajax call
    $.ajax({
        url: 'api-edit-topic',
        type: 'POST',
        data: formData,
        dataType: 'json',
        // cache: false,
        contentType: false,
        processData: false
    }).always(function (response) {
        /*
        Response should include the status code
        and, if successful, the ID so we can go directly to the page.
        Otherwise, the error code. It should be a little bit more specific
         */
        // console.log('response', response);
        if (response.status == 1) {
            // redirect to the proper page
            displaySuccess();
            window.location.href = "topic?id=" + response.topic;
        } else if(response.status == 0){
            displayError(response.message);
        } else{
            displayError('Internal Server error')
        }
    });
})