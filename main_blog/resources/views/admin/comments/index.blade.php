@extends('layouts.admin')

@section('header', app_term('comments'))

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800 uppercase tracking-tighter italic">{{ app_term('comments') }} {{ __('Moderation') }}</h1>
    <p class="text-sm text-slate-500 font-medium">{{ __('Review and manage your user engagement.') }}</p>
</div>

<div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-black tracking-[0.2em] border-b border-slate-100">
            <tr>
                <th class="px-8 py-5">Author</th>
                <th class="px-8 py-5">Comment Content</th>
                <th class="px-8 py-5">Article</th>
                <th class="px-8 py-5">Status</th>
                <th class="px-8 py-5 text-right">{{ app_term('actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($comments as $comment)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-8 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-sm shadow-sm border border-blue-100/50 uppercase italic">
                            {{ substr($comment->user->name ?? $comment->name ?? '?', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ $comment->user->name ?? $comment->name }}</p>
                            <p class="text-[10px] text-slate-400 font-medium">{{ $comment->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-8 py-5">
                    <p class="text-sm text-slate-600 leading-relaxed max-w-md line-clamp-2" title="{{ $comment->content }}">
                        {{ $comment->content }}
                    </p>
                    <p class="text-[10px] text-slate-300 font-medium mt-1 uppercase tracking-widest">{{ $comment->created_at->diffForHumans() }}</p>
                </td>
                <td class="px-8 py-5">
                    <a href="{{ route('articles.show', $comment->article->slug) }}" target="_blank" class="text-xs font-bold text-blue-600 hover:text-blue-800 hover:underline transition-colors uppercase tracking-widest italic">
                        View Article <i class="fas fa-external-link-alt text-[8px] ml-1"></i>
                    </a>
                </td>
                <td class="px-8 py-5">
                    @php
                        $statusStyles = [
                            'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                            'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                            'spam' => 'bg-rose-50 text-rose-700 border-rose-100',
                        ];
                        $style = $statusStyles[$comment->status] ?? 'bg-slate-50 text-slate-700 border-slate-100';
                    @endphp
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $style }}">
                        {{ $comment->status }}
                    </span>
                </td>
                <td class="px-8 py-5 text-right">
                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        @if($comment->status === 'pending')
                        <form action="#" method="POST" class="inline-block">
                            @csrf @method('PUT')
                            <button type="submit" class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-xl transition-colors" title="Approve">
                                <i class="fas fa-check-circle"></i>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="inline-block" onsubmit="return confirm('{{ __('Are you sure you want to delete this comment?') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl transition-colors" title="{{ app_term('delete') }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-8 py-24 text-center uppercase tracking-tighter italic">
                    <i class="far fa-comments text-4xl text-slate-100 mb-6 block"></i>
                    <p class="text-xl font-black text-slate-300">NO COMMENTS YET</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($comments->hasPages())
    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100">
        {{ $comments->links() }}
    </div>
    @endif
</div>
@endsection