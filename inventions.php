<?php
include "navbar.php";
include "config.php";

// Fetch unique categories and countries for dropdowns
$categoriesResult = $conn->query("SELECT DISTINCT category FROM inventions");
$countriesResult = $conn->query("SELECT DISTINCT country FROM inventions");

// Build filter query based on GET parameters
$where = [];

if (!empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $where[] = "name LIKE '%$search%'";
}

if (!empty($_GET['category'])) {
    $category = $conn->real_escape_string($_GET['category']);
    $where[] = "category='$category'";
}

if (!empty($_GET['country'])) {
    $country = $conn->real_escape_string($_GET['country']);
    $where[] = "country='$country'";
}

$sql = "SELECT * FROM inventions";
if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .invention-card { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 8px; cursor: pointer; }
        .video-container iframe { border-radius: 8px; }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Greatest Inventions</h2>

    <!-- Filters -->
    <form method="GET" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search inventions..." value="<?php echo $_GET['search'] ?? ''; ?>">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                <?php while($cat = $categoriesResult->fetch_assoc()):
                    $selected = (isset($_GET['category']) && $_GET['category'] == $cat['category']) ? 'selected' : '';
                ?>
                    <option value="<?php echo $cat['category']; ?>" <?php echo $selected; ?>><?php echo $cat['category']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-4">
            <select name="country" class="form-select">
                <option value="">All Countries</option>
                <?php while($c = $countriesResult->fetch_assoc()):
                    $selected = (isset($_GET['country']) && $_GET['country'] == $c['country']) ? 'selected' : '';
                ?>
                    <option value="<?php echo $c['country']; ?>" <?php echo $selected; ?>><?php echo $c['country']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Inventions Grid -->
    <div class="inventions-grid">
        <?php if($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): $id = $row['id']; ?>
            <div class="invention-card" data-bs-toggle="modal" data-bs-target="#inventionModal<?php echo $id; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <div class="video-container">
                    <iframe width="100%" height="200" src="<?php echo $row['video_url']; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
                <br>
                <div class="invention-info"><h6><strong>Creator:</strong> <?php echo $row['creator']; ?></h6></div>
                <div class="invention-info"><h6><strong>Country:</strong> <?php echo $row['country']; ?></h6></div>
                <div class="invention-info"><h6><strong>Year:</strong> <?php echo $row['year']; ?></h6></div>
                <div class="invention-info"><h6><strong>Category:</strong> <?php echo $row['category']; ?></h6></div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="inventionModal<?php echo $id; ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content p-4">
                        <span class="close-modal" data-bs-dismiss="modal">×</span>
                        <h2 style="color: #667eea; margin-bottom: 20px;"><?php echo $row['name']; ?></h2>
                        <div class="row mb-3">
                            <div class="col"><strong>Inventor:</strong> <?php echo $row['creator']; ?></div>
                            <div class="col"><strong>Country:</strong> <?php echo $row['country']; ?></div>
                            <div class="col"><strong>Year:</strong> <?php echo $row['year']; ?></div>
                            <div class="col"><strong>Category:</strong> <?php echo $row['category']; ?></div>
                        </div>
                        <h4 style="color: #667eea; margin-bottom: 10px;">Description & Impact:</h4>
                        <p style="line-height: 1.6; margin-bottom: 20px;"><?php echo $row['description']; ?></p>
                        <?php if($row['video_url']): ?>
                        <h4 style="color: #667eea; margin-bottom: 10px;">Demo Video:</h4>
                        <div style="border-radius: 12px; overflow: hidden;">
                            <iframe width="100%" height="400" src="<?php echo $row['video_url']; ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No inventions found matching your criteria.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
