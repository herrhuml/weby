<?php
Class FileUpload{
    function thumbnail( $img, $source, $dest, $maxw, $maxh ) {
        $jpg = $source.$img;
    
        if( $jpg ) {
            list( $width, $height  ) = getimagesize( $jpg );
            $source = imagecreatefromjpeg( $jpg );
    
            if( $maxw >= $width && $maxh >= $height ) {
                $ratio = 1;
            }elseif( $width > $height ) {
                $ratio = $maxw / $width;
            }else {
                $ratio = $maxh / $height;
            }
    
            $thumb_width = round( $width * $ratio );
            $thumb_height = round( $height * $ratio );
    
            $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
            imagecopyresampled( $thumb, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height );
    
            $path = $dest.$img;
            imagejpeg( $thumb, $path, 75 );
        }
        imagedestroy( $thumb );
        imagedestroy( $source );
    }
}
