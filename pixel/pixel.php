<?php
$in = $argv[1];
$img = imagecreatefrompng($in);
$x = imagesx($img)/4;
$y = imagesy($img)/4;
$new = imagecreatetruecolor($x, $y);
imagealphablending($new, false);
imagesavealpha($new, true);
// Extract image colors
for ($a = 0; $a < imagesy($img); $a+=4) {
    for ($b = 0; $b < imagesx($img); $b+=4) {
        $colors[] = imagecolorat($img, $b, $a);
    }
}

$row = 0;
$col = 0;
$a = 1;
foreach ($colors as $color) {
    $rgba = imagecolorsforindex($img, $color);
    $index = imagecolorallocatealpha($new, $rgba["red"], $rgba["green"], $rgba["blue"], $rgba["alpha"]);
    imagesetpixel($new, $col, $row, $index);
    $row = (floor($a/$x));
    $col = ($a-(($row)*$x));
    //echo "(" . $row . "|" . $col . ")";
    $a++;
    /*$old = $row;
    $row = (floor($a/$x)+1);
    $new = $row;
    $col = ($a-(($row-1)*$x)+1);
    if ($old != $new) {
        echo "\n";
    }*/
}
imagepng($new);
/*
// Set image colors for new
for ($a = 0; $a < $y; $a++) {
    for ($b = 0; $b < $x; $b++) {
        //echo $colors[($a*$b)+$b] . "\n";
    }
}
*/
?>
