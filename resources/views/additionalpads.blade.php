@php
// Define vertical connections (up/down floors) per map
$verticalMaps = [
    'map180' => ['up' => 'map321', 'down' => NULL],
    'map321' => ['up' => NULL, 'down' => 'map180'],
    'map247' => ['up' => 'map401', 'down' => NULL],
    'map401' => ['up' => NULL, 'down' => 'map250'],
    'map405' => ['up' => NULL, 'down' => 'map149'],
    'map149' => ['up' => 'map405', 'down' => NULL],
    'map129' => ['up' => 'map449', 'down' => NULL],
    'map449' => ['up' => NULL, 'down' => 'map129'],
    'map260' => ['up' => 'map454', 'down' => NULL],
    'map454' => ['up' => NULL, 'down' => 'map260'],
    'map289' => ['up' => 'map477', 'down' => NULL],
    'map477' => ['up' => NULL, 'down' => 'map289'],
    'map88' => ['up' => 'map482', 'down' => NULL],
    'map482' => ['up' => NULL, 'down' => 'map88'],
    'map74' => ['up' => 'map493', 'down' => NULL],
    'map493' => ['up' => NULL, 'down' => 'map74'],
    'map68' => ['up' => 'map497', 'down' => NULL],
    'map64' => ['up' => 'map497', 'down' => NULL],
    'map497' => ['up' => NULL, 'down' => 'map64'],
];
@endphp

@if(isset($verticalMaps[$map]))
<div class="vertical-pads">
    @if(!empty($verticalMaps[$map]['up']))
        <a href="/map/{{ $verticalMaps[$map]['up'] }}" class="vertical-btn up">🔼 FLOOR UP</a>
    @endif
    @if(!empty($verticalMaps[$map]['down']))
        <a href="/map/{{ $verticalMaps[$map]['down'] }}" class="vertical-btn down">🔽 FLOOR DOWN</a>
    @endif
</div>
@endif

