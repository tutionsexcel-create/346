<?php
session_start();
require_once 'config.php'; // Assumes $conn is a mysqli connection

// Replace with your actual session variables after login
$faculty_id   = $_SESSION['user_id'] ?? 1; 
$faculty_name = $_SESSION['user_name'] ?? 'Prof. Sharma';

$message = "";

// Handle adding a new slot
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_slot'])) {
    $subject    = trim($_POST['subject']);
    $slot_date  = $_POST['slot_date'];
    $start_time = $_POST['start_time'];
    $end_time   = $_POST['end_time'];

    if (!empty($subject) && !empty($slot_date) && !empty($start_time) && !empty($end_time)) {
        $stmt = $conn->prepare("INSERT INTO tuition_slots (faculty_id, faculty_name, subject, slot_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $faculty_id, $faculty_name, $subject, $slot_date, $start_time, $end_time);
        
        if ($stmt->execute()) {
            $message = "<div class='alert success'>Slot published successfully!</div>";
        } else {
            $message = "<div class='alert error'>Error adding slot: " . $conn->error . "</div>";
        }
        $stmt->close();
    }
}

// Handle deleting an unbooked slot
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $stmt = $conn->prepare("DELETE FROM tuition_slots WHERE id = ? AND faculty_id = ? AND status = 'available'");
    $stmt->bind_param("ii", $delete_id, $faculty_id);
    $stmt->execute();
    $stmt->close();
    header("Location: faculty_slots.php");
    exit;
}

// Fetch faculty's slots
$stmt = $conn->prepare("SELECT * FROM tuition_slots WHERE faculty_id = ? ORDER BY slot_date ASC, start_time ASC");
$stmt->bind_param("i", $faculty_id);
$stmt->execute();
$slots = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faculty Slot Manager | Excel Tuitions</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        h2 { color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px; margin-bottom: 20px; }
        .form-group label { display: block; font-size: 13px; font-weight: bold; margin-bottom: 5px; color: #475569; }
        .form-group input { width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        .btn { background: #2563eb; color: #fff; border: none; padding: 10px 18px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn:hover { background: #1d4ed8; }
        .btn-danger { background: #dc2626; padding: 5px 10px; font-size: 12px; text-decoration: none; color: #fff; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #f8fafc; color: #334155; }
        .badge-avail { background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .badge-booked { background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .success { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

<div class="container">
    <h2>Publish Availability Slot — <?php echo htmlspecialchars($faculty_name); ?></h2>
    <?php echo $message; ?>

    <form method="POST" action="">
        <div class="form-grid">
            <div class="form-group">
                <label>Subject / Topic</label>
                <input type="text" name="subject" placeholder="e.g. Mathematics / PHP" required>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="slot_date" min="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <div class="form-group">
                <label>Start Time</label>
                <input type="time" name="start_time" required>
            </div>
            <div class="form-group">
                <label>End Time</label>
                <input type="time" name="end_time" required>
            </div>
        </div>
        <button type="submit" name="add_slot" class="btn">Publish Slot</button>
    </form>

    <h2>Your Scheduled Slots</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Booked By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($slots->num_rows > 0): ?>
                <?php while ($row = $slots->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo date('d M Y', strtotime($row['slot_date'])); ?></td>
                        <td><?php echo date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A', strtotime($row['end_time'])); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td>
                            <?php if ($row['status'] === 'available'): ?>
                                <span class="badge-avail">Available</span>
                            <?php else: ?>
                                <span class="badge-booked">Booked</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $row['student_name'] ? htmlspecialchars($row['student_name']) : '—'; ?></td>
                        <td>
                            <?php if ($row['status'] === 'available'): ?>
                                <a href="?delete_id=<?php echo $row['id']; ?>" class="btn-danger" onclick="return confirm('Remove this slot?');">Remove</a>
                            <?php else: ?>
                                <small style="color:#64748b;">Locked</small>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;">No slots created yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>