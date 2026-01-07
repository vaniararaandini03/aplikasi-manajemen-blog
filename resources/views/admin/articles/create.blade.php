@extends('layouts.admin')

@section('title', 'Tambah Artikel')

@section('content')

<div style="
    max-width: 800px;
    margin: 0 auto;
    font-family: Georgia, serif;
">

    <h1 style="
        font-size: 32px;
        margin-bottom: 30px;
        color: #242424;
    ">
        Tambah Artikel
    </h1>

    <div style="
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    ">

        <form action="{{ route('admin.articles.store') }}" method="POST">
            @csrf

            <!-- Judul -->
            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:8px; font-weight:bold;">
                    Judul Artikel
                </label>
                <input type="text" name="title"
                       style="
                           width:100%;
                           padding:10px;
                           border:1px solid #ddd;
                           border-radius:6px;
                       ">
            </div>

            <!-- Penulis -->
            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:8px; font-weight:bold;">
                    Nama Penulis
                </label>
                <input type="text" name="author"
                       style="
                           width:100%;
                           padding:10px;
                           border:1px solid #ddd;
                           border-radius:6px;
                       ">
            </div>

            <!-- Kategori -->
            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:8px; font-weight:bold;">
                    Kategori
                </label>
                <select name="category_id"
                        style="
                            width:100%;
                            padding:10px;
                            border:1px solid #ddd;
                            border-radius:6px;
                        ">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Isi -->
            <div style="margin-bottom: 30px;">
                <label style="display:block; margin-bottom:8px; font-weight:bold;">
                    Isi Artikel
                </label>
                <textarea name="content" rows="8"
                          style="
                              width:100%;
                              padding:12px;
                              border:1px solid #ddd;
                              border-radius:6px;
                              resize:vertical;
                          "></textarea>
            </div>

            <!-- Tombol -->
            <div style="display:flex; gap:15px;">
                <button type="submit"
                        style="
                            background:#1a8917;
                            color:#fff;
                            padding:10px 22px;
                            border:none;
                            border-radius:20px;
                            cursor:pointer;
                            font-size:14px;
                        ">
                    Simpan
                </button>

                <a href="{{ route('admin.articles.index') }}"
                   style="
                       text-decoration:none;
                       padding:10px 22px;
                       border-radius:20px;
                       border:1px solid #ddd;
                       color:#555;
                       font-size:14px;
                   ">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
