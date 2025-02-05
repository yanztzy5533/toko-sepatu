<?php
// Menghubungkan ke database
$conn = mysqli_connect("localhost", "username", "password", "database");

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Menerima data dari client-side
$produkId = $_POST['produkId'];

// Mengecek apakah produk ada di database
$query = "SELECT * FROM produk WHERE id = '$produkId'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Mengambil data produk
    $produk = mysqli_fetch_assoc($result);

    // Membuat transaksi baru
    $query = "INSERT INTO transaksi (produk_id, tanggal) VALUES ('$produkId', NOW())";
    mysqli_query($conn, $query);

    // Mengirimkan respons ke client-side
    $response = array('pesan' => 'Produk berhasil dibeli!');
    echo json_encode($response);
} else {
    // Mengirimkan respons ke client-side jika produk tidak ada
    $response = array('pesan' => 'Produk tidak ada!');
    echo json_encode($response);
}

// Menutup koneksi
mysqli_close($conn);
?>

<?php
// Menghubungkan ke database
$conn = mysqli_connect("localhost", "username", "password", "database");

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Menerima data dari client-side
$produkId = $_POST['produkId'];

// Menambahkan produk ke keranjang
$query = "INSERT INTO keranjang (produk_id) VALUES ('$produkId')";
mysqli_query($conn, $query);

// Mengirimkan respons ke client-side
$response = array('pesan' => 'Produk berhasil ditambahkan ke keranjang!');
echo json_encode($response);

// Menutup koneksi
mysqli_close($conn);
?>