@extends('layouts.visitor')

@section('title', app_term('home') . ' | ' . config('app.name'))

@section('content')
<!-- Hero Section / Featured Products-like Articles -->
<section class="pt-12 pb-24 overflow-hidden border-b border-slate-100 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24 uppercase tracking-tighter">
            <div class="lg:w-1/2 space-y-10">
                <div class="inline-flex items-center gap-3 px-4 py-1.5 bg-blue-50 text-blue-600 rounded-full text-xs font-extrabold tracking-widest uppercase">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                    </span>
                    {{ __('Fresh Insights') }}
                </div>
                
                <h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 leading-[0.9] tracking-tighter uppercase italic">
                    The Modern <br> <span class="text-blue-600">Standard</span> of <br> CMS.
                </h1>
                
                <p class="text-lg text-slate-500 max-w-lg font-medium leading-relaxed normal-case tracking-normal">
                    Experience a modular architecture designed for the future. From high-end editorials to digital storefronts, our starter kit adapts to your vision.
                </p>
                
                <div class="flex items-center gap-6 pt-4">
                    <a href="#browse" class="bg-blue-600 text-white px-10 py-5 rounded-2xl font-black text-sm shadow-2xl shadow-blue-200 hover:bg-blue-700 transition-soft flex items-center gap-3 group">
                        {{ __('Browse Collections') }}
                        <i class="fas fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('register') }}" class="text-slate-800 font-black text-sm border-b-2 border-slate-900 pb-1 hover:text-blue-600 hover:border-blue-600 transition-soft uppercase tracking-widest">
                        {{ __('Join the Community') }}
                    </a>
                </div>
            </div>

            <div class="lg:w-1/2 relative">
                <div class="relative z-10 grid grid-cols-2 gap-4">
                    @foreach($featuredArticles as $featured)
                        <div class="rounded-3xl overflow-hidden aspect-[4/5] relative group shadow-2xl {{ $loop->first ? 'col-span-1 mt-12' : ($loop->iteration == 2 ? 'col-span-1' : 'col-span-2 -mt-12') }}">
                            <img src="{{ $featured->featured_image ? asset('storage/'.$featured->featured_image) : 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80' }}" 
                                 class="w-full h-full object-cover transition-soft group-hover:scale-110" alt="{{ $featured->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-80"></div>
                            <div class="absolute bottom-0 p-8 w-full">
                                <span class="text-[10px] font-black uppercase tracking-widest text-blue-400 mb-2 block">{{ $featured->category->name ?? 'Featured' }}</span>
                                <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 uppercase leading-tight">{{ $featured->title }}</h3>
                                <a href="{{ route('articles.show', $featured->slug) }}" class="inline-block p-4 bg-white/10 backdrop-blur-md rounded-xl text-white hover:bg-white hover:text-slate-900 transition-soft">
                                    <i class="fas fa-plus text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Abstract Elements -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-50 -z-10"></div>
                <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-purple-100 rounded-full blur-3xl opacity-50 -z-10"></div>
            </div>
        </div>
    </div>
</section>

