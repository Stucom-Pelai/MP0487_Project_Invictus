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
        username:{
            required: true,
            minlength: 4,
            maxlength: 30
        },
        surname:{
            required: true,
            minlength: 4,
            maxlength: 30
        },
        nickname:{
            required: true,
            minlength: 4,
            maxlength: 30
        },
        password:{
            required: true,
            minlength: 8
        },
        confirm_password:{
            required: true,
            minlength: 8,
            equalTo: "#password"
        }
    },
    messages: {
        email: {
            required: "Please enter your email address.",
            minlength: "The email must be at least 8 characters long.",
            maxlength: "The email cannot be more than 40 characters long.",
            pattern: "Please enter a valid email address."
        },
        username: {
            required: "Please enter your username.",
            minlength: "The username must be at least 4 characters long.",
            maxlength: "The username cannot be more than 30 characters long."
        },
        surname: {
            required: "Please enter your surname.",
            minlength: "The surname must be at least 4 characters long.",
            maxlength: "The surname cannot be more than 30 characters long."
        },
        nickname: {
            required: "Please enter your nickname.",
            minlength: "The nickname must be at least 4 characters long.",
            maxlength: "The nickname cannot be more than 30 characters long."
        },
        password: {
            required: "Please enter your password.",
            minlength: "The password must be at least 8 characters long."
        },
        confirm_password: {
            required: "Please confirm your password.",
            minlength: "The confirmation password must be at least 8 characters long.",
            equalsTo: "Passwords do not match."
        }
        
    }
})