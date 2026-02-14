# Spokesperson Video - Version History

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

## Current Version: 0.2.0
