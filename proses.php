<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "service_ac");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari form
$nama    = $_POST['nama'];
$no_hp   = $_POST['no_hp'];
$layanan = $_POST['layanan'];
$tanggal = $_POST['tanggal'];
$jam     = $_POST['jam'];
$alamat  = $_POST['alamat'];

// Query simpan ke tabel booking
$sql = "INSERT INTO booking (nama, no_hp, layanan, tanggal, jam, alamat) 
        VALUES ('$nama','$no_hp','$layanan','$tanggal','$jam','$alamat')";

if ($koneksi->query($sql) === TRUE) {
    echo "<h2>✅ Booking berhasil disimpan!</h2>";
    echo "<a href='index.html'>Kembali ke Beranda</a>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
