<?php include 'header.php'; ?>
<?php
ob_start();
include 'menu.php';
$menuHtml = ob_get_clean();
echo $menuHtml;
$showStudentLogin = preg_match('/\bLogout\b/i', strip_tags($menuHtml)) === 0
	&& preg_match('/\bLogin\b/i', strip_tags($menuHtml)) === 1;
?>
<section id="hero" class="hero section">
    <div class="page-title light-background">
        <div class="container">
            <img src="assets/img/logo5.gif" alt="Logo" style="width: 10%; height: auto; display: block; margin: 0 auto;" />
            <h1 style="text-align: center; margin-top: 10px;">                
            </h1>
            <nav class="breadcrumbs" style="text-align: center; margin-bottom: 20px;">
                <ol style="list-style: none; padding: 0; display: inline-flex; gap: 10px;">
                    <li><a href="index" style="text-decoration: none; color: #036;">Home</a></li>
                    <li style="color: #555;">For Student Slot Booking</li>
                </ol>
            </nav>
        </div>
        <p><h2>Student Slot Booking</h2><br /></p>
<div class="container">
    <p> The slot booking system allows students to view real-time availability of tutors and reserve a dedicated one-on-one or small-group learning session at a time that fits their schedule—eliminating back-and-forth messaging and preventing double-bookings.</p>
</div>
</div>
<main class="container">
	<h2>How to Book a Slot (Step-by-Step Process)</h2>

	<ol>
		<li>
			<h2>Log In to Your Student Account</h2>
			<p>Sign in to <strong>exceltuitions.com</strong> using your registered student credentials so your bookings are linked to your profile.</p>
		</li>
		<li>
			<h2>Browse Available Slots</h2>
			<p>Open the <strong>Book a Tuition Slot</strong> page to view a live schedule of open sessions published by faculty members, including the <strong>Date</strong>, <strong>Time</strong>, <strong>Subject</strong>, and <strong>Faculty Name</strong>.</p>
		</li>
		<li>
			<h2>Select Your Preferred Session</h2>
			<p>Find a subject and time slot that matches your availability and click the <strong>Book Slot</strong> button next to that session.</p>
		</li>
		<li>
			<h2>Confirm Your Booking</h2>
			<p>Approve the confirmation prompt. Once confirmed, the slot is immediately reserved under your name and removed from the public availability list so no one else can claim it.</p>
		</li>
		<li>
			<h2>View Your Scheduled Sessions</h2>
			<p>Scroll down to the <strong>My Booked Sessions</strong> section on the same page to verify your confirmed date, time, and tutor details ahead of your class.</p>
		</li>
	</ol>

	<section aria-labelledby="student-faq-heading">
		<h2 id="student-faq-heading">Frequently Asked Questions (Student Guide)</h2>

		<h3>Booking Your Sessions</h3>
		<h3>1. How do I book a tuition slot?</h3>
		<p>Log in to your student account on <strong>exceltuitions.com</strong> and open the <strong>Book a Tuition Slot</strong> page. Browse the list of available sessions by subject, date, and tutor, then click <strong>Book Slot</strong> next to your preferred time and confirm. Your reservation is locked in immediately.</p>

		<h3>2. How far in advance should I book a session?</h3>
		<p>We recommend booking at least <strong>24 hours in advance</strong> to secure your preferred tutor and time slot, though you can book any open slot listed on the schedule right up until the session start time.</p>

		<h3>3. Can I book multiple sessions in a week?</h3>
		<p>Yes. You can book as many available sessions as you need across different subjects or dates, provided the time slots do not overlap.</p>

		<h3>4. Where can I see my confirmed bookings?</h3>
		<p>All your upcoming classes appear under the <strong>My Booked Sessions</strong> section on your booking dashboard, showing the confirmed date, time, subject, and faculty name.</p>

		<h3>Rescheduling &amp; Cancellations</h3>
		<h3>5. What if I need to reschedule or cancel a booked slot?</h3>
		<p>If your plans change, please cancel or request a reschedule at least <strong>12 to 24 hours before</strong> your scheduled start time. Canceling early frees up the slot so another student can use it, and allows you to pick a new time that works better for you.</p>

		<h3>6. How do I pick a new time after canceling?</h3>
		<p>Once your previous booking is canceled, simply return to the <strong>Available Tuition Slots</strong> list and select any open date and time that fits your schedule.</p>

		<h3>7. What happens if my tutor needs to reschedule?</h3>
		<p>In the rare event a tutor is unavailable due to an emergency, you will be notified promptly and assisted in moving your session to the next earliest available slot.</p>

		<h3>Attendance &amp; Class Guidelines</h3>
		<h3>8. How do I join my scheduled session?</h3>
		<p>Log in to your student dashboard <strong>5 to 10 minutes before</strong> your session start time. Your session details and joining instructions will be available under <strong>My Booked Sessions</strong>.</p>

		<h3>9. What should I prepare before joining a class?</h3>
		<p>Have your school textbooks, class notes, recent assignments, and a list of specific topics or questions you want to cover ready before the session begins so you get the most out of your time.</p>

		<h3>10. What happens if I am running late or miss a session?</h3>
		<p>Your tutor will wait for the first <strong>10 to 15 minutes</strong> of the scheduled slot. If you join late, the session will still conclude at the originally scheduled end time so subsequent students are not delayed. Unnotified missed sessions may be counted as completed.</p>
	</section>

	<?php if ($showStudentLogin): ?>
		<p><a class="btn btn-primary" href="Login.php">Student Login</a></p>
	<?php else: ?>
		<p><a class="btn btn-primary" href="dashboard.php">Back to Dashboard</a></p>
	<?php endif; ?>
</main>

<?php include 'footer.php'; ?>
