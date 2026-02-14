    <!-- SERVICES -->
    <section class="services fade-in" id="services">
        <div class="container">
            <div class="section-label">What We Do</div>
            <h2 class="section-title">Every style. One studio.</h2>
            <p class="section-sub">From concept to final cut — scripted, shot, and edited in-house by our team.</p>

            <?php
            $services = [
                ['icon' => '🎬', 'title' => 'VSL & Presentations', 'desc' => 'High-converting video sales letters and pitch decks that close deals.'],
                ['icon' => '✨', 'title' => '3D & 2D Animation', 'desc' => 'Custom animated videos that explain complex ideas simply and beautifully.'],
                ['icon' => '📊', 'title' => 'Motion Graphics', 'desc' => 'Dynamic graphics and kinetic typography that bring data and concepts to life.'],
                ['icon' => '😂', 'title' => 'Funny Ads', 'desc' => 'Comedy-driven commercials that are memorable, shareable, and effective.'],
                ['icon' => '📱', 'title' => 'Product Demos', 'desc' => 'Clear, compelling walkthroughs that show exactly how your product works.'],
                ['icon' => '🏢', 'title' => 'Corporate Videos', 'desc' => 'Professional brand films, training content, and internal communications.'],
            ];
            ?>

            <div class="row g-4">
                <?php foreach ($services as $service): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon"><?= $service['icon'] ?></div>
                        <h3><?= $service['title'] ?></h3>
                        <p><?= $service['desc'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
