<?php
if(isset($_GET['pdf'])) {
    $pdfFile = $_GET['pdf'];
    $filePath = 'admin/module/tampil/pdf/' . $pdfFile;

    if(file_exists($filePath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        readfile($filePath);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'PDF file not specified.';
}
?>
