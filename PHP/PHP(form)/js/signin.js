$( document ).ready(function() {
  $("#btn_in").click(
    function(){
      sendAjaxForm('result_form', 'signin_form', 'action_signin.php');
      return false;
      }
    );
});

function sendAjaxForm(result_form, signin_form, url) {
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: $("#"+signin_form).serialize(),
        success: function(result) {
          switch (result.status)
          {
            case 'ok':
              window.location.href = 'profile.php';
            break;
            case 'login_problem':
                $('#signin_problem').html('Нет пользователя с таким логином');
            break;
            case 'pass_problem':
                $('#signin_problem').html('Проверьте пароль');
            break;
          }
        },
      	error: function(response) {
              $('#result_form').html('Ошибка. Данные не отправлены.');
      	}
   	});
}
