function checkform(form) {
    // get all the inputs within the submitted form
    const inputs = form.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
        // only validate the inputs that have the required attribute
        if(inputs[i].hasAttribute("required")){
            if(inputs[i].value == ""){
                // found an empty field that is required
                return false;
            }
        }
    }
    return true;
}