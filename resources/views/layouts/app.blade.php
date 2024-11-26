<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplicação')</title>

    <!-- CSS do Bootstrap e Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            /* Opção 1 - Azul Moderno */
            --navbar-bg: #2563eb;
            /* Azul vibrante */
            --navbar-text: #ffffff;

            /* Opção 2 - Roxo Elegante */
            --navbar-bg: #6d28d9;
            /* Roxo profundo */
            --navbar-text: #ffffff;

            /* Opção 3 - Verde Corporativo */
            --navbar-bg: #059669;
            /* Verde esmeralda */
            --navbar-text: #ffffff;

            /* Opção 4 - Gradiente Moderno */
            --navbar-bg: linear-gradient(to right, #3b82f6, #2563eb);
            --navbar-text: #ffffff;
        }

        /* Adicione essa classe se escolher usar o gradiente */
        .navbar {
            background: var(--navbar-bg) !important;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 70px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid #dee2e6;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 80px;
        }

        .navbar {
            position: fixed;
            width: 100%;
            z-index: 1000;
            background-color: var(--navbar-bg) !important;
        }

        .navbar * {
            color: var(--navbar-text) !important;
        }

        .nav-link {
            padding: 12px 16px;
            color: #333;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link:hover {
            background-color: var(--sidebar-hover);
            border-radius: 4px;
        }

        .logo-img {
            height: 40px;
            width: auto;
        }

        .dropdown-menu {
            right: 0;
            left: auto;
        }

        .dropdown-menu * {
            color: #333 !important;
        }

        .nav-icon {
            font-size: 1.1rem;
            width: 24px;
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
    <div class="sidebar" style="width: 250px;">
        <div class="d-flex flex-column px-3">
            <a href="/dashboard" class="nav-link">
                <i class="bi bi-house-door nav-icon"></i>
                <span>Dashboard</span>
            </a>
            <a href="/users" class="nav-link">
                <i class="bi bi-people nav-icon"></i>
                <span>Usuários</span>
            </a>
            <a href="/products" class="nav-link">
                <i class="bi bi-box nav-icon"></i>
                <span>Produtos</span>
            </a>
            <a href="/logs" class="nav-link">
                <i class="bi bi-cart nav-icon"></i>
                <span>Ver Logs</span>
            </a>
            <a href="/movies" class="nav-link">
                <i class="bi bi-film nav-icon"></i>
                <span>Filmes</span>
            </a>

            <a href="/reports" class="nav-link">
                <i class="bi bi-graph-up nav-icon"></i>
                <span>Relatórios</span>
            </a>
            <a href="/settings" class="nav-link">
                <i class="bi bi-gear nav-icon"></i>
                <span>Configurações</span>
            </a>
        </div>
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