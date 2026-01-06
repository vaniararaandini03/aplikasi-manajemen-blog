@extends('layouts.admin')

@section('content')
<h2>Dashboard Admin</h2>

<div style="
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin:30px 0;
">
    <div style="border:1px solid #ddd;padding:20px;text-align:center">
        <small>Total Artikel</small>
        <h2>{{ $totalArticles }}</h2>
    </div>

    <div style="border:1px solid #ddd;padding:20px;text-align:center">
        <small>Published</small>
        <h2>{{ $publishedArticles }}</h2>
    </div>

    <div style="border:1px solid #ddd;padding:20px;text-align:center">
        <small>Draft</small>
        <h2>{{ $draftArticles }}</h2>
    </div>

    <div style="border:1px solid #ddd;padding:20px;text-align:center">
        <small>Total Users</small>
        <h2>{{ $totalUsers }}</h2>
    </div>
</div>

<h4>Artikel Terbaru</h4>
<p>Belum ada artikel.</p>
@endsection
