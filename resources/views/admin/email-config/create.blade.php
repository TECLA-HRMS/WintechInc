@extends('layouts.admin')

@section('adminContent')
<style>
    :root {
        --primary: #4f46e5; --primary-light: #eef2ff;
        --danger: #dc2626;  --danger-light: #fef2f2;
        --text-dark: #111827; --text-muted: #6b7280;
        --border: #e5e7eb;  --bg-light: #f9fafb;
    }
    .ec-page { background: #f1f5f9; min-height: 100vh; padding: 1.5rem; }

    .ec-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; }
    .ec-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-dark); margin: 0 0 0.25rem; }
    .ec-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text-muted); }
    .ec-breadcrumb a { color: var(--primary); text-decoration: none; }

    .btn-back { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1.1rem; border: 1px solid var(--border); border-radius: 8px; background: #fff; color: var(--text-dark); font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all .2s; }
    .btn-back:hover { background: var(--bg-light); color: var(--text-dark); }

    .form-card { background: #fff; border-radius: 14px; border: 1px solid var(--border); box-shadow: 0 1px 4px rgba(0,0,0,.05); overflow: hidden;  }
    .form-card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); background: var(--bg-light); display: flex; align-items: center; gap: 0.6rem; }
    .form-card-header h6 { margin: 0; font-size: 0.85rem; font-weight: 700; color: var(--text-dark); text-transform: uppercase; letter-spacing: 0.05em; }
    .card-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; background: var(--primary-light); color: var(--primary); }
    .form-card-body { padding: 1.75rem; }

    .field-label { font-size: 0.75rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block; }
    .field-input { width: 100%; border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; height: 42px; padding: 0 0.875rem; color: var(--text-dark); background: #fff; outline: none; transition: border-color .2s, box-shadow .2s; }
    .field-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79,70,229,.1); }
    .field-input.is-invalid { border-color: var(--danger); }
    .field-input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220,38,38,.1); }
    .field-error { font-size: 0.75rem; color: var(--danger); margin-top: 0.35rem; display: flex; align-items: center; gap: 0.3rem; }

    .form-card-footer { padding: 1.25rem 1.75rem; border-top: 1px solid var(--border); background: var(--bg-light); display: flex; align-items: center; gap: 0.75rem; }
    .btn-save { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.5rem; background: var(--primary); color: #fff; border: none; border-radius: 8px; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all .2s; }
    .btn-save:hover { background: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79,70,229,.3); }
    .btn-cancel { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.25rem; background: #fff; color: var(--text-muted); border: 1px solid var(--border); border-radius: 8px; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all .2s; }
    .btn-cancel:hover { background: var(--bg-light); color: var(--text-dark); }
</style>

<div class="ec-page">

    <!-- Header -->
    <div class="ec-header">
        <div>
            <h1><i class="fa-solid fa-envelope-open-text me-2" style="color:var(--primary)"></i>Add Email</h1>
            <div class="ec-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.emailconfig.index') }}">Email Config</a>
                <span>/</span>
                <span>Add New</span>
            </div>
        </div>
        <a href="{{ route('admin.emailconfig.index') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-card-header">
            <div class="card-icon"><i class="fa-solid fa-plus"></i></div>
            <h6>New Email Address</h6>
        </div>

        <form action="{{ route('admin.emailconfig.store') }}" method="POST" id="emailConfigForm">
            @csrf
            <div class="form-card-body">

                <!-- Name -->
                <div class="mb-4">
                    <label class="field-label">Name <span style="color:var(--danger)">*</span></label>
                    <input type="text"
                           name="name"
                           class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           value="{{ old('name') }}"
                           placeholder="e.g. HR Department">
                    @error('name')
                        <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-2">
                    <label class="field-label">Email Address <span style="color:var(--danger)">*</span></label>
                    <div style="position:relative">
                        <i class="fa-solid fa-at" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--text-muted);font-size:.8rem;pointer-events:none"></i>
                        <input type="email"
                               name="email"
                               class="field-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               style="padding-left:34px"
                               value="{{ old('email') }}"
                               placeholder="example@domain.com">
                    </div>
                    @error('email')
                        <div class="field-error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message == 'validation.email' ? 'Please enter a valid email address (e.g., example@domain.com)' : $message }}
                        </div>
                    @enderror
                </div>

            </div>

            <div class="form-card-footer">
                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-check"></i> Save Email
                </button>
                <a href="{{ route('admin.emailconfig.index') }}" class="btn-cancel">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