<style>
.vertical-pads {
    position: fixed;
    right: 20px;
    bottom: 340px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 410;
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
.vertical-btn:hover { background: rgba(0,0,0,0.95); }
</style>

@php
// Define clickable zones per map
$mapZones = [
    'map264' => [
        [
            'id' => 'button1map264',
            'x1' => 102, 'y1' => 20, 'x2' => 117, 'y2' => 90,
            'title' => 'Grade 8 - ARISTOTLE',
            'students' => [
                'girls' => [
                    'Aaliyah Santos','Abby Reyes','Althea Cruz','Amara Lopez','Andrea Garcia','Angelique Mendoza','Anya Torres','Aria Ramos',
                    'Bella Aquino','Breezy Fernandez','Celine Jimenez','Clara Tan','Dana Uy','Darcy Ponce','Elara Navarro','Eliza Perez',
                    'Faith Salazar','Fiona Hernandez','Freya Cabrera','Gemma Velasco','Gia Dela Rosa','Hailey Fuentes','Harper Morales','Indie Wong',
                    'Isabella Kim','Jada Patel','Janae David','Jessa Lim','Jolie Santos','Kaiya Reyes','Kyla Cruz','Lara Lopez'
                ],
                'boys' => [
                    'Aaron Garcia','Arlo Mendoza','Blaze Torres','Carlo Ramos','Cole Aquino','Dash Fernandez','Diego Jimenez','Eli Tan',
                    'Enzo Uy','Finn Ponce','Gabe Navarro','Griff Perez','Hayes Salazar','Hugo Hernandez','Ian Cabrera','Jax Velasco',
                    'Kai Dela Rosa','Knox Fuentes','Leo Morales','Milo Wong','Nash Kim'
                ]
            ]
        ],
    ],
    'map268' => [
        [
            'id' => 'button1map264',
            'x1' => 122, 'y1' => 0, 'x2' => 155, 'y2' => 90,
            'title' => 'Grade 8 - ARISTOTLE',
            'students' => [
                'girls' => [
                    'Aaliyah Santos','Abby Reyes','Althea Cruz','Amara Lopez','Andrea Garcia','Angelique Mendoza','Anya Torres','Aria Ramos',
                    'Bella Aquino','Breezy Fernandez','Celine Jimenez','Clara Tan','Dana Uy','Darcy Ponce','Elara Navarro','Eliza Perez',
                    'Faith Salazar','Fiona Hernandez','Freya Cabrera','Gemma Velasco','Gia Dela Rosa','Hailey Fuentes','Harper Morales','Indie Wong',
                    'Isabella Kim','Jada Patel','Janae David','Jessa Lim','Jolie Santos','Kaiya Reyes','Kyla Cruz','Lara Lopez'
                ],
                'boys' => [
                    'Aaron Garcia','Arlo Mendoza','Blaze Torres','Carlo Ramos','Cole Aquino','Dash Fernandez','Diego Jimenez','Eli Tan',
                    'Enzo Uy','Finn Ponce','Gabe Navarro','Griff Perez','Hayes Salazar','Hugo Hernandez','Ian Cabrera','Jax Velasco',
                    'Kai Dela Rosa','Knox Fuentes','Leo Morales','Milo Wong','Nash Kim'
                ]
            ]
        ],
    ],
    'map270' => [
        [
            'id' => 'button1map264',
            'x1' => 112, 'y1' => 0, 'x2' => 152, 'y2' => 90,
            'title' => 'Grade 8 - ARISTOTLE',
            'students' => [
                'girls' => [
                    'Aaliyah Santos','Abby Reyes','Althea Cruz','Amara Lopez','Andrea Garcia','Angelique Mendoza','Anya Torres','Aria Ramos',
                    'Bella Aquino','Breezy Fernandez','Celine Jimenez','Clara Tan','Dana Uy','Darcy Ponce','Elara Navarro','Eliza Perez',
                    'Faith Salazar','Fiona Hernandez','Freya Cabrera','Gemma Velasco','Gia Dela Rosa','Hailey Fuentes','Harper Morales','Indie Wong',
                    'Isabella Kim','Jada Patel','Janae David','Jessa Lim','Jolie Santos','Kaiya Reyes','Kyla Cruz','Lara Lopez'
                ],
                'boys' => [
                    'Aaron Garcia','Arlo Mendoza','Blaze Torres','Carlo Ramos','Cole Aquino','Dash Fernandez','Diego Jimenez','Eli Tan',
                    'Enzo Uy','Finn Ponce','Gabe Navarro','Griff Perez','Hayes Salazar','Hugo Hernandez','Ian Cabrera','Jax Velasco',
                    'Kai Dela Rosa','Knox Fuentes','Leo Morales','Milo Wong','Nash Kim'
                ]
            ]
        ],
    ],
    'map272' => [
        [
            'id' => 'button1map264',
            'x1' => 107, 'y1' => 19, 'x2' => 115, 'y2' => 77,
            'title' => 'Grade 8 - ARISTOTLE',
            'students' => [
                'girls' => [
                    'Aaliyah Santos','Abby Reyes','Althea Cruz','Amara Lopez','Andrea Garcia','Angelique Mendoza','Anya Torres','Aria Ramos',
                    'Bella Aquino','Breezy Fernandez','Celine Jimenez','Clara Tan','Dana Uy','Darcy Ponce','Elara Navarro','Eliza Perez',
                    'Faith Salazar','Fiona Hernandez','Freya Cabrera','Gemma Velasco','Gia Dela Rosa','Hailey Fuentes','Harper Morales','Indie Wong',
                    'Isabella Kim','Jada Patel','Janae David','Jessa Lim','Jolie Santos','Kaiya Reyes','Kyla Cruz','Lara Lopez'
                ],
                'boys' => [
                    'Aaron Garcia','Arlo Mendoza','Blaze Torres','Carlo Ramos','Cole Aquino','Dash Fernandez','Diego Jimenez','Eli Tan',
                    'Enzo Uy','Finn Ponce','Gabe Navarro','Griff Perez','Hayes Salazar','Hugo Hernandez','Ian Cabrera','Jax Velasco',
                    'Kai Dela Rosa','Knox Fuentes','Leo Morales','Milo Wong','Nash Kim'
                ]
            ]
        ],
    ],
    'map274' => [
        [
            'id' => 'button1map264',
            'x1' => 17, 'y1' => 5, 'x2' => 50, 'y2' => 90,
            'title' => 'Grade 8 - ARISTOTLE',
            'students' => [
                'girls' => [
                    'Aaliyah Santos','Abby Reyes','Althea Cruz','Amara Lopez','Andrea Garcia','Angelique Mendoza','Anya Torres','Aria Ramos',
                    'Bella Aquino','Breezy Fernandez','Celine Jimenez','Clara Tan','Dana Uy','Darcy Ponce','Elara Navarro','Eliza Perez',
                    'Faith Salazar','Fiona Hernandez','Freya Cabrera','Gemma Velasco','Gia Dela Rosa','Hailey Fuentes','Harper Morales','Indie Wong',
                    'Isabella Kim','Jada Patel','Janae David','Jessa Lim','Jolie Santos','Kaiya Reyes','Kyla Cruz','Lara Lopez'
                ],
                'boys' => [
                    'Aaron Garcia','Arlo Mendoza','Blaze Torres','Carlo Ramos','Cole Aquino','Dash Fernandez','Diego Jimenez','Eli Tan',
                    'Enzo Uy','Finn Ponce','Gabe Navarro','Griff Perez','Hayes Salazar','Hugo Hernandez','Ian Cabrera','Jax Velasco',
                    'Kai Dela Rosa','Knox Fuentes','Leo Morales','Milo Wong','Nash Kim'
                ]
            ]
        ],
    ],
    'map276' => [
        [
            'id' => 'button1map264',
            'x1' => 107, 'y1' => 18, 'x2' => 116, 'y2' => 83,
            'title' => 'Grade 8 - DARWIN',
            'students' => [
                'girls' => [
                    'Lani Hernandez','Lara Cabrera','Leia Velasco','Luna Dela Rosa','Mia Fuentes',
                    'Nica Morales','Nova Wong','Opal Kim','Paige Patel','Pia David',
                    'Quinn Lim','Raya Santos','Riley Reyes','Rylee Cruz','Sariah Lopez',
                    'Skye Garcia','Sienna Mendoza','Tessa Torres','Tia Ramos','Uma Aquino',
                    'Veda Fernandez','Wren Jimenez','Xena Tan','Xyla Uy','Yara Ponce'
                ],
                'boys' => [
                    'Lars Navarro','Leo Perez','Mack Salazar','Merrick Hernandez','Milo Cabrera',
                    'Nash Velasco','Nico Dela Rosa','Oren Fuentes','Orion Morales','Pax Wong',
                    'Piers Kim','Quill Patel','Rex David','Rocco Lim','Ronan Santos',
                    'Silas Reyes','Tate Cruz'
                ]
            ]
        ],
    ],
    'map278' => [
        [
            'id' => 'button1map264',
            'x1' => 107, 'y1' => 14, 'x2' => 133, 'y2' => 80,
            'title' => 'Grade 8 - DARWIN',
            'students' => [
                'girls' => [
                    'Lani Hernandez','Lara Cabrera','Leia Velasco','Luna Dela Rosa','Mia Fuentes',
                    'Nica Morales','Nova Wong','Opal Kim','Paige Patel','Pia David',
                    'Quinn Lim','Raya Santos','Riley Reyes','Rylee Cruz','Sariah Lopez',
                    'Skye Garcia','Sienna Mendoza','Tessa Torres','Tia Ramos','Uma Aquino',
                    'Veda Fernandez','Wren Jimenez','Xena Tan','Xyla Uy','Yara Ponce'
                ],
                'boys' => [
                    'Lars Navarro','Leo Perez','Mack Salazar','Merrick Hernandez','Milo Cabrera',
                    'Nash Velasco','Nico Dela Rosa','Oren Fuentes','Orion Morales','Pax Wong',
                    'Piers Kim','Quill Patel','Rex David','Rocco Lim','Ronan Santos',
                    'Silas Reyes','Tate Cruz'
                ]
            ]
        ],
    ],
    'map280' => [
        [
            'id' => 'button1map264',
            'x1' => 97, 'y1' => 26, 'x2' => 100, 'y2' => 67,
            'title' => 'Grade 8 - DARWIN',
            'students' => [
                'girls' => [
                    'Lani Hernandez','Lara Cabrera','Leia Velasco','Luna Dela Rosa','Mia Fuentes',
                    'Nica Morales','Nova Wong','Opal Kim','Paige Patel','Pia David',
                    'Quinn Lim','Raya Santos','Riley Reyes','Rylee Cruz','Sariah Lopez',
                    'Skye Garcia','Sienna Mendoza','Tessa Torres','Tia Ramos','Uma Aquino',
                    'Veda Fernandez','Wren Jimenez','Xena Tan','Xyla Uy','Yara Ponce'
                ],
                'boys' => [
                    'Lars Navarro','Leo Perez','Mack Salazar','Merrick Hernandez','Milo Cabrera',
                    'Nash Velasco','Nico Dela Rosa','Oren Fuentes','Orion Morales','Pax Wong',
                    'Piers Kim','Quill Patel','Rex David','Rocco Lim','Ronan Santos',
                    'Silas Reyes','Tate Cruz'
                ]
            ]
        ],
    ],
    'map284' => [
        [
            'id' => 'button1map264',
            'x1' => 120, 'y1' => 0, 'x2' => 142, 'y2' => 90,
            'title' => 'Grade 8 - HARVEY',
            'students' => [
                'girls' => [
                    'Hailey Reyes','Harper Cruz','Indie Lopez','Isabella Garcia','Jada Mendoza',
                    'Janae Torres','Jessa Ramos','Jolie Aquino','Kaiya Fernandez','Kiera Jimenez',
                    'Kyla Tan','Lani Uy','Lara Ponce','Leia Navarro','Luna Perez',
                    'Mia Salazar','Nica Hernandez','Nova Cabrera','Opal Velasco','Paige Dela Rosa',
                    'Pia Fuentes','Quinn Morales','Raya Wong','Riley Kim','Rylee Patel',
                    'Sariah David','Skye Lim','Sienna Santos','Tessa Reyes','Tia Cruz'
                ],
                'boys' => [
                    'Gabe Lopez','Griff Garcia','Hayes Mendoza','Hugo Torres','Ian Ramos',
                    'Jax Aquino','Jett Fernandez','Kai Jimenez','Knox Tan','Lars Uy',
                    'Leo Ponce','Mack Navarro','Merrick Perez','Milo Salazar','Nash Hernandez',
                    'Nico Cabrera','Orion Velasco','Pax Dela Rosa','Quill Fuentes','Rex Morales'
                ]
            ]
        ],
    ],
    'map452' => [
        [
            'id' => 'button1map264',
            'x1' => 99, 'y1' => 17, 'x2' => 106, 'y2' => 67,
            'title' => 'Grade 8 - CARSON',
            'students' => [
                'girls' => [
                    'Aira Navarro','Aisha Perez','Althea Salazar','Amara Hernandez','Andrea Cabrera',
                    'Angelique Velasco','Anya Dela Rosa','Aria Fuentes','Bella Morales','Brielle Wong',
                    'Celine Kim','Clara Patel','Cleo David','Dahlia Lim','Daniella Santos',
                    'Darcy Reyes','Elara Cruz','Ella Lopez','Elowen Garcia','Faith Mendoza',
                    'Fiora Torres','Freya Ramos','Gemma Aquino','Gia Fernandez','Giselle Jimenez',
                    'Hailey Tan','Harper Uy','Indie Ponce','Isabella Navarro','Jada Perez',
                    'Janae Salazar','Jessa Hernandez','Jolie Cabrera','Kaiya Velasco','Kiera Dela Rosa'
                ],
                'boys' => [
                    'Aaron Fuentes','Arlo Morales','Axel Wong','Beau Kim','Blaze Patel',
                    'Bowie David','Carlo Lim','Caspian Santos','Cole Reyes','Dash Cruz',
                    'Diego Lopez','Ellis Garcia','Enzo Mendoza','Finn Torres','Flint Ramos',
                    'Ford Aquino','Gabe Fernandez','Gage Jimenez','Griff Tan','Hayes Uy',
                    'Huck Ponce','Ian Navarro','Jett Perez','Knox Salazar'
                ]
            ]
        ],
    ],
    'map129' => [
        [
            'id' => 'button1',
            'x1' => 0, 'y1' => 12, 'x2' => 70, 'y2' => 60,
            'title' => 'Grade 7 - ALZONA',
            'students' => [
                'girls' => [
                    'Aria Santos','Bella Reyes','Celine Cruz','Dana Lopez','Ella Garcia',
                    'Faith Mendoza','Gia Torres','Hailey Ramos','Isla Aquino','Jessa Fernandez',
                    'Kaiya Jimenez','Lara Tan','Mia Uy','Nica Ponce','Opal Navarro',
                    'Pia Perez','Quinn Salazar','Raya Hernandez','Skye Cabrera','Tessa Velasco',
                    'Uma Dela Rosa','Veda Fuentes','Wren Morales','Xena Wong'
                ],
                'boys' => [
                    'Axel Kim','Beau Patel','Cole David','Dax Lim','Eli Santos',
                    'Finn Reyes','Gabe Cruz','Huck Lopez','Ian Garcia','Jax Mendoza',
                    'Kai Torres','Leo Ramos','Milo Aquino','Nico Fernandez','Orion Jimenez','Pax Tan'
                ]
            ]
        ],
    ],
    'map131' => [
        [
            'id' => 'button1',
            'x1' => 93, 'y1' => 16, 'x2' => 160, 'y2' => 55,
            'title' => 'Grade 7 - ALZONA',
            'students' => [
                'girls' => [
                    'Aria Santos','Bella Reyes','Celine Cruz','Dana Lopez','Ella Garcia',
                    'Faith Mendoza','Gia Torres','Hailey Ramos','Isla Aquino','Jessa Fernandez',
                    'Kaiya Jimenez','Lara Tan','Mia Uy','Nica Ponce','Opal Navarro',
                    'Pia Perez','Quinn Salazar','Raya Hernandez','Skye Cabrera','Tessa Velasco',
                    'Uma Dela Rosa','Veda Fuentes','Wren Morales','Xena Wong'
                ],
                'boys' => [
                    'Axel Kim','Beau Patel','Cole David','Dax Lim','Eli Santos',
                    'Finn Reyes','Gabe Cruz','Huck Lopez','Ian Garcia','Jax Mendoza',
                    'Kai Torres','Leo Ramos','Milo Aquino','Nico Fernandez','Orion Jimenez','Pax Tan'
                ]
            ]
        ],
        [
            'id' => 'button2',
            'x1' => 0, 'y1' => 17, 'x2' => 80, 'y2' => 54,
            'title' => 'Grade 7 - ZARA-STE',
            'students' => [
                'girls' => [
                    'Lara Hernandez','Leia Cabrera','Luna Velasco','Mia Dela Rosa','Nica Fuentes',
                    'Nova Morales','Paige Wong','Quinn Kim','Raya Patel','Riley David',
                    'Skye Lim','Tessa Santos','Uma Reyes','Veda Cruz','Wren Lopez',
                    'Xyla Garcia','Yara Mendoza','Zia Torres','Zoe Ramos','Aaliyah Aquino',
                    'Brielle Fernandez','Clara Jimenez','Darcy Tan','Eliza Uy','Freya Ponce',
                    'Gemma Navarro','Harper Perez','Indie Salazar','Jolie Hernandez'
                ],
                'boys' => [
                    'Arlo Cabrera','Bowie Velasco','Caspian Dela Rosa','Dash Fuentes','Ellis Morales',
                    'Flint Wong','Griff Kim','Hayes Patel','Idris David','Jovi Lim',
                    'Kian Santos','Lorne Reyes','Merrick Cruz','Nico Lopez','Oren Garcia',
                    'Piers Mendoza','Quill Torres','Ronan Ramos','Silas Aquino'
                ]
            ]       
        ],
    ],
    'map145' => [
        [
            'id' => 'button1',
            'x1' => 24, 'y1' => 16, 'x2' => 113, 'y2' => 52,
            'title' => 'Grade 7 - DELA CRUZ',
            'students' => [
                'girls' => [
                    'Aaliyah Cabrera','Brielle Velasco','Clara Dela Rosa','Darcy Fuentes','Eliza Morales',
                    'Freya Wong','Gemma Kim','Harper Patel','Indie David','Jolie Lim',
                    'Kyla Santos','Liora Reyes','Maren Cruz','Nyla Lopez','Opal Garcia',
                    'Pippa Mendoza','Quinn Torres','Rylee Ramos','Sariah Aquino','Taya Fernandez',
                    'Uma Jimenez','Veda Tan','Wren Uy','Xyla Ponce','Ysmeine Navarro',
                    'Zariah Perez','Aisha Salazar','Bellamy Hernandez','Cleo Cabrera','Dahlia Velasco'
                ],
                'boys' => [
                    'Arlo Dela Rosa','Bowie Fuentes','Caspian Morales','Dash Wong','Ellis Kim',
                    'Flint Patel','Griff David','Hayes Lim','Idris Santos','Jovi Reyes',
                    'Kian Cruz','Lorne Lopez','Merrick Garcia','Nico Mendoza','Oren Torres',
                    'Piers Ramos','Quill Aquino','Ronan Fernandez','Silas Jimenez','Talon Tan'
                ]
            ]
        ],
    ],
    'map141' => [
        [
            'id' => 'button1',
            'x1' => 18, 'y1' => 23, 'x2' => 100, 'y2' => 56,
            'title' => 'Grade 7 - CAMPOS',
            'students' => [
                'girls' => [
                    'Abby Cruz','Amara Lopez','Bea Garcia','Cia Mendoza','Dana Torres',
                    'Elara Ramos','Fiona Aquino','Gia Fernandez','Hana Jimenez','Ivy Tan',
                    'Jada Uy','Kiera Ponce','Lani Navarro','Maya Perez','Nia Salazar',
                    'Opal Hernandez','Pia Cabrera','Quinn Velasco','Rhea Dela Rosa','Sienna Fuentes',
                    'Tia Morales','Uma Wong','Veda Kim','Wren Patel','Xena David','Zoe Lim'
                ],
                'boys' => [
                    'Blaze Santos','Cole Reyes','Dax Cruz','Eli Lopez','Ford Garcia',
                    'Gage Mendoza','Huck Torres','Ike Ramos','Jett Aquino','Knox Fernandez',
                    'Lars Jimenez','Mack Tan','Nash Uy','Ozzy Ponce','Pike Navarro',
                    'Quill Perez','Rocco Salazar','Slade Hernandez'
                ]
            ]
        ],
        [
            'id' => 'button2',
            'x1' => 110, 'y1' => 21, 'x2' => 160, 'y2' => 56,
            'title' => 'Grade 7 - ESCURO',
            'students' => [
                'girls' => [
                    'Abby Mendoza','Amara Torres','Bea Ramos','Cia Aquino','Dana Fernandez',
                    'Elara Jimenez','Fiona Tan','Gia Uy','Hana Ponce','Ivy Navarro',
                    'Jada Perez','Kiera Salazar','Lani Hernandez','Maya Cabrera','Nia Velasco',
                    'Opal Dela Rosa','Pia Fuentes','Quinn Morales','Rhea Wong','Sienna Kim',
                    'Tia Patel','Uma David','Veda Lim','Wren Santos','Xena Reyes',
                    'Yara Cruz','Zia Lopez','Zoe Garcia','Aaliyah Mendoza','Brielle Torres',
                    'Clara Ramos','Darcy Aquino','Eliza Fernandez','Freya Jimenez'
                ],
                'boys' => [
                    'Arlo Tan','Bowie Uy','Caspian Ponce','Dash Navarro','Ellis Perez',
                    'Flint Salazar','Griff Hernandez','Hayes Cabrera','Idris Velasco','Jovi Dela Rosa',
                    'Kian Fuentes','Lorne Morales','Merrick Wong','Nico Kim','Oren Patel',
                    'Piers David','Quill Lim','Ronan Santos','Silas Reyes','Talon Cruz',
                    'Vance Lopez','Wilder Garcia'
                ]
            ]
        ],
    ],
    'map404' => [
        [
            'id' => 'button1',
            'x1' => 52, 'y1' => 13, 'x2' => 73, 'y2' => 47,
            'title' => 'Grade 7 - ALMEDA',
            'students' => [
                'girls' => [
                    'Aaliyah Santos','Brielle Reyes','Clara Cruz','Darcy Lopez','Eliza Garcia',
                    'Freya Mendoza','Gemma Torres','Harper Ramos','Indie Aquino','Jolie Fernandez',
                    'Kyla Jimenez','Liora Tan','Maren Uy','Nyla Ponce','Opal Navarro',
                    'Pippa Perez','Quinn Salazar','Rylee Hernandez','Sariah Cabrera','Taya Velasco',
                    'Uma Dela Rosa','Veda Fuentes','Wren Morales','Xyla Wong','Ysmeine Kim',
                    'Zariah Patel','Aisha David','Bellamy Lim','Cleo Santos','Dahlia Reyes',
                    'Elowen Cruz','Fiora Lopez','Giselle Garcia'
                ],
                'boys' => [
                    'Arlo Mendoza','Bowie Torres','Caspian Ramos','Dash Aquino','Ellis Fernandez',
                    'Flint Jimenez','Griff Tan','Hayes Uy','Idris Ponce','Jovi Navarro',
                    'Kian Perez','Lorne Salazar','Merrick Hernandez','Nico Cabrera','Oren Velasco',
                    'Piers Dela Rosa','Quill Fuentes','Ronan Morales','Silas Wong','Talon Kim',
                    'Vance Patel','Wilder David'
                ]
            ]
        ],
    ],
    




];
$currentMap = $map ?? 'map1';
$zones = $mapZones[$currentMap] ?? [];
@endphp

{{-- Render zones --}}
@foreach($zones as $zone)
<div
    id="{{ $zone['id'] }}"
    class="map-zone"
    data-x1="{{ $zone['x1'] }}"
    data-y1="{{ $zone['y1'] }}"
    data-x2="{{ $zone['x2'] }}"
    data-y2="{{ $zone['y2'] }}"
    data-title="{{ $zone['title'] }}"
    data-students='@json($zone['students'])'
    style="position:absolute; border:2px dashed rgba(255,255,255,0.6); cursor:pointer;"
></div>
@endforeach





{{-- Cursor coordinates overlay for debugging TO REMOVE AFTER --}}
<div id="cursor-coords" style="
    position: fixed;
    top: 10px;
    left: 10px;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 4px;
    z-index: 99999;
    pointer-events: none;
"></div>








{{-- Modal --}}
<div id="class-modal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <span id="modal-title"></span>
            <span class="modal-close" onclick="closeClassModal()">×</span>
        </div>
        <div class="modal-body">
            <div id="modal-summary" style="margin-bottom:10px; font-weight:bold;"></div>
            <div class="student-grid" id="modal-students"></div>
        </div>
    </div>
</div>

<style>
.map-zone:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Modal styling */
#class-modal {
    display: none;
    position: fixed;
    top:0; left:0;
    width:100vw; height:100vh;
    background: rgba(0, 18, 43, 0);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
.modal-content {
    background: rgba(0,18,43,0.9);
    color: #fff;
    padding: 15px 20px;
    border-radius: 12px;
    width: 80%;
    max-width: 700px;
    max-height: auto;
}
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
.modal-close {
    cursor: pointer;
    font-size: 18px;
    padding: 3px 6px;
    background: #444;
    border-radius: 6px;
}
.student-grid {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: space-between;
    font-size: 13px;
}
.student-column {
    flex: 1;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 4px 6px;
}
.student-column div:first-child {
    font-weight: bold;
    margin-bottom: 4px;
}
.student-column div {
    background: rgba(255,255,255,0.1);
    padding: 2px 4px;
    border-radius: 4px;
    text-align: left;
}
</style>

<script>
// Scale zones to 16:9
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

        zone.style.left = (x1 / 160 * stageWidth) + 'px';
        zone.style.top = (y1 / 90 * stageHeight) + 'px';
        zone.style.width = ((x2 - x1) / 160 * stageWidth) + 'px';
        zone.style.height = ((y2 - y1) / 90 * stageHeight) + 'px';
    });
}

