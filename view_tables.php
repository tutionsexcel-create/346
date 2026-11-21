<?php
// Include your existing database connection configuration
require_once 'config.php';

// Verification check for database connection variable
if (!isset($conn) || !$conn) {
    die("Database connection failed or \$conn is not set in config.php");
}

/**
 * Helper function to detect and format hashed password strings
 */
function formatPasswordValue($val) {
    if (is_null($val)) return '<span class="null-val">NULL</span>';
    
    // Convert html special chars for safe rendering
    $safe_val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    
    // Detect typical MD5 (32 hex characters)
    if (preg_match('/^[a-f0-9]{32}$/i', $val)) {
        return "<code>{$safe_val}</code> <span class=\"hash-tag\">(MD5 Hash - Non-reversible)</span>";
    }
    
    // Detect typical SHA256 (64 hex characters)
    if (preg_match('/^[a-f0-9]{64}$/i', $val)) {
        return "<code>{$safe_val}</code> <span class=\"hash-tag\">(SHA-256 Hash)</span>";
    }
    
    // Detect BCrypt ($2y$, $2a$, $2b$)
    if (preg_match('/^\$2[ayb]\$.{56}$/', $val)) {
        return "<code>" . substr($safe_val, 0, 15) . "...</code> <span class=\"hash-tag\">(BCrypt Encrypted)</span>";
    }

    return $safe_val;
}

// Fetch all table names from current database
$tables = [];
$table_result = mysqli_query($conn, "SHOW TABLES");

if ($table_result) {
    while ($row = mysqli_fetch_row($table_result)) {
        $tables[] = $row[0];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Tables Inspector & Manager</title>
    <style>
        :root {
            --bg-color: #f8f9fa;
            --text-color: #212529;
            --card-bg: #ffffff;
            --border-color: #dee2e6;
            --header-bg: #0d6efd;
            --header-text: #ffffff;
            --th-bg: #e9ecef;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-bar {
            background-color: var(--header-bg);
            color: var(--header-text);
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-bar h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .nav-links {
            margin-bottom: 20px;
            padding: 10px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
        }

        .nav-links a {
            margin-right: 12px;
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .table-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .table-card-header {
            background-color: var(--th-bg);
            padding: 12px 18px;
            font-weight: bold;
            font-size: 16px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-wrapper {
            overflow-x: auto;
            max-height: 500px;
            overflow-y: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 10px 14px;
            border-bottom: 1px solid var(--border-color);
            border-right: 1px solid var(--border-color);
            white-space: nowrap;
        }

        th {
            background-color: #f1f3f5;
            position: sticky;
            top: 0;
            z-index: 2;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f1f3f5;
        }

        .hash-tag {
            font-size: 11px;
            color: #6c757d;
            font-style: italic;
            background: #e2e3e5;
            padding: 2px 6px;
            border-radius: 4px;
            margin-left: 4px;
        }

        .null-val {
            color: #adb5bd;
            font-style: italic;
        }

        code {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            background-color: #f1f3f5;
            padding: 2px 4px;
            border-radius: 3px;
            font-size: 12px;
        }

        .btn {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
            background-color: #0d6efd;
            border-radius: 4px;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn:hover {
            background-color: #0b5ed7;
        }

        .btn-edit {
            background-color: #198754;
        }

        .btn-edit:hover {
            background-color: #157347;
        }

        .alert-success {
            padding: 12px 20px;
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
            border-radius: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-bar">
        <h1>Database Manager & Inspector</h1>
        <span>Total Tables: <?php echo count($tables); ?></span>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert-success"><?php echo htmlspecialchars($_GET['msg']); ?></div>
    <?php endif; ?>

    <?php if (!empty($tables)): ?>
        <div class="nav-links">
            <strong>Jump to table:</strong> 
            <?php foreach ($tables as $tbl): ?>
                <a href="#table-<?php echo htmlspecialchars($tbl); ?>"><?php echo htmlspecialchars($tbl); ?></a>
            <?php endforeach; ?>
        </div>

        <?php foreach ($tables as $table): ?>
            <?php
            $data_query = mysqli_query($conn, "SELECT * FROM `$table` LIMIT 100");
            $field_count = $data_query ? mysqli_num_fields($data_query) : 0;
            $row_count =$data_query ? mysqli_num_rows($data_query) : 0;                          // Detect primary key dynamically$primary_key = null;
            $fields = $data_query ? mysqli_fetch_fields($data_query) : [];
            foreach ($fields as$field) {
                if ($field->flags & MYSQLI_PRI_KEY_FLAG) {
                    $primary_key =$field->name;
                    break;
                }
            }
            ?>
            <div class="table-card" id="table-<?php echo htmlspecialchars($table); ?>">
                <div class="table-card-header">
                    <div>
                        <span>Table: <code><?php echo htmlspecialchars($table); ?></code></span>
                        <span style="font-size: 12px; font-weight: normal; color: #6c757d; margin-left: 10px;">Showing up to 100 rows</span>
                    </div>
                    <a href="manage.php?action=create&table=<?php echo urlencode($table); ?>" class="btn">+ Add New Record</a>
                </div>
                
                <div class="table-wrapper">
                    <?php if ($row_count > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <?php foreach ($fields as$field): ?>
                                        <th><?php echo htmlspecialchars($field->name); ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($data_query)): ?>
                                    <tr>
                                        <td>
                                            <?php if ($primary_key && isset($row[$primary_key])): ?>
                                                <a href="manage.php?action=edit&table=<?php echo urlencode($table); ?>&id=<?php echo urlencode($row[$primary_key]); ?>" class="btn btn-edit">Edit</a>
                                            <?php else: ?>
                                                <span class="null-val">No PK</span>
                                            <?php endif; ?>
                                        </td>
                                        <?php foreach ($fields as$field): ?>
                                            <?php 
                                            $col_name =$field->name;
                                            $val = $row[$col_name];
                                            $is_password_col = preg_match('/pass\vert{}pwd\vert{}secret\vert{}key/i',$col_name);
                                            ?>
                                            <td>
                                                <?php 
                                                if ($is_password_col && !empty($val)) {
                                                    echo formatPasswordValue($val);
                                                } else {
                                                    echo is_null($val) 
                                                        ? '<span class="null-val">NULL</span>' 
                                                        : htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
                                                }
                                                ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div style="padding: 20px; text-align: center; color: #6c757d;">No records found in this table.</div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tables found in the connected database.</p>
    <?php endif; ?>
</div>

</body>
</html>