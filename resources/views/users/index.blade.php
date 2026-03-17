@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col-6">
            <h2 class="fw-bold text-dark mb-0">Users Management</h2>
        </div>
        <div class="col-6 text-end">
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Add New User
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-secondary"></i>
                                    </div>
                                    <span class="fw-semibold">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role)
                                    <span class="badge bg-light text-primary border border-primary-subtle">{{ ucfirst($user->role->name) }}</span>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $user->status === 'active' ? 'active' : 'inactive' }}">
                                    <i class="fas fa-circle me-1" style="font-size: 8px;"></i> {{ ucfirst($user->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-light text-primary me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                                <button type="button" class="btn btn-sm btn-light text-danger delete-user" data-id="{{ $user->id }}" data-status="{{ $user->status }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="https://illustrations.popsy.co/gray/no-data.svg" alt="No data" style="width: 150px;" class="mb-3">
                                <p class="text-muted">No users found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-user').click(function() {
            const userId = $(this).data('id');
            const status = $(this).data('status');

            if (status === 'active') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Access Denied',
                    text: 'Active users cannot be deleted!',
                    confirmButtonColor: '#4e73df',
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/users/${userId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                xhr.responseJSON.message || 'Something went wrong.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
