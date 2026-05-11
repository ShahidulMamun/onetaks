{{-- resources/views/auth/verify-otp.blade.php --}}
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">OTP যাচাই করুন</h2>
    <p class="text-center text-gray-500 mb-6 text-sm">
        <strong>{{ session('password_reset_email') }}</strong> তে পাঠানো ৬ সংখ্যার OTP দিন
    </p>

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

    <form action="{{ route('password.otp.verify') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">OTP কোড</label>
            <input
                type="text"
                name="otp"
                maxlength="6"
                required
                placeholder="000000"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-center text-2xl tracking-widest font-mono focus:outline-none focus:ring-2 focus:ring-blue-500"
                autocomplete="one-time-code"
            >
        </div>

        {{-- Countdown Timer --}}
        <p class="text-center text-sm text-gray-500 mb-4">
            মেয়াদ শেষ হবে: <span id="timer" class="font-semibold text-red-500">10:00</span>
        </p>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition">
            OTP যাচাই করুন
        </button>
    </form>

    <form action="{{ route('password.otp.send') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="email" value="{{ session('password_reset_email') }}">
        <button type="submit"
            class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 rounded-lg transition text-sm">
            OTP আবার পাঠান
        </button>
    </form>
</div>

<script>
    // Countdown 10 minutes
    let seconds = 600;
    const timerEl = document.getElementById('timer');
    const interval = setInterval(() => {
        seconds--;
        const m = String(Math.floor(seconds / 60)).padStart(2, '0');
        const s = String(seconds % 60).padStart(2, '0');
        timerEl.textContent = `${m}:${s}`;
        if (seconds <= 0) {
            clearInterval(interval);
            timerEl.textContent = 'মেয়াদ শেষ';
            timerEl.classList.add('text-red-700');
        }
    }, 1000);
</script>
</body>
</html>