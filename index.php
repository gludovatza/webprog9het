<?php 

echo "Hello world";
echo "Hello world3";

// https://webprogramozas.inf.elte.hu/#!/subjects/webprog-pti/gyak/09
// 4. feladat
$a = $_GET["a"] ?? null;
$b = $_GET["b"] ?? null;
$x = ($a != null && $b != null) ? -1 * $b / $a : '';

$errors = [];
if($a == null) 
  $errors[] = 'nem volt még megadva az a értéke.';
if($b == null) 
  $errors[] = 'nem volt még megadva a b értéke.';

?>
<ul>
  <?php foreach($errors as $error) : ?>
    <li><?= $error ?></li>
  <?php endforeach ?>
</ul>
<form action="" method="get">
  <fieldset>
    <label for="a">A értéke:</label>
    <input type="number" name="a" id="a" value="<?= $_GET["a"] ?? 1 ?>" min="1">
  </fieldset>
  <fieldset>
    <label for="b">B értéke:</label>
    <input type="number" name="b" id="b" value="<?= $_GET["b"] ?? 1 ?>" min="1">
  </fieldset>
  <button>Számolj!</button>
</form>
<?php if(count($errors) == 0) : ?>
  <div id="megoldas">x értéke: <?=$x ?></div>
<?php endif ?>