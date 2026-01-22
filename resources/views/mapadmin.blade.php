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

/* GO SEARCH */
.search-box {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: rgba(0,0,0,0.7);
    padding: 10px;
    border-radius: 10px;
    display: flex;
    gap: 6px;
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

/* DPAD */
.editor {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: grid;
    grid-template-columns: 120px 120px 120px;
    grid-template-rows: 120px 120px 120px;
    gap: 10px;
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

/* SAVE */
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
}
</style>
</head>

<body>

<form method="POST" action="/admin/map/save" id="mapForm">
@csrf

<!-- ACTUAL MAP VALUE -->
<input type="hidden" name="map" id="currentMap" value="map1">

<!-- DPAD -->
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

<button class="save-btn" type="submit">SAVE</button>
</form>

<!-- GO SEARCH -->
<div class="search-box">
    <input type="number" id="mapSearch" placeholder="1" onkeydown="handleEnter(event)">
    <button type="button" onclick="goMap()">GO</button>
</div>

<script>
function goMap() {
    const num = document.getElementById('mapSearch').value;
    if (!num) return;

    const mapName = 'map' + num;

    document.body.style.backgroundImage = `url('/maps/${mapName}.jpg')`;
    document.getElementById('currentMap').value = mapName;
    document.getElementById('mapLabel').innerText = mapName;

    // Optional: populate DPAD inputs if mapData exists in JS
}

/* Trigger go on Enter */
function handleEnter(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        goMap();
    }
}

/* NUMBER → mapX CONVERSION */
document.querySelectorAll('.map-input').forEach(input => {
    input.addEventListener('input', function () {
        const dir = this.dataset.dir;
        const hidden = document.querySelector(`input[name="${dir}"]`);
        hidden.value = this.value === '' ? '' : 'map' + this.value;
    });
});

/* --- NEW: Keep map number after save --- */
document.getElementById('mapForm').addEventListener('submit', function(e){
    // Save the current Go input value to a cookie so we can reload it
    const mapNum = document.getElementById('mapSearch').value;
    if(mapNum) {
        document.cookie = "lastMap=" + mapNum + ";path=/";
    }
});

// On page load, check cookie and go to that map
window.addEventListener('DOMContentLoaded', () => {
    const matches = document.cookie.match(/(?:^|; )lastMap=(\d+)/);
    if(matches) {
        document.getElementById('mapSearch').value = matches[1];
        goMap();
    }
});
</script>

</body>
</html>
