<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - User Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @stack('styles')
    
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            height: 100vh;
            background-color: #f4f6f9;
            box-sizing: border-box;
        }
        *, *:before, *:after {
            box-sizing: inherit;
        }
        .layout {
            display: flex;
            height: 100vh;
            width: 100%;
        }
        .sidebar {
            width: 250px;
            min-width: 250px;
            background-color: #1f2937;
            color: #f3f4f6;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 0.3s;
        }
        .sidebar-header {
            padding: 1.5rem 1rem;
            text-align: center;
            background-color: #111827;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #374151;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }
        .sidebar ul li {
            border-bottom: 1px solid #374151;
        }
        .sidebar ul li a, .logout-btn {
            display: block;
            padding: 1rem 1.5rem;
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
        }
        .sidebar ul li a:hover, .sidebar ul li a.active, .logout-btn:hover {
            background-color: #374151;
            color: white;
            padding-left: 1.75rem;
        }
        .sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .logout-form {
            margin: 0;
        }
        .logout-btn {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            font-size: 1rem;
            font-family: inherit;
            cursor: pointer;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
        }
        .navbar {
            background-color: white;
            padding: 0.75rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            z-index: 10;
        }
        .navbar .welcome-text {
            font-size: 1rem;
            color: #374151;
        }
        .content {
            padding: 2rem;
            flex: 1;
            overflow-y: auto;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                min-width: 0;
                overflow: hidden;
            }
            .sidebar.active {
                width: 250px;
                min-width: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <!-- Sidebar Overlay (Mobile) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar Partial -->
        @include('layouts.partials.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <header class="navbar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link me-3 p-0" id="sidebarToggle">
                        <i class="fas fa-bars fa-lg text-dark"></i>
                    </button>
                    <div class="welcome-text d-none d-sm-block">
                        Welcome, <strong>{{ auth()->user()->name ?? 'Guest' }}</strong>
                    </div>
                </div>
            </header>

            <!-- Page Content section -->
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // Sidebar toggle
            $('#sidebarToggle, #sidebarOverlay').click(function() {
                $('#sidebar').toggleClass('active');
                $('#sidebarOverlay').toggleClass('active');
            });

            // SweetAlert Toast helper
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            window.toast = Toast;

            // Flash messages
            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif

            @if(session('error'))
                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                });
            @endif
        });
    </script>
    
    @stack('scripts')
</body>
</html>
