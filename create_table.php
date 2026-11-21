<?php
// Include database connection
require_once 'config.php';

if (!isset($conn) || !$conn) {
    die("Database connection failed or \$conn is not set in config.php");
}

$error_msg = '';
$success_msg = '';$sql_query_result = null;
$executed_sql = '';

// Data types list for the dropdown
$data_types = [
    'INT', 'VARCHAR', 'TEXT', 'DATE', 'DATETIME', 'TIMESTAMP', 
    'TINYINT', 'BIGINT', 'DECIMAL', 'FLOAT', 'BOOLEAN', 'LONGTEXT', 'BLOB'
];

// 1. Handle SQL Box Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) &&$_POST['action'] === 'run_sql') {
    $executed_sql = trim($_POST['sql_query'] ?? '');
    if (!empty($executed_sql)) {
        // Multi-query or single query execution
        $result = mysqli_query($conn,$executed_sql);
        if ($result === true) {$affected_rows = mysqli_affected_rows($conn);$success_msg = "Query executed successfully. (Affected rows: {$affected_rows})";
        } elseif ($result instanceof mysqli_result) {
            $sql_query_result =$result;
            $success_msg = "Query executed successfully. Returned " . mysqli_num_rows($result) . " rows.";
        } else {
            $error_msg = "SQL Execution Error: " . mysqli_error($conn);
        }
    } else {
        $error_msg = "Please enter an SQL query to execute.";
    }
}

