<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\AdminCredentialsMail;
use Illuminate\Support\Facades\Mail;

class AdminManagementController extends Controller
{
    // List all admins/sub-admins/employees
    public function index()
    {
        $admins = DB::table('admins')
            ->where('id', '!=', session('admin_id')) // Exclude current admin
            ->get();
            
        return view('admin.admin-management.index', compact('admins'));
    }

    // Show create form
    public function create()
    {
        $modules = $this->getAvailableModules();
        return view('admin.admin-management.create', compact('modules'));
    }

    // Store new admin
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'mobile_number' => 'required|string|max:20',
            'role' => 'required|in:super_admin,sub_admin,employee',
            'password' => 'required|string|min:6|confirmed',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // ✅ If Super Admin, give all permissions
        if ($request->role === 'super_admin') {
            $permissions = array_keys($this->getAvailableModules());
        } else {
            $permissions = $request->permissions ?? [];
        }

        $password = $request->password;

        DB::table('admins')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($password),
            'role' => $request->role,
            'permissions' => json_encode($permissions),
            'created_by' => session('admin_id'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Prepare mail data
        $mailData = [
            'name' => $request->name,
            'username' => $request->email,
            'password' => $password,
            'role' => ucfirst(str_replace('_', ' ', $request->role)),
            'isUpdate' => false
        ];

        try {
            Mail::to($request->email)->send(new AdminCredentialsMail('Your New Admin Account', $mailData));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin credentials email: ' . $e->getMessage());
        }

        return redirect()->route('admin.management.index')
            ->with('success', 'Admin account created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $admin = DB::table('admins')->where('id', $id)->first();
        
        if (!$admin) {
            abort(404);
        }

        $permissions = $admin->permissions;
        $admin->permissions = is_string($permissions) ? json_decode($permissions, true) : (array)$permissions;
        
        return view('admin.admin-management.edit', [
            'admin' => $admin,
            'modules' => $this->getAvailableModules()
        ]);
    }

    // Update admin
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,'.$id,
            'mobile_number' => 'required|string|max:20',
            'role' => 'required|in:super_admin,sub_admin,employee',
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // ✅ If Super Admin, grant all modules
        if ($request->role === 'super_admin') {
            $permissions = array_keys($this->getAvailableModules());
        } else {
            $permissions = $request->permissions ?? [];
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'role' => $request->role,
            'permissions' => json_encode($permissions),
            'status' => $request->status,
            'updated_at' => now()
        ];

        if ($request->password) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('admins')->where('id', $id)->update($updateData);

        $mailData = [
            'name' => $request->name,
            'username' => $request->email,
            'role' => ucfirst(str_replace('_', ' ', $request->role)),
            'isUpdate' => true
        ];

        if ($request->password) {
            $mailData['password'] = $request->password;
        }

        try {
            Mail::to($request->email)->send(new AdminCredentialsMail('Your Admin Account Has Been Updated', $mailData));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin update email: ' . $e->getMessage());
        }

        return redirect()->route('admin.management.index')
            ->with('success', 'Admin account updated successfully!');
    }

    // Delete admin
    public function destroy($id)
    {
        DB::table('admins')->where('id', $id)->delete();
        return redirect()->route('admin.management.index')
            ->with('success', 'Admin account deleted successfully!');
    }

    // Get available modules
private function getAvailableModules()
{
    return [
        'resume_management' => 'Resume Management',
        'job_management' => 'Job Management',
        'enquiries' => 'Enquiries',
        'user_management' => 'User Management',
        'news_management' => 'News Management',
        'email_config' => 'Email Configuration',
        'company_registration' => 'Company Registration',
        'admin_management' => 'Admin Management',
        'activity_logs' => 'Activity Logs',
        'report_management' => 'Reports',
        'newsletter_management' => 'Newsletter',
        'blog' => 'Blog Management',
    ];
}


}
