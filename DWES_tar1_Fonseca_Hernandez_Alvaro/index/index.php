<?php

$clients = [
    [
        'name' => 'Brandon Sanderson',
        'orders' => [
                'name' => 'Iphone 15 Pro Max, Airpods pro',
                'total' => 2054.99
        ],
        'suscriptions' => true
    ],
    [
        'name' => 'Robert Jordan',
        'orders' => [],
        'suscriptions' => false
    ],
    [
        'name' => 'George R.R. Martin',
        'orders' => [
                'name' => 'Iphone 15 Pro Max, Kindle ',
                'total' => 1300.5
        ],
        'suscriptions' => true
    ],
    [
        'name' => 'R.F. Kuang',
        'orders' => [
                'name' => 'Iphone 15 Pro Max',
                'total' => 1400.5   
        ],
        'suscriptions' => true
    ],
    [
        'name' => 'J.K. Rowling',
        'orders' => [],
        'suscriptions' => false
    ]
];

$listaSuscritos = array_filter($clients, function ($client) {
    return $client['suscriptions'];
});
$listaNoSuscritos = array_filter($clients, function ($client) {
    return $client['suscriptions'] === false;
});

$listaOrders = array_filter($clients, function ($client) {
    return count($client['orders']) >= 1;
});

$listaPorPrecio = usort($clients, function($a, $b) {
    return $b['orders']['total'] <=> $a['orders']['total'];
});

function sortPrice($a, $b)
{
    $totalPriceA = !empty($a["orders"]["total"]) ? $a["orders"]["total"] : 0;
    $totalPriceB = !empty($b["orders"]["total"]) ? $b["orders"]["total"] : 0;
 
    if ($totalPriceA == $totalPriceB) {
        return 0;
    }
    return ($totalPriceA > $totalPriceB) ? -1 : 1;
}

require "index.view.php"
?>