// 2. Handle CREATE TABLE Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) &&$_POST['action'] === 'create_table') {
    $table_name = trim($_POST['table_name'] ?? '');
    $columns =$_POST['columns'] ?? [];

    $clean_table_name = preg_replace('/[^a-zA-Z0-9_]/', '',$table_name);

    if (empty($clean_table_name)) {$error_msg = 'Please provide a valid table name.';
    } elseif (empty($columns)) {$error_msg = 'At least one column is required to create a table.';
    } else {
        $col_definitions = [];$primary_keys = [];

        foreach ($columns as$col) {
            $col_name = preg_replace('/[^a-zA-Z0-9_]/', '', trim($col['name'] ?? ''));
            $col_type = strtoupper(trim($col['type'] ?? 'VARCHAR'));
            $col_length = trim($col['length'] ?? '');
            $col_null = isset($col['null']) && $col['null'] === '1' ? 'NULL' : 'NOT NULL';$col_ai = isset($col['ai']) &&$col['ai'] === '1' ? 'AUTO_INCREMENT' : '';
            $col_default = trim($col['default'] ?? '');

            if (empty($col_name)) continue;

            $type_def =$col_type;
            if ($col_length !== '' && !in_array($col_type, ['TEXT', 'LONGTEXT', 'DATE', 'DATETIME', 'TIMESTAMP', 'BLOB'])) {
                $type_def .= "({$col_length})";
            }

            $default_def = '';
            if ($col_default !== '') {
                if (in_array(strtoupper($col_default), ['CURRENT_TIMESTAMP', 'NULL'])) {
                    $default_def = "DEFAULT " . strtoupper($col_default);
                } else {
                    $default_def = "DEFAULT '" . mysqli_real_escape_string($conn,$col_default) . "'";
                }
            }

            $col_sql = "`{$col_name}` {$type_def} {$col_null} {$col_ai} {$default_def}";
            $col_definitions[] = trim($col_sql);

            if (isset($col['pk']) && $col['pk'] === '1') {$primary_keys[] = "`{$col_name}`";
            }
        }

        if (empty($col_definitions)) {$error_msg = 'Please define at least one valid column with a name.';
        } else {
            if (!empty($primary_keys)) {$col_definitions[] = "PRIMARY KEY (" . implode(', ', $primary_keys) . ")";
            }

            $create_sql = "CREATE TABLE `{$clean_table_name}` (\n  " . implode(",\n  ", $col_definitions) . "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

            if (mysqli_query($conn,$create_sql)) {
                header("Location: index.php?msg=" . urlencode("Table '{$clean_table_name}' created successfully!"));
                exit;
            } else {
                $error_msg = "Database Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Table & SQL Query Box</title>
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
            max-width: 1250px;
            margin: 0 auto;
        }

        .header-bar {
            background-color: var(--header-bg);
            color: var(--header-text);
            padding: 15px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-bar h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
            margin-bottom: 25px;
        }

        .card-header {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--header-bg);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-meta-group {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-meta-group label {
            font-weight: 600;
        }

        input[type="text"], select, textarea {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .input-table-name { width: 300px; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid var(--border-color);
        }

        th {
            background-color: var(--th-bg);
            font-weight: 600;
            font-size: 13px;
        }

        tr:nth-child(even) { background-color: #f8f9fa; }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            background-color: #0d6efd;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover { background-color: #0b5ed7; }
        .btn-success { background-color: #198754; }
        .btn-success:hover { background-color: #157347; }
        .btn-danger { background-color: #dc3545; padding: 4px 8px; font-size: 12px; }
        .btn-danger:hover { background-color: #bb2d3b; }
        .btn-secondary { background-color: #6c757d; }
        .btn-secondary:hover { background-color: #5c636a; }

        .btn-sm-template {
            padding: 3px 8px;
            font-size: 11px;
            background: #e9ecef;
            color: #212529;
            border: 1px solid #ced4da;
            border-radius: 3px;
            cursor: pointer;
            margin-left: 5px;
        }
        .btn-sm-template:hover { background: #dee2e6; }

        .sql-textarea {
            width: 100%;
            height: 120px;
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 13px;
            line-height: 1.5;
            background-color: #212529;
            color: #f8f9fa;
            padding: 12px;
            border-radius: 4px;
            resize: vertical;
        }

        .alert-error {
            padding: 12px 20px;
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            padding: 12px 20px;
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .text-center { text-align: center; }

        .query-results-wrapper {
            overflow-x: auto;
            max-height: 400px;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-bar">
        <h1>Database Tools: Table Builder &amp; Query Console</h1>
        <a href="view_tables" class="btn btn-secondary"> Back to Table Viewer</a>
    </div>

    <?php if ($error_msg): ?>
        <div class="alert-error"><?php echo htmlspecialchars($error_msg); ?></div>
    <?php endif; ?>

    <?php if ($success_msg): ?>
        <div class="alert-success"><?php echo htmlspecialchars($success_msg); ?></div>
    <?php endif; ?>

    <!-- SECTION 1: CREATE TABLE BUILDER -->
    <div class="card">
        <div class="card-header">
            <span>+ Create New Table (phpMyAdmin Builder)</span>
        </div>

        <form method="POST" action="create_table.php" id="createTableForm">
            <input type="hidden" name="action" value="create_table">

            <div class="table-meta-group">
                <label for="table_name">Table Name:</label>
                <input type="text" id="table_name" name="table_name" class="input-table-name" placeholder="e.g., categories, orders" required autocomplete="off">
            </div>

            <table id="columnsTable">
                <thead>
                    <tr>
                        <th>Column Name</th>
                        <th>Type</th>
                        <th>Length / Values</th>
                        <th>Default</th>
                        <th class="text-center">Primary Key</th>
                        <th class="text-center">Null</th>
                        <th class="text-center">Auto Increment (A_I)</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="columnsBody">
                    <!-- Dynamic column rows inserted by Javascript -->
                </tbody>
            </table>

            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <button type="button" class="btn btn-secondary" onclick="addColumnRow()">+ Add Column</button>
                    <button type="button" class="btn btn-secondary" onclick="addBulkColumns(5)">+ Add 5 Columns</button>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Save &amp; Create Table</button>
                </div>
            </div>
        </form>
    </div>

    <!-- SECTION 2: RAW SQL QUERY EXECUTOR -->
    <div class="card">
        <div class="card-header">
            <span> Run Custom SQL Query</span>
            <div>
                <span style="font-size: 12px; font-weight: normal; margin-right: 5px;">Quick Templates:</span>
                <button type="button" class="btn-sm-template" onclick="setSqlTemplate('SELECT')">SELECT</button>
                <button type="button" class="btn-sm-template" onclick="setSqlTemplate('INSERT')">INSERT</button>
                <button type="button" class="btn-sm-template" onclick="setSqlTemplate('UPDATE')">UPDATE</button>
                <button type="button" class="btn-sm-template" onclick="setSqlTemplate('CREATE')">CREATE</button>
            </div>
        </div>

        <form method="POST" action="create_table.php">
            <input type="hidden" name="action" value="run_sql">
            <div style="margin-bottom: 12px;">
                <textarea name="sql_query" id="sql_query" class="sql-textarea" placeholder="Enter your SQL query here... (e.g., SELECT * FROM users LIMIT 10);"><?php echo htmlspecialchars($executed_sql); ?></textarea>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 12px; color: #6c757d;">Press execute to run DDL or DML query directly on database.</span>
                <button type="submit" class="btn btn-success">▶ Execute SQL</button>
            </div>
        </form>

        <!-- Display Select Query Results -->
        <?php if ($sql_query_result && mysqli_num_rows($sql_query_result) > 0): ?>
            <div class="query-results-wrapper">
                <table>
                    <thead>
                        <tr>
                            <?php 
                            $fields = mysqli_fetch_fields($sql_query_result);
                            foreach ($fields as$field): 
                            ?>
                                <th><?php echo htmlspecialchars($field->name); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($sql_query_result)): ?>
                            <tr>
                                <?php foreach ($fields as$field): ?>
                                    <td>
                                        <?php 
                                        $val = $row[$field->name];
                                        echo is_null($val) ? '<span style="color:#adb5bd; font-style:italic;">NULL</span>' : htmlspecialchars($val); 
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
let colIndex = 0;
const dataTypes = <?php echo json_encode($data_types); ?>;

function addColumnRow(isPrimaryDefault = false) {
    const tbody = document.getElementById('columnsBody');
    const tr = document.createElement('tr');
    tr.id = `row_${colIndex}`;

    let typeOptions = dataTypes.map(t => `<option value="${t}">${t}</option>`).join('');

    tr.innerHTML = `
        <td>
            <input type="text" name="columns[${colIndex}][name]" placeholder="col_name" required style="width: 100%;">
        </td>
        <td>
            <select name="columns[${colIndex}][type]" style="width: 100%;">
                ${typeOptions}
            </select>
        </td>
        <td>
            <input type="text" name="columns[${colIndex}][length]" placeholder="e.g., 255" style="width: 90px;">
        </td>
        <td>
            <input type="text" name="columns[${colIndex}][default]" placeholder="NULL / Value" style="width: 120px;">
        </td>
        <td class="text-center">
            <input type="checkbox" name="columns[${colIndex}][pk]" value="1" ${isPrimaryDefault ? 'checked' : ''}>
        </td>
        <td class="text-center">
            <input type="checkbox" name="columns[${colIndex}][null]" value="1"> Null
        </td>
        <td class="text-center">
            <input type="checkbox" name="columns[${colIndex}][ai]" value="1" ${isPrimaryDefault ? 'checked' : ''}>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger" onclick="removeColumnRow(${colIndex})">✕</button>
        </td>
    `;

    tbody.appendChild(tr);
    colIndex++;
}

function removeColumnRow(idx) {
    const row = document.getElementById(`row_${idx}`);
    if (row) row.remove();
}

function addBulkColumns(count) {
    for (let i = 0; i < count; i++) {
        addColumnRow();
    }
}

function setSqlTemplate(type) {
    const sqlInput = document.getElementById('sql_query');
    switch (type) {
        case 'SELECT':
            sqlInput.value = "SELECT * FROM `table_name` LIMIT 100;";
            break;
        case 'INSERT':
            sqlInput.value = "INSERT INTO `table_name` (`col1`, `col2`) VALUES ('val1', 'val2');";
            break;
        case 'UPDATE':
            sqlInput.value = "UPDATE `table_name` SET `col1` = 'val1' WHERE `id` = 1;";
            break;
        case 'CREATE':
            sqlInput.value = "CREATE TABLE `new_table` (\n  `id` INT AUTO_INCREMENT PRIMARY KEY,\n  `title` VARCHAR(255) NOT NULL\n) ENGINE=InnoDB;";
            break;
    }
}

// Default initial rows on load
window.addEventListener('DOMContentLoaded', () => {
    addColumnRow(true); // id row
    const firstRowName = document.querySelector('#row_0 input[name="columns[0][name]"]');
    const firstRowLength = document.querySelector('#row_0 input[name="columns[0][length]"]');
    if (firstRowName) firstRowName.value = 'id';
    if (firstRowLength) firstRowLength.value = '11';

    addBulkColumns(3); // 3 blank rows
});
</script>

</body>
</html>