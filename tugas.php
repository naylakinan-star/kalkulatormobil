<?php
 

// Pesan dari proses.php
$pesan = $_GET['pesan'] ?? "";

// Nilai form untuk repopulate
$nilai_nama = $_GET['nama'] ?? "";
$nilai_email = $_GET['email'] ?? "";
$nilai_hargamobil = $_GET['hargamobil'] ?? "";
$nilai_tenor = $_GET['tenor'] ?? "";
$nilai_dp = $_GET['dp'] ?? "";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <title>Auto Finance</title>
    <style>
        /* karena warnanya banyak yg di ulang ulang, maka pake root saja supaya mudah */
        :root {
            --hijau-tua: #0d3b3a;
            --hijau: #14574f;
            --amber: #f2a900;
            --amber-tua: #d68f00;
            --putih-hijau: #eef3f0;
            --teks: #12302e;
            --abu: #5f7271;
            --garis: #d8e2de;
        }

        body {
            background-color: var(--putih-hijau);
            color: var(--teks);
            line-height: 1.65;
        }

        /* navbarrrr */
        .navbar {
            background-color: var(--hijau-tua);
            padding: 14px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            color: #fff;
            font-weight: 800;
            font-size: 22px;
        }

        .navbar-brand span { color: var(--amber); }

        .navbar-brand i {
            color: var(--amber);
            margin-right: 6px;
        }

        .navbar .nav-link {
            color: rgba(255, 255, 255, .8);
            font-weight: 500;
            border-radius: 999px;
            padding: 8px 16px;
        }

        .navbar .nav-link:hover {
            color: var(--hijau-tua);
            background-color: var(--amber);
        }

        .navbar-toggler { border-color: rgba(255, 255, 255, .4); }
        .navbar-toggler-icon { filter: invert(1); }

        /* SLIDER */
        .carousel-item {
            height: 460px;
            background: linear-gradient(135deg, var(--hijau-tua), var(--hijau));
        }

        .carousel-item img {
            width: 100%;
            height: 460px;
            object-fit: cover;
            filter: brightness(50%);
        }

        .carousel-caption {
            bottom: auto;
            top: 50%;
            transform: translateY(-50%);
            text-align: left;
            left: 10%;
            right: 30%;
        }

        .carousel-caption h5 {
            font-weight: 800;
            font-size: clamp(1.8rem, 4vw, 3rem);
            line-height: 1.1;
        }

        .carousel-caption p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, .9);
        }

        .carousel-indicators [data-bs-target] {
            width: 28px;
            height: 4px;
            border: 0;
            background-color: var(--amber);
        }

        section { padding: 80px 0; }

        .judul-section {
            font-weight: 800;
            font-size: clamp(1.7rem, 3vw, 2.3rem);
            margin-bottom: 14px;
        }

        .sub-section {
            color: var(--abu);
            max-width: 560px;
            margin-bottom: 40px;
        }

        /* tentang */
        .tentang-box {
            background: #fff;
            border: 1px solid var(--garis);
            border-left: 6px solid var(--amber);
            border-radius: 16px;
            padding: 36px;
        }

        .tentang-box p {
            color: var(--abu);
            margin-bottom: 0;
            max-width: 62ch;
        }

        /* kalkulator */
        .kalkulator { background-color: #fff; }

        .kotak-form {
            background-color: var(--putih-hijau);
            border: 1px solid var(--garis);
            border-radius: 20px;
            padding: 32px;
            height: 100%;
        }

        .kotak-form h5 {
            font-weight: 800;
            font-size: 1.2rem;
            margin-bottom: 24px;
        }

        .kalkulator label {
            font-weight: 600;
            font-size: .9rem;
            margin-bottom: 6px;
        }

        .kalkulator input[type="text"],
        .kalkulator input[type="number"],
        .kalkulator select {
            width: 100%;
            border: 1.5px solid var(--garis);
            border-radius: 12px;
            padding: 12px 16px;
            background-color: #fff;
            font-family: inherit;
            color: var(--teks);
            margin-bottom: 22px;
        }

        .kalkulator input:focus,
        .kalkulator select:focus {
            outline: none;
            border-color: var(--hijau);
            box-shadow: 0 0 0 4px rgba(20, 87, 79, .15);
        }

        /* radio disembunyikan */
        .tenor { 
            display: flex; 
            flex-wrap: wrap;
            gap: 8px; 
            margin-bottom: 22px; 
            }

        .tenor input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .tenor label {
            border: 1.5px solid var(--garis);
            background: #fff;
            border-radius: 999px;
            padding: 8px 18px;
            margin: 0;
            cursor: pointer;
        }

        .tenor label:hover { border-color: var(--hijau); }

        .tenor input[type="radio"]:checked + label {
            background: var(--hijau-tua);
            border-color: var(--hijau-tua);
            color: #fff;
        }

        .tenor input[type="radio"]:focus-visible + label {
            outline: 3px solid var(--amber);
            outline-offset: 2px;
        }

        /* tombol hitung */
        .tombol-hitung {
            background-color: var(--amber);
            color: var(--hijau-tua);
            font-weight: 700;
            font-family: inherit;
            border: none;
            border-radius: 12px;
            padding: 14px;
            width: 100%;
            cursor: pointer;
        }

        .tombol-hitung:hover { background-color: var(--amber-tua); }

        /* HASIL */
        .hasil {
            background-color: var(--hijau-tua);
            color: #fff;
            border-radius: 20px;
            padding: 32px;
            height: 100%;
        }

        .hasil h3 {
            font-weight: 800;
            font-size: 1.2rem;
            margin-bottom: 24px;
        }

        .hasil-kosong {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: rgba(255, 255, 255, .7);
            min-height: 320px;
        }

        .hasil-kosong .ikon { font-size: 2.6rem; margin-bottom: 10px; }

        /* angka angsuran*/
        .hasil-utama {
            background-color: var(--amber);
            color: var(--hijau-tua);
            border-radius: 16px;
            padding: 22px 24px;
            margin-bottom: 22px;
        }

        .hasil-utama small { font-weight: 600; opacity: .8; }

        .hasil-utama .angka {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 800;
            line-height: 1.1;
        }

        .baris {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 11px 0;
            font-size: .95rem;
        }


        /* pesan kalo input belum lengkap */
        .pesan {
            background: #fff3d6;
            border: 1px solid var(--amber);
            color: #6b4a00;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: .9rem;
        }

        /* footer */
        .footer {
            background-color: var(--hijau-tua);
            color: rgba(255, 255, 255, .75);
            text-align: center;
            padding: 28px 12px;
        }

        .footer strong { color: var(--amber); }

        @media (max-width: 768px) {
            section { padding: 56px 0; }
            .carousel-item, .carousel-item img { height: 380px; }
            .carousel-caption { left: 8%; right: 8%; }
            .kotak-form, .hasil { padding: 24px; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md">
    <div class="container">
        <a class="navbar-brand" href="#beranda">
            <i class="bi bi-car-front-fill"></i>Auto <span>Finance</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#beranda">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kalkulator">Kalkulator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#kontak">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- slider -->
<div id="beranda" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#beranda" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#beranda" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#beranda" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="asset/mobil3.jpg" class="d-block w-100" alt="Mobil">
            <div class="carousel-caption d-none d-md-block">
                <h5>Kredit mobil terpercaya</h5>
                <p>Hitung perkiraan angsuran mobil dengan mudah dan cepat.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="asset/mobil2.jpg" class="d-block w-100" alt="Mobil">
            <div class="carousel-caption d-none d-md-block">
                <h5>Mudah dalam menghitung</h5>
                <p>Masukkan harga, DP dan tenor untuk melihat hasil perhitungan.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="asset/mobil1.jpg" class="d-block w-100" alt="Mobil">
            <div class="carousel-caption d-none d-md-block">
                <h5>Rencanakan pembelianmu</h5>
                <p>Ketahui estimasi cicilan mobil sebelum membeli.</p>
            </div>
        </div>
    </div>
</div>

<!-- tentang -->
<section id="tentang">
    <div class="container">
        <div class="tentang-box">
            <h2 class="judul-section">Tentang Perusahaan</h2>
            <p>
                Auto Finance merupakan perusahaan yang bergerak
                di bidang penjualan dan pembiayaan kendaraan.
                Kami membantu pelanggan mendapatkan kendaraan
                impian dengan proses perhitungan angsuran yang mudah.
            </p>
        </div>
    </div>
</section>

<!-- kalkulator -->
<section class="kalkulator" id="kalkulator">
    <div class="container">
        <h2 class="judul-section">Kalkulator Angsuran</h2>
        <p class="sub-section">Isi data di bawah, lalu lihat estimasi cicilan bulananmu.</p>

        <?php if ($pesan != "") { ?>
    <div class="pesan">
        <?php echo htmlspecialchars($pesan); ?>
    </div>
   <?php } ?>

        <div class="row">

            <!-- form -->
            <div class="col">
                <div class="kotak-form">
                    <h5>Data pembelian</h5>

                   <form method="POST" action="proses.php">

                         <form method="POST" action="proses.php">

    <!-- NAMA -->
    <label for="nama">Nama</label>
    <input type="text"
           id="nama"
           name="nama"
           value="<?php echo htmlspecialchars($nilai_nama); ?>">

    <!-- EMAIL -->
    <label for="email">Email</label>
    <input type="text"
           id="email"
           name="email"
           value="<?php echo htmlspecialchars($nilai_email); ?>">

    <!-- HARGA MOBIL -->
    <label for="hargamobil">Harga Mobil</label>
    <input type="number"
           id="hargamobil"
           name="hargamobil"
           min="0"
           value="<?php echo htmlspecialchars($nilai_hargamobil); ?>">

    <!-- TENOR -->
    <label>Tenor</label>

    <input type="radio"
           name="tenor"
           value="1"
           <?php if ($nilai_tenor == "1") echo "checked"; ?>>
    <label>1 Tahun</label>

    <input type="radio"
           name="tenor"
           value="2"
           <?php if ($nilai_tenor == "2") echo "checked"; ?>>
    <label>2 Tahun</label>

    <input type="radio"
           name="tenor"
           value="3"
           <?php if ($nilai_tenor == "3") echo "checked"; ?>>
    <label>3 Tahun</label>

    <input type="radio"
           name="tenor"
           value="4"
           <?php if ($nilai_tenor == "4") echo "checked"; ?>>
    <label>4 Tahun</label>

    <input type="radio"
           name="tenor"
           value="5"
           <?php if ($nilai_tenor == "5") echo "checked"; ?>>
    <label>5 Tahun</label>

    <br><br>

    <!-- DP -->
    <label>DP</label>

    <input type="radio"
           name="dp"
           value="10"
           <?php if ($nilai_dp == "10") echo "checked"; ?>>
    <label>10%</label>

    <input type="radio"
           name="dp"
           value="20"
           <?php if ($nilai_dp == "20") echo "checked"; ?>>
    <label>20%</label>

    <input type="radio"
           name="dp"
           value="30"
           <?php if ($nilai_dp == "30") echo "checked"; ?>>
    <label>30%</label>

    <input type="radio"
           name="dp"
           value="40"
           <?php if ($nilai_dp == "40") echo "checked"; ?>>
    <label>40%</label>

    <input type="radio"
           name="dp"
           value="50"
           <?php if ($nilai_dp == "50") echo "checked"; ?>>
    <label>50%</label>

    <br><br>

    <button type="submit" name="submit" class="tombol-hitung">
        Hitung Angsuran
    </button>

</form>
                </div>
            </div>

<?php

if (isset($_POST["submit"])) {

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $hargamobil = $_POST['hargamobil'];
    $tenor = $_POST['tenor'];
    $dp = $_POST['dp'];

    // DP mobil
    $hargadpmobil = ($dp / 100) * $hargamobil;

    // Lama angsuran dalam bulan
    $lamaangsuran = $tenor * 12;

    // Bunga 20%
    $bunga = 20 / 100 * $hargamobil;

    // Sisa pinjaman
    $sisapinjaman = $hargamobil - $hargadpmobil;

    // Total bayar
    $totalbayar = $sisapinjaman + $bunga;

    // Angsuran per bulan
    $jumlahangsuran = $totalbayar / $lamaangsuran;

    // Menampilkan hasil
    echo "<div class='hasil'>";

    echo "<h3>Hasil Perhitungan</h3>";

    echo "Nama = " . $nama . "<br>";
    echo "Email = " . $email . "<br>";
    echo "Harga Mobil = Rp " . number_format($hargamobil, 0, ',', '.') . "<br>";
    echo "Tenor = " . $tenor . " tahun<br>";
    echo "DP = " . $dp . "%<br>";
    echo "Lama Angsuran = " . $lamaangsuran . " bulan<br>";
    echo "DP Mobil = Rp " . number_format($hargadpmobil, 0, ',', '.') . "<br>";
    echo "Bunga = Rp " . number_format($bunga, 0, ',', '.') . "<br>";
    echo "Angsuran = Rp " . number_format($jumlahangsuran, 0, ',', '.') . "<br>";

    echo "</div>";

} else {

    echo "<div class='hasil hasil-kosong'>";
    echo "<h2>Belum ada perhitungan</h2>";
    echo "<p>Isi data di samping untuk mengetahui hasil.</p>";
    echo "</div>";

}

?>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer" id="kontak">
    <p class="mb-0">
        &copy; 2026 <strong>Auto Finance</strong> || Penghitung Angsuran Mobil
        || +62 432 67576 31262
        || autofinance34@gmail.com

    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> 