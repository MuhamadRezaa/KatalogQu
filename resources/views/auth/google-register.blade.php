<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pendaftaran Google</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Satu Langkah Lagi!</h1>
            <p class="text-gray-600">Konfirmasi detail Anda untuk menyelesaikan pendaftaran dengan Google.</p>
        </div>

        <div class="flex items-center justify-center">
            @php
                $avatar =
                    data_get($google_user, 'avatar') ?:
                    data_get($google_user, 'avatar_original') ?:
                    data_get($google_user, 'picture'); // kadang key-nya ini
            @endphp

            @if ($avatar)
                <img src="{{ $avatar }}" alt="Avatar" class="w-20 h-20 rounded-full border-2 border-gray-300"
                    referrerpolicy="no-referrer"
                    onerror="this.onerror=null;this.src='{{ asset('assets/images/defaultfoto.png') }}'">
            @else
                <div
                    class="w-20 h-20 rounded-full border-2 border-gray-300 flex items-center justify-center text-xs text-gray-500">
                    No photo
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('google.register') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="google_id" value="{{ $google_user['google_id'] }}">
            <input type="hidden" name="avatar" value="{{ $google_user['avatar'] }}">

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ $google_user['name'] }}" required
                    class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ $google_user['email'] }}" readonly
                    class="w-full px-3 py-2 mt-1 bg-gray-100 border border-gray-300 rounded-md">
            </div>

            <div>
                <button type="submit"
                    class="w-full py-2 px-4 font-semibold text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Daftar dan Masuk
                </button>
            </div>
        </form>
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline"><i>Batal dan kembali ke
                    Login</i></a>
        </div>
    </div>
</body>

</html>
