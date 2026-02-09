<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>KNHS MAP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>

   #ratio-wrapper {
    position: absolute;
    inset: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: black; /* bars */
}

#ratio-stage {
    width: 100vw;
    aspect-ratio: 16 / 9;
    max-height: 100vh;
    background: transparent;
    position: relative;
}

html, body {
    margin: 0;
    height: 100%;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow: hidden;
}

/* FULL BACKGROUND MAP */
body {
    background: black;
}

#ratio-stage {
    background: url("{{ asset('maps/'.$map.'.jpg') }}") no-repeat center center;
    background-size: cover;
}

/* 16:9 STAGE */
/* #stage {
    width: 1920px;
    height: 1080px;
    position: relative;
    background: url("{{ asset('maps/'.$map.'.jpg') }}") no-repeat center center;
    background-size: cover;
    transform-origin: top left;
} */

/* TOP BAR: MENU + SEARCH */
.top-bar {
    position: absolute;
    top: 20px;
    left: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 200;
}

/* MENU BUTTON */
.menu-btn {
    width: 40px;
    height: 40px;
    background: rgba(0,0,0,0.6);
    border-radius: 10px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    color: #fff;
    transition: background 0.2s ease;
}
.menu-btn:hover { background: rgba(0,0,0,0.85); }

/* SEARCH BAR */
.search-bar {
    display: flex;
    align-items: center;
    background: rgb(42, 32, 108);
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
    padding: 5px 10px;
}
.search-bar input {
    border: none;
    outline: none;
    font-size: 14px;
    padding: 6px 8px;
    border-radius: 6px;
    width: 140px;
}
.search-bar button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 18px;
    color: #4285f4;
}
.search-bar button:hover { color: #357ae8; }
/* SEARCH AUTOCOMPLETE */
#search-results {
    position: absolute;
    top: 45px;
    left: 0;
    width: 100%;
    background: #ffffffdb;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 200px;
    overflow-y: auto;
    display: none;
    z-index: 300;
}

#search-results li {
    padding: 10px 12px;
    font-size: 14px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
}

#search-results li:hover {
    background: #f0f6ff;
}

#search-results li:last-child {
    border-bottom: none;
}


