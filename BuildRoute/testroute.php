<?php

require_once './route.php';

use PHPUnit\Framework\TestCase;
use function route\Php\itinerary;

class testroute extends TestCase
{
    public function testItinerary()
    {
        $tree = ['Moscow', [
          ['Smolensk'],
          ['Yaroslavl'],
          ['Voronezh', [
            ['Liski'],
            ['Boguchar'],
            ['Kursk', [
              ['Belgorod', [
                ['Borisovka'],
              ]],
              ['Kurchatov'],
            ]],
          ]],
          ['Ivanovo', [
            ['Kostroma'], ['Kineshma'],
          ]],
          ['Vladimir'],
          ['Tver', [
            ['Klin'], ['Dubna'], ['Rzhev'],
          ]],
        ]];

        $route1 = ['Dubna', 'Tver', 'Moscow', 'Ivanovo', 'Kostroma'];
        $route2 = ['Borisovka', 'Belgorod', 'Kursk', 'Kurchatov'];
        $route3 = ['Rzhev', 'Tver', 'Moscow'];
        $route4 = ['Ivanovo', 'Moscow', 'Voronezh', 'Kursk'];
        $route5 = ['Rzhev', 'Tver', 'Moscow', 'Voronezh', 'Kursk', 'Belgorod', 'Borisovka'];
        $route6 = ['Tver', 'Dubna'];

        $this->assertEquals($route1, itinerary($tree, 'Dubna', 'Kostroma'));
        $this->assertEquals($route2, itinerary($tree, 'Borisovka', 'Kurchatov'));
        $this->assertEquals($route3, itinerary($tree, 'Rzhev', 'Moscow'));
        $this->assertEquals($route4, itinerary($tree, 'Ivanovo', 'Kursk'));
        $this->assertEquals($route5, itinerary($tree, 'Rzhev', 'Borisovka'));
        $this->assertEquals($route6, itinerary($tree, 'Tver', 'Dubna'));
    }
}
