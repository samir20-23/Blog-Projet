<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ app_term('dashboard') }} | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 transition-transform duration-300 transform bg-slate-900 lg:translate-x-0 lg:static lg:inset-0"
               :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            <div class="flex items-center justify-between h-16 px-6 bg-slate-800">
                <span class="text-xl font-extrabold text-white">{{ config('app.name') }} <span class="text-blue-400">CMS</span></span>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                    {{ app_term('dashboard') }}
                </a>

                <div class="pt-4 pb-2">
                    <span class="px-4 text-xs font-semibold tracking-wider text-slate-500 uppercase">{{ app_term('blog') }}</span>
                </div>

                <a href="{{ route('admin.articles.index') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl {{ request()->routeIs('admin.articles.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fas fa-newspaper w-5 mr-3"></i>
                    {{ app_term('articles') }}
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fas fa-folder w-5 mr-3"></i>
                    {{ app_term('categories') }}
                </a>

                <a href="{{ route('admin.tags.index') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl {{ request()->routeIs('admin.tags.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fas fa-tags w-5 mr-3"></i>
                    {{ app_term('tags') }}
                </a>

                <a href="{{ route('admin.comments.index') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-colors rounded-xl {{ request()->routeIs('admin.comments.*') ? 'bg-blue-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fas fa-comments w-5 mr-3"></i>
                    {{ app_term('comments') }}
                </a>

                <div class="pt-4 pb-2">
                    <span class="px-4 text-xs font-semibold tracking-wider text-slate-500 uppercase">{{ app_term('system') }}</span>
                </div>

                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium transition-colors text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl">
                    <i class="fas fa-file w-5 mr-3"></i>
                    {{ app_term('pages') }}
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium transition-colors text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl">
                    <i class="fas fa-users w-5 mr-3"></i>
                    {{ app_term('users') }}
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium transition-colors text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl">
                    <i class="fas fa-cog w-5 mr-3"></i>
                    {{ app_term('settings') }}
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Header -->
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-slate-200">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="ml-4 text-lg font-semibold text-slate-800">
                        @yield('header')
                    </h2>
                </div>

                <div class="flex items-center space-x-4">
                    <div x-data="{ userMenuOpen: false }" class="relative">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center focus:outline-none">
                            <div class="flex items-center gap-3">
                                <span class="hidden text-sm font-semibold text-slate-700 sm:block">{{ auth()->user()->name }}</span>
                                <div class="w-10 h-10 bg-blue-600 flex items-center justify-center text-white font-bold rounded-xl shadow-lg">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </div>
                        </button>
                        <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-cloak
                             class="absolute right-0 w-48 mt-2 overflow-hidden bg-white rounded-xl shadow-xl border border-slate-100 z-[60]">
                            <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">Profile</a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                               class="block px-4 py-2 text-sm text-red-600 hover:bg-slate-50 transition-colors border-t">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Scroll Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50">
                <div class="container mx-auto px-6 py-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center shadow-sm">
                            <i class="fas fa-check-circle mr-3"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl flex items-center shadow-sm">
                            <i class="fas fa-exclamation-circle mr-3"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @yield('scripts')
</body>
</html>
