<?php
require 'function.php';
$newKodePeminjam = generateKodePeminjam(getSortId());
session_start();

if (isset($_POST["submit"])) {
    if (create($_POST) > 0) {
        $_SESSION['success'] = "Data Peminjam Buku Berhasil Di Simpan";
        echo "<script> location.href='index.php' </script>";
    } else {
        echo "<script> alert('Data Gagal Ditambahkan') </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Tambah Data Peminjaman</title>

    <script>
        function redirectToPreviousPage() {
            window.location.href = "index.php";
        }
    </script>
</head>
<body>
<div class="card my-5 p-5" style="margin-right: 120px; margin-left: 120px;">
    <h2>Tambah Data Peminjaman Buku</h2>

    <form action="" method="post">
        <div class="card my-3 p-4 bg-warning">
            <div class="row">
                <label class="col-sm-2 col-form-label" for="kodePeminjam">Kode Peminjam:</label>
                <div class="col-sm-10">
                    <input type="text" id="kodePeminjam" name="kodePeminjam" class="form-control"
                           value="<?php echo $newKodePeminjam; ?>" readonly><br>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-2 col-form-label" for="kodeBuku">Kode Buku:</label>
                <div class="col-sm-10">
                    <input type="text" id="kodeBuku" name="kodeBuku" class="form-control" required><br>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-2 col-form-label" for="judulBuku">Judul Buku:</label>
                <div class="col-sm-10">
                    <input type="text" id="judulBuku" name="judulBuku" class="form-control" required><br>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-2 col-form-label" for="namaPeminjam">Nama Peminjam:</label>
                <div class="col-sm-10">
                    <input type="text" id="namaPeminjam" name="namaPeminjam" class="form-control" required><br>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-2 col-form-label" for="tanggalPinjam">Tanggal Pinjam:</label>
                <div class="col-sm-10">
                    <input type="date" id="tanggalPinjam" name="tanggalPinjam" class="form-control" required><br>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-2 col-form-label" for="tanggalKembali">Tanggal Kembali:</label>
                <div class="col-sm-10">
                    <input type="date" id="tanggalKembali" name="tanggalKembali" class="form-control" required><br>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-2 col-form-label" for="status">Status:</label>
                <div class="col-sm-10">
                    <input type="text" id="status" name="status" class="form-control" required><br>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-primary me-1" type="submit" name="submit"><i class="bi bi-check-circle"></i> Simpan
            </button>
            <button class="btn btn-danger" onclick="redirectToPreviousPage()"><i class="bi bi-x-circle"></i> Batal
            </button>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>
</html>
