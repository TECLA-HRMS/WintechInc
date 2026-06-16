{{-- Modern Footer Section --}}
<footer class="modern-footer" style="background: #090e24 !important; color: #f8fafc !important; padding-top: 50px; padding-bottom: 20px; position: relative; overflow: hidden; z-index: 1;">
    <div class="footer-cta-container">
        <div class="container">
            <div class="footer-cta-card">
                <div class="footer-cta-text">
                    <h3>Ready to transform your business?</h3>
                    <p>Contact our experts today and discover custom staffing & IT solutions.</p>
                </div>
                <div class="footer-cta-actions">
                    <a href="{{ url('contact') }}" class="footer-cta-btn">Get In Touch <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container main-footer-content">
        <div class="row g-5">
            <!-- Column 1: Brand Profile -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="footer-widget brand-widget">
                    <div class="footer-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('logo.png') }}" alt="Wintech Inc" class="brand-logo-img">
                        </a>
                    </div>
                    <p class="brand-desc">
                        Wintech Inc is a leading provider of comprehensive IT recruitment services, non-IT staffing solutions, digital marketing strategies, and robust software & mobile application development.
                    </p>
                    <div class="social-links-grid">
                        @if($fb = \App\Models\AdminSetting::get('fb_link'))
                            <a href="{{ $fb }}" target="_blank" class="social-btn facebook" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if($instagram = \App\Models\AdminSetting::get('instagram_link'))
                            <a href="{{ $instagram }}" target="_blank" class="social-btn instagram" aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if($twitter = \App\Models\AdminSetting::get('twitter_link'))
                            <a href="{{ $twitter }}" target="_blank" class="social-btn twitter" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                        @if($linkedin = \App\Models\AdminSetting::get('linkedin_link'))
                            <a href="{{ $linkedin }}" target="_blank" class="social-btn linkedin" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif
                        @if($youtube = \App\Models\AdminSetting::get('youtube_link'))
                            <a href="{{ $youtube }}" target="_blank" class="social-btn youtube" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12">
                <div class="footer-widget link-widget">
                    <h4 class="widget-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('best-placement-services-for-candidate-in-chennai') }}">Placement Service (Candidate)</a></li>
                        <li><a href="{{ url('best-manpower-suppliers-services-for-candidate-in-chennai') }}">Manpower Suppliers</a></li>
                        <li><a href="{{ url('best-placement-service-for-employers-services-for-candidate-in-chennai') }}">Placement (For Employers)</a></li>
                        <li><a href="{{ url('best-manpower-consultants-services-in-chennai') }}">Manpower Consultants</a></li>
                        <li><a href="{{ url('best-placement-service-for-it-industry-in-chennai') }}">IT Industry Placement</a></li>
                    </ul>
                </div>
            </div>

            <!-- Column 3: Exclusive Services -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="footer-widget link-widget">
                    <h4 class="widget-title">Exclusive Services</h4>
                    <ul class="footer-links">
                        <li><a href="{{ url('digital-marketing') }}">Digital Marketing</a></li>
                        <li><a href="{{ url('web-development') }}">Web Development</a></li>
                        <li><a href="{{ url('e-commerce-development') }}">E commerce Development</a></li>
                        <li><a href="{{ url('mobile-app-development') }}">Mobile App Development</a></li>
                    </ul>
                </div>
            </div>

            <!-- Column 4: Contact Info -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="footer-widget contact-widget">
                    <h4 class="widget-title">Contact Us</h4>
                    <div class="contact-info-list">
                        <div class="contact-item">
                            <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
                            <p>{{ \App\Models\AdminSetting::get('site_address') ?: 'No 8/235, Pillaiyar Kovil St, Vasanth Vihar, Polichalur, Chennai 600074.' }}</p>
                        </div>
                        <div class="contact-item">
                            <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                            <p><a href="tel:{{ \App\Models\AdminSetting::get('site_phone') ?: '+919940436371' }}">{{ \App\Models\AdminSetting::get('site_phone') ?: '+91 9940436371' }}</a></p>
                        </div>
                        <div class="contact-item">
                            <div class="icon-box"><i class="fas fa-envelope"></i></div>
                            <p><a href="mailto:{{ \App\Models\AdminSetting::get('site_email') ?: 'lochana@wintechinc.in' }}">{{ \App\Models\AdminSetting::get('site_email') ?: 'lochana@wintechinc.in' }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Area -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p class="copyright-text">&copy; {{ date('Y') }} Wintech Inc. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <span>•</span>
                    <a href="#">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- Floating Action Utilities --}}
<div class="floating-utilities">
    @php
        $phoneRaw = \App\Models\AdminSetting::get('site_phone') ?: '+919940436371';
        $phoneNum = preg_replace('/[^0-9+]/', '', $phoneRaw);
    @endphp
    <!-- WhatsApp -->
    <a href="https://api.whatsapp.com/send?phone={{ $phoneNum }}&text=Hello!%20I%20would%20like%20to%20know%20more%20about%20your%20services." target="_blank" class="float-btn whatsapp-btn" title="Chat on WhatsApp">
        <img src="{{ asset('whatsapp.png') }}" alt="WhatsApp">
    </a>
    <!-- Phone Call -->
    <a href="tel:{{ $phoneNum }}" class="float-btn call-btn" title="Call Us Now">
        <img src="{{ asset('call.gif') }}" alt="Call">
    </a>
