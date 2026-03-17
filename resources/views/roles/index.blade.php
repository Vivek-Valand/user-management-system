@extends('layouts.app')

@section('title', 'Role Permissions')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark">Role & Permission Management</h2>
            <p class="text-muted">Manage module access for different user roles.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Select Role</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.index') }}" method="GET" id="roleSelectForm">
                        <div class="mb-3">
                            <label for="role_id" class="form-label fw-semibold">Role</label>
                            <select name="role_id" id="role_id" class="form-select shadow-sm" onchange="this.form.submit()">
                                <option value="" disabled {{ !request('role_id') ? 'selected' : '' }}>-- Select a Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            @if($selectedRole)
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-white border-bottom">
                        <h5 class="m-0 font-weight-bold text-primary">
                            Permissions for: <span class="text-dark">{{ ucfirst($selectedRole->name) }}</span>
                        </h5>
                    </div>
                    <form action="{{ route('roles.update_permissions') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $selectedRole->id }}">
                        
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 50px;" class="ps-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                                </div>
                                            </th>
                                            <th>Module / Menu Name</th>
                                            <th>Slug</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $selectedPermIds = $selectedRole->permissions->pluck('id')->toArray();
                                        @endphp
                                        @foreach($permissions as $permission)
                                            @if($selectedRole->name === 'admin' && $permission->slug === 'roles')
                                                @continue
                                            @endif
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input perm-checkbox" type="checkbox" name="permissions[]" 
                                                            value="{{ $permission->id }}" 
                                                            {{ in_array($permission->id, $selectedPermIds) ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-semibold text-dark">{{ $permission->name }}</span>
                                                </td>
                                                <td>
                                                    <code class="bg-light text-primary px-2 py-1 rounded small">{{ $permission->slug }}</code>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white p-4">
                            <div class="d-grid d-md-block text-md-end">
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="fas fa-save me-2"></i> Save Permissions
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <div class="card bg-light border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-user-shield fa-4x text-muted mb-3 opacity-25"></i>
                        <h5 class="text-muted">Please select a role from the left to manage permissions.</h5>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Select All functionality
        $('#selectAll').click(function() {
            $('.perm-checkbox').prop('checked', this.checked);
        });

        // Update Select All state based on individual checkboxes
        $('.perm-checkbox').click(function() {
            if ($('.perm-checkbox:checked').length == $('.perm-checkbox').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });
        
        // Initial check for select all
        if ($('.perm-checkbox:checked').length == $('.perm-checkbox').length && $('.perm-checkbox').length > 0) {
            $('#selectAll').prop('checked', true);
        }
    });
</script>
@endpush
