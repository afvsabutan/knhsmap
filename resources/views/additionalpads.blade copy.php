@php
// Define vertical connections (up/down floors) per map
$verticalMaps = [
    'map180'   => ['up' => 'map321',  'down' => NULL],
    'map321'   => ['up' => NULL,  'down' => 'map180'],
    'map247' => ['up' => 'map401', 'down' => NULL],
    'map401' => ['up' => NULL, 'down' => 'map250'],
    'map405' => ['up' => NULL, 'down' => 'map149'],
    'map149' => ['up' => 'map405', 'down' =>  NULL],
    'map129' => ['up' => 'map449', 'down' =>  NULL],
    'map449' => ['up' => NULL, 'down' => 'map129'],
    'map260' => ['up' => 'map454', 'down' =>  NULL],
    'map454' => ['up' => NULL, 'down' => 'map260'],
    'map289' => ['up' => 'map477', 'down' =>  NULL],
    'map477' => ['up' => NULL, 'down' => 'map289'],
    'map88' => ['up' => 'map482', 'down' =>  NULL],
    'map482' => ['up' => NULL, 'down' => 'map88'],
    'map74' => ['up' => 'map493', 'down' =>  NULL],
    'map493' => ['up' => NULL, 'down' => 'map74'],
    'map68' => ['up' => 'map497', 'down' =>  NULL],
    'map64' => ['up' => 'map497', 'down' =>  NULL],
    'map497' => ['up' => NULL, 'down' => 'map64'],
];
@endphp

@if(isset($verticalMaps[$map]))
    <div class="vertical-pads">

        {{-- Move Up Floor --}}
        @if(!empty($verticalMaps[$map]['up']))
            <a href="/map/{{ $verticalMaps[$map]['up'] }}"
               class="vertical-btn up">
                🔼 FLOOR UP
            </a>
        @endif

        {{-- Move Down Floor --}}
        @if(!empty($verticalMaps[$map]['down']))
            <a href="/map/{{ $verticalMaps[$map]['down'] }}"
               class="vertical-btn down">
                🔽 FLOOR DOWN
            </a>
        @endif

    </div>
@endif

{{-- CSS for vertical pads above mini-DPAD --}}
<style>
.vertical-pads {
    position: fixed;
    right: 20px;       /* align with mini-DPAD */
    bottom: 340px;     /* above mini-DPAD (mini-DPAD is at 80px from bottom) */
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 410;      /* above mini-DPAD (z-index 310) */
}

.vertical-btn {
    padding: 10px 14px;
    background: rgba(0,0,0,0.75);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    text-align: center;
    font-size: 14px;
}

.vertical-btn:hover {
    background: rgba(0,0,0,0.95);
}
</style>



@php
// Define clickable zones per map in 16:9 coordinates (x:0-16, y:0-9)
$mapZones = [
    'map1' => [
        ['id' => 'button1map1', 'x1' => 1, 'y1' => 1, 'x2' => 3, 'y2' => 6, 'text' => 'Hello World!'],
        ['id' => 'button2map1', 'x1' => 10, 'y1' => 2, 'x2' => 12, 'y2' => 5, 'text' => 'Another Info'],
    ],
    'map2' => [
        ['id' => 'button1map2', 'x1' => 5, 'y1' => 3, 'x2' => 8, 'y2' => 7, 'text' => 'Map 2 Zone!'],
    ],
];
$currentMap = $map ?? 'map1';
$zones = $mapZones[$currentMap] ?? [];
@endphp

@foreach($zones as $zone)
    <div 
        id="{{ $zone['id'] }}"
        class="map-zone"
        data-x1="{{ $zone['x1'] }}"
        data-y1="{{ $zone['y1'] }}"
        data-x2="{{ $zone['x2'] }}"
        data-y2="{{ $zone['y2'] }}"
        data-text="{{ $zone['text'] }}"
        style="position:absolute; border:2px dashed rgba(255,255,255,0.6); cursor:pointer;"
    ></div>
@endforeach

<script>
function scaleZones() {
    const stage = document.getElementById('ratio-stage');
    if(!stage) return;
    const stageWidth = stage.clientWidth;
    const stageHeight = stage.clientHeight;

    document.querySelectorAll('.map-zone').forEach(zone => {
        const x1 = parseFloat(zone.dataset.x1);
        const y1 = parseFloat(zone.dataset.y1);
        const x2 = parseFloat(zone.dataset.x2);
        const y2 = parseFloat(zone.dataset.y2);

        const left = (x1 / 16) * stageWidth;
        const top = (y1 / 9) * stageHeight;
        const width = ((x2 - x1) / 16) * stageWidth;
        const height = ((y2 - y1) / 9) * stageHeight;

        zone.style.left = left + 'px';
        zone.style.top = top + 'px';
        zone.style.width = width + 'px';
        zone.style.height = height + 'px';
    });
}

document.addEventListener('DOMContentLoaded', () => {
    scaleZones();
    document.querySelectorAll('.map-zone').forEach(zone => {
        zone.addEventListener('click', () => {
            alert(zone.dataset.text);
        });
    });
});

window.addEventListener('resize', scaleZones);
window.addEventListener('orientationchange', scaleZones);
</script>

<style>
.map-zone:hover {
    background: rgba(255, 255, 255, 0.2);
}
</style>
