#!/bin/bash
#
# Fix SEO: Remove noindex/nofollow meta tags from all HTML files
#
# CRITICAL ISSUE: Hugo generated the site with noindex/nofollow tags
# This script removes those tags to allow search engine indexing
#

echo "🔍 Scanning for noindex meta tags..."

# Count files with noindex before fix
BEFORE_COUNT=$(grep -r 'name="robots".*noindex' public/ | wc -l)
echo "Found $BEFORE_COUNT occurrences of noindex tags"

echo ""
echo "🔧 Removing noindex/nofollow meta tags..."

# Find all HTML files and remove the noindex/nofollow meta tags
find public -name "*.html" -type f | while read file; do
    # Remove the full line containing robots noindex/nofollow
    sed -i '/<meta name="robots" content="noindex, nofollow">/d' "$file"
    sed -i '/<meta name="robots" content="noindex">/d' "$file"
done

echo ""
echo "✅ Cleanup complete!"

# Count files with noindex after fix
AFTER_COUNT=$(grep -r 'name="robots".*noindex' public/ 2>/dev/null | wc -l)
echo "Remaining noindex tags: $AFTER_COUNT"

if [ $AFTER_COUNT -eq 0 ]; then
    echo ""
    echo "✨ SUCCESS! All noindex tags have been removed."
    echo ""
    echo "📈 Your site is now ready for search engine indexing!"
    echo ""
    echo "Next steps:"
    echo "  1. Deploy the updated public/ directory to your server"
    echo "  2. Submit sitemap to Google Search Console"
    echo "  3. Request indexing for key pages"
else
    echo ""
    echo "⚠️  Warning: $AFTER_COUNT noindex tags still remain"
    echo "Please review manually."
fi

echo ""
echo "🔍 Verification - Checking homepage..."
if grep -q 'name="robots".*noindex' public/index.html 2>/dev/null; then
    echo "❌ Homepage still has noindex tag"
else
    echo "✅ Homepage is clean - ready for indexing!"
fi
