<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        User Management System
    </div>
    <ul>
        @can('dashboard')
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
        </li>
        @endcan

        @can('users')
        <li>
            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Users
            </a>
        </li>
        @endcan

        @can('roles')
        <li>
            <a href="{{ route('roles.index') }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> Roles & Permissions
            </a>
        </li>
        @endcan

        <li class="mt-auto">
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</aside>
