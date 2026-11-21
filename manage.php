<?php
require_once 'config.php';

if (!isset($conn) || !$conn) {
    die("Database connection failed.");
}

$action =$_GET['action'] ?? '';
$table =$_GET['table'] ?? '';
$id =$_GET['id'] ?? null;

if (empty($table)) {
    die("Table parameter is missing.");
}

// Fetch table structure details
$cols_query = mysqli_query($conn, "SHOW COLUMNS FROM `$table`");
if (!$cols_query) {
    die("Invalid table selected.");
}

$columns = [];$primary_key = null;

while ($col = mysqli_fetch_assoc($cols_query)) {
    $columns[] =$col;
    if ($col['Key'] === 'PRI') {
        $primary_key =$col['Field'];
    }
}

$row_data = [];$error_msg = '';

// Handle POST actions (Insert / Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posted_data =$_POST['data'] ?? [];

    if ($action === 'create') {
        $fields = [];$placeholders = [];
        $types = '';$values = [];

        foreach ($columns as$col) {
            $field =$col['Field'];
            // Skip Auto-Increment fields on insert
            if (strpos($col['Extra'], 'auto_increment') !== false) {
                continue;
            }

            if (array_key_exists($field, $posted_data)) {$val = $posted_data[$field];
                
                // Optional password hashing handle
                if (preg_match('/pass|pwd|secret/i', $field) && !empty($val)) {
                    $val = password_hash($val, PASSWORD_BCRYPT);
                }

                $fields[] = "`$field`";
                $placeholders[] = "?";
                $types .= 's';$values[] = $val === '' ? null : $val;
            }
        }

        if (!empty($fields)) {$sql = "INSERT INTO `$table` (" . implode(', ', $fields) . ") VALUES (" . implode(', ', $placeholders) . ")";
            $stmt = mysqli_prepare($conn,$sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, $types, ...$values);
                if (mysqli_stmt_execute($stmt)) {
                    header("Location: index.php?msg=" . urlencode("Record created successfully in '$table'."));
                    exit;
                } else {
                    $error_msg = "Database Error: " . mysqli_error($conn);
                }
            }
        }
    } elseif ($action === 'edit' &&$primary_key && $id !== null) {$set_clauses = [];
        $types = '';$values = [];

        foreach ($columns as$col) {
            $field =$col['Field'];
            if ($field ===$primary_key) continue; // Skip primary key updating

            if (array_key_exists($field, $posted_data)) {$val = $posted_data[$field];

                // Check password override
                if (preg_match('/pass|pwd|secret/i', $field)) {
                    if (empty($val)) {
                        continue; // Skip password update if left blank
                    }
                    $val = password_hash($val, PASSWORD_BCRYPT);
                }

                $set_clauses[] = "`$field` = ?";
                $types .= 's';$values[] = $val === '' ? null : $val;
            }
        }

        if (!empty($set_clauses)) {$sql = "UPDATE `$table` SET " . implode(', ', $set_clauses) . " WHERE `$primary_key` = ?";
            $types .= 's';
            $values[] =$id;

            $stmt = mysqli_prepare($conn,$sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, $types, ...$values);
                if (mysqli_stmt_execute($stmt)) {
                    header("Location: index.php?msg=" . urlencode("Record updated successfully in '$table'."));
                    exit;
                } else {
                    $error_msg = "Database Error: " . mysqli_error($conn);
                }
            }
        }
    }
}

// Fetch existing data for edit mode
if ($action === 'edit' && $primary_key &&$id !== null) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM `$table` WHERE `$primary_key` = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's',$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_data = mysqli_fetch_assoc($result) ?: [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($action); ?> Record - <?php echo htmlspecialchars($table); ?></title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 700px;
            margin: 30px auto;
            background: #fff;
            padding: 25px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        h2 {
            margin-top: 0;
            font-size: 20px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 13px;
        }

        input[type="text"], input[type="password"], textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            height: 80px;
            resize: vertical;
        }

        .btn-submit {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-cancel {
            margin-left: 10px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #842029;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .field-info {
            font-size: 11px;
            color: #6c757d;
            margin-top: 2px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2><?php echo ($action === 'create') ? 'Create New Record in' : 'Edit Record in'; ?> <code><?php echo htmlspecialchars($table); ?></code></h2>

    <?php if ($error_msg): ?>
        <div class="alert-error"><?php echo htmlspecialchars($error_msg); ?></div>
    <?php endif; ?>

    <form method="POST">
        <?php foreach ($columns as$col): ?>
            <?php 
            $field =$col['Field'];
            $type =$col['Type'];
            $is_auto = (strpos($col['Extra'], 'auto_increment') !== false);
            $is_pri = ($field === $primary_key);$is_password = (bool)preg_match('/pass|pwd|secret/i', $field);$val = $row_data[$field] ?? '';
            ?>

            <div class="form-group">
                <label for="field-<?php echo htmlspecialchars($field); ?>">
                    <?php echo htmlspecialchars($field); ?>
                    <span style="font-weight: normal; color: #6c757d;">(<?php echo htmlspecialchars($type); ?>)</span>
                </label>

                <?php if ($is_auto): ?>
                    <input type="text" value="<?php echo htmlspecialchars($val); ?>" disabled placeholder="(Auto Increment)">
                    <div class="field-info">Generated automatically by database</div>
                <?php elseif ($is_password): ?>
                    <input type="password" id="field-<?php echo htmlspecialchars($field); ?>" name="data[<?php echo htmlspecialchars($field); ?>]" placeholder="<?php echo $action === 'edit' ? 'Leave blank to keep unchanged' : 'Enter password'; ?>">
                <?php elseif (strpos($type, 'text') !== false): ?>
                    <textarea id="field-<?php echo htmlspecialchars($field); ?>" name="data[<?php echo htmlspecialchars($field); ?>]"><?php echo htmlspecialchars($val); ?></textarea>
                <?php else: ?>
                    <input type="text" id="field-<?php echo htmlspecialchars($field); ?>" name="data[<?php echo htmlspecialchars($field); ?>]" value="<?php echo htmlspecialchars($val); ?>">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn-submit">Save Record</button>
            <a href="index.php" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>