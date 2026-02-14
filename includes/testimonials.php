    <!-- TESTIMONIALS -->
    <section class="testimonials fade-in" id="testimonials">
        <div class="container">
            <div class="section-label">Client Results</div>
            <h2 class="section-title mb-5">Real results, real people</h2>

            <?php
            $testimonials = [
                [
                    'quote' => 'Our VSL made him more than $1 Million.',
                    'name' => 'Bogdan V.',
                    'role' => 'Entrepreneur',
                    'initials' => 'BV',
                    'vimeo_id' => '1164951621',
                    'vimeo_hash' => 'bdfa54814d',
                ],
                [
                    'quote' => 'Our strategy helped increase their funds from under $60 million to almost $80 million.',
                    'name' => 'David O.',
                    'role' => 'Fund Manager',
                    'initials' => 'DO',
                    'vimeo_id' => '1164951547',
                    'vimeo_hash' => '931a1608f8',
                ],
                [
                    'quote' => 'Our video strategy took his sales from $0 to $1 MILLION per month.',
                    'name' => 'Demar Z.',
                    'role' => 'Business Owner',
                    'initials' => 'DZ',
                    'vimeo_id' => '1164951126',
                    'vimeo_hash' => '9df04e95f5',
                ],
                [
                    'quote' => 'You can\'t go wrong working with the Talking Heads team.',
                    'name' => 'John G.',
                    'role' => 'Client',
                    'initials' => 'JG',
                    'vimeo_id' => '1164951331',
                    'vimeo_hash' => 'dd85374ade',
                ],
                [
                    'quote' => 'It was a pleasure working with the Talking Heads team. You are in great hands with those guys.',
                    'name' => 'Dave Z.',
                    'role' => 'Client',
                    'initials' => 'DZ',
                    'vimeo_id' => '1164951457',
                    'vimeo_hash' => '3d7aff3a31',
                ],
            ];
            $vimeo_src = static function ($id, $hash) {
                return 'https://player.vimeo.com/video/' . $id . '?h=' . $hash;
            };
            ?>

            <div class="row g-4" id="testimonialsRow">
                <?php foreach ($testimonials as $t):
                    $embed_src = $vimeo_src($t['vimeo_id'], $t['vimeo_hash']);
                ?>
                <div class="col-lg-4 col-md-6 testimonial-column">
                    <div class="testimonial-card">
                        <div class="testimonial-video">
                            <iframe
                                src="<?= htmlspecialchars($embed_src) ?>"
                                frameborder="0"
                                allow="autoplay; fullscreen; picture-in-picture"
                                allowfullscreen
                                title="<?= htmlspecialchars($t['name'] . ' testimonial') ?>"
                           ></iframe>
                        </div>
                        <div class="stars">★★★★★</div>
                        <blockquote>"<?= htmlspecialchars($t['quote']) ?>"</blockquote>
                        <div class="d-flex align-items-center gap-3">
                            <div class="testimonial-avatar"><?= htmlspecialchars($t['initials']) ?></div>
                            <div>
                                <div class="testimonial-name"><?= htmlspecialchars($t['name']) ?></div>
                                <div class="testimonial-role"><?= htmlspecialchars($t['role']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
