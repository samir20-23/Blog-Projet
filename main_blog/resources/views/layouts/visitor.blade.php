<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Projet | Insights & Stories</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .font-heading { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .bg-mesh { background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%); }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased selection:bg-blue-500 selection:text-white">
    <nav class="sticky top-0 z-50 glass shadow-sm transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('articles.home') }}" class="text-2xl font-extrabold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent flex items-center gap-2 group">
                <div class="p-2 bg-blue-600 rounded-xl text-white group-hover:rotate-12 transition-transform duration-300">
                    <i class="fas fa-bolt text-sm"></i>
                </div>
                <span>Blog Projet</span>
            </a>
            <div class="flex items-center gap-1">
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-slate-600 hover:text-blue-600 font-semibold text-sm transition transition-all duration-300">Admin Dashboard</a>
                    @endif
                    <div class="ml-2 pl-4 border-l border-slate-200 flex items-center gap-3">
                        <span class="text-sm font-medium text-slate-500 hidden sm:inline">{{ auth()->user()->name }}</span>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-slate-900 text-white hover:bg-slate-800 px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-slate-200 transition-all duration-300">
                            Logout
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-slate-700 hover:text-blue-600 font-bold text-sm transition-all duration-300">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-2.5 rounded-xl text-sm font-bold shadow-xl shadow-blue-200 transition-all duration-300">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="min-h-screen">
        @yield('content')
    </main>
    <footer class="bg-white border-t border-slate-100 mt-24">
        <div class="container mx-auto px-6 py-12 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-slate-400 font-medium">
                &copy; 2026 Blog Projet. Created with excellence.
            </div>
            <div class="flex gap-6">
                <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><i class="fab fa-github text-xl"></i></a>
                <a href="#" class="text-slate-400 hover:text-blue-600 transition-colors"><i class="fab fa-linkedin text-xl"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
