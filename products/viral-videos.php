<?php
declare(strict_types=1);

$path_prefix = '../';
require_once __DIR__ . '/../includes/connect-videos.php';
require_once __DIR__ . '/../includes/video_schema_vimeo.php';

$tagLabel = 'Viral';
$sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos WHERE viral=true ORDER BY `rank` ASC LIMIT 12';
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
    ['slug' => 'video-presentation', 'label' => 'Video Presentation'],
    ['slug' => 'whiteboard', 'label' => 'Whiteboard'],
    ['slug' => 'animation', 'label' => 'Custom Animation'],
];

include __DIR__ . '/../includes/header.php';
?>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="section-label">Video Production Style</div>
                <h1>Viral Video Production</h1>
                <p class="hero-sub mx-auto">Professional viral commercial production for social media marketing. Shareable video content that promotes your brand and drives traffic.</p>
                <a href="/contact.php" class="btn btn-accent">Get Info</a>
            </div>
        </div>
    </section>

    <!-- VIRAL EXAMPLES -->
    <section class="portfolio fade-in" id="examples">
        <div class="container">
            <div class="section-label">Examples</div>
            <h2 class="section-title">Viral Video Examples</h2>
            <p class="section-sub mb-5">Professional viral commercial production for social media. Create shareable video content that promotes your brand, increases engagement, and drives traffic across Facebook, Instagram, YouTube, and TikTok.</p>
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

    <!-- RANDOM CONTENT (from viral_content + videos) -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Featured</div>
            <h2 class="section-title mb-5">Viral in Action</h2>
            <div class="row g-4">
                <?php
                $style = 'viral';
                include __DIR__ . '/../includes/random-content.php';
                ?>
            </div>
        </div>
    </section>

    <!-- CUSTOM VIRAL VIDEOS -->
    <section class="services fade-in">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title mb-4">Custom Viral Videos</h2>
                        <h3 class="h6 text-uppercase mb-2">Use Viral Videos For</h3>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2 text-secondary">Social Media Content</li>
                            <li class="mb-2 text-secondary">Brand Awareness</li>
                            <li class="mb-2 text-secondary">Product or Service Promotion</li>
                            <li class="mb-2 text-secondary">Video Channel Growth</li>
                        </ul>
                        <h3 class="h6 text-uppercase mb-2">You Get</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 text-secondary">Professional Actor</li>
                            <li class="mb-2 text-secondary">Skilled Editing and Compositing</li>
                            <li class="mb-2 text-secondary">Motion Graphics</li>
                            <li class="mb-2 text-secondary">Graphics and Effects</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <a href="/contact.php" class="btn btn-accent">Order Viral Video</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY BUSINESSES NEED VIRAL VIDEO -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Benefits</div>
            <h2 class="section-title">Why Do Businesses Need Viral Video?</h2>
            <p class="section-sub">Viral videos are one of the most effective ways to promote your brand on social media. The right content, audience, and video marketing strategy can increase engagement and drive traffic across platforms.</p>
            <ul class="list-unstyled">
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Reach a Wider Audience:</strong> Shareable, relatable content gets seen and shared across Facebook, Instagram, YouTube, and TikTok.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Increase Brand Awareness:</strong> Social media marketing with video is more personalized and interactive than other channels.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Tell Your Story:</strong> A video is a great marketing tool — it can be shared with millions in seconds and builds connection.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Build Your Video Channel:</strong> Consistent viral-style content helps grow your presence and authority on social platforms.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- VIRAL COMMERCIAL EXPLAINER -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Social Media Viral Commercial</h2>
            <p class="section-sub">We create viral-style video commercials for social media marketing. The most effective viral videos are about something relatable — they can be funny, emotional, or carry a clear message that resonates with your audience.</p>
            <p class="text-secondary">Getting your video to go viral is not easy; it takes the right content, the right audience, and a solid video marketing strategy. We focus on creating shareable, on-strategy content that promotes your brand and increases engagement across platforms.</p>
        </div>
    </section>

    <!-- QUESTIONS -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Questions to Ask Yourself</h2>
            <ul class="list-unstyled">
                <li class="mb-2 text-secondary">What is your viral commercial strategy?</li>
                <li class="mb-2 text-secondary">Do you have a social media strategy?</li>
                <li class="mb-2 text-secondary">How are you going to use viral video marketing?</li>
                <li class="mb-2 text-secondary">What is the goal of your video?</li>
                <li class="mb-2 text-secondary">What platforms will you publish on?</li>
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
