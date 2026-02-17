# Spokesperson Video - Version History

## v0.3.1 (2025-02-17)

### Session Summary

**Animation product page (`products/animation.php`):**
- New page matching whiteboard layout: hero, examples grid (animation=true), Animation in Action (random-content), Custom Animated Videos, benefits, Animated Video copy, questions, related styles
- Links from products index "Get Info" and title for animation slug sections

**Products index (`products/index.php`):**
- Spokesperson Videos moved to top of Video Production Styles
- Get Info and title links for Custom Animated Videos (and other animation slug sections) point to `/products/animation.php`
- Explainer Videos section removed (kept Custom Animated Videos)
- Animated Logos section removed

**Portfolio modal (`includes/portfolio-modal.php`):**
- Modal header: equal vertical padding (`py-2 px-3`), `align-items-center`, close button `align-self-center` so close (X) is vertically centered

**Testimonial thumbnails (`assets/css/style.css`):**
- `.portfolio-thumb img` base styles (width/height 100%, object-fit cover)
- `.product-section-testimonials` section: `object-fit: contain` for thumb video/img so portrait/square testimonial thumbnails show full frame without weird crop

---

## v0.3.0 (2025-02-16)

### Session Summary

**Products page (`products/index.php`):**
- Catalog of 11 video production styles with pricing, features, and 2x2 video grids per style
- Uses existing portfolio modal for video playback; connects to working_videos DB
- Path prefix support in header/footer for subdirectory asset loading

**Whiteboard page (`products/whiteboard.php`):**
- Hero, examples grid (6 videos), featured section with random whiteboard_content + videos
- Custom Whiteboard Videos (use cases, deliverables), benefits, explainer copy, questions
- Related Video Styles links (animation, 3d, motion, typography, presentation)

**Shared components:**
- `includes/portfolio-modal.php` — extracted from portfolio for reuse
- `includes/random-content.php` — 3 random videos + paired content from {style}_content table
- `includes/video-types.php` — `video_type_switch()` for slug → WHERE/label mapping

**Navigation:**
- Products link in header, footer, mobile menu
- Whiteboard "Get Info" on products index links to whiteboard page

---

## v0.2.1 (2025-02-14)

### Session Summary

**Testimonials:**
- Five testimonials with Vimeo embeds; three shown at a time, chosen at random on each page load (JS shuffle)
- Quote text and names aligned with reference; portrait 9:16 container, iframe cover via container query (no black bars)

**Hero:**
- Replaced native video with Vimeo iframe (video 1106382740, hash 88f762d477)
- Play overlay click sets `autoplay=1` on iframe and hides overlay

**Typography / logo:**
- Switched display font from Syne to Plus Jakarta Sans (700, 800) so “g” and other descenders render with a standard glyph and no longer look cut off
- Logo kept `line-height: 1.6` for spacing

---

## v0.2.0 (2025-02-13)

### Session Summary

**Portfolio system from showPortfolio.php:**
- Integrated DB-driven portfolio using `working_videos` database
- Added `connect-videos.php` and `video_schema_vimeo.php` (self-contained, no wth2025 path dependency)
- Variable system: `$type`, `$types`, `$columns`, `$show`, `$rand` (set before include)

**Display type:**
- `$type = 'display'` fetches 1 video each from: whiteboard, presentation, product, 3d, viral, animation
- Fixed flow with if/elseif/else to prevent fallthrough to single-type logic

**Index configuration:**
- `$type = 'display'`, `$show = 6`, `$columns = 3` before portfolio include

**Vimeo:**
- Thumbnails (thumbnail_webm or jpg fallback), modal playback, schema output
- main.js modal handlers for iframe load/clear

**FTP:**
- Enabled uploadOnSave in sftp.json and sync_config.jsonc

---

## Current Version: 0.3.1
