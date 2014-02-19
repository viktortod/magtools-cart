<?php

    require_once '../include/magtools/init.php';

    $image_width = 600;
    $image_height = 300;

    # Makes a picture and sets size in pixels
    $image  = imagecreatetruecolor($image_width, $image_height);

    
    #Horizontal gradient
    for($i=0; $i<$image_height; $i++)
    {
        $color = floor($i * 255 / $image_height);
        $color = ImageColorAllocate($image, $color, $color, $color);
        imageline($image, 0, $i, $image_width, $i, $color);
    }

    # Prints out all the figures and picture and frees memory
    header('Content-type: image/png');
    ImagePNG($image);
    imagedestroy($image);
?>
