@extends('layouts.visitor')

@section('title', $category->name . ' | Collections | ' . config('app.name'))

@section('content')
<section class="pt-24 pb-24 bg-white border-b border-slate-50 uppercase tracking-tighter italic">
    <div class="container mx-auto px-6 text-center space-y-8">
        <span class="text-xs font-black text-blue-600 tracking-widest leading-none bg-blue-50 px-6 py-2 rounded-full">
            {{ app_term('category') }}
        </span>
        <h1 class="text-6xl md:text-9xl font-extrabold text-slate-900 leading-[0.85] tracking-tighter uppercase italic">
            {{ $category->name }}
        </h1>
        @if($category->description)
            <p class="text-xl text-slate-500 font-medium normal-case tracking-normal leading-relaxed max-w-2xl mx-auto not-italic">
                {{ $category->description }}
            </p>
        @endif
        
        <div class="pt-8 flex justify-center gap-4 text-[10px] font-black tracking-widest text-slate-400 not-italic">
            <span>{{ $articles->total() }} Articles</span>
            <span class="w-1.5 h-1.5 bg-slate-200 rounded-full my-auto"></span>
            <span>Curated Collection</span>
        </div>
    </div>
</section>

<section class="py-24 bg-slate-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-20">
            @forelse($articles as $article)
            <div class="group product-card">
                <div class="relative aspect-[4/5] rounded-[40px] overflow-hidden mb-8 bg-slate-200 shadow-2xl shadow-slate-200/50">
                    <img src="{{ $article->featured_image ? asset('storage/'.$article->featured_image) : 'https://img.freepik.com/premium-psd/abstract-red-yellow-swirl-black_1283787-495.jpg?semt=ais_incoming&w=740&q=80' }}" 
                         class="w-full h-full object-cover transition-soft group-hover:scale-110 product-image" alt="{{ $article->title }}">
                    
                    <div class="absolute inset-0 bg-slate-900/10 group-hover:bg-slate-900/20 transition-soft"></div>
                    
                    <!-- Quick View Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-soft delay-75 pointer-events-none group-hover:pointer-events-auto">
                        <a href="{{ route('articles.show', $article->slug) }}" class="p-6 bg-white rounded-3xl text-slate-900 hover:bg-blue-600 hover:text-white transition-soft shadow-2xl">
                            <i class="fas fa-arrow-right text-xl"></i>
                        </a>
                    </div>
                </div>

                <div class="space-y-4 uppercase tracking-tighter italic">
                    <div class="flex justify-between items-start gap-4">
                        <h3 class="text-3xl font-black text-slate-900 leading-none group-hover:text-blue-600 transition-soft">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                    </div>
                    <div class="flex items-center gap-3 text-slate-400 font-bold text-[10px] tracking-widest border-t border-slate-100 pt-6 not-italic">
                        <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center text-xs">
                            {{ substr($article->user->name, 0, 1) }}
                        </div>
                        {{ $article->user->name }}
                        <span class="text-slate-200">•</span>
                        {{ $article->created_at->format('M d') }}
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-full py-40 text-center uppercase tracking-tighter">
                    <p class="text-3xl font-black text-slate-300">COLLECTION IS EMPTY</p>
                    <a href="{{ route('home') }}" class="inline-block mt-8 text-blue-600 font-black hover:underline px-8 py-3 border-2 border-blue-600 rounded-2xl">Return Home</a>
                </div>
            @endforelse
        </div>
        
        <div class="mt-24">
            {{ $articles->links() }}
        </div>
    </div>
</section>
@endsection
