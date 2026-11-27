<?php
session_start();
include 'header.php';
include 'menu2.php';
require_once 'config.php'; // Assumes $conn is a mysqli connection

// Use the logged-in user ID to load the active student's details.
$session_user_id = (int) ($_SESSION['user_id'] ?? 0);
$student_stmt = $conn->prepare("SELECT id, sname FROM student_registration WHERE id = ? AND status = 'Active' LIMIT 1");
$student_stmt->bind_param("i", $session_user_id);
$student_stmt->execute();
$student = $student_stmt->get_result()->fetch_assoc();
$student_stmt->close();

if (!$student) {
    exit('Active student record not found.');
}

$student_id = (int) $student['id'];
$student_name = $student['sname'];

$message = "";

// Handle booking a slot
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_slot_id'])) {
    $slot_id = intval($_POST['book_slot_id']);

    // Atomic update ensures two students don't book the same slot simultaneously
    $stmt = $conn->prepare("UPDATE tuition_slots SET status = 'booked', student_id = ?, student_name = ? WHERE id = ? AND status = 'available'");
    $stmt->bind_param("isi", $student_id, $student_name, $slot_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $message = "<div class='alert success'>Slot booked successfully!</div>";
    } else {
        $message = "<div class='alert error'>Sorry, this slot was just booked by another student or is no longer available.</div>";
    }
    $stmt->close();
}

// Fetch all upcoming available slots
$today = date('Y-m-d');
$avail_stmt = $conn->prepare("SELECT * FROM tuition_slots WHERE status = 'available' AND slot_date >= ? ORDER BY slot_date ASC, start_time ASC");
$avail_stmt->bind_param("s", $today);
$avail_stmt->execute();
$available_slots = $avail_stmt->get_result();

// Fetch student's booked slots
$my_stmt = $conn->prepare("SELECT * FROM tuition_slots WHERE student_id = ? ORDER BY slot_date ASC, start_time ASC");
$my_stmt->bind_param("i", $student_id);
$my_stmt->execute();
$my_slots = $my_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book a Tuition Slot | Excel Tuitions</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 25px; }
        h2 { color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #f8fafc; color: #334155; }
        .btn-book { background: #16a34a; color: #fff; border: none; padding: 8px 14px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-book:hover { background: #15803d; }
        .badge-confirmed { background: #dbeafe; color: #1e40af; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .alert { padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .success { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
<br><br><br>
<img src="assets/img/logo5.gif" alt="Logo" style="width: 10%; height: auto; display: block; margin: 0 auto;" />
    <div id="carouselExampleIndicators" class="carousel slide text-center" data-bs-ride="carousel">
        <h3>Student Slot Booking</h3>
    </div>



<div class="container">
    <h2>Available Tuition Slots</h2>
    <?php echo $message; ?>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Faculty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($available_slots->num_rows > 0): ?>
                <?php while ($row = $available_slots->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo date('d M Y', strtotime($row['slot_date'])); ?></td>
                        <td><?php echo date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A', strtotime($row['end_time'])); ?></td>
                        <td><strong><?php echo htmlspecialchars($row['subject']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['faculty_name']); ?></td>
                        <td>
                            <form method="POST" action="" style="margin:0;">
                                <input type="hidden" name="book_slot_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn-book" onclick="return confirm('Confirm booking for this slot?');">Book Slot</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align:center;">No open slots available right now. Please check back later.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="container">
    <h2>My Booked Sessions — <?php echo htmlspecialchars($student_name); ?></h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Subject</th>
                <th>Faculty</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($my_slots->num_rows > 0): ?>
                <?php while ($row = $my_slots->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo date('d M Y', strtotime($row['slot_date'])); ?></td>
                        <td><?php echo date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A', strtotime($row['end_time'])); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td><?php echo htmlspecialchars($row['faculty_name']); ?></td>
                        <td><span class="badge-confirmed">Confirmed</span></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align:center;">You haven't booked any sessions yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>