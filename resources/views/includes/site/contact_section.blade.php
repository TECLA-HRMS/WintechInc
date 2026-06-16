    <!-- start contact section -->
    <section class="contact-section" style="padding: 80px 0; background-color: #ffffff;">
        <div class="container" style="background-color: #0d1628; padding: 60px; border-radius: 24px; border: 1px solid #e2e8f0; box-shadow: 0 20px 40px rgba(13, 22, 40, 0.08);">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 mb-5 mb-lg-0 pr-lg-5">
                    <h2 style="color: white; font-weight: 700; margin-bottom: 20px;">Send Us a Message</h2>
                    <p style="color: #b0b5c1; margin-bottom: 40px;">Fill out the form and our team will get back to you within 24 hours. We offer expert, customized solutions to help your business achieve its goals and streamline your operations.</p>
                    <ul class="contact-benefits" style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 25px; display: flex; align-items: center;">
                            <span style="background-color: #ff5e14; color: white; border-radius: 50%; width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 12px; flex-shrink: 0;">
                                <i class="fas fa-check"></i>
                            </span>
                            Expert Consultation & Strategy
                        </li>
                        <li style="margin-bottom: 25px; display: flex; align-items: center;">
                            <span style="background-color: #ff5e14; color: white; border-radius: 50%; width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 12px; flex-shrink: 0;">
                                <i class="fas fa-check"></i>
                            </span>
                            Tailored Industry Solutions
                        </li>
                        <li style="margin-bottom: 25px; display: flex; align-items: center;">
                            <span style="background-color: #ff5e14; color: white; border-radius: 50%; width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 12px; flex-shrink: 0;">
                                <i class="fas fa-check"></i>
                            </span>
                            Dedicated Client Support
                        </li>
                        <li style="display: flex; align-items: center;">
                            <span style="background-color: #ff5e14; color: white; border-radius: 50%; width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 12px; flex-shrink: 0;">
                                <i class="fas fa-phone-alt"></i>
                            </span>
                            +91 99404 36371
                        </li>
                    </ul>
                </div>
                <div class="col-lg-7 col-md-12 pl-lg-4">
                    <div class="contact-form-wrapper" style="background: white; border-radius: 12px; padding: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
                        @if(session('success'))
                            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #c3e6cb; font-size: 15px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-check-circle" style="font-size: 18px;"></i>
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label style="color: #4a5568; font-size: 14px; font-weight: 600; margin-bottom: 8px; display: block;">Full Name *</label>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" style="width: 100%; padding: 14px 18px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; transition: all 0.3s ease; color: #1a202c; font-size: 15px; background-color: #f8fafc;" onfocus="this.style.borderColor='#ff5e14'; this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(255, 94, 20, 0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc'; this.style.boxShadow='none'" required>
                                    @error('name') <span class="text-danger" style="font-size: 13px; margin-top: 6px; display: block; font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label style="color: #4a5568; font-size: 14px; font-weight: 600; margin-bottom: 8px; display: block;">Email Address *</label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" style="width: 100%; padding: 14px 18px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; transition: all 0.3s ease; color: #1a202c; font-size: 15px; background-color: #f8fafc;" onfocus="this.style.borderColor='#ff5e14'; this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(255, 94, 20, 0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc'; this.style.boxShadow='none'" required>
                                    @error('email') <span class="text-danger" style="font-size: 13px; margin-top: 6px; display: block; font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label style="color: #4a5568; font-size: 14px; font-weight: 600; margin-bottom: 8px; display: block;">Phone Number *</label>
                                    <input type="tel" name="phonenumber" value="{{ old('phonenumber') }}" placeholder="+91 98765 43210" style="width: 100%; padding: 14px 18px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; transition: all 0.3s ease; color: #1a202c; font-size: 15px; background-color: #f8fafc;" onfocus="this.style.borderColor='#ff5e14'; this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(255, 94, 20, 0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc'; this.style.boxShadow='none'" required>
                                    @error('phonenumber') <span class="text-danger" style="font-size: 13px; margin-top: 6px; display: block; font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label style="color: #4a5568; font-size: 14px; font-weight: 600; margin-bottom: 8px; display: block;">Service Interested In *</label>
                                    <select name="service" style="width: 100%; padding: 14px 18px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; transition: all 0.3s ease; color: #4a5568; font-size: 15px; background-color: #f8fafc;" onfocus="this.style.borderColor='#ff5e14'; this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(255, 94, 20, 0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc'; this.style.boxShadow='none'" required>
                                        <option value="">Select a Service</option>
                                        <optgroup label="IT Sectors">
                                            <option value="Placement Service(Candidate)" {{ old('service') == 'Placement Service(Candidate)' ? 'selected' : '' }}>Placement Service(Candidate)</option>
                                            <option value="Placement Service (For Employers)" {{ old('service') == 'Placement Service (For Employers)' ? 'selected' : '' }}>Placement Service (For Employers)</option>
                                            <option value="Placement Service for IT Industry" {{ old('service') == 'Placement Service for IT Industry' ? 'selected' : '' }}>Placement Service for IT Industry</option>
                                            <option value="Placement  Service for Manpower  (Employers)" {{ old('service') == 'Placement  Service for Manpower  (Employers)' ? 'selected' : '' }}>Placement  Service for Manpower  (Employers)</option>
                                            <option value="Placement  Service for Manpower  (Candidate)" {{ old('service') == 'Placement  Service for Manpower  (Candidate)' ? 'selected' : '' }}>Placement  Service for Manpower  (Candidate)</option>
                                        </optgroup>
                                        <optgroup label="Non-IT Sectors">
                                            <option value="Manpower Suppliers" {{ old('service') == 'Manpower Suppliers' ? 'selected' : '' }}>Manpower Suppliers</option>
                                            <option value="Manpower Consultants" {{ old('service') == 'Manpower Consultants' ? 'selected' : '' }}>Manpower Consultants</option>
                                            <option value="Placement Service for Accounts" {{ old('service') == 'Placement Service for Accounts' ? 'selected' : '' }}>Placement Service for Accounts</option>
                                            <option value="Placement Service for Accounts (Employers)" {{ old('service') == 'Placement Service for Accounts (Employers)' ? 'selected' : '' }}>Placement Service for Accounts (Employers)</option>
                                            <option value="Placement  Service for Hospital" {{ old('service') == 'Placement  Service for Hospital' ? 'selected' : '' }}>Placement  Service for Hospital</option>
                                            <option value="Manpower Outsourcing Services" {{ old('service') == 'Manpower Outsourcing Services' ? 'selected' : '' }}>Manpower Outsourcing Services</option>
                                            <option value="Placement Service for Banking Sector" {{ old('service') == 'Placement Service for Banking Sector' ? 'selected' : '' }}>Placement Service for Banking Sector</option>
                                        </optgroup>
                                        <optgroup label="Services">
                                            <option value="Digital Marketing" {{ old('service') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                            <option value="Web Development" {{ old('service') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                            <option value="E commerce Development" {{ old('service') == 'E commerce Development' ? 'selected' : '' }}>E commerce Development</option>
                                            <option value="Mobile App Development" {{ old('service') == 'Mobile App Development' ? 'selected' : '' }}>Mobile App Development</option>
                                        </optgroup>
                                        <option value="Other" {{ old('service') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('service') <span class="text-danger" style="font-size: 13px; margin-top: 6px; display: block; font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 mb-4">
                                    <label style="color: #4a5568; font-size: 14px; font-weight: 600; margin-bottom: 8px; display: block;">Subject *</label>
                                    <input type="text" name="subject" value="{{ old('subject') }}" placeholder="How can we help you?" style="width: 100%; padding: 14px 18px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; transition: all 0.3s ease; color: #1a202c; font-size: 15px; background-color: #f8fafc;" onfocus="this.style.borderColor='#ff5e14'; this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(255, 94, 20, 0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc'; this.style.boxShadow='none'" required>
                                    @error('subject') <span class="text-danger" style="font-size: 13px; margin-top: 6px; display: block; font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 mb-4">
                                    <label style="color: #4a5568; font-size: 14px; font-weight: 600; margin-bottom: 8px; display: block;">Message *</label>
                                    <textarea name="message" placeholder="Tell us more about your requirements..." rows="4" style="width: 100%; padding: 14px 18px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; transition: all 0.3s ease; resize: vertical; color: #1a202c; font-size: 15px; background-color: #f8fafc;" onfocus="this.style.borderColor='#ff5e14'; this.style.backgroundColor='#ffffff'; this.style.boxShadow='0 0 0 4px rgba(255, 94, 20, 0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.backgroundColor='#f8fafc'; this.style.boxShadow='none'" required>{{ old('message') }}</textarea>
                                    @error('message') <span class="text-danger" style="font-size: 13px; margin-top: 6px; display: block; font-weight: 500;"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</span> @enderror
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" style="background-color: #ff5e14; color: white; border: none; padding: 16px 30px; border-radius: 8px; font-weight: 600; font-size: 16px; cursor: pointer; transition: all 0.3s ease; width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px;" onmouseover="this.style.backgroundColor='#e04c08'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(255, 94, 20, 0.2)';" onmouseout="this.style.backgroundColor='#ff5e14'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                        <span>Send Message</span>
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->
