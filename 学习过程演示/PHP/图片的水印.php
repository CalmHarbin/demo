<?php 
$dst_im=imagecreatefromjpeg("images/suning.jpg");
$src_im=imagecreatefromjpeg("images/logo.jpg");
$src_w=imagesx($src_im);
$src_h=imagesy($src_im);
imagecopy($dst_im, $src_im, 0, 0, 0, 0, $src_w, $src_h);
imagejpeg($dst_im,"images/t_suning.jpg");
 ?>
