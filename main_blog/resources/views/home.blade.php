@extends('layouts.visitor')

@section('content')
<div class="relative overflow-hidden bg-slate-50 border-b border-slate-200">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    <div class="container mx-auto px-6 py-24 md:py-32 flex flex-col items-center text-center relative z-10">
        <span class="px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-extrabold rounded-full uppercase tracking-widest mb-8 animate-fade-in-up">Latest Insights</span>
        <h1 class="text-6xl md:text-8xl font-black text-slate-900 mb-8 tracking-tighter sm:leading-[1.1]">The Blog Projet <br><span class="text-blue-600">Experience</span></h1>
        <p class="max-w-2xl text-xl text-slate-500 font-medium leading-relaxed mb-12">Elegant thoughts perfectly architected for the modern web. Dive into a collection of curated articles, case studies, and deep dives.</p>
        <div class="flex gap-4">
            <a href="#articles" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-4 rounded-2xl shadow-2xl shadow-blue-200 transition-all transform hover:-translate-y-1">Start Reading</a>
            <a href="#" class="bg-white border text-slate-700 hover:bg-slate-50 font-bold px-10 py-4 rounded-2xl transition-all shadow-sm">About Us</a>
        </div>
    </div>
</div>

<div id="articles" class="container mx-auto px-6 py-16">
    <div class="flex items-end justify-between mb-12">
        <div>
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight mb-2">Editor's Picks</h2>
            <div class="h-1.5 w-20 bg-blue-600 rounded-full"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @foreach($articles as $article)
        <div class="group bg-white rounded-[2rem] shadow-xl shadow-slate-200 border border-slate-100 hover:border-blue-200 transition-all hover:shadow-2xl duration-500 overflow-hidden flex flex-col h-full relative">
            <div class="p-8 pb-4 relative">
                <div class="flex items-center justify-between mb-6">
                    @if($article->category)
                    <span class="bg-slate-100 group-hover:bg-blue-50 group-hover:text-blue-600 text-slate-500 text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-tighter transition-colors">{{ $article->category->name }}</span>
                    @endif
                    <span class="text-slate-400 text-xs font-bold">{{ $article->created_at->diffForHumans() }}</span>
                </div>
                <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-blue-600 transition-colors leading-tight">
                    <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                </h3>
                <p class="text-slate-500 text-base leading-relaxed mb-8 flex-grow">
                    {{ Str::limit($article->content, 140) }}
                </p>
            </div>
            <div class="px-8 pb-8 mt-auto flex items-center justify-between border-t border-slate-50 pt-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-slate-200 to-slate-300 rounded-full flex items-center justify-center font-bold text-slate-500 shadow-inner">
                        {{ substr($article->user->name ?? 'A', 0, 1) }}
                    </div>
                    <span class="text-sm font-bold text-slate-600">{{ $article->user->name ?? 'Admin' }}</span>
                </div>
                <a href="{{ route('articles.show', $article) }}" class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
        
        @if($articles->isEmpty())
        <div class="col-span-full py-32 text-center">
            <div class="bg-white rounded-3xl p-16 shadow-inner border-2 border-dashed border-slate-100 max-w-md mx-auto">
                <i class="fas fa-box-open text-6xl text-slate-200 mb-6 block"></i>
                <h3 class="text-2xl font-bold text-slate-400">No articles yet.</h3>
                <p class="text-slate-300 mt-2">Come back later for amazing stories.</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection