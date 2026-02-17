<?php
declare(strict_types=1);

$path_prefix = '../';
require_once __DIR__ . '/../includes/connect-videos.php';
require_once __DIR__ . '/../includes/video_schema_vimeo.php';
require_once __DIR__ . '/../includes/video-types.php';

$products = [
    ['slug' => 'whiteboard', 'title' => 'Whiteboard Videos', 'bullets' => ['30 sec video - $199', '60 sec video - $399', 'Engaging hand-drawn style']],
    ['slug' => 'animation', 'title' => 'Explainer Videos', 'bullets' => ['30–60 sec custom animations', 'Clear, compelling storytelling', 'Custom pricing']],
    ['slug' => 'presentation', 'title' => 'Spokesperson Videos', 'bullets' => ['Green screen production', 'Multiple format options', 'Professional delivery']],
    ['slug' => 'animation', 'title' => 'Custom Animated Videos', 'bullets' => ['2D and 3D animation', 'Motion graphics', 'Brand-aligned design']],
    ['slug' => 'testimonials', 'title' => 'Testimonial Videos', 'bullets' => ['Customer success stories', 'Authentic endorsements', 'Build trust']],
    ['slug' => 'product', 'title' => 'Product Videos', 'bullets' => ['Demo and feature highlights', 'Product showcases', 'Conversion-focused']],
    ['slug' => 'motion', 'title' => 'Motion Graphics', 'bullets' => ['Titles and lower thirds', 'Data visualization', 'Kinetic typography']],
    ['slug' => 'logo', 'title' => 'Animated Logos', 'bullets' => ['Logo animation', 'Brand identity', 'Professional polish']],
    ['slug' => 'presentation', 'title' => 'Stock Footage Videos', 'bullets' => ['Stock + voiceover', 'Cost-effective', 'Quick turnaround']],
    ['slug' => 'animation', 'title' => 'Character Animated Videos', 'bullets' => ['Character-driven storytelling', 'Memorable mascots', 'Engaging narratives']],
    ['slug' => 'specialty', 'title' => 'Drone Videos', 'bullets' => ['Aerial footage', 'Stunning perspectives', 'Professional cinematography']],
];

include __DIR__ . '/../includes/header.php';
?>

    <!-- PRODUCTS INTRO -->
    <section class="services fade-in" style="padding-top: 120px;">
        <div class="container">
            <div class="section-label">What We Make</div>
            <h2 class="section-title">Video Production Styles</h2>
            <p class="section-sub">Every style of video your business needs — from whiteboard to spokesperson to custom animation.</p>
        </div>
    </section>

    <?php foreach ($products as $product):
        [$where, $tagLabel] = video_type_switch($product['slug']);
        $sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos ' . $where . ' ORDER BY `rank` ASC LIMIT 4';
        $result = $conn->query($sql);
        $videos = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $vimeoRaw = trim($row['vimeo'] ?? '');
                if ($vimeoRaw !== '') {
                    $videos[] = $row;
                }
            }
        }
    ?>
    <section class="services fade-in">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-5 d-flex flex-column justify-content-center">
                    <h3 class="section-title mb-3">
                        <?php if ($product['slug'] === 'whiteboard'): ?>
                        <a href="/products/whiteboard.php" class="text-decoration-none text-dark"><?= htmlspecialchars($product['title']) ?></a>
                        <?php else: ?>
                        <?= htmlspecialchars($product['title']) ?>
                        <?php endif; ?>
                    </h3>
                    <ul class="list-unstyled mb-4">
                        <?php foreach ($product['bullets'] as $bullet): ?>
                        <li class="mb-2 text-secondary"><?= htmlspecialchars($bullet) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="<?= $product['slug'] === 'whiteboard' ? '/products/whiteboard.php' : '/#contact' ?>" class="btn btn-accent align-self-start">Get Info</a>
                    </div>
                    <div class="col-lg-7">
                    <div class="row g-2">
                        <?php foreach ($videos as $row):
                            $vimeoRaw = trim($row['vimeo'] ?? '');
                            if ($vimeoRaw === '') continue;
                            $p = strpos($vimeoRaw, '/') + 1;
                            $vimeoParam = substr_replace($vimeoRaw, '?h=', $p, 0);
                            $vimeoParam = preg_replace('/\?\//', '?', $vimeoParam);
                            $embedUrl = 'https://player.vimeo.com/video/' . $vimeoParam . '&title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=58479';
                            $embedUrlAmp = str_replace('&', '&amp;', $embedUrl);
                            $thumbnailWebm = isset($row['thumbnail_webm']) ? trim($row['thumbnail_webm']) : '';
                            $jpgFallback = 'https://www.websitetalkingheads.com/ivideo/videos/640/' . rawurlencode($row['Name']) . '.jpg';
                            $shortName = strlen($row['Name']) > 18 ? trim(substr($row['Name'], 0, strrpos($row['Name'], ' '))) : $row['Name'];
                        ?>
                        <div class="col-6">
                            <div class="portfolio-card" data-bs-toggle="modal" data-bs-target="#portfolioModal" data-vimeo="<?= htmlspecialchars($embedUrlAmp) ?>">
                                <div class="portfolio-thumb">
                                    <?php if ($thumbnailWebm !== ''): ?>
                                    <video autoplay muted loop playsinline><source src="<?= htmlspecialchars($thumbnailWebm) ?>" type="video/webm"></video>
                                    <?php else: ?>
                                    <img src="<?= htmlspecialchars($jpgFallback) ?>" alt="<?= htmlspecialchars($row['description']) ?>">
                                    <?php endif; ?>
                                    <div class="hover-play">
                                        <div class="play-sm">
                                            <svg viewBox="0 0 24 24" fill="#1a1a1a" width="18" height="18"><polygon points="8,5 20,12 8,19"/></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-info">
                                    <h3><?= htmlspecialchars($shortName) ?></h3>
                                    <span><?= htmlspecialchars($tagLabel) ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                            output_vimeo_video_schema_from_embed($embedUrl, (string) $row['Name'], (string) $row['description']);
                        endforeach; ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach; ?>

<?php include __DIR__ . '/../includes/portfolio-modal.php'; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>
