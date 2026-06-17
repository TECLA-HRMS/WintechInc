<?php

use App\Http\Controllers\Backend\BlogController;

use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Report\ContactReportController;
use App\Http\Controllers\Report\JobapplicationReport;
use App\Http\Controllers\Report\ProfileReportController;

use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\TestimonialController;

use App\Http\Controllers\Backend\HomeController;

use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\EmailconfigController;

use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\CourseBannerController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\AdminIndividualRecordController;
use App\Http\Controllers\Backend\MassRecordController;
use App\Http\Controllers\Backend\VideoGalleryController;
use App\Http\Controllers\Backend\MediaItemController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\Jobs\ManagejobsController;
use App\Http\Controllers\Backend\Jobs\ExperienceController;
use App\Http\Controllers\Backend\Jobs\CandidateController;
use App\Http\Controllers\Backend\Jobs\sheduleController;
use App\Http\Controllers\Backend\Jobs\ShortlistController;
use App\Http\Controllers\Backend\Jobs\QuestionController;
use App\Http\Controllers\Backend\Jobs\ManageresumeController;
use App\Http\Controllers\Backend\EventController as AdminEventController;
use App\Http\Controllers\Backend\CompanyRegistrationController as AdminCompanyRegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminManagementController;
use App\Http\Controllers\Backend\NewsletterController;
use App\Http\Controllers\Backend\AdminSettingsController;
use App\Http\Controllers\Backend\JobFunctionController;
use App\Http\Controllers\Backend\ActivityLogController;

use App\Models\FooterInfo;

use App\Http\Controllers\Backend\ProfileController;
// Admin Management
        Route::get('/admin-management', [AdminManagementController::class, 'index'])->name('management.index');
        Route::get('/create', [AdminManagementController::class, 'create'])->name('management.create');
        
        Route::post('/', [AdminManagementController::class, 'store'])->name('management.store');
        Route::get('/{id}/edit', [AdminManagementController::class, 'edit'])->name('management.edit');
        Route::put('/{id}', [AdminManagementController::class, 'update'])->name('management.update');
        Route::delete('/{id}', [AdminManagementController::class, 'destroy'])->name('management.destroy');


Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
   Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordPage'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'handleForgotPassword'])->name('forgot-password.submit');
