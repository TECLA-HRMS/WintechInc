# WintechInc (TECLA-HRMS)

## Description
WintechInc is a comprehensive Human Resource Management System (HRMS) and Job Portal built on the Laravel 9 framework. It facilitates seamless interaction between job seekers and employers, offering features such as company registrations, job postings, resume management, application tracking, and an administrative dashboard for overall platform management.

## Features
- **User Roles:** Admin, Company/Employer, and Candidate.
- **Job Management:** Create, read, update, and delete job postings.
- **Application Tracking:** Candidates can apply to jobs and track their application status.
- **Company Profiles:** Employers can register, manage their profiles, and handle job briefs.
- **Admin Dashboard:** Full control over users, jobs, newsletters, settings, and site content.
- **Newsletter System:** Custom email newsletters and job alerts.
- **File Management:** PDF handling for resumes (via DomPDF/mPDF) and image processing.
- **Social Login:** Integration with Laravel Socialite for easier access.
- **Data Export/Import:** Excel integration via Maatwebsite Excel.

## Technology Stack
- **Framework:** Laravel 9.x
- **Language:** PHP 8.0+
- **Frontend:** Blade Templating, HTML5, CSS3, JavaScript
- **Database:** MySQL
- **Key Packages:**
  - `barryvdh/laravel-dompdf` & `mpdf/mpdf` (PDF Generation)
  - `intervention/image` (Image Handling)
  - `maatwebsite/excel` (Excel Export/Import)
  - `laravel/socialite` (OAuth Authentication)

## Requirements
- PHP >= 8.0.2
- Composer
- MySQL Database

## Installation & Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/TECLA-HRMS/WintechInc.git
   cd wintech-new
   ```

2. **Install Composer Dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   Copy `.env.example` to `.env` and configure your environment variables (Database, Mail credentials, etc.).
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Run the Development Server**
   ```bash
   php artisan serve
   ```
   The application will be accessible at `http://localhost:8000`.

## Directory Structure Highlights
- `app/Http/Controllers/`: Contains backend (Admin) and frontend logic.
- `resources/views/`: Blade templates separated into `admin`, `site` (frontend), and `emails`.
- `public/`: Publicly accessible assets including compiled CSS, JS, uploads, and generated resumes.
- `routes/`: Web and API routing.

## Contributing
Please follow the standard Git workflow. Create feature branches and submit pull requests for code reviews.

## License
This project and its contents are proprietary to TECLA-HRMS / WintechInc.
