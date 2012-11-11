<?php
$im = imagecreatetruecolor(4200, 5400);
imagefill($im, 0, 0, 0xFFFFFF);
imageantialias($im, true);
//imageline ($im, 0, 1350, 2100, 1350, 0x000000);
//imageline ($im, 1050, 0, 1050, 2700, 0x000000);
for ($i=-50; $i<200; $i++)
{
    for ($x=-150; $x<2400; $x++)
    {

        $y = 6*cos($x/8)+15 + cos($x/2)-cos($x/4);
        $y2 = 6*cos(($x+1)/8)+15 + cos(($x+1)/2)-cos(($x+1)/4);

        $y += (50-$i)*4*cos(($x+abs($i-50))/(200))-1350;
        //$y2 += (50-$i)*2*cos(($x+abs($i-50))/(200));
        $y2 += (50-$i)*4*cos(($x+abs($i-50)+1)/(200))-1350;
        imageline($im, $x-156, $y+$i*54, $x-155, $y2+$i*54, 0x3c508b);

        $y = 3*cos($x/8)+4*cos($x/16)+1.5;
        $y2 = 3*cos(($x+1)/8)+4*cos(($x+1)/16)+1.5;
        $y += (50-$i)*4*cos(($x+abs($i-50))/(200))-1350;
        $y2 += (50-$i)*4*cos(($x+abs($i-50)+1)/(200))-1350;
        imageline($im, $x-156, $y+$i*54, $x-155, $y2+$i*54, 0x3c508b);
        //imageline($im, $x-150, $y+$i*27, $x-149, $y2+$i*27, 0x3c508b);

        $y = -6*cos($x/8)-15 - cos($x/2)+cos($x/4);
        $y2 = -6*cos(($x+1)/8)-15 - cos(($x+1)/2)+cos(($x+1)/4);

        $y += (50-$i)*4*cos(($x+abs($i-50))/(200))-1350;
        //$y2 += (50-$i)*2*cos(($x+abs($i-50))/(200));
        $y2 += (50-$i)*4*cos(($x+abs($i-50)+1)/(200))-1350;
        imageline($im, $x-156, $y+$i*54, $x-155, $y2+$i*54, 0x3c508b);

        $y = -3*cos($x/8)-4*cos($x/16)-1.5;
        $y2 = -3*cos(($x+1)/8)-4*cos(($x+1)/16)-1.5;
        $y += (50-$i)*4*cos(($x+abs($i-50))/(200))-1350;
        $y2 += (50-$i)*4*cos(($x+abs($i-50)+1)/(200))-1350;
        imageline($im, $x-156, $y+$i*54, $x-155, $y2+$i*54, 0x3c508b);
    }

}
//header('Content-Type: image/jpeg');
imagepng($im, 'image.png');
imagedestroy($im);