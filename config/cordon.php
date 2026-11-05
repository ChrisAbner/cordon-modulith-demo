<?php

// Only the settings this demo changes; the rest are Cordon's defaults.
// See https://chrisabner.github.io/Cordon-Modulith/guide/configuration
return [
    'modules' => [
        'Catalog' => ['depends_on' => []],
        'Orders' => ['depends_on' => ['Catalog']],
        'Shipping' => ['depends_on' => ['Orders']],
    ],
];
