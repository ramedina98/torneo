//this function helps us to convert the frist letter to capital letter...
const firstCapitalLetter = (chain) => {
    let name = ''; //this is the variable that will be return...
    //here we store the string with the first capital letter...
    let CapitalLetter = chain.charAt(0).toUpperCase() + chain.slice(1);
    
    //we check if there are any underscore...
    if(CapitalLetter.includes('_')){
        let parts = CapitalLetter.split('_');
        name = parts[0] + ' ' + parts[1];
    } else{
        name = CapitalLetter;
    }

    return name;
}
/*TODO: Tal vez poder cambiar el icono de la pestaña.
Tambien el boton correspondiente en el nav debe de estar 
sobre saltado... */

//global variable... <-- TODO: Checar si esto esta bien...
let previusID = null;
const highlightBtn = (previusID, currentID) => {
    //we remove the class...
    $(`#${currentID}`).removeClass('collapsed');

    //if it is not null, we proceed to add the class...
    if(previusID !== null){
        $(`#${previusID}`).addClass('collapsed');
    }
}

//this function inject the corresponding component...
const loadComponent = (name) => {
    //empty or not? 
    if (name === '') {
        //this is the name of the default component...
        name = 'inicio';
    }

    // component path according to id...
    var componentPath = './views/components/' + name + '.php';

    // performs component loading using AJAX...
    $.ajax({
        url: componentPath,
        type: 'GET',
        dataType: 'html',
        success: function(data) {
            //we change the title of the page...
            $('#title').text(firstCapitalLetter(name));
            //we add text to the title tag...
            $('title').prop('text', 'Torneos || ' + firstCapitalLetter(name));
            //we highlight the corresponding btn on the sider...
            highlightBtn(previusID, name);
            //we insert the content of the component...
            $('#container_components').html(data);
            //save the name of the component...
            previusID = name;
        },
        error: function() {
            //we change the title of the page...
            $('#title').text('Error');
            //we add text to the title tag...
            $('title').prop('text', name);
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
}
//Jquery...
$(document).ready(function(){
    //let's the url with the hash and everything...
    let currentHash = window.location.hash;

    //we get what is after the #...
    let componentName = currentHash.substring(currentHash.lastIndexOf('#') + 1);
    
    //we call the corresponding function to inject the component...
    loadComponent(componentName);

    /*here we detect the change in the url, taking what is after 
    the # which is the componet name... */
    window.onpopstate = function () {
        //let's the url with the hash and everything...
        let hash = window.location.hash;
        //we get what is after the #...
        let componentName = hash.substring(hash.lastIndexOf('#') + 1);
        //we call the corresponding function to inject the component...
        loadComponent(componentName);
    };
});