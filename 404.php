<?php
declare(strict_types=1);

http_response_code(404);
include __DIR__ . '/includes/header.php';
?>

    <section class="hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="section-label">404</div>
                <h1>Page not found</h1>
                <p class="hero-sub mx-auto">The page you’re looking for doesn’t exist or has moved.</p>
                <a href="/" class="btn btn-accent mt-3">Back to home</a>
            </div>
        </div>
    </section>

<?php include __DIR__ . '/includes/footer.php'; ?>
