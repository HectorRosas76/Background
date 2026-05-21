const msg = 'Hola mundo!!';
console.log(msg);

// callback

// document.addEventListener('DOMContentLoaded', () => {
//     document.getElementsByTagName('h1')[0].textContent = "Hola app contactos";
// });

// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementsByTagName('h1')[0].textContent = "Hola app contactos";
// });

document.getElementsByTagName('h1')[0].textContent = "Hola app contactos";
document.getElementsByTagName('h1')[0].innerHTML = "<i>Hola</i> app contactos";
const titulo = document.getElementById('tiTulo');
titulo.innerText = "aaaaaa";