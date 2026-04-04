@extends('layouts.admin')

@section('header', app_term('create_new') . ' ' . app_term('category'))

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.categories.index') }}" class="text-slate-500 hover:text-slate-800 flex items-center gap-2 font-medium transition-colors">
        <i class="fas fa-arrow-left text-xs"></i>
        {{ __('Back to List') }}
    </a>
</div>

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        @csrf

        <div class="space-y-6">
            <div>
                <h2 class="text-xl font-bold text-slate-800">{{ app_term('category') }} {{ __('Details') }}</h2>
                <p class="text-sm text-slate-500">{{ __('Define the name and hierarchy of this classification.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold text-slate-700">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" 
                           placeholder="e.g. Technology" required>
                    @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Slug -->
                <div class="space-y-2">
                    <label for="slug" class="text-sm font-semibold text-slate-700">{{ __('Slug') }} (Optional)</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" 
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" 
                           placeholder="technology">
                    @error('slug') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Parent Category -->
            <div class="space-y-2">
                <label for="parent_id" class="text-sm font-semibold text-slate-700">{{ __('Parent Category') }}</label>
                <select name="parent_id" id="parent_id" 
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none appearance-none">
                    <option value="">{{ __('None (Top Level)') }}</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="text-sm font-semibold text-slate-700">{{ __('Description') }}</label>
                <textarea name="description" id="description" rows="4" 
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                          placeholder="What is this category about?">{{ old('description') }}</textarea>
                @error('description') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Status -->
                <div class="space-y-2">
                    <label for="status" class="text-sm font-semibold text-slate-700">{{ __('Status') }}</label>
                    <div class="flex items-center gap-4 py-2">
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="status" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }} class="hidden">
                            <span class="w-5 h-5 border-2 border-slate-200 rounded-full flex items-center justify-center mr-2 group-hover:border-blue-300 transition-colors">
                                <span class="w-2 h-2 bg-blue-600 rounded-full scale-0 transition-transform duration-200"></span>
                            </span>
                            <span class="text-sm font-medium text-slate-600">Active</span>
                        </label>
                        <label class="flex items-center cursor-pointer group">
                            <input type="radio" name="status" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }} class="hidden">
                            <span class="w-5 h-5 border-2 border-slate-200 rounded-full flex items-center justify-center mr-2 group-hover:border-blue-300 transition-colors">
                                <span class="w-2 h-2 bg-blue-600 rounded-full scale-0 transition-transform duration-200"></span>
                            </span>
                            <span class="text-sm font-medium text-slate-600">Inactive</span>
                        </label>
                    </div>
                </div>

                <!-- Image -->
                <div class="space-y-2">
                    <label for="image" class="text-sm font-semibold text-slate-700">{{ __('Category Image') }}</label>
                    <input type="file" name="image" id="image" class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                </div>
            </div>
        </div>

        <style>
            input[type="radio"]:checked + span span { scale: 1 !important; }
            input[type="radio"]:checked + span { border-color: #2563eb !important; }
        </style>

        <div class="pt-6 border-t border-slate-50 flex justify-end gap-4">
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 transition-colors">
                {{ app_term('cancel') }}
            </a>
            <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-lg shadow-blue-100 transition-all flex items-center gap-2">
                <i class="fas fa-save text-xs"></i>
                {{ app_term('save') }} {{ app_term('category') }}
            </button>
        </div>
    </form>
</div>
@endsection
