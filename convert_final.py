import os

failed_files = [
    r"c:\xampp\htdocs\wintech-new\resources\views\site\e-commerce-development\index.blade.php",
    r"c:\xampp\htdocs\wintech-new\resources\views\site\mobile-app-development\index.blade.php",
    r"c:\xampp\htdocs\wintech-new\resources\views\site\web-development\index.blade.php"
]

for file in failed_files:
    if not os.path.exists(file):
        continue
        
    with open(file, "r", encoding="utf-8") as f:
        content = f.read()

    # Find start
    start_idx = content.find('<!-- banner blank space area -->')
    if start_idx != -1:
        start_idx += len('<!-- banner blank space area -->')
        # skip <main id="main"> or <body> if it immediately follows
        tag_start = content.find('<', start_idx)
        if tag_start != -1 and tag_start - start_idx < 10:
            tag_end = content.find('>', tag_start)
            if tag_end != -1:
                # if it's <main id="main"> or <body>, keep it inside the content or exclude it?
                # Actually, layouts usually don't have <main>, so keep it.
                pass

    # Find end
    end_idx = content.find('<div class="rts-footer-area')
    if end_idx == -1:
        end_idx = content.find('<!-- rts footer area')
    if end_idx == -1:
        end_idx = content.find('<!-- copyright area start -->')

    if start_idx != -1 and end_idx != -1 and start_idx < end_idx:
        core_content = content[start_idx:end_idx].strip()
        
        # some might have stray </body> tag at the end of core_content, but usually not
        if core_content.startswith('<body>'):
            core_content = core_content[6:]
            
        new_content = "@extends('layouts.site')\n@section('content')\n\n" + core_content + "\n\n@endsection\n"
        with open(file, "w", encoding="utf-8") as f:
            f.write(new_content)
        print(f"Converted: {file}")
    else:
        print(f"Still failed: {file} (start: {start_idx}, end: {end_idx})")
