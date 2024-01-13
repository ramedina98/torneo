//btn add from participantes.php component...
$(document).on({
    mouseenter: function () {
        //Event when hovering over the button...
        $(this).fadeOut('normal', function() {
            $(this).html('<i class="bx bxs-plus-circle"></i> Añadir un nuevo participante').fadeIn('normal');
        });
    },
    mouseleave: function () {
        //Event whe th cursor is removed from the button...
        $(this).fadeOut('normal', function() {
            $(this).html('<i class="bx bxs-plus-circle"></i>').fadeIn('normal');
        });
    }
}, '#btn_add');