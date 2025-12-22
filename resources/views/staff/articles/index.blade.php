@extends('layouts.medium')

@section('title', 'Artikel Saya')

@section('content')
    <a href="{{ route('staff.articles.create') }}" class="btn" style="margin-bottom:20px;">+ Tulis Artikel Baru</a>

    @forelse($articles as $article)
        <article>
            <h2>{{ $article->title }}</h2>

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

            <div style="margin-top:10px;">
                <a href="{{ route('staff.articles.edit', $article) }}" class="btn" style="background:#007bff; color:white; text-decoration:none; padding:5px 10px; border-radius:4px; font-size:0.9rem;">Edit</a>

                <form method="POST" action="{{ route('staff.articles.destroy', $article) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn" style="background:#dc3545; color:white; border:none; padding:5px 10px; border-radius:4px; font-size:0.9rem;" onclick="return confirm('Hapus artikel?')">Delete</button>
                </form>
            </div>
        </article>
    @empty
        <p>Tidak ada artikel.</p>
    @endforelse

    {{ $articles->links() }}
@endsection