// Reset Password Routes
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordPage'])->name('reset-password');
Route::post('/reset-password', [AuthController::class, 'handleResetPassword'])->name('reset-password.submit');
Route::get('/admin/otp', [AuthController::class, 'showOTPForm'])->name('admin.otp');
Route::post('/admin/verify-otp', [AuthController::class, 'verifyOTP'])->name('admin.verify-otp');
// Public Routes
Route::get('/auth', [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
Route::patch('/events/toggle-status/{event}', [EventController::class, 'toggleStatus'])
    ->name('events.toggle-status');

   // Media Gallery Routes
   Route::get('/media', [MediaItemController::class, 'index'])->name('media.index');
   Route::get('/media/create/{type?}', [MediaItemController::class, 'create'])->name('media.create');
   Route::post('/media', [MediaItemController::class, 'store'])->name('media.store');
   Route::get('/media/{id}/edit', [MediaItemController::class, 'edit'])->name('media.edit');
   Route::put('/media/{id}', [MediaItemController::class, 'update'])->name('media.update');
   Route::delete('/media/{id}', [MediaItemController::class, 'destroy'])->name('media.destroy');
   Route::post('/media/{id}/change-status', [MediaItemController::class, 'changeStatus'])
   ->name('media.change-status');

// Public Media Routes
Route::get('/media/{slug}', [MediaController::class, 'show'])->name('media.show');

Route::get('admin/syllabus-inquiry/pdf', [CourseBannerController::class, 'exportPDF'])->name('syllabus-inquiry.pdf');
Route::get('/admin/syllabus-inquiry/csv', [CourseBannerController::class, 'exportCSV'])->name('syllabus-inquiry.csv');


    Route::resource('emailconfig', EmailconfigController::class);



Route::resource('courses/{course}/banners', CourseBannerController::class);
Route::post('/send-course-pdf', [CourseBannerController::class, 'sendCoursePdf'])->name('send.course.pdf');
Route::post('course-banners/update-status', [CourseBannerController::class, 'updateStatus'])
    ->name('course-banners.update-status');
Route::resource('course-banners', CourseBannerController::class);

Route::get('/admin/syllabus-inquiries', [CourseBannerController::class, 'list'])
    ->name('syllabus-inquiries.list');


// banner  ///////

    Route::resource('banner', BannerController::class);
    Route::post('banner/update-status', [BannerController::class, 'updateStatus'])
    ->name('banner.update-status');



    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    /** Advertisement Routes */
    Route::get('advertisement', [AdvertisementController::class, 'index'])->name('advertisement.index');
    Route::put('advertisement/homepage-banner-secion-one', [AdvertisementController::class, 'homepageBannerSecionOne'])->name('homepage-banner-secion-one');
    Route::put('advertisement/homepage-banner-secion-two', [AdvertisementController::class, 'homepageBannerSecionTwo'])->name('homepage-banner-secion-two');
    /** Advertisement Routes End*/

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{galleryImage}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{galleryImage}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{galleryImage}', [GalleryController::class, 'destroy'])->name('gallery.destroy');


    /** settings routes */
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('generale-setting-update', [SettingsController::class, 'generalSettingUpdate'])->name('generale-setting-update');
    Route::put('email-setting-update', [SettingsController::class, 'emailConfigSettingUpdate'])->name('email-setting-update');
    Route::put('logo-setting-update', [SettingsController::class, 'logoSettingUpdate'])->name('logo-setting-update');
    Route::put('pusher-setting-update', [SettingsController::class, 'pusherSettingUpdate'])->name('pusher-setting-update');
    /** settings routes End*/
// Admin Routes
    Route::get('/individual-records', [AdminIndividualRecordController::class, 'index'])->name('individual-records.index');
    Route::get('/individual-records/create', [AdminIndividualRecordController::class, 'create'])->name('individual-records.create');
    Route::post('/individual-records', [AdminIndividualRecordController::class, 'store'])->name('individual-records.store');
    Route::get('/individual-records/{record}/edit', [AdminIndividualRecordController::class, 'edit'])->name('individual-records.edit');
    Route::put('/individual-records/{record}', [AdminIndividualRecordController::class, 'update'])->name('individual-records.update');
    Route::delete('/individual-records/{record}', [AdminIndividualRecordController::class, 'destroy'])->name('individual-records.destroy');
    Route::patch('admin/individual-records/{id}/update-status', [AdminIndividualRecordController::class, 'updateStatus'])->name('individual-records.update-status');
    Route::delete('/individual-records/{id}/delete-image/{imageIndex}', [AdminIndividualRecordController::class, 'deleteAdditionalImage'])
    ->name('individual-records.delete-image');
    Route::get('mass-records', [MassRecordController::class, 'index'])->name('mass-records.index');
    Route::get('mass-records/create', [MassRecordController::class, 'create'])->name('mass-records.create');
    Route::post('mass-records', [MassRecordController::class, 'store'])->name('mass-records.store');
    Route::get('mass-records/{mass_record}/edit', [MassRecordController::class, 'edit'])->name('mass-records.edit');
    Route::put('mass-records/{mass_record}', [MassRecordController::class, 'update'])->name('mass-records.update');
    Route::delete('mass-records/{mass_record}', [MassRecordController::class, 'destroy'])->name('mass-records.destroy');
    Route::patch('/admin/mass-records/{id}/toggle-status', [MassRecordController::class, 'toggleStatus'])
    ->name('mass-records.toggle-status');

// Admin routes (protected by auth middleware)
 
    // Slider Routes
    Route::resource('slider', SliderController::class);
    Route::post('slider/update-status', [SliderController::class, 'updateStatus'])->name('slider.update-status');

// Admin routes
Route::get('/videos-gallery', [VideoGalleryController::class, 'index'])->name('videos.index');
Route::get('/videos/create', [VideoGalleryController::class, 'create'])->name('videos.create');
Route::post('/videos', [VideoGalleryController::class, 'store'])->name('videos.store');
Route::get('/videos/{id}/edit', [VideoGalleryController::class, 'edit'])->name('videos.edit');
Route::put('/videos/{id}', [VideoGalleryController::class, 'update'])->name('videos.update');
Route::delete('/videos/{id}', [VideoGalleryController::class, 'destroy'])->name('videos.destroy');
Route::post('/videos/{video}/change-status', [VideoGalleryController::class, 'changeStatus'])
    ->name('videos.change-status');
// API route
Route::get('/api/videos', [VideoGalleryController::class, 'apiVideos']);

    // TestimonialController
    Route::put('testimonial/change-status', [TestimonialController::class, 'changeStatus'])->name('testimonial.change-status');
    Route::get('testimonial/checkname', [TestimonialController::class, 'checkname'])->name('testimonial.checkname');
    Route::resource('testimonial', TestimonialController::class);



    // Service Routes
    Route::get('update-service', [ServiceController::class, 'updateService'])->name('view.service');
    Route::post('update-service/{id}', [ServiceController::class, 'postService'])->name('update.service');
    Route::post('serviceoption/status-change', [ServiceController::class, 'changeStatus'])->name('serviceoption.status-change');
    Route::resource('serviceoption', ServiceController::class);



    /** Blog routes */

    Route::get('blog/check-name', [BlogController::class, 'checkname'])->name('blog.check-name');
    Route::put('blog/change-status', [BlogController::class, 'changeStatus'])->name('blog.change-status');
    Route::resource('blog', BlogController::class);

    Route::get('blog-category/check-name', [BlogCategoryController::class, 'checkname'])->name('blog-category.check-name');
    Route::put('blog-category/change-status', [BlogCategoryController::class, 'changeStatus'])->name('blog-category.change-status');
    Route::resource('blog-category', BlogCategoryController::class);
    Route::resource('blog-comments', BlogCommentController::class);
    /** Blog routes */

    
    /** Blog routes */
    Route::put('blog-category/change-status', [BlogCategoryController::class, 'changeStatus'])->name('blog-category.change-status');
    Route::resource('blog-category', BlogCategoryController::class);
    Route::resource('blog-comments', BlogCommentController::class);
    /** Blog routes */


//managejobs

Route::resource('managejobs', ManagejobsController::class);

// Job Functions
Route::resource('job-functions', JobFunctionController::class)->except(['show']);

// Admin Settings
Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
Route::post('/settings/general', [AdminSettingsController::class, 'saveGeneral'])->name('settings.general');
Route::post('/settings/email', [AdminSettingsController::class, 'saveEmail'])->name('settings.email');
Route::post('/settings/test-mail', [AdminSettingsController::class, 'testMail'])->name('settings.test-mail');
Route::post('/settings/appearance', [AdminSettingsController::class, 'saveAppearance'])->name('settings.appearance');

// Newsletter
Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
Route::get('/newsletter/compose', [NewsletterController::class, 'compose'])->name('newsletter.compose');
Route::post('/newsletter/send', [NewsletterController::class, 'sendCustom'])->name('newsletter.send');
Route::post('/newsletter/{id}/toggle', [NewsletterController::class, 'toggleStatus'])->name('newsletter.toggle');
Route::delete('/newsletter/{id}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');

// Job Applicants Routes
Route::get('/managejobs/{id}/applicants', [ManagejobsController::class, 'viewApplicants'])->name('managejobs.applicants');
Route::post('/job-applications/{id}/status', [ManagejobsController::class, 'updateApplicationStatus'])->name('job-applications.update-status');



use App\Http\Controllers\Backend\CategoryController as AdminCategoryController;
use App\Http\Controllers\Backend\PhotoController as AdminPhotoController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are for the admin panel and are protected by auth middleware.
| They are loaded by RouteServiceProvider within the 'admin' prefix.
|
*/


    // Category Management
    Route::prefix('categories')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('categories.create');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Photo Management
    Route::prefix('photos')->group(function () {
        Route::get('/', [AdminPhotoController::class, 'index'])->name('photos.index');
        Route::get('/create', [AdminPhotoController::class, 'create'])->name('photos.create');
        Route::post('/', [AdminPhotoController::class, 'store'])->name('photos.store');
        Route::get('/{photo}/edit', [AdminPhotoController::class, 'edit'])->name('photos.edit');
        Route::put('/{photo}', [AdminPhotoController::class, 'update'])->name('photos.update');
        Route::delete('/{photo}', [AdminPhotoController::class, 'destroy'])->name('photos.destroy');
    });

    // contacts //////
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

Route::prefix('resume')->name('resume.')->group(function () {
    Route::get('/', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'index'])->name('index');
    Route::get('/bulk-download-resumes', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'bulkDownloadResumes'])->name('bulk-download-resumes');
    Route::get('/email-template/{type}', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'getEmailTemplate'])->name('email-template');
    Route::get('/stats/data', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'getStats'])->name('stats');
    Route::get('/{id}', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'show'])->name('show');
    Route::patch('/{id}/update-status', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'updateStatus'])->name('update-status');
    Route::post('/{id}/send-email', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'sendEmail'])->name('send-email');
    Route::delete('/{id}', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'destroy'])->name('destroy');
    Route::get('/{id}/view-resume', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'viewResume'])->name('view-resume');
    
});
Route::patch('/applications/{id}/status', [App\Http\Controllers\Backend\Jobs\ManageresumeController::class, 'updateStatus'])
     ->name('resume.updateStatus');
    Route::resource('blog', \App\Http\Controllers\Backend\BlogController::class)->except(['show']);

    // Backend (Admin)
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events/store', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::post('/events/{id}/update', [AdminEventController::class, 'update'])->name('events.update');
    Route::get('/events/{id}/delete', [AdminEventController::class, 'destroy'])->name('events.delete');


      Route::get('/company-registrations', [AdminCompanyRegistrationController::class, 'index'])
        ->name('company.registrations.index');
    Route::get('/company-registrations/{companyRegistration}', [AdminCompanyRegistrationController::class, 'show'])
        ->name('company.registrations.show');
    Route::post('/company-registrations/{companyRegistration}/status', [AdminCompanyRegistrationController::class, 'updateStatus'])
        ->name('company.registrations.update-status');
    Route::delete('/company-registrations/{companyRegistration}', [AdminCompanyRegistrationController::class, 'destroy'])
        ->name('company.registrations.destroy');
    Route::get('/company-registrations-export', [AdminCompanyRegistrationController::class, 'export'])
        ->name('company.registrations.export');

        Route::get('/company-registrations/{companyRegistration}/download/pdf', [AdminCompanyRegistrationController::class, 'download'])->name('company.registrations.download.pdf');


        // User Report Routes
