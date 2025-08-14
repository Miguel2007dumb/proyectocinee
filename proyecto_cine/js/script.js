const precios = {
    "Cinemark Multiplaza": { "Sala 1": 130, "Sala 3": 140, "Sala VIP": 150 },
    "Cinemark City Mall": { "Sala 1": 120, "Sala 3": 130, "Sala VIP": 160 },
    "Cinépolis Plaza Miraflores": { "Sala 1": 100, "Sala 3": 130, "Sala VIP": 150 },
    "Cinépolis Las Cascadas": { "Sala 1": 130, "Sala 3": 150, "Sala VIP": 200 },
    "Metrocinemas Novacentro": { "Sala 1": 120, "Sala 3": 130, "Sala VIP": 160},
    "Metrocinemas Metromall": { "Sala 1": 90, "Sala 3": 120, "Sala VIP": 180 }
};

const formatoExtra = { "2D": 0, "3D": 30, "IMAX": 60 };
const asientosOcupados = {
    "Sala 1": [2, 5, 20],
    "Sala 3": [1, 4, 7],
    "Sala 5": [2, 6, 38],
    "Sala VIP": [3, 8, 10]
};

let precioUnitario = 0;
let seleccionados = [];

function initSelects() {
    const cineSelect = document.getElementById('cine');
    const formatoSelect = document.getElementById('formato');

    Object.keys(precios).forEach(cine => {
        const opt = document.createElement('option');
        opt.value = cine;
        opt.textContent = cine;
        cineSelect.appendChild(opt);
    });

    Object.keys(formatoExtra).forEach(fmt => {
        const opt = document.createElement('option');
        opt.value = fmt;
        opt.textContent = fmt;
        formatoSelect.appendChild(opt);
    });

    actualizarSalas();
}

function actualizarSalas() {
    const cine = document.getElementById('cine').value;
    const salaSelect = document.getElementById('sala');
    salaSelect.innerHTML = '';
    Object.keys(precios[cine]).forEach(sala => {
        const opt = document.createElement('option');
        opt.value = sala;
        opt.textContent = sala;
        salaSelect.appendChild(opt);
    });
}

function mostrarAsientos() {
    const cine = document.getElementById('cine').value;
    const sala = document.getElementById('sala').value;
    const hora = document.getElementById('hora').value;
    const formato = document.getElementById('formato').value;

    precioUnitario = precios[cine][sala] + formatoExtra[formato];

    document.getElementById('precio').innerHTML = `<strong>Precio por entrada:</strong> L. ${precioUnitario}`;
    document.getElementById('infoSala').innerHTML = `
        <p><strong>Cine:</strong> ${cine}</p>
        <p><strong>Sala:</strong> ${sala}</p>
        <p><strong>Hora:</strong> ${hora}</p>
        <p><strong>Formato:</strong> ${formato}</p>
        <p><strong>Precio por entrada:</strong> L. ${precioUnitario}</p>
    `;

    renderizarAsientos(sala);
    document.getElementById('asientosSection').style.display = 'block';
}

function renderizarAsientos(sala) {
    const cont = document.getElementById('contenedorAsientos');
    cont.innerHTML = '';
    seleccionados = [];

    for (let i = 0; i < 5; i++) {
        for (let j = 1; j <= 8; j++) { 
            const asiento = document.createElement('div');
            asiento.className = 'asiento';
            asiento.textContent = `${String.fromCharCode(65 + i)}${j}`;

            if (asientosOcupados[sala]?.includes(j)) {
                asiento.classList.add('ocupado');
            } else {
                asiento.addEventListener('click', () => toggleAsiento(asiento));
            }

            cont.appendChild(asiento);
        }
    }
}

function toggleAsiento(el) {
    const id = el.textContent;
    if (seleccionados.includes(id)) {
        seleccionados = seleccionados.filter(a => a !== id);
        el.classList.remove('seleccionado');
    } else {
        seleccionados.push(id);
        el.classList.add('seleccionado');
    }
    const total = precioUnitario * seleccionados.length;
    document.getElementById('total').innerHTML = `
        <p><strong>Asientos:</strong> ${seleccionados.join(', ')}</p>
        <p><strong>Total:</strong> L. ${total}</p>
    `;
}

function confirmarCompra() {
    if (seleccionados.length === 0) {
        alert("Por favor selecciona al menos un asiento.");
        return;
    }

    const cine = document.getElementById('cine').value;
    const sala = document.getElementById('sala').value;
    const hora = document.getElementById('hora').value;
    const formato = document.getElementById('formato').value;
    const total = seleccionados.length * precioUnitario;
    const asientos = seleccionados.join(',');

    const url = `ticket.html?cine=${encodeURIComponent(cine)}&sala=${encodeURIComponent(sala)}&hora=${encodeURIComponent(hora)}&formato=${encodeURIComponent(formato)}&asientos=${encodeURIComponent(asientos)}&total=${total}`;
    window.open(url, '_blank');
}

function setupLoadMore(btnId, boxClass) {
    const btn = document.getElementById(btnId);
    let current = 4;
    btn.onclick = () => {
        const boxes = document.querySelectorAll(`.${boxClass}`);
        for (let i = current; i < current + 4 && i < boxes.length; i++) {
            boxes[i].style.display = 'block';
        }
        current += 4;
        if (current >= boxes.length) btn.style.display = 'none';
    };
}

document.addEventListener('DOMContentLoaded', () => {
    initSelects();
    document.getElementById('btnMostrarAsientos').addEventListener('click', mostrarAsientos);
    document.getElementById('btnConfirmar').addEventListener('click', confirmarCompra);
    document.getElementById('cine').addEventListener('change', actualizarSalas);
    setupLoadMore('aload-more-1', 'box-1');
});
    const params = new URLSearchParams(window.location.search);
    document.getElementById('cine').textContent = "Cine: " + params.get('cine');
    document.getElementById('sala').textContent = "Sala: " + params.get('sala');
    document.getElementById('hora').textContent = "Hora: " + params.get('hora');
    document.getElementById('formato').textContent = "Formato: " + params.get('formato');
    document.getElementById('asientos').textContent = "Asientos: " + params.get('asientos');
    document.getElementById('total').textContent = "Total a pagar: L. " + params.get('total');
        document.getElementById('btnVolver').addEventListener('click', function() {
      window.location.href = 'index.php';
    });
