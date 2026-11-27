<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<br>
<br>
<main class="admissions-page">
	<style>
		.admissions-page { color: #243047; line-height: 1.65; }
		.admissions-page *, .admissions-page *::before, .admissions-page *::after { box-sizing: border-box; }
		.admissions-wrap { width: min(1100px, 92%); margin: 0 auto; }
		.admissions-hero { padding: 64px 20px; text-align: center; background: #f1f6ff; }
		.admissions-hero h1 { margin: 0 0 14px; color: #153b73; font-size: clamp(2rem, 5vw, 3.2rem); line-height: 1.2; }
		.admissions-hero p { max-width: 800px; margin: 0 auto 24px; }
		.admissions-cta { display: inline-block; margin: 6px; padding: 12px 20px; border-radius: 6px; background: #1769aa; color: #fff; text-decoration: none; font-weight: 700; }
		.admissions-cta:hover { background: #104f84; color: #fff; }
		.admissions-cta.secondary { background: #fff; color: #1769aa; border: 1px solid #1769aa; }
		.admissions-section { padding: 42px 0; }
		.admissions-section h2 { margin: 0 0 18px; color: #153b73; }
		.admissions-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 18px; }
		.admissions-card { height: 100%; padding: 22px; border: 1px solid #e1e8f0; border-radius: 9px; background: #fff; }
		.admissions-card h3 { margin-top: 0; color: #1769aa; }
		.admissions-steps { margin: 0; padding-left: 24px; }
		.admissions-steps li { padding: 0 0 18px 8px; }
		.admissions-note { padding: 18px 20px; border-left: 4px solid #35a36b; background: #f0faf4; border-radius: 4px; }
		.admissions-form { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
		.admissions-form label { display: block; font-weight: 600; }
		.admissions-form input, .admissions-form select, .admissions-form textarea { width: 100%; margin-top: 6px; padding: 11px; border: 1px solid #cbd5e1; border-radius: 5px; font: inherit; }
		.admissions-form textarea { min-height: 100px; resize: vertical; }
		.admissions-form .full-width { grid-column: 1 / -1; }
		.admissions-form button { padding: 12px 20px; border: 0; border-radius: 6px; background: #1769aa; color: #fff; font: inherit; font-weight: 700; cursor: pointer; }
		@media (max-width: 600px) { .admissions-form { grid-template-columns: 1fr; } .admissions-form .full-width { grid-column: auto; } }
	</style>

	<section class="admissions-hero">
		<div class="admissions-wrap">
			<h1>Start Your Learning Journey with the Right Guidance</h1>
			<p>Simple online admissions for personalized one-on-one tuition and live academic batches. Enroll in home tuition, live online tutoring, or structured group classes through a clear, supportive process.</p>
			<a class="admissions-cta" href="#admission-form">Apply for Admission</a>
			<a class="admissions-cta secondary" href="#admission-form">Book a Free Demo Class</a>
		</div>
	</section>

	<div class="admissions-wrap">
		<section class="admissions-section">
			<h2>Who Can Apply</h2>
			<div class="admissions-grid">
				<article class="admissions-card">
					<h3>School Students (Grades 1–12)</h3>
					<p>Academic support across CBSE, ICSE, State Boards, IGCSE, and IB curricula.</p>
				</article>
				<article class="admissions-card">
					<h3>Board &amp; Competitive Exam Aspirants</h3>
					<p>Targeted preparation batches, test series, and doubt-clearing programs.</p>
				</article>
				<article class="admissions-card">
					<h3>Skill &amp; Enrichment Learners</h3>
					<p>Spoken English, coding, mental math, and foundational workshops.</p>
				</article>
			</div>
		</section>

		<section class="admissions-section">
			<h2>Our 4-Step Admission Process</h2>
			<ol class="admissions-steps">
				<li><strong>Submit your admission inquiry:</strong> Share student details, grade, academic board, subjects, and preferred learning mode.</li>
				<li><strong>Get academic counseling and tutor matching:</strong> We review your goals and recommend suitable tutors or upcoming batches for your schedule and budget.</li>
				<li><strong>Attend a demo session:</strong> Try a class and confirm the teaching style, syllabus clarity, and student comfort before deciding.</li>
				<li><strong>Confirm your seat and start classes:</strong> Complete fee confirmation, receive your timetable, and begin regular sessions.</li>
			</ol>
		</section>

		<section class="admissions-section admissions-faq">
			<h2>Admissions Frequently Asked Questions — ExcelTuitions.com</h2>

			<h3>Eligibility &amp; Enrollment</h3>
			<div class="admissions-faq-list">
				<article>
					<h4>1. Who is eligible to apply for admission on ExcelTuitions.com?</h4>
					<p>Students from Grades 1 to 12 across CBSE, ICSE, State Boards, IGCSE, and IB, as well as competitive exam aspirants and skill-course learners, can apply for one-on-one tuition or live group batches.</p>
				</article>
				<article>
					<h4>2. When are admissions open?</h4>
					<p>Admissions for one-on-one home tuition and live online tutoring remain open year-round. Group batches and exam crash courses follow scheduled start dates listed on the <strong>Find a Class</strong> page.</p>
				</article>
				<article>
					<h4>3. What details or documents are required during admission?</h4>
					<p>To initiate admission, you only need basic student details (name, grade, school board, preferred subjects) and parent/guardian contact information. No complex paperwork is required at the inquiry stage.</p>
				</article>
				<article>
					<h4>4. How long does the admission process take?</h4>
					<p>Once you submit an admission inquiry, tutor matching or batch counseling typically takes 24 to 48 hours, followed by a demo session before final seat confirmation.</p>
				</article>
			</div>

			<h3>Demo Classes, Batches &amp; Flexibility</h3>
			<div class="admissions-faq-list">
				<article>
					<h4>5. Is a demo class mandatory before confirming admission?</h4>
					<p>It is optional, though strongly recommended. Attending a demo session lets students and parents check the teacher's explanation style, pacing, and syllabus alignment before paying regular fees.</p>
				</article>
				<article>
					<h4>6. Can a student enroll mid-term or mid-session?</h4>
					<p>Yes. One-on-one tuition starts whenever you are ready, and mid-term learners in group batches receive syllabus catch-up support and topic summaries to stay on track.</p>
				</article>
				<article>
					<h4>7. Can we change class timings or switch modes after admission?</h4>
					<p>Yes. Subject to tutor or batch availability, you can request schedule adjustments, switch between online and home tuition, or transfer to another suitable batch.</p>
				</article>
			</div>

			<h3>Fees, Seat Confirmation &amp; Refunds</h3>
			<div class="admissions-faq-list">
				<article>
					<h4>8. Is there any registration or application fee to apply?</h4>
					<p>Submitting an admission inquiry and scheduling your initial consultation or demo request carries no upfront application fee.</p>
				</article>
				<article>
					<h4>9. How is a seat confirmed after the demo class?</h4>
					<p>Once you approve the tutor or batch after your demo session, you receive your fee summary and finalized timetable. Completing the tuition fee payment confirms your admission.</p>
				</article>
				<article>
					<h4>10. What happens if a student needs to discontinue or pause classes?</h4>
					<p>You can notify support or your coordinator in advance to pause upcoming billing cycles or request a tutor replacement if your learning needs change.</p>
				</article>
			</div>
		</section>
	</div>
</main>

<?php include 'footer.php'; ?>
