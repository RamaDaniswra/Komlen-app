<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="bg-gray-900 text-gray-200 w-64 p-6 flex flex-col">
            <h2 class="text-white text-2xl font-bold mb-6">Admin Panel</h2>

            <nav class="flex-1 space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="block px-3 py-2 rounded hover:bg-gray-800">
                    Dashboard
                </a>

                <a href="{{ route('admin.comics.index') }}" 
                   class="block px-3 py-2 rounded hover:bg-gray-800">
                    Komik
                </a>

                <a href="{{ route('admin.chapters.index') }}" 
                   class="block px-3 py-2 rounded hover:bg-gray-800">
                    Chapter
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="block px-3 py-2 rounded hover:bg-gray-800">
                    Users
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full bg-red-600 py-2 mt-4 rounded hover:bg-red-700">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto">
            @yield('content')
        </main>

    </div>

</body>
</html>