// Modal open/close
function openClassModal(title, students) {
    document.getElementById('modal-title').innerText = title;

    const total = students.girls.length + students.boys.length;
    document.getElementById('modal-summary').innerText = `${total} students: ${students.girls.length} girls, ${students.boys.length} boys`;

    const grid = document.getElementById('modal-students');
    grid.innerHTML = '';

    // Girls column
    const girlsCol = document.createElement('div');
    girlsCol.classList.add('student-column');
    const girlsTitle = document.createElement('div');
    girlsTitle.innerHTML = "Girls";
    girlsCol.appendChild(girlsTitle);
    students.girls.forEach(g => {
        const div = document.createElement('div');
        div.innerText = g;
        girlsCol.appendChild(div);
    });

    // Boys column
    const boysCol = document.createElement('div');
    boysCol.classList.add('student-column');
    const boysTitle = document.createElement('div');
    boysTitle.innerHTML = "Boys";
    boysCol.appendChild(boysTitle);
    students.boys.forEach(b => {
        const div = document.createElement('div');
        div.innerText = b;
        boysCol.appendChild(div);
    });

    grid.appendChild(girlsCol);
    grid.appendChild(boysCol);

    document.getElementById('class-modal').style.display = 'flex';
}

function closeClassModal() {
    document.getElementById('class-modal').style.display = 'none';
}

// Add click events
document.addEventListener('DOMContentLoaded', () => {
    scaleZones();
    document.querySelectorAll('.map-zone').forEach(zone => {
        zone.addEventListener('click', () => {
            openClassModal(
                zone.dataset.title,
                JSON.parse(zone.dataset.students)
            );
        });
    });
});

window.addEventListener('resize', scaleZones);
window.addEventListener('orientationchange', scaleZones);




// Show cursor X/Y for 16:9 coordinates
document.addEventListener('mousemove', function(e) {
    const stage = document.getElementById('ratio-stage');
    const overlay = document.getElementById('cursor-coords');
    if(!stage || !overlay) return;

    const rect = stage.getBoundingClientRect();
    const offsetX = e.clientX - rect.left;
    const offsetY = e.clientY - rect.top;

    if(offsetX >= 0 && offsetY >= 0 && offsetX <= rect.width && offsetY <= rect.height) {
        const x = Math.round(offsetX / rect.width * 160);
        const y = Math.round(offsetY / rect.height * 90);
        overlay.innerText = `x: ${x}, y: ${y}`;
    } else {
        overlay.innerText = '';
    }
});

</script>
