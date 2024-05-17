<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Output buffering aç
    ob_start();

    // İndirilecek dosyanın URL'si
    $url = 'https://wordpress.org/latest.zip';
    $zipFile = 'latest.zip';

    // Dosya indirme işlemi
    echo "Dosya indiriliyor: $url<br>";
    flush();
    ob_flush();
    sleep(2);

    $ch = curl_init($url);
    $fp = fopen($zipFile, 'w+');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);

    echo "Dosya indirildi: $zipFile<br>";
    flush();
    ob_flush();
    sleep(2);

    // Dosyayı çıkartma işlemi
    $zip = new ZipArchive;
    if ($zip->open($zipFile) === TRUE) {
        echo "Dosya çıkartılıyor: $zipFile<br>";
        flush();
        ob_flush();
        sleep(2);

        $zip->extractTo('./');
        $zip->close();

        echo "Dosya çıkartıldı: ./<br>";
        flush();
        ob_flush();
        sleep(2);
    } else {
        echo "Dosya açılamadı: $zipFile<br>";
        flush();
        ob_flush();
        sleep(2);
    }

    // ZIP dosyasını silme işlemi
    unlink($zipFile);
    echo "ZIP dosyası silindi: $zipFile<br>";
    flush();
    ob_flush();
    sleep(2);

    // Output buffering'i kapat
    ob_end_flush();
} else {
    echo "Bu sayfaya doğrudan erişim sağlanamaz. Lütfen formu kullanarak POST isteği gönderin.<br>";
}
