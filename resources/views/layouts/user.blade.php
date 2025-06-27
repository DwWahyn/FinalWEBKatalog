<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ulfamart E-Katalog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    {{-- Navbar --}}
    <nav class="bg-green-700 text-white py-4 shadow">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Ulfamart</h1>
            <div class="flex gap-4 items-center">
                <a href="{{ url('/user/dashboard') }}" class="hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-white text-green-700 px-3 py-1 rounded hover:bg-gray-100 text-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="container mx-auto py-8 px-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-green-700 text-white text-center py-4 mt-10">
        © {{ date('Y') }} Ulfamart E-Katalog. All rights reserved.
    </footer>

</body>
</html>
