@extends('layouts.staff')

@section('title', 'Dashboard Staff')

@section('content')
<div style="max-width:1200px;margin:0 auto;font-family:Inter,Arial,sans-serif;">

    <!-- Header -->
    <div style="margin-bottom:32px;">
        <h1 style="font-size:32px;margin:0 0 8px 0;color:#242424;">Dashboard Staff</h1>
        <p style="margin:0;color:#6b7280;font-size:16px;">Pantau artikel dan aktivitas Anda</p>
    </div>

    <!-- Statistics Cards -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;margin-bottom:40px;">
        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #f1f5f9;">
            <div style="display:flex;align-items:center;gap:16px;">
                <div style="background:#e0f2fe;border-radius:12px;padding:12px;">
                    <span style="font-size:24px;">📝</span>
                </div>
                <div>
                    <h3 style="font-size:28px;font-weight:700;margin:0;color:#1e293b;">{{ $totalArticles }}</h3>
                    <p style="margin:4px 0 0 0;color:#64748b;font-size:14px;">Total Artikel</p>
                </div>
            </div>
        </div>

        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #f1f5f9;">
            <div style="display:flex;align-items:center;gap:16px;">
                <div style="background:#dcfce7;border-radius:12px;padding:12px;">
                    <span style="font-size:24px;">✅</span>
                </div>
                <div>
                    <h3 style="font-size:28px;font-weight:700;margin:0;color:#166534;">{{ $publishedArticles }}</h3>
                    <p style="margin:4px 0 0 0;color:#64748b;font-size:14px;">Published</p>
                </div>
            </div>
        </div>

        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #f1f5f9;">
            <div style="display:flex;align-items:center;gap:16px;">
                <div style="background:#fef3c7;border-radius:12px;padding:12px;">
                    <span style="font-size:24px;">📝</span>
                </div>
                <div>
                    <h3 style="font-size:28px;font-weight:700;margin:0;color:#92400e;">{{ $draftArticles }}</h3>
                    <p style="margin:4px 0 0 0;color:#64748b;font-size:14px;">Draft</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div style="background:#fff;border-radius:16px;padding:24px;margin-bottom:40px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #f1f5f9;">
        <h3 style="font-size:20px;font-weight:600;margin:0 0 20px 0;color:#1e293b;">Aksi Cepat</h3>
        <div style="display:flex;gap:16px;flex-wrap:wrap;">
            <a href="{{ route('staff.articles.create') }}"
               style="background:#1a8917;color:#fff;padding:12px 20px;border-radius:25px;text-decoration:none;font-weight:500;display:flex;align-items:center;gap:8px;">
                ✍️ Tulis Artikel Baru
            </a>
            <a href="{{ route('staff.articles.index') }}"
               style="background:#3b82f6;color:#fff;padding:12px 20px;border-radius:25px;text-decoration:none;font-weight:500;display:flex;align-items:center;gap:8px;">
                📚 Kelola Artikel
            </a>
            <a href="{{ route('staff.profile') }}"
               style="background:#8b5cf6;color:#fff;padding:12px 20px;border-radius:25px;text-decoration:none;font-weight:500;display:flex;align-items:center;gap:8px;">
                👤 Profil Saya
            </a>
        </div>
    </div>

    <!-- Chart Section -->
    <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.06);border:1px solid #f1f5f9;">
        <h3 style="font-size:20px;font-weight:600;margin:0 0 20px 0;color:#1e293b;">Statistik Artikel</h3>
        <div style="max-width:400px;margin:0 auto;">
            <canvas id="articleChart" height="200"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('articleChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                data: @json($chartData['values']),
                backgroundColor: ['#10b981', '#f59e0b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>
@endsection
