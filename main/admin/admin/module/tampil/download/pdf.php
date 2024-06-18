<?php
// Check if PDF file parameter is set
if(isset($_GET['pdf'])) {
    $pdfFile = $_GET['pdf'];
    $filePath = 'pdf/' . $pdfFile;

    // Check if the file exists
    if(file_exists($filePath)) {
        // Set headers for force download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and output it to the browser
        readfile($filePath);
        exit;
    } else {
        // File not found
        echo 'File not found.';
    }
} else {
    // PDF file parameter not set
    echo 'PDF file not specified.';
}
?>
