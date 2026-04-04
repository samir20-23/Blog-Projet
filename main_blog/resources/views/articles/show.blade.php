@extends('layouts.visitor')

@section('content')
<div class="container mx-auto px-6 py-12 max-w-5xl">
    <div class="mb-12">
        <a href="{{ route('articles.home') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-blue-600 font-bold transition-all group">
            <div class="w-10 h-10 rounded-full bg-white shadow-sm border flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                <i class="fas fa-arrow-left"></i>
            </div>
            <span>Back to Stories</span>
        </a>
    </div>

    <article class="bg-white rounded-[3rem] shadow-2xl shadow-slate-100 overflow-hidden border border-slate-50 relative">
        <div class="p-12 md:p-20">
            <div class="flex flex-wrap items-center gap-4 mb-8">
                @if($article->category)
                <span class="px-6 py-2 bg-blue-50 text-blue-600 text-xs font-black rounded-full uppercase lg:tracking-widest">{{ $article->category->name }}</span>
                @endif
                <div class="flex items-center gap-4 text-slate-400 text-sm font-bold ml-auto sm:ml-0">
                    <span class="flex items-center gap-2"><i class="far fa-calendar-alt text-blue-400"></i>{{ $article->created_at->format('M d, Y') }}</span>
                    <span class="flex items-center gap-2"><i class="far fa-clock text-blue-400"></i>5 min read</span>
                </div>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-slate-900 mb-12 tracking-tighter leading-tight">{{ $article->title }}</h1>

            <div class="flex items-center gap-6 p-6 bg-slate-50 rounded-3xl mb-16 border border-slate-100">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-black shadow-lg">
                    {{ substr($article->user->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <span class="text-slate-400 text-xs font-black uppercase tracking-widest block mb-1">Author / Storyteller</span>
                    <h4 class="text-xl font-bold text-slate-900">{{ $article->user->name ?? 'Admin User' }}</h4>
                </div>
            </div>

            <div class="prose prose-xl max-w-none text-slate-700 font-medium leading-[1.8] space-y-8">
                {!! nl2br(e($article->content)) !!}
            </div>

            @if($article->tag)
            <div class="mt-20 pt-10 border-t border-slate-100 flex flex-wrap gap-3">
                <span class="px-5 py-2.5 bg-slate-900 text-white rounded-2xl text-sm font-black flex items-center gap-2 transition-all hover:-translate-y-1 shadow-lg shadow-slate-200">
                    <i class="fas fa-hashtag text-slate-400"></i>
                    {{ $article->tag->name }}
                </span>
            </div>
            @endif
        </div>
    </article>

    <section class="mt-24 max-w-3xl mx-auto">
        <h3 class="text-4xl font-black text-slate-900 mb-12 tracking-tight flex items-baseline gap-4">
            Comments
            <span class="text-blue-600 text-xl font-black bg-blue-50 px-4 py-1 rounded-2xl">{{ $article->comments->count() }}</span>
        </h3>

        <div class="space-y-8 mb-16">
            @foreach($article->comments as $comment)
            <div class="flex gap-6 items-start group">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-black text-xl shadow-sm flex-shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                    {{ substr($comment->user->name ?? 'A', 0, 1) }}
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-100 border border-slate-50 flex-grow relative transition-all duration-300 hover:shadow-2xl hover:border-indigo-100">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-black text-slate-900 border-b-2 border-transparent group-hover:border-indigo-600 transition-all">{{ $comment->user->name ?? 'Unknown User' }}</h4>
                        <span class="text-xs text-slate-300 font-bold uppercase tracking-widest">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-slate-600 font-medium leading-relaxed italic">"{{ $comment->content }}"</p>
                </div>
            </div>
            @endforeach

            @if($article->comments->isEmpty())
            <div class="text-center py-20 bg-white rounded-[2rem] border-2 border-dashed border-slate-100">
                <p class="text-slate-400 font-black text-xl">Be the first to share your thoughts!</p>
            </div>
            @endif
        </div>

        <div class="bg-slate-900 p-10 md:p-16 rounded-[3rem] shadow-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-8 opacity-10 transform group-hover:scale-110 transition-all duration-1000">
                <i class="fas fa-quote-right text-[10rem] text-white"></i>
            </div>
            
            <div class="relative z-10">
                <h4 class="text-3xl font-black text-white mb-4 tracking-tight">Join the conversation.</h4>
                <p class="text-slate-400 font-medium mb-10">Your feedback helps our storytellers grow.</p>
                
                @auth
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <div class="mb-8">
                        <textarea name="content" rows="5" class="w-full p-8 bg-slate-800 border-none rounded-3xl focus:ring-4 focus:ring-blue-600/50 text-white placeholder-slate-500 font-medium transition-all shadow-inner outline-none" required placeholder="What's on your mind?"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white font-black px-12 py-5 rounded-2xl shadow-2xl shadow-blue-900 hover:bg-blue-700 transition-all transform hover:-translate-y-1">Send Comment</button>
                </form>
                @else
                <div class="text-center py-10 bg-slate-800 rounded-[2rem] border border-slate-700">
                    <p class="text-slate-300 font-bold text-lg mb-8 uppercase tracking-widest underline decoration-blue-600 decoration-4">Authorization required</p>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white font-black px-12 py-4 rounded-xl shadow-xl hover:bg-blue-700 transition-all transform hover:scale-105 inline-block">Login to Comment</a>
                </div>
                @endauth
            </div>
        </div>
    </section>
</div>
@endsection
