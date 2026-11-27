<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<br>
<br>
<br>
<br>
<main class="quick-links-page">
	<h1>Quick Links</h1>

	<section aria-labelledby="menu-links-title">
		<h2 id="menu-links-title">Quick Links</h2>
		<style>
		.quick-links-page .quick-link-button {
			display: block;
			padding: 0.75rem 1rem;
			color: #fff;
			border-radius: 6px;
			text-align: center;
			text-decoration: none;
		}

		.quick-links-page .quick-link-button:hover {
			filter: brightness(0.9);
		}

		.quick-links-page .quick-link-grid {
			display: grid;
			grid-template-columns: repeat(4, minmax(0, 1fr));
			gap: 0.75rem 1.5rem;
			list-style: none;
			padding: 0;
		}

		@media (max-width: 900px) {
			.quick-links-page .quick-link-grid {
				grid-template-columns: repeat(2, minmax(0, 1fr));
			}
		}

		@media (max-width: 480px) {
			.quick-links-page .quick-link-grid {
				grid-template-columns: 1fr;
			}
		}
	</style>
	<ul class="quick-link-grid">
			<li><a href="index" class="quick-link-button" style="background: #2563eb;">Home</a></li>
			<li><a href="about_us" class="quick-link-button" style="background: #9333ea;">About</a></li>
			<li><a href="#" class="quick-link-button" style="background: #ea580c;">Slot Booking</a></li>
			<li><a href="for_student" class="quick-link-button" style="background: #0891b2;">For Student</a></li>
			<li><a href="for_faculty" class="quick-link-button" style="background: #16a34a;">For Faculty</a></li>
			<li><a href="find_faculty" class="quick-link-button" style="background: #db2777;">Find a Teacher</a></li>
			<li><a href="find_class" class="quick-link-button" style="background: #4f46e5;">Find a Class</a></li>
			<li><a href="#" class="quick-link-button" style="background: #7c3aed;">Administration</a></li>
			<li><a href="course" class="quick-link-button" style="background: #0284c7;">Courses/Subjects</a></li>
			<li><a href="SRegistration" class="quick-link-button" style="background: #65a30d;">Student Registration</a></li>
			<li><a href="Faculty-Registration" class="quick-link-button" style="background: #c026d3;">Faculty Registration</a></li>
			<li><a href="Faculty-Login" class="quick-link-button" style="background: #0d9488;">Faculty Login</a></li>
			<li><a href="admissions" class="quick-link-button" style="background: #ca8a04;">Admissions</a></li>
			<li><a href="quick_links" class="quick-link-button" style="background: #e11d48;">Quick Links</a></li>
			<li><a href="#services" class="quick-link-button" style="background: #57534e;">Gallery</a></li>
			<li>
				<?php if (isset($_SESSION['user_id'])): ?>
					<a href="logout" class="quick-link-button" style="background: #dc2626;">Logout</a>
				<?php else: ?>
					<a href="Login" class="quick-link-button" style="background: #16a34a;">Login</a>
				<?php endif; ?>
			</li>
			<li><a href="#contact" class="quick-link-button" style="background: #1d4ed8;">Contact</a></li>
		</ul>
	</section>

	
</main>

<?php include 'footer.php'; ?>
