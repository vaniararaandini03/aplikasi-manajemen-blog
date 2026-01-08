@extends('layouts.admin')

@section('title', 'Tambah Artikel')

@section('content')

<div style="max-width:800px;margin:0 auto;font-family:Georgia,serif;">

    <h1 style="font-size:32px;margin-bottom:30px;">Tambah Artikel</h1>

    <div style="background:#fff;padding:30px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.05);">

        {{-- NOTIFIKASI ERROR --}}
        @if ($errors->any())
            <div style="background:#ffecec;border:1px solid #f5c2c7;padding:15px;border-radius:8px;margin-bottom:25px;">
                <strong>Perhatian!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Judul -->
            <div style="margin-bottom:20px;">
                <label>Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    style="width:100%;padding:10px;border:1px solid {{ $errors->has('title') ? '#dc3545' : '#ddd' }};">
                @error('title') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <!-- Penulis -->
            <div style="margin-bottom:20px;">
                <label>Nama Penulis</label>
                <input type="text" name="author" value="{{ old('author') }}"
                    style="width:100%;padding:10px;border:1px solid {{ $errors->has('author') ? '#dc3545' : '#ddd' }};">
                @error('author') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <!-- Kategori -->
            <div style="margin-bottom:20px;">
                <label>Kategori</label>
                <select name="category_id"
                    style="width:100%;padding:10px;border:1px solid {{ $errors->has('category_id') ? '#dc3545' : '#ddd' }};">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <!-- Upload File -->
            <div style="margin-bottom:20px;">
                <label>Gambar Artikel</label>
                <input type="file" name="image"
                    style="width:100%;padding:8px;border:1px solid {{ $errors->has('image') ? '#dc3545' : '#ddd' }};">
                <small style="color:#6c757d;">Format JPG/PNG, maksimal 2MB</small><br>
                @error('image') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <!-- Isi -->
            <div style="margin-bottom:30px;">
                <label>Isi Artikel</label>
                <textarea id="content" name="content" rows="8"
                    style="width:100%;padding:12px;border:1px solid {{ $errors->has('content') ? '#dc3545' : '#ddd' }};">{{ old('content') }}</textarea>

                <small id="wordCount" style="color:#6c757d;">
                    Jumlah kata: 0 / 100
                </small><br>

                @error('content') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <button id="submitBtn" type="submit"
                style="background:#1a8917;color:#fff;padding:10px 22px;border:none;border-radius:20px;"
                disabled>
                Simpan
            </button>
        </form>
    </div>
</div>

{{-- SCRIPT HITUNG KATA --}}
<script>
    const textarea = document.getElementById('content');
    const counter = document.getElementById('wordCount');
    const submitBtn = document.getElementById('submitBtn');

    function countWords(text) {
        return text.trim().split(/\s+/).filter(word => word.length > 0).length;
    }

    function updateCounter() {
        const words = countWords(textarea.value);
        counter.textContent = `Jumlah kata: ${words} / 100`;

        if (words >= 100) {
            submitBtn.disabled = false;
            counter.style.color = 'green';
        } else {
            submitBtn.disabled = true;
            counter.style.color = 'red';
        }
    }

    textarea.addEventListener('input', updateCounter);
    updateCounter();
</script>

@endsection
