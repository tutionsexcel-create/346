<?php
// Include database connection and header
include 'header.php';
require_once 'config.php';

if (!isset($conn) || !$conn) {
    die("Database connection failed. Please check config.php.");
}

// Fetch active record (status = 1)
$sql = "SELECT `id`, `content`, `status` FROM `about_us` WHERE `status` = 1 ORDER BY `id` DESC LIMIT 1";
$result = mysqli_query($conn,$sql);

// Fetch data row
$about_data = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;

include 'menu.php';
?>

<style>
    .about-container {
        max-width: 1140px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .about-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 40px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    .about-card h1.page-title {
        font-size: 2rem;
        color: #212529;
        margin-top: 0;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #0d6efd;
    }

    /* Styles for WYSIWYG rendered HTML content */
    .about-content {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #495057;
    }

    .about-content h1, 
    .about-content h2, 
    .about-content h3, 
    .about-content h4 {
        color: #212529;
        margin-top: 25px;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .about-content p {
        margin-bottom: 15px;
    }

    .about-content ul, 
    .about-content ol {
        margin-bottom: 20px;
        padding-left: 30px;
    }

    .about-content li {
        margin-bottom: 8px;
    }

    .about-content table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }

    .about-content table th,
    .about-content table td {
        padding: 10px 15px;
        border: 1px solid #dee2e6;
    }

    .no-data-card {
        text-align: center;
        padding: 60px 20px;
        background: #f8f9fa;
        border-radius: 8px;
        margin: 40px 0;
    }

    .no-data-card h2 {
        color: #212529;
        margin-bottom: 10px;
    }

    .no-data-card p {
        color: #6c757d;
        margin: 5px 0;
    }
</style>

<main class="about-container">
    <?php if ($about_data && !empty($about_data['content'])): ?>
        <br>
        <div class="about-card">
            <h1 class="page-title">About Us</h1>
            <div class="about-content">
                <!-- Direct HTML rendering from Summernote -->
                <?php echo $about_data['content']; ?>
            </div>
        </div>

    <?php else: ?>

        <div class="no-data-card">
            <h2>About Us</h2>
            <p>Page under construction</p>
            <p>Coming soon...</p>
        </div>

    <?php endif; ?>
</main>

<?php 
include 'footer.php';
?>