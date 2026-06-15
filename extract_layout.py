import os
import re

base_dir = r"c:\xampp\htdocs\wintech-new\resources\views"
index_file = os.path.join(base_dir, r"site\home\index.blade.php")

with open(index_file, "r", encoding="utf-8") as f:
    content = f.read()

# Try to find logical split points
# 1. head (everything up to and including </head> and maybe `<style>` following it)
# The head and styles and schemas end right before `<header class="header--sticky header-one ">`
header_start = content.find('<header class="header--sticky header-one ">')
head_content = content[:header_start]

# 2. header (from <header> up to <!-- banner blank space area --><body>)
body_start = content.find('<!-- banner blank space area --><body>')
if body_start == -1:
    body_start = content.find('<body>')
header_content = content[header_start:body_start]

# 3. body / content (from body_start to the footer)
# Footer starts at <div class="rts-footer-area footer-one rts-section-gapTop bg-footer-one">
footer_start = content.find('<div class="rts-footer-area footer-one rts-section-gapTop bg-footer-one">')
if footer_start == -1:
    # Look for whatsapp/call icons which might be part of footer or content
    footer_start = content.find('<style>\n\t.whatsapp {')

body_content = content[body_start:footer_start]

# 4. footer (from footer_start to <!-- progress Back to top -->)
script_start = content.find('<!-- progress Back to top -->')
if script_start == -1:
    script_start = content.find('<script src="')

footer_content = content[footer_start:script_start]

# 5. script (from script_start to end of file)
script_content = content[script_start:]

# Create layout parts
layouts_dir = os.path.join(base_dir, "layouts")
includes_dir = os.path.join(base_dir, "includes", "site")

os.makedirs(layouts_dir, exist_ok=True)
os.makedirs(includes_dir, exist_ok=True)

with open(os.path.join(includes_dir, "head.blade.php"), "w", encoding="utf-8") as f:
    f.write(head_content)

with open(os.path.join(includes_dir, "header.blade.php"), "w", encoding="utf-8") as f:
    f.write(header_content)

with open(os.path.join(includes_dir, "footer.blade.php"), "w", encoding="utf-8") as f:
    f.write(footer_content)

with open(os.path.join(includes_dir, "script.blade.php"), "w", encoding="utf-8") as f:
    f.write(script_content)

# Create layout file
layout_content = """@include('includes.site.head')
<body>
@include('includes.site.header')

@yield('content')

@include('includes.site.footer')
@include('includes.site.script')
"""
with open(os.path.join(layouts_dir, "site.blade.php"), "w", encoding="utf-8") as f:
    f.write(layout_content)

# Update index.blade.php
# We need to strip <body> tag if it's in body_content since it's now in layout
body_content = body_content.replace('<!-- banner blank space area --><body>', '')
body_content = body_content.replace('<body>', '')
body_content = body_content.replace('</body>\n</html>', '') # Remove closing tags if they are in body_content (they usually aren't, they are in script_content)

new_index_content = """@extends('layouts.site')
@section('content')
""" + body_content + "\n@endsection\n"

with open(index_file, "w", encoding="utf-8") as f:
    f.write(new_index_content)

print("Extraction complete. Layout and includes created, index.blade.php updated.")