</div>

{{-- Premium Footer Styling --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.modern-footer {
    background: #090e24 !important;
    color: #f8fafc !important;
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

/* Background Gradients */
.modern-footer::before {
    content: '';
    position: absolute;
    top: -200px;
    right: -200px;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(232, 73, 36, 0.15) 0%, transparent 70%);
    z-index: -1;
    pointer-events: none;
}
.modern-footer::after {
    content: '';
    position: absolute;
    bottom: -150px;
    left: -150px;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(7, 16, 86, 0.5) 0%, transparent 70%);
    z-index: -1;
    pointer-events: none;
}

/* CTA Card */
.footer-cta-container {
    transform: translateY(-40px);
    margin-bottom: -10px;
}
.footer-cta-card {
    background: #b11e24;
    border-radius: 24px;
    padding: 40px 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 20px 40px rgba(232, 73, 36, 0.25);
    flex-wrap: wrap;
    gap: 30px;
}
.footer-cta-text h3 {
    color: #fff;
    font-size: 28px;
    font-weight: 800;
    margin: 0 0 8px;
    letter-spacing: -0.5px;
}
.footer-cta-text p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 15px;
    margin: 0;
}
.footer-cta-btn {
    background: #fff;
    color: #ba1c26;
    padding: 16px 36px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none !important;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}
.footer-cta-btn i {
    transition: transform 0.3s ease;
}
.footer-cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    background: #090e24;
    color: #fff;
}
.footer-cta-btn:hover i {
    transform: translateX(4px);
}

/* Content Area */
.main-footer-content {
    padding-bottom: 10px;
    padding-top: 20px;
}
.footer-widget {
    margin-bottom: 20px;
}
.brand-logo-img {
    height: 52px;
    background: #fff;
    padding: 8px 16px;
    border-radius: 12px;
    margin-bottom: 24px;
    box-shadow: 0 8px 16px rgba(255, 255, 255, 0.05);
}
.brand-desc {
    color: #94a3b8;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 28px;
}

/* Social Buttons */
.social-links-grid {
    display: flex;
    gap: 12px;
}
.social-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #cbd5e1;
    font-size: 16px;
    text-decoration: none !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.social-btn:hover {
    color: #fff;
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
.social-btn.facebook:hover {
    background: #1877f2;
    border-color: #1877f2;
}
.social-btn.instagram:hover {
    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    border-color: #e6683c;
}

/* Quick & Service Links */
.widget-title {
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 24px;
    position: relative;
    padding-bottom: 12px;
}
.widget-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 32px;
    height: 2.5px;
    background: #e84924;
    border-radius: 2px;
}
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 3px;
}
.footer-links li a {
    color: #94a3b8;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none !important;
    transition: all 0.2s ease;
    display: inline-block;
}
.footer-links li a:hover {
    color: #e84924;
    transform: translateX(5px);
}

/* Contact Info list */
.contact-info-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}
.contact-item .icon-box {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(232, 73, 36, 0.1);
    border: 1px solid rgba(232, 73, 36, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #e84924;
    flex-shrink: 0;
}
.contact-item p {
    margin: 0;
    font-size: 14px;
    color: #94a3b8;
    line-height: 1.5;
}
.contact-item p a {
    color: inherit;
    text-decoration: none !important;
    transition: color 0.2s ease;
}
.contact-item p a:hover {
    color: #e84924;
}

/* Footer Bottom */
.footer-bottom {
    background: #060a1a;
    padding: 24px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.05);
}
.footer-bottom-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}
.copyright-text {
    color: #64748b;
    font-size: 13px;
    margin: 0;
}
.footer-bottom-links {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255, 255, 255, 0.15);
    font-size: 13px;
}
.footer-bottom-links a {
    color: #64748b;
    text-decoration: none !important;
    transition: color 0.2s ease;
}
.footer-bottom-links a:hover {
    color: #e84924;
}

/* Floating Utilities */
.floating-utilities {
    position: fixed;
    bottom: 30px;
    right: 30px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    z-index: 9999;
}
.float-btn {
    width: 50px;
    height: 50px;
    margin-bottom: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.float-btn:hover {
    transform: translateY(-5px) scale(1.05);
}
.float-btn img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
.whatsapp-btn {
    background: #25d366;
}
.call-btn {
    background: #fff;
    left: 30px;
    bottom: 30px;
    position: fixed !important;
}

/* Responsive Overrides */
@media (max-width: 991px) {
    .footer-cta-card {
        padding: 30px;
        text-align: center;
        flex-direction: column;
    }
    .footer-cta-btn {
        width: 100%;
        justify-content: center;
    }
    .footer-bottom-inner {
        flex-direction: column;
        text-align: center;
    }
}
</style>