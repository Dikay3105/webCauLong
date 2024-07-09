$("#signin-form").ready(function() {
    $("#signin-form").validate({
        rules: {
            username: "required",
            password: "required"
        },
        messages: {
          username: "Tên không được bỏ trống",
          password: "Mật khẩu không được bỏ trống",
        },
    });
});     
$("#signin-form").on("submit", function(event) {
event.preventDefault();
console.log( $(this).serialize() );
$.ajax({
    type: "POST",
    url: '../Controllers/Signin-upController.php',
    data: $(this).serializeArray(),
    success: function(response) {
     
    try {
        response = JSON.parse(response); 
        console.log(response.message + "thông báo lỗi");
        if (response.status == 0) {
            $(".error-message").text(response.message);
        } else {
                window.location.href = "index.php";
        }
      } catch (error) {
        console.log("lỗi");
    }
}
});
});

function focusOnErrorInput() {
var errorInput = $(".form-input.error");
if (errorInput.length > 0) {
errorInput.first().focus();
}
}
focusOnErrorInput();