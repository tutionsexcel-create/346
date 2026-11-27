<?php
session_start();
if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
  header("location:AdminLogin");
  exit;
}
?>

<?php
//include'header.php';
//include'menu.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --admin-ink: #172554;
        --admin-muted: #64748b;
    }
    .admin-dashboard {
        min-height: 75vh;
        padding: 1.5rem 0;
        background: radial-gradient(circle at 8% 8%, #dbeafe 0, transparent 26%),
                    radial-gradient(circle at 96% 90%, #fce7f3 0, transparent 25%), #f8fafc;
    }
    .admin-container {
        background: linear-gradient(135deg, rgba(219, 234, 254, .5), rgba(252, 231, 243, .5));
        border-radius: 1.5rem;
    }
    .admin-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(125deg, #312e81, #2563eb 58%, #06b6d4);
        border-radius: 1.5rem;
        color: #fff;
        padding: 2.25rem;
        box-shadow: 0 1.25rem 3rem rgba(37, 99, 235, .2);
    }
    .admin-header::after {
        content: "";
        position: absolute;
        width: 260px;
        height: 260px;
        right: 12%;
        top: -190px;
        border: 35px solid rgba(255, 255, 255, .1);
        border-radius: 50%;
        pointer-events: none;
    }
    .admin-header > * {
        position: relative;
        z-index: 1;
    }
    .admin-logo {
        width: 80px;
        height: 80px;
        object-fit: contain;
        padding: .5rem;
        background: #fff;
        border-radius: 1.15rem;
        box-shadow: 0 .5rem 1.25rem rgba(15, 23, 42, .15);
    }
    .admin-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid rgba(148, 163, 184, .2);
        border-radius: 1.2rem;
        background: linear-gradient(145deg, #fff, #fbfdff);
        box-shadow: 0 .5rem 1.5rem rgba(30, 41, 59, .07);
        transition: transform .22s ease, box-shadow .22s ease;
    }
    .admin-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 1rem 2rem rgba(30, 41, 59, .13);
    }
    .admin-card .card-body {
        padding: 1.75rem !important;
        border-top: 4px solid var(--card-accent, #3b82f6);
    }
    .admin-card-mark {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        border-radius: 1rem;
        background: var(--card-tint, #dbeafe);
        color: var(--card-accent, #2563eb);
        font-size: 1.2rem;
        font-weight: 700;
    }
    .admin-card h3 { color: var(--admin-ink); font-weight: 700; }
    .admin-card p { color: var(--admin-muted) !important; line-height: 1.65; }
    .admin-card .btn { border-color: var(--card-accent, #2563eb); color: var(--card-accent, #2563eb); font-weight: 600; }
    .admin-card .btn:hover { background: var(--card-accent, #2563eb); color: #fff; }
    .admin-accordion .accordion-item {
        --item-accent: #7c3aed;
        --item-tint: #ede9fe;
        overflow: hidden;
        height: 100%;
        margin-bottom: 0;
        border: 1px solid rgba(148, 163, 184, .25);
        border-left: 5px solid var(--item-accent);
        border-radius: 1rem;
        box-shadow: 0 .4rem 1rem rgba(30, 41, 59, .06);
    }
    .admin-accordion .accordion-item:nth-child(2) { --item-accent: #0891b2; --item-tint: #cffafe; }
    .admin-accordion .accordion-item:nth-child(3) { --item-accent: #16a34a; --item-tint: #dcfce7; }
    .admin-accordion .accordion-item:nth-child(4) { --item-accent: #ea580c; --item-tint: #ffedd5; }
    .admin-accordion .accordion-item:nth-child(5) { --item-accent: #db2777; --item-tint: #fce7f3; }
    .admin-accordion .accordion-button {
        padding: 1.15rem 1.4rem;
        background: var(--item-tint);
        color: var(--item-accent);
        font-weight: 700;
        box-shadow: none;
    }
    .admin-accordion .accordion-button:not(.collapsed) { background: var(--item-accent); color: #fff; }
    .admin-accordion .accordion-button:not(.collapsed)::after { filter: brightness(0) invert(1); }
    .admin-accordion .accordion-button::after { filter: saturate(1.5); }
    .admin-accordion .accordion-body { padding: 1.25rem 1.4rem; }
    .admin-accordion .accordion-body .btn {
        border-color: var(--item-accent);
        background: var(--item-accent);
        color: #fff;
        font-weight: 600;
    }
    .admin-accordion .accordion-body .btn:hover,
    .admin-accordion .accordion-body .btn:focus {
        border-color: var(--item-accent);
        background: #fff;
        color: var(--item-accent);
    }
    @media (max-width: 575.98px) {
        .admin-dashboard { padding: 2rem 0; }
        .admin-header { padding: 1.5rem; border-radius: 1.2rem; }
        .admin-logo { width: 64px; height: 64px; }
    }
</style>

<main class="admin-dashboard">
    <div class="container admin-container">
        <header class="admin-header d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-5">
            <div class="d-flex align-items-center gap-3">
                <div>                    
                    <p class="text-white-50 text-uppercase small fw-semibold mb-1">Administration</p>
                    <h1 class="h2 mb-1">Admin Panel</h1>
                    <p class="mb-0 text-white-50">Manage your website content and settings.</p>
                </div>
            </div>
            <a href="AdminLogout" class="btn btn-light fw-semibold px-4">Logout</a>
        </header>

        <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between gap-2 mb-4">
            <div>
                <h2 class="h4 mb-1">Dashboard</h2>
                <p class="text-secondary mb-0">Choose a section to manage.</p>
            </div>            
        </div>
        <div class="accordion admin-accordion row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3" id="adminSections">
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingAbout"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAbout" aria-expanded="false" aria-controls="collapseAbout">About Us</button></h3>
                <div id="collapseAbout" class="accordion-collapse collapse" aria-labelledby="headingAbout" data-bs-parent="#adminSections"><div class="accordion-body"><p class="text-secondary">Update the information shown on your About page.</p><a href="about" class="btn btn-outline-primary">Edit About Us</a></div></div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingSubjects"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubjects" aria-expanded="false" aria-controls="collapseSubjects">Subjects</button></h3>
                <div id="collapseSubjects" class="accordion-collapse collapse" aria-labelledby="headingSubjects" data-bs-parent="#adminSections"><div class="accordion-body"><p class="text-secondary">Manage the subjects available to students.</p><a href="Subject" class="btn btn-outline-primary">Manage Subjects</a></div></div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingCourses"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCourses" aria-expanded="false" aria-controls="collapseCourses">Courses</button></h3>
                <div id="collapseCourses" class="accordion-collapse collapse" aria-labelledby="headingCourses" data-bs-parent="#adminSections"><div class="accordion-body"><p class="text-secondary">Review and update your course listings.</p><a href="Courses" class="btn btn-outline-primary">Manage Courses</a></div></div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingFeedback"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFeedback" aria-expanded="false" aria-controls="collapseFeedback">Feedback</button></h3>
                <div id="collapseFeedback" class="accordion-collapse collapse" aria-labelledby="headingFeedback" data-bs-parent="#adminSections"><div class="accordion-body"><p class="text-secondary">Open the feedback management section.</p><a href="AdminPanel" class="btn btn-outline-primary">View Feedback</a></div></div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingPassword"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePassword" aria-expanded="false" aria-controls="collapsePassword">Password</button></h3>
                <div id="collapsePassword" class="accordion-collapse collapse" aria-labelledby="headingPassword" data-bs-parent="#adminSections"><div class="accordion-body"><p class="text-secondary">Open account password settings.</p><a href="AdminPanel" class="btn btn-outline-primary">Change Password</a></div></div>
            </div>
        </div>
    </div>
</main>

<?php
//include'footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
