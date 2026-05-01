# Sweem Team Block (WordPress Gutenberg Plugin)

A custom WordPress Gutenberg block plugin for creating team member cards with multiple visual skins, social profile links, and style customization options.

This project is built with `@wordpress/scripts` and follows the modern block development workflow (`src` -> `build`).

## Features

- 9 visual skin styles for team member presentation
- Team profile fields (name, designation, image, alt text)
- Social links (Facebook, X/Twitter, LinkedIn, Instagram)
- Style controls for colors, typography, spacing, and icon size
- Dynamic block rendering through PHP (`render.php`)
- Font Awesome support for social media icons

## Tech Stack

- WordPress Gutenberg (Block API v3)
- JavaScript (React-based block editor components)
- PHP (server-side render integration)
- SCSS/CSS
- Node.js + npm
- `@wordpress/scripts`

## Requirements

- WordPress `6.8+`
- PHP `7.4+`
- Node.js `18+` (recommended)
- npm `9+` (recommended)

## Installation (Local Development)

1. Clone this repository:

   ```bash
   git clone <your-repo-url>
   cd sweem-block
   ```

2. Install dependencies:

   ```bash
   npm install
   ```

3. Build assets for production:

   ```bash
   npm run build
   ```

4. For active development (watch mode):

   ```bash
   npm run start
   ```

5. Copy/link this plugin folder into your WordPress `wp-content/plugins/` directory and activate **Sweem Block** from the WordPress admin dashboard.

## Available Scripts

- `npm run start` - Starts development build with file watching
- `npm run build` - Creates production-ready assets in `build/`
- `npm run format` - Formats project files
- `npm run lint:js` - Lints JavaScript files
- `npm run lint:css` - Lints style files
- `npm run plugin-zip` - Generates installable plugin zip

## Project Structure

```text
sweem-block/
|-- src/
|   `-- sweem-block/
|       |-- block.json
|       |-- edit.js
|       |-- index.js
|       |-- render.php
|       |-- view.js
|       |-- editor.scss
|       `-- style.scss
|-- build/
|   `-- sweem-block/    # Compiled assets
|-- sweem-block.php     # Plugin bootstrap file
|-- package.json
`-- README.md
```

## How It Works

- Block metadata and attributes are defined in `src/sweem-block/block.json`.
- Editor UI and controls are managed in `src/sweem-block/edit.js`.
- Dynamic frontend markup is rendered through `src/sweem-block/render.php`.
- The plugin bootstrap (`sweem-block.php`) registers block metadata from compiled assets and enqueues Font Awesome for icon rendering.

## Hiring Manager Notes

This project demonstrates:

- Practical Gutenberg block architecture
- Dynamic rendering with PHP + editor-side controls
- Asset pipeline usage with WordPress tooling
- Real-world, reusable component design for team showcase sections

If you are evaluating this repository, please review:

- `src/sweem-block/block.json` for schema and block capabilities
- `src/sweem-block/edit.js` for editing experience and controls
- `src/sweem-block/render.php` for server-side rendering logic
- `sweem-block.php` for plugin registration and runtime hooks

## Future Improvements

- Add block unit/integration tests
- Add image fallback and validation for broken media links
- Add i18n-ready UI labels throughout editor controls
- Add accessibility checks for social links and icon semantics

## License

GPL-2.0-or-later

