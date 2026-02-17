<?php
declare(strict_types=1);

$path_prefix = '../';
require_once __DIR__ . '/../includes/connect-videos.php';
require_once __DIR__ . '/../includes/video_schema_vimeo.php';

$tagLabel = 'Presentation';
$sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos WHERE Presentation=true ORDER BY `rank` ASC LIMIT 12';
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
    ['slug' => 'viral', 'label' => 'Viral Videos'],
    ['slug' => 'animation', 'label' => 'Custom Animation'],
    ['slug' => 'testimonials', 'label' => 'Testimonials'],
    ['slug' => 'product', 'label' => 'Product Videos'],
];

include __DIR__ . '/../includes/header.php';
?>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="section-label">Video Production Style</div>
                <h1>Video Presentation Production</h1>
                <p class="hero-sub mx-auto">Professional video presentations with on-camera spokesperson and green screen.</p>
                <a href="/#contact" class="btn btn-accent">Get Info</a>
            </div>
        </div>
    </section>

    <!-- VIDEO PRESENTATION EXAMPLES -->
    <section class="portfolio fade-in" id="examples">
        <div class="container">
            <div class="section-label">Examples</div>
            <h2 class="section-title">Video Presentation Examples</h2>
            <p class="section-sub mb-5">Professional video presentation production for B2B businesses. Green screen spokesperson videos that deliver your message clearly, build trust, and support product demos, training, and marketing.</p>
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

    <!-- RANDOM CONTENT (from presentation_content + videos) -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Featured</div>
            <h2 class="section-title mb-5">Video Presentation in Action</h2>
            <div class="row g-4">
                <?php
                $style = 'presentation';
                include __DIR__ . '/../includes/random-content.php';
                ?>
            </div>
        </div>
    </section>

    <!-- CUSTOM VIDEO PRESENTATION -->
    <section class="services fade-in">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title mb-4">Custom Video Presentation</h2>
                        <h3 class="h6 text-uppercase mb-2">Use Video Presentation For</h3>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2 text-secondary">Product Demos</li>
                            <li class="mb-2 text-secondary">Training & Onboarding</li>
                            <li class="mb-2 text-secondary">Marketing & Sales</li>
                            <li class="mb-2 text-secondary">Company Updates</li>
                        </ul>
                        <h3 class="h6 text-uppercase mb-2">You Get</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 text-secondary">Green Screen Production</li>
                            <li class="mb-2 text-secondary">Customizable Backgrounds & Branding</li>
                            <li class="mb-2 text-secondary">Multiple Format Options</li>
                            <li class="mb-2 text-secondary">Professional Delivery</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <a href="/#contact" class="btn btn-accent">Order Video Presentation</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY BUSINESSES NEED VIDEO PRESENTATION -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Benefits</div>
            <h2 class="section-title">Why Do Businesses Need Video Presentation?</h2>
            <p class="section-sub">Video presentations with an on-camera spokesperson put a human face on your brand. They build trust, clarify your message, and work across product demos, training, and marketing.</p>
            <ul class="list-unstyled">
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Human Connection:</strong> A real spokesperson builds trust and makes your message more memorable.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Clear Delivery:</strong> Complex ideas are easier to explain when delivered by a professional on camera.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Brand Consistency:</strong> Green screen and customizable backgrounds keep every video on-brand.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Versatile Use:</strong> Use the same style for landing pages, sales tools, training, and internal communications.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- VIDEO PRESENTATION EXPLAINER -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Video Presentation</h2>
            <p class="section-sub">We create video presentations with an on-camera spokesperson shot on green screen. Your message is delivered clearly and professionally, with backgrounds and branding tailored to your needs.</p>
            <p class="text-secondary">Video presentations work for product demos, training, marketing, and company updates. We shoot in our studio for consistent quality and offer multiple formats — landscape, square, vertical — so your videos fit any platform.</p>
        </div>
    </section>

    <!-- QUESTIONS -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Questions to Ask Yourself</h2>
            <ul class="list-unstyled">
                <li class="mb-2 text-secondary">What is the goal of your video?</li>
                <li class="mb-2 text-secondary">What is the best length for your video?</li>
                <li class="mb-2 text-secondary">How much are you willing to spend?</li>
                <li class="mb-2 text-secondary">What type of video do you want to create?</li>
                <li class="mb-2 text-secondary">How much time do you have for the project?</li>
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
