<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Jika form disubmit, proses pilihan KRS
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ambil data dari form
    $selected_courses = $_POST['course']; // Ambil mata kuliah yang dipilih

    // Validasi apakah ada mata kuliah yang dipilih
    if (!empty($selected_courses)) {
        // Simpan pilihan KRS ke dalam sesi
        $_SESSION['selected_courses'] = $selected_courses;
        // Redirect ke halaman cetak_krs.php
        header('Location: cetak_krs.php');
        exit;
    } else {
        // Jika tidak ada mata kuliah yang dipilih, tampilkan pesan kesalahan
        $error_message = "Pilih setidaknya satu mata kuliah!";
    }
}

$courses = $conn->query("SELECT * FROM courses");

include 'includes/header.php';
?>

<h1 class="mt-4">Pilih KRS (Kartu Rencana Studi)</h1>
<p>Berikut adalah daftar semua mata kuliah yang telah diinput, silahkan pilih matakuliah mana yang akan di ambil untuk semester ini :</p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Mata Kuliah</th>
                <th>Semester</th>
                <th>SKS</th>
                <th>Pilih</th> 
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $courses->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['course_name']; ?></td>
                    <td><?php echo $row['semester']; ?></td>
                    <td><?php echo $row['sks']; ?></td>
                    <td><input type="checkbox" name="course[]" value="<?php echo $row['id']; ?>"></td> 
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="text-right">
        <button type="submit" name="submit" class="btn btn-primary">Cetak KRS</button>
    </div>
</form>

<?php include 'includes/footer.php'; ?>
