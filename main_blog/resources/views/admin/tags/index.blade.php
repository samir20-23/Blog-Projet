@extends('layouts.admin')

@section('header', app_term('tags'))

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 uppercase tracking-tighter italic">{{ app_term('tags') }}</h1>
        <p class="text-sm text-slate-500 font-medium">{{ __('Organize your content with descriptive labels.') }}</p>
    </div>
    <a href="{{ route('admin.tags.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-100 transition-all flex items-center gap-2 uppercase tracking-widest text-xs">
        <i class="fas fa-plus"></i>
        {{ app_term('create_new') }}
    </a>
</div>

<div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-black tracking-[0.2em] border-b border-slate-100">
            <tr>
                <th class="px-8 py-5">Tag Name</th>
                <th class="px-8 py-5">Slug</th>
                <th class="px-8 py-5">Usage</th>
                <th class="px-8 py-5 text-right">{{ app_term('actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($tags as $tag)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-8 py-5">
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-slate-100 text-slate-700 rounded-lg text-sm font-bold border border-slate-200">
                        <i class="fas fa-hashtag text-[10px] opacity-40"></i>
                        {{ $tag->name }}
                    </span>
                </td>
                <td class="px-8 py-5 text-sm text-slate-500 font-mono tracking-tighter">{{ $tag->slug }}</td>
                <td class="px-8 py-5">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                        Used in {{ $tag->articles_count ?? 0 }} Articles
                    </span>
                </td>
                <td class="px-8 py-5 text-right">
                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="{{ app_term('edit') }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Are you sure you want to delete this tag?') }}')">
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
                <td colspan="4" class="px-8 py-20 text-center uppercase tracking-tighter">
                    <div class="flex flex-col items-center">
                        <i class="fas fa-tags text-4xl text-slate-100 mb-6"></i>
                        <p class="text-xl font-black text-slate-400 mb-4">NO TAGS FOUND</p>
                        <a href="{{ route('admin.tags.create') }}" class="text-blue-600 font-black hover:underline text-sm uppercase tracking-widest">{{ app_term('create_new') }}</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
