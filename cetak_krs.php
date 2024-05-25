<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['selected_courses']) || empty($_SESSION['selected_courses'])) {
    // Jika tidak ada mata kuliah yang dipilih, kembalikan ke halaman pilih_krs.php
    header('Location: pilih_krs.php');
    exit;
}

$selected_courses = $_SESSION['selected_courses'];
$courses_ids = implode(",", $selected_courses);

// Query untuk mengambil detail mata kuliah yang dipilih
$sql = "SELECT * FROM courses WHERE id IN ($courses_ids)";
$result = $conn->query($sql);

include 'includes/header.php';
?>

<h1 class="mt-4">Kartu Rencana Studi (KRS)</h1>
<p>Berikut adalah daftar mata kuliah yang telah dipilih:</p>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Mata Kuliah</th>
            <th>Semester</th>
            <th>SKS</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['course_name']; ?></td>
                <td><?php echo $row['semester']; ?></td>
                <td><?php echo $row['sks']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
    // Otomatis cetak setelah halaman dimuat
    window.onload = function() {
        window.print();
    }
</script>

<?php include 'includes/footer.php'; ?>
