<?php
declare(strict_types=1);

$path_prefix = '../';
$spokespeople = [
    ['name' => 'Jed', 'gender' => 'male'],
    ['name' => 'Chantel', 'gender' => 'female'],
    ['name' => 'Derek', 'gender' => 'male'],
    ['name' => 'Angie', 'gender' => 'female'],
    ['name' => 'Josh', 'gender' => 'male'],
    ['name' => 'Angelica', 'gender' => 'female'],
    ['name' => 'Walt', 'gender' => 'male'],
    ['name' => 'Gabrielle', 'gender' => 'female'],
    ['name' => 'Daniel', 'gender' => 'male'],
    ['name' => 'Jordan', 'gender' => 'male'],
    ['name' => 'Lonzo', 'gender' => 'male'],
    ['name' => 'Angeline', 'gender' => 'female'],
    ['name' => 'Brenton', 'gender' => 'male'],
    ['name' => 'Maria', 'gender' => 'female'],
    ['name' => 'Dustin', 'gender' => 'male'],
    ['name' => 'Karina', 'gender' => 'female'],
    ['name' => 'Dave', 'gender' => 'male'],
    ['name' => 'Bella', 'gender' => 'female'],
    ['name' => 'Regi', 'gender' => 'male'],
    ['name' => 'Brittany', 'gender' => 'female'],
    ['name' => 'Daryl', 'gender' => 'male'],
    ['name' => 'Debbie', 'gender' => 'female'],
    ['name' => 'Joe', 'gender' => 'male'],
    ['name' => 'Emi', 'gender' => 'female'],
    ['name' => 'James', 'gender' => 'male'],
    ['name' => 'Chelsey', 'gender' => 'female'],
    ['name' => 'Chance', 'gender' => 'male'],
    ['name' => 'Jillian', 'gender' => 'female'],
    ['name' => 'Ben', 'gender' => 'male'],
    ['name' => 'Heidi', 'gender' => 'female'],
    ['name' => 'Frits', 'gender' => 'male'],
    ['name' => 'Amber', 'gender' => 'female'],
    ['name' => 'Caden', 'gender' => 'male'],
    ['name' => 'Kari', 'gender' => 'female'],
    ['name' => 'Julio', 'gender' => 'male'],
    ['name' => 'Emilia', 'gender' => 'female'],
    ['name' => 'Jonny', 'gender' => 'male'],
    ['name' => 'Audrey', 'gender' => 'female'],
    ['name' => 'Eirik', 'gender' => 'male'],
    ['name' => 'Kylee', 'gender' => 'female'],
];
include __DIR__ . '/../includes/header.php';
?>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <div class="hero-content text-center">
                <div class="section-label">Spokespeople</div>
                <h1>Turn website visitors into paying customers</h1>
                <p class="hero-sub mx-auto">We provide done-for-you video spokesperson services for business websites — professional, custom-produced videos featuring real human spokespeople who deliver your message directly to your audience. We handle everything: scriptwriting, talent selection, video production, and delivery.</p>
                <p class="section-sub mx-auto mb-0">Professional video spokespeople increase conversions by up to 80% and keep visitors engaged 3x longer.</p>
            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="clients fade-in">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <p class="section-title mb-1" style="color: var(--accent);">80%</p>
                    <p class="section-sub mb-0">Higher conversion rate</p>
                </div>
                <div class="col-md-4">
                    <p class="section-title mb-1" style="color: var(--accent);">10,000+</p>
                    <p class="section-sub mb-0">Videos created</p>
                </div>
                <div class="col-md-4">
                    <p class="section-title mb-1" style="color: var(--accent);">48–72hr</p>
                    <p class="section-sub mb-0">Quick turnaround</p>
                </div>
            </div>
            <p class="text-center section-sub mt-4 mb-0">Trusted by 5,000+ businesses worldwide · 48–72hr delivery · Custom scripts included</p>
        </div>
    </section>

    <!-- TOP SPOKESPEOPLE -->
    <section class="portfolio fade-in" id="top-spokespeople">
        <div class="container">
            <div class="section-label">Choose your spokesperson</div>
            <h2 class="section-title mb-4">Top spokespeople</h2>
            <div class="d-flex flex-wrap gap-2 mb-4" id="spokesperson-filter" role="group" aria-label="Filter spokespeople">
                <button type="button" class="btn btn-outline-dark rounded-pill btn-sm active" data-filter="all" aria-pressed="true">All</button>
                <button type="button" class="btn btn-outline-dark rounded-pill btn-sm" data-filter="male" aria-pressed="false">Men</button>
                <button type="button" class="btn btn-outline-dark rounded-pill btn-sm" data-filter="female" aria-pressed="false">Women</button>
            </div>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-5 g-4">
                <?php
                $posterBase = 'https://www.websitetalkingheads.com/spokespeople/posters/';
                $videoBase = 'https://www.websitetalkingheads.com/spokespeople/videos/';
                foreach ($spokespeople as $person):
                    $name = $person['name'];
                    $posterUrl = $posterBase . rawurlencode($name) . '.jpg';
                    $videoUrl = $videoBase . rawurlencode($name) . '.mp4';
                ?>
                <div class="col" data-gender="<?= htmlspecialchars($person['gender']) ?>">
                    <div class="portfolio-card" role="button" tabindex="0" data-bs-toggle="modal" data-bs-target="#spokespersonModal" data-video-src="<?= htmlspecialchars($videoUrl) ?>" data-poster="<?= htmlspecialchars($posterUrl) ?>" data-name="<?= htmlspecialchars($name) ?>">
                        <div class="portfolio-thumb">
                            <img src="<?= htmlspecialchars($posterUrl) ?>" alt="<?= htmlspecialchars($name) ?> - Video Spokesperson" loading="lazy">
                            <div class="hover-play">
                                <div class="play-sm">
                                    <svg viewBox="0 0 24 24" fill="#1a1a1a" width="18" height="18"><polygon points="8,5 20,12 8,19"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-info">
                            <h3><?= htmlspecialchars($name) ?></h3>
                            <span>Video spokesperson</span>
                        </div>
                    </div>
                    <a href="/contact.php?spokesperson=<?= rawurlencode($name) ?>" class="btn btn-accent btn-sm mt-2 w-100">Choose <?= htmlspecialchars($name) ?></a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- WHY VIDEO SPOKESPEOPLE -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Why video spokespeople work</div>
            <h2 class="section-title mb-5">Why video spokespeople drive results</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="service-card p-4 p-lg-5 h-100">
                        <h3 class="section-title fs-4 mb-3">Increase conversions</h3>
                        <p class="section-sub mb-0">Boost your conversion rate by up to 80% when visitors see a real person explaining your product or service. Human connection builds trust instantly.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4 p-lg-5 h-100">
                        <h3 class="section-title fs-4 mb-3">3x longer engagement</h3>
                        <p class="section-sub mb-0">Keep visitors on your site 3 times longer. Video spokespeople capture attention and guide users through your sales funnel naturally.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card p-4 p-lg-5 h-100">
                        <h3 class="section-title fs-4 mb-3">Build trust faster</h3>
                        <p class="section-sub mb-0">Studies show 73% of visitors are more likely to purchase when they see a video spokesperson. Give your brand a trusted face and voice.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MALE / FEMALE -->
    <section class="services fade-in">
        <div class="container">
            <div class="service-card p-4 p-lg-5">
                <h2 class="section-title mb-3">Choose from male and female spokespeople</h2>
                <p class="section-sub mb-4">Our range of professional talent lets you select a male or female video spokesperson that matches your brand voice and target audience. From corporate executives to friendly customer service representatives, our presenters deliver your message with confidence and authenticity.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#top-spokespeople" class="btn btn-accent">Browse male spokespeople</a>
                    <a href="#top-spokespeople" class="btn btn-outline-dark rounded-pill">Browse female spokespeople</a>
                </div>
            </div>
        </div>
    </section>

    <!-- PROFESSIONAL SPOKESPERSONS -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">Professional videos</div>
            <h2 class="section-title mb-4">Professional spokesperson videos that drive results</h2>
            <p class="section-sub mb-5">Our spokesperson videos feature professional talent delivering your message with clarity and authenticity. Each video is produced to ensure your brand is represented by a confident, engaging presenter who connects with your audience. Whether you need a corporate spokesperson for B2B presentations or a friendly presenter for customer-facing content, our library offers the right match for your brand voice and target demographic.</p>
            <div class="service-card p-4 p-lg-5">
                <h3 class="section-title fs-4 mb-4">Video spokesperson services for business websites</h3>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 section-sub"><strong>Homepage videos</strong> — Establish immediate trust and communicate core value to first-time visitors; increase conversion rates and reduce bounce.</li>
                    <li class="mb-3 section-sub"><strong>Landing pages</strong> — Clear messaging and strong call-to-action for targeted campaigns; maximize lead generation and campaign ROI.</li>
                    <li class="mb-3 section-sub"><strong>Product or service introductions</strong> — Explain complex offerings with clarity and confidence; reduce confusion and accelerate the sales cycle.</li>
                    <li class="section-sub mb-0"><strong>Marketing campaigns</strong> — Consistent, professional messaging across channels; brand coherence and scalable production.</li>
                </ul>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../includes/testimonials.php'; ?>

    <!-- SPOKESPEOPLE FAQ -->
    <section class="services fade-in">
        <div class="container">
            <div class="section-label">FAQ</div>
            <h2 class="section-title mb-4">Frequently asked questions</h2>
            <div class="accordion" id="spokespeopleFaq">
                <div class="accordion-item border-0 mb-2 rounded overflow-hidden shadow-sm">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#spFAQ1" aria-expanded="false" aria-controls="spFAQ1">How much does a video spokesperson cost?</button>
                    </h3>
                    <div id="spFAQ1" class="accordion-collapse collapse" data-bs-parent="#spokespeopleFaq">
                        <div class="accordion-body section-sub">Pricing starts at $199 for a standard spokesperson video. Other types (whiteboard, 3D animation, motion graphics, etc.) cost more. Custom scripts, multiple takes, and premium spokespeople are available. <a href="/contact.php">Contact us</a> for a detailed quote.</div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-2 rounded overflow-hidden shadow-sm">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#spFAQ2" aria-expanded="false" aria-controls="spFAQ2">How quickly can I get my video?</button>
                    </h3>
                    <div id="spFAQ2" class="accordion-collapse collapse" data-bs-parent="#spokespeopleFaq">
                        <div class="accordion-body section-sub">Standard delivery is 48–72 hours, depending on spokesperson availability. Rush orders are available. We keep you updated throughout the process.</div>
                    </div>
                </div>
                <div class="accordion-item border-0 mb-2 rounded overflow-hidden shadow-sm">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#spFAQ3" aria-expanded="false" aria-controls="spFAQ3">Can I customize the script?</button>
                    </h3>
                    <div id="spFAQ3" class="accordion-collapse collapse" data-bs-parent="#spokespeopleFaq">
                        <div class="accordion-body section-sub">Yes. We provide professional scriptwriting services, or you can write your own. Our spokespeople deliver your message with the timing and emphasis you need.</div>
                    </div>
                </div>
            </div>
            <p class="mt-4 mb-0"><a href="/faq.php" class="btn btn-outline-dark rounded-pill">More FAQs</a></p>
        </div>
    </section>

    <?php include __DIR__ . '/../includes/cta.php'; ?>

<?php include __DIR__ . '/../includes/spokesperson-modal.php'; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>
