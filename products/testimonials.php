<?php
declare(strict_types=1);

$path_prefix = '../';
require_once __DIR__ . '/../includes/connect-videos.php';
require_once __DIR__ . '/../includes/video_schema_vimeo.php';

$tagLabel = 'Testimonials';
$sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos WHERE testimonials=true ORDER BY `rank` ASC LIMIT 12';
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
    ['slug' => 'viral-videos', 'label' => 'Viral Videos'],
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
                <h1>Testimonial Video Production</h1>
                <p class="hero-sub mx-auto">Customer success stories and authentic endorsements that build trust.</p>
                <a href="/contact.php" class="btn btn-accent">Get Info</a>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL EXAMPLES -->
    <section class="portfolio fade-in" id="examples">
        <div class="container">
            <div class="section-label">Examples</div>
            <h2 class="section-title">Testimonial Video Examples</h2>
            <p class="section-sub mb-5">Professional testimonial video production for B2B businesses. Customer success stories told in your customers' own words — real people, real results. Ideal for landing pages, sales materials, and social proof.</p>
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

    <!-- RANDOM CONTENT (from testimonials_content + videos) -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Featured</div>
            <h2 class="section-title mb-5">Testimonials in Action</h2>
            <div class="row g-4">
                <?php
                $style = 'testimonials';
                include __DIR__ . '/../includes/random-content.php';
                ?>
            </div>
        </div>
    </section>

    <!-- CUSTOM TESTIMONIAL VIDEOS -->
    <section class="services fade-in">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <h2 class="section-title mb-4">Custom Testimonial Videos</h2>
                        <h3 class="h6 text-uppercase mb-2">Use Testimonial Videos For</h3>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2 text-secondary">Landing Pages</li>
                            <li class="mb-2 text-secondary">Sales Materials</li>
                            <li class="mb-2 text-secondary">Social Proof</li>
                            <li class="mb-2 text-secondary">Case Studies</li>
                        </ul>
                        <h3 class="h6 text-uppercase mb-2">You Get</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 text-secondary">Customer Success Stories</li>
                            <li class="mb-2 text-secondary">Authentic Endorsements</li>
                            <li class="mb-2 text-secondary">Professional Production</li>
                            <li class="mb-2 text-secondary">Build Trust</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <a href="/contact.php" class="btn btn-accent">Order Testimonial Video</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHY BUSINESSES NEED TESTIMONIAL VIDEO -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Benefits</div>
            <h2 class="section-title">Why Do Businesses Need Testimonial Video?</h2>
            <p class="section-sub">Testimonial videos put real customers in front of your audience. They build credibility, answer objections, and help viewers connect with peer stories — making them one of the most effective tools for conversion.</p>
            <ul class="list-unstyled">
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Build Trust:</strong> Authentic endorsements from real customers build credibility for your brand and offerings.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Increase Conversions:</strong> Viewers connect with peer stories; testimonial videos can boost conversion rates on landing pages and sales materials.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Social Proof:</strong> Customer success stories told in your customers' own words — real people, real results.</span>
                </li>
                <li class="mb-3 d-flex align-items-start gap-2">
                    <span class="fw-bold">•</span>
                    <span><strong>Versatile Use:</strong> Use testimonial videos on landing pages, in sales decks, on social media, and at events.</span>
                </li>
            </ul>
        </div>
    </section>

    <!-- TESTIMONIAL EXPLAINER -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Testimonial Video</h2>
            <p class="section-sub">We create testimonial videos that capture customer success stories and authentic endorsements. Your best customers tell your story — in their own words — so prospects hear from peers, not from you.</p>
            <p class="text-secondary">Testimonial videos work for landing pages, sales materials, and social proof. We produce them with the same quality as our other video styles so they fit seamlessly into your marketing and build trust with your audience.</p>
        </div>
    </section>

    <!-- QUESTIONS -->
    <section class="services fade-in">
        <div class="container">
            <h2 class="section-title">Questions to Ask Yourself</h2>
            <ul class="list-unstyled">
                <li class="mb-2 text-secondary">What is the goal of your testimonial video?</li>
                <li class="mb-2 text-secondary">Who are the best customers to feature?</li>
                <li class="mb-2 text-secondary">Where will you use the testimonials?</li>
                <li class="mb-2 text-secondary">How many testimonial videos do you need?</li>
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
