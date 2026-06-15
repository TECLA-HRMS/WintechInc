<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\VideoGalleryController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\CareerController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Frontend\CompanyRegistrationController as FrontendCompanyRegistrationController;
use App\Http\Controllers\Frontend\JobApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Models\NewsletterSubscriber;

// Newsletter
Route::post('/newsletter/subscribe', function (\Illuminate\Http\Request $request) {
    $request->validate(['email' => 'required|email']);
    NewsletterSubscriber::firstOrCreate(
        ['email' => $request->email],
        ['name' => $request->name, 'is_active' => true]
    );
    return back()->with('success', 'You have subscribed to job alerts!');
})->name('newsletter.subscribe');

Route::get('/newsletter/unsubscribe', function (\Illuminate\Http\Request $request) {
    NewsletterSubscriber::where('email', $request->email)->update(['is_active' => false]);
    return redirect('/')->with('success', 'You have been unsubscribed.');
})->name('newsletter.unsubscribe');

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Career (resource handles index/create/store/show/edit/update/destroy)
Route::resource('career', CareerController::class)->except(['show']);
Route::get('/career/{id}', [CareerController::class, 'show'])->name('career.show');
Route::post('/career/filter', [CareerController::class, 'filter'])->name('career.filter');
Route::get('/career/apply/{id}', [CareerController::class, 'applyForm'])->name('career.applyForm');
Route::post('/career/apply', [CareerController::class, 'applySubmit'])->name('career.applySubmit');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.page');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Static pages
Route::get('/faq', function () { return view('site.faq.index'); })->name('faq');
Route::get('/about', function () { return view('site.about.index'); })->name('site.about');

// Jobs
Route::get('/job', [JobController::class, 'index'])->name('jobs.index');
Route::get('/job/search/suggestions', [JobController::class, 'suggestions'])->name('jobs.suggestions');
Route::get('/job/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/job/{id}/details', [JobController::class, 'getJobDetails'])->name('jobs.details');

