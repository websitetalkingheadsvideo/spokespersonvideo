<?php
declare(strict_types=1);

$path_prefix = '../';
require_once __DIR__ . '/../includes/connect-videos.php';
require_once __DIR__ . '/../includes/video_schema_vimeo.php';
require_once __DIR__ . '/../includes/video-types.php';

$products = [
    ['slug' => 'presentation', 'title' => 'Video Presentation', 'bullets' => ['Green screen production with customizable backgrounds and branding.', 'Professional delivery with on-camera spokesperson.', 'Ideal for product demos, training, and marketing that needs a human face.', 'Consistent quality shot in our studio for a polished, on-brand look.']],
    ['slug' => 'viral', 'title' => 'Viral Videos', 'bullets' => ['Shareable video content for social media that promotes your brand, increases engagement, and drives traffic across Facebook, Instagram, YouTube, and TikTok.', 'Professional viral commercial production — relatable, on-strategy content that\'s built to be shared.', 'Ideal for social campaigns, brand awareness, and video marketing that reaches a wider audience.']],
    ['slug' => 'whiteboard', 'title' => 'Whiteboard Videos', 'bullets' => ['Hand-drawn visuals that turn complex ideas into clear, memorable stories.', 'Ideal for explainers, training, and product demos — viewers retain more with whiteboard storytelling.', 'Engaging hand-drawn style']],
    ['slug' => 'animation', 'title' => 'Custom Animated Videos', 'bullets' => ['2D  animation tailored to your story and message.', 'Brand-aligned design — colors, fonts, and style that match your identity.', 'Ideal for explainers, product launches, and campaigns that stand out.', 'From concept to delivery, we handle scripting, storyboards, and final cut.']],
    ['slug' => 'testimonials', 'title' => 'Testimonial Videos', 'bullets' => ['Customer success stories told in your customers\' own words — real people, real results.', 'Authentic endorsements that build trust and credibility for your brand and offerings.', 'Ideal for landing pages, sales materials, and social proof — viewers connect with peer stories.']],
    ['slug' => 'product', 'title' => 'Product Videos', 'bullets' => ['Demo and feature highlights that show your product in action, not just on the page.', 'Product showcases tailored for e‑commerce, sales, and marketing — conversion-focused.', 'Ideal for landing pages, ads, and trade shows — clear, professional, on-brand delivery.']],
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
    <section class="services fade-in<?= $product['slug'] === 'testimonials' ? ' product-section-testimonials' : '' ?>">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-5 d-flex flex-column justify-content-center">
                    <h3 class="section-title mb-3">
                        <?php if ($product['slug'] === 'presentation'): ?>
                        <a href="/products/video-presentation.php" class="text-decoration-none text-dark"><?= htmlspecialchars($product['title']) ?></a>
                        <?php elseif ($product['slug'] === 'viral'): ?>
                        <a href="/products/viral-videos.php" class="text-decoration-none text-dark"><?= htmlspecialchars($product['title']) ?></a>
                        <?php elseif ($product['slug'] === 'whiteboard'): ?>
                        <a href="/products/whiteboard.php" class="text-decoration-none text-dark"><?= htmlspecialchars($product['title']) ?></a>
                        <?php elseif ($product['slug'] === 'animation'): ?>
                        <a href="/products/animation.php" class="text-decoration-none text-dark"><?= htmlspecialchars($product['title']) ?></a>
                        <?php elseif ($product['slug'] === 'testimonials'): ?>
                        <a href="/products/testimonials.php" class="text-decoration-none text-dark"><?= htmlspecialchars($product['title']) ?></a>
                        <?php else: ?>
                        <?= htmlspecialchars($product['title']) ?>
                        <?php endif; ?>
                    </h3>
                    <ul class="list-unstyled mb-4">
                        <?php foreach ($product['bullets'] as $bullet): ?>
                        <li class="mb-2 text-secondary"><?= htmlspecialchars($bullet) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($product['slug'] === 'presentation'): ?>
                    <a href="/products/video-presentation.php" class="btn btn-accent align-self-start">Get Info</a>
                    <?php elseif ($product['slug'] === 'viral'): ?>
                    <a href="/products/viral-videos.php" class="btn btn-accent align-self-start">Get Info</a>
                    <?php elseif ($product['slug'] === 'whiteboard'): ?>
                    <a href="/products/whiteboard.php" class="btn btn-accent align-self-start">Get Info</a>
                    <?php elseif ($product['slug'] === 'animation'): ?>
                    <a href="/products/animation.php" class="btn btn-accent align-self-start">Get Info</a>
                    <?php elseif ($product['slug'] === 'testimonials'): ?>
                    <a href="/products/testimonials.php" class="btn btn-accent align-self-start">Get Info</a>
                    <?php endif; ?>
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
