### Задачи, выполненные мной во время обучения программированию.
1. **BuildRoad** — Построение маршрута между двумя городами в дереве.
    Пример:
```php
<?php

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

itinerary($tree, 'Dubna', 'Kostroma');
// ['Dubna', 'Tver', 'Moscow', 'Ivanovo', 'Kostroma']

itinerary($tree, 'Borisovka', 'Kurchatov');
// ['Borisovka', 'Belgorod', 'Kursk', 'Kurchatov']

2. **JSONStringify** — Реализация функции для приведения файла к строковому значению с возможностью задать отступ для ключа.
    Пример:
```php
<?php

stringify('hello'); // hello – значение приведено к строке, но не имеет кавычек
stringify(true);    // true
stringify(5);       // 5

$data = [
    'hello' => 'world',
    'is' => true,
    'nested' => ['count' => 5],
];

stringify($data); // то же самое что stringify(data, ' ', 1);
// {
//  hello: world
//  is: true
//  nested: {
//   count: 5
//  }
// }

stringify($data, '|-', 2);
// Символ, переданный вторым аргументом повторяется столько раз, сколько указано третьим аргументом.
// {
// |-|-hello: world
// |-|-is: true
// |-|-nested: {
// |-|-|-|-count: 5
// |-|-}
// }