
$(".div-msg").fadeIn();
setTimeout(function () {
    $(".div-msg").fadeOut();
}, 1500);

$("#update-selector").change(function () {
    var gameId = $(this).find("option:selected").val();
    var gameData = $('#gameData').text().trim();
    var games = JSON.parse(gameData);

    $.each(games, function (index, game) {
        console.log(index);
        if (gameId == 0) {
            $("#game-name").val("");
            $("#game-gender").val("");
            $("#game-developer").val("");
            $("#game-release-date").val("");
            $("#game-description").val("");
        } else if (gameId == index + 1) {
            $("#game-name").val(game["name"]);
            $("#game-gender").val(game["gender"]);
            $("#game-developer").val(game["developer"]);
            $("#game-release-date").val(game["release_date"]);
            $("#game-description").val(game["description"]);
        }
    });
});

$("#add").click(function () {
    $("#addNewGame").show();
    $("#back").show();
})

$("#update").click(function () {
    $("#updateGame").show();
    $("#back").show();
})

$("#delete").click(function () {
    $("#deleteGame").show();
    $("#back").show();
})

$("#back").click(function () {
    $("#deleteGame").css("display", "none")
    $("#updateGame").css("display", "none")
    $("#addNewGame").css("display", "none")
    $("#back").css("display", "none")
})

$(".cancelar").click(function () {
    $("#deleteGame").css("display", "none")
    $("#updateGame").css("display", "none")
    $("#addNewGame").css("display", "none")
    $("#back").css("display", "none")
})

if (mostraLista) {
    $('.slider').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 1500,
                    dots: false,
                    arrows: false
                }
            },
            {
                breakpoint: 960,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 1500,
                    dots: false,
                    arrows: false
                }
            }, ,
            {
                breakpoint: 780,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 1500,
                    dots: false,
                    arrows: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 1500,
                    dots: false,
                    arrows: false
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 1500,
                    dots: false,
                    arrows: false
                }
            }
        ]
    })
} else {
    $("#void_list").css("display", "block")
}

$("#create").click(function () {
    $('#form-addNewGame').validate({
        rules: {
            name: {
                required: true
            },
            gender: {
                required: true
            },
            developer: {
                required: true
            },
            release_date: {
                required: true,
                dateISO: true
            },
            description: {
                required: true
            }
        },
        messages: {
            name: "Please enter a title",
            gender: "Please enter a gender",
            developer: "Please enter a developer",
            release_date: {
                required: "Please enter a release date",
                dateISO: "Please enter a valid date in the format yyyy-mm-dd"
            },
            description: "Please enter a description"
        }
    })
});

$("#save").click(function () {
    $('#form-updateGame').validate({
        rules: {
            game_id: {
                required: true,
                min: 1
            },
            name: {
                required: true
            },
            gender: {
                required: true
            },
            developer: {
                required: true
            },
            release_date: {
                required: true,
                dateISO: true
            },
            description: {
                required: true
            }
        },
        messages: {
            game_id: {
                required: "Please select a game",
                min: "Please select a game"
            },
            name: "Please enter a title",
            gender: "Please enter a gender",
            developer: "Please enter a developer",
            release_date: {
                required: "Please enter a release date",
                dateISO: "Please enter a valid date in the format yyyy-mm-dd"
            },
            description: "Please enter a description"
        }
    })
});

$("#confirm").click(function () {
    $('#form-deleteGame').validate({
        rules: {
            game_id: {
                required: true,
                min: 1
            },
            adminPassword: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            game_id: {
                required: "Please select a game",
                min: "Please select a game"
            },
            adminPassword: {
                required: "Please enter the admin password",
                minlength: "Password must be at least 8 characters long"
            }
        }
    })
});