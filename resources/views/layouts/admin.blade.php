<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-800">
            Store Admin
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 flex flex-col">
            <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Users</a>
            <a href="{{ route('admin.orders') }}" class="block px-4 py-2 rounded hover:bg-gray-800">Orders</a>
        
            <!-- Divider to separate logout from main links -->
            <div class="my-4 border-t border-gray-800"></div>
        
            <!-- Secure Logout Form -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded text-red-400 hover:bg-gray-800 hover:text-red-300 transition-colors">
                    Log Out
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</body>
</html>