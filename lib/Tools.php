<?php
    class Tools{
        
        public static function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
        {
            if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0)
                return FALSE;
            
            if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize)
                return FALSE;
            
            $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
            
            if ($extensions !== FALSE AND !in_array($ext,$extensions))
                return FALSE;
            
            return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
        }
        
    }
    ?>
