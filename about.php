<?php
require_once 'config.php';
include_once 'header.php'; // Adjust the path as necessary

// Function to sanitize and clean the input content
function sanitizeContent($content) {
    // Remove unnecessary attributes and tags
    $content = preg_replace('/\s*data-[^=]+="[^"]*"/i', '', $content); // Remove data-* attributes
    $content = preg_replace('/<br\s*\/?>/i', '', $content); // Remove <br> tags
    $content = preg_replace('/\s+/', ' ', $content); // Normalize whitespace
    return trim($content);
}
// 1. INCLUDE YOUR CONFIG FILE

$message = '';
$message_type = '';

// 2. HANDLE FORM SUBMISSION (SAVE CONTENT)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_about'])) {
    $about_content = isset($_POST['about_content']) ? trim($_POST['about_content']) : '';

    if (!empty($about_content)) {
        if ($conn instanceof mysqli) {
            // MySQLi implementation
            $stmt = $conn->prepare("INSERT INTO about_us (id, content, status, created_at) VALUES (1, ?, 1, NOW()) ON DUPLICATE KEY UPDATE content = VALUES(content), status = VALUES(status), created_at = NOW()");
            if ($stmt) {
                $stmt->bind_param("s", $about_content);
                if ($stmt->execute()) {
                    $message = "About Us content saved successfully!";
                    $message_type = "success";
                } else {
                    $message = "Error saving content: " . $stmt->error;
                    $message_type = "danger";
                }
                $stmt->close();
            } else {
                $message = "Error preparing statement: " . $conn->error;
                $message_type = "danger";
            }
        } elseif ($conn instanceof PDO) {
            // PDO implementation
            try {
                $stmt = $conn->prepare("INSERT INTO about_us (id, content, status, created_at) VALUES (1, :content, 1, NOW()) ON DUPLICATE KEY UPDATE content = VALUES(content), status = VALUES(status), created_at = NOW()");
                $stmt->execute([':content' => $about_content]);
                $message = "About Us content saved successfully!";
                $message_type = "success";
            } catch (PDOException $e) {
                $message = "Database error: " . $e->getMessage();
                $message_type = "danger";
            }
        } else {
            $message = "Invalid database connection ($conn).";
            $message_type = "danger";
        }
    } else {
        $message = "Content cannot be empty.";
        $message_type = "warning";
    }
}

// 3. FETCH CURRENT CONTENT FROM DATABASE
$current_content = '';

if ($conn instanceof mysqli) {
    $stmt = $conn->prepare("SELECT content FROM about_us WHERE id = 1 LIMIT 1");
    if ($stmt) {
        $stmt->execute();
        $stmt->bind_result($fetched_content);
        if ($stmt->fetch()) {
            $current_content = $fetched_content;
        }
        $stmt->close();
    }
} elseif ($conn instanceof PDO) {
    try {
        $stmt = $conn->prepare("SELECT content FROM about_us WHERE id = 1 LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $current_content = $row['content'];
        }
    } catch (PDOException $e) {
        // Silently handle error or set message
    }
}
include_once 'menu.php'; // Adjust the path as necessary
?>

<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<link href="assets/summernote/summernote.css" rel="stylesheet" />

    <body class="fixed-left">    
        <br><br><br><br>   
        <script>
                            <?php if (!empty($message)): ?>
                                alert("<?php echo htmlspecialchars($message); ?>");
                            <?php endif; ?>
                        </script>
        <div id="wrapper">
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Alert Notification -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h3 class="panel-title">Edit About Us Content</h3></div>
                                    <div class="panel-body"> 
                                        <form action="about.php" method="POST" id="summernoteForm">
                                            <div class="form-group">
                                                <!-- This <textarea> becomes the WYSIWYG editor on page load -->
                                                <textarea class="summernote" name="about_content"><?php echo htmlspecialchars($current_content); ?></textarea>
                                            </div>
                                            <div class="form-group text-right m-b-0">
                                                <button type="submit" name="submit_about" class="btn btn-success waves-effect waves-light">
                                                    <i class="fa fa-save"></i> Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End row -->
                    </div> <!-- container -->
                               
                </div> <!-- content -->                
            </div>
          
        </div>

    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/fastclick/fastclick.js"></script>
        <script type="text/javascript" src="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <!--form validation init-->
        <script src="assets/summernote/summernote.min.js"></script>

        <script>

            jQuery(document).ready(function(){
                $('.wysihtml5').wysihtml5();
                $('.summernote').summernote({
                    height: 200,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                 // set focus to editable area after initializing summernote
                });
            });
        </script>
<?php include "footer.php"; ?>    
    </body>
</html>
