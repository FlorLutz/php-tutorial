<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <h1>Hello World!</h1>
    <p>Hallo, das ist ein Paragraph.</p>
    <p>Das hier wird mein erstes PHP-Projekt.</p>

    <?php
    $name = 'Florian';
    echo '<p>Mein Name ist ' . $name . '.</p>';

    $zahl1 = 7;
    $zahl2 = 8;

    echo '<p>7 * 8 = ' . $zahl1 * $zahl2 . '.</p>';
    ?>
  </body>
</html>