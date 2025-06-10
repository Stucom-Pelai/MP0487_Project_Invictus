$(".div-msg").fadeIn();
setTimeout(function () {
    $(".div-msg").fadeOut();
}, 1500);

$("#back").click(function () {
    $("#confirmacion").css("display", "none")
    $("#back").css("display", "none")
})

$("#cancelar").click(function () {
    $("#confirmacion").css("display", "none")
    $("#back").css("display", "none")
})

$("#botonDelete").click(function () {
    $("#confirmacion").show();
    $("#back").show()
})

$("#update").click(function () {
    $("#form-settings").validate({
        rules: {
            email: {
                minlength: 8,
                pattern: /[^\s@]+@[^\s@]+\.[^\s@]/
            },
            username: {
                minlength: 4,
                maxlength: 30
            },
            surname: {
                minlength: 4,
                maxlength: 30
            },
            nickname: {
                minlength: 4,
                maxlength: 30
            },
            description: {
                minlength: 30,
                maxlength: 400
            },
            old_password: {
                minlength: 8
            },
            new_password: {
                minlength: 8
            },
            new_password_confirmation: {
                minlength: 8,
                equalTo: "#new_password"
            }
        },
        messages: {
            email: {
                minlength: "Email must be at least 8 characters long.",
                pattern: "Please enter a valid email address."
            },
            username: {
                minlength: "Username must be at least 4 characters long.",
                maxlength: "Username cannot be more than 30 characters long."
            },
            surname: {
                minlength: "Surname must be at least 4 characters long.",
                maxlength: "Surname cannot be more than 30 characters long."
            },
            nickname: {
                minlength: "Nickname must be at least 4 characters long.",
                maxlength: "Nickname cannot be more than 30 characters long."
            },
            description: {
                minlength: "Description must be at least 30 characters long.",
                maxlength: "Description cannot be more than 400 characters long."
            },
            old_password: {
                minlength: "Old password must be at least 8 characters long."
            },
            new_password: {
                minlength: "New password must be at least 8 characters long."
            },
            new_password_confirmation: {
                minlength: "Confirmation password must be at least 8 characters long.",
                equalTo: "Passwords do not match."
            },
        }
    })
});


