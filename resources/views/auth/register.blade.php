<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-10 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" class="w-full px-3 py-2 border rounded-lg mb-4" required />
            @error('username')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email" class="w-full px-3 py-2 border rounded-lg mb-4" required />
            @error('email')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" class="w-full px-3 py-2 border rounded-lg mb-4" required />
            @error('password')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Ulangi password" class="w-full px-3 py-2 border rounded-lg mb-4" required />

            <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-black mb-4">Daftar</button>

            <div class="text-center text-sm text-gray-600">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-gray-900 font-medium hover:underline">Login</a>
            </div>
        </form>
    </div>

</body>
</html>
