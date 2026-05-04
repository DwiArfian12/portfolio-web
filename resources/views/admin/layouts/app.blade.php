<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-size: .875rem;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            z-index: 1000;
            background: linear-gradient(180deg, #2c3e50 0%, #1a252f 100%);
            transition: all 0.3s ease;
            overflow-y: auto;
        }
        .sidebar.collapsed {
            margin-left: -250px;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #adb5bd;
            padding: .75rem 1rem;
            border-radius: .25rem;
            margin: 2px 8px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.1);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.15);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Top navbar */
        .navbar-top {
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            z-index: 999;
            transition: left 0.3s ease;
            padding: 10px 20px;
        }
        .navbar-top.sidebar-collapsed {
            left: 0;
        }

        /* Main content */
        .main-content-wrapper {
            margin-left: 250px;
            padding-top: 60px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        .main-content-wrapper.sidebar-collapsed {
            margin-left: 0;
        }

        /* Toggle button */
        .toggle-sidebar-btn {
            background: none;
            border: none;
            font-size: 1.3rem;
            color: #495057;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background 0.2s;
        }
        .toggle-sidebar-btn:hover {
            background: #e9ecef;
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }
        .sidebar-overlay.active {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.mobile-open {
                margin-left: 0;
            }
            .navbar-top {
                left: 0;
            }
            .main-content-wrapper {
                margin-left: 0;
            }
        }

        .card-dashboard {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .card-dashboard:hover {
            transform: translateY(-5px);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="position-sticky">
            <div class="text-center py-3 border-bottom border-secondary">
                <a href="{{ route('home') }}" class="text-white text-decoration-none">
                    <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Admin Panel</h5>
                </a>
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.profiles.*') ? 'active' : '' }}" href="{{ route('admin.profiles.index') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}" href="{{ route('admin.skills.index') }}">
                        <i class="fas fa-cogs"></i> Skills
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" href="{{ route('admin.galleries.index') }}">
                        <i class="fas fa-images"></i> Gallery
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
                        <i class="fas fa-folder-open"></i> Projects
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
                        <i class="fas fa-envelope"></i> Messages
                    </a>
                </li>
            </ul>
            <hr class="border-secondary">
            <ul class="nav flex-column mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i> View Site
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Top navbar -->
    <nav class="navbar-top d-flex justify-content-between align-items-center shadow-sm" id="navbarTop">
        <div class="d-flex align-items-center">
            <button class="toggle-sidebar-btn" id="toggleSidebar" title="Toggle Sidebar">
                <i class="fas fa-bars"></i>
            </button>
            <h5 class="mb-0 ms-2">@yield('title', 'Dashboard')</h5>
        </div>
        <div>
            <a href="{{ route('admin.settings.index') }}" class="text-decoration-none text-dark me-3" title="Settings">
                <i class="fas fa-cog"></i>
            </a>
            <span><i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}</span>
        </div>
    </nav>

    <!-- Main content -->
    <div class="main-content-wrapper" id="mainContentWrapper">
        <main class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            const sidebar = $('#sidebar');
            const navbarTop = $('#navbarTop');
            const mainContent = $('#mainContentWrapper');
            const overlay = $('#sidebarOverlay');
            const toggleBtn = $('#toggleSidebar');

            // Check localStorage for sidebar state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.addClass('collapsed');
                navbarTop.addClass('sidebar-collapsed');
                mainContent.addClass('sidebar-collapsed');
            }

            // Toggle sidebar
            toggleBtn.on('click', function() {
                const isMobile = window.innerWidth <= 768;

                if (isMobile) {
                    sidebar.toggleClass('mobile-open');
                    overlay.toggleClass('active');
                } else {
                    sidebar.toggleClass('collapsed');
                    navbarTop.toggleClass('sidebar-collapsed');
                    mainContent.toggleClass('sidebar-collapsed');
                    localStorage.setItem('sidebarCollapsed', sidebar.hasClass('collapsed'));
                }
            });

            overlay.on('click', function() {
                sidebar.removeClass('mobile-open');
                overlay.removeClass('active');
            });

            $(window).on('resize', function() {
                if (window.innerWidth > 768) {
                    overlay.removeClass('active');
                    sidebar.removeClass('mobile-open');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
