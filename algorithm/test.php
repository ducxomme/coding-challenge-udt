<?php
const NEEDED_CONTAINER = 3;

$listings = [
  [
    'name' => 'Container renter A',
    'container' => 1,
    'totalCost' => 1
  ],
  [
    'name' => 'Container renter B',
    'container' => 2,
    'totalCost' => 1
  ],
  [
    'name' => 'Container renter C',
    'container' => 3,
    'totalCost' => 3
  ]
];

function cmp($a, $b) {
    if ($a['totalCost'] == $b['totalCost'] ) {
        return 0;
    }
    return ($a['totalCost']  < $b['totalCost'] ) ? -1 : 1;
}

usort($listings, "cmp");

$containerCount = 0;
$totalCost = 0;

for ($i = 0; $i < count($listings); $i++) {
  $currentContainers = $listings[$i]['container'];

  if ($containerCount < NEEDED_CONTAINER && (NEEDED_CONTAINER - $currentContainers >= 0)) {
    $containerCount += $currentContainers;
    $totalCost += $listings[$i]['totalCost'];

    echo '[Contract with] ' . $listings[$i]['name'] . ' ' . $currentContainers . ' containers,' . ' price: ' . $listings[$i]['totalCost'] . "\n";
  }
}

if ($containerCount < NEEDED_CONTAINER) {
  echo "\nNot enough containers";
}

echo "\n[Summary] total cost " . $totalCost;
