<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminActivityLogger
{
    private array $skipRouteNames = [
        'admin.login',
        'admin.login.submit',
        'admin.logout',
        'admin.forgot-password',
        'admin.forgot-password.submit',
        'admin.reset-password',
        'admin.reset-password.submit',
        'admin.admin.otp',
        'admin.admin.verify-otp',
        'admin.notifications.feed',
        'admin.activity-logs.index',
    ];

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($this->shouldLog($request)) {
            $this->writeLog($request, $response->getStatusCode());
        }

        return $response;
    }

    private function shouldLog(Request $request): bool
    {
        if (!session('admin_id')) {
            return false;
        }

        if ($request->routeIs(...$this->skipRouteNames)) {
            return false;
        }

        return Str::startsWith($request->path(), 'admin');
    }

    private function writeLog(Request $request, int $statusCode): void
    {
        try {
            $admin = DB::table('admins')->where('id', session('admin_id'))->first();

            if (!$admin) {
                return;
            }

            DB::table('admin_activity_logs')->insert([
                'admin_id' => $admin->id,
                'admin_name' => $admin->name ?? null,
                'admin_email' => $admin->email ?? null,
                'admin_role' => $admin->role ?? null,
                'module' => $this->resolveModule($request),
                'action' => $this->resolveAction($request),
                'method' => $request->method(),
                'route_name' => optional($request->route())->getName(),
                'url' => $request->fullUrl(),
                'status_code' => $statusCode,
                'ip_address' => $request->ip(),
                'user_agent' => Str::limit((string) $request->userAgent(), 1000, ''),
                'payload' => $this->payload($request),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (\Throwable $e) {
            \Log::warning('Unable to write admin activity log: ' . $e->getMessage());
        }
    }

    private function resolveModule(Request $request): string
    {
        $routeName = optional($request->route())->getName() ?? '';
        $path = $request->path();

        $map = [
            'dashboard' => ['admin.dashboard'],
            'resumes' => ['admin.resume.', 'admin/job-applications'],
            'user_management' => ['admin.profiles.', 'admin.profile.', 'admin/user-reports'],
            'company_registration' => ['admin.company.', 'admin/company-registrations'],
            'job_management' => ['admin.managejobs.', 'admin/job-report', 'admin/job-applications-report', 'admin/selected-candidate-report'],
            'job_functions' => ['admin.job-functions.'],
            'enquiries' => ['admin.contact.', 'admin/contact'],
            'email_configuration' => ['admin.emailconfig.'],
            'admin_management' => ['admin.management.'],
            'newsletter' => ['admin.newsletter.'],
            'settings' => ['admin.settings.'],
            'reports' => ['admin.reports.', 'admin/reports', 'admin/contact-report', 'admin/profile-report', 'admin/company-report'],
        ];

        foreach ($map as $module => $needles) {
            foreach ($needles as $needle) {
                if (Str::startsWith($routeName, $needle) || Str::startsWith($path, $needle)) {
                    return $module;
                }
            }
        }

        return 'admin';
    }

    private function resolveAction(Request $request): string
    {
        $routeName = optional($request->route())->getName() ?? '';

        if ($request->isMethod('GET')) {
            if (Str::endsWith($routeName, '.create')) return 'open_create_form';
            if (Str::endsWith($routeName, '.edit')) return 'open_edit_form';
            if (Str::endsWith($routeName, '.show')) return 'view_detail';
            return 'view';
        }

        return match ($request->method()) {
            'POST' => 'create_or_submit',
            'PUT', 'PATCH' => 'update',
            'DELETE' => 'delete',
            default => strtolower($request->method()),
        };
    }

    private function payload(Request $request): ?string
    {
        if ($request->isMethod('GET')) {
            return $request->query() ? json_encode($request->query()) : null;
        }

        $data = collect($request->except([
            '_token',
            '_method',
            'password',
            'password_confirmation',
            'current_password',
            'new_password',
            'new_password_confirmation',
        ]))->take(25)->all();

        return $data ? json_encode($data) : null;
    }
}
