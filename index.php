<?php include 'includes/header.php'; ?>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="hero-badge d-inline-flex align-items-center gap-2">
                    <span class="dot"></span>
                    Award-winning video production since 2001
                </div>
                <h1>Videos that make<br>people pay attention</h1>
                <p class="hero-sub mx-auto">We write, shoot, and produce every style of video your business needs — all under one roof in our studio.</p>
                <div class="d-flex justify-content-center gap-3 hero-buttons">
                    <a href="#contact" class="btn btn-accent">Start Your Project →</a>
                    <a href="#work" class="btn btn-outline-dark rounded-pill">See Our Work</a>
                </div>
            </div>
            <div class="hero-video">
                <div class="play-overlay" id="heroPlay">
                    <div class="play-btn">
                        <svg viewBox="0 0 24 24" fill="#1a1a1a" width="24" height="24"><polygon points="8,5 20,12 8,19"/></svg>
                    </div>
                </div>
                <video muted loop playsinline id="heroVideo">
                    <source src="" type="video/mp4">
                </video>
            </div>
        </div>
    </section>

    <!-- CLIENTS -->
    <section class="clients fade-in">
        <div class="container text-center">
            <p class="clients-label">Trusted by 4,000+ businesses worldwide</p>
            <div class="client-logos d-flex justify-content-center align-items-center flex-wrap gap-5">
                <span>Bridgestone</span>
                <span>Kiplinger</span>
                <span>American Heart</span>
                <span>EyeQue</span>
                <span>Roche</span>
                <span>Eaton</span>
            </div>
        </div>
    </section>

<?php include 'includes/services.php'; ?>
<?php
$type = 'display';
$show = 6;
$columns = 3;
include 'includes/portfolio.php';
?>
<?php include 'includes/testimonials.php'; ?>
<?php include 'includes/process.php'; ?>
<?php include 'includes/cta.php'; ?>
<?php include 'includes/footer.php'; ?>
