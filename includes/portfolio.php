    <!-- PORTFOLIO -->
    <section class="portfolio fade-in" id="work">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-5">
                <div>
                    <div class="section-label">Our Work</div>
                    <h2 class="section-title mb-0">See what we've built</h2>
                </div>
                <a href="/work.php" class="btn btn-outline-dark rounded-pill">View All Work →</a>
            </div>

            <?php
            /* Variables (set before include, same as showPortfolio):
             * $type   - single video type (whiteboard, animation, presentation, etc.) or 'display' for 1 from each: whiteboard, presentation, product, 3d, viral, animation
             * $types  - array of types for 1 video each, in order (e.g. ['presentation','animation','product','whiteboard','viral','3d'])
             * $columns - 1, 2, 3, or 4
             * $show   - max number to show (default 99)
             * $rand   - true to randomize
             */
            require_once __DIR__ . '/connect-videos.php';
            require_once __DIR__ . '/video_schema_vimeo.php';
            require_once __DIR__ . '/video-types.php';

            if (!isset($show) || $show === null || $show === '') $show = 99;
            $show = (int) $show;
            if (!isset($columns)) $columns = 3;
            if (!isset($rand)) $rand = false;

            $projects = [];
            $displayTypes = ['whiteboard', 'presentation', 'product', '3d', 'viral', 'animation'];

            if (isset($type) && strtolower(trim((string) $type)) === 'display') {
                foreach ($displayTypes as $t) {
                    [$where, $tagLabel] = video_type_switch($t);
                    $sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos ' . $where . ' ORDER BY `rank` ASC LIMIT 1';
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $projects[] = ['row' => $row, 'tag' => $tagLabel];
                    }
                }
            } elseif (!empty($types) && is_array($types)) {
                foreach ($types as $t) {
                    [$where, $tagLabel] = video_type_switch($t);
                    $sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos ' . $where . ' ORDER BY `rank` ASC LIMIT 1';
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $projects[] = ['row' => $row, 'tag' => $tagLabel];
                    }
                }
            } else {
                $typeVal = isset($type) ? strtolower(trim((string) $type)) : 'presentation';
                [$where, $tagLabel] = video_type_switch($typeVal);
                $sql = 'SELECT Name, description, vimeo, thumbnail_webm FROM videos ' . $where;
                $sql .= $rand ? ' ORDER BY RAND()' : ' ORDER BY `rank` ASC';
                if ($show > 0) $sql .= ' LIMIT ' . (int) $show;
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $projects[] = ['row' => $row, 'tag' => $tagLabel];
                    }
                }
            }

            switch ((int) $columns) {
                case 1: $colClass = 'col-12'; break;
                case 2: $colClass = 'col-md-6'; break;
                case 4: $colClass = 'col-lg-3 col-md-6'; break;
                default: $colClass = 'col-lg-4 col-md-6';
            }
            ?>

            <div class="row g-4">
                <?php foreach ($projects as $item):
                    $row = $item['row'];
                    $tagLabel = $item['tag'];
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
                <div class="<?= $colClass ?>">
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
        <?php include __DIR__ . '/portfolio-modal.php'; ?>
    </section>