Route::prefix('user-reports')->name('user-reports.')->group(function () {
    Route::get('/', [ProfileReportController::class, 'index'])->name('index');
    Route::get('/download', [ProfileReportController::class, 'downloadPDF'])->name('download');
});

// Admin Job Applications Routes
    Route::get('/job-applications', [JobApplicationController::class, 'index'])->name('job-applications.index');
    Route::get('/job-applications/{id}', [JobApplicationController::class, 'show'])->name('job-applications.show');
    Route::put('/job-applications/{id}/status', [JobApplicationController::class, 'updateStatus'])->name('job-applications.update-status');
    Route::delete('/job-applications/{id}', [JobApplicationController::class, 'destroy'])->name('job-applications.destroy');


        // Contact Reports Routes

 Route::get('/contact-report', [ContactReportController::class, 'index'])->name('contact.report');
    Route::get('/contact-report/download', [ContactReportController::class, 'download'])->name('contact.download');
     Route::get('/contacts/download-pdf', [ContactReportController::class, 'downloadPDF'])->name('contact.download.pdf');

     use App\Http\Controllers\Report\CompanyRegistrationReportController;

    Route::get('company-registration-report', [CompanyRegistrationReportController::class, 'index'])->name('company.report');
    Route::get('company-registration-report/download-excel', [CompanyRegistrationReportController::class, 'downloadExcel'])->name('company.report.download.excel');
    Route::get('company-registration-report/download-pdf', [CompanyRegistrationReportController::class, 'downloadPDF'])->name('company.report.download.pdf');
