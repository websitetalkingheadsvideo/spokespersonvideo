# Spokesperson Video - Version History

## v0.4.0 (2025-02-17)

### Session Summary

**Spokespeople page (`spokespeople/index.php`):**
- New Spokespeople section: hero, stats (80%, 10k+, 48–72hr), grid of spokespeople with thumbnails and demo videos.
- Thumbnails and videos from websitetalkingheads.com (posters/ and videos/ by name); video modal with Accept/focus fix for aria-hidden.
- Grid: 5 per row on lg; crop thumbnails from bottom only (`object-position: center top`).
- Filter: All / Men / Women (client-side via `data-gender`); works with static data or future DB.

**Navigation:**
- Replaced Services with Spokespeople in header and footer (desktop + mobile).
- Removed Work link from header and footer.

**404 and .htaccess:**
- Custom 404 page (`404.php`): HTTP 404, header/footer, “Back to home” link.
- `.htaccess`: `ErrorDocument 404 /404.php` for Apache.

**Cookie notice:**
- `includes/cookie-notice.php`: fixed bottom bar, “Accept” sets `cookie_consent` for 365 days; link to Privacy; included in footer.
- `assets/css/style.css`: `.cookie-notice { z-index: 1055; }`.
- `assets/js/main.js`: cookie read/set and show/hide logic.

**Other:**
- Spokesperson modal: `video.src` + `load()` for playback; focus returned to trigger on hide (accessibility).
- Spokespeople section CSS: `#top-spokespeople .portfolio-thumb img { object-position: center top; }`.

---

## v0.3.7 (2025-02-17)

### Session Summary

**Contact page (`contact.php`):**
- New contact page with Pipedrive web form embed (webforms.pipedrive.com).
- Hero intro: "Start a project" / "Tell us about your video goals."

**Privacy page (`privacy.php`):**
- New privacy policy page with full content: Information Collection, Use of Information, Cookies/Third-Party Services, SMS Communications, Information Sharing, Data Security, Your Rights, California Privacy Notice, International Visitors, Updates, Contact.
- Effective Date: January 2024. Links: sales@websitetalkingheads.com, Contact page.

**Navigation / CTA updates:**
- Header "Start a Project" (desktop + mobile) → `/contact.php`
- Footer "Contact" → `/contact.php`
- CTA "Book a Demo" → `/contact.php` (was mailto)
- Home hero "Start Your Project" → `/contact.php`
- Product pages (video-presentation, viral-videos, whiteboard, animation, testimonials, product): "Get Info" and "Order X" → `/contact.php`

**Data:**
- `data/todo.md` — Page additions todo: Contact (done), Privacy (done), FAQ (pending).

---

## v0.3.6 (2025-02-17)

### Session Summary

**About page (`about.php`):**
- New root-level About page: hero, short “since 2001” copy, long content from websitetalkingheads.com (Bringing Your Website to Life, What We Do, Types of Videos, Why Spokesperson Videos Work, Tailored to Your Brand, Final Thought), Mission, quote block, “See it in action” with two Vimeo demos (1153028126, 980932658), CTA.
- Header and footer “About” links point to `/about.php`.

**CSS / rules:**
- Removed inline style from `products/index.php` (padding-top): added `.services--intro { padding-top: 120px; }` in `assets/css/style.css`, section uses `services--intro` class.
- `data/css_rules.md`: compliance report for css_organization and bootstrap-before-css (single violation fixed).

---

## v0.3.5 (2025-02-17)

### Session Summary

**Product Videos page (`products/product.php`):**
- New page based on whiteboard.php layout: hero, examples grid (product=true), Product Videos in Action (product_content random), Custom Product Videos (use cases, deliverables), benefits, Product Demo Video explainer, questions, related styles.
- Uses `video_type_switch('product')` for WHERE/label; related links to whiteboard, animation, video-presentation, testimonials, viral-videos.

**Products index (`products/index.php`):**
- Title and Get Info links for Product Videos point to `/products/product.php`.

---

## v0.3.4 (2025-02-17)

### Session Summary

**New product pages (same style/layout as whiteboard.php):**
- `products/video-presentation.php` — Video Presentation Production: hero, examples (Presentation=true), Featured (presentation_content), Custom Video Presentation, benefits, explainer, questions, related styles.
- `products/viral-videos.php` — Viral Video Production: hero, examples (viral=true), Viral in Action (viral_content), Custom Viral Videos, benefits, Social Media Viral Commercial copy, questions, related styles.
- `products/testimonials.php` — Testimonial Video Production: hero, examples (testimonials=true), Testimonials in Action (testimonials_content), Custom Testimonial Videos, benefits, explainer, questions, related styles.

**Products index (`products/index.php`):**
- Get Info and title links only for styles with a dedicated page; use absolute paths `/products/...`. Presentation → video-presentation.php; Viral → viral-videos.php; Whiteboard → whiteboard.php; Animation → animation.php; Testimonials → testimonials.php. No Get Info for Product Videos (no page). Removed CTA include from products page.

---

## v0.3.3 (2025-02-17)

### Session Summary

**Products index (`products/index.php`):**
- Testimonial Videos: expanded bullet list to near Whiteboard word count (3 descriptive bullets).
- Product Videos: expanded description list (3 descriptive bullets).
- Motion Graphics: expanded descriptions to near Whiteboard length (3 descriptive bullets).
- Removed sections: Stock Footage Videos, Character Animated Videos, Drone Videos, Motion Graphics.

**Testimonial thumbnails (`assets/css/style.css`):**
- `.product-section-testimonials .portfolio-thumb`: `aspect-ratio` set to `16 / 9` (videos are 16:9, not portrait).

---

## v0.3.2 (2025-02-17)

### Session Summary

**Products index (`products/index.php`):**
- Renamed "Spokesperson Videos" to "Video Presentation" and expanded bullet list (5 descriptive bullets); removed "or teleprompter" from one bullet.
- Whiteboard Videos: replaced "30 sec video - $199" / "60 sec video - $399" with two descriptive blurbs; kept "Engaging hand-drawn style."
- Custom Animated Videos: expanded bullet list from 3 to 5 descriptive items (animation, motion graphics, brand-aligned design, use cases, full production).

**Testimonial thumbnails (`assets/css/style.css`):**
- `.product-section-testimonials .portfolio-thumb`: set `aspect-ratio: 9 / 16` so portrait testimonial videos fill the container and black bars (letterboxing) are removed.

---

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

## Current Version: 0.4.0
