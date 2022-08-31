$( document ).ready(function() {
    $("#btn_up").click(
        function(){
            sendAjaxForm('result_form', 'signup_form', 'action_signup.php');
            return false;
            }
        );
 });
        
function sendAjaxForm(result_form, signup_form, url) {
    $.ajax({
        url: url, 
        type: "POST", 
        dataType: "json", 
        data: $("#"+signup_form).serialize(),
        success: function(errors){
            if(errors['name']){
                $('#name').html(errors['name']);
            }
            if(errors['login']){
                $('#login').html(errors['login']);
            }
            if(errors['email']){
                $('#email').html(errors['email']);
            }
            if(errors['password']){
                $('#password').html(errors['password']);
            }
            if(errors['name']){
                $('#password_confirm').html(errors['password_confirm']);
            }
            if(errors['result']){
                $('#result_form').html(errors['result']);
            }
        },
        error: function(response) {
            $('#result_form').html('Ошибка. Данные не отправлены.');
        }
    });
}
        