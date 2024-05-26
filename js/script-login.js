const limit  = 16;

var matricula = document.getElementById('matricula');
var alerta = document.getElementById('alerta');
var matricula_valor = matricula.value;

matricula.addEventListener('input', function(){
    matricula_valor = matricula.value;
    if(matricula_valor.length > limit){
        matricula.value = matricula_valor.slice(0, limit);
        alerta.style = 'opacity: 1; transition: opacity 0.5s;';
    }
    else{
        alerta.style = 'opacity: 0; transition: opacity 0.5s;';
    }
});