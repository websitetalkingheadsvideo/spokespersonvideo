# Spokesperson Video - Version History

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

## Current Version: 0.2.1
