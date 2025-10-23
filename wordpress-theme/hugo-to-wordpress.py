#!/usr/bin/env python3
"""
Hugo to WordPress Migration Script
Converts Hugo markdown posts to WordPress WXR format
"""

import os
import re
from datetime import datetime
import xml.etree.ElementTree as ET
from xml.dom import minidom

def parse_hugo_frontmatter(content):
    """Parse Hugo frontmatter from markdown file"""
    frontmatter = {}
    body = content

    # Check for YAML frontmatter (---)
    if content.startswith('---'):
        parts = content.split('---', 2)
        if len(parts) >= 3:
            yaml_content = parts[1].strip()
            body = parts[2].strip()

            # Parse YAML frontmatter manually
            for line in yaml_content.split('\n'):
                line = line.strip()
                if ':' in line and not line.startswith('#'):
                    key, value = line.split(':', 1)
                    key = key.strip()
                    value = value.strip()

                    # Remove quotes from value
                    value = value.strip('"').strip("'")

                    # Handle arrays [item1, item2]
                    if value.startswith('[') and value.endswith(']'):
                        # Parse array
                        items = value[1:-1].split(',')
                        frontmatter[key] = [item.strip().strip('"').strip("'") for item in items]
                    else:
                        frontmatter[key] = value

    return frontmatter, body

def escape_cdata(text):
    """Properly escape text for CDATA sections"""
    if text is None:
        return ""
    # Convert markdown to HTML-ish (basic conversion)
    # Replace code blocks
    text = re.sub(r'```(\w+)?\n(.*?)```', r'<pre><code>\2</code></pre>', text, flags=re.DOTALL)
    # Replace inline code
    text = re.sub(r'`([^`]+)`', r'<code>\1</code>', text)
    # Replace headers
    text = re.sub(r'^### (.+)$', r'<h3>\1</h3>', text, flags=re.MULTILINE)
    text = re.sub(r'^## (.+)$', r'<h2>\1</h2>', text, flags=re.MULTILINE)
    # Replace bold
    text = re.sub(r'\*\*(.+?)\*\*', r'<strong>\1</strong>', text)
    # Replace italic
    text = re.sub(r'\*(.+?)\*', r'<em>\1</em>', text)
    # Replace links
    text = re.sub(r'\[([^\]]+)\]\(([^\)]+)\)', r'<a href="\2">\1</a>', text)
    # Replace line breaks
    text = text.replace('\n\n', '</p><p>')
    text = '<p>' + text + '</p>'
    return text

