import os

failed_files = [
    r"c:\xampp\htdocs\wintech-new\resources\views\site\blog\index.blade.php",
    r"c:\xampp\htdocs\wintech-new\resources\views\site\digital-marketing\index.blade.php",
    r"c:\xampp\htdocs\wintech-new\resources\views\site\e-commerce-development\index.blade.php",
    r"c:\xampp\htdocs\wintech-new\resources\views\site\mobile-app-development\index.blade.php",
    r"c:\xampp\htdocs\wintech-new\resources\views\site\web-development\index.blade.php"
]

for file in failed_files:
    if not os.path.exists(file):
        continue
        
    with open(file, "r", encoding="utf-8") as f:
        content = f.read()

    if "@extends('layouts.site')" in content:
        print(f"Skipping (already extends): {file}")
        continue

    # Find start
    start_idx = content.find('<!-- banner blank space area --><body>')
    if start_idx != -1:
        start_idx += len('<!-- banner blank space area --><body>')
    else:
        # try <body>
        start_idx = content.find('<body>')
        if start_idx != -1:
            start_idx += 6

    # Find end
    # These files usually have <footer... or rts-footer-area
    end_idx = content.find('<div class="rts-footer-area')
    if end_idx == -1:
        end_idx = content.find('<!-- rts footer area')
    if end_idx == -1:
        # look for copyright area
        end_idx = content.find('<!-- copyright area start -->')

    if start_idx != -1 and end_idx != -1 and start_idx < end_idx:
        core_content = content[start_idx:end_idx].strip()
        new_content = "@extends('layouts.site')\n@section('content')\n\n" + core_content + "\n\n@endsection\n"
        with open(file, "w", encoding="utf-8") as f:
            f.write(new_content)
        print(f"Converted: {file}")
    else:
        print(f"Still failed: {file} (start: {start_idx}, end: {end_idx})")
