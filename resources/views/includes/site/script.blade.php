<!-- progress Back to top -->
<div class="progress-wrap">
   <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
   </svg>
</div>

<script src="{{ asset('Content/asset/staticweb/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/js/main.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/js/popper.min.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/js/script.js') }}"></script>
<script src="{{ asset('Content/asset/staticweb/js/jquery.validate.min.js') }}"></script>

<script src="{{ asset('assets/js/vendor/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jqueryui.js') }}"></script>
<script src="{{ asset('assets/js/vendor/waypoint.js') }}"></script>
<script src="{{ asset('assets/js/plugins/swiper.js') }}"></script>
<script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sal.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/contact.form.js') }}"></script>
<!-- main Js -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
    var swiper = new Swiper(".mySwipers", {
        loop: true,
        autoHeight: true,
        effect: 'fade',
        speed: 1500,
        autoplay: {
            delay: 1500,
        },
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        slidesPerView: 1, // Default to 1 slide at a time
        breakpoints: {
            768: {
                slidesPerView: 2, // Show 2 slides at a time on larger screens
            },
        },
    });
});

</script>
<script>
function showLoginPopup(e) {
    if (e) e.preventDefault();
    
    // Check if already exists
    if (document.getElementById('loginPopupModal')) {
        document.getElementById('loginPopupModal').style.display = 'flex';
        setTimeout(() => { document.getElementById('loginPopupModal').style.opacity = '1'; }, 10);
        return false;
    }
    
    const overlay = document.createElement('div');
    overlay.id = 'loginPopupModal';
    overlay.style.cssText = 'position:fixed;inset:0;background:rgba(15,23,42,0.6);backdrop-filter:blur(6px);z-index:999999;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);';
    
    const box = document.createElement('div');
    box.style.cssText = 'background:#ffffff;padding:32px 28px;border-radius:24px;width:90%;max-width:400px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);text-align:center;transform:scale(0.95) translateY(10px);transition:all 0.3s cubic-bezier(0.4, 0, 0.2, 1);position:relative;border:1px solid rgba(0,0,0,0.05);';
    
    box.innerHTML = `
        <button onclick="closeLoginPopup()" style="position:absolute;top:16px;right:16px;background:none;border:none;color:#9ca3af;cursor:pointer;padding:4px;display:flex;align-items:center;justify-content:center;border-radius:50%;transition:all 0.2s;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <div style="width:64px;height:64px;background:#FDEEEF;color:#B82025;border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;transform:rotate(-3deg);box-shadow:0 10px 15px -3px rgba(184,32,37,0.2);">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="transform:rotate(3deg);"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        </div>
        <h3 style="font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:800;color:#0f172a;margin:0 0 10px;line-height:1.2;">Sign in Required</h3>
        <p style="font-family:'Inter',sans-serif;font-size:14.5px;color:#64748b;margin:0 0 28px;line-height:1.5;">Please sign in or create a free account to apply for this job and track your applications.</p>
        <div style="display:flex;flex-direction:column;gap:12px;">
            <a href="{{ route('login') }}" style="display:flex;align-items:center;justify-content:center;width:100%;padding:14px;background:linear-gradient(135deg,#B82025,#D32F2F);color:#fff;text-decoration:none;border-radius:14px;font-weight:700;font-size:15px;font-family:'Inter',sans-serif;transition:all 0.2s;box-shadow:0 8px 16px rgba(184,32,37,0.25);">
                Sign In to Apply
            </a>
            <a href="{{ route('login') }}" onclick="sessionStorage.setItem('authTab','register')" style="display:flex;align-items:center;justify-content:center;width:100%;padding:14px;background:transparent;color:#0B1656;text-decoration:none;border-radius:14px;font-weight:700;font-size:15px;font-family:'Inter',sans-serif;border:2px solid #EAF0F6;transition:all 0.2s;">
                Create Free Account
            </a>
        </div>
    `;
    
    // Hover effects via JS for inline styles
    const primaryBtn = box.querySelector('a[href="{{ route('login') }}"]');
    if(primaryBtn) {
        primaryBtn.addEventListener('mouseenter', () => { primaryBtn.style.transform = 'translateY(-2px)'; primaryBtn.style.boxShadow = '0 12px 20px rgba(184,32,37,0.3)'; });
        primaryBtn.addEventListener('mouseleave', () => { primaryBtn.style.transform = 'translateY(0)'; primaryBtn.style.boxShadow = '0 8px 16px rgba(184,32,37,0.25)'; });
    }
    
    const secBtn = box.querySelectorAll('a')[1];
    if(secBtn) {
        secBtn.addEventListener('mouseenter', () => { secBtn.style.background = '#EAF0F6'; });
        secBtn.addEventListener('mouseleave', () => { secBtn.style.background = 'transparent'; });
    }

    const closeBtn = box.querySelector('button');
    if(closeBtn) {
        closeBtn.addEventListener('mouseenter', () => { closeBtn.style.background = '#f1f5f9'; closeBtn.style.color = '#0f172a'; });
        closeBtn.addEventListener('mouseleave', () => { closeBtn.style.background = 'none'; closeBtn.style.color = '#9ca3af'; });
    }
    
    overlay.appendChild(box);
    document.body.appendChild(overlay);
    
    // trigger animation
    setTimeout(() => {
        overlay.style.opacity = '1';
        box.style.transform = 'scale(1) translateY(0)';
    }, 10);
    
    // Close on click outside
    overlay.addEventListener('click', (e) => {
        if(e.target === overlay) closeLoginPopup();
    });
    
    return false;
}

function closeLoginPopup() {
    const overlay = document.getElementById('loginPopupModal');
    if(overlay) {
        overlay.style.opacity = '0';
        overlay.children[0].style.transform = 'scale(0.95) translateY(10px)';
        setTimeout(() => { overlay.style.display = 'none'; }, 300);
    }
}
</script>
<!-- scripts end form hear -->
</body>
</html>