// Job applications & wishlist (web middleware already applied globally)
Route::get('/job/{id}/apply', [JobApplicationController::class, 'showApplyForm'])->name('job.apply');
Route::post('/job/{id}/apply', [JobApplicationController::class, 'store'])->name('job.apply.store');
Route::get('/api/user-data', [JobApplicationController::class, 'getUserData'])->name('user.data');
Route::get('/api/check-auth', [JobApplicationController::class, 'checkAuth'])->name('check.auth');
Route::get('/my-applications', [JobApplicationController::class, 'myApplications'])->name('job.my-applications')->middleware('auth');

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{jobId}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove/{jobId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist/check/{jobId}', [WishlistController::class, 'checkStatus'])->name('wishlist.check');
Route::get('/api/wishlist', [WishlistController::class, 'getWishlist'])->name('api.wishlist');
Route::post('/wishlist/clear', [WishlistController::class, 'clear'])->name('wishlist.clear');
Route::get('/wishlist/show/{id}', [WishlistController::class, 'show'])->name('wishlist.show');
Route::post('/wishlist/sync', [WishlistController::class, 'syncWishlistStatus'])->name('wishlist.sync');

// Notifications
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/preferences', [App\Http\Controllers\NotificationController::class, 'updatePreferences'])->name('notifications.preferences.update');
Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::post('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
Route::get('/notifications/unread-count', [App\Http\Controllers\NotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');

// Company
Route::get('/company', [FrontendCompanyRegistrationController::class, 'showForm'])->name('site.company');
Route::get('/company-register', [FrontendCompanyRegistrationController::class, 'showForm'])->name('company.register.form');
Route::post('/company-register', [FrontendCompanyRegistrationController::class, 'store'])->name('company.register.submit');

// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordPage'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'handleResetPassword'])->name('password.update');

// Profile (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/resume', [ProfileController::class, 'deleteResume'])->name('profile.resume.delete');
    Route::post('/profile/remove-picture', [ProfileController::class, 'removeProfilePicture'])->name('profile.remove-picture');
});

// Settings (auth required)
Route::middleware('auth')->prefix('settings')->group(function () {
    Route::get('/', [SettingsController::class, 'show'])->name('settings');
    Route::post('/account', [SettingsController::class, 'updateAccount'])->name('settings.account');
    Route::post('/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/preferences', [SettingsController::class, 'updatePreferences'])->name('settings.preferences');
    Route::post('/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::post('/privacy', [SettingsController::class, 'updatePrivacy'])->name('settings.privacy');
    Route::post('/security', [SettingsController::class, 'updateSecurity'])->name('settings.security');
    Route::post('/job-preferences', [SettingsController::class, 'updateJobPreferences'])->name('settings.job-preferences');
    Route::post('/upload-resume', [SettingsController::class, 'uploadResume'])->name('settings.uploadResume');
    Route::post('/delete-resume', [SettingsController::class, 'deleteResume'])->name('settings.deleteResume');
    Route::post('/clear-cache', [SettingsController::class, 'clearCache'])->name('settings.clearCache');
    Route::post('/delete-browsing-history', [SettingsController::class, 'deleteBrowsingHistory'])->name('settings.deleteBrowsingHistory');
    Route::post('/toggle-dark-mode', [SettingsController::class, 'toggleDarkMode'])->name('settings.toggleDarkMode');
    Route::get('/download-data', [SettingsController::class, 'downloadData'])->name('settings.downloadData');
    Route::post('/delete-account', [SettingsController::class, 'deleteAccount'])->name('settings.deleteAccount');
});

Route::get('/about', function () {
    return view('site.about.index');
});
Route::get('/best-manpower-consultants-services-in-chennai', function () {
    return view('site.best-manpower-consultants-services-in-chennai.index');
});
Route::get('/best-manpower-outsourcing-services-in-chennai', function () {
    return view('site.best-manpower-outsourcing-services-in-chennai.index');
});
Route::get('/best-manpower-suppliers-services-for-candidate-in-chennai', function () {
    return view('site.best-manpower-suppliers-services-for-candidate-in-chennai.index');
});
Route::get('/best-placement-placement-services-for-manpower-for-employer-in-chennai', function () {
    return view('site.best-placement-placement-services-for-manpower-for-employer-in-chennai.index');
});
Route::get('/best-placement-service-for-accounts-candidate-in-chennai', function () {
    return view('site.best-placement-service-for-accounts-candidate-in-chennai.index');
});
Route::get('/best-placement-service-for-accounts-employers-in-chennai', function () {
    return view('site.best-placement-service-for-accounts-employers-in-chennai.index');
});
Route::get('/best-placement-service-for-banking-sector-in-chennai', function () {
    return view('site.best-placement-service-for-banking-sector-in-chennai.index');
});
Route::get('/best-placement-service-for-employers-services-for-candidate-in-chennai', function () {
    return view('site.best-placement-service-for-employers-services-for-candidate-in-chennai.index');
});
Route::get('/best-placement-service-for-hospital-in-chennai', function () {
    return view('site.best-placement-service-for-hospital-in-chennai.index');
});
Route::get('/best-placement-service-for-it-industry-in-chennai', function () {
    return view('site.best-placement-service-for-it-industry-in-chennai.index');
});
Route::get('/best-placement-service-for-marketing-executive-services-in-chennai', function () {
    return view('site.best-placement-service-for-marketing-executive-services-in-chennai.index');
});
Route::get('/best-placement-services-for-candidate-in-chennai', function () {
    return view('site.best-placement-services-for-candidate-in-chennai.index');
});
Route::get('/best-placement-services-for-manpower-for-candidate-in-chennai', function () {
    return view('site.best-placement-services-for-manpower-for-candidate-in-chennai.index');
});
Route::get('/blog', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('blog.show');
Route::get('/career', function () {
    return view('site.career.index');
});
Route::get('/contact', [ContactController::class, 'index'])->name('contact.page');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/digital-marketing', function () {
    return view('site.digital-marketing.index');
});
Route::get('/e-commerce-development', function () {
    return view('site.e-commerce-development.index');
});

Route::get('/mobile-app-development', function () {
    return view('site.mobile-app-development.index');
});
Route::get('/web-development', function () {
    return view('site.web-development.index');
});
Route::get('/why-choose-wintech-hr-consultancy', function () {
    return view('site.why-choose-wintech-hr-consultancy.index');
});
