/*
    Relacionado ao design
*/

const containter = document.getElementById('container')
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click',()=>{
    containter.classList.add("active");
});

loginBtn.addEventListener('click',()=>{
    containter.classList.remove("active");
});

/*
    Lógica de validação
*/