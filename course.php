<?php
include 'config.php';
include 'header.php';
include 'menu.php';

$subjects = $conn->query("SELECT subject_name FROM subjects WHERE status = 1");
?>
<br>
<br>
<br>
<br>
<main>
	<h1>Subjects</h1>
	<?php if ($subjects && $subjects->num_rows > 0): ?>
		<ul>
			<?php while ($subject = $subjects->fetch_assoc()): ?>
				<li><?= htmlspecialchars($subject['subject_name'], ENT_QUOTES, 'UTF-8') ?></li>
			<?php endwhile; ?>
		</ul>
	<?php else: ?>
		<p>No subjects available.</p>
	<?php endif; ?>

	<section class="course-content">
		<h2>Build Knowledge. Gain Confidence. Excel.</h2>
		<p>Our courses are designed to help students understand key concepts, improve problem-solving skills, and prepare confidently for exams. Choose a subject from the list above to begin your learning journey.</p>
	</section>
</main>


<?php include 'footer.php'; ?>
