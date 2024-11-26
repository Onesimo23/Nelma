<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplicação Segura')</title>

    <!-- CSS do Bootstrap e Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --navbar-bg: #6a1b9a;
            /* Roxo elegante */
            --navbar-text: #ffffff;
            /* Texto branco */

            --sidebar-bg: #212121;
            /* Preto */
            --sidebar-text: #e0e0e0;
            /* Cinza claro */
            --sidebar-hover: #ffb300;
            /* Dourado */
        }

        .navbar {
            background: var(--navbar-bg) !important;
            color: var(--navbar-text) !important;
        }

        .navbar * {
            color: var(--navbar-text) !important;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding-top: 70px;
        }

        .sidebar a {
            text-decoration: none;
            color: var(--sidebar-text);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: var(--sidebar-hover);
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 80px;
        }

        .nav-icon {
            font-size: 1.1rem;
        }

        .logo-img {
            height: 40px;
            width: auto;
        }

        .dropdown-menu * {
            color: #333 !important;
        }
    </style>
</head>

<body>
    <!-- Navbar superior -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://sig.unisave.ac.mz/sigeup/public/dist/img/up.png" alt="Logo" class="logo-img">
            </a>

            <!-- Menu do usuário -->
            <div class="ms-auto">
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::user()->name ?? 'Usuário' }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2" href="/profile">
                                <i class="bi bi-person"></i> Perfil
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center gap-2">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="/dashboard" class="nav-link">
            <i class="bi bi-house-door nav-icon"></i>
            <span>Dashboard</span>
        </a>
        <a href="/logs" class="nav-link">
            <i class="bi bi-journal-text nav-icon"></i>
            <span>Logs de Rastreamento</span>
        </a>
        <a href="/products" class="nav-link">
            <i class="bi bi-box nav-icon"></i>
            <span>Produtos(API)</span>
        </a>
        <a href="/sensitive_data" class="nav-link">
            <i class="bi bi-shield-lock nav-icon"></i>
            <span>Segurança de Dados</span>
        </a>
    </div>

    <!-- Conteúdo principal -->
    <div class="main-content">
        @if (isset($header))
        <header class="bg-white shadow-sm rounded mb-4">
            <div class="py-3 px-4">
                {{ $header }}
            </div>
        </header>
        @endif

        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>