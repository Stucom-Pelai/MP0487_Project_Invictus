    // Función para verificar si las cookies han sido aceptadas
    function cookiesAccepted() {
        return localStorage.getItem('cookies_accepted') === 'true';
    }

    // Verificar si las cookies han sido aceptadas previamente
    if (cookiesAccepted()) {

        $('#form-cookies').css("display", "none");
        $('#boton_cookies').hide(); 
        $('#cookie-consent_').hide();

        $('.boton_header').show(); 
        $('.botonUs').show();
        $('.boton').show();
        $('.img_header>nav a').show();
        $('.center2').show();
    } else {
        $('#form-cookies').css("display", "none");
        $('#boton_cookies').hide(); 
        $('#cookie-consent_').show();

        $('.boton_header').hide(); // Ocultar el formulario de login si las cookies no han sido aceptadas
        $('.botonUs').hide();
        $('.boton').hide();
        $('.img_header>nav a').hide();
        $('.center2').hide();

    }

    // Ocultar el aviso de cookies y mostrar el formulario de login al aceptar las cookies
    $('#accept-cookies').click(function(){
        $('#cookie-consent_').hide();
        $('#form-cookies').css("display", "none");
        $('#boton_cookies').hide(); 

        $('.boton_header').show(); 
        $('.botonUs').show();
        $('.boton').show();
        $('.img_header>nav a').show();
        $('.center2').show();

        // Guardar la aceptación de cookies en el almacenamiento local
        localStorage.setItem('cookies_accepted', 'true');
    });

    $("#decline-cookies").click(function(){
        $('#cookie-consent_').hide();
        $('#form-cookies').css("display", "inline-block");
        $('#boton_cookies').show(); 
    })

    $("#boton_cookies").click(function(){
        $('#cookie-consent_').show();
    })

    $('.slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        autoplay: true,
        autoplaySpeed: 2500,
        arrows:false,
        responsive: [
            {
                breakpoint: 1400,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2500,
                    dots: false,
                    arrows:false,
                }
            },
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2500,
                    dots: true,
                    arrows: false
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2500,
                    dots: true,
                    arrows: false
                }
            },
            {
                breakpoint: 500,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2500,
                    dots: true,
                    arrows: false
                }
            }
        ]
    })
