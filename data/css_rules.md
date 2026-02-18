# CSS Rules Compliance Report

Scan date: 2025-02-17  
Rules: `css_organization.mdc`, `bootstrap-before-css.mdc`

---

## 1. css_organization.mdc

### 1.1 Inline styles (violations)

| File | Line | Issue | Rule |
|------|------|--------|------|
| `products/index.php` | 22 | `style="padding-top: 120px;"` on `<section>` | All styling must be in external CSS; no inline `style=""`. |

**Fix:** Remove the inline attribute. Use a Bootstrap spacing class if it fits (e.g. `pt-5` = 48px), or add a class in `assets/css/style.css` (e.g. `.services--intro { padding-top: 120px; }`) and use that class on the section.

### 1.2 Embedded `<style>` blocks

- **Result:** None found.

### 1.3 CSS file location

- **Rule:** “Create `css/` folder in project root” and link with `href="css/filename.css"`.
- **Project:** Uses `assets/css/style.css` and links via `<?= $path_prefix ?>assets/css/style.css` in `includes/header.php`.
- **Note:** Structural difference only; styles are still external and cached. No change required unless you want to align with the literal `css/` root folder.

### 1.4 Stylesheet linking

- **Result:** Compliant. Bootstrap, fonts, and `style.css` are linked in `includes/header.php` (external stylesheets, no embedded CSS).

---

## 2. bootstrap-before-css.mdc

### 2.1 Inline style that should be Bootstrap or project class

| File | Line | Issue | Rule |
|------|------|--------|------|
| `products/index.php` | 22 | `style="padding-top: 120px;"` | Prefer Bootstrap utilities (`pt-*`) or existing project classes from `assets/css/style.css`; avoid inline styles. |

**Bootstrap:** Spacing scale does not include 120px (e.g. `pt-5` = 3rem = 48px). So either:

- Use the closest Bootstrap class (e.g. `pt-5`) if acceptable, or  
- Add a named class in `assets/css/style.css` (e.g. `.pt-hero` or `.services--intro`) with `padding-top: 120px` and use that class instead of `style=""`.

### 2.2 Custom CSS in `assets/css/style.css`

- **Result:** Not treated as violations. The rule’s order is: (1) Bootstrap utilities/components, (2) **existing project classes from `assets/css/style.css`**, (3) new custom CSS with approval. The current `style.css` is the existing project layer; this report does not flag its contents as bootstrap-before-css violations.

---

## Summary

| Rule | Violations |
|------|------------|
| css_organization | 1 (inline style in `products/index.php` line 22) |
| bootstrap-before-css | 1 (same inline style; should be Bootstrap or project class) |

**Single change that satisfies both rules:**  
In `products/index.php` line 22, remove `style="padding-top: 120px;"` and either use a Bootstrap class (e.g. `pt-5`) or a new/existing class in `assets/css/style.css` that sets `padding-top: 120px`.
