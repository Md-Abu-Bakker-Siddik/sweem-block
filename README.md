# Sweem Team Block

`Sweem Team Block` is a custom WordPress Gutenberg block plugin for presenting team members with multiple visual skins, social profile links, and per-skin style customization.

The block is registered as `create-block/sweem-block` and rendered dynamically with PHP.

## Key Features

- 4 built-in layout skins (`style1`, `style2`, `style3`, `style4`)
- Team member content fields:
  - Name
  - Designation
  - Profile image + alt text
  - Social links (Facebook, X/Twitter, LinkedIn, Instagram)
- Per-skin style control support via `styleSettings` object
  - Title color
  - Subtitle color
  - Card background
  - Content background
  - Social background
  - Social icon color
  - Image radius
- Dynamic server-side rendering (`render.php`)
- Font Awesome icons loaded for editor + frontend

## Tech Stack

- WordPress Block API v3
- JavaScript (Gutenberg block editor APIs)
- PHP (dynamic render callback template)
- SCSS/CSS
- `@wordpress/scripts`

## Requirements

- WordPress 6.8+
- PHP 7.4+
- Node.js 18+ (recommended for development)
- npm 9+ (recommended for development)

## Installation

1. Place this plugin in your WordPress plugins directory:
   - `wp-content/plugins/sweem-block`
2. Activate **Sweem Block** from WordPress Admin -> Plugins.
3. Open the block editor and insert **Sweem Team Block**.

## Local Development

Install dependencies:

```bash
npm install
```

Run watch/development build:

```bash
npm run start
```

Create production build:

```bash
npm run build
```

Create distributable zip:

```bash
npm run plugin-zip
```

## Project Structure

```text
sweem-block/
|- sweem-block.php                  # Plugin bootstrap and block registration
|- package.json
|- src/
|  |- sweem-block/
|  |  |- block.json                 # Block metadata and attributes
|  |  |- index.js                   # registerBlockType entry
|  |  |- edit.js                    # Editor UI and controls
|  |  |- render.php                 # Dynamic frontend markup
|  |  |- view.js                    # Frontend interaction logic
|  |  |- editor.scss
|  |  |- style.scss
|  |  |- _theme-colors.scss
|  |  |- _theme-typography.scss
|- build/                           # Compiled assets
|  |- sweem-block/
|  |- blocks-manifest.php
|- readme.txt
```

## Block Behavior Notes

- Skin selection is controlled by `skinStyle`.
- Style customization is stored per skin inside `styleSettings[skinStyle]`.
- If a style value is invalid, render sanitization prevents unsafe CSS injection.
- Social links are normalized in PHP (adds `https://` when needed).
- Image URLs are normalized and escaped before output.

## Security & Output Handling

In `render.php`, the plugin applies output safety practices:

- `esc_url()` for URLs
- `esc_attr()` for attributes
- `esc_html()` for text output
- CSS variable values are sanitized before inline output

## Hiring Manager / Reviewer Guide

If you are reviewing this project, start with these files:

1. `src/sweem-block/block.json` - data contract (attributes, assets, supports)
2. `src/sweem-block/edit.js` - editor UX, inspector controls, skin-aware style settings
3. `src/sweem-block/render.php` - server-side rendering and sanitization
4. `src/sweem-block/style.scss` - visual implementation of all skins
5. `sweem-block.php` - plugin bootstrap and registration flow

## Known Scope

- The plugin currently provides one block focused on team card presentation.
- Typography controls exist in attributes but only fields connected in the current editor UI are exposed in inspector panels.

## License

GPL-2.0-or-later

