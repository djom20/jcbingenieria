<?php
    if (!isset($_GET['f']) || empty($_GET['f'])) { exit(); }

    $root = "reportes/";
    $file = basename($_GET['f']);
    $path = $root.$file;
    $type = '';

    if(is_file($path)) {
        $extensiones = array("pdf");
        if(strpos($file,"/")!==false){ die("No puedes navegar por otros directorios"); }

        $ftmp = explode(".",$file);
        $fExt = strtolower($ftmp[count($ftmp)-1]);
        if(!in_array($fExt,$extensiones)){ die("<b>ERROR!</b> no es posible descargar archivos con la extensión $fExt"); }

        $size = filesize($path);
        if (function_exists('mime_content_type')){
            $type = mime_content_type($path);
        }elseif(function_exists('finfo_file')){
            $info = finfo_open(FILEINFO_MIME);
            $type = finfo_file($info, $path);
            finfo_close($info);
        }

        if($type==''){ $type = "application/force-download"; }

        // Definir headers
        header("Content-Type: $type");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . $size);

        // Descargar archivo
        readfile($path);
    }else{ die("El archivo no existe."); }
?>