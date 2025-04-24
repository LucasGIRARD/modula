<?php
if ($_POST['action'] == "upload") {
    $file = $_FILES["photo"];

    if ($file['error'] == 0) {

        $tmp_file = $file['tmp_name'];


        if (!is_uploaded_file($tmp_file)) {
            $message = "une erreur lors de l'upload du fichier " . $fileName . " s'est produit.";
        } else {

            //$allowedExtensions = array("jpg", "jpeg", "gif", "png", "bmp");
			$allowedExtensions = array("jpg");
            $couper = explode(".", strtolower($file['name']));
            $extension = end($couper);

            if (!preg_match('/image/i', $file['type']) && !in_array($extension, $allowedExtensions)) {
                $message = "n'est pas reconnu comme une image!";
            } else {


                $fileName = "0." . $extension;
                $uploaddir = "temp";  // dossier ou sera déplacé la photo
                $path = $uploaddir . "/" . $fileName;

                if (!move_uploaded_file($tmp_file, $path)) {
                    $message = "Impossible de copier la photo dans $uploaddir";
                } else {
                    $message = "Le fichier " . $fileName . "  a bien été uploadé";

                    $photo[0] = $fileName;
                }
            }
        }
    } else {
        $messageErreurPHP = array("",
            "Le fichier téléchargé excède la taille authorisé par le serveur. <!--(php.ini => upload_max_filesize) -->",
            "Le fichier téléchargé excède la taille authorisé par le formulaire. <!--(HTML => MAX_FILE_SIZE) -->",
            "Le fichier n'a été que partiellement téléchargé. <!-- (max_execution_time) -->",
            "Aucun fichier n'a été téléchargé.",
            "",
            "Le fichier n'a pas été téléchargé. <!--(serveur => dossier temporaire) -->",
            "Le fichier n'a pas été téléchargé. <!--(serveur => droit d'écriture) -->",
            "Le fichier n'a pas été téléchargé. <!--(serveur => extension PHP -->");
        $message = $messageErreurPHP[$file['error']];
    }
    session_start();
    $_SESSION['photoTemp'] = $photo;
    $i = 0;
}
if ($_POST['action'] == "resize") {
    $i = $_POST['compteur'];
    session_start();
    $photo = $_SESSION['photoTemp'];
    $tempImage = "temp/" . $photo[$i];
    $imageD = "resultat/" . $photo[$i];
    
    $angle = $_POST['angle'];
    $difH = 0;
    $difW = 0;


    $split = explode('.', $tempImage);
    $ext = end($split);

    $function = returnCorrectFunction($ext);
    $image = $function($tempImage);


    list($imageBaseWidth, $imageBaseHeight) = getimagesize($tempImage);

    $ratioW = $imageBaseWidth / 100;
    $ratioH = $imageBaseHeight / 100;
    if ($ratioH > $ratioW) {
        $ratio = $ratioH;
    } else {
        $ratio = $ratioW;
    }
    $blackTop = $_POST['blackTop'] * $ratio;
    $blackBottom = $_POST['blackBottom'] * $ratio;
    $blackLeft = $_POST['blackLeft'] * $ratio;
    $blackRight = $_POST['blackRight'] * $ratio;

    $tempModifWidth = $_POST["imageNewWidth"];
    $tempModifHeight = $_POST["imageNewHeight"];
    $modifWidth = $tempModifWidth * $ratio;
    $modifHeight = $tempModifHeight * $ratio;

    if ($modifHeight > $modifWidth) {
        $newHeight = $modifHeight;
        $newWidth = $modifHeight;
    } else {
        $newHeight = $modifWidth;
        $newWidth = $modifWidth;
    }

    if ($angle != 0 && $angle != 360) {
        $x1 = imagesx($image);
        $y1 = imagesy($image);
        $white = imageColorAllocate($image, 255, 255, 255);
        $image = imagerotate($image, $angle, $white);
        $x2 = imagesx($image);
        $y2 = imagesy($image);
        if ($modifHeight < $x2) {
            $difH = ($x2 - $x1) / 2;
        } else {
            $imageBaseHeight = $x2;
        }
        if ($modifWidth < $y2) {
            $difW = ($y2 - $y1) / 2;
        } else {

            $imageBaseWidth = $y2;
        }
    }

    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    imageantialias($newImage, true);

    $bg = imagecolorallocate($newImage, 255, 255, 255);
    imagefill($newImage, 0, 0, $bg);


    if ($blackTop > 0) {
        $src_x = $blackTop + $difH;
    } else {
        $src_x = 0 + $difH;
    }

    if ($blackLeft > 0) {
        $src_y = $blackLeft + $difW;
    } else {
        $src_y = 0 + $difW;
    }
    if ($blackTop > 0 || $blackBottom > 0) {
        $src_h = $modifHeight;
    } else {
        $src_h = $imageBaseWidth;
    }
    if ($blackLeft > 0 || $blackRight > 0) {
        $src_w = $modifWidth;
    } else {
        $src_w = $imageBaseWidth;
    }



    $dst_x = ($newHeight / 2) - ($src_h / 2);
    $dst_y = ($newWidth / 2) - ($src_w / 2);
    $dst_h = $src_h;
    $dst_w = $src_w;



    imagecopyresampled($newImage, $image, $dst_y, $dst_x, $src_y, $src_x, $dst_w, $dst_h, $src_w, $src_h);

    $xr = 0;
    $yr = 0;
    $src_hr = $newHeight;
    $src_wr = $newWidth;
    $dst_hwr1 = 500;
    $dst_hwr2 = 100;

    $dst_imager1 = imagecreatetruecolor($dst_hwr1, $dst_hwr1);
    
    imageantialias($dst_imager1, true);
    
    imagecopyresized($dst_imager1, $newImage, $xr, $yr, $xr, $yr, $dst_hwr1, $dst_hwr1, $src_wr, $src_hr);
    


    imagejpeg($dst_imager1, $imageD, 100);
    

    imagedestroy($image);
    $i++;
	echo '<meta http-equiv="refresh" content="1; URL=view.php">';
}

