/*here we have all the necessary code to do the validation of inputs 
and other aspects...*/

//btn 'crear cuenta'... 
const createAccountBtn = document.querySelector('.btn');
//the form...
const form = document.querySelector('form');
//inputs...
const inputs = form.querySelectorAll('input');
//labels...
const labels = form.querySelectorAll('label');

//regular expression...
const regularExpression = {
    nameAndLastname: /^([A-Za-z]+\s?)+$/, 
    username: /^[a-zA-Z0-9]+([-_@]?[a-zA-Z0-9]+)*$/, 
    password: /^(?=.*[-_@])[a-zA-Z0-9-_@]+$/
}
//check all inputs...
const validarInputs = (e) => {
    const name = e.target.name; 
    const data = e.target.value; 
    const input = e.target;

    switch(name){
        case 'name': 
            if(regularExpression.nameAndLastname.test(data)){
                //label...
                labels[0].innerText = 'Nombre';
                labels[0].style.color = 'rgb(70, 144, 255)';
                //input...
                input.style.outline = '2px solid rgb(70, 144, 255)';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'block'; 
            } else{
                //label...
                labels[0].innerText = 'Ingrese un nombre valido';
                labels[0].style.color = 'red';
                //input...
                input.style.outline = '2px solid red';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'none'; 
            }
        break;
        case 'last_p':
            if(regularExpression.nameAndLastname.test(data)){
                //label...
                labels[1].innerText = 'Apellido Paterno';
                labels[1].style.color = 'rgb(70, 144, 255)';
                //input...
                input.style.outline = '2px solid rgb(70, 144, 255)';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'block'; 
            } else{
                //label...
                labels[1].innerText = 'Ingrese un apellido valido';
                labels[1].style.color = 'red';
                //input...
                input.style.outline = '2px solid red';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'none'; 
            }
        break;
        case 'last_m':
            if(regularExpression.nameAndLastname.test(data)){
                //label...
                labels[2].innerText = 'Apellido Materno';
                labels[2].style.color = 'rgb(70, 144, 255)';
                //input...
                input.style.outline = '2px solid rgb(70, 144, 255)';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'block'; 
            } else{
                //label...
                labels[2].innerText = 'Ingrese un apellido valido';
                labels[2].style.color = 'red';
                //input...
                input.style.outline = '2px solid red';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'none'; 
            }
        break;
        case 'username':
            if(regularExpression.username.test(data)){
                //label...
                labels[3].innerText = 'Nombre de usuario';
                labels[3].style.color = 'rgb(70, 144, 255)';
                //input...
                input.style.outline = '2px solid rgb(70, 144, 255)';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'block'; 
            } else{
                //label...
                labels[3].innerText = 'Ingrese un nombre de usuario valido';
                labels[3].style.color = 'red';
                //input...
                input.style.outline = '2px solid red';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'none'; 
            }
        break;
        case 'password':
            if(regularExpression.password.test(data)){
                //label...
                labels[4].innerText = 'Password';
                labels[4].style.color = 'rgb(70, 144, 255)';
                //input...
                input.style.outline = '2px solid rgb(70, 144, 255)';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'block'; 
            } else{
                //label...
                labels[4].innerText = 'Ingrese una contraseña valida';
                labels[4].style.color = 'red';
                //input...
                input.style.outline = '2px solid red';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'none'; 
            }
        break;
        case 'password_conf':
            if(regularExpression.password.test(data)){
                //label...
                labels[5].innerText = 'Confirmar password';
                labels[5].style.color = 'rgb(70, 144, 255)';
                //input...
                input.style.outline = '2px solid rgb(70, 144, 255)';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'block'; 
            } else{
                //label...
                labels[5].innerText = 'Ingrese una contraseña valida';
                labels[5].style.color = 'red';
                //input...
                input.style.outline = '2px solid red';
                //btn 'crear cuenta'...
                createAccountBtn.style.display = 'none'; 
            }
        break;
    }

}
/*check that the value of the input password is the same as the one 
in the confirm password...*/
const confirmPassword = (e) => {
    if(e.target.value === inputs[4].value){
        labels[5].style.color = 'rgb(70, 144, 255)';
        labels[5].innerText = 'Coincide la contraseña';
        setTimeout(function(){
            labels[5].innerText = 'Confirmar password';
        }, 3000);
    } else{
        labels[5].innerText = 'No coincide';
        labels[5].style.color = 'red';
    }
}
//password confirmation input...
inputs[5].addEventListener('blur', (e) => {
    if(e.target.value.trim() !== ''){
        confirmPassword(e);
    } else{
        validarInputs(e);
    }
})
//all inputs...
inputs.forEach((input) => {
    input.addEventListener('keyup', validarInputs);
    if(input.name !== 'password_conf'){
        input.addEventListener('blur', validarInputs);
    }
})
/*now, here we work with the 'create account' button where we will 
first check that all the inputs are filled in, and then we will send the information...*/
form.addEventListener('submit', (e) => {
    var isValid = true; 
    var valueLabels = ['Nombre', 'Apellido Paterno', 'Apellido Materno', 'Nombre de usuario', 'Password', 'Confirmar password'];

    inputs.forEach((item, index) => {
        if(item.type !== 'submit'){
            if(item.value.trim() === ''){
                //we change the border when in focus...
                item.style.outline = '2px solid red';
                labels[index].style.color = 'red';
                //we change the label text...
                labels[index].innerText = 'Esta vacío';
                //is false becaouse at least one of the inputs is empty...
                isValid = false;
            } else{
                //we change the border again...
                item.style.outline = '2px solid rgb(70, 144, 255)';
                labels[index].style.color = 'rgb(70, 144, 255)';
                //we add your default text again...
                labels[index].innerText = valueLabels[index];
            }
        }
    })

    /*TODO: hay que checar que es lo que esta pasando con el archivo PHP, como lo
    resolveremos...*/
    //we check that some of the inputs are not empty...
    if(!isValid){
        e.preventDefault();
        console.log('Uno de los campos esta vacio, por lo menos...')
    } 
});