
$(".div-msg").fadeIn();
setTimeout(function() {
    $(".div-msg").fadeOut();
}, 1500);

$("#loginForm").validate({
    rules: {
        email: {
            required: true,
            minlength: 8,
            pattern : /[^\s@]+@[^\s@]+\.[^\s@]/,
        },
        password: {
            required: true,
            minlength: 8 
        }
    },
    messages: {
        email: {
            required: "Please enter your email address",
            minlength: "Please enter at least 8 characters.",
            pattern: "Please enter a valid email address"
        },
        password: {
            required: "Please enter your password",
            minlength: "Password must be at least 8 characters long"
        }
    }
    
});