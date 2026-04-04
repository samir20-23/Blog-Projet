@extends('layouts.admin')

@section('header', app_term('dashboard'))

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mr-4">
            <i class="fas fa-newspaper text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">{{ app_term('articles') }}</p>
            <p class="text-2xl font-bold text-slate-800">{{ $stats['articles'] }}</p>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mr-4">
            <i class="fas fa-folder text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">{{ app_term('categories') }}</p>
            <p class="text-2xl font-bold text-slate-800">{{ $stats['categories'] }}</p>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mr-4 relative">
            <i class="fas fa-comments text-xl"></i>
            @if($stats['comments'] > 0)
                <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-white"></span>
            @endif
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">{{ app_term('pending_comments') }}</p>
            <p class="text-2xl font-bold text-slate-800">{{ $stats['comments'] }}</p>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center">
        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mr-4">
            <i class="fas fa-users text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-slate-500">{{ app_term('users') }}</p>
            <p class="text-2xl font-bold text-slate-800">{{ $stats['users'] }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Articles -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">{{ app_term('recent_articles') }}</h3>
            <a href="{{ route('admin.articles.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-semibold">{{ app_term('view_all') }}</a>
        </div>
        <div class="p-0">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-semibold">
                    <tr>
                        <th class="px-6 py-3">Title</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($stats['recent_articles'] as $article)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-800 truncate max-w-xs">{{ $article->title }}</p>
                            <p class="text-xs text-slate-400 capitalize">{{ $article->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-semibold">
                                {{ $article->category->name ?? 'None' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($article->status === 'published')
                                <span class="px-2 py-1 bg-green-50 text-green-600 rounded-lg text-xs font-bold uppercase">Published</span>
                            @else
                                <span class="px-2 py-1 bg-amber-50 text-amber-600 rounded-lg text-xs font-bold uppercase">{{ $article->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-slate-400">No articles found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions / Popular -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-slate-50">
            <h3 class="font-bold text-slate-800">{{ app_term('popular_articles') }}</h3>
        </div>
        <div class="flex-1 p-6 space-y-4">
            @forelse($stats['popular_articles'] as $popular)
            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl hover:bg-slate-100 transition-colors cursor-pointer group">
                <div class="flex items-center overflow-hidden">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3 flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        #{{ $loop->iteration }}
                    </div>
                    <p class="text-sm font-medium text-slate-800 truncate">{{ $popular->title }}</p>
                </div>
                <div class="flex items-center text-slate-400 text-xs">
                    <i class="far fa-eye mr-1"></i>
                    {{ $popular->views }}
                </div>
            </div>
            @empty
            <div class="text-center py-10 text-slate-400">No views data.</div>
            @endforelse

            <div class="pt-6 border-t border-slate-50 mt-auto">
                <h4 class="text-xs font-bold text-slate-400 uppercase mb-4 tracking-wider">Quick Actions</h4>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.articles.create') }}" class="flex items-center justify-center gap-2 p-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-shadow shadow-md font-semibold text-sm">
                        <i class="fas fa-plus"></i> {{ app_term('new_article') }}
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="flex items-center justify-center gap-2 p-3 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 transition-colors font-semibold text-sm">
                        <i class="fas fa-folder-plus"></i> {{ app_term('new_category') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
