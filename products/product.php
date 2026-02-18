<?php
declare(strict_types=1);

$path_prefix = '../';
require_once __DIR__ . '/../includes/connect-videos.php';
require_once __DIR__ . '/../includes/video_schema_vimeo.php';
require_once __DIR__ . '/../includes/video-types.php';

[$where, $tagLabel] = video_type_switch('product');
$sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos ' . $where . ' ORDER BY `rank` ASC LIMIT 12';
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

$relatedStyles = [
    ['slug' => 'whiteboard', 'label' => 'Whiteboard'],
    ['slug' => 'animation', 'label' => '2D Animation'],
    ['slug' => 'video-presentation', 'label' => 'Video Spokespeople'],
    ['slug' => 'testimonials', 'label' => 'Testimonials'],
    ['slug' => 'viral-videos', 'label' => 'Viral Videos'],
];

include __DIR__ . '/../includes/header.php';
?>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="section-label">Video Production Style</div>
                <h1>Product Video Production</h1>
                <p class="hero-sub mx-auto">Demo and feature highlights that show your product in action, tailored for e‑commerce, sales, and marketing.</p>
                <a href="/contact.php" class="btn btn-accent">Get Info</a>
            </div>
        </div>
    </section>

    <!-- PRODUCT EXAMPLES -->
    <section class="portfolio fade-in" id="examples">
        <div class="container">
            <div class="section-label">Examples</div>
            <h2 class="section-title">Product Video Examples</h2>
            <p class="section-sub mb-5">Product showcases that put your offering in the spotlight. Conversion-focused video for landing pages, ads, and trade shows — clear, professional, on-brand delivery.</p>
            <div class="row g-4">
                <?php foreach (array_slice($videos, 0, 6) as $row):
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
                <div class="col-lg-4 col-md-6">
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
    </section>

    <!-- RANDOM CONTENT (from product_content + videos) -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Featured</div>
            <h2 class="section-title mb-5">Product Videos in Action</h2>
            <div class="row g-4">
                <?php
                $style = 'product';
                include __DIR__ . '/../includes/random-content.php';
                ?>
            </div>
        </div>
    </section>

    <!-- CUSTOM PRODUCT VIDEOS -->
    <section class="services fade-in">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title mb-4">Custom Product Videos</h2>
                        <h3 class="h6 text-uppercase mb-2">Use Product Videos For</h3>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2 text-secondary">Landing Pages</li>
                            <li class="mb-2 text-secondary">E‑commerce Product Pages</li>
                            <li class="mb-2 text-secondary">Sales and Marketing</li>
                            <li class="mb-2 text-secondary">Trade Shows and Demos</li>
                        </ul>
                        <h3 class="h6 text-uppercase mb-2">You Get</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 text-secondary">Feature Highlights</li>
                            <li class="mb-2 text-secondary">Product-in-Action Footage</li>
                            <li class="mb-2 text-secondary">On-Brand Visuals and Sound</li>
                            <li class="mb-2 text-secondary">Conversion-Focused Cuts</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <a href="/contact.php" class="btn btn-accent">Order Product Video</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY BUSINESSES NEED PRODUCT VIDEOS -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Benefits</div>
            <h2 class="section-title">Why Do Businesses Need Product Videos?</h2>
            <p class="section-sub">Product videos show your offering in action instead of relying on text and static images. They help buyers understand features, build confidence, and convert.</p>
            <ul class="list-unstyled">
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Increase Conversions:</strong> Product videos can significantly boost conversion rates on landing and product pages.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Clarify Features:</strong> Demonstrate how your product works instead of describing it in text.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Build Trust:</strong> Show real product footage so buyers know what to expect.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Versatile Use:</strong> Use on e‑commerce sites, in ads, at trade shows, and in sales presentations.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- PRODUCT VIDEO EXPLAINER -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Product Demo Video</h2>
            <p class="section-sub">We create product videos that showcase your offering clearly and professionally. Feature highlights, demos, and product-in-action footage designed for e‑commerce, sales, and marketing.</p>
            <p class="text-secondary">Product videos are built to convert. Short, focused clips that show what you sell and why it matters. Use them on landing pages, in ads, or at trade shows to drive awareness and sales.</p>
        </div>
    </section>

    <!-- QUESTIONS -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Questions to Ask Yourself</h2>
            <ul class="list-unstyled">
                <li class="mb-2 text-secondary">What features should the video highlight?</li>
                <li class="mb-2 text-secondary">Where will the video be used (landing page, e‑commerce, ads)?</li>
                <li class="mb-2 text-secondary">What is the best length for your audience?</li>
                <li class="mb-2 text-secondary">Do you need product-in-action footage or animation?</li>
            </ul>
        </div>
    </section>

    <!-- RELATED STYLES -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Explore</div>
            <h2 class="section-title">Related Video Styles</h2>
            <div class="d-flex flex-wrap gap-2">
                <?php foreach ($relatedStyles as $rs): ?>
                <a href="/products/<?= htmlspecialchars($rs['slug']) ?>.php" class="btn btn-outline-dark rounded-pill"><?= htmlspecialchars($rs['label']) ?></a>
                <?php endforeach; ?>
                <a href="/products/" class="btn btn-outline-dark rounded-pill">All Styles</a>
            </div>
        </div>
    </section>

<?php include __DIR__ . '/../includes/portfolio-modal.php'; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>
