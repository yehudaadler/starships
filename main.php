<?php

require_once('ShipsFilter.php');
require_once('ApiProxy.php');
require_once('Utils.php');

$api = new ApiProxy();
$shipsFilter = new ShipsFilter();
$utils = new Utils();

$ships = $api->getShips();

$smallShips = $shipsFilter->getSmallShips($ships);
$utils->print_array('Small Ships', $smallShips, array('name', 'max_atmosphering_speed'));

$bigShips = $shipsFilter->getBigShips($ships);
$utils->print_array('Big Ships', $bigShips, array('name', 'passengers', 'cargo_capacity'));
