<?php
$koneksi = new mysqli("localhost", "root", "", "service_ac");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$id = intval($_GET['id']);
$data = $koneksi->query("SELECT * FROM booking WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $layanan = $_POST['layanan'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $alamat = $_POST['alamat'];
    $catatan = $_POST['catatan'];

    $sql = "UPDATE booking SET 
        nama='$nama',
        no_hp='$no_hp',
        layanan='$layanan',
        tanggal='$tanggal',
        jam='$jam',
        alamat='$alamat',
        catatan='$catatan'
        WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Booking</title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background:#f0f2f5; padding:30px; }
    .form-box {
      max-width: 600px; margin:auto; background:white; padding:20px;
      border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1);
    }
    h2 { margin-top:0; color:#007BFF; }
    label { display:block; margin:10px 0 5px; font-weight:600; }
    input, select, textarea {
      width:100%; padding:10px; border:1px solid #ccc;
      border-radius:8px; margin-bottom:15px;
    }
    button {
      padding:10px 20px; background:#007BFF; border:none;
      color:white; font-weight:600; border-radius:8px; cursor:pointer;
    }
    button:hover { background:#0056b3; }
    a { text-decoration:none; margin-left:15px; color:#555; }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>✏️ Edit Booking #<?= $data['id']; ?></h2>
    <form method="POST">
      <label>Nama</label>
      <input type="text" name="nama" value="<?= $data['nama']; ?>" required>

      <label>No. HP</label>
      <input type="tel" name="no_hp" value="<?= $data['no_hp']; ?>" required>

      <label>Layanan</label>
      <select name="layanan">
        <option <?= $data['layanan']=="Cuci AC"?"selected":""; ?>>Cuci AC</option>
        <option <?= $data['layanan']=="Service Berkala"?"selected":""; ?>>Service Berkala</option>
        <option <?= $data['layanan']=="Isi/Ganti Freon"?"selected":""; ?>>Isi/Ganti Freon</option>
        <option <?= $data['layanan']=="Perbaikan Kerusakan"?"selected":""; ?>>Perbaikan Kerusakan</option>
        <option <?= $data['layanan']=="Instalasi & Bongkar Pasang"?"selected":""; ?>>Instalasi & Bongkar Pasang</option>
      </select>

      <label>Tanggal</label>
      <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" required>

      <label>Jam</label>
      <input type="time" name="jam" value="<?= $data['jam']; ?>" required>

      <label>Alamat</label>
      <input type="text" name="alamat" value="<?= $data['alamat']; ?>" required>

      <label>Catatan</label>
      <textarea name="catatan"><?= $data['catatan']; ?></textarea>

      <button type="submit">💾 Simpan Perubahan</button>
      <a href="admin.php">Batal</a>
    </form>
  </div>
</body>
</html>
