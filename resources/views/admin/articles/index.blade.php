    @extends('layouts.admin')

    @section('title', 'Daftar Artikel')

    @section('content')

    <div style="max-width:800px; margin:0 auto; font-family:Georgia, serif;">

        <!-- Header -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <h1 style="font-size:32px;">Daftar Artikel</h1>

            <a href="{{ route('admin.articles.create') }}"
            style="
                background:#1a8917;
                color:#fff;
                padding:8px 16px;
                border-radius:20px;
                text-decoration:none;
                font-size:14px;
            ">
                + Buat Artikel Baru
            </a>
        </div>

        <!-- List Artikel -->
        @forelse ($articles as $article)
            <article style="border-bottom:1px solid #eee; padding:20px 0;">

                <!-- Judul -->
                <h2 style="margin-bottom:8px;">
                    <a href="{{ route('admin.articles.show', $article->id) }}"
                    style="color:#242424; text-decoration:none;">
                        {{ $article->title }}
                    </a>
                </h2>

                <!-- Excerpt -->
                <p style="color:#555; line-height:1.6; margin-bottom:10px;">
                    {{ Str::limit(strip_tags($article->content), 150) }}
                </p>

                <!-- Meta -->
                <div style="font-size:13px; color:#777;">
                    {{ $article->created_at->format('d M Y') }}
                    &nbsp;•&nbsp;
                    Status:
                    @if ($article->status === 'published')
                        <span style="color:#1a8917; font-weight:bold;">Published</span>
                    @else
                        <span style="color:#999;">Draft</span>
                    @endif
                </div>

            </article>
        @empty
            <p style="color:#999;">Tidak ada artikel.</p>
        @endforelse

        <!-- Pagination -->
        <div style="margin-top:30px;">
            {{ $articles->links() }}
        </div>

    </div>

    @endsection
