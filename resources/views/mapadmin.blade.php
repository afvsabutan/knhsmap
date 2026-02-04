<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>KNHS Map Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
html, body {
    margin: 0;
    height: 100%;
    font-family: Arial, sans-serif;
    overflow: hidden;
}

body {
    background: url("/maps/map1.jpg") no-repeat center center fixed;
    background-size: cover;
}

/* ================= SEARCH ================= */
.search-box {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: rgba(0,0,0,0.75);
    padding: 10px;
    border-radius: 10px;
    display: flex;
    gap: 6px;
    z-index: 300;
}
.search-box input {
    width: 60px;
    padding: 6px;
    border-radius: 6px;
    border: none;
    text-align: center;
}
.search-box button {
    padding: 6px 10px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

/* ================= MAIN DPAD EDITOR ================= */
.editor {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: grid;
    grid-template-columns: 120px 120px 120px;
    grid-template-rows: 120px 120px 120px;
    gap: 10px;
    z-index: 200;
}

.cell {
    background: rgba(0,0,0,0.65);
    color: white;
    border-radius: 14px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.cell input {
    width: 60px;
    padding: 6px;
    border-radius: 6px;
    border: none;
    text-align: center;
}

.forward { grid-column: 2; grid-row: 1; }
.left    { grid-column: 1; grid-row: 2; }
.center  { grid-column: 2; grid-row: 2; }
.right   { grid-column: 3; grid-row: 2; }
.back    { grid-column: 2; grid-row: 3; }

/* ================= SAVE ================= */
.save-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 12px 22px;
    font-size: 16px;
    border-radius: 12px;
    border: none;
    background: #00bfff;
    color: white;
    cursor: pointer;
    z-index: 300;
}

/* ================= ADMIN NAV DPAD (ABOVE SAVE) ================= */
.mini-dpad {
    position: fixed;
    bottom: 80px;
    right: 20px;
    display: grid;
    grid-template-columns: 42px 42px 42px;
    grid-template-rows: 42px 42px 42px;
    gap: 6px;
    z-index: 310;
}

.mini-dpad button {
    border-radius: 10px;
    border: none;
    background: rgba(0,0,0,0.75);
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.mini-dpad button:hover {
    background: rgba(0,0,0,0.95);
    transform: scale(1.1);
}

.mini-forward { grid-column: 2; grid-row: 1; }
.mini-left    { grid-column: 1; grid-row: 2; }
.mini-right   { grid-column: 3; grid-row: 2; }
.mini-back    { grid-column: 2; grid-row: 3; }
</style>
</head>

<body>

<form method="POST" action="/admin/map/save" id="mapForm">
@csrf

<input type="hidden" name="map" id="currentMap" value="map1">
<input type="hidden" name="mode" id="saveMode" value="normal">

<!-- ================= MAIN DPAD EDITOR ================= -->
<div class="editor">

    <div class="cell forward">
        <label>FORWARD</label>
        <input type="number" class="map-input" data-dir="forward">
        <input type="hidden" name="forward">
    </div>

    <div class="cell left">
        <label>LEFT</label>
        <input type="number" class="map-input" data-dir="left">
        <input type="hidden" name="left">
    </div>

    <div class="cell center">
        <strong>CURRENT</strong>
        <div id="mapLabel">map1</div>
    </div>

    <div class="cell right">
        <label>RIGHT</label>
        <input type="number" class="map-input" data-dir="right">
        <input type="hidden" name="right">
    </div>

    <div class="cell back">
        <label>BACK</label>
        <input type="number" class="map-input" data-dir="back">
        <input type="hidden" name="back">
    </div>

</div>
<button type="button"
        class="save-btn"
        style="right: 180px; background:#6c5ce7"
        onclick="saveWithLR()">
    SAVE w/ LR
</button>
<button class="save-btn" type="submit">SAVE</button>
</form>

<!-- ================= SEARCH ================= -->
<div class="search-box">
    <input type="number" id="mapSearch" placeholder="1" onkeydown="handleEnter(event)">
    <button type="button" onclick="goMap()">GO</button>
</div>

<!-- ================= ADMIN NAV DPAD ================= -->
<div class="mini-dpad">
    <button id="btn-forward" class="mini-forward" onclick="adminMove('forward')">▲</button>
    <button id="btn-left"    class="mini-left"    onclick="adminMove('left')">◀</button>
    <button id="btn-right"   class="mini-right"   onclick="adminMove('right')">▶</button>
    <button id="btn-back"    class="mini-back"    onclick="adminMove('back')">▼</button>
</div>

<script>
let currentLinks = {};

/* ================= GO MAP ================= */
function goMap() {
    const num = document.getElementById('mapSearch').value;
    if (!num) return;

    const mapName = 'map' + num;
    document.body.style.backgroundImage = `url('/maps/${mapName}.jpg')`;
    document.getElementById('currentMap').value = mapName;
    document.getElementById('mapLabel').innerText = mapName;

    loadAdminLinks();
}

/* ================= ENTER KEY ================= */
function handleEnter(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        goMap();
    }
}

/* ================= NUMBER → mapX ================= */
document.querySelectorAll('.map-input').forEach(input => {
    input.addEventListener('input', function () {
        const dir = this.dataset.dir;
        const hidden = document.querySelector(`input[name="${dir}"]`);
        hidden.value = this.value ? 'map' + this.value : '';
    });
});

/* ================= LOAD LINKS + TOGGLE DPAD ================= */
async function loadAdminLinks() {
    const map = document.getElementById('currentMap').value;

    try {
        const res = await fetch(`/admin/map/links/${map}`);
        currentLinks = await res.json();

        toggleBtn('forward', currentLinks.forward);
        toggleBtn('left',    currentLinks.left);
        toggleBtn('right',   currentLinks.right);
        toggleBtn('back',    currentLinks.back);

    } catch (e) {
        console.error('Failed loading links');
    }
}

function toggleBtn(dir, val) {
    document.getElementById('btn-' + dir).style.display = val ? 'block' : 'none';
}

/* ================= ADMIN MOVE ================= */
function adminMove(dir) {
    const target = currentLinks[dir];
    if (!target) return;

    const num = target.replace('map','');
    document.getElementById('mapSearch').value = num;
    goMap();
}

/* ================= COOKIE SAVE ================= */
document.getElementById('mapForm').addEventListener('submit', () => {
    const num = document.getElementById('mapSearch').value;
    if (num) document.cookie = "lastMap=" + num + ";path=/";
});

/* ================= LOAD LAST MAP ================= */
window.addEventListener('DOMContentLoaded', () => {
    const m = document.cookie.match(/(?:^|; )lastMap=(\d+)/);
    if (m) {
        document.getElementById('mapSearch').value = m[1];
        goMap();
    } else {
        loadAdminLinks();
    }
});

function saveWithLR() {

    const forwardInput = document.querySelector('.map-input[data-dir="forward"]');
    const forwardVal = forwardInput.value;

    if (!forwardVal) {
        alert('Set FORWARD first');
        return;
    }

    const base = parseInt(forwardVal, 10);
    if (isNaN(base)) {
        alert('FORWARD must be a number');
        return;
    }

    // tell backend we want special behavior
    document.getElementById('saveMode').value = 'withLR';

    // ONLY save forward on current map
    document.querySelector('input[name="forward"]').value = 'map' + base;
    document.querySelector('input[name="left"]').value  = '';
    document.querySelector('input[name="right"]').value = '';
    document.querySelector('input[name="back"]').value  = '';
    
    document.getElementById('mapForm').submit();
}


</script>

</body>
</html>
