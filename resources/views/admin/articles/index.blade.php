@extends('layouts.admin')

@section('title', 'Daftar Artikel')

@section('content')

<div style="max-width:800px;margin:0 auto;font-family:Georgia, serif;">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;">
        <h1 style="font-size:32px;">Daftar Artikel</h1>

        <a href="{{ route('admin.articles.create') }}"
           style="background:#1a8917;color:#fff;padding:8px 16px;border-radius:20px;text-decoration:none;">
            + Buat Artikel Baru
        </a>
    </div>

    @forelse ($articles as $article)
        <article style="border-bottom:1px solid #eee;padding:20px 0;">

            {{-- GAMBAR --}}
            @if ($article->image)
                <img src="{{ asset('storage/' . $article->image) }}"
                     alt="{{ $article->title }}"
                     style="width:100%;max-height:240px;object-fit:cover;border-radius:12px;margin-bottom:15px;">
            @endif

            <h2>
                <a href="{{ route('admin.articles.show', $article->id) }}"
                   style="color:#242424;text-decoration:none;">
                    {{ $article->title }}
                </a>
            </h2>

            <p style="color:#555;">
                {{ Str::limit(strip_tags($article->content), 150) }}
            </p>

            <small style="color:#777;">
                {{ $article->created_at->format('d M Y') }}
                •
                {{ ucfirst($article->status) }}
            </small>

        </article>
    @empty
        <p>Tidak ada artikel.</p>
    @endforelse

    {{ $articles->links() }}

</div>
@endsection
