<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmpDir = 'tmp/';
        $imagesDir = 'images/';

        $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if ($extension !== 'jpg') {
            throw new Exception('Archivo erróneo. Solo se permiten archivos JPG.');
        }

        $tmpFile = $tmpDir . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $tmpFile);
        
        if (isset($_POST['confirm'])) {
            $destinationFile = $imagesDir . $_FILES['image']['name'];
            copy($tmpFile, $destinationFile);
            unlink($tmpFile);
            echo 'Archivo guardado correctamente.';
        }else{
            echo 'Archivo guardado en tmp correctamente.';
        }
    }else{
        throw new Exception('No se ha proporcionado ningún archivo o se ha producido un error en la carga.');
    }
}
?>