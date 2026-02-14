<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talking Heads | Video Production Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- NAV -->
    <nav id="mainNav">
        <div class="container">
            <div class="nav-inner d-flex align-items-center justify-content-between">
                <a href="/" class="logo">Talking<span>Heads</span></a>
                <ul class="nav-links d-none d-md-flex align-items-center gap-4 list-unstyled mb-0">
                    <li><a href="#work">Work</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#testimonials">About</a></li>
                    <li><a href="#contact" class="btn btn-accent">Start a Project</a></li>
                </ul>
                <button class="mobile-menu-btn d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- MOBILE OFFCANVAS -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header">
            <a href="/" class="logo">Talking<span>Heads</span></a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column gap-3">
            <a href="#work" class="mobile-link" data-bs-dismiss="offcanvas">Work</a>
            <a href="#services" class="mobile-link" data-bs-dismiss="offcanvas">Services</a>
            <a href="#testimonials" class="mobile-link" data-bs-dismiss="offcanvas">About</a>
            <a href="#contact" class="btn btn-accent mt-3" data-bs-dismiss="offcanvas">Start a Project</a>
        </div>
    </div>