/* SIDE MENU */
.side-menu {
    position: absolute;
    top: 50%;
    left: -300px;
    transform: translateY(-50%);
    width: 260px;
    background: rgba(40,40,50,0.95);
    color: #fff;
    padding: 20px 25px;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.6);
    transition: left 0.3s ease;
    z-index: 250;
}
.side-menu.active { left: 20px; }
.side-menu h2 {
    margin-top: 0;
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
}
.menu-close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    background: #ff4c4c;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
    transition: all 0.2s ease;
}
.menu-close-btn:hover { background: #e04343; }
.menu-list { list-style: none; padding:0; margin:0; }
.menu-list li { margin-bottom: 15px; }
.menu-list li a {
    display: block;
    text-decoration: none;
    color: #fff;
    background: rgba(255,255,255,0.05);
    padding: 10px 15px;
    border-radius: 12px;
    font-size: 16px;
    transition: all 0.2s ease;
}
.menu-list li a:hover { background: rgba(255,255,255,0.2); color: #00bfff; transform: translateX(5px); }

/* INFO PANEL BELOW SEARCH - dark blue background */
.info-panel {
    position: absolute;
    top: 70px;
    left: 20px;
    width: 240px;
    background: rgba(0, 18, 43, 0.9); /* dark blue 90% opacity */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    padding: 15px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    z-index: 200;
    color: #fff;
    transition: transform 0.25s ease;
}
.info-panel.shift-down {
    transform: translateY(180px); /* moves panel down */
}
.info-panel .floor {
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 6px;
}
.info-panel .address {
    font-size: 14px;
    margin-bottom: 8px;
}
.info-panel .landmark {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 8px;
}
.info-panel .landmark img { width: 16px; height: 16px; }
.info-panel .landmark a {
    text-decoration: none;
    color: #00bfff;
    font-size: 14px;
}
.info-panel .landmark a:hover { text-decoration: underline; }
.info-panel .date {
    font-size: 13px;
    color: #ccc;
}
.info-panel .date a {
    color: #00bfff;
    text-decoration: none;
}
.info-panel .date a:hover { text-decoration: underline; }

/* MINI MAP - bottom left rectangle */
.mini-map {
    position: absolute;
    bottom: 60px;
    left: 20px;
    width: 180px;
    height: 100px;
    border-radius: 8px;
    border: 2px solid #fff;
    background: url("{{ asset('maps/overallmap.jpg') }}") no-repeat center center;
    background-size: cover;
    cursor: pointer;
    box-shadow: 0 0 10px rgba(0,0,0,0.5);
    transition: transform 0.2s ease;
}
.mini-map:hover { transform: scale(1.05); }

/* CROSS CONTROLS - D-Pad SQUARE with rounded corners + text labels */
.controls {
    position: absolute;
    right: 25px;
    bottom: 60px;
    display: grid;
    grid-template-columns: 80px 80px 80px;
    grid-template-rows: 80px 80px 80px;
    gap: 10px;
    z-index: 200;
}
.btn {
    background: rgba(0, 0, 0, 0.55);
    border-radius: 15px; /* semi-rounded corners */
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.5);
}
.btn span.label {
    font-size: 10px;
    margin-top: 4px;
    font-weight: normal;
}
.btn:hover {
    background: rgba(0, 0, 0, 0.85);
    transform: scale(1.15);
    box-shadow: 0 4px 12px rgba(0,0,0,0.7);
}
.forward { grid-column: 2; grid-row: 1; }
.left    { grid-column: 1; grid-row: 2; }
.right   { grid-column: 3; grid-row: 2; }
.back    { grid-column: 2; grid-row: 3; }

/* MINI MAP POPUP */
#mini-map-modal { display: none; position: absolute; top:50%; left:50%; transform:translate(-50%,-50%); z-index:999; }
#mini-map-modal img { max-width:90vw; max-height:90vh; border-radius:10px; border:2px solid #fff; display:block; }
.close-btn { position:absolute; top:-15px; right:-15px; background:#000; color:#fff; width:30px; height:30px; border-radius:50%; font-size:20px; line-height:30px; text-align:center; cursor:pointer; }

/* BOTTOM CENTER TITLE */
.title-bottom {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    color: #ffffff;
    font-size: 18px;
    font-weight: 500;
    text-shadow: 0 0 8px rgba(0,0,0,0.7);
    z-index: 100;
    pointer-events: none;
}

/* TOP RIGHT BRANDING */
.branding {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(0,0,0,0.5);
    padding: 8px 15px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.5);
    color: #fff;
    font-size: 14px;
    font-weight: 500;
    z-index: 300;
}

.branding img {
    height: 56px;
    width: auto;
}
</style>
</head>

<body>
<div id="ratio-wrapper">
    <div id="ratio-stage">

<!-- TOP BAR: MENU + SEARCH -->
<div class="top-bar">
    <button class="menu-btn" onclick="toggleMenu()">☰</button>
    <div class="search-bar">
        <input type="text" id="map-search" placeholder="Search location..." autocomplete="off">
        <button onclick="searchMap()">🔍</button>

        <!-- SEARCH SUGGESTIONS -->
        <div id="search-results" class="search-results"></div>
    </div>
</div>

<!-- INFO PANEL BELOW SEARCH -->
<div class="info-panel">
    <div class="floor">GROUND FLOOR</div>
    <div class="address">KNHS 304444, Kabacan</div>
    <div class="landmark">
        <img src="https://img.icons8.com/fluency/48/000000/marker.png" alt="Landmark Icon">
        <a href="https://www.google.com/maps" target="_blank">View on Google Maps</a>
    </div>
    <div class="date">
        January 2026 - <a href="#">See more dates</a>
    </div>
</div>

<!-- SIDE MENU -->
<div class="side-menu" id="side-menu">
    <button class="menu-close-btn" onclick="closeMenu()">×</button>
    <h2>KNHS MAP</h2>
    <ul class="menu-list">
        <li><a href="#">Campus Overview</a></li>
        <li><a href="#">Departments</a></li>
        <li><a href="#">Facilities</a></li>
        <li><a href="#">Events</a></li>
        <li><a href="#">Settings</a></li>
    </ul>
</div>

<!-- MINI MAP -->
<div class="mini-map" onclick="openMiniMap()"></div>

<!-- MINI MAP POPUP -->
<div id="mini-map-modal">
    <div class="close-btn" onclick="closeMiniMap()">×</div>
    <img id="mini-map-image" src="{{ asset('maps/overallmap.jpg') }}">
</div>

<!-- CROSS CONTROLS -->
<div class="controls">
    @if($links['forward'])
        <a class="btn forward" href="{{ url('map/'.$links['forward']) }}">▲<span class="label">FORWARD</span></a>
    @endif
    @if($links['left'])
        <a class="btn left" href="{{ url('map/'.$links['left']) }}">◀<span class="label">TURN LEFT</span></a>
    @endif
    @if($links['right'])
        <a class="btn right" href="{{ url('map/'.$links['right']) }}">▶<span class="label">TURN RIGHT</span></a>
    @endif
    @if($links['back'])
        <a class="btn back" href="{{ url('map/'.$links['back']) }}">▼<span class="label">BACKWARD</span></a>
    @endif
</div>

<!-- BOTTOM CENTER TITLE -->
<div class="title-bottom">KNHS MAP</div>

<!-- TOP RIGHT BRANDING -->
<div class="branding">
    <span>KABACAN NATIONAL HIGH SCHOOL</span>
    <img src="{{ asset('maps/knhslogo.png') }}" alt="KNHS Logo">
</div>

<script>
// Toggle side menu
function toggleMenu() { document.getElementById('side-menu').classList.add('active'); }
function closeMenu() { document.getElementById('side-menu').classList.remove('active'); }

// Mini-map popup
function openMiniMap() { document.getElementById('mini-map-modal').style.display = 'block'; }
function closeMiniMap() { document.getElementById('mini-map-modal').style.display = 'none'; }
document.getElementById('mini-map-modal').addEventListener('click', function(e) {
    if(e.target.id === 'mini-map-modal') closeMiniMap();
});

// Dummy search
// function searchMap() {
//     const query = document.getElementById('map-search').value.trim();
//     if(query) alert("Searching for: " + query);
// }

const locations = [
    { name: "Computer Laboratory", map: "map12" },
    { name: "12 TVL ICT", map: "map8" },
    { name: "12 HUMMS 8", map: "map16" },
    { name: "Registrar's office", map: "map21" },
    { name: "12 STEM",
  students: [
    "Bella Quinto",
    "Breezy Rivera",
    "Brielle Singh",
    "Celine Salazar",
    "Clara Tan",
    "Cleo Torres",
    "Dahlia Uy",
    "Daniella Velasco",
    "Darcy Wong",
    "Elara Alvarez",
    "Eliza Cabrera",
    "Ella David",
    "Elowen Espino",
    "Faith Fuentes",
    "Fiona Lim",
    "Freya Patel",
    "Gemma Perez",
    "Gia Quinto",
    "Giselle Rivera",
    "Hailey Singh",
    "Harper Salazar",
    "Indie Tan",
    "Isabella Torres",
    "Jada Uy",
    "Janae Velasco",
    "Jessa Wong",
    "Jolie Alvarez",
    "Kaiya Cabrera",
    "Kiera David",
    "Kyla Espino",
    "Lani Fuentes",
    "Lara Lim",
    "Leia Patel",
    "Luna Perez",
    "Merrick Quinto",
    "Milo Rivera",
    "Nash Singh",
    "Nico Salazar",
    "Orion Tan",
    "Pax Torres",
    "Piers Uy",
    "Quill Velasco",
    "Rex Wong",
    "Rocco Alvarez",
    "Ronan Cabrera",
    "Silas David",
    "Slade Espino",
    "Talon Fuentes",
    "Tate Lim",
    "Theo Patel",
    "Vance Perez",
    "Wes Quinto",
    "Wilder Rivera",
    "Xander Singh",
    "Yves Salazar",
    "Zane Tan"
  ],
  map: "map85"
}
    { name: "Grade 12 BUilding", map: "map74" },
    { name: "SPA Building", map: "map64" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
    { name: "12 STEM", map: "map85" },
];

const input = document.getElementById("map-search");
const results = document.getElementById("search-results");
const infoPanel = document.querySelector(".info-panel");

// Move info panel down when search is active
input.addEventListener("input", moveInfoPanel);
input.addEventListener("focus", moveInfoPanel);

function moveInfoPanel() {
    if (input.value || results.style.display === "block") {
        infoPanel.classList.add("shift-down");
    } else {
        infoPanel.classList.remove("shift-down");
    }
}

// Remove shift-down when clicking outside
document.addEventListener("click", (e) => {
    if (!e.target.closest(".search-bar")) {
        results.style.display = "none";
        infoPanel.classList.remove("shift-down");
    }
});


input.addEventListener("input", showResults);
input.addEventListener("focus", showResults);

document.addEventListener("click", (e) => {
    if (!e.target.closest(".search-bar")) {
        results.style.display = "none";
    }
});

function showResults() {
    const value = input.value.trim().toLowerCase();

    // if input is empty, hide the results and move info panel back
    if (!value) {
        results.style.display = "none";
        infoPanel.classList.remove("shift-down");
        return;
    }

    results.innerHTML = "";

    const filtered = locations.filter(loc =>
        loc.name.toLowerCase().includes(value)
    );

    if (filtered.length === 0) {
        results.style.display = "none";
        return;
    }

    filtered.forEach(loc => {
        const li = document.createElement("li");
        li.textContent = loc.name;
        li.onclick = () => {
            window.location.href = `/map/${loc.map}`;
        };
        results.appendChild(li);
    });

    results.style.display = "block";

    // Move info panel down
    infoPanel.classList.add("shift-down");
}


function searchMap() {
    if (results.firstChild) {
        results.firstChild.click();
    }
}

</script>
@include('additionalpads')
</div> <!-- stage -->
</div> <!-- viewport -->

<script>
function lock16by9() {
    const stage = document.getElementById('ratio-stage');

    const w = window.innerWidth;
    const h = window.innerHeight;

    if ((w / h) < (16 / 9)) {
        // portrait or tall screen → limit by height
        stage.style.width = (h * 16 / 9) + 'px';
    } else {
        // landscape → full width
        stage.style.width = '100vw';
    }
}

window.addEventListener('resize', lock16by9);
window.addEventListener('orientationchange', lock16by9);
lock16by9();
</script>


</body>
</html>

