//Jquery...
$(document).ready(function(){
    $(document).ready(function(){
        /*when the course passes through the button, the text should appear...*/
        $('#btn_add').click(function(){
            alert.log('hola');
        })
        //this function helps us to convert the frist letter to capital letter...
        const firstCapitalLetter = (chain) => {
            return chain.charAt(0).toUpperCase() + chain.slice(1);
        }

        $('.navegador li a').on('click', function(){
            // we get the id...
            var clickedId = $(this).attr('id');

            // component path according to id...
            var componentPath = './views/components/' + clickedId + '.php';

            // performs component loading using AJAX...
            $.ajax({
                url: componentPath,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    //we change the title of the page...
                    $('#title').text(firstCapitalLetter(clickedId));
                    //we insert the content of the component...
                    $('#container_components').html(data);
                },
                error: function() {
                    //we change the title of the page...
                    $('#title').text('Error');
                    //we insert the content of the component...
                    $('#container_components').html(`<div class="container">
                            <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                                <h1>404</h1>
                                <h2>The page you are looking for doesn't exist.</h2>
                                <a class="btn" href="index.html">Back to home</a>
                                <img src="assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
                                <div class="credits">
                                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                                </div>
                            </section>
                        </div>`);
                }
            });
        });
    });
});

//btn add from participantes.php component...
$(document).on({
    mouseenter: function () {
        //Event when hovering over the button...
        $(this).fadeOut('slow', function() {
            $(this).html('<i class="bx bxs-plus-circle"></i> Añadir un nuevo participante').fadeIn('fast');
        });
    },
    mouseleave: function () {
        //Event whe th cursor is removed from the button...
        $(this).fadeOut('slow', function() {
            $(this).html('<i class="bx bxs-plus-circle"></i>').fadeIn('fast');
        });
    }
}, '#btn_add');