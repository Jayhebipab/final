<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form method="POST" action="/login" class="bg-white p-8 rounded shadow-md w-96">
        @csrf

        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if(session('error'))
            <p class="text-red-500 text-sm mb-4">{{ session('error') }}</p>
        @endif

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-6">
            <label>Password</label>
            <input type="password" name="password" required class="w-full px-3 py-2 border rounded">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white w-full py-2 px-4 rounded">
            Login
        </button>
    </form>
</body>
</html>
