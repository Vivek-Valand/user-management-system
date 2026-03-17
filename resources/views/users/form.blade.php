@extends('layouts.app')

@section('title', $user->exists ? 'Edit User' : 'Add New User')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $user->exists ? 'Edit User' : 'Add New User' }}</li>
                </ol>
            </nav>
            <h2 class="fw-bold text-dark">{{ $user->exists ? 'Edit User' : 'Create New User' }}</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-{{ $user->exists ? 'user-edit' : 'user-plus' }} me-2"></i>
                        User Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ $user->exists ? route('users.update', $user->id) : route('users.store') }}" method="POST">
                        @csrf
                        @if($user->exists)
                            @method('PUT')
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter full name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="name@example.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label fw-semibold">Password {{ $user->exists ? '(Leave blank to keep current)' : '' }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Min 8 characters" {{ $user->exists ? '' : 'required' }}>
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="role_id" class="form-label fw-semibold">User Role</label>
                                <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                                    <option value="" disabled selected>Select a role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <div class="d-flex align-items-center">
                                    <div class="me-3 fw-semibold">User Status:</div>
                                    <label class="switch">
                                        <input type="checkbox" name="status" id="status" {{ old('status', $user->status ?? 'active') === 'active' ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="ms-3 text-muted" id="status-label">{{ old('status', $user->status ?? 'active') === 'active' ? 'Active' : 'Inactive' }}</span>
                                </div>
                            </div>

                            <div class="col-12 mt-5 border-top pt-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('users.index') }}" class="btn btn-light px-4 border">Cancel</a>
                                    <button type="submit" class="btn btn-primary px-5">
                                        <i class="fas fa-save me-2"></i> Save User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('.toggle-password').click(function() {
            const input = $(this).siblings('input');
            const icon = $(this).find('i');
            
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Status label update
        $('#status').change(function() {
            if ($(this).is(':checked')) {
                $('#status-label').text('Active');
            } else {
                $('#status-label').text('Inactive');
            }
        });
    });
</script>
@endpush
