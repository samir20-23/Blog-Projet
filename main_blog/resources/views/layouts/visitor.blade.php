<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, .font-heading { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.5); }
        .product-card:hover .product-image { transform: scale(1.05); }
        .transition-soft { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-[#fafafa] text-slate-900 antialiased selection:bg-blue-600 selection:text-white">
    <!-- Navigation -->
    <nav class="sticky top-0 z-50 glass shadow-sm transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-12">
                <a href="{{ route('home') }}" class="text-2xl font-extrabold flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-blue-200 group-hover:rotate-12 transition-soft">
                        <i class="fas fa-cubes text-lg"></i>
                    </div>
                    <span class="tracking-tight text-slate-800">{{ config('app.name') }}</span>
                </a>
                
                <div class="hidden lg:flex items-center gap-8 text-sm font-bold text-slate-500">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors uppercase tracking-widest leading-none">{{ app_term('home') }}</a>
                    @foreach($categories ?? [] as $navCat)
                        <a href="{{ route('articles.category', $navCat->slug) }}" class="hover:text-blue-600 transition-colors uppercase tracking-widest leading-none">{{ $navCat->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button class="w-10 h-10 flex items-center justify-center text-slate-400 hover:text-blue-600 transition-colors">
                    <i class="fas fa-search text-lg"></i>
                </button>
                
                <div class="h-6 w-px bg-slate-200 mx-2"></div>

                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3">
                            <span class="hidden sm:inline text-sm font-bold text-slate-700">{{ auth()->user()->name }}</span>
                            <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 overflow-hidden border border-slate-200">
                                @if(auth()->user()->profile && auth()->user()->profile->avatar)
                                    <img src="{{ asset('storage/'.auth()->user()->profile->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-user text-sm"></i>
                                @endif
                            </div>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute right-0 w-48 mt-3 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-50">
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 border-b border-slate-50 transition-colors">
                                    <i class="fas fa-shield-alt mr-2 text-blue-600"></i> Admin
                                </a>
                            @endif
                            <a href="#" class="block px-4 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors">My Profile</a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                               class="block px-4 py-3 text-sm font-bold text-red-600 hover:bg-slate-50 transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i> Log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-bold text-slate-600 hover:text-blue-600 transition-colors">Sign in</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-2.5 rounded-2xl text-sm font-bold shadow-lg shadow-blue-100 transition-soft">
                            Join Free
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="container mx-auto px-6 mt-6">
                <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 mt-24 pt-24 pb-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-12 border-b border-white/5">
                <div class="col-span-1 md:col-span-1">
                    <a href="#" class="text-2xl font-extrabold text-white flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center text-white">
                            <i class="fas fa-cubes text-lg"></i>
                        </div>
                        <span>{{ config('app.name') }}</span>
                    </a>
                    <p class="text-sm leading-relaxed mb-8">
                        The ultimate modular CMS starter kit for visionaries. Build anything from blogs to high-end stores in minutes.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-soft">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-soft">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-soft">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
                
                @foreach($footerMenus ?? [] as $title => $links)
                <div>
                    <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">{{ $title }}</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        @foreach($links as $text => $url)
                            <li><a href="{{ $url }}" class="hover:text-white transition-colors">{{ $text }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
                
                <div>
                    <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Categories</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        @foreach($categories ?? [] as $footerCat)
                            <li><a href="{{ route('articles.category', $footerCat->slug) }}" class="hover:text-white transition-colors">{{ $footerCat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6 uppercase tracking-widest text-xs">Newsletter</h4>
                    <p class="text-sm mb-6">Stay ahead of the curve with our latest insights.</p>
                    <div class="relative">
                        <input type="email" placeholder="Your email" class="w-full bg-white/5 border border-white/10 rounded-2xl py-3 px-5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <button class="absolute right-2 top-2 bg-blue-600 text-white px-4 py-1.5 rounded-xl text-xs font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/20">Go</button>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-xs">&copy; {{ date('Y') }} {{ config('app.name') }}. Built with ❤️ for everyone.</p>
                <div class="flex gap-8 text-xs font-bold text-white uppercase tracking-widest">
                    <a href="#" class="hover:text-blue-600 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-blue-600 transition-colors">Terms</a>
                    <a href="#" class="hover:text-blue-600 transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
