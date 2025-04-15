<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <!-- Include Bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

    <div class="content">
        <h1>Welcome to GenZBanking, Your money,our responsibility</h1>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
