$("#infor-form").ready(function() {
    $("#infor-form").validate({
        rules: {
            formName:{
                required: true,
                remote: '../Model/check-username.php'
            },
            formPassword: "required",
            formPhone:{
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10,
                startsWithZero: true
                
            }, 
            formEmail: {
                required: true,
                email: true,
                remote: '../Model/check-email.php'
            }
        },
        messages: {
            formName:{
                required: "Tên không được bỏ trống",
                remote: "Username đã được sử dụng"
            }, 
            formPassword: "Mật khẩu không được bỏ trống",
            formPhone:{
                required: "Số điện thoại không bỏ trống",
                minlength: "Số điện thoại đủ 10 chữ số",
                maxlength: "Số điện thoại đủ 10 chữ số",
                number: "Số điện thoại không chứa chữ số"
            },
            formEmail: {
                required: "Email không được bỏ trống",
                email: "Hãy nhập đúng định dạng email",
                remote: "Email đã được sử dụng"    
            }
        },
    });
});     
$("#infor-form").on("submit", function(event) {
event.preventDefault();
console.log( $(this).serialize() );
$.ajax({
    type: "POST",
    url: '../Controllers/Signin-upController.php',
    data: $(this).serializeArray(),
    success: function(response) {
    
    try {
        response = JSON.parse(response);
        console.log(response.message);
        if (response.status == 0) {
            $(".error-message").text(response.message);
        } else {
            window.location.href = 'index.php';
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
$.validator.addMethod("startsWithZero", function(value, element) {
    return value.charAt(0) === '0';
}, "Số điện thoại phải bắt đầu bằng số 0");
