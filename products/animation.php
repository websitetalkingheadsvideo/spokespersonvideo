<?php
declare(strict_types=1);

$path_prefix = '../';
require_once __DIR__ . '/../includes/connect-videos.php';
require_once __DIR__ . '/../includes/video_schema_vimeo.php';

$tagLabel = 'Animation';
$sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos WHERE animation=true ORDER BY `rank` ASC LIMIT 12';
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
    ['slug' => 'whiteboard', 'label' => 'Whiteboard Animation'],
    ['slug' => '3d', 'label' => '3D Animation'],
    ['slug' => 'motion', 'label' => 'Motion Graphics'],
    ['slug' => 'typography', 'label' => 'Typography Video'],
    ['slug' => 'presentation', 'label' => 'Video Spokespeople'],
];

include __DIR__ . '/../includes/header.php';
?>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="section-label">Video Production Style</div>
                <h1>Animated Video Production</h1>
                <p class="hero-sub mx-auto">Professional animated video production for B2B businesses. Engaging explainer videos, product demos, and training videos that boost conversions.</p>
                <a href="/#contact" class="btn btn-accent">Get Info</a>
            </div>
        </div>
    </section>

    <!-- ANIMATION EXAMPLES -->
    <section class="portfolio fade-in" id="examples">
        <div class="container">
            <div class="section-label">Examples</div>
            <h2 class="section-title">Animation Examples</h2>
            <p class="section-sub mb-5">Professional animated video production for B2B businesses. Engaging explainer videos, product demos, and training videos that boost conversions.</p>
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

    <!-- RANDOM CONTENT (from animation_content + videos) -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Featured</div>
            <h2 class="section-title mb-5">Animation in Action</h2>
            <div class="row g-4">
                <?php
                $style = 'animation';
                include __DIR__ . '/../includes/random-content.php';
                ?>
            </div>
        </div>
    </section>

    <!-- CUSTOM ANIMATED VIDEOS -->
    <section class="services fade-in">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title mb-4">Custom Animated Videos</h2>
                        <h3 class="h6 text-uppercase mb-2">Used For</h3>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2 text-secondary">Sales Video</li>
                            <li class="mb-2 text-secondary">Onboarding</li>
                            <li class="mb-2 text-secondary">Educational Video</li>
                            <li class="mb-2 text-secondary">Training Video</li>
                        </ul>
                        <h3 class="h6 text-uppercase mb-2">You Get</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 text-secondary">Custom Graphics</li>
                            <li class="mb-2 text-secondary">Professional Voice Over</li>
                            <li class="mb-2 text-secondary">Skilled Editing and Compositing</li>
                            <li class="mb-2 text-secondary">Motion Design</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <a href="/#contact" class="btn btn-accent">Order Animated Video</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY BUSINESSES NEED ANIMATED VIDEO -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Benefits</div>
            <h2 class="section-title">Why Do Businesses Need Animated Video?</h2>
            <p class="section-sub">Animated videos are the new trend in B2B marketing. They offer a more engaging and immersive experience for the viewer and can be used to communicate complex concepts effectively. Not just for kids anymore, animated videos are a great way to get your message across in a creative, entertaining and memorable way that resonates with business decision-makers.</p>
            <ul class="list-unstyled">
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Simplify Complex Products:</strong> Break down technical concepts into easy-to-understand visual narratives.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Increase Conversions:</strong> Animated explainer videos can boost conversion rates by 80% or more.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Improve Brand Recognition:</strong> Consistent animated characters and style reinforce your brand identity.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Reduce Bounce Rates:</strong> Engaging animations keep visitors on your site longer, improving SEO rankings.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- ANIMATED VIDEO EXPLAINER -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Animated Video</h2>
            <p class="section-sub">Animated videos are a great way to convey a message in an engaging way. They can be used for marketing, explainer videos and more. Animated videos are a great way to market your brand. They provide an opportunity to tell your story in a more engaging way than traditional videos.</p>
            <p class="text-secondary">Corporate videos have been around for decades now, but animated corporate videos or animated explainer videos are relatively new on the scene and proven to increase engagement rates by up to 80%.</p>
        </div>
    </section>

    <!-- QUESTIONS -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Questions to Ask Before Creating an Animated Video That Sells</h2>
            <ul class="list-unstyled">
                <li class="mb-2 text-secondary">What do I want to communicate?</li>
                <li class="mb-2 text-secondary">What is the purpose of this video?</li>
                <li class="mb-2 text-secondary">Who am I targeting with this video?</li>
                <li class="mb-2 text-secondary">How can I make my message clear and concise in the animation?</li>
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
