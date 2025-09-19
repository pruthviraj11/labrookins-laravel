@extends('layouts/layoutMaster')
@section('title', $page_data['page_title'] ?? 'Reset Password')

@section('vendor-style')
    {{-- add page-specific css if needed --}}
@endsection

@section('content')
<section class="container mt-3">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">{{ $page_data['form_title'] ?? 'Change Password' }}</h4>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('reset-password.save') }}" method="POST" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="old_password" class="form-label">Enter Old Password</label>
                    <div class="input-group">
                        <input type="password" name="old_password" id="old_password"
                               class="form-control @error('old_password') is-invalid @enderror"
                               placeholder="Old password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#old_password">Show</button>
                        @error('old_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Enter New Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="New password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password">Show</button>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted">At least 8 characters, use letters, numbers & symbols.</small>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Re-Enter Password to Confirm</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               placeholder="Confirm password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password_confirmation">Show</button>
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('page-script')
<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(btn){
        btn.addEventListener('click', function(){
            const targetSelector = this.getAttribute('data-target');
            const input = document.querySelector(targetSelector);
            if (!input) return;
            if (input.type === 'password') {
                input.type = 'text';
                this.textContent = 'Hide';
            } else {
                input.type = 'password';
                this.textContent = 'Show';
            }
        });
    });
</script>
@endsection