// Company Registration Report - List Page
    Route::get('/company-report', [CompanyRegistrationReportController::class, 'index'])
        ->name('company.report');


    // Download Excel
    Route::get('/company-report/download-excel', [CompanyRegistrationReportController::class, 'downloadExcel'])
        ->name('company.download.excel');

    // Download PDF
    Route::get('/company-report/download-pdf', [CompanyRegistrationReportController::class, 'downloadPDF'])
        ->name('company.download.pdf');

Route::get('/profile-report', [ProfileReportController::class, 'index'])->name('profile.report');
Route::get('/profile-report/download-pdf', [ProfileReportController::class, 'downloadPDF'])->name('profile.report.download.pdf');
Route::get('/profile-report/download-csv', [ProfileReportController::class, 'downloadCSV'])->name('profile.report.download.csv');


use App\Http\Controllers\Report\JobReportController;
use App\Http\Controllers\Report\SelectedCandidateReportController;
  // Job Report Routes
    Route::get('/job-report', [JobReportController::class, 'index'])->name('job.report');
    Route::get('/job-report/download/pdf', [JobReportController::class, 'downloadPDF'])->name('job.report.download.pdf');
    Route::get('/job-report/download/csv', [JobReportController::class, 'downloadCSV'])->name('job.report.download.csv');


