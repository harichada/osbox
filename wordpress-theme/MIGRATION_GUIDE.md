# Hugo to WordPress Migration Guide

This guide will help you migrate your Hugo blog (OpenSourceBox) to WordPress using the OpenSourceBox WordPress theme.

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [WordPress Installation](#wordpress-installation)
3. [Theme Installation](#theme-installation)
4. [Content Migration](#content-migration)
5. [Post-Migration Tasks](#post-migration-tasks)
6. [Troubleshooting](#troubleshooting)

## Prerequisites

Before starting the migration:

- [ ] WordPress 5.0 or higher installed
- [ ] PHP 7.4 or higher
- [ ] MySQL 5.7 or higher / MariaDB 10.2 or higher
- [ ] Access to WordPress admin panel
- [ ] Backup of your Hugo site content
- [ ] FTP/SSH access to your WordPress installation

## WordPress Installation

If you haven't already installed WordPress:

1. Download WordPress from [wordpress.org](https://wordpress.org/download/)
2. Follow the [installation guide](https://wordpress.org/support/article/how-to-install-wordpress/)
3. Complete the 5-minute installation process
4. Log in to your WordPress admin panel

## Theme Installation

### Step 1: Upload the Theme

**Option A: Via WordPress Admin**
1. Go to `Appearance > Themes`
2. Click `Add New` > `Upload Theme`
3. Choose the `opensourcebox.zip` file
4. Click `Install Now`
5. Click `Activate`

**Option B: Via FTP**
1. Upload the `opensourcebox` folder to `/wp-content/themes/`
2. Go to `Appearance > Themes`
3. Activate the OpenSourceBox theme

### Step 2: Configure Theme Settings

1. **Site Identity** (`Appearance > Customize > Site Identity`)
   - Set Site Title: "OpenSourceBox"
   - Set Tagline: Your site description
   - Upload a logo (optional)

2. **Menus** (`Appearance > Menus`)
   - Create a Primary Menu for header navigation
   - Create a Footer Menu (optional)
   - Assign menus to locations

3. **Widgets** (`Appearance > Widgets`)
   - Configure Sidebar widgets
   - Configure Footer widgets (Footer 1, 2, 3)

4. **Footer Text** (`Appearance > Customize > Footer Settings`)
   - Set custom footer copyright text

## Content Migration

### Method 1: Using WordPress Importer (Recommended)

#### Step 1: Convert Hugo Markdown to WordPress XML

You'll need to convert your Hugo markdown files to WordPress WXR (WordPress eXtended RSS) format.

**Recommended: Use the Provided Python Script**

A ready-to-use conversion script is included: `hugo-to-wordpress.py`

This script requires **NO external dependencies** - it uses only Python standard library!

**Usage:**

```bash
# Run the script from the wordpress-theme directory
python3 hugo-to-wordpress.py /path/to/hugo/content wordpress-import.xml

# Or from your Hugo site root:
cd /home/user/osbox
python3 wordpress-theme/hugo-to-wordpress.py ./content wordpress-import.xml
```

The script will:
- ✓ Parse all markdown files in `content/posts/`
- ✓ Extract frontmatter (title, date, author, categories, tags, description)
- ✓ Convert markdown to HTML
- ✓ Generate WordPress WXR XML file
- ✓ Preserve all metadata and content

**Output:**
- `wordpress-import.xml` - Ready to import into WordPress

#### Step 2: Import to WordPress

1. Install WordPress Importer:
   - Go to `Tools > Import`
   - Click on `WordPress`
   - Click `Install Now` and then `Run Importer`

2. Import the XML file:
   - Click `Choose File` and select your `wordpress-import.xml`
   - Click `Upload file and import`
   - Assign authors or create new ones
   - Check "Download and import file attachments"
   - Click `Submit`

3. Wait for import to complete

### Method 2: Manual Content Migration

For a smaller number of posts, you can manually create posts:

1. Go to `Posts > Add New`
2. Copy the post title from Hugo markdown
3. Copy the post content
4. Set the publish date
5. Add categories and tags
6. Set featured image (if applicable)
7. Click `Publish`

### Content Mapping

| Hugo | WordPress |
|------|-----------|
| `title:` | Post Title |
| `date:` | Publish Date |
| `author:` | Author |
| `description:` | Excerpt (or first paragraph) |
| `tags:` | Tags |
| `categories:` | Categories |
| Content | Post Content |

### Handling Code Blocks

Hugo code blocks are compatible with WordPress. The syntax is:

**Hugo:**
```markdown
```python
print("Hello World")
```
```

This will render correctly in WordPress. For syntax highlighting, install a plugin like:
- **Syntax Highlighter Evolved**
- **Crayon Syntax Highlighter**
- **Prism.js**

## Post-Migration Tasks

### 1. Permalinks Setup

Set up SEO-friendly URLs:

1. Go to `Settings > Permalinks`
2. Select `Post name` structure
3. Click `Save Changes`

### 2. Install Essential Plugins

Recommended plugins for your migrated site:

```bash
# SEO
- Yoast SEO or Rank Math

# Performance
- WP Super Cache or W3 Total Cache
- Autoptimize

# Security
- Wordfence Security
- Sucuri Security

# Backup
- UpdraftPlus
- BackupBuddy

# Code Highlighting
- Syntax Highlighter Evolved
- Prism.js Syntax Highlighter
```

Install via `Plugins > Add New`

### 3. Configure SEO

1. Install Yoast SEO
2. Go to `SEO > General`
3. Run the Configuration Wizard
4. Set up XML sitemap
5. Submit sitemap to Google Search Console

### 4. Set Up Google Analytics

1. Create Google Analytics account
2. Get tracking ID
3. Install plugin like "MonsterInsights" or "Google Analytics for WordPress"
4. Add tracking ID
5. Verify tracking is working

### 5. Test All Functionality

- [ ] Homepage displays posts correctly
- [ ] Single posts display properly
- [ ] Categories and tags work
- [ ] Search functionality works
- [ ] Comments system works (if enabled)
- [ ] Sidebar widgets display correctly
- [ ] Footer widgets display correctly
- [ ] Mobile responsiveness
- [ ] All images load correctly
- [ ] Internal links work
- [ ] External links work

### 6. Set Up 301 Redirects

If your URL structure changed, set up redirects:

**Option A: Use Plugin**
- Install "Redirection" plugin
- Go to `Tools > Redirection`
- Add redirects from old Hugo URLs to new WordPress URLs

**Option B: .htaccess**
```apache
# Add to .htaccess file
Redirect 301 /posts/old-post-slug/ /new-post-slug/
```

### 7. Update robots.txt

Create/update `robots.txt` file:

```
User-agent: *
Disallow: /wp-admin/
Disallow: /wp-includes/
Allow: /wp-admin/admin-ajax.php

Sitemap: http://opensourcebox.com/sitemap_index.xml
```

### 8. Create Key Pages

Don't forget to create:
- [ ] About page
- [ ] Contact page
- [ ] Privacy Policy page
- [ ] Terms of Service page

## Troubleshooting

### Issue: Posts not displaying

**Solution:**
- Go to `Settings > Reading`
- Ensure "Your homepage displays" is set to "Your latest posts"
- Or set a custom homepage and posts page

### Issue: Images not showing

**Solution:**
- Re-upload images via Media Library
- Update image URLs in posts
- Use "Search & Replace" plugin to bulk update URLs

### Issue: Formatting issues in posts

**Solution:**
- Install "Classic Editor" plugin for better markdown compatibility
- Or manually fix formatting in Gutenberg editor
- Use "HTML to Markdown" converter if needed

### Issue: Code blocks not formatted

**Solution:**
- Install syntax highlighting plugin
- Configure code block settings
- Re-format code blocks if needed

### Issue: 404 errors

**Solution:**
- Go to `Settings > Permalinks`
- Click `Save Changes` (this flushes rewrite rules)
- Clear browser cache

### Issue: Theme not displaying correctly

**Solution:**
- Verify theme is activated
- Check PHP error logs
- Ensure WordPress version is compatible
- Disable plugins one by one to find conflicts

## Additional Resources

- [WordPress Codex](https://codex.wordpress.org/)
- [WordPress Support Forums](https://wordpress.org/support/)
- [Hugo to WordPress Migration Tools](https://github.com/topics/hugo-to-wordpress)
- [WordPress Theme Development](https://developer.wordpress.org/themes/)

## Migration Checklist

- [ ] WordPress installed and configured
- [ ] OpenSourceBox theme installed and activated
- [ ] Content converted from Hugo to WordPress format
- [ ] Posts imported successfully
- [ ] Tags and categories mapped correctly
- [ ] Images uploaded and working
- [ ] Permalinks configured
- [ ] Essential plugins installed
- [ ] SEO configured
- [ ] Analytics set up
- [ ] All pages tested
- [ ] 301 redirects configured (if needed)
- [ ] robots.txt updated
- [ ] Sitemap submitted to search engines
- [ ] Mobile responsiveness verified
- [ ] Site backup created

## Support

If you encounter issues during migration:

1. Check WordPress debug log
2. Search WordPress support forums
3. Contact OpenSourceBox support
4. Review theme documentation

---

Good luck with your migration! Once complete, you'll have a fully functional WordPress site with all your Hugo content.