function returnCorrectFunction($ext) {
    $function = "";
    switch ($ext) {
        case "png":
            $function = "imagecreatefrompng";
            break;
        case "jpeg":
            $function = "imagecreatefromjpeg";
            break;
        case "jpg":
            $function = "imagecreatefromjpeg";
            break;
        case "gif":
            $function = "imagecreatefromgif";
            break;
        case "bmp":
            $function = "imagecreatefrombmp";
            break;
    }
    return $function;
}

function imagecreatefrombmp($filename) {
    //Ouverture du fichier en mode binaire
    if (!$f1 = fopen($filename, "rb"))
        return FALSE;

    //1 : Chargement des ent?tes FICHIER
    $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1, 14));
    if ($FILE['file_type'] != 19778)
        return FALSE;

    //2 : Chargement des ent?tes BMP
    $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel' .
                    '/Vcompression/Vsize_bitmap/Vhoriz_resolution' .
                    '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1, 40));
    $BMP['colors'] = pow(2, $BMP['bits_per_pixel']);
    if ($BMP['size_bitmap'] == 0)
        $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
    $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel'] / 8;
    $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
    $BMP['decal'] = ($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
    $BMP['decal'] -= floor($BMP['width'] * $BMP['bytes_per_pixel'] / 4);
    $BMP['decal'] = 4 - (4 * $BMP['decal']);
    if ($BMP['decal'] == 4)
        $BMP['decal'] = 0;

    //3 : Chargement des couleurs de la palette
    $PALETTE = array();
    if ($BMP['colors'] < 16777216) {
        $PALETTE = unpack('V' . $BMP['colors'], fread($f1, $BMP['colors'] * 4));
    }

    //4 : Cr?ation de l'image
    $IMG = fread($f1, $BMP['size_bitmap']);
    $VIDE = chr(0);

    $res = imagecreatetruecolor($BMP['width'], $BMP['height']);
    $P = 0;
    $Y = $BMP['height'] - 1;
    while ($Y >= 0) {
        $X = 0;
        while ($X < $BMP['width']) {
            if ($BMP['bits_per_pixel'] == 24)
                $COLOR = unpack("V", substr($IMG, $P, 3) . $VIDE);
            elseif ($BMP['bits_per_pixel'] == 16) {
                $COLOR = unpack("n", substr($IMG, $P, 2));
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            } elseif ($BMP['bits_per_pixel'] == 8) {
                $COLOR = unpack("n", $VIDE . substr($IMG, $P, 1));
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            } elseif ($BMP['bits_per_pixel'] == 4) {
                $COLOR = unpack("n", $VIDE . substr($IMG, floor($P), 1));
                if (($P * 2) % 2 == 0)
                    $COLOR[1] = ($COLOR[1] >> 4); else
                    $COLOR[1] = ($COLOR[1] & 0x0F);
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            }
            elseif ($BMP['bits_per_pixel'] == 1) {
                $COLOR = unpack("n", $VIDE . substr($IMG, floor($P), 1));
                if (($P * 8) % 8 == 0)
                    $COLOR[1] = $COLOR[1] >> 7;
                elseif (($P * 8) % 8 == 1)
                    $COLOR[1] = ($COLOR[1] & 0x40) >> 6;
                elseif (($P * 8) % 8 == 2)
                    $COLOR[1] = ($COLOR[1] & 0x20) >> 5;
                elseif (($P * 8) % 8 == 3)
                    $COLOR[1] = ($COLOR[1] & 0x10) >> 4;
                elseif (($P * 8) % 8 == 4)
                    $COLOR[1] = ($COLOR[1] & 0x8) >> 3;
                elseif (($P * 8) % 8 == 5)
                    $COLOR[1] = ($COLOR[1] & 0x4) >> 2;
                elseif (($P * 8) % 8 == 6)
                    $COLOR[1] = ($COLOR[1] & 0x2) >> 1;
                elseif (($P * 8) % 8 == 7)
                    $COLOR[1] = ($COLOR[1] & 0x1);
                $COLOR[1] = $PALETTE[$COLOR[1] + 1];
            }
            else
                return FALSE;
            imagesetpixel($res, $X, $Y, $COLOR[1]);
            $X++;
            $P += $BMP['bytes_per_pixel'];
        }
        $Y--;
        $P+=$BMP['decal'];
    }

    //Fermeture du fichier
    fclose($f1);

    return $res;
}

