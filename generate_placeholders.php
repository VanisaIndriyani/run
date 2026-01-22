<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

function createPdf($filename, $title, $content) {
    $dompdf = new Dompdf();
    $html = "
    <html>
    <head>
        <style>
            body { font-family: sans-serif; text-align: center; padding-top: 50px; }
            h1 { color: #003366; }
            p { color: #555; font-size: 18px; }
            .placeholder { border: 2px dashed #ccc; padding: 40px; margin: 20px; }
        </style>
    </head>
    <body>
        <div class='placeholder'>
            <h1>$title</h1>
            <p>$content</p>
            <p><em>(Ini adalah fail placeholder. Sila muat naik fail sebenar.)</em></p>
        </div>
    </body>
    </html>";
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    $output = $dompdf->output();
    file_put_contents("documents/$filename", $output);
    echo "Created $filename<br>";
}

// Create documents directory if not exists
if (!is_dir('documents')) {
    mkdir('documents');
}

createPdf("surat_kebenaran.pdf", "Surat Kebenaran Ibu Bapa", "Borang kebenaran ini perlu diisi oleh ibu bapa atau penjaga peserta bawah umur.");
createPdf("surat_jemputan.pdf", "Surat Jemputan Sekolah", "Surat jemputan rasmi kepada sekolah-sekolah untuk menyertai larian.");
createPdf("syarat_peraturan.pdf", "Syarat & Peraturan", "Senarai lengkap syarat penyertaan dan peraturan keselamatan.");
createPdf("buku_program.pdf", "Buku Program", "Buku program digital mengandungi tentatif dan info larian.");

echo "All placeholders created successfully.";
?>