@extends('layouts.admin')

@section('header', app_term('categories'))

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">{{ app_term('categories') }}</h1>
        <p class="text-sm text-slate-500">{{ __('Manage your content classifications.') }}</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition-all flex items-center gap-2">
        <i class="fas fa-plus text-xs"></i>
        {{ app_term('create_new') }}
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 text-slate-500 text-xs uppercase font-bold tracking-wider">
                <th class="px-6 py-4">{{ __('Name') }}</th>
                <th class="px-6 py-4">{{ __('Slug') }}</th>
                <th class="px-6 py-4">{{ __('Articles') }}</th>
                <th class="px-6 py-4">{{ __('Status') }}</th>
                <th class="px-6 py-4 text-right">{{ app_term('actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($categories as $category)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}" class="w-10 h-10 rounded-lg object-cover mr-3 shadow-sm">
                        @else
                            <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 mr-3">
                                <i class="fas fa-folder"></i>
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold text-slate-800">{{ $category->name }}</p>
                            @if($category->parent_id)
                                <span class="text-xs text-slate-400">Sub-category of {{ $category->parent->name }}</span>
                            @endif
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-slate-500 font-mono">{{ $category->slug }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-bold">
                        {{ $category->articles_count }} {{ app_term('articles') }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($category->status === 'active')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ __('Active') }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                            {{ __('Inactive') }}
                        </span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="{{ app_term('edit') }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Are you sure you want to delete this category?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="{{ app_term('delete') }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                    <i class="fas fa-folder-open text-4xl mb-4 block"></i>
                    {{ __('No categories found. Start by creating one!') }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
