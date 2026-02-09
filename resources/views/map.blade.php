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
    { name: "12 STEM", map: "map85" },
    { name: "Grade 12 Building", map: "map74" },
    { name: "SPA Building", map: "map64" },
    { name: "G8 Building", map: "map264" },
      { name: "Aaliyah Santos", map: "map264" },
      { name: "Abby Reyes", map: "map264" },
      { name: "Althea Cruz", map: "map264" },
      { name: "Amara Lopez", map: "map264" },
      { name: "Andrea Garcia", map: "map264" },
      { name: "Angelique Mendoza", map: "map264" },
      { name: "Anya Torres", map: "map264" },
      { name: "Aria Ramos", map: "map264" },
      { name: "Bella Aquino", map: "map264" },
      { name: "Breezy Fernandez", map: "map264" },
      { name: "Celine Jimenez", map: "map264" },
      { name: "Clara Tan", map: "map264" },
      { name: "Dana Uy", map: "map264" },
      { name: "Darcy Ponce", map: "map264" },
      { name: "Elara Navarro", map: "map264" },
      { name: "Eliza Perez", map: "map264" },
      { name: "Faith Salazar", map: "map264" },
      { name: "Fiona Hernandez", map: "map264" },
      { name: "Freya Cabrera", map: "map264" },
      { name: "Gemma Velasco", map: "map264" },
      { name: "Gia Dela Rosa", map: "map264" },
      { name: "Hailey Fuentes", map: "map264" },
      { name: "Harper Morales", map: "map264" },
      { name: "Indie Wong", map: "map264" },
      { name: "Isabella Kim", map: "map264" },
      { name: "Jada Patel", map: "map264" },
      { name: "Janae David", map: "map264" },
      { name: "Jessa Lim", map: "map264" },
      { name: "Jolie Santos", map: "map264" },
      { name: "Kaiya Reyes", map: "map264" },
      { name: "Kyla Cruz", map: "map264" },
      { name: "Lara Lopez", map: "map264" },
      { name: "Aaron Garcia", map: "map264" },
      { name: "Arlo Mendoza", map: "map264" },
      { name: "Blaze Torres", map: "map264" },
      { name: "Carlo Ramos", map: "map264" },
      { name: "Cole Aquino", map: "map264" },
      { name: "Dash Fernandez", map: "map264" },
      { name: "Diego Jimenez", map: "map264" },
      { name: "Eli Tan", map: "map264" },
      { name: "Enzo Uy", map: "map264" },
      { name: "Finn Ponce", map: "map264" },
      { name: "Gabe Navarro", map: "map264" },
      { name: "Griff Perez", map: "map264" },
      { name: "Hayes Salazar", map: "map264" },
      { name: "Hugo Hernandez", map: "map264" },
      { name: "Ian Cabrera", map: "map264" },
      { name: "Jax Velasco", map: "map264" },
      { name: "Kai Dela Rosa", map: "map264" },
      { name: "Knox Fuentes", map: "map264" },
      { name: "Leo Morales", map: "map264" },
      { name: "Milo Wong", map: "map264" },
      { name: "Nash Kim", map: "map264" },
      { name: "Lani Hernandez", map: "map276" },
      { name: "Lara Cabrera", map: "map276" },
      { name: "Leia Velasco", map: "map276" },
      { name: "Luna Dela Rosa", map: "map276" },
      { name: "Mia Fuentes", map: "map276" },
      { name: "Nica Morales", map: "map276" },
      { name: "Nova Wong", map: "map276" },
      { name: "Opal Kim", map: "map276" },
      { name: "Paige Patel", map: "map276" },
      { name: "Pia David", map: "map276" },
      { name: "Quinn Lim", map: "map276" },
      { name: "Raya Santos", map: "map276" },
      { name: "Riley Reyes", map: "map276" },
      { name: "Rylee Cruz", map: "map276" },
      { name: "Sariah Lopez", map: "map276" },
      { name: "Skye Garcia", map: "map276" },
      { name: "Sienna Mendoza", map: "map276" },
      { name: "Tessa Torres", map: "map276" },
      { name: "Tia Ramos", map: "map276" },
      { name: "Uma Aquino", map: "map276" },
      { name: "Veda Fernandez", map: "map276" },
      { name: "Wren Jimenez", map: "map276" },
      { name: "Xena Tan", map: "map276" },
      { name: "Xyla Uy", map: "map276" },
      { name: "Yara Ponce", map: "map276" },
      { name: "Lars Navarro", map: "map276" },
      { name: "Leo Perez", map: "map276" },
      { name: "Mack Salazar", map: "map276" },
      { name: "Merrick Hernandez", map: "map276" },
      { name: "Milo Cabrera", map: "map276" },
      { name: "Nash Velasco", map: "map276" },
      { name: "Nico Dela Rosa", map: "map276" },
      { name: "Oren Fuentes", map: "map276" },
      { name: "Orion Morales", map: "map276" },
      { name: "Pax Wong", map: "map276" },
      { name: "Piers Kim", map: "map276" },
      { name: "Quill Patel", map: "map276" },
      { name: "Rex David", map: "map276" },
      { name: "Rocco Lim", map: "map276" },
      { name: "Ronan Santos", map: "map276" },
      { name: "Silas Reyes", map: "map276" },
      { name: "Tate Cruz", map: "map276" },
    { name: "G7 Building", map: "map149" },
      { name: "Aria Santos", map: "map129" },
      { name: "Bella Reyes", map: "map129" },
      { name: "Celine Cruz", map: "map129" },
      { name: "Dana Lopez", map: "map129" },
      { name: "Ella Garcia", map: "map129" },
      { name: "Faith Mendoza", map: "map129" },
      { name: "Gia Torres", map: "map129" },
      { name: "Hailey Ramos", map: "map129" },
      { name: "Isla Aquino", map: "map129" },
      { name: "Jessa Fernandez", map: "map129" },
      { name: "Kaiya Jimenez", map: "map129" },
      { name: "Lara Tan", map: "map129" },
      { name: "Mia Uy", map: "map129" },
      { name: "Nica Ponce", map: "map129" },
      { name: "Opal Navarro", map: "map129" },
      { name: "Pia Perez", map: "map129" },
      { name: "Quinn Salazar", map: "map129" },
      { name: "Raya Hernandez", map: "map129" },
      { name: "Skye Cabrera", map: "map129" },
      { name: "Tessa Velasco", map: "map129" },
      { name: "Uma Dela Rosa", map: "map129" },
      { name: "Veda Fuentes", map: "map129" },
      { name: "Wren Morales", map: "map129" },
      { name: "Xena Wong", map: "map129" },
      { name: "Axel Kim", map: "map129" },
      { name: "Beau Patel", map: "map129" },
      { name: "Cole David", map: "map129" },
      { name: "Dax Lim", map: "map129" },
      { name: "Eli Santos", map: "map129" },
      { name: "Finn Reyes", map: "map129" },
      { name: "Gabe Cruz", map: "map129" },
      { name: "Huck Lopez", map: "map129" },
      { name: "Ian Garcia", map: "map129" },
      { name: "Jax Mendoza", map: "map129" },
      { name: "Kai Torres", map: "map129" },
      { name: "Leo Ramos", map: "map129" },
      { name: "Milo Aquino", map: "map129" },
      { name: "Nico Fernandez", map: "map129" },
      { name: "Orion Jimenez", map: "map129" },
      { name: "Pax Tan", map: "map129" },
      { name: "Lara Hernandez", map: "map131" },
      { name: "Leia Cabrera", map: "map131" },
      { name: "Luna Velasco", map: "map131" },
      { name: "Mia Dela Rosa", map: "map131" },
      { name: "Nica Fuentes", map: "map131" },
      { name: "Nova Morales", map: "map131" },
      { name: "Paige Wong", map: "map131" },
      { name: "Quinn Kim", map: "map131" },
      { name: "Raya Patel", map: "map131" },
      { name: "Riley David", map: "map131" },
      { name: "Skye Lim", map: "map131" },
      { name: "Tessa Santos", map: "map131" },
      { name: "Uma Reyes", map: "map131" },
      { name: "Veda Cruz", map: "map131" },
      { name: "Wren Lopez", map: "map131" },
      { name: "Xyla Garcia", map: "map131" },
      { name: "Yara Mendoza", map: "map131" },
      { name: "Zia Torres", map: "map131" },
      { name: "Zoe Ramos", map: "map131" },
      { name: "Aaliyah Aquino", map: "map131" },
      { name: "Brielle Fernandez", map: "map131" },
      { name: "Clara Jimenez", map: "map131" },
      { name: "Darcy Tan", map: "map131" },
      { name: "Eliza Uy", map: "map131" },
      { name: "Freya Ponce", map: "map131" },
      { name: "Gemma Navarro", map: "map131" },
      { name: "Harper Perez", map: "map131" },
      { name: "Indie Salazar", map: "map131" },
      { name: "Jolie Hernandez", map: "map131" },
      { name: "Arlo Cabrera", map: "map131" },
      { name: "Bowie Velasco", map: "map131" },
      { name: "Caspian Dela Rosa", map: "map131" },
      { name: "Dash Fuentes", map: "map131" },
      { name: "Ellis Morales", map: "map131" },
      { name: "Flint Wong", map: "map131" },
      { name: "Griff Kim", map: "map131" },
      { name: "Hayes Patel", map: "map131" },
      { name: "Idris David", map: "map131" },
      { name: "Jovi Lim", map: "map131" },
      { name: "Kian Santos", map: "map131" },
      { name: "Lorne Reyes", map: "map131" },
      { name: "Merrick Cruz", map: "map131" },
      { name: "Nico Lopez", map: "map131" },
      { name: "Oren Garcia", map: "map131" },
      { name: "Piers Mendoza", map: "map131" },
      { name: "Quill Torres", map: "map131" },
      { name: "Ronan Ramos", map: "map131" },
      { name: "Silas Aquino", map: "map131" },
      { name: "Aaliyah Cabrera", map: "map145" },
      { name: "Brielle Velasco", map: "map145" },
      { name: "Clara Dela Rosa", map: "map145" },
      { name: "Darcy Fuentes", map: "map145" },
      { name: "Eliza Morales", map: "map145" },
      { name: "Freya Wong", map: "map145" },
      { name: "Gemma Kim", map: "map145" },
      { name: "Harper Patel", map: "map145" },
      { name: "Indie David", map: "map145" },
      { name: "Jolie Lim", map: "map145" },
      { name: "Kyla Santos", map: "map145" },
      { name: "Liora Reyes", map: "map145" },
      { name: "Maren Cruz", map: "map145" },
      { name: "Nyla Lopez", map: "map145" },
      { name: "Opal Garcia", map: "map145" },
      { name: "Pippa Mendoza", map: "map145" },
      { name: "Quinn Torres", map: "map145" },
      { name: "Rylee Ramos", map: "map145" },
      { name: "Sariah Aquino", map: "map145" },
      { name: "Taya Fernandez", map: "map145" },
      { name: "Uma Jimenez", map: "map145" },
      { name: "Veda Tan", map: "map145" },
      { name: "Wren Uy", map: "map145" },
      { name: "Xyla Ponce", map: "map145" },
      { name: "Ysmeine Navarro", map: "map145" },
      { name: "Zariah Perez", map: "map145" },
      { name: "Aisha Salazar", map: "map145" },
      { name: "Bellamy Hernandez", map: "map145" },
      { name: "Cleo Cabrera", map: "map145" },
      { name: "Dahlia Velasco", map: "map145" },
      { name: "Arlo Dela Rosa", map: "map145" },
      { name: "Bowie Fuentes", map: "map145" },
      { name: "Caspian Morales", map: "map145" },
      { name: "Dash Wong", map: "map145" },
      { name: "Ellis Kim", map: "map145" },
      { name: "Flint Patel", map: "map145" },
      { name: "Griff David", map: "map145" },
      { name: "Hayes Lim", map: "map145" },
      { name: "Idris Santos", map: "map145" },
      { name: "Jovi Reyes", map: "map145" },
      { name: "Kian Cruz", map: "map145" },
      { name: "Lorne Lopez", map: "map145" },
      { name: "Merrick Garcia", map: "map145" },
      { name: "Nico Mendoza", map: "map145" },
      { name: "Oren Torres", map: "map145" },
      { name: "Piers Ramos", map: "map145" },
      { name: "Quill Aquino", map: "map145" },
      { name: "Ronan Fernandez", map: "map145" },
      { name: "Silas Jimenez", map: "map145" },
      { name: "Talon Tan", map: "map145" },
      { name: "Aaliyah Santos", map: "map404" },
      { name: "Brielle Reyes", map: "map404" },
      { name: "Clara Cruz", map: "map404" },
      { name: "Darcy Lopez", map: "map404" },
      { name: "Eliza Garcia", map: "map404" },
      { name: "Freya Mendoza", map: "map404" },
      { name: "Gemma Torres", map: "map404" },
      { name: "Harper Ramos", map: "map404" },
      { name: "Indie Aquino", map: "map404" },
      { name: "Jolie Fernandez", map: "map404" },
      { name: "Kyla Jimenez", map: "map404" },
      { name: "Liora Tan", map: "map404" },
      { name: "Maren Uy", map: "map404" },
      { name: "Nyla Ponce", map: "map404" },
      { name: "Opal Navarro", map: "map404" },
      { name: "Pippa Perez", map: "map404" },
      { name: "Quinn Salazar", map: "map404" },
      { name: "Rylee Hernandez", map: "map404" },
      { name: "Sariah Cabrera", map: "map404" },
      { name: "Taya Velasco", map: "map404" },
      { name: "Uma Dela Rosa", map: "map404" },
      { name: "Veda Fuentes", map: "map404" },
      { name: "Wren Morales", map: "map404" },
      { name: "Xyla Wong", map: "map404" },
      { name: "Ysmeine Kim", map: "map404" },
      { name: "Zariah Patel", map: "map404" },
      { name: "Aisha David", map: "map404" },
      { name: "Bellamy Lim", map: "map404" },
      { name: "Cleo Santos", map: "map404" },
      { name: "Dahlia Reyes", map: "map404" },
      { name: "Elowen Cruz", map: "map404" },
      { name: "Fiora Lopez", map: "map404" },
      { name: "Giselle Garcia", map: "map404" },
      { name: "Arlo Mendoza", map: "map404" },
      { name: "Bowie Torres", map: "map404" },
      { name: "Caspian Ramos", map: "map404" },
      { name: "Dash Aquino", map: "map404" },
      { name: "Ellis Fernandez", map: "map404" },
      { name: "Flint Jimenez", map: "map404" },
      { name: "Griff Tan", map: "map404" },
      { name: "Hayes Uy", map: "map404" },
      { name: "Idris Ponce", map: "map404" },
      { name: "Jovi Navarro", map: "map404" },
      { name: "Kian Perez", map: "map404" },
      { name: "Lorne Salazar", map: "map404" },
      { name: "Merrick Hernandez", map: "map404" },
      { name: "Nico Cabrera", map: "map404" },
      { name: "Oren Velasco", map: "map404" },
      { name: "Piers Dela Rosa", map: "map404" },
      { name: "Quill Fuentes", map: "map404" },
      { name: "Ronan Morales", map: "map404" },
      { name: "Silas Wong", map: "map404" },
      { name: "Talon Kim", map: "map404" },
      { name: "Vance Patel", map: "map404" },
      { name: "Wilder David", map: "map404" },

    { name: "12 STEM", map: "map85" },
      { name: "Bella Quinto", map: "map85" },
      { name: "Breezy Rivera", map: "map85" },
      { name: "Brielle Singh", map: "map85" },
      { name: "Celine Salazar", map: "map85" },
      { name: "Clara Tan", map: "map85" },
      { name: "Cleo Torres", map: "map85" },
      { name: "Dahlia Uy", map: "map85" },
      { name: "Daniella Velasco", map: "map85" },
      { name: "Darcy Wong", map: "map85" },
      { name: "Elara Alvarez", map: "map85" },
      { name: "Eliza Cabrera", map: "map85" },
      { name: "Ella David", map: "map85" },
      { name: "Elowen Espino", map: "map85" },
      { name: "Faith Fuentes", map: "map85" },
      { name: "Fiona Lim", map: "map85" },
      { name: "Freya Patel", map: "map85" },
      { name: "Gemma Perez", map: "map85" },
      { name: "Gia Quinto", map: "map85" },
      { name: "Giselle Rivera", map: "map85" },
      { name: "Hailey Singh", map: "map85" },
      { name: "Harper Salazar", map: "map85" },
      { name: "Indie Tan", map: "map85" },
      { name: "Isabella Torres", map: "map85" },
      { name: "Jada Uy", map: "map85" },
      { name: "Janae Velasco", map: "map85" },
      { name: "Jessa Wong", map: "map85" },
      { name: "Jolie Alvarez", map: "map85" },
      { name: "Kaiya Cabrera", map: "map85" },
      { name: "Kiera David", map: "map85" },
      { name: "Kyla Espino", map: "map85" },
      { name: "Lani Fuentes", map: "map85" },
      { name: "Lara Lim", map: "map85" },
      { name: "Leia Patel", map: "map85" },
      { name: "Luna Perez", map: "map85" }
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




