document.getElementById('jugar');
document.getElementById('formulario');
document.getElementById('cerrar');
jugar.onclick = function (){
    if(formulario.style.visibility='hidden'){
        formulario.style.visibility='visible';
    }
    
}
cerrar.onclick = function (){
    formulario.style.visibility='hidden'
}