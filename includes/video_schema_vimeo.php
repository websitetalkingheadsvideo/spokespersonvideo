<?php
declare(strict_types=1);

function output_vimeo_video_schema_from_embed(string $vimeo_embed_src, string $fallback_title = '', string $fallback_description = ''): void {
  if (!filter_var($vimeo_embed_src, FILTER_VALIDATE_URL)) return;
  if (!preg_match('#player\.vimeo\.com/video/(\d+)(?:\?h=([^&]+))?#', $vimeo_embed_src, $matches)) return;
  $video_id = $matches[1];
  $video_hash = $matches[2] ?? '';
  $attempts = [
    "https://vimeo.com/api/oembed.json?url=" . urlencode("https://player.vimeo.com/video/$video_id" . ($video_hash ? "?h=$video_hash" : "")),
  ];
  if ($video_hash) $attempts[] = "https://vimeo.com/api/oembed.json?url=" . urlencode("https://vimeo.com/$video_id?h=$video_hash");
  $attempts[] = "https://vimeo.com/api/oembed.json?url=" . urlencode("https://vimeo.com/$video_id");
  $oembed_data = null;
  foreach ($attempts as $oembed_url) {
    $oembed_data = fetch_vimeo_oembed($oembed_url);
    if ($oembed_data !== null) break;
  }
  if ($oembed_data === null) return;
  $title = $oembed_data['title'] ?? $fallback_title;
  $description = !empty($oembed_data['description']) ? $oembed_data['description'] : $fallback_description;
  $thumbnail_url = $oembed_data['thumbnail_url'] ?? '';
  if (empty($thumbnail_url) || !filter_var($thumbnail_url, FILTER_VALIDATE_URL)) return;
  $schema = [
    "@context" => "https://schema.org",
    "@type" => "VideoObject",
    "name" => $title,
    "thumbnailUrl" => $thumbnail_url,
    "embedUrl" => html_entity_decode($vimeo_embed_src, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
  ];
  if (!empty($description)) $schema["description"] = $description;
  if (!empty($oembed_data['upload_date'])) $schema["uploadDate"] = normalize_upload_date($oembed_data['upload_date']);
  echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
}

function fetch_vimeo_oembed(string $url): ?array {
  if (function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt_array($ch, [CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 10, CURLOPT_USERAGENT => 'Mozilla/5.0']);
    $response = curl_exec($ch);
    curl_close($ch);
  } else {
    $ctx = stream_context_create(['http' => ['timeout' => 10, 'header' => "User-Agent: Mozilla/5.0\r\n"], 'ssl' => ['verify_peer' => false]]);
    $response = @file_get_contents($url, false, $ctx);
  }
  if (!$response) return null;
  $data = json_decode($response, true);
  return is_array($data) ? $data : null;
}

function normalize_upload_date(string $date_string): string {
  if (empty($date_string)) return date('c');
  $parsed = strtotime($date_string);
  return $parsed ? date('c', $parsed) : date('c');
}
