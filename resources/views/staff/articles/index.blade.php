@extends('layouts.staff')

@section('title', 'Artikel Saya')

@section('content')
<div style="max-width:1200px;margin:0 auto;font-family:Inter,Arial,sans-serif;">

    <!-- Header -->
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;">
        <div>
            <h1 style="font-size:28px;margin:0 0 5px 0;color:#242424;">Artikel Saya</h1>
            <p style="margin:0;color:#6b7280;">Kelola artikel yang Anda buat</p>
        </div>
        <a href="{{ route('staff.articles.create') }}"
           style="background:#1a8917;color:#fff;padding:12px 24px;border:none;border-radius:25px;text-decoration:none;font-weight:500;display:flex;align-items:center;gap:8px;">
            ✍️ Tulis Artikel Baru
        </a>
    </div>

    <!-- Articles Grid -->
    @forelse($articles as $article)
        <div style="background:#fff;border-radius:16px;padding:24px;margin-bottom:20px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #f1f5f9;">

            <!-- Article Header -->
            <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;">
                <div style="flex:1;">
                    <h2 style="font-size:20px;font-weight:600;margin:0 0 8px 0;color:#1e293b;">
                        <a href="{{ route('staff.articles.show', $article) }}"
                           style="color:#1e293b;text-decoration:none;">
                            {{ $article->title }}
                        </a>
                    </h2>

                    <!-- Status Badge -->
                    @if($article->status == 'published')
                        <span style="background:#dcfce7;color:#166534;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:500;display:inline-block;">
                            ✅ Published
                        </span>
                    @else
                        <span style="background:#fef3c7;color:#92400e;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:500;display:inline-block;">
                            📝 Draft
                        </span>
                    @endif
                </div>

                <!-- Article Image -->
                @if($article->image)
                    <div style="margin-left:20px;">
                        <img src="{{ asset('storage/' . $article->image) }}"
                             alt="{{ $article->title }}"
                             style="width:80px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                    </div>
                @endif
            </div>

            <!-- Article Content -->
            <p style="color:#64748b;margin:0 0 16px 0;line-height:1.5;">
                {{ Str::limit(strip_tags($article->content), 200) }}
            </p>

            <!-- Article Meta -->
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <div style="color:#94a3b8;font-size:14px;">
                    📅 {{ $article->created_at->format('d M Y') }}
                    • 📂 {{ $article->category->name ?? 'Uncategorized' }}
                </div>

                <!-- Action Buttons -->
                <div style="display:flex;gap:8px;">
                    <a href="{{ route('staff.articles.show', $article) }}"
                       style="background:#f1f5f9;color:#475569;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:14px;font-weight:500;">
                        👁️ Lihat
                    </a>

                    <a href="{{ route('staff.articles.edit', $article) }}"
                       style="background:#3b82f6;color:#fff;padding:8px 16px;border-radius:8px;text-decoration:none;font-size:14px;font-weight:500;">
                        ✏️ Edit
                    </a>

                    <form method="POST" action="{{ route('staff.articles.destroy', $article) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="background:#ef4444;color:#fff;padding:8px 16px;border:none;border-radius:8px;font-size:14px;font-weight:500;cursor:pointer;"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <!-- Empty State -->
        <div style="text-align:center;padding:60px 20px;background:#fff;border-radius:16px;border:2px dashed #e2e8f0;">
            <div style="font-size:48px;margin-bottom:16px;">📝</div>
            <h3 style="color:#475569;margin:0 0 8px 0;">Belum ada artikel</h3>
            <p style="color:#94a3b8;margin:0 0 24px 0;">Mulai buat artikel pertama Anda untuk berbagi pengetahuan</p>
            <a href="{{ route('staff.articles.create') }}"
               style="background:#1a8917;color:#fff;padding:12px 24px;border-radius:25px;text-decoration:none;font-weight:500;display:inline-flex;align-items:center;gap:8px;">
                ✍️ Tulis Artikel Pertama
            </a>
        </div>
    @endforelse

    <!-- Pagination -->
    @if($articles->hasPages())
        <div style="margin-top:40px;text-align:center;">
            {{ $articles->links() }}
        </div>
    @endif

</div>
@endsection