Route::get('/job-applications-report', [JobapplicationReport::class, 'index'])->name('job-applications.report');
Route::get('/job-applications-report/download-pdf', [JobapplicationReport::class, 'downloadPDF'])->name('job-applications.report.download.pdf');
Route::get('/job-applications-report/download-csv', [JobapplicationReport::class, 'downloadCSV'])->name('job-applications.report.download.csv');


Route::get('/selected-candidate-report', [SelectedCandidateReportController::class, 'index'])->name('selected.candidate.report');
    Route::get('/selected-candidate-report/download/csv', [SelectedCandidateReportController::class, 'downloadCSV'])->name('selected.candidate.report.download.csv');
    Route::get('/selected-candidate-report/download/pdf', [SelectedCandidateReportController::class, 'downloadPDF'])->name('selected.candidate.report.download.pdf');
Route::get('/reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/{report}/export/{format}', [App\Http\Controllers\Backend\ReportController::class, 'export'])->name('reports.export');

// Admin Notifications API
Route::get('/notifications/feed', function () {
    $items = collect();

    // Latest 3 job applications
    $apps = \Illuminate\Support\Facades\DB::table('job_applications')
        ->orderBy('created_at', 'desc')->limit(3)->get();
    foreach ($apps as $a) {
        $items->push([
            'type'    => 'application',
            'icon'    => 'ti-file-description',
            'color'   => '#4f46e5',
            'bg'      => '#eef2ff',
            'text'    => 'New application from ' . $a->full_name,
            'time'    => $a->created_at,
            'link'    => route('admin.resume.index'),
        ]);
    }

    // Latest 3 company registrations
    $comps = \Illuminate\Support\Facades\DB::table('company_registrations')
        ->orderBy('created_at', 'desc')->limit(3)->get();
    foreach ($comps as $c) {
        $items->push([
            'type'    => 'company',
            'icon'    => 'ti-building',
            'color'   => '#059669',
            'bg'      => '#ecfdf5',
            'text'    => 'Company registration: ' . $c->name,
            'time'    => $c->created_at,
            'link'    => route('admin.company.registrations.index'),
        ]);
    }

    // Latest 3 contacts
    $contacts = \Illuminate\Support\Facades\DB::table('contacts')
        ->orderBy('created_at', 'desc')->limit(3)->get();
    foreach ($contacts as $ct) {
        $items->push([
            'type'    => 'contact',
            'icon'    => 'ti-message',
            'color'   => '#d97706',
            'bg'      => '#fffbeb',
            'text'    => 'New enquiry from ' . $ct->name,
            'time'    => $ct->created_at,
            'link'    => route('admin.contact.index'),
        ]);
    }

    // Sort all by time desc, take top 8
    $sorted = $items->sortByDesc('time')->take(8)->values();

    // Add human-readable time
    $sorted = $sorted->map(function($n) {
        $n['ago'] = \Carbon\Carbon::parse($n['time'])->diffForHumans();
        return $n;
    });

    return response()->json([
        'count' => $sorted->count(),
        'items' => $sorted,
    ]);
})->name('notifications.feed');
