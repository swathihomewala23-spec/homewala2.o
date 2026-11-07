<?php
$img = imagecreate(600, 400);
imagecolorallocate($img, 204, 204, 204);
$textColor = imagecolorallocate($img, 0, 0, 0);
imagestring($img, 5, 250, 190, 'No Image', $textColor);
imagejpeg($img, 'public/assets/img/noimage.jpg');
imagedestroy($img);
echo "Created noimage.jpg\n";
