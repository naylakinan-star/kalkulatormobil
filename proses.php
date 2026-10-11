<?php

// Kalau halaman proses.php dibuka langsung
if (!isset($_POST["submit"])) {
    header("Location: tugas.php");
    exit;
}


// =============================
// MENGAMBIL DATA DARI FORM
// =============================

$nama = trim($_POST['nama'] ?? "");
$email = trim($_POST['email'] ?? "");
$hargamobil = trim($_POST['hargamobil'] ?? "");
$tenor = $_POST['tenor'] ?? "";
$dp = $_POST['dp'] ?? "";



$query_nama = "nama=" . urlencode($nama);
$query_email = "email=" . urlencode($email);
$query_hargamobil = "hargamobil=" . urlencode($hargamobil);
$query_tenor = "tenor=" . urlencode($tenor);
$query_dp = "dp=" . urlencode($dp);

$isi_form = "&$query_nama&$query_email&$query_hargamobil&$query_tenor&$query_dp";




if ($nama === "") {

    $pesan = urlencode("Nama harus diisi");

    header("Location: tugas.php?pesan=$pesan$isi_form");
    exit;

}


if ($email === "") {

    $pesan = urlencode("Email harus diisi");

    header("Location: tugas.php?pesan=$pesan$isi_form");
    exit;

}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $pesan = urlencode("Format email tidak valid");

    header("Location: tugas.php?pesan=$pesan$isi_form");
    exit;

}


if ($hargamobil === "" || !is_numeric($hargamobil) || $hargamobil <= 0) {

    $pesan = urlencode("Harga mobil harus diisi dengan angka yang benar");

    header("Location: tugas.php?pesan=$pesan$isi_form");
    exit;

}


if (!in_array($tenor, ["1", "2", "3", "4", "5"])) {

    $pesan = urlencode("Tenor harus dipilih");

    header("Location: tugas.php?pesan=$pesan$isi_form");
    exit;

}


if (!in_array($dp, ["10", "20", "30", "40", "50"])) {

    $pesan = urlencode("DP harus dipilih");

    header("Location: tugas.php?pesan=$pesan$isi_form");
    exit;

}


// DP mobil
$hargadpmobil = ($dp / 100) * $hargamobil;


// Lama angsuran
$lamaangsuran = $tenor * 12;


// Bunga 20%
$bunga = (20 / 100) * $hargamobil;


// Sisa pinjaman
$sisapinjaman = $hargamobil - $hargadpmobil;


// Total yang harus dibayar
$totalbayar = $sisapinjaman + $bunga;


// Angsuran per bulan
$jumlahangsuran = $totalbayar / $lamaangsuran;


?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Hasil Perhitungan</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #eef3f0;
            padding: 30px;
        }

        .hasil {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .hasil h2 {
            color: #14574f;
        }

        .hasil p {
            margin: 10px 0;
        }

        .angsuran {
            background-color: #f2a900;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .kembali {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #14574f;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

    </style>

</head>

<body>

<div class="hasil">

    <h2>Hasil Perhitungan Angsuran</h2>

    <p>
        <b>Nama:</b>
        <?php echo htmlspecialchars($nama); ?>
    </p>

    <p>
        <b>Email:</b>
        <?php echo htmlspecialchars($email); ?>
    </p>

    <p>
        <b>Harga Mobil:</b>
        Rp <?php echo number_format($hargamobil, 0, ',', '.'); ?>
    </p>

    <p>
        <b>Tenor:</b>
        <?php echo $tenor; ?> Tahun
    </p>

    <p>
        <b>DP:</b>
        <?php echo $dp; ?>%
    </p>

    <p>
        <b>Lama Angsuran:</b>
        <?php echo $lamaangsuran; ?> Bulan
    </p>

    <p>
        <b>DP Mobil:</b>
        Rp <?php echo number_format($hargadpmobil, 0, ',', '.'); ?>
    </p>

    <p>
        <b>Bunga 20%:</b>
        Rp <?php echo number_format($bunga, 0, ',', '.'); ?>
    </p>

    <p>
        <b>Total Bayar:</b>
        Rp <?php echo number_format($totalbayar, 0, ',', '.'); ?>
    </p>


    <div class="angsuran">

        <b>Angsuran Per Bulan</b>

        <h2>
            Rp <?php echo number_format($jumlahangsuran, 0, ',', '.'); ?>
        </h2>

    </div>

</div>

</body>

</html>