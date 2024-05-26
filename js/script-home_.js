const dia_ifilmes = document.getElementById('dia-ifilmes');
const button_descricao = document.getElementById('toggleButton');
const descricao = document.getElementsByClassName('descricao');
const button_CorN = document.getElementById('CorN');

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

// Carregar o estado salvo do localStorage
function carregarEstado() {
    const estadoDiaIfilmes = localStorage.getItem('corDiaIfilmes');
    const estadoButtonCorN = localStorage.getItem('corButtonCorN');

    if (estadoDiaIfilmes && dia_ifilmes) {
        dia_ifilmes.classList.remove('text-bg-danger', 'text-bg-success');
        dia_ifilmes.classList.add(estadoDiaIfilmes);
    }

    if (estadoButtonCorN && button_CorN) {
        button_CorN.classList.remove('btn-danger', 'btn-success');
        button_CorN.classList.add(estadoButtonCorN);
    }
}

// Salvar o estado no localStorage
function salvarEstado(estadoDiaIfilmes, estadoButtonCorN) {
    localStorage.setItem('corDiaIfilmes', estadoDiaIfilmes);
    localStorage.setItem('corButtonCorN', estadoButtonCorN);
}

// Alternar a cor dos elementos dia_ifilmes e button_CorN e salvar o estado
if (button_CorN) {
    button_CorN.addEventListener('click', () => {
        if (dia_ifilmes.classList.contains('text-bg-danger') && button_CorN.classList.contains('btn-danger')) {
            dia_ifilmes.classList.remove('text-bg-danger');
            button_CorN.classList.remove('btn-danger');
            dia_ifilmes.classList.add('text-bg-success');
            button_CorN.classList.add('btn-success');
            salvarEstado('text-bg-success', 'btn-success');
        } else {
            dia_ifilmes.classList.remove('text-bg-success');
            button_CorN.classList.remove('btn-success');
            dia_ifilmes.classList.add('text-bg-danger');
            button_CorN.classList.add('btn-danger');
            salvarEstado('text-bg-danger', 'btn-danger');
        }
    });
}
// Carregar o estado quando a página for carregada
document.addEventListener('DOMContentLoaded', carregarEstado);


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
