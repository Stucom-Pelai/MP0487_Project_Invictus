$(".div-msg").fadeIn();
setTimeout(function() {
    $(".div-msg").fadeOut();
}, 1500);

$("#registerForm").validate({
    rules:{
        email:{
            required: true,
            minlength: 8,
            maxlength: 40,
            pattern: /[^\s@]+@[^\s@]+\.[^\s@]/
        },
        password:{
            required: true,
            minlength: 8
        }
    },
    messages: {
        email: {
            required: "Please enter your email address.",
            minlength: "The email must be at least 8 characters long.",
            maxlength: "The email cannot be more than 40 characters long.",
            pattern: "Please enter a valid email address."
        },     
        password: {
            required: "Please enter your password.",
            minlength: "The password must be at least 8 characters long."
        },        
    }
})