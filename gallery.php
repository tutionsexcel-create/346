<?php
include __DIR__ . '/header.php';
include __DIR__ . '/menu.php';
?>
<?php
// gallery.php - ExcelTuitions.com Photo Gallery
$pageTitle = "Gallery | ExcelTuitions.com";

// Configure your 10 gallery items (update paths/extensions if using .png or .webp)
$images = [
    [
        'src'     => 'images/image1.jpg',
        'title'   => 'Interactive Classroom Learning',
        'caption' => 'Focused concept-building sessions led by experienced educators.'
    ],
    [
        'src'     => 'images/image2.jpg',
        'title'   => 'One-on-One Home Tuition',
        'caption' => 'Personalized attention tailored to each student’s learning pace.'
    ],
    [
        'src'     => 'images/image3.jpg',
        'title'   => 'Live Online Tutoring',
        'caption' => 'Seamless digital classes connecting students with verified teachers.'
    ],
    [
        'src'     => 'images/image4.jpg',
        'title'   => 'Board Exam Preparation Batch',
        'caption' => 'Structured revision and practice sessions for CBSE, ICSE, and State Boards.'
    ],
    [
        'src'     => 'images/image5.jpg',
        'title'   => 'Mathematics Doubt-Clearing Workshop',
        'caption' => 'Step-by-step problem solving and analytical skill development.'
    ],
    [
        'src'     => 'images/image6.jpg',
        'title'   => 'Science Practical & Concept Session',
        'caption' => 'Visual explanations that make complex topics easy to understand.'
    ],
    [
        'src'     => 'images/image7.jpg',
        'title'   => 'Small-Group Study Batch',
        'caption' => 'Collaborative peer learning with regular mentor feedback.'
    ],
    [
        'src'     => 'images/image8.jpg',
        'title'   => 'Student Progress Assessment',
        'caption' => 'Periodic mock tests and performance tracking for steady improvement.'
    ],
    [
        'src'     => 'images/image9.jpg',
        'title'   => 'Skill & Spoken English Enrichment',
        'caption' => 'Building confidence, communication, and presentation skills.'
    ],
    [
        'src'     => 'images/image10.jpg',
        'title'   => 'Parent-Tutor Academic Counseling',
        'caption' => 'Aligning study plans with student goals and school milestones.'
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <style>
        :root {
            --primary: #1e40af;
            --primary-dark: #1e3a8a;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            line-height: 1.6;
        }

        .gallery-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #ffffff;
            text-align: center;
            padding: 3.5rem 1.25rem;
        }

        .gallery-header h1 {
            font-size: 2.25rem;
            margin-bottom: 0.5rem;
        }

        .gallery-header p {
            max-width: 650px;
            margin: 0 auto;
            opacity: 0.92;
            font-size: 1.05rem;
        }

        .container {
            max-width: 1200px;
            margin: 2.5rem auto;
            padding: 0 1.25rem;
        }

        .gallery-hint {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        .gallery-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.05);
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .gallery-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
        }

        .thumb-wrapper {
            position: relative;
            width: 100%;
            height: 200px;
            background-color: #e2e8f0;
            overflow: hidden;
        }

        .thumb-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .gallery-card:hover .thumb-wrapper img {
            transform: scale(1.05);
        }

        .badge-index {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(15, 23, 42, 0.75);
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 999px;
        }

        .card-body {
            padding: 1rem 1.1rem;
        }

        .card-body h3 {
            font-size: 1.05rem;
            margin-bottom: 0.35rem;
            color: var(--text-main);
        }

        .card-body p {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        /* Lightbox Modal */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.92);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            user-select: none;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox-content {
            max-width: 900px;
            width: 100%;
            text-align: center;
            color: #ffffff;
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 72vh;
            border-radius: 10px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.45);
            object-fit: contain;
            background: #0f172a;
        }

        .lightbox-meta {
            margin-top: 1rem;
        }

        .lightbox-meta h2 {
            font-size: 1.3rem;
            margin-bottom: 0.25rem;
        }

        .lightbox-meta p {
            color: #cbd5e1;
            font-size: 0.95rem;
        }

        .lightbox-counter {
            display: inline-block;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .nav-btn,
        .close-btn {
            position: fixed;
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.25);
            cursor: pointer;
            transition: background 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-btn:hover,
        .close-btn:hover {
            background: rgba(255, 255, 255, 0.28);
        }

        .close-btn {
            top: 20px;
            right: 24px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            font-size: 1.5rem;
        }

        .nav-btn {
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.5rem;
        }

        .prev-btn {
            left: 20px;
        }

        .next-btn {
            right: 20px;
        }

        @media (max-width: 640px) {
            .nav-btn {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }
            .prev-btn { left: 10px; }
            .next-btn { right: 10px; }
        }
    </style>
</head>
<body>

<header class="gallery-header">
    <h1>Our Learning Gallery</h1>
    <p>Explore glimpses of personalized tutoring, live classes, and student milestones at ExcelTuitions.com.</p>
</header>

<main class="container">
    <p class="gallery-hint">Click any image to view full screen, then use your keyboard <strong>Left (&larr;)</strong> and <strong>Right (&rarr;)</strong> arrow keys to slide.</p>

    <div class="gallery-grid">
        <?php foreach ($images as $index => $item): ?>
            <div class="gallery-card" onclick="openLightbox(<?php echo $index; ?>)">
                <div class="thumb-wrapper">
                    <span class="badge-index"><?php echo ($index + 1) . ' / ' . count($images); ?></span>
                    <img
                        src="<?php echo htmlspecialchars($item['src']); ?>"
                        alt="<?php echo htmlspecialchars($item['title']); ?>"
                        loading="lazy"
                        onerror="this.src='https://placehold.co/600x400/e2e8f0/1e293b?text=Image+<?php echo $index + 1; ?>';"
                    >
                </div>
                <div class="card-body">
                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                    <p><?php echo htmlspecialchars($item['caption']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<!-- Lightbox Viewer -->
<div class="lightbox" id="lightbox" onclick="handleBackdropClick(event)">
    <button class="close-btn" onclick="closeLightbox()" aria-label="Close gallery">&times;</button>
    <button class="nav-btn prev-btn" onclick="changeSlide(-1)" aria-label="Previous image">&#10094;</button>

    <div class="lightbox-content">
        <img id="lightbox-img" src="" alt="">
        <div class="lightbox-meta">
            <h2 id="lightbox-title"></h2>
            <p id="lightbox-caption"></p>
            <span class="lightbox-counter" id="lightbox-counter"></span>
        </div>
    </div>

    <button class="nav-btn next-btn" onclick="changeSlide(1)" aria-label="Next image">&#10095;</button>
</div>

<script>
    const galleryData = <?php echo json_encode($images, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    let currentIndex = 0;

    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxCounter = document.getElementById('lightbox-counter');

    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function changeSlide(step) {
        currentIndex = (currentIndex + step + galleryData.length) % galleryData.length;
        updateLightbox();
    }

    function updateLightbox() {
        const item = galleryData[currentIndex];
        lightboxImg.src = item.src;
        lightboxImg.alt = item.title;
        lightboxImg.onerror = function () {
            this.src = `https://placehold.co/900x600/1e293b/f8fafc?text=Image+${currentIndex + 1}`;
        };
        lightboxTitle.textContent = item.title;
        lightboxCaption.textContent = item.caption;
        lightboxCounter.textContent = `Image ${currentIndex + 1} of ${galleryData.length}  •  Use ← / → keys to slide, ESC to close`;
    }

    function handleBackdropClick(event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    }

    // Keyboard navigation: Left/Right arrows to slide, Escape to close
    document.addEventListener('keydown', function (event) {
        if (!lightbox.classList.contains('active')) return;

        if (event.key === 'ArrowRight') {
            event.preventDefault();
            changeSlide(1);
        } else if (event.key === 'ArrowLeft') {
            event.preventDefault();
            changeSlide(-1);
        } else if (event.key === 'Escape') {
            event.preventDefault();
            closeLightbox();
        }
    });
</script>

<?php include __DIR__ . '/footer.php'; ?>
