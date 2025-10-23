# OpenSourceBox WordPress Theme

A modern WordPress theme converted from the Hugo blog site for OpenSourceBox - your source for AI, Machine Learning, and Open Source technology content.

## Description

OpenSourceBox is a clean, responsive WordPress theme designed for technical blogs and content sites. It features a professional layout optimized for readability and includes support for all standard WordPress features including custom menus, widgets, and post formats.

## Features

- Clean, modern design with GitHub-inspired styling
- Fully responsive layout
- Custom header and footer widget areas
- Primary and footer navigation menus
- Featured images support
- Customizable footer text via WordPress Customizer
- Full support for tags and categories
- Code syntax highlighting friendly styles
- SEO-friendly markup
- Translation ready

## Installation

### Option 1: WordPress Admin Panel

1. Download the theme as a ZIP file
2. Log in to your WordPress admin panel
3. Navigate to Appearance > Themes
4. Click "Add New" then "Upload Theme"
5. Choose the ZIP file and click "Install Now"
6. Activate the theme

### Option 2: Manual Installation

1. Download the theme files
2. Upload the `opensourcebox` folder to `/wp-content/themes/`
3. Go to Appearance > Themes in WordPress admin
4. Activate the OpenSourceBox theme

## Setup & Configuration

### 1. Menus

Navigate to Appearance > Menus to create your menus:
- **Primary Menu**: Main navigation in header
- **Footer Menu**: Links in footer area

### 2. Widgets

Navigate to Appearance > Widgets to configure widget areas:
- **Sidebar**: Main sidebar widget area
- **Footer 1, 2, 3**: Three footer widget columns

### 3. Customizer Settings

Go to Appearance > Customize to:
- Upload a custom logo
- Set footer copyright text
- Configure site identity

### 4. Recommended Plugins

For the best experience, consider installing:
- **Classic Editor** or **Gutenberg** for post editing
- **Jetpack** for additional features
- **Yoast SEO** for search engine optimization
- **Contact Form 7** for contact forms
- **WP Super Cache** for performance

## Theme Structure

```
opensourcebox/
├── style.css              # Main stylesheet and theme info
├── functions.php          # Theme functions and features
├── index.php              # Main template file
├── header.php             # Header template
├── footer.php             # Footer template
├── sidebar.php            # Sidebar template
├── single.php             # Single post template
├── page.php               # Page template
├── archive.php            # Archive template
├── category.php           # Category template
├── tag.php                # Tag template
├── author.php             # Author archive template
├── search.php             # Search results template
├── 404.php                # 404 error template
├── comments.php           # Comments template
├── searchform.php         # Search form template
└── README.md              # This file
```

## Customization

### Colors

The theme uses a GitHub-inspired color scheme. To customize colors, edit the CSS variables in `style.css`.

### Fonts

The theme uses system fonts for optimal performance:
- `-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif`

You can change this in `style.css` under the `body` selector.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Support

For theme support and questions:
- Visit: http://opensourcebox.com/
- Create an issue in the theme repository

## Changelog

### Version 1.0.0
- Initial release
- Converted from Hugo blog site
- Full WordPress theme functionality
- Responsive design
- Widget support
- Custom menu support

## Credits

- Based on the Hugo blog site for OpenSourceBox
- Developed for WordPress 5.0+
- Follows WordPress Coding Standards

## License

This theme is licensed under the GNU General Public License v2 or later.

## Author

OpenSourceBox Team
- Website: http://opensourcebox.com/

---

Thank you for using the OpenSourceBox WordPress theme!
