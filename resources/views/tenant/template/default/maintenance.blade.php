<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $store->store_name ?? 'Store' }} - Under Maintenance</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-500 p-6 text-center">
            <div class="flex justify-center mb-4">
                <div class="bg-white p-3 rounded-full">
                    <i data-lucide="settings" class="h-12 w-12 text-blue-500"></i>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-white">{{ $store->store_name ?? 'Our Store' }}</h1>
        </div>

        <div class="p-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Under Maintenance</h2>
            <p class="text-gray-600 mb-6">
                We're currently improving our store to serve you better. Please check back soon!
            </p>

            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <p class="text-blue-800 font-medium">
                    {{ $store->maintenance_message ?? 'Our team is working hard to bring you an improved shopping experience.' }}
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="mailto:{{ $store->store_email ?? 'info@example.com' }}"
                    class="flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                    <i data-lucide="mail" class="h-5 w-5"></i>
                    Contact Us
                </a>
                <a href="https://wa.me/{{ $store->whatsapp_number ?? '6281234567890' }}" target="_blank"
                    class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                    <i data-lucide="message-circle" class="h-5 w-5"></i>
                    WhatsApp
                </a>
            </div>
        </div>

        <div class="bg-gray-50 p-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ $store->store_name ?? 'Store' }}. All rights reserved.
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>