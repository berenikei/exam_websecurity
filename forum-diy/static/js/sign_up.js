//AJAX POST Request with sign_up data 
$('#frmSignup').submit(function(e){
    e.preventDefault()

      // try and catch to handle frontend validation
      // TODO: use switch statements?
      try{
        if($('#frmSignup input[name = "txtUsername"]').val() =='') throw 'Add username';
        if($('input[name = "txtEmail"]').val() =='') throw 'Add email';
        if($('#frmSignup input[name = "txtPassword"]').val() =='') throw 'Add password';
        if($('input[name = "txtConfirmPassword"]').val() =='') throw 'Confirm password';

        if($('#frmSignup input[name = "txtUsername"]').val().length < 6) throw 'Username should be at least 6 characters';
        if($('#frmSignup input[name = "txtUsername"]').val().length > 20) throw 'Username should be less than 20 characters';

        if($('#frmSignup input[name = "txtPassword"]').val().length < 8) throw 'Password should be at least 8 characters';
        
        if($('#frmSignup input[name = "txtPassword"]').val() != $('input[name = "txtConfirmPassword"]').val()) throw 'Passwords don\'t match';

      } catch (e) {
        displayError(e)
        return;
      }

    $.ajax({
      url: "create-user",
      method: "POST",
      data: $('#frmSignup').serialize(),
      dataType: "JSON"
    }).always(function(jData){

        if(jData.status == 1){
          // console.log('user created successfuly');
          document.getElementById("err-msg").style.display ="none";
          displaySuccess();
          setTimeout("location.href = './index.php';", 2000)
        }else if(jData.status == 0){
          //TODO create a toast message or something like that ?
          //$('h1').text('Incorrect login')
          displayError(jData.message);
        }
        // else if(jData.status === 200){
        //     displaySuccess();
        //     setTimeout("location.href = './index.php';", 4000)
        // } 
        else{
          // when we get a php error and pass it in the response text
          displayError('Internal Server error')
        }
    })
  });

