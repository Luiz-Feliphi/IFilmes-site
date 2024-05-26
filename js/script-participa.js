const limit  = 16;

var matricula = document.getElementById('matricula2');
var alerta = document.getElementById('alerta');
var matricula_valor = matricula.value;
var delayInMilliseconds = 5000; //1 second
var botao_enviar = document.getElementById('submit');
var texto_sucesso = document.getElementById('sucesso-pedido');

matricula.addEventListener('input', function(){
    matricula_valor = matricula.value;
    if(matricula_valor.length > limit){
        matricula.value = matricula_valor.slice(0, limit);
        alerta.style = 'opacity: 1; transition: opacity 0.5s;';
        setTimeout(function() {
            //your code to be executed after 1 second
            alerta.style = 'opacity: 0; transition: opacity 0.5s;';
          }, delayInMilliseconds);
    }
    else{
        alerta.style = 'opacity: 0; transition: opacity 0.5s;';
    }
});

if(matricula_valor == 0){
    texto_sucesso.style = 'opacity: 0;';
}

botao_enviar.addEventListener('click', function(){
    matricula_valor = matricula.value;
    if(matricula_valor == 0){
        texto_sucesso.style = 'opacity: 0;';
    } else {
        texto_sucesso.style = 'opacity: 1;';
    }
});