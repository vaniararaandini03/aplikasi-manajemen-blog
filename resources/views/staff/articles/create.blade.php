@extends('layouts.staff')

@section('title', 'Tambah Artikel')

@section('content')

<div style="max-width:800px;margin:0 auto;font-family:Georgia,serif;">

    <h1 style="font-size:32px;margin-bottom:30px;">Tambah Artikel</h1>

    <div style="background:#fff;padding:30px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.05);">

        {{-- ERROR BACKEND --}}
        @if ($errors->any())
            <div style="background:#ffecec;border:1px solid #f5c2c7;padding:15px;border-radius:8px;margin-bottom:20px;">
                <strong>⚠️ Perhatian!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- WARNING FRONTEND --}}
        <div id="formWarning"
            style="display:none;background:#fff3cd;border:1px solid #ffeeba;
                   padding:12px;border-radius:8px;margin-bottom:20px;color:#856404;">
            ⚠️ Semua field wajib diisi, isi artikel minimal 100 kata, dan gambar wajib dipilih.
        </div>

        {{-- 🔴 UBAH DI SINI: TAMBAH enctype --}}
        <form action="{{ route('staff.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul -->
            <div style="margin-bottom:20px;">
                <label>Judul Artikel <span style="color:red">*</span></label>
                <input type="text" id="title" name="title" class="form-control">
            </div>

            <!-- Penulis -->
            <div style="margin-bottom:20px;">
                <label>Nama Penulis <span style="color:red">*</span></label>
                <input type="text" id="author" name="author" class="form-control">
            </div>

            <!-- Kategori -->
            <div style="margin-bottom:20px;">
                <label>Kategori <span style="color:red">*</span></label>
                <select id="category" name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div style="margin-bottom:20px;">
                <label>Status Artikel <span style="color:red">*</span></label>
                <select id="status" name="status" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="draft">Draft</option>
                    <option value="published">Publish</option>
                </select>
            </div>

            <!-- 🔴 FIELD BARU: GAMBAR -->
            <div style="margin-bottom:20px;">
                <label>Gambar Artikel <span style="color:red">*</span></label>
                <input type="file"
                       id="image"
                       name="image"
                       class="form-control"
                       accept="image/*">
            </div>

            <!-- Isi -->
            <div style="margin-bottom:30px;">
                <label>Isi Artikel <span style="color:red">*</span></label>
                <textarea id="content" name="content" rows="8"
                    class="form-control"></textarea>

                <small id="wordCount" style="color:red;">
                    Jumlah kata: 0 / 100
                </small>
            </div>

            <button id="submitBtn" type="submit"
                style="background:#1a8917;color:#fff;padding:10px 22px;border:none;border-radius:20px;"
                disabled>
                Simpan
            </button>
        </form>
    </div>
</div>

<script>
    const title = document.getElementById('title');
    const author = document.getElementById('author');
    const category = document.getElementById('category');
    const status = document.getElementById('status');
    const content = document.getElementById('content');
    const image = document.getElementById('image');
    const counter = document.getElementById('wordCount');
    const submitBtn = document.getElementById('submitBtn');
    const warning = document.getElementById('formWarning');

    function countWords(text) {
        return text.trim().split(/\s+/).filter(w => w.length > 0).length;
    }

    function validateForm() {
        const words = countWords(content.value);

        counter.textContent = `Jumlah kata: ${words} / 100`;

        const valid =
            title.value.trim() !== '' &&
            author.value.trim() !== '' &&
            category.value !== '' &&
            status.value !== '' &&
            image.files.length > 0 &&
            words >= 100;

        submitBtn.disabled = !valid;
        warning.style.display = valid ? 'none' : 'block';
        counter.style.color = words >= 100 ? 'green' : 'red';
    }

    [title, author, category, status, content, image].forEach(el =>
        el.addEventListener('input', validateForm)
    );

    validateForm();
</script>

@endsection
