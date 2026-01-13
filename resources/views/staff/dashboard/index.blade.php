@extends('layouts.staff')

@section('title', 'Dashboard Staff')

@section('content')
<h2>Dashboard Staff</h2>

<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:20px; margin-top:24px;">
    <div class="card">
        <h4>Total Artikel</h4>
        <div class="number">{{ $totalArticles }}</div>
    </div>

    <div class="card">
        <h4>Published</h4>
        <div class="number">{{ $publishedArticles }}</div>
    </div>

    <div class="card">
        <h4>Draft</h4>
        <div class="number">{{ $draftArticles }}</div>
    </div>
</div>

<div class="card" style="margin-top:32px;">
    <h4>Statistik Artikel</h4>
    <canvas id="articleChart" height="100"></canvas>
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
                backgroundColor: ['#1a73e8', '#fbbc04']
            }]
        }
    });
</script>
@endsection
