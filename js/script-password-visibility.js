var $ = jQuery.noConflict();

$(function () {
    $(document).on("click","#toggle_pwd_1",function(){
        $(this).toggleClass("fa-eye fa-eye-slash");
       var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password_1").attr("type", type);
    });
    $(document).on("click","#toggle_pwd_2",function(){
        $(this).toggleClass("fa-eye fa-eye-slash");
       var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password_2").attr("type", type);
    });
    $(document).on("click","#toggle_pwd",function(){
        $(this).toggleClass("fa-eye fa-eye-slash");
       var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("#password").attr("type", type);
        $("#password_current").attr("type", type);
        $("#reg_password").attr("type", type);
    });
   
});