<?php
    $directory = 'images/';
    $scanned_directory = array_diff(scandir($directory), array('..', '.'));
    $a = 0;
    $n = 1;
    foreach ($scanned_directory as $i) {
        if($a==5){
            echo('<div class="break"></div>');
            $a=0;
        }
        echo('<a class="flex-a" href="images/'.$i.'" data-lightbox="Images"><img class="flex-child" width="250px" height="250px" src="images/'.$i.'" alt="'.$i.'"></a>');
        //echo('<img class="flex-child" data-lightbox="images" src="images/'.$i.'" alt="'.$i.'">');
        $a++;$n++;
    }
?>