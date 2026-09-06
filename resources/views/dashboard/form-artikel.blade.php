@extends('dashboard.layout')

@section('title', ($isEdit ? 'Edit Artikel' : 'Tambah Artikel Baru') . ' | FZAN NEWS')

@section('content')
<div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 28px;">
    <div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: 30px; font-weight: 700; color: #0f172a; margin-bottom: 4px;">
            {{ $isEdit ? 'Edit Artikel' : 'Tambah Artikel Baru' }}
        </h1>
        <p style="color: #64748b; font-size: 14px;">Lengkapi formulir di bawah ini. Anda dapat melihat pratinjau langsung di sebelah kanan.</p>
    </div>
    <a href="{{ route('dashboard.daftar-artikel') }}" style="background: #f1f5f9; color: #475569; padding: 10px 20px; border-radius: 99px; font-weight: 600; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<!-- Two Column Layout: Form & Live Preview -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 28px; align-items: start;">
    <!-- Form Card -->
    <div style="background: #ffffff; border-radius: 16px; padding: 28px; box-shadow: 0 4px 16px rgba(0,0,0,0.03); border: 1px solid #e2e8f0;">
        <form action="{{ $isEdit ? route('dashboard.update-artikel', $article->id) : route('dashboard.simpan-artikel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div style="display: flex; flex-direction: column; gap: 20px;">
                <!-- Judul -->
                <div>
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; color: #0f172a;">
                        Judul Artikel <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="title" id="formTitleInput" value="{{ old('title', $article->title) }}" placeholder="Contoh: Menjaga Produktivitas di Era Digital" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 15px; outline: none; font-family: inherit; transition: border-color 0.2s;">
                    @error('title')
                        <span style="color: #ef4444; font-size: 12.5px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; color: #0f172a;">
                        Kategori Artikel <span style="color: #ef4444;">*</span>
                    </label>
                    <select name="category" id="formCategorySelect" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 14px; background: #fff; outline: none; font-family: inherit;">
                        @php
                            $cats = ['Lifestyle', 'Travel', 'Productivity', 'Personal Growth', 'Technology', 'Health', 'Fashion', 'Art', 'Sports'];
                        @endphp
                        @foreach($cats as $cat)
                            <option value="{{ $cat }}" {{ old('category', $article->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 16px;">
                    <!-- Penulis -->
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; color: #0f172a;">
                            Penulis <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="author_name" id="formAuthorInput" value="{{ old('author_name', $article->author_name ?: 'Olivia Hart') }}" required style="width: 100%; padding: 12px 16px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 14px; outline: none; font-family: inherit;">
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; color: #0f172a;">
                            Jabatan Penulis
                        </label>
                        <input type="text" name="author_role" value="{{ old('author_role', $article->author_role ?: 'Editor') }}" placeholder="Editor in Chief" style="width: 100%; padding: 12px 16px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 14px; outline: none; font-family: inherit;">
                    </div>
                </div>

                <!-- Gambar Sampul (Upload File / URL) -->
                <div>
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; color: #0f172a;">
                        Gambar Sampul Artikel
                    </label>

                    <!-- Area Upload File -->
                    <div id="dropZone" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 20px; text-align: center; background: #f8fafc; cursor: pointer; transition: all 0.2s;" onclick="document.getElementById('formImageFileInput').click();">
                        <input type="file" name="image_file" id="formImageFileInput" accept="image/*" style="display: none;">
                        <i class="fas fa-cloud-upload-alt" style="font-size: 28px; color: var(--c-teal, #076653); margin-bottom: 8px;"></i>
                        <p style="margin: 0; font-weight: 600; font-size: 14px; color: #334155;" id="uploadFileName">Klik atau seret file gambar ke sini</p>
                        <p style="margin: 4px 0 0 0; font-size: 12px; color: #64748b;">Format: JPG, PNG, WEBP, GIF (Maks. 5MB)</p>
                    </div>
                    @error('image_file')
                        <span style="color: #ef4444; font-size: 12.5px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                    </div>
                </div>



                <!-- Content -->
                <div>
                    <label style="display: block; font-weight: 600; font-size: 14px; margin-bottom: 8px; color: #0f172a;">
                        Isi Konten Artikel <span style="color: #ef4444;">*</span>
                    </label>
                    <textarea name="content" id="formContentInput" rows="8" required placeholder="Tuliskan teks paragraf artikel di sini..." style="width: 100%; padding: 12px 16px; border: 1.5px solid #cbd5e1; border-radius: 10px; font-size: 14px; outline: none; font-family: inherit; line-height: 1.6; resize: vertical;">{{ old('content', $article->content) }}</textarea>
                </div>

                <!-- Submit Buttons -->
                <div style="display: flex; gap: 12px; justify-content: flex-end; padding-top: 16px; border-top: 1px solid #f1f5f9;">
                    <a href="{{ route('dashboard.daftar-artikel') }}" style="background: #f1f5f9; color: #475569; padding: 12px 24px; border-radius: 99px; font-weight: 600; text-decoration: none; font-size: 14px;">Batal</a>
                    <button type="submit" style="background: var(--c-teal); color: #ffffff; border: none; padding: 12px 32px; border-radius: 99px; font-weight: 600; font-size: 15px; cursor: pointer; box-shadow: 0 4px 14px rgba(7, 102, 83, 0.3); display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-paper-plane"></i> {{ $isEdit ? 'Simpan Perubahan' : 'Terbitkan Artikel' }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Live Preview Card -->
    <div style="position: sticky; top: 32px;">
        <div style="font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 0.8px; color: var(--c-teal); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-eye"></i> Live Card Preview
        </div>

        <div style="background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
            <div style="height: 200px; position: relative; background: #e2e8f0;">
                <img id="previewImage" src="{{ old('image', $article->image ?: 'https://images.unsplash.com/photo-1544144433-d50aff500b91?auto=format&fit=crop&q=80&w=800') }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                <span id="previewCategory" style="position: absolute; top: 14px; left: 14px; background: var(--c-teal); color: #fff; font-size: 10px; font-weight: 700; padding: 4px 10px; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.5px;">
                    {{ strtoupper($article->category ?: 'LIFESTYLE') }}
                </span>
            </div>
            <div style="padding: 20px;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; display: flex; items-center; gap: 8px;">
                    <span><i class="far fa-clock"></i> 5 min read</span> &bull; <span>Hari Ini</span>
                </div>
                <h3 id="previewTitle" style="font-family: 'Playfair Display', serif; font-size: 19px; font-weight: 700; color: #0f172a; margin-bottom: 8px; line-height: 1.3;">
                    {{ $article->title ?: 'Judul Artikel Anda Akan Muncul Di Sini' }}
                </h3>
                <p id="previewExcerpt" style="font-size: 13px; color: #64748b; line-height: 1.5; margin-bottom: 16px;">
                    {{ $article->excerpt ?: 'Ringkasan singkat artikel akan langsung terupdate di sini saat Anda mengetik...' }}
                </p>
                <div style="border-top: 1px solid #f1f5f9; padding-top: 12px; display: flex; align-items: center; gap: 10px;">
                    <img src="https://i.pravatar.cc/100?img=5" alt="Author" style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
                    <span id="previewAuthor" style="font-size: 12.5px; font-weight: 600; color: #334155;">
                        {{ $article->author_name ?: 'Olivia Hart' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Live Form Preview Sync
    const titleInput = document.getElementById('formTitleInput');
    const categorySelect = document.getElementById('formCategorySelect');
    const authorInput = document.getElementById('formAuthorInput');
    const imageFileInput = document.getElementById('formImageFileInput');
    const uploadFileName = document.getElementById('uploadFileName');
    const dropZone = document.getElementById('dropZone');
    const contentInput = document.getElementById('formContentInput');

    function getAutoExcerpt(text) {
        const stripped = text.replace(/<[^>]*>/g, '').trim();
        const words = stripped.split(/\s+/).filter(w => w.length > 0);
        return words.slice(0, 10).join(' ') + (words.length > 10 ? '...' : '');
    }

    const pTitle = document.getElementById('previewTitle');
    const pCategory = document.getElementById('previewCategory');
    const pAuthor = document.getElementById('previewAuthor');
    const pImage = document.getElementById('previewImage');
    const pExcerpt = document.getElementById('previewExcerpt');

    if (titleInput) {
        titleInput.addEventListener('input', (e) => {
            pTitle.innerText = e.target.value || 'Judul Artikel Anda';
        });
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', (e) => {
            pCategory.innerText = (e.target.value || 'LIFESTYLE').toUpperCase();
        });
    }

    if (authorInput) {
        authorInput.addEventListener('input', (e) => {
            pAuthor.innerText = e.target.value || 'Penulis';
        });
    }

    if (imageFileInput) {
        imageFileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                uploadFileName.innerHTML = `<i class="fas fa-check-circle" style="color: #10b981;"></i> <strong>${file.name}</strong> (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
                pImage.src = URL.createObjectURL(file);
            }
        });
    }

    if (dropZone) {
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.style.borderColor = 'var(--c-teal, #076653)';
                dropZone.style.background = '#f0fdf4';
            }, false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropZone.style.borderColor = '#cbd5e1';
                dropZone.style.background = '#f8fafc';
            }, false);
        });
        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files && files.length > 0) {
                imageFileInput.files = files;
                const event = new Event('change');
                imageFileInput.dispatchEvent(event);
            }
        });
    }

    if (contentInput) {
        contentInput.addEventListener('input', (e) => {
            const auto = getAutoExcerpt(e.target.value);
            pExcerpt.innerText = auto || 'Ringkasan singkat akan otomatis muncul dari 10 kata pertama konten...';
        });
    }
</script>
@endsection