if (!isset($photo[$i])) {
    echo '<meta http-equiv="refresh" content="3; URL=index.php">';
} else {

?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <title></title>
            <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
            <script type="text/javascript" src="jQueryRotate.js"></script>
            <script type="text/javascript">
                var angle = 0;
                var Image
                var unit = 1;
                var heightImage
                var widthImage

                var newHeightImage
                var newWidthImage

                var blackTop
                var blackBottom
                var blackLeft
                var blackRight

                var blackTopHeight
                var blackBottomHeight
                var blackLeftWidth
                var blackRightWidth

                function load(){
                    Image = document.getElementById('photo');
                    heightImage = parseInt(Image.height, 10);
                    widthImage = parseInt(Image.width, 10);


                    document.getElementById('body').style.width = widthImage+"px";

                    blackTop = document.getElementById('blackTop').style;
                    blackBottom = document.getElementById('blackBottom').style;
                    blackLeft = document.getElementById('blackLeft').style;
                    blackRight = document.getElementById('blackRight').style;

                    blackTop.width = widthImage+"px";

                    blackBottom.top = heightImage+"px";
                    blackBottom.width = widthImage+"px";

                    blackLeft.height = heightImage+2+"px";

                    blackRight.height = heightImage+2+"px";
                    blackRight.left = widthImage+"px";


                    blackLeftWidth = parseInt(blackLeft.width, 10)-1;
                    blackRightWidth = parseInt(blackRight.width, 10)-1;
                    blackTopHeight = parseInt(blackTop.height, 10)-1;
                    blackBottomHeight = parseInt(blackBottom.height, 10)-1;


                    heightValue();
                    widthValue();
                    angleValue();
                }
                function changeUnit() {
                    unit = parseInt(document.getElementById('unit').value, 10);
                }

                function heightValue() {
                    newHeightImage = heightImage - blackTopHeight - blackBottomHeight;
                    document.getElementById('heightValue').innerHTML = newHeightImage;
                }
                function widthValue() {
                    newWidthImage = widthImage - blackLeftWidth - blackRightWidth;
                    document.getElementById('widthValue').innerHTML = newWidthImage;
                }
                function angleValue() {
                    document.getElementById('angleValue').innerHTML = angle;
                }

                function heightTopMore() {
                    if (blackTopHeight >= 0){
                        blackTop.height = parseInt(blackTop.height, 10)+unit +"px";
                        blackTopHeight = parseInt(blackTop.height, 10)-1;
                    }
                    else if(blackTopHeight < 0){
                        blackTop.top = parseInt(blackTop.top, 10)+unit +"px";
                        blackLeft.top = parseInt(blackLeft.top, 10)+unit +"px";
                        blackLeft.height = parseInt(blackLeft.height, 10)-unit +"px";
                        blackRight.top = parseInt(blackRight.top, 10)+unit +"px";
                        blackRight.height = parseInt(blackRight.height, 10)-unit +"px";
                        blackTopHeight = parseInt(blackTop.height, 10)-1+parseInt(blackTop.top, 10)+1;
                    }
                    heightValue();
                }
                function heightTopLess() {
                    if (blackTopHeight > 0){
                        blackTop.height = parseInt(blackTop.height, 10)-unit +"px";
                        blackTopHeight = parseInt(blackTop.height, 10)-1;
                    }
                    else if(blackTopHeight <= 0){
                        blackTop.top = parseInt(blackTop.top, 10)-unit +"px";
                        blackLeft.top = parseInt(blackLeft.top, 10)-unit +"px";
                        blackLeft.height = parseInt(blackLeft.height, 10)+unit +"px";
                        blackRight.top = parseInt(blackRight.top, 10)-unit +"px";
                        blackRight.height = parseInt(blackRight.height, 10)+unit +"px";
                        blackTopHeight = parseInt(blackTop.height, 10)-1+parseInt(blackTop.top, 10)+1;
                    }
                    heightValue();
                }

                function heightBottomMore() {
                    if (blackBottomHeight >= 0){
                        blackBottom.height = parseInt(blackBottom.height, 10)+unit +"px";
                        blackBottom.top = parseInt(blackBottom.top, 10)-unit +"px";
                        blackBottomHeight = parseInt(blackBottom.height, 10)-1;
                    }
                    else if(blackBottomHeight < 0){
                        blackBottom.top = parseInt(blackBottom.top, 10)-unit +"px";
                        blackLeft.height = parseInt(blackLeft.height, 10)-unit +"px";
                        blackRight.height = parseInt(blackRight.height, 10)-unit +"px";
                        blackBottomHeight = parseInt(blackBottom.height, 10)-1-(parseInt(blackBottom.top, 10) - heightImage);
                    }
                    heightValue();
                }
                function heightBottomLess() {
                    if (blackBottomHeight > 0){
                        blackBottom.height = parseInt(blackBottom.height, 10)-unit +"px";
                        blackBottom.top = parseInt(blackBottom.top, 10)+unit +"px";
                        blackBottomHeight = parseInt(blackBottom.height, 10)-1;
                    }
                    else if(blackBottomHeight <= 0){
                        blackBottom.top = parseInt(blackBottom.top, 10)+unit +"px";
                        blackLeft.height = parseInt(blackLeft.height, 10)+unit +"px";
                        blackRight.height = parseInt(blackRight.height, 10)+unit +"px";
                        blackBottomHeight = parseInt(blackBottom.height, 10)-1-(parseInt(blackBottom.top, 10) - heightImage);
                    }
                    heightValue();
                }

                function widthLeftMore() {
                    if (blackLeftWidth >= 0){
                        blackLeft.width = parseInt(blackLeft.width, 10)+unit +"px";
                        blackLeftWidth = parseInt(blackLeft.width, 10)-1;
                    }
                    else if(blackLeftWidth < 0){
                        blackLeft.left = parseInt(blackLeft.left, 10)+unit +"px";
                        blackTop.left = parseInt(blackTop.left, 10)+unit +"px";
                        blackTop.width = parseInt(blackTop.width, 10)-unit +"px";
                        blackBottom.left = parseInt(blackBottom.left, 10)+unit +"px";
                        blackBottom.width = parseInt(blackBottom.width, 10)-unit +"px";
                        blackLeftWidth = (parseInt(blackLeft.width, 10)-1)+(parseInt(blackLeft.left, 10)+1);
                    }
                    widthValue();
                }
                function widthLeftLess() {
                    if (blackLeftWidth > 0){
                        blackLeft.width = parseInt(blackLeft.width, 10)-unit +"px";
                        blackLeftWidth = parseInt(blackLeft.width, 10)-1;
                    }
                    else if(blackLeftWidth <= 0){
                        blackLeft.left = parseInt(blackLeft.left, 10)-unit +"px";
                        blackTop.left = parseInt(blackTop.left, 10)-unit +"px";
                        blackTop.width = parseInt(blackTop.width, 10)+unit +"px";
                        blackBottom.left = parseInt(blackBottom.left, 10)-unit +"px";
                        blackBottom.width = parseInt(blackBottom.width, 10)+unit +"px";
                        blackLeftWidth = parseInt(blackLeft.width, 10)-1+parseInt(blackLeft.left, 10)+1;
                    }
                    widthValue();
                }

                function widthRightMore() {
                    if (blackRightWidth >= 0){
                        blackRight.width = parseInt(blackRight.width, 10)+unit +"px";
                        blackRight.left = parseInt(blackRight.left, 10)-unit +"px";
                        blackRightWidth = parseInt(blackRight.width, 10)-1;
                    }
                    else if(blackRightWidth < 0){
                        blackRight.left = parseInt(blackRight.left, 10)-unit +"px";
                        blackTop.width = parseInt(blackTop.width, 10)-unit +"px";
                        blackBottom.width = parseInt(blackBottom.width, 10)-unit +"px";
                        blackRightWidth = parseInt(blackRight.width, 10)-1-(parseInt(blackRight.left, 10) - widthImage);
                    }
                    widthValue();
                }
                function widthRightLess() {
                    if (blackRightWidth > 0){
                        blackRight.width = parseInt(blackRight.width, 10)-unit +"px";
                        blackRight.left = parseInt(blackRight.left, 10)+unit +"px";
                        blackRightWidth = parseInt(blackRight.width, 10)-1;
                    }
                    else if(blackRightWidth <= 0){
                        blackRight.left = parseInt(blackRight.left, 10)+unit +"px";
                        blackTop.width = parseInt(blackTop.width, 10)+unit +"px";
                        blackBottom.width = parseInt(blackBottom.width, 10)+unit +"px";
                        blackRightWidth = parseInt(blackRight.width, 10)-1-(parseInt(blackRight.left, 10) - widthImage);
                    }
                    widthValue();
                }

                function turnMore() {
                    angle = angle + unit ;
                    $('#photo').rotate(angle);
                    angleValue();
                }
                function turnLess() {
                    angle = angle - unit ;
                    $('#photo').rotate(angle);
                    angleValue();
                }
                function loadingValues() {
                    document.hidden.imageNewWidth.value = newWidthImage;
                    document.hidden.imageNewHeight.value = newHeightImage;
                    document.hidden.blackTop.value = blackTopHeight;
                    document.hidden.blackBottom.value = blackBottomHeight;
                    document.hidden.blackRight.value = blackRightWidth;
                    document.hidden.blackLeft.value = blackLeftWidth;
                    document.hidden.angle.value = -angle;
                    document.hidden.photo.value = photo;
                }
            </script>
        </head>
        <body onload="load();">
            <center>
                <div style="padding-top:70px">
                    <div id="body" style="position:relative;width:10px">
                        <div id="blackTop" style="height:1px;width:0px;top:-1px;left:0px;background-color:black;position:absolute;z-index:10;"></div>
                        <div id="blackBottom" style="height:1px;width:0px;top:-1px;left:0px;background-color:black;position:absolute;z-index:10;"></div>
                        <div id="blackLeft" style="height:0px;width:1px;top:-1px;left:-1px;background-color:black;position:absolute;z-index:10;"></div>
                        <div id="blackRight" style="height:0px;width:1px;top:-1px;left:0px;background-color:black;position:absolute;z-index:10;"></div>
                    </div>
                    <div style="height:140px;">
                        <img id="photo" style="max-height:100px;max-width:100px;" alt="" src="temp/<?php echo $photo[$i] ?>" />
                    </div>

                    <table>
                        <tr>
                            <td><b>Width:</b></td>
                            <td><span id="widthValue"></span></td>
                        </tr>
                        <tr>
                            <td><b>Height:</b></td>
                            <td><span id="heightValue"></span></td>
                        </tr>
                        <tr>
                            <td><b>Angle:</b></td>
                            <td><span id="angleValue"></span>°</td>
                        </tr>
                    </table>
                    unité :<input size="2" value="1" id="unit" onblur="changeUnit();" />
                    <br />
                    haut : <button onclick="heightTopMore();">+</button><button onclick="heightTopLess();">-</button>
                    <br />
                    bas : <button onclick="heightBottomMore();">+</button><button onclick="heightBottomLess();">-</button>
                    <br />
                    gauche : <button onclick="widthLeftMore();">+</button><button onclick="widthLeftLess();">-</button>
                    <br />
                    droite : <button onclick="widthRightMore();">+</button><button onclick="widthRightLess();">-</button>
                    <br />
                    pivoter : <button onclick="turnMore();">+</button><button onclick="turnLess();">-</button>
                </div>
                <div>
                    <form name="hidden" action="fonction.php" method="POST">
                        <input type='hidden' name='imageNewWidth' value="" />
                        <input type='hidden' name='imageNewHeight' value="" />
                        <input type='hidden' name='blackTop' value="" />
                        <input type='hidden' name='blackBottom' value="" />
                        <input type='hidden' name='blackLeft' value="" />
                        <input type='hidden' name='blackRight' value="" />
                        <input type='hidden' name='angle' value="" />
                        <input type='hidden' name='action' value="resize" />
                        <input type='hidden' name='compteur' value="<?php echo $i; ?>" />
                        <input type="submit" onmouseover="loadingValues();" value="valider" />
                    </form>
                </div>
            </center>
        </body>
    </html>
<?php
}
?>