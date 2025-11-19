<?php
session_start();
require_once "Funciones_model.php";

$fModel = new FuncionModel();
$funciones = $fModel->Listar();
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Comprar entrada - mapa de asientos</title>
<link rel="stylesheet" href="../Css/Entradas.css">
</head>
<body>

    <?php include "../includes/Header.php"; ?>

<div class="map-wrap">
    <h1>Comprar entrada</h1>

    <div class="controls">
        <label>Función:</label>
        <select id="funcionSelect">
            <option value="">-- Seleccione función --</option>
            <?php foreach ($funciones as $f): ?>
                <option value="<?= $f->getIDFuncion(); ?>">
                    <?= htmlspecialchars($f->getTitulo()) ?> — <?= htmlspecialchars($f->getFecha()) ?> <?= htmlspecialchars($f->getHorario()) ?> — Sala <?= htmlspecialchars($f->getSalaNombre()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="price-box" id="priceBox">Precio: -</div>
    </div>

    <div id="seat-map">Seleccione una función para ver el mapa.</div>

    <div class="legend">
        <span><span class="box" style="background:#e6f7e6;border:1px solid #c6e3c6"></span> Disponible</span>
        <span><span class="box" style="background:#f5d6d6;border:1px solid #e0bcbc"></span> Ocupado</span>
        <span><span class="box" style="background:#ffdd88;border:1px solid #ffca3a"></span> Seleccionado</span>
        <div class="info" id="selectedInfo" style="margin-left:auto">Asiento: ninguno</div>
    </div>

    <div style="margin-top:12px">
        <button id="comprarBtn" disabled>Comprar asiento seleccionado</button>
    </div>

    <div id="msg" class="mensaje" style="display:none"></div>
    <div id="err" class="error" style="display:none"></div>
</div>

<script>
let ocupados = [];
let asientos = [];
let filaMap = {};
let selected = null;
let precio = 0;

const seatMapEl = document.getElementById('seat-map');
const funcionSelect = document.getElementById('funcionSelect');
const priceBox = document.getElementById('priceBox');
const comprarBtn = document.getElementById('comprarBtn');
const selectedInfo = document.getElementById('selectedInfo');
const msg = document.getElementById('msg');
const err = document.getElementById('err');

funcionSelect.addEventListener('change', async () => {
    reset();
    const id = funcionSelect.value;

    if (!id) {
        seatMapEl.innerHTML = '<p>Seleccione una función para ver el mapa de asientos.</p>';
        priceBox.textContent = 'Precio: -';
        return;
    }

    const res = await fetch('SeatsController.php?ID_Funcion=' + id);
    const text = await res.text();

    try {
        const data = JSON.parse(text);

        // Seguridad
        if (!Array.isArray(data.asientos)) {
            seatMapEl.innerHTML = "<p>Error: datos de asientos inválidos.</p>";
            return;
        }

        precio = data.funcion.precio || 0;
        priceBox.textContent = 'Precio: $' + precio;
        ocupados = data.ocupados.map(x => parseInt(x));
        asientos = data.asientos;

        renderSeats();
    } catch (e) {
        seatMapEl.innerHTML = "<p>Error al analizar datos: " + text + "</p>";
    }
});

function reset() {
    selected = null;
    ocupados = [];
    asientos = [];
    filaMap = {};

    seatMapEl.innerHTML = '<p>Cargando asientos...</p>';
    selectedInfo.textContent = 'Asiento: ninguno';
    comprarBtn.disabled = true;

    msg.style.display = 'none';
    err.style.display = 'none';
}

function renderSeats() {
    filaMap = {};

    asientos.forEach(a => {
        if (!filaMap[a.fila]) filaMap[a.fila] = [];
        filaMap[a.fila].push(a);
    });

    seatMapEl.innerHTML = '';
    const filas = Object.keys(filaMap).sort();

    filas.forEach(fila => {
        const row = document.createElement('div');
        row.className = 'seat-row';

        const label = document.createElement('div');
        label.className = 'row-label';
        label.textContent = fila;
        row.appendChild(label);

        filaMap[fila].sort((a,b)=> a.numero - b.numero).forEach(a => {
            const el = document.createElement('div');
            el.className = 'seat';
            el.dataset.id = a.ID_Asiento;
            el.dataset.et = a.etiqueta;
            el.textContent = a.etiqueta;

            if (ocupados.includes(parseInt(a.ID_Asiento))) {
                el.classList.add('occupied');
                el.style.pointerEvents = "none";
            } else {
                el.classList.add('available');
                el.addEventListener('click', () => selectSeat(el, a));
            }

            row.appendChild(el);
        });

        seatMapEl.appendChild(row);
    });
}

function selectSeat(el, a) {
    const prev = document.querySelector('.seat.selected');
    if (prev) prev.classList.remove('selected');

    el.classList.add('selected');
    selected = a;

    selectedInfo.textContent = 'Asiento: ' + a.etiqueta + ' | Precio: $' + precio;
    comprarBtn.disabled = false;

    msg.style.display = 'none';
    err.style.display = 'none';
}

comprarBtn.addEventListener('click', async () => {
    if (!selected) return;

    comprarBtn.disabled = true;
    const ID_Funcion = funcionSelect.value;
    const ID_Asiento = selected.ID_Asiento;

    const form = new FormData();
    form.append('ID_Funcion', ID_Funcion);
    form.append('ID_Asiento', ID_Asiento);

    const res = await fetch('EntradasController.php', { method: 'POST', body: form });
    const text = await res.text();

    let data;
    try { data = JSON.parse(text); } catch(e) {}

    if (res.ok && data && data.success) {
        msg.style.display = 'block';
        err.style.display = 'none';
        msg.textContent = 'Compra realizada. Código: ' + data.idEntrada;

        // Convertir asiento a ocupado
        const seat = document.querySelector(`.seat[data-id="${ID_Asiento}"]`);
        if (seat) {
            const nuevo = seat.cloneNode(true);
            nuevo.classList.remove("selected","available");
            nuevo.classList.add("occupied");
            nuevo.style.pointerEvents = "none";

            seat.parentNode.replaceChild(nuevo, seat);
        }

        selected = null;
        selectedInfo.textContent = 'Asiento: ninguno';
        comprarBtn.disabled = true;
    } else {
        comprarBtn.disabled = false;
        err.style.display = 'block';
        err.textContent = (data && data.error) ? data.error : 'Error al comprar asiento';
    }
});
</script>

</body>
</html>
