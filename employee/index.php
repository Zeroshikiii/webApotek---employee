<?php
session_start();

if (!isset($_SESSION['idUser'])) {
    header('Location: ../login/index.php');
    exit();
}

include('../config.php');

$idUser = $_SESSION['idUser'];
$username = $_SESSION['username'];

// Mengambil daftar klien dari database
$query = "SELECT * FROM pegawai";
$result = mysqli_query($connection, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($connection));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Employee Lists</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <!-- Your existing HTML code... -->

    <div class="container">
        <h2>List of Employee</h2>
        <div class="container">
            <a href="tambah_employee.php" class=" btn btn-primary btn-login mb-3">Add Employee</a>
        </div>
        <table class="table" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Posisiton</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['idPegawai']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['jabatan']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td>
                            <a href="edit_employee.php?id=<?php echo $row['idPegawai']; ?>" class="btn btn-warning">Edit</a>
                            <a href="hapus_employee.php?id=<?php echo $row['idPegawai']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
