#!/bin/bash
#
# Fix Open Graph and Twitter Card meta tags
# Add proper descriptions for better social media sharing
#

echo "🔧 Fixing Open Graph and Twitter Card tags..."

SITE_DESC="OpenSourceBox - Your source for AI, Machine Learning, and Open Source technology tutorials, guides, and best practices."

# Fix homepage Open Graph tags
echo "  ➜ Fixing homepage OG tags..."
sed -i 's|<meta property="og:description" content="" />|<meta property="og:description" content="'"$SITE_DESC"'" />|' /home/user/osbox/public/index.html
sed -i 's|<meta itemprop="description" content="">|<meta itemprop="description" content="'"$SITE_DESC"'">|' /home/user/osbox/public/index.html
sed -i 's|<meta name="twitter:description" content=""/>|<meta name="twitter:description" content="'"$SITE_DESC"'"/>|' /home/user/osbox/public/index.html

# Add Twitter card image if logo exists
if [ -f /home/user/osbox/public/images/logo.svg ]; then
    echo "  ➜ Adding logo to OG tags..."
    # Insert after og:url
    sed -i 's|<meta property="og:url" content="http://opensourcebox.com/" />|<meta property="og:url" content="http://opensourcebox.com/" />\n<meta property="og:image" content="http://opensourcebox.com/images/logo.svg" />|' /home/user/osbox/public/index.html
fi

echo ""
echo "✅ Open Graph tags updated!"
echo ""
echo "🔍 Verification:"
grep "og:description" /home/user/osbox/public/index.html
grep "twitter:description" /home/user/osbox/public/index.html

echo ""
echo "📱 Social media cards are now properly configured!"
