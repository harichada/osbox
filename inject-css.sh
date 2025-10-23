#!/bin/bash

# Script to inject custom CSS into all Hugo-generated HTML files
# This adds the exciting modern design to your live site

echo "🎨 Injecting exciting custom CSS into HTML files..."

# CSS link to inject
CSS_LINK='<link rel="stylesheet" href="/css/custom.css">'

# Find all HTML files and inject the CSS link before </head>
find public -name "*.html" -type f | while read file; do
    # Check if custom.css is already included
    if ! grep -q "custom.css" "$file"; then
        # Inject before </head>
        sed -i "s|</head>|  $CSS_LINK\n</head>|" "$file"
        echo "✅ Updated: $file"
    else
        echo "⏭️  Skipped (already has custom CSS): $file"
    fi
done

echo ""
echo "🎉 Done! Your site now has the exciting modern design!"
echo ""
echo "📝 Next steps:"
echo "1. Test locally: Open public/index.html in a browser"
echo "2. Deploy: Push the updated 'public' directory to your server"
echo ""
