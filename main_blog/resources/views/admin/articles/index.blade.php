@extends('layouts.admin')

@section('header', app_term('articles'))

@section('content')
@php
$articleImages = [
    'https://thumb.r2.moele.me/t/29364/29354926/a-0120.jpg',    // Tailwind CSS
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs0hz095PpqP23iVmUSB3Wbdqkjtz3f7LOQQ&s',         // CMS
    'https://images.rawpixel.com/dark_image_png_social_square/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDI0LTEwL3RwNTQ5LWVsZW1lbnQtc2ktNDgtcC5wbmc.png',  // Minimalism
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrUdQoWRir1X-p-gcM3_ItgkMxOIEeAEfaSg&s',     // Laravel
    'https://www.shutterstock.com/shutterstock/videos/3992980503/thumb/1.jpg?ip=x480',          // AI
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE-UC8GqcIwlw_2vEm_vnygUpHsV9IGKx_Qg&s',    // Business
];
@endphp
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">{{ app_term('articles') }}</h1>
        <p class="text-sm text-slate-500">{{ __('Manage your content and publications.') }}</p>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all flex items-center gap-2">
        <i class="fas fa-plus text-xs"></i>
        {{ app_term('create_new') }}
    </a>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                <th class="px-6 py-4">{{ __('Article') }}</th>
                <th class="px-6 py-4">{{ __('Category') }}</th>
                <th class="px-6 py-4">{{ __('Status') }}</th>
                <th class="px-6 py-4">{{ __('Views') }}</th>
                <th class="px-6 py-4 text-right">{{ app_term('actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($articles as $article)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                       @if($article->featured_image)
    <img src="{{ asset('storage/'.$article->featured_image) }}" class="w-12 h-12 rounded-xl object-cover mr-4 shadow-sm border border-slate-100">
@else
    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mr-4 overflow-hidden">
        <img src="{{ $articleImages[array_rand($articleImages)] }}" alt="aura" class="w-full h-full object-cover">
    </div>
@endif
                        <div class="max-w-xs overflow-hidden">
                            <p class="font-bold text-slate-800 truncate" title="{{ $article->title }}">{{ $article->title }}</p>
                            <p class="text-xs text-slate-400 font-mono">{{ $article->slug }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold">
                        {{ $article->category->name ?? 'Uncategorized' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @php
                        $statusClasses = [
                            'published' => 'bg-green-100 text-green-700',
                            'draft' => 'bg-slate-100 text-slate-700',
                            'archived' => 'bg-red-100 text-red-700',
                        ];
                        $class = $statusClasses[$article->status] ?? 'bg-slate-100 text-slate-700';
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $class }}">
                        {{ ucfirst($article->status) }}
                    </span>
                    @if($article->is_featured)
                        <span class="ml-1 text-amber-500" title="Featured">
                            <i class="fas fa-star text-[10px]"></i>
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm text-slate-500">
                    <div class="flex items-center">
                        <i class="far fa-eye mr-2 opacity-50"></i>
                        {{ number_format($article->views) }}
                    </div>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="{{ app_term('edit') }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Are you sure you want to delete this article?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="{{ app_term('delete') }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-20 text-center text-slate-400">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-newspaper text-2xl"></i>
                        </div>
                        <p class="font-medium text-slate-600 mb-1">{{ __('No articles yet.') }}</p>
                        <p class="text-sm mb-4">{{ __('Start your journey by creating your first publication.') }}</p>
                        <a href="{{ route('admin.articles.create') }}" class="text-blue-600 font-bold hover:underline text-sm">{{ app_term('create_new') }}</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($articles->hasPages())
    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
        {{ $articles->links() }}
    </div>
    @endif
</div>
@endsection
