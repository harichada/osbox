#!/bin/bash
#
# Add proper meta descriptions to homepage and archive pages
#
# This fixes the empty meta descriptions on:
# - Homepage
# - Category pages
# - Tag pages
#

echo "🔍 Adding meta descriptions to pages..."

# Define the site description
SITE_DESC="OpenSourceBox - Your source for AI, Machine Learning, and Open Source technology tutorials, guides, and best practices."

# Fix homepage
echo "  ➜ Fixing homepage..."
sed -i 's/<meta name="description" content="">/<meta name="description" content="'"$SITE_DESC"'">/' /home/user/osbox/public/index.html

# Fix categories index
echo "  ➜ Fixing categories index..."
sed -i 's/<meta name="description" content="">/<meta name="description" content="Browse articles by category - AI, Machine Learning, Open Source, Healthcare, Finance, Server Administration, and more.">/' /home/user/osbox/public/categories/index.html

# Fix tags index
echo "  ➜ Fixing tags index..."
sed -i 's/<meta name="description" content="">/<meta name="description" content="Browse articles by tag - Explore topics in AI, Machine Learning, NLP, Deep Learning, Open Source technologies, and more.">/' /home/user/osbox/public/tags/index.html

# Fix AI category
if [ -f /home/user/osbox/public/categories/ai/index.html ]; then
    echo "  ➜ Fixing AI category..."
    sed -i 's/<meta name="description" content="">/<meta name="description" content="Artificial Intelligence tutorials, guides, and best practices. Learn about AI algorithms, neural networks, and practical applications.">/' /home/user/osbox/public/categories/ai/index.html
fi

# Fix Open Source category
if [ -f /home/user/osbox/public/categories/open-source/index.html ]; then
    echo "  ➜ Fixing Open Source category..."
    sed -i 's/<meta name="description" content="">/<meta name="description" content="Open Source software guides, tutorials, and tools. Learn about open source AI, ML frameworks, and development best practices.">/' /home/user/osbox/public/categories/open-source/index.html
fi

# Fix Server Administration category
if [ -f /home/user/osbox/public/categories/server-administration/index.html ]; then
    echo "  ➜ Fixing Server Administration category..."
    sed -i 's/<meta name="description" content="">/<meta name="description" content="Server administration guides, system management tutorials, and infrastructure best practices for Linux and open source systems.">/' /home/user/osbox/public/categories/server-administration/index.html
fi

# Fix Healthcare category
if [ -f /home/user/osbox/public/categories/healthcare/index.html ]; then
    echo "  ➜ Fixing Healthcare category..."
    sed -i 's/<meta name="description" content="">/<meta name="description" content="AI and Machine Learning applications in healthcare. Medical data analysis, diagnostic tools, and healthcare technology innovations.">/' /home/user/osbox/public/categories/healthcare/index.html
fi

# Fix Finance category
if [ -f /home/user/osbox/public/categories/finance/index.html ]; then
    echo "  ➜ Fixing Finance category..."
    sed -i 's/<meta name="description" content="">/<meta name="description" content="AI and Machine Learning in finance. Fraud detection, predictive analytics, algorithmic trading, and financial technology applications.">/' /home/user/osbox/public/categories/finance/index.html
fi

# Fix Chatbots category
if [ -f /home/user/osbox/public/categories/chatbots/index.html ]; then
    echo "  ➜ Fixing Chatbots category..."
    sed -i 's/<meta name="description" content="">/<meta name="description" content="Chatbot development tutorials and guides. Build AI-powered conversational interfaces using open source tools and frameworks.">/' /home/user/osbox/public/categories/chatbots/index.html
fi

# Fix common tag pages
for tag in ai ml nlp "machine-learning" "deep-learning" "open-source" apis chatbots "sentiment-analysis"; do
    TAG_FILE="/home/user/osbox/public/tags/${tag}/index.html"
    if [ -f "$TAG_FILE" ]; then
        echo "  ➜ Fixing tag: $tag..."
        sed -i 's/<meta name="description" content="">/<meta name="description" content="Articles tagged with '"${tag}"'. Explore tutorials, guides, and best practices.">/' "$TAG_FILE"
    fi
done

echo ""
echo "✅ Meta descriptions added!"
echo ""
echo "🔍 Verification..."
grep '<meta name="description"' /home/user/osbox/public/index.html

echo ""
echo "📊 Summary:"
EMPTY_DESC=$(grep -r '<meta name="description" content="">' /home/user/osbox/public/*.html 2>/dev/null | wc -l)
echo "  • Remaining pages with empty descriptions: $EMPTY_DESC"
echo "  • Homepage: $(grep 'description' /home/user/osbox/public/index.html | grep -v 'content=""' > /dev/null && echo '✅ Fixed' || echo '⚠️  Check')"
