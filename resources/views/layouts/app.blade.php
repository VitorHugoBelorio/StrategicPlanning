<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Planejamento Estratégico')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    {{-- 🔹 Exibir navbar apenas fora das rotas de login, registro e reset --}}
    @unless (Route::is('login') || Route::is('register') || Route::is('password.request') || Route::is('password.reset'))
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="{{ url('/') }}">
                    <i class="bi bi-bar-chart-fill me-1"></i> Planejamento Estratégico
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto align-items-center">

                        @auth
                            <li class="nav-item me-3">
                                <span class="navbar-text text-white">
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ Auth::user()->name }}
                                </span>
                            </li>

                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light btn-sm">
                                        <i class="bi bi-box-arrow-right me-1"></i> Sair
                                    </button>
                                </form>
                            </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>
    @endunless

    <main class="@unless (Route::is('login') || Route::is('register')) mt-4 @endunless">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
