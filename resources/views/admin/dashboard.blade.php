@extends('layouts.admin')

@section('content')

<h2 style="font-size:28px;margin-bottom:25px;color:#242424;">
    Dashboard Admin
</h2>

<!-- STATISTIK -->
<div style="
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:40px;
">
    <div style="background:#f9fafb;border:1px solid #e5e7eb;padding:20px;border-radius:12px;">
        <small style="color:#6b7280;">Total Artikel</small>
        <h2 style="margin-top:10px;">{{ $totalArticles }}</h2>
    </div>

    <div style="background:#ecfdf5;border:1px solid #bbf7d0;padding:20px;border-radius:12px;">
        <small style="color:#065f46;">Published</small>
        <h2 style="margin-top:10px;color:#16a34a;">{{ $published }}</h2>
    </div>

    <div style="background:#f8fafc;border:1px solid #e5e7eb;padding:20px;border-radius:12px;">
        <small style="color:#6b7280;">Draft</small>
        <h2 style="margin-top:10px;color:#64748b;">{{ $draft }}</h2>
    </div>

    <div style="background:#eff6ff;border:1px solid #bfdbfe;padding:20px;border-radius:12px;">
        <small style="color:#1e40af;">Total Users</small>
        <h2 style="margin-top:10px;color:#2563eb;">{{ $totalUsers }}</h2>
    </div>
</div>

<!-- ARTIKEL TERBARU -->
<h3 style="margin-bottom:15px;color:#242424;">
    Artikel Terbaru
</h3>

@if($latestArticles->isEmpty())
    <p style="color:#777;">Belum ada artikel.</p>
@else
    <div style="max-width:700px;">
        @foreach($latestArticles as $article)
            <div style="
                padding:15px 0;
                border-bottom:1px solid #e5e7eb;
            ">
                <a href="{{ route('admin.articles.show', $article->id) }}"
                   style="
                   font-size:18px;
                   font-weight:600;
                   color:#1a8917;
                   text-decoration:none;
                   ">
                    {{ $article->title }}
                </a>

                <div style="margin-top:6px;font-size:13px;color:#6b7280;">
                    {{ $article->created_at->format('d M Y') }}
                    •
                    @if($article->status === 'published')
                        <span style="color:#16a34a;font-weight:600;">Published</span>
                    @else
                        <span style="color:#64748b;">Draft</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
