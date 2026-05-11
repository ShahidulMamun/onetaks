{{-- resources/views/auth/forgot-password.blade.php --}}
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Password ভুলে গেছেন?</h2>
    <p class="text-center text-gray-500 mb-6 text-sm">আপনার email দিন, আমরা OTP পাঠাবো</p>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('password.otp.send') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                placeholder="example@email.com"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
            OTP পাঠান
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">← Login এ ফিরে যান</a>
    </p>
</div>
</body>
</html>