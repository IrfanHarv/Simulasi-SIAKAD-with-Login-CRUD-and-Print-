<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $course_name = $_POST['course_name'];
        $semester = $_POST['semester'];
        $sks = $_POST['sks'];
        $conn->query("INSERT INTO courses (course_name, semester, sks) VALUES ('$course_name', '$semester', '$sks')");
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $course_name = $_POST['course_name'];
        $semester = $_POST['semester'];
        $sks = $_POST['sks'];
        $conn->query("UPDATE courses SET course_name='$course_name', semester='$semester', sks='$sks' WHERE id=$id");
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $conn->query("DELETE FROM courses WHERE id=$id");
    }
}

$courses = $conn->query("SELECT * FROM courses");

include 'includes/header.php';
?>

<h1 class="mt-4">Data Mata Kuliah</h1>
<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#courseModal" onclick="openCreateModal()">Tambah Mata Kuliah</button>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Mata Kuliah</th>
            <th>Semester</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $courses->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['course_name']; ?></td>
                <td><?php echo $row['semester']; ?></td>
                <td><?php echo $row['sks']; ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#courseModal" onclick="openEditModal(<?php echo $row['id']; ?>, '<?php echo $row['course_name']; ?>', '<?php echo $row['semester']; ?>', '<?php echo $row['sks']; ?>')">Edit</button>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="courseForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseModalLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="course-id">
                    <div class="form-group">
                        <label for="course_name">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" required>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester" required>
                    </div>
                    <div class="form-group">
                        <label for="sks">SKS</label>
                        <input type="text" class="form-control" id="sks" name="sks" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" name="create" id="create-button" class="btn btn-primary">Tambah</button>
                    <button type="submit" name="update" id="update-button" class="btn btn-primary" style="display:none;">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('courseForm').reset();
        document.getElementById('course-id').value = '';
        document.getElementById('courseModalLabel').innerText = 'Tambah Mata Kuliah';
        document.getElementById('create-button').style.display = 'inline-block';
        document.getElementById('update-button').style.display = 'none';
    }

    function openEditModal(id, course_name, semester, sks) {
        document.getElementById('course-id').value = id;
        document.getElementById('course_name').value = course_name;
        document.getElementById('semester').value = semester;
        document.getElementById('sks').value = sks;
        document.getElementById('courseModalLabel').innerText = 'Edit Mata Kuliah';
        document.getElementById('create-button').style.display = 'none';
        document.getElementById('update-button').style.display = 'inline-block';
    }
</script>

<?php include 'includes/footer.php'; ?>
