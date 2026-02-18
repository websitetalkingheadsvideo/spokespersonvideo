<?php
declare(strict_types=1);

/**
 * Renders 3 random video cards with paired content from {style}_content table.
 * Expects: $style (e.g. 'whiteboard'), $conn (from connect-videos.php).
 * Uses same DB as connect-videos (working_videos) - whiteboard_content, etc.
 */
$style = $style ?? 'whiteboard';
$style = is_string($style) ? preg_replace('/[^a-z0-9_]/', '', strtolower($style)) : 'whiteboard';
if ($style === '') $style = 'whiteboard';

$mediaHeading = ['', '', ''];
$mediaContent = ['', '', ''];

$contentTable = $style . '_content';
$contentSql = "SELECT title, content FROM `{$contentTable}` ORDER BY RAND() LIMIT 3";
$contentResult = @$conn->query($contentSql);
if ($contentResult && $contentResult->num_rows > 0) {
    $z = 0;
    while ($z < 3 && ($row = $contentResult->fetch_assoc())) {
        $mediaHeading[$z] = $row['title'] ?? '';
        $mediaContent[$z] = $row['content'] ?? '';
        $z++;
    }
}

$videoSql = "SELECT Name, description, vimeo, thumbnail_webm FROM videos WHERE `{$style}` = true ORDER BY RAND() LIMIT 3";
$videoResult = $conn->query($videoSql);

if (!$videoResult || $videoResult->num_rows === 0) {
    return;
}

$keyword = $keyword ?? ['Watch', 'View', 'See'];
if (!is_array($keyword) || count($keyword) < 3) {
    $keyword = ['Watch', 'View', 'See'];
}

require_once __DIR__ . '/video_schema_vimeo.php';

$x = 0;
while ($row = $videoResult->fetch_assoc()) {
    $vimeoRaw = trim($row['vimeo'] ?? '');
    if ($vimeoRaw === '') continue;

    $p = strpos($vimeoRaw, '/');
    $vimeoParam = ($p !== false)
        ? substr_replace($vimeoRaw, '?h=', $p + 1, 0)
        : $vimeoRaw;
    $vimeoParam = preg_replace('/\?\//', '?', $vimeoParam ?? '');
    $embedUrl = 'https://player.vimeo.com/video/' . $vimeoParam . '&title=0&byline=0&portrait=0&badge=0&autopause=0&player_id=0&app_id=58479';
    $embedUrlAmp = str_replace('&', '&amp;', $embedUrl);

    $thumbnailWebm = isset($row['thumbnail_webm']) ? trim($row['thumbnail_webm']) : '';
    $jpgFallback = 'https://www.websitetalkingheads.com/ivideo/videos/640/' . rawurlencode($row['Name']) . '.jpg';

    $heading = $mediaHeading[$x] ?? '';
    $content = $mediaContent[$x] ?? '';

    output_vimeo_video_schema_from_embed($embedUrl, (string) $row['Name'], (string) ($row['description'] ?? ''));
?>
<div class="col-md-4">
    <div class="service-card h-100">
        <div class="portfolio-card" data-bs-toggle="modal" data-bs-target="#portfolioModal" data-vimeo="<?= htmlspecialchars($embedUrlAmp) ?>">
            <div class="portfolio-thumb">
                <?php if ($thumbnailWebm !== ''): ?>
                <video autoplay muted loop playsinline><source src="<?= htmlspecialchars($thumbnailWebm) ?>" type="video/webm"></video>
                <?php else: ?>
                <img src="<?= htmlspecialchars($jpgFallback) ?>" alt="<?= htmlspecialchars($row['description'] ?? '') ?>">
                <?php endif; ?>
                <div class="hover-play">
                    <div class="play-sm">
                        <svg viewBox="0 0 24 24" fill="#1a1a1a" width="18" height="18"><polygon points="8,5 20,12 8,19"/></svg>
                    </div>
                </div>
            </div>
            <div class="portfolio-info">
                <?php if ($heading !== ''): ?>
                <h3><?= $heading ?></h3>
                <?php endif; ?>
                <?php if ($content !== ''): ?>
                <p class="text-secondary small mb-0 mt-1"><?= $content ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
    $x++;
    if ($x >= 3) break;
}
?>
