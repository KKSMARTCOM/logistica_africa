<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Terrassement',
                'description' => 'Découvrez nos machines de terrasement',
                'image' => 'assets/images/machine/compacteur.png',
            ],
            [
                'name' => 'Levage',
                'description' => 'Découvrez nos machines de levage',
                'image' => 'assets/images/machine/tractopelle.png',
            ],
            [
                'name' => 'Transport',
                'description' => 'Découvrez nos machines de transport',
                'image' => 'assets/images/machine/12roues.png',
            ],
            [
                'name' => 'Équipements complémentaires',
                'description' => 'Découvrez nos équipements complémentaires',
                'image' => 'assets/images/machine/auto-betonniere.png',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $machines = [
            'Terrassement' => [
                [
                    'name' => 'Compacteur',
                    'description' => 'Chariot élévateur électrique compact et puissant.',
                    'image' => 'assets/images/machine/compacteur.png',
                    'additionnal_images' => ['toyota1.jpg', 'toyota2.jpg'],
                    'price' => 200000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'CA610D, 129Kw',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '3000 m²/jour',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'Dynapac',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2013',
                        ],
                    ]
                ],
                [
                    'name' => 'Auto-bétonnière',
                    'description' => 'Système motorisé pour transport de colis en ligne droite.',
                    'image' => 'assets/images/machine/auto-betonniere.png',
                    'additionnal_images' => [],
                    'price' => 300000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => '3500EE',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '50 m³/jour (8 heures)',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'DBM',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2023',
                        ],
                    ]
                ],
                [
                    'name' => 'Pelle Mécanique',
                    'description' => 'Système motorisé pour transport de colis en ligne droite.',
                    'image' => 'assets/images/machine/pelle.png',
                    'additionnal_images' => [],
                    'price' => 350000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'E300DL, 169 Kw',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '810m³/jour',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'VOLVO',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2022',
                        ]
                    ]
                ],
                [
                    'name' => 'Chargeuse',
                    'description' => 'Système motorisé pour transport de colis en ligne droite.',
                    'image' => 'assets/images/machine/chargeuse.png',
                    'additionnal_images' => [],
                    'price' => 250000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'L956F, 165Kw',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '1500m³/jour',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'SDLG',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2022',
                        ],
                    ]
                ],
                [
                    'name' => 'Niveleuse',
                    'description' => 'Système motorisé pour transport de colis en ligne droite.',
                    'image' => 'assets/images/machine/niveuse.png',
                    'additionnal_images' => [],
                    'price' => 350000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'CAT 140H, 154Kw',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '780m³/jour',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'CATERPILLAR',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2007',
                        ],
                    ]
                ],
                [
                    'name' => 'Compacteur',
                    'description' => 'Système motorisé pour transport de colis en ligne droite.',
                    'image' => 'assets/images/machine/compacteur2.png',
                    'additionnal_images' => [],
                    'price' => 30000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'Kohler KD15-440',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '0,50/0,25mm-25/13 kN-63/63hz',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'DYNAPAC',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2024',
                        ],
                    ]
                ],
            ],
            'Levage' => [
                [
                    'name' => 'Tractopelle',
                    'description' => 'Transpalette robuste pour entrepôt intensif.',
                    'image' => 'assets/images/machine/tractopelle.png',
                    'additionnal_images' => [],
                    'price' => 180000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => '3DXPLUS, 55Kw',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => 'Godet 1m³',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'JCB',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2023',
                        ],
                    ]
                ],
                [
                    'name' => 'Tractopelle',
                    'description' => 'Transpalette compact avec grande manœuvrabilité.',
                    'image' => 'assets/images/machine/tractopel.png',
                    'additionnal_images' => [],
                    'price' => 180000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'B877F, 70Kw',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => 'Godet 1m³',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'SDLG',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2022',
                        ],
                    ]
                ],
            ],
            'Transport' => [
                [
                    'name' => 'Camion Benne 12 roues',
                    'description' => 'Gerbeur électrique avec levée initiale.',
                    'image' => 'assets/images/machine/12roues.png',
                    'additionnal_images' => [],
                    'price' => 140000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'F2000',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '25m³',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'SHACMAN',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2023',
                        ],

                    ]
                ],
                [
                    'name' => 'Camion Benne 10 roues',
                    'description' => 'Gerbeur électrique avec levée initiale.',
                    'image' => 'assets/images/machine/10roues.png',
                    'additionnal_images' => [],
                    'price' => 120000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'F2000',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '20m³',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'SHACMAN',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2023',
                        ],
                    ]
                ],
                [
                    'name' => 'Camion grue',
                    'description' => 'Gerbeur électrique avec levée initiale.',
                    'image' => 'assets/images/machine/grue.png',
                    'additionnal_images' => [],
                    'price' => 80000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'PK140.1',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '6T',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'RENAULT-ATLAS',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '1996',
                        ],
                    ]
                ],
                [
                    'name' => 'Camion grue',
                    'description' => 'Gerbeur électrique avec levée initiale.',
                    'image' => 'assets/images/machine/grue2.png',
                    'additionnal_images' => [],
                    'price' => 80000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'PK14080',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '5T',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'RENAULT-PALFINGER',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '1996',
                        ],
                    ]
                ],
            ],
            'Équipements complémentaires' => [
                [
                    'name' => 'Auto-bétonnière',
                    'description' => 'Système motorisé pour transport de colis en ligne droite.',
                    'image' => 'assets/images/machine/auto-betonniere.png',
                    'additionnal_images' => [],
                    'price' => 300000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => '3500EE',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '50 m³/jour (8 heures)',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'DBM',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2023',
                        ],
                    ]
                ],
                [
                    'name' => 'Tour d’éclairage',
                    'description' => 'Convoyeur à bande pour lignes de production.',
                    'image' => 'assets/images/machine/tour.png',
                    'additionnal_images' => [],
                    'price' => 30000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'HILIGHT V4',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '50HZ, 6KVA',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'ATLAS COPCO',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2020',
                        ],
                    ]
                ],
                [
                    'name' => 'Groupe électrogène',
                    'description' => 'Convoyeur à bande pour lignes de production.',
                    'image' => 'assets/images/machine/groupe.png',
                    'additionnal_images' => [],
                    'price' => 100000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => 'DB80GF 80Kw',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '100KVA',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'VOLVO',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2022',
                        ],
                    ]
                ],
                [
                    'name' => 'Groupe électrogène',
                    'description' => 'Convoyeur à bande pour lignes de production.',
                    'image' => 'assets/images/machine/groupe2.png',
                    'additionnal_images' => [],
                    'price' => 80000,
                    'characteristics' => [
                        [
                            'label' => 'Modèle & Puissance',
                            'value' => '3305GM',
                        ],
                        [
                            'label' => 'Capacité',
                            'value' => '20KVA',
                        ],
                        [
                            'label' => 'Producteur',
                            'value' => 'POWEROL',
                        ],
                        [
                            'label' => 'Année de production',
                            'value' => '2023',
                        ],
                    ]
                ],
            ],
        ];

        foreach ($machines as $categoryName => $items) {
            $category = Category::where('name', $categoryName)->first();
            if (!$category) continue;

            foreach ($items as $item) {
                Machine::create([
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'image' => $item['image'],
                    'additionnal_images' => json_encode($item['additionnal_images']),
                    'price' => $item['price'],
                    'characteristics' => json_encode($item['characteristics']),
                ]);
            }
        }
    }
}
