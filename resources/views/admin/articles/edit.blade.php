@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('content')

<div style="max-width:800px;margin:0 auto;font-family:Georgia,serif;">

    <h1 style="font-size:32px;margin-bottom:30px;">Edit Artikel</h1>

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

        {{-- NOTIFIKASI SUKSES --}}
        @if(session('success'))
            <div style="background:#d4edda;border:1px solid #c3e6cb;padding:15px;border-radius:8px;margin-bottom:25px;color:#155724;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div style="margin-bottom:20px;">
                <label>Judul Artikel</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}"
                    style="width:100%;padding:10px;border:1px solid {{ $errors->has('title') ? '#dc3545' : '#ddd' }};">
                @error('title') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <!-- Kategori -->
            <div style="margin-bottom:20px;">
                <label>Kategori</label>
                <select name="category_id"
                    style="width:100%;padding:10px;border:1px solid {{ $errors->has('category_id') ? '#dc3545' : '#ddd' }};">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <!-- Status -->
            <div style="margin-bottom:20px;">
                <label>Status Artikel</label>
                <select name="status"
                    style="width:100%;padding:10px;border:1px solid {{ $errors->has('status') ? '#dc3545' : '#ddd' }};">
                    <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                </select>
                @error('status') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <!-- Editor's Choice -->
            <div style="margin-bottom:20px;">
                <label style="display:block;margin-bottom:8px;">Editor's Choice</label>
                <input type="checkbox" name="is_editor_choice" value="1" id="is_editor_choice"
                       {{ old('is_editor_choice', $article->is_editor_choice) ? 'checked' : '' }}
                       style="margin-right:8px;">
                <label for="is_editor_choice" style="display:inline;">Tandai sebagai artikel pilihan editor</label>
            </div>

            <!-- Upload File -->
            <div style="margin-bottom:20px;">
                <label>Gambar Artikel</label>
                @if($article->image)
                    <div style="margin-bottom:10px;">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Current Image"
                             style="max-width:200px;max-height:150px;border:1px solid #ddd;border-radius:8px;">
                        <p style="margin:5px 0;color:#666;font-size:14px;">Gambar saat ini</p>
                    </div>
                @endif
                <input type="file" name="image"
                    style="width:100%;padding:8px;border:1px solid {{ $errors->has('image') ? '#dc3545' : '#ddd' }};">
                <small style="color:#6c757d;">Format JPG/PNG, maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</small><br>
                @error('image') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <!-- Isi -->
            <div style="margin-bottom:30px;">
                <label>Isi Artikel</label>
                <textarea id="content" name="content" rows="8"
                    style="width:100%;padding:12px;border:1px solid {{ $errors->has('content') ? '#dc3545' : '#ddd' }};">{{ old('content', $article->content) }}</textarea>

                <small id="wordCount" style="color:#6c757d;">
                    Jumlah kata: {{ str_word_count($article->content) }} / 100
                </small><br>

                @error('content') <small style="color:red">{{ $message }}</small> @enderror
            </div>

            <div style="display:flex;gap:10px;">
                <button id="submitBtn" type="submit"
                    style="background:#1a8917;color:#fff;padding:10px 22px;border:none;border-radius:20px;">
                    Update Artikel
                </button>
                <a href="{{ route('admin.articles.index') }}"
                   style="background:#6c757d;color:#fff;padding:10px 22px;border:none;border-radius:20px;text-decoration:none;display:inline-block;">
                    Kembali
                </a>
            </div>
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
