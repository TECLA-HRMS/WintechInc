@extends('layouts.admin')

@section('adminContent')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<div class="amc-wrap">

    {{-- HEADER --}}
    <div class="amc-header">
        <div>
            <a href="{{ route('admin.management.index') }}" class="amc-back">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Back
            </a>
            <div class="amc-title">{{ isset($admin) ? 'Edit Admin Account' : 'Create New Admin' }}</div>
            <div class="amc-sub">{{ isset($admin) ? 'Update administrator details and permissions.' : 'Add a new administrator to your team.' }}</div>
        </div>
    </div>

    <form action="{{ isset($admin) ? route('admin.management.update', $admin->id) : route('admin.management.store') }}" method="POST">
        @csrf
        @if(isset($admin)) @method('PUT') @endif

        <div class="amc-grid">

            {{-- BASIC INFO PANEL --}}
            <div class="amc-panel">
                <div class="amc-panel__head">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span>Basic Information</span>
                </div>
                <div class="amc-panel__body">
                    <div class="amc-field">
                        <label class="amc-label">Full Name <span class="amc-req">*</span></label>
                        <input type="text" name="name" class="amc-input @error('name') amc-input--error @enderror" 
                               value="{{ old('name', $admin->name ?? '') }}" placeholder="Enter full name" required>
                        @error('name')
                            <div class="amc-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="amc-field">
                        <label class="amc-label">Email Address <span class="amc-req">*</span></label>
                        <input type="email" name="email" class="amc-input @error('email') amc-input--error @enderror" 
                               value="{{ old('email', $admin->email ?? '') }}" placeholder="admin@example.com" required>
                        @error('email')
                            <div class="amc-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="amc-field">
                        <label class="amc-label">Mobile Number <span class="amc-req">*</span></label>
                        <input type="text" name="mobile_number" class="amc-input @error('mobile_number') amc-input--error @enderror" 
                               value="{{ old('mobile_number', $admin->mobile_number ?? '') }}" placeholder="+1 234 567 8900" required>
                        @error('mobile_number')
                            <div class="amc-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ROLE & PERMISSIONS PANEL --}}
            <div class="amc-panel">
                <div class="amc-panel__head">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <span>Role & Permissions</span>
                </div>
                <div class="amc-panel__body">
                    <div class="amc-field">
                        <label class="amc-label">Role <span class="amc-req">*</span></label>
                        <select name="role" id="roleSelect" class="amc-select @error('role') amc-input--error @enderror" required>
                            <option value="">Select a role</option>
                            <option value="super_admin" {{ old('role', $admin->role ?? '') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="sub_admin" {{ old('role', $admin->role ?? '') == 'sub_admin' ? 'selected' : '' }}>Sub Admin</option>
                            <option value="employee" {{ old('role', $admin->role ?? '') == 'employee' ? 'selected' : '' }}>Employee</option>
                        </select>
                        @error('role')
                            <div class="amc-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="permissionsSection" class="amc-perms" style="{{ old('role', $admin->role ?? '') == 'super_admin' ? 'display:none' : '' }}">
                        <label class="amc-label">Module Permissions</label>
                        <div class="amc-perms-grid">
                            @foreach($modules as $key => $module)
                                @php
                                    $permissions = isset($admin) ? (is_array($admin->permissions) ? $admin->permissions : json_decode($admin->permissions, true)) : [];
                                    $checked = in_array($key, old('permissions', $permissions ?? []));
                                @endphp
                                <label class="amc-checkbox">
                                    <input type="checkbox" name="permissions[]" value="{{ $key }}" {{ $checked ? 'checked' : '' }}>
                                    <span class="amc-checkbox__box"></span>
                                    <span class="amc-checkbox__lbl">{{ $module }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('permissions')
                            <div class="amc-error">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(isset($admin))
                    <div class="amc-field">
                        <label class="amc-switch">
                            <input type="checkbox" name="status" value="1" {{ old('status', $admin->status ?? 1) ? 'checked' : '' }}>
                            <span class="amc-switch__slider"></span>
                            <span class="amc-switch__lbl">Account Active</span>
                        </label>
                    </div>
                    @endif
                </div>
            </div>

            {{-- PASSWORD PANEL --}}
            <div class="amc-panel">
                <div class="amc-panel__head">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <span>{{ isset($admin) ? 'Change Password' : 'Set Password' }}</span>
                </div>
                <div class="amc-panel__body">
                    @if(!isset($admin))
                    <div class="amc-info">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        Password will be sent to the user's email automatically.
                    </div>
                    @endif

                    <div class="amc-field">
                        <label class="amc-label">{{ isset($admin) ? 'New Password' : 'Password' }} @if(!isset($admin))<span class="amc-req">*</span>@endif</label>
                        <input type="password" name="password" class="amc-input @error('password') amc-input--error @enderror" 
                               placeholder="Enter password" {{ !isset($admin) ? 'required' : '' }}>
                        @if(isset($admin))
                            <div class="amc-hint">Leave blank to keep current password</div>
                        @endif
                        @error('password')
                            <div class="amc-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="amc-field">
                        <label class="amc-label">Confirm Password @if(!isset($admin))<span class="amc-req">*</span>@endif</label>
                        <input type="password" name="password_confirmation" class="amc-input" 
                               placeholder="Confirm password" {{ !isset($admin) ? 'required' : '' }}>
                    </div>
                </div>
            </div>

        </div>

        {{-- ACTIONS --}}
        <div class="amc-actions">
            <button type="submit" class="amc-btn amc-btn--primary">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                {{ isset($admin) ? 'Update Account' : 'Create Account' }}
            </button>
            <a href="{{ route('admin.management.index') }}" class="amc-btn amc-btn--ghost">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                Cancel
            </a>
        </div>

    </form>

</div>

<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    const perms = document.getElementById('permissionsSection');
    if (this.value === 'super_admin') {
        perms.style.display = 'none';
        perms.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
    } else {
        perms.style.display = 'block';
    }
});
</script>

<style>
.amc-wrap{font-family:'Inter',-apple-system,sans-serif;padding:24px;background:#f1f5f9;min-height:100vh;color:#0f172a}

/* HEADER */
.amc-header{margin-bottom:24px}
.amc-back{display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:500;color:#64748b;text-decoration:none;margin-bottom:10px;transition:color .15s}
.amc-back:hover{color:#0f172a}
.amc-title{font-size:20px;font-weight:600;color:#0f172a;margin-bottom:3px}
.amc-sub{font-size:13px;color:#64748b}

/* GRID */
.amc-grid{display:grid;gap:20px;margin-bottom:20px}

/* PANEL */
.amc-panel{background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden}
.amc-panel__head{display:flex;align-items:center;gap:9px;padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;font-weight:600;color:#0f172a}
.amc-panel__head svg{color:#64748b;flex-shrink:0}
.amc-panel__body{padding:20px}

/* FIELD */
.amc-field{margin-bottom:18px}
.amc-field:last-child{margin-bottom:0}
.amc-label{display:block;font-size:13px;font-weight:500;color:#0f172a;margin-bottom:7px}
.amc-req{color:#ef4444}
.amc-input,.amc-select{font-family:'Inter',sans-serif;width:100%;font-size:13px;color:#0f172a;background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px;outline:none;transition:border-color .15s}
.amc-input:focus,.amc-select:focus{border-color:#3b82f6}
.amc-input--error{border-color:#ef4444}
.amc-error{font-size:12px;color:#ef4444;margin-top:5px}
.amc-hint{font-size:12px;color:#94a3b8;margin-top:5px}

/* INFO BOX */
.amc-info{display:flex;align-items:flex-start;gap:10px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:12px 14px;font-size:12px;color:#1e40af;margin-bottom:18px}
.amc-info svg{flex-shrink:0;margin-top:1px}

/* PERMISSIONS */
.amc-perms{margin-top:18px}
.amc-perms-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:10px;margin-top:10px}
.amc-checkbox{display:flex;align-items:center;gap:9px;cursor:pointer;padding:10px 12px;border:1px solid #e2e8f0;border-radius:10px;transition:all .15s;user-select:none}
.amc-checkbox:hover{background:#f8fafc;border-color:#cbd5e1}
.amc-checkbox input{display:none}
.amc-checkbox__box{width:18px;height:18px;border:2px solid #cbd5e1;border-radius:5px;flex-shrink:0;position:relative;transition:all .15s}
.amc-checkbox input:checked + .amc-checkbox__box{background:#3b82f6;border-color:#3b82f6}
.amc-checkbox input:checked + .amc-checkbox__box::after{content:'';position:absolute;left:5px;top:2px;width:4px;height:8px;border:solid #fff;border-width:0 2px 2px 0;transform:rotate(45deg)}
.amc-checkbox__lbl{font-size:13px;color:#0f172a;font-weight:500}

/* SWITCH */
.amc-switch{display:flex;align-items:center;gap:12px;cursor:pointer;user-select:none}
.amc-switch input{display:none}
.amc-switch__slider{width:44px;height:24px;background:#cbd5e1;border-radius:99px;position:relative;transition:background .2s;flex-shrink:0}
.amc-switch__slider::after{content:'';position:absolute;left:3px;top:3px;width:18px;height:18px;background:#fff;border-radius:50%;transition:left .2s}
.amc-switch input:checked + .amc-switch__slider{background:#3b82f6}
.amc-switch input:checked + .amc-switch__slider::after{left:23px}
.amc-switch__lbl{font-size:13px;font-weight:500;color:#0f172a}

/* ACTIONS */
.amc-actions{display:flex;gap:12px;flex-wrap:wrap}
.amc-btn{display:inline-flex;align-items:center;gap:8px;font-family:'Inter',sans-serif;font-size:13px;font-weight:500;padding:11px 20px;border-radius:10px;cursor:pointer;text-decoration:none;transition:all .15s;border:1px solid transparent}
.amc-btn--primary{background:#3b82f6;color:#fff;border-color:#3b82f6}
.amc-btn--primary:hover{background:#2563eb;color:#fff}
.amc-btn--ghost{background:#fff;color:#64748b;border-color:#e2e8f0}
.amc-btn--ghost:hover{background:#f8fafc;color:#0f172a}

/* RESPONSIVE */
@media(min-width:900px){.amc-grid{grid-template-columns:1fr 1fr}.amc-panel:first-child{grid-column:1/2;grid-row:1/3}}
@media(max-width:600px){.amc-wrap{padding:16px}.amc-perms-grid{grid-template-columns:1fr}}

.layout-navbar-fixed .layout-wrapper:not(.layout-horizontal):not(.layout-without-menu) .layout-page{padding-top:22px!important;background-color:#f1f5f9!important}
</style>

@endsection
