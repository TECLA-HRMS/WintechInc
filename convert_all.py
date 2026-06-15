import os
import glob

base_dir = r"c:\xampp\htdocs\wintech-new\resources\views\site"

files = glob.glob(os.path.join(base_dir, "**/*.blade.php"), recursive=True)

success_count = 0
failed_files = []

for file in files:
    # Skip home/index.blade.php as it's already done
    if r"site\home\index.blade.php" in file or r"site/home/index.blade.php" in file:
        continue
    # Skip login page
    if r"site\login\index.blade.php" in file or r"site/login/index.blade.php" in file:
        continue

    with open(file, "r", encoding="utf-8") as f:
        content = f.read()

    # Skip if already extending
    if "@extends('layouts.site')" in content:
        print(f"Skipping (already extends): {file}")
        continue

    # Try to find the content area
    
    # 1. Find end of header
    header_end = content.find('<!-- ENd Header Area -->')
    if header_end != -1:
        # Find the last occurrence of <!-- ENd Header Area --> before the footer
        # Some files have multiple headers (commented out)
        # Let's find the LAST one before the footer
        pass
    
    # Let's use a simpler heuristic:
    # 1. Find the first occurrence of <div class="rts-breadcrumb-area
    # OR 
    # Find the end of the header navigation
    
    start_idx = -1
    if '<div class="rts-breadcrumb-area' in content:
        start_idx = content.find('<div class="rts-breadcrumb-area')
    else:
        # fallback, find '<!-- ENd Header Area -->'
        start_idx = content.rfind('<!-- ENd Header Area -->')
        if start_idx != -1:
            start_idx += len('<!-- ENd Header Area -->')
            # skip <body> if present
            body_tag = content.find('<body>', start_idx)
            if body_tag != -1 and body_tag < start_idx + 100:
                start_idx = body_tag + 6

    end_idx = -1
    if '<!-- rts footer area start -->' in content:
        end_idx = content.find('<!-- rts footer area start -->')
    elif '<div class="rts-footer-area' in content:
        end_idx = content.find('<div class="rts-footer-area')

    if start_idx != -1 and end_idx != -1 and start_idx < end_idx:
        core_content = content[start_idx:end_idx].strip()
        new_content = "@extends('layouts.site')\n@section('content')\n\n" + core_content + "\n\n@endsection\n"
        with open(file, "w", encoding="utf-8") as f:
            f.write(new_content)
        success_count += 1
        print(f"Converted: {file}")
    else:
        failed_files.append((file, start_idx, end_idx))
        print(f"Failed to find bounds: {file} (start: {start_idx}, end: {end_idx})")

print(f"Successfully converted {success_count} files.")
if failed_files:
    print(f"Failed {len(failed_files)} files.")
