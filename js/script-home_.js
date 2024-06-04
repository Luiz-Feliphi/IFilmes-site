const dia_ifilmes = document.getElementById('dia-ifilmes');
const button_descricao = document.getElementById('toggleButton');
const descricao = document.getElementsByClassName('descricao');

function proximaSexta() {
    const hoje = new Date();
    let proximaSexta = new Date(hoje);
    proximaSexta.setDate(hoje.getDate() + (5 - hoje.getDay() + 7) % 7);
    const dia = proximaSexta.getDate();
    const mes = proximaSexta.getMonth() + 1;
    let diaFormatado = dia < 10 ? '0' + dia : dia;
    let mesFormatado = mes < 10 ? '0' + mes : mes;
    return diaFormatado + '/' + mesFormatado;
}

if (dia_ifilmes) {
    dia_ifilmes.innerText = proximaSexta();
}

button_descricao.addEventListener('click', function() {
    var icon1 = document.getElementById('icon1');
    var icon2 = document.getElementById('icon2');

    if (icon1.style.display === 'none') {
        icon1.style.display = 'block';
        icon2.style.display = 'none';
        for (let i = 0; i < descricao.length; i++) {
            descricao[i].style.display = 'block';
        }
    } else {
        icon1.style.display = 'none';
        icon2.style.display = 'block';
        for (let i = 0; i < descricao.length; i++) {
            descricao[i].style.display = 'none';
        }
    }
});

window.addEventListener('load', function() {
    
});
// Exibe o dia e o mês da próxima sexta-feira no elemento dia-ifilmes
