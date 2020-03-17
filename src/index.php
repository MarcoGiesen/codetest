<?php

use Domain\Database;
use Domain\Order\Repository\OrderRepository;
use Domain\Order\Statistic;

require 'vendor/autoload.php';

// this would normally be placed in a registry / DI
$database = new Database();
$repo = new OrderRepository($database);
$orders = $repo->fetchAll();

$orderStatistic = new Statistic($orders);

$ordersByCurrency = $repo->fetchOrdersCountGroupedByCurrency();

?>

<html>
<head>

</head>
<body>
    <h3>Show order count and some payment status:</h3>
    <p>Current orders in system <?php echo \count($orders) ?></p>
    <p>Currently unpaid orders: <?php echo $orderStatistic->countUnpaid() ?></p>
    <p>Currently paid orders: <?php echo $orderStatistic->countPaid() ?></p>

    <h3>Currency usage accumulated by orders:</h3>
    <?php
    foreach ($ordersByCurrency as $item) {
        [$currency, $counter] = $item;

        echo sprintf('<p>Currency %s used in %d orders</p>', $currency, $counter);
    }
    ?>
</body>
</html>
