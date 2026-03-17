@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark mb-1">Dashboard Overview</h2>
            <p class="text-muted">Quick statistics and recent activities.</p>
        </div>
    </div>
    
    <!-- Small Stat Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #4e73df !important;">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 0.7rem;">Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #1cc88a !important;">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 0.7rem;">Active Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #36b9cc !important;">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 0.7rem;">System Roles</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRoles }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-shield fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #f6c23e !important;">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 0.7rem;">New Users (Month)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $newUsersThisMonth }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-lg text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Recently Joined Users -->
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recently Joined Users</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3 border-0">User</th>
                                    <th class="border-0">Role</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0 text-end pe-3">Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentlyJoinedUsers as $user)
                                <tr>
                                    <td class="ps-3 border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user text-secondary" style="font-size: 0.8rem;"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $user->name }}</div>
                                                <div class="text-muted small">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge bg-light text-primary border border-primary-subtle" style="font-size: 0.7rem;">
                                            {{ ucfirst($user->role->name ?? 'None') }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge badge-{{ $user->status === 'active' ? 'active' : 'inactive' }}" style="font-size: 0.7rem;">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-3 border-bottom-0">
                                        <span class="text-muted">{{ $user->created_at->diffForHumans() }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small">No new users found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
