@extends('layouts.admin')

@section('header', app_term('edit') . ' ' . app_term('article') . ': ' . $article->title)

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.articles.index') }}" class="text-slate-500 hover:text-slate-800 flex items-center gap-2 font-medium transition-colors">
        <i class="fas fa-arrow-left text-xs"></i>
        {{ __('Back to List') }}
    </a>
</div>

<form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    @method('PUT')
    
    <!-- Main Content Area -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 space-y-6">
            <h2 class="text-xl font-bold text-slate-800 mb-4">{{ app_term('article') }} {{ __('Content') }}</h2>
            
            <!-- Title -->
            <div class="space-y-2">
                <label for="title" class="text-sm font-semibold text-slate-700">{{ __('Title') }}</label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" 
                       class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none text-lg font-bold" 
                       placeholder="e.g. 10 Best Productivity Apps of 2024" required>
                @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Excerpt -->
            <div class="space-y-2">
                <label for="excerpt" class="text-sm font-semibold text-slate-700">{{ __('Excerpt') }} (Brief Summary)</label>
                <textarea name="excerpt" id="excerpt" rows="3" 
                          class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                          placeholder="A short summary of the article for listings...">{{ old('excerpt', $article->excerpt) }}</textarea>
                @error('excerpt') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Content -->
            <div class="space-y-2">
                <label for="content" class="text-sm font-semibold text-slate-700">{{ __('Full Content') }}</label>
                <textarea name="content" id="content" rows="12" 
                          class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                          placeholder="Start writing your masterpiece here...">{{ old('content', $article->content) }}</textarea>
                @error('content') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- SEO Metadata -->
        <div x-data="{ expanded: false }" class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <button type="button" @click="expanded = !expanded" class="w-full px-8 py-6 flex items-center justify-between text-left hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-search text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800">SEO Settings</h3>
                        <p class="text-xs text-slate-500 font-medium">Optimize how this article appears in search engines.</p>
                    </div>
                </div>
                <i class="fas fa-chevron-down text-slate-400 transition-transform duration-300" :class="{'rotate-180': expanded}"></i>
            </button>
            
            <div x-show="expanded" x-cloak class="p-8 border-t border-slate-50 space-y-6">
                <div class="space-y-2">
                    <label for="seo_title" class="text-sm font-semibold text-slate-700">{{ __('SEO Title') }}</label>
                    <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $article->seo_title) }}" 
                           class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" 
                           placeholder="Defaults to article title if empty">
                </div>

                <div class="space-y-2">
                    <label for="seo_description" class="text-sm font-semibold text-slate-700">{{ __('SEO Description') }}</label>
                    <textarea name="seo_description" id="seo_description" rows="3" 
                              class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                              placeholder="Defaults to excerpt if empty">{{ old('seo_description', $article->seo_description) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar / Publish Settings -->
    <div class="space-y-8">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 space-y-6">
            <h3 class="font-bold text-slate-800 border-b border-slate-50 pb-4">{{ __('Publishing') }}</h3>
            
            <!-- Status -->
            <div class="space-y-2">
                <label for="status" class="text-sm font-semibold text-slate-700">{{ __('Status') }}</label>
                <select name="status" id="status" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none appearance-none">
                    <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <!-- Published At -->
            <div class="space-y-2">
                <label for="published_at" class="text-sm font-semibold text-slate-700">{{ __('Publish Date') }}</label>
                <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}" 
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
            </div>

            <!-- Featured Flag -->
            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                <label for="is_featured" class="text-sm font-bold text-slate-700">{{ __('Feature Article') }}</label>
                <div x-data="{ checked: {{ old('is_featured', $article->is_featured) ? 'true' : 'false' }} }" class="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" x-model="checked" class="hidden">
                    <div @click="checked = !checked" class="w-12 h-6 rounded-full cursor-pointer transition-colors" :class="checked ? 'bg-blue-600' : 'bg-slate-300'"></div>
                    <div @click="checked = !checked" class="absolute left-1 top-1 w-4 h-4 rounded-full bg-white transition-transform cursor-pointer" :class="checked ? 'translate-x-6' : 'translate-x-0'"></div>
                </div>
            </div>

            <button type="submit" class="w-full px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-extrabold shadow-lg shadow-blue-100 transition-all flex items-center justify-center gap-3">
                <i class="fas fa-save text-sm"></i>
                {{ __('Update Article') }}
            </button>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 space-y-6">
            <h3 class="font-bold text-slate-800 border-b border-slate-50 pb-4">Classification</h3>

            <!-- Category -->
            <div class="space-y-2">
                <label for="category_id" class="text-sm font-semibold text-slate-700">{{ app_term('category') }}</label>
                <select name="category_id" id="category_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
                    <option value="">{{ __('Select Category') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Featured Image -->
            <div class="space-y-2">
                <label for="featured_image" class="text-sm font-semibold text-slate-700">{{ __('Featured Image') }}</label>
                @if($article->featured_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/'.$article->featured_image) }}" class="w-full h-32 rounded-2xl object-cover shadow-sm">
                    </div>
                @endif
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl hover:border-blue-400 transition-colors cursor-pointer bg-slate-50 hover:bg-blue-50 group">
                    <div class="space-y-1 text-center">
                        <i class="fas fa-image text-2xl text-slate-300 group-hover:text-blue-500 mb-2 transition-colors"></i>
                        <div class="flex text-sm text-slate-600">
                            <label for="featured_image" class="relative cursor-pointer font-bold text-blue-600 hover:text-blue-500">
                                <span>{{ $article->featured_image ? 'Change file' : 'Upload a file' }}</span>
                                <input id="featured_image" name="featured_image" type="file" class="sr-only">
                            </label>
                        </div>
                        <p class="text-xs text-slate-400 font-medium">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
