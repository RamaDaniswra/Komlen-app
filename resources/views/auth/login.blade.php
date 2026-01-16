<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Komik Online</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

  <div class="bg-white shadow-md border border-gray-200 rounded-xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="mb-4">
        <label class="text-gray-600 text-sm font-medium">Username</label>
        <input type="text" name="username" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-gray-300 focus:outline-none" placeholder="Masukkan Username" value="{{ old('username') }}" required autofocus />
        @error('username')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label class="text-gray-600 text-sm font-medium">Password</label>
        <input type="password" name="password" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-gray-300 focus:outline-none" placeholder="Masukkan Password" required />
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="w-full py-2.5 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition">Login</button>
    </form>

    <p class="text-sm text-gray-600 text-center mt-4">
      Belum punya akun? <a href="{{ route('register') }}" class="text-gray-900 font-medium hover:underline">Register</a>
    </p>
  </div>

</body>
</html>
