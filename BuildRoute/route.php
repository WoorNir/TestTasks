<?php

namespace route\Php;
function makeConnections($tree, $acc, $parent)
{
    $leaf = $tree[0];
    $children = $tree[1] ?? null;

    if (!$children) {
        $acc[$leaf] = [$parent];
        return $acc;
    }

    $neighbors = array_map(fn($child) => $child[0], $children);
    $neighbors[] = $parent;
    
    $newAcc = array_merge($acc, [$leaf => $neighbors]);
    return array_reduce($children, fn($finalAcc, $child) => makeConnections($child, $finalAcc, $leaf), $newAcc);
}

function makeRoute($connections, $start, $finish)
{
    var_dump($connections);
    $iter = function ($current, $route) use (&$iter, $finish, $connections) {
        $currentRoute = array_merge($route, [$current]);
        if ($current === $finish) {
            return $currentRoute;
        }

        $neighbors = $connections[$current] ?? [];
        $filteredNeighbors = array_filter($neighbors, fn($neighbor) => !in_array($neighbor, $currentRoute));

        echo "Current: $current, Route: " . implode(' -> ', $currentRoute) . "\n";

        return array_reduce(
            $filteredNeighbors,
            fn($acc, $neighbor) => array_merge($acc, $iter($neighbor, $currentRoute)), 
            []);
    };
    return $iter($start, []);
}

function itinerary($tree, $start, $finish)
{
    $connections = makeConnections($tree, [], '');
    return makeRoute($connections, $start, $finish);
}