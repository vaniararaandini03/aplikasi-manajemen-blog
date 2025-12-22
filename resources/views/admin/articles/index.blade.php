@extends('layouts.medium')

@section('title', 'Daftar Artikel')

@section('content')
    <a href="{{ route(request()->route()->getPrefix() . '.articles.create') }}" class="btn" style="margin-bottom:20px;">+ Buat Artikel Baru</a>

    @forelse($articles as $article)
        <article>
            <h2><a href="{{ route(request()->route()->getPrefix() . '.articles.show', $article->id) }}" style="color:#00ab6b; text-decoration:none;">
                {{ $article->title }}
            </a></h2>

            <p class="excerpt">{{ Str::limit(strip_tags($article->content), 150) }}</p>

            <div class="meta">
                {{ $article->created_at->format('d M Y') }}
                | Status:
                @if($article->status == 'published')
                    <span style="color:#00ab6b;">Published</span>
                @else
                    <span style="color:#999;">Draft</span>
                @endif
            </div>
        </article>
    @empty
        <p>Tidak ada artikel.</p>
    @endforelse

    {{ $articles->links() }}
@endsection
