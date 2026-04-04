@extends('layouts.visitor')

@section('title', $article->seo_title ?? $article->title)

@section('content')
<article class="pt-24 pb-24 border-b border-slate-100 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto space-y-16">
            <!-- Header -->
            <header class="text-center space-y-10 uppercase tracking-tighter italic">
                <div class="flex items-center justify-center gap-4 text-xs font-black text-blue-600 tracking-widest leading-none">
                    <a href="{{ route('articles.category', $article->category->slug) }}" class="hover:underline transition-all">
                        {{ $article->category->name ?? 'Uncategorized' }}
                    </a>
                    <span class="w-1.5 h-1.5 bg-slate-200 rounded-full"></span>
                    <span>{{ $article->created_at->format('M d, Y') }}</span>
                    <span class="w-1.5 h-1.5 bg-slate-200 rounded-full"></span>
                    <span>{{ number_format($article->views) }} Views</span>
                </div>

                <h1 class="text-5xl md:text-8xl font-black text-slate-900 leading-[0.9] tracking-tighter">
                    {{ $article->title }}
                </h1>

                @if($article->excerpt)
                <p class="text-xl text-slate-500 font-medium normal-case tracking-normal leading-relaxed max-w-2xl mx-auto not-italic">
                    {{ $article->excerpt }}
                </p>
                @endif

                <div class="flex items-center justify-center gap-4 pt-4 border-t border-slate-50 inline-flex mx-auto">
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 font-bold overflow-hidden border border-slate-200">
                        @if($article->user->profile && $article->user->profile->avatar)
                            <img src="{{ asset('storage/'.$article->user->profile->avatar) }}" class="w-full h-full object-cover">
                        @else
                            {{ substr($article->user->name, 0, 1) }}
                        @endif
                    </div>
                    <div class="text-left not-italic tracking-normal normal-case">
                        <p class="font-bold text-slate-900 text-sm leading-none mb-1">{{ $article->user->name }}</p>
                        <p class="text-[10px] uppercase font-black tracking-widest text-slate-400">Content Architect</p>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($article->featured_image)
            <div class="rounded-[40px] overflow-hidden aspect-[16/9] shadow-2xl shadow-slate-200/50">
                <img src="{{ asset('storage/'.$article->featured_image) }}" class="w-full h-full object-cover" alt="{{ $article->title }}">
            </div>
            @endif

            <!-- Content -->
            <div class="prose prose-slate prose-lg max-w-none prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tighter prose-p:leading-relaxed prose-p:text-slate-600 prose-strong:text-slate-900 prose-img:rounded-3xl shadow-none border-none">
                {!! nl2br(e($article->content)) !!}
            </div>

            <!-- Tags -->
            @if($article->tags->count() > 0)
            <div class="pt-12 border-t border-slate-50 flex flex-wrap gap-3 uppercase tracking-tighter italic">
                @foreach($article->tags as $tag)
                    <span class="px-6 py-3 bg-slate-50 text-slate-500 rounded-2xl text-[10px] font-black border border-slate-100 transition-colors hover:border-blue-400 hover:text-blue-600 cursor-pointer">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</article>

<!-- Comments Section -->
<section class="py-24 bg-slate-50 uppercase tracking-tighter">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-extrabold italic text-slate-900 mb-16">{{ app_term('comments') }} ({{ $article->comments->count() }})</h2>

            <!-- Comment Form -->
            <div class="bg-white p-10 rounded-[32px] shadow-sm border border-slate-100 mb-16 normal-case tracking-normal not-italic">
                <h3 class="text-xl font-bold text-slate-800 mb-6 uppercase tracking-tighter italic">Join the discussion</h3>
                <form action="{{ route('comments.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    
                    @guest
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Your Name</label>
                            <input type="text" name="name" id="name" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
                        </div>
                        <div class="space-y-2">
                            <label for="email" class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Your Email</label>
                            <input type="email" name="email" id="email" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
                        </div>
                    </div>
                    @endguest

                    <div class="space-y-2">
                        <label for="content" class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Message</label>
                        <textarea name="content" id="content" rows="6" required 
                                  class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all outline-none overflow-hidden resize-none"
                                  placeholder="What are your thoughts on this?"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-xl font-black text-sm uppercase tracking-widest shadow-xl shadow-blue-500/20 hover:bg-blue-700 transition-soft flex items-center gap-3">
                        Submit Comment
                    </button>
                </form>
            </div>

            <!-- Comments List -->
            <div class="space-y-10 normal-case tracking-normal not-italic">
                @forelse($article->comments->where('status', 'approved') as $comment)
                <div class="flex gap-6 pb-10 border-b border-slate-100 last:border-0 group">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl flex-shrink-0 shadow-lg shadow-blue-200/20">
                        {{ substr($comment->name ?? $comment->user->name, 0, 1) }}
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-4">
                            <h4 class="font-bold text-slate-900">{{ $comment->name ?? $comment->user->name }}</h4>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-slate-600 leading-relaxed max-w-2xl">{{ $comment->content }}</p>
                        <button class="text-xs font-black uppercase tracking-widest text-blue-600 hover:text-blue-800 transition-colors opacity-0 group-hover:opacity-100 transition-soft">
                            Reply
                        </button>
                    </div>
                </div>
                @empty
                    <div class="text-center py-10 uppercase tracking-tighter">
                        <p class="text-lg font-black text-slate-300">BE THE FIRST TO COMMENT</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Related Articles -->
@if($relatedArticles->count() > 0)
<section class="py-24 bg-white uppercase tracking-tighter italic">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-extrabold text-slate-900 mb-16 text-center leading-none">Related <br> <span class="text-blue-600">Discoveries</span></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @foreach($relatedArticles as $related)
            <a href="{{ route('articles.show', $related->slug) }}" class="group block space-y-6">
                <div class="relative aspect-video rounded-[32px] overflow-hidden shadow-xl shadow-slate-200/50">
                    <img src="{{ $related->featured_image ? asset('storage/'.$related->featured_image) : 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&q=80' }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-soft">
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 group-hover:text-blue-600 transition-soft line-clamp-2 leading-tight">
                        {{ $related->title }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