def hugo_to_wordpress_xml(content_dir, output_file):
    """Convert Hugo markdown posts to WordPress WXR format"""

    print(f"Converting Hugo posts from: {content_dir}")
    print(f"Output file: {output_file}")

    # Create XML structure
    rss = ET.Element('rss')
    rss.set('version', '2.0')
    rss.set('xmlns:excerpt', 'http://wordpress.org/export/1.2/excerpt/')
    rss.set('xmlns:content', 'http://purl.org/rss/1.0/modules/content/')
    rss.set('xmlns:wfw', 'http://wellformedweb.org/CommentAPI/')
    rss.set('xmlns:dc', 'http://purl.org/dc/elements/1.1/')
    rss.set('xmlns:wp', 'http://wordpress.org/export/1.2/')

    channel = ET.SubElement(rss, 'channel')
    ET.SubElement(channel, 'title').text = 'OpenSourceBox'
    ET.SubElement(channel, 'link').text = 'http://opensourcebox.com'
    ET.SubElement(channel, 'description').text = 'OpenSourceBox Blog'
    ET.SubElement(channel, 'pubDate').text = datetime.now().strftime('%a, %d %b %Y %H:%M:%S +0000')
    ET.SubElement(channel, 'language').text = 'en-US'

    wp_version = ET.SubElement(channel, 'wp:wxr_version')
    wp_version.text = '1.2'

    # Process all markdown files
    posts_dir = os.path.join(content_dir, 'posts')

    if not os.path.exists(posts_dir):
        print(f"Error: Posts directory not found: {posts_dir}")
        return

    file_count = 0
    for filename in sorted(os.listdir(posts_dir)):
        if filename.endswith('.md'):
            filepath = os.path.join(posts_dir, filename)
            print(f"Processing: {filename}")

            try:
                with open(filepath, 'r', encoding='utf-8') as f:
                    content = f.read()

                # Parse frontmatter and content
                meta, body = parse_hugo_frontmatter(content)

                # Create item element for each post
                item = ET.SubElement(channel, 'item')

                # Title
                title = ET.SubElement(item, 'title')
                title.text = meta.get('title', filename.replace('.md', ''))

                # Link (will be set by WordPress)
                link = ET.SubElement(item, 'link')
                link.text = 'http://opensourcebox.com/' + filename.replace('.md', '').lower().replace(' ', '-')

                # Pub Date
                date_str = meta.get('date', '2022-01-01')
                try:
                    if 'T' in date_str:
                        date_obj = datetime.fromisoformat(date_str.replace('Z', '+00:00'))
                    else:
                        date_obj = datetime.strptime(str(date_str), '%Y-%m-%d')
                except:
                    date_obj = datetime.now()

                pubdate = ET.SubElement(item, 'pubDate')
                pubdate.text = date_obj.strftime('%a, %d %b %Y %H:%M:%S +0000')

                # Creator
                creator = ET.SubElement(item, 'dc:creator')
                creator.text = meta.get('author', 'Admin')

                # Description (excerpt)
                description = ET.SubElement(item, 'description')
                description.text = meta.get('description', '')

                # Content
                content_encoded = ET.SubElement(item, 'content:encoded')
                content_encoded.text = escape_cdata(body)

                # Excerpt
                excerpt = ET.SubElement(item, 'excerpt:encoded')
                excerpt.text = meta.get('description', '')

                # Post ID (sequential)
                post_id = ET.SubElement(item, 'wp:post_id')
                post_id.text = str(file_count + 1)

                # Post date
                post_date = ET.SubElement(item, 'wp:post_date')
                post_date.text = date_obj.strftime('%Y-%m-%d %H:%M:%S')

                post_date_gmt = ET.SubElement(item, 'wp:post_date_gmt')
                post_date_gmt.text = date_obj.strftime('%Y-%m-%d %H:%M:%S')

                # Post name (slug)
                post_name = ET.SubElement(item, 'wp:post_name')
                post_name.text = filename.replace('.md', '').lower().replace(' ', '-')

                # Post status
                post_status = ET.SubElement(item, 'wp:status')
                post_status.text = 'publish'

                # Post type
                post_type = ET.SubElement(item, 'wp:post_type')
                post_type.text = 'post'

                # Categories
                categories = meta.get('categories', [])
                if isinstance(categories, str):
                    categories = [categories]

                for cat in categories:
                    category = ET.SubElement(item, 'category')
                    category.set('domain', 'category')
                    category.set('nicename', cat.lower().replace(' ', '-'))
                    category.text = cat

                # Tags
                tags = meta.get('tags', [])
                if isinstance(tags, str):
                    tags = [tags]

                for tag in tags:
                    tag_elem = ET.SubElement(item, 'category')
                    tag_elem.set('domain', 'post_tag')
                    tag_elem.set('nicename', tag.lower().replace(' ', '-'))
                    tag_elem.text = tag

                file_count += 1

            except Exception as e:
                print(f"Error processing {filename}: {e}")
                continue

    print(f"\nProcessed {file_count} posts")

    # Write XML file with pretty formatting
    xml_str = ET.tostring(rss, encoding='utf-8')
    dom = minidom.parseString(xml_str)
    pretty_xml = dom.toprettyxml(indent='  ', encoding='utf-8')

    with open(output_file, 'wb') as f:
        f.write(pretty_xml)

    print(f'WordPress export file created: {output_file}')
    print(f'\nNext steps:')
    print(f'1. Log in to WordPress admin')
    print(f'2. Go to Tools > Import > WordPress')
    print(f'3. Upload {output_file}')
    print(f'4. Follow the import wizard')

if __name__ == '__main__':
    import sys

    # Get content directory from command line or use default
    if len(sys.argv) > 1:
        content_dir = sys.argv[1]
    else:
        content_dir = '/home/user/osbox/content'

    # Output file
    if len(sys.argv) > 2:
        output_file = sys.argv[2]
    else:
        output_file = 'wordpress-import.xml'

    # Run conversion
    hugo_to_wordpress_xml(content_dir, output_file)
