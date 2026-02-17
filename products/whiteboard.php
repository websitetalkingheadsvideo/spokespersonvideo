<?php
declare(strict_types=1);

$path_prefix = '../';
require_once __DIR__ . '/../includes/connect-videos.php';
require_once __DIR__ . '/../includes/video_schema_vimeo.php';

$tagLabel = 'Whiteboard';
$sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos WHERE whiteboard=true ORDER BY `rank` ASC LIMIT 12';
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
    ['slug' => 'animation', 'label' => '2D Animation'],
    ['slug' => '3d', 'label' => '3D Animation'],
    ['slug' => 'motion', 'label' => 'Motion Graphics'],
    ['slug' => 'typography', 'label' => 'Typography'],
    ['slug' => 'presentation', 'label' => 'Video Spokespeople'],
];

include __DIR__ . '/../includes/header.php';
?>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="section-label">Video Production Style</div>
                <h1>Whiteboard Video Production</h1>
                <p class="hero-sub mx-auto">Professional whiteboard explainer videos that simplify complex concepts.</p>
                <a href="/#contact" class="btn btn-accent">Get Info</a>
            </div>
        </div>
    </section>

    <!-- WHITEBOARD EXAMPLES -->
    <section class="portfolio fade-in" id="examples">
        <div class="container">
            <div class="section-label">Examples</div>
            <h2 class="section-title">Whiteboard Examples</h2>
            <p class="section-sub mb-5">Professional whiteboard video production for B2B businesses. Hand-drawn explainer videos that simplify complex concepts, engage viewers, and boost conversions for sales, training, and marketing.</p>
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

    <!-- RANDOM CONTENT (from whiteboard_content + videos) -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Featured</div>
            <h2 class="section-title mb-5">Whiteboard in Action</h2>
            <div class="row g-4">
                <?php
                $style = 'whiteboard';
                include __DIR__ . '/../includes/random-content.php';
                ?>
            </div>
        </div>
    </section>

    <!-- CUSTOM WHITEBOARD VIDEOS -->
    <section class="services fade-in">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title mb-4">Custom Whiteboard Videos</h2>
                        <h3 class="h6 text-uppercase mb-2">Use Whiteboard Videos For</h3>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2 text-secondary">Sales Video</li>
                            <li class="mb-2 text-secondary">Onboarding</li>
                            <li class="mb-2 text-secondary">Educational Video</li>
                            <li class="mb-2 text-secondary">Training Video</li>
                        </ul>
                        <h3 class="h6 text-uppercase mb-2">You Get</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 text-secondary">Custom Drawings</li>
                            <li class="mb-2 text-secondary">Professional Voice Over</li>
                            <li class="mb-2 text-secondary">Skilled Editing and Compositing</li>
                            <li class="mb-2 text-secondary">Phone Consultation</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <a href="/#contact" class="btn btn-accent">Order Whiteboard Video</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY BUSINESSES NEED WHITEBOARD -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Benefits</div>
            <h2 class="section-title">Why Do Businesses Need Whiteboard Video?</h2>
            <p class="section-sub">Whiteboard videos are one of the most effective ways to explain complex B2B concepts in a simple, engaging manner. They transform complicated ideas into clear, visual narratives that resonate with business decision-makers.</p>
            <ul class="list-unstyled">
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Simplify Complex Products:</strong> Break down technical concepts, processes, and services into easy-to-understand visual stories.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Increase Conversions:</strong> Whiteboard explainer videos can boost conversion rates on landing pages.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Improve Retention:</strong> The hand-drawn visual style helps viewers remember your message longer.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Build Trust:</strong> The transparent, authentic feel of whiteboard animation builds credibility.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Versatile Applications:</strong> Perfect for sales presentations, product demos, training modules, onboarding, and marketing campaigns.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- WHITEBOARD EXPLAINER -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Whiteboard Explainer Video</h2>
            <p class="section-sub">We create whiteboard explainer videos with animation that explains the concept, service or product. A short, typically animated video provides information in a clear and engaging manner.</p>
            <p class="text-secondary">People use whiteboard explainer videos to explain complex topics simply. We design them to be short, around 2 minutes long, and for people to watch on mobile devices. Use them as an introduction for your website, a sales tool, or for education.</p>
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
