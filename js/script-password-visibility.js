$(function () {
    $("#toggle_pwd_1").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
       var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password_1").attr("type", type);
    });
    $("#toggle_pwd_2").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
       var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password_2").attr("type", type);
    });
    $("#toggle_pwd").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
       var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password").attr("type", type);
        $("#password_current").attr("type", type);
    });
});