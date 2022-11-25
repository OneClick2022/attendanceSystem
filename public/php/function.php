<?php

if(isset($_FILES["webcam"]["tmp_name"])){
    $tmpName = $_FILES["webcam"]["tmp_name"];
    $imageName = date("Y.m.d") . "-" . date("h.i.sa") . ' .jpeg';
    move_uploaded_file($tmpName, '../cameraimg/' . $imageName);
}
