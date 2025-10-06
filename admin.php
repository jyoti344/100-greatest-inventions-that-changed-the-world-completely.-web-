<?php
include "navbar.php";
include "config.php";
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Panel</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div style="text-align: right; padding-right: 20px;">
<a href="admin_signup.php" class="btn btn-success mt-3">
  <i class="fas fa-user-plus"></i> Create New Admin
</a>
<hr>
</div>
<div class="container mt-5">
  <h2>Admin Panel</h2>
  <form method="post" action="admin.php">
    <input type="text" name="name" class="form-control mb-2" placeholder="Invention Name" required>
    <input type="text" name="creator" class="form-control mb-2" placeholder="Creator" required>
    <input type="text" name="country" class="form-control mb-2" placeholder="Country" required>
    <textarea name="description" class="form-control mb-2" placeholder="Description" required></textarea>
    <input type="text" name="video_url" class="form-control mb-2" placeholder="Video URL (embed)" required>
    <input type="text" name="category" class="form-control mb-2" placeholder="Category" required>
    <input type="text" name="year" class="form-control mb-2" placeholder="Year" required>
    <button type="submit" name="add" class="btn btn-primary">Add Invention</button>
  </form>
  <hr>
  <h3>Manage Inventions</h3>
  <?php
if(isset($_POST['add'])) {
    $stmt = $conn->prepare("INSERT INTO inventions (name, creator, country, description, video_url, category, year) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss", $_POST['name'], $_POST['creator'], $_POST['country'], $_POST['description'], $_POST['video_url'], $_POST['category'], $_POST['year']);
    $stmt->execute();
    echo "<p class='text-success'>Invention added successfully!</p>";
}

// Handle delete request
if(isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $conn->query("DELETE FROM inventions WHERE id = $delete_id");
    echo "<p class='text-danger'>Invention deleted successfully!</p>";
}

$result = $conn->query("SELECT * FROM inventions");

if ($result->num_rows > 0) {
    echo "<div class='table-responsive mt-4'>";
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead><tr><th>ID</th><th>Name</th><th>Country</th><th>Action</th></tr></thead><tbody>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['country']."</td>";
        echo "<td>
            <form method='post' style='display:inline;' onsubmit='return confirmDelete()'>
                <input type='hidden' name='delete_id' value='".$row['id']."'>
                <button type='submit' class='btn btn-danger btn-sm'>
                    <i class='fas fa-trash'></i> Delete
                </button>
            </form>
        </td>";
        echo "</tr>";
    }

    echo "</tbody></table></div>";
} else {
    echo "<p class='text-muted'>No inventions found yet.</p>";
}
?>
</div>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this invention? This action cannot be undone!");
}
</script>
</body>
</html>