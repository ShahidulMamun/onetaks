{{-- resources/views/auth/reset-password.blade.php --}}
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>নতুন Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">নতুন Password সেট করুন</h2>
    <p class="text-center text-gray-500 mb-6 text-sm">কমপক্ষে 6 অক্ষরের password দিন</p>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('password.reset') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">নতুন Password</label>
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    placeholder="নতুন password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="button" onclick="togglePass('password')"
                    class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 text-xs">👁</button>
            </div>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Password নিশ্চিত করুন</label>
            <div class="relative">
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    placeholder="আবার password দিন"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button type="button" onclick="togglePass('password_confirmation')"
                    class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 text-xs">👁</button>
            </div>
        </div>
        <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition">
            Password পরিবর্তন করুন
        </button>
    </form>
</div>
<script>
    function togglePass(id) {
        const el = document.getElementById(id);
        el.type = el.type === 'password' ? 'text' : 'password';
    }
</script>
</body>
</html>