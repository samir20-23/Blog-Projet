@extends('layouts.admin')

@section('header', app_term('create_new') . ' ' . app_term('tag'))

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.tags.index') }}" class="text-slate-500 hover:text-slate-800 flex items-center gap-2 font-bold transition-colors uppercase tracking-widest text-[10px]">
        <i class="fas fa-arrow-left"></i>
        {{ __('Back to List') }}
    </a>
</div>

<div class="max-w-2xl mx-auto">
    <form action="{{ route('admin.tags.store') }}" method="POST" class="space-y-10 bg-white p-12 rounded-[40px] shadow-sm border border-slate-100">
        @csrf

        <div class="space-y-8">
            <div class="uppercase tracking-tighter italic">
                <h2 class="text-2xl font-black text-slate-800 mb-2">{{ app_term('tag') }} {{ __('Label') }}</h2>
                <p class="text-sm font-bold text-slate-400 normal-case tracking-normal not-italic">{{ __('Create a unique label for categorization.') }}</p>
            </div>

            <!-- Name -->
            <div class="space-y-3">
                <label for="name" class="text-[10px] uppercase font-black tracking-[0.2em] text-slate-400 ml-1">{{ __('Tag Name') }}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-300">
                        <i class="fas fa-hashtag"></i>
                    </div>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full pl-12 pr-6 py-5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none text-lg font-bold text-slate-800 placeholder-slate-300" 
                           placeholder="e.g. digital-assets" required autofocus>
                </div>
                @error('name') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
            </div>

            <!-- Slug (Auto-generated or Manual) -->
            <div class="space-y-3 opacity-60">
                <label for="slug" class="text-[10px] uppercase font-black tracking-[0.2em] text-slate-400 ml-1">{{ __('Slug') }} (Optional)</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                       class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-2 focus:ring-blue-400 transition-all outline-none text-sm font-mono tracking-tighter text-slate-500" 
                       placeholder="leave empty for auto-generate">
                @error('slug') <span class="text-xs text-red-500 ml-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="pt-8 border-t border-slate-50 flex justify-end gap-6 uppercase tracking-widest text-xs font-black">
            <a href="{{ route('admin.tags.index') }}" class="px-8 py-3 rounded-2xl text-slate-300 hover:text-slate-800 transition-colors">
                {{ app_term('cancel') }}
            </a>
            <button type="submit" class="px-10 py-4 bg-slate-900 hover:bg-blue-600 text-white rounded-2xl shadow-2xl shadow-slate-200 transition-soft flex items-center gap-3 italic">
                <i class="fas fa-save text-[10px]"></i>
                {{ app_term('save') }} {{ app_term('tag') }}
            </button>
        </div>
    </form>
</div>
@endsection