<!-- Browser Section (Store Grid) -->
<section id="browse" class="py-24 bg-slate-50">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
            <div class="space-y-4 uppercase tracking-tighter">
                <h2 class="text-4xl font-extrabold text-slate-900 italic leading-none">{{ app_term('recent_articles') }}</h2>
                <p class="text-sm font-bold text-slate-500 tracking-widest">
                    {{ __('EXPLORE OUR LATEST CURATED CONTENT COLLECTIONS') }}
                </p>
            </div>
            
            <div class="flex gap-4 overflow-x-auto pb-4 md:pb-0 scrollbar-hide">
                <button class="px-8 py-3 bg-white border border-slate-100 rounded-2xl text-xs font-black uppercase tracking-widest text-slate-800 shadow-sm hover:shadow-md transition-soft whitespace-nowrap active-filter">
                    All
                </button>
                @foreach($categories as $cat)
                    <a href="{{ route('articles.category', $cat->slug) }}" class="px-8 py-3 bg-white border border-slate-100 rounded-2xl text-xs font-black uppercase tracking-widest text-slate-500 shadow-sm hover:shadow-md hover:text-blue-600 transition-soft whitespace-nowrap">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16">
            @forelse($articles as $article)
            <div class="group product-card">
                <div class="relative aspect-[4/5] rounded-3xl overflow-hidden mb-6 bg-slate-100 shadow-xl shadow-slate-200/50">
                    <img src="{{ $article->featured_image ? asset('storage/'.$article->featured_image) : 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&q=80' }}" 
                         class="w-full h-full object-cover transition-soft group-hover:scale-110 product-image" alt="{{ $article->title }}">
                    
                    <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-slate-900/20 transition-soft"></div>
                    
                    <!-- Quick View Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-soft delay-75 pointer-events-none group-hover:pointer-events-auto">
                        <a href="{{ route('articles.show', $article->slug) }}" class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-slate-900 hover:bg-blue-600 hover:text-white transition-soft shadow-2xl">
                            <i class="fas fa-expand text-lg"></i>
                        </a>
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md rounded-full text-[10px] font-black uppercase tracking-widest text-slate-800 shadow-sm">
                            {{ $article->category->name ?? 'Article' }}
                        </span>
                    </div>

                    @if($article->is_featured)
                        <div class="absolute top-4 right-4">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-[10px] shadow-lg">
                                <i class="fas fa-bolt"></i>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="space-y-2 uppercase tracking-tighter">
                    <div class="flex justify-between items-start gap-4">
                        <h3 class="text-xl font-extrabold text-slate-900 leading-tight group-hover:text-blue-600 transition-soft">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                    </div>
                    <div class="flex items-center gap-3 text-slate-500 font-bold text-[10px] tracking-widest border-t border-slate-100 pt-4">
                        <div class="w-6 h-6 rounded-full bg-slate-200 border border-slate-100 overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center text-xs text-slate-400 capitalize">
                                {{ substr($article->user->name, 0, 1) }}
                            </div>
                        </div>
                        {{ $article->user->name }}
                        <span class="text-slate-300">•</span>
                        {{ $article->created_at->format('M d, Y') }}
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-full py-20 text-center uppercase tracking-tighter">
                    <p class="text-2xl font-black text-slate-300">NO COLLECTIONS FOUND</p>
                </div>
            @endforelse
        </div>
        
        @if($articles->hasPages())
        <div class="mt-20 pt-10 border-t border-slate-100">
            {{ $articles->links() }}
        </div>
        @endif
    </div>
</section>

<!-- Call to Action -->
<section class="py-24">
    <div class="container mx-auto px-6">
        <div class="relative rounded-[40px] overflow-hidden bg-slate-900 py-24 px-8 md:px-20 text-center uppercase tracking-tighter">
            <!-- Background mesh -->
            <div class="absolute inset-0 opacity-40">
                <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_20%_30%,#2563eb_0%,transparent_50%)]"></div>
                <div class="absolute bottom-0 right-0 w-full h-full bg-[radial-gradient(circle_at_80%_70%,#4f46e5_0%,transparent_50%)]"></div>
            </div>
            
            <div class="relative z-10 space-y-10">
                <h2 class="text-5xl md:text-7xl font-extrabold text-white leading-none">Ready to <span class="text-blue-500">Transform</span> <br> Your Content?</h2>
                <p class="text-lg text-slate-400 normal-case tracking-normal max-w-2xl mx-auto font-medium">
                    Join thousands of creators building the next generation of digital experiences with our modular CMS engine.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-4">
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-12 py-5 rounded-2xl font-black text-sm shadow-2xl shadow-blue-500/20 hover:bg-blue-700 transition-soft uppercase tracking-widest">
                        Get Started For Free
                    </a>
                    <a href="#" class="bg-white/5 backdrop-blur-md text-white px-12 py-5 rounded-2xl font-black text-sm hover:bg-white/10 transition-soft uppercase tracking-widest border border-white/10">
                        View Documentation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection