    <!-- PROCESS -->
    <section class="process fade-in">
        <div class="container">
            <div class="section-label">How It Works</div>
            <h2 class="section-title mb-5">Simple. Collaborative. Fast.</h2>

            <?php
            $steps = [
                ['num' => '01', 'title' => 'Schedule a Call', 'desc' => 'Tell us about your goals and what you need. 30 minutes, no pressure.'],
                ['num' => '02', 'title' => 'Video Strategy', 'desc' => 'We develop a plan — message, style, and format tailored to your audience.'],
                ['num' => '03', 'title' => 'Production', 'desc' => 'We script, cast, shoot, and edit everything in our studio.'],
                ['num' => '04', 'title' => 'Launch', 'desc' => 'Your videos go live and start working for your business.'],
            ];
            ?>

            <div class="row g-4">
                <?php foreach ($steps as $step): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="process-step text-center">
                        <div class="step-number"><?= $step['num'] ?></div>
                        <h3><?= $step['title'] ?></h3>
                        <p><?= $step['desc'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
