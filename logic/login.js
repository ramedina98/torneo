/*here we have everything related to the login page...*/

//get the error message element...
const errorMessage = document.querySelector('.cont_error'); 

//verify if the error message exits...
if(errorMessage){
    setTimeout(function(){
        errorMessage.style.display = 'none';
    }, 5000);
}

//get the button...
const buttonViewable1 = document.getElementById('view_btn_1');
const buttonViewable2 = document.getElementById('view_btn_2');
//get the password input...
const passInput = document.querySelector('.password_input');
const passInput2 = document.querySelector('.password_input_conf');

buttonViewable1.addEventListener('click', (e) => {
    e.preventDefault();
    if(passInput.type === 'password'){
        passInput.type = 'text';
        buttonViewable1.innerHTML = `<i class='bx bxs-hide'></i> Ocultar Contraseña`;
    } else{
        passInput.type = 'password';
        buttonViewable1.innerHTML = `<i class='bx bxs-face'></i> Ver contraseña`;
    }
})

if(buttonViewable2){
    buttonViewable2.addEventListener('click', (e) => {
        e.preventDefault();
        if(passInput2.type === 'password'){
            passInput2.type = 'text';
            buttonViewable2.innerHTML = `<i class='bx bxs-hide'></i> Ocultar Contraseña`;
        } else{
            passInput2.type = 'password';
            buttonViewable2.innerHTML = `<i class='bx bxs-face'></i> Ver contraseña`;
        }
    })
}