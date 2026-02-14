    <!-- TESTIMONIALS -->
    <section class="testimonials fade-in" id="testimonials">
        <div class="container">
            <div class="section-label">Client Results</div>
            <h2 class="section-title mb-5">Real results, real people</h2>

            <?php
            $testimonials = [
                [
                    'quote' => 'Our VSL made him more than $1 million in revenue.',
                    'name' => 'Bogdan V.',
                    'role' => 'Entrepreneur',
                    'initials' => 'BV',
                    'video' => '',
                ],
                [
                    'quote' => 'Helped increase our funds from under $60 million to almost $80 million.',
                    'name' => 'David O.',
                    'role' => 'Fund Manager',
                    'initials' => 'DO',
                    'video' => '',
                ],
                [
                    'quote' => 'Took his sales from $0 to $1 million per month.',
                    'name' => 'Demar Z.',
                    'role' => 'Business Owner',
                    'initials' => 'DZ',
                    'video' => '',
                ],
            ];
            ?>

            <div class="row g-4">
                <?php foreach ($testimonials as $t): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card">
                        <div class="testimonial-video">
                            <video muted playsinline poster="">
                                <source src="<?= $t['video'] ?>" type="video/mp4">
                            </video>
                        </div>
                        <div class="stars">★★★★★</div>
                        <blockquote>"<?= $t['quote'] ?>"</blockquote>
                        <div class="d-flex align-items-center gap-3">
                            <div class="testimonial-avatar"><?= $t['initials'] ?></div>
                            <div>
                                <div class="testimonial-name"><?= $t['name'] ?></div>
                                <div class="testimonial-role"><?= $t['role'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
