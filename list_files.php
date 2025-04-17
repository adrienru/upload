<?php
function listFiles($dir) {
    if (!is_dir($dir)) {
        echo "<p>El directorio no existe.</p>";
        return;
    }

    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $filePath = $dir . '/' . $file;
            $fileExt = pathinfo($file, PATHINFO_EXTENSION);

            // Icono por defecto para archivos
            $icon = 'icons/archivo.png'; // Cambia esto a un icono por defecto si lo tienes

            // Asigna iconos según la extensión del archivo
            if (is_dir($filePath)) {
                $icon = 'icons/carpeta.png'; // Icono para carpetas
            } else {
                switch ($fileExt) {
                    case 'pdf':
                        $icon = 'icons/archivo-pdf.png';
                        break;
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                        $icon = 'icons/edicion-de-fotos.png';
                        break;
                    case 'mp3':
                    case 'wav':
                    case 'ogg':
                    case 'flac':
                        $icon = 'icons/spotify.png'; // Icono de música
                        break;
                    case 'mp4':
                    case 'mov':
                    case 'avi':
                    case 'mkv':
                        $icon = 'icons/youtube.png'; // Icono de video
                        break;
                    case 'xlsx':
                        $icon = 'icons/archivo-excel.png'; // Icono de Excel
                        break;
                    case 'zip':
                        $icon = 'icons/carpeta-zip.png'; // Icono de ZIP
                        break;
                    default:
                        $icon = 'icons/documento.png'; // Icono por defecto para documentos
                }
            }

            echo "<li><span class='icon'><img src='$icon' alt='$file' class='file-icon'></span><span class='file-name'>";

            if (is_dir($filePath)) {
                echo "<strong><a href='?dir=" . urlencode($filePath) . "'>$file</a></strong>";
            } else {
                echo "<a href='$filePath' target='_blank'>$file</a>";
            }
            echo "</span>";

            if (!is_dir($filePath)) {
                echo "<a href='$filePath' download class='download-button'>Descargar</a>";
                echo "<a href='rename.php?file=" . urlencode($filePath) . "' class='rename-button'>Renombrar</a>";
                echo "<a href='delete.php?file=" . urlencode($filePath) . "' class='delete-button'>Eliminar</a>";
            }

            echo "</li>";
        }
    }
}

$currentDir = isset($_GET['dir']) ? $_GET['dir'] : 'uploads';
echo "<h3>Navegando en: $currentDir</h3>";
listFiles($currentDir);
?>
