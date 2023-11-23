<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ol>
        <h1>Clientes Suscritos</h1>
        
        <?php foreach ($listaSuscritos as $client) : ?>
            <li>
            <?php echo $client['name'] ?>
            <?php echo "<br>" ?>
            </li>
            
        <?php endforeach; ?>
    </ol>
    <ol>
        <h1>Clientes NO Suscritos</h1>
        
        <?php foreach ($listaNoSuscritos as $client) : ?>
            <li>
            <?php echo $client['name'] ?>
            <?php echo "<br>" ?>
            </li>
            
        <?php endforeach; ?>
    </ol>

    <ul>
        <h1>Clientes al menos un pedido</h1>
        
        <?php foreach ($listaOrders as $client) : ?>
            <li>
            <?php echo $client['name'] ?>
            <?php echo "<br>" ?>
            <?php echo "Precio Total: " . $client['orders']['total']; ?>
            </li>
            
        <?php endforeach; ?>
    </ul>
    <ul>
        <h1>Clientes ordenados por gasto total</h1>
        
        <?php foreach ($listaPorPrecio as $client) : ?>
            <li>
            <?php echo $client['name'] ?>
            <?php echo "<br>" ?>
            <?php echo "Precio Total: " . $client['orders']['total']; ?>
            </li>
            
        <?php endforeach; ?>
    </ul>

    <ol>
    <h1>Clientes ordenados por gasto total</h1>
        <?php
        $sortedClients = $clients;
        usort($sortedClients, "sortPrice");
 
        foreach ($sortedClients as $client) : ?>
            <li>
                <?= $client["name"]; ?>: $<?= !empty($client["orders"]["total"]) ? $client["orders"]["total"] : 0; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</body>

</html>