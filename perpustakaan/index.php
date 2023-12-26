<?php
require 'function.php';
session_start();
$cursor = find();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Perpustakaan</title>
</head>
<body>

<div class="container mt-5">
    <h3>Data Peminjaman Buku</h3>
    <button class="btn btn-primary my-3 mb-2" onclick="redirectToTambah()">
        <i class="bi bi-plus-circle-fill"></i> Tambah Data
    </button>

    <?php
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['success'] . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        
        unset($_SESSION['success']);
    }
    ?>


    <table class="table table-striped">
        <thead class="table-warning">
        <tr>
            <th scope="col">Kode Peminjaman</th>
            <th scope="col">Kode Buku</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Tanggal Pinjam</th>
            <th scope="col">Tanggal Kembali</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($cursor as $document):
            echo "<script> console.log('Debug Objects: " . $document['tanggalPinjam'] . "' ) </script>"; ?>
            <tr>
                <td><?php echo $document['kodePeminjam']; ?></td>
                <td><?php echo $document['kodeBuku']; ?></td>
                <td><?php echo $document['judulBuku']; ?></td>
                <td><?php echo $document['namaPeminjam']; ?></td>
                <td><?php echo convertDate($document['tanggalPinjam']); ?></td>
                <td><?php echo convertDate($document['tanggalKembali']); ?></td>
                <td><?php echo $document['status']; ?></td>
                <td>

                    <a class="btn btn-success" href="update.php?id=<?= $document["_id"]; ?>"><i
                                class="bi bi-pencil-fill"></i> Edit</a>

                    <a class="btn btn-danger" href="delete.php?id=<?= $document["_id"]; ?>"
                       onclick="return confirm('yakin?');"><i class="bi bi-trash-fill"></i> Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script>
    function redirectToTambah() {
        window.location.href = "create.php";
    }
</script>
</body>
</html>
