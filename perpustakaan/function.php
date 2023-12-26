<?php
require 'connection.php';

$database = require 'connection.php';

// Gantilah nama collection sesuai dengan kebutuhan Anda
$collection = $database->selectCollection('peminjaman');

/**
 * Fungsi untuk mendapatkan semua data peminjaman.
 *
 * @return MongoDB\Driver\Cursor
 */
function find()
{
    global $collection;
    return $collection->find();
}

/**
 * Fungsi untuk mendapatkan data peminjaman berdasarkan ID.
 *
 * @param string $id ID dokumen
 * @return array|null
 */
function getById($id)
{
    global $collection;
    return $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
}

/**
 * Fungsi untuk menghapus data peminjaman berdasarkan ID.
 *
 * @param string $id ID dokumen
 * @return int Jumlah dokumen yang dihapus
 */
function delete($id)
{
    global $collection;

    $result = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)]);

    return $result->getDeletedCount();
}

/**
 * Fungsi untuk mendapatkan ID terakhir yang diurutkan.
 *
 * @return string
 */
function getSortId()
{
    global $collection;
    $lastDocument = $collection->findOne([], ['sort' => ['kodePeminjam' => -1]]);
    $lastId = isset($lastDocument['kodePeminjam']) ? $lastDocument['kodePeminjam'] : 'KP-000';

    return $lastId;
}

/**
 * Fungsi untuk membuat data peminjaman baru.
 *
 * @param array $data Data peminjaman baru
 * @return int Jumlah dokumen yang diinsert
 */
function create($data)
{
    global $collection;

    $kodePeminjam = $data["kodePeminjam"];
    $kodeBuku = $data["kodeBuku"];
    $judulBuku = $data["judulBuku"];
    $namaPeminjam = $data["namaPeminjam"];
    $tanggalPinjam = $data["tanggalPinjam"];
    $tanggalKembali = $data["tanggalKembali"];
    $status = $data["status"];

    // Data yang akan diinsert
    $data = [
        "kodePeminjam" => $kodePeminjam,
        "kodeBuku" => $kodeBuku,
        "judulBuku" => $judulBuku,
        "namaPeminjam" => $namaPeminjam,
        "tanggalPinjam" => new MongoDB\BSON\UTCDateTime(strtotime($tanggalPinjam) * 1000),
        "tanggalKembali" => new MongoDB\BSON\UTCDateTime(strtotime($tanggalKembali) * 1000),
        "status" => $status,
    ];

    // Melakukan insert data ke koleksi MongoDB
    $result = $collection->insertOne($data);

    return $result->getInsertedCount();
}

/**
 * Fungsi untuk mengenerate Kode Peminjam baru berdasarkan ID terakhir.
 *
 * @param string $lastId ID terakhir
 * @return string Kode Peminjam baru
 */
function generateKodePeminjam($lastId)
{
    // Mendapatkan nomor urut dari ID sebelumnya
    $lastNumber = intval(substr($lastId, 3));

    // Menambahkan 1 untuk mendapatkan nomor urut berikutnya
    $nextNumber = $lastNumber + 1;

    // Menggabungkan dengan format KP-XXX
    $newId = "KP-" . sprintf('%03d', $nextNumber);

    return $newId;
}

/**
 * Fungsi untuk mengupdate data peminjaman berdasarkan ID.
 *
 * @param string $id ID dokumen yang akan diupdate
 * @param array $data Data baru
 * @return int Jumlah dokumen yang diupdate
 */
function update($id, $data)
{
    global $collection;

    $kodeBuku = $data["kodeBuku"];
    $judulBuku = $data["judulBuku"];
    $namaPeminjam = $data["namaPeminjam"];
    $tanggalPinjam = $data["tanggalPinjam"];
    $tanggalKembali = $data["tanggalKembali"];
    $status = $data["status"];

    // Data yang akan diupdate
    $updateData = [
        '$set' => [
            "kodeBuku" => $kodeBuku,
            "judulBuku" => $judulBuku,
            "namaPeminjam" => $namaPeminjam,
            "tanggalPinjam" => new MongoDB\BSON\UTCDateTime(strtotime($tanggalPinjam) * 1000),
            "tanggalKembali" => new MongoDB\BSON\UTCDateTime(strtotime($tanggalKembali) * 1000),
            "status" => $status,
        ],
    ];

    // Melakukan update data ke koleksi MongoDB berdasarkan ID
    $result = $collection->updateOne(['_id' => new MongoDB\BSON\ObjectID($id)], $updateData);

    return $result->getModifiedCount();
}

/**
 * Fungsi untuk mengonversi tanggal dari format UTCDateTime ke format tertentu.
 *
 * @param MongoDB\BSON\UTCDateTime $date Tanggal dalam format UTCDateTime
 * @return string Tanggal dalam format yang diinginkan
 */
function convertDate($date)
{
    $timestampSeconds = $date->toDateTime()->getTimestamp();
    $timestampMillis = $timestampSeconds * 1000;
    $utc = new MongoDB\BSON\UTCDateTime($timestampMillis);
    $result = $utc->toDateTime();

    return $result->format('d-m-Y');
}
