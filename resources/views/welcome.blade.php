<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light text-dark font-sans">
    <div class="container-fluid min-vh-100 d-flex flex-column justify-content-center align-items-center">
        <header class="d-flex justify-content-between align-items-center py-4">
            <a href="/" class="text-decoration-none text-dark">
                <svg class="h-3 w-auto text-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 62 65">
                    <!-- SVG Content Here -->
                </svg>
            </a>
            <nav>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary me-2">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <main class="container my-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h2 class="card-title h4">Documentation</h2>
                            <p class="card-text mt-3">
                                Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience, we recommend reading our documentation from beginning to end.
                            </p>
                            <a href="https://laravel.com/docs" class="btn btn-outline-secondary mt-3">Learn More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h2 class="card-title h4">Laracasts</h2>
                            <p class="card-text mt-3">
                                Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out and level up your development skills.
                            </p>
                            <a href="https://laracasts.com" class="btn btn-outline-secondary mt-3">Learn More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h2 class="card-title h4">Laravel News</h2>
                            <p class="card-text mt-3">
                                Laravel News aggregates the latest news in the Laravel ecosystem, including new package releases and tutorials.
                            </p>
                            <a href="https://laravel-news.com" class="btn btn-outline-secondary mt-3">Learn More</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h2 class="card-title h4">Vibrant Ecosystem</h2>
                            <p class="card-text mt-3">
                                Laravel's library of tools like Forge, Vapor, and Nova, along with open-source libraries, help take projects to the next level.
                            </p>
                            <a href="https://laravel.com" class="btn btn-outline-secondary mt-3">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="text-center py-4">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</body>
</html>
