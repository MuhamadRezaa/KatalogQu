@extends('tenant.admin.layouts.app')

@section('title', 'Store Heroes')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Manajemen Store Heroes</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHeroModal">
                            <i class="fa fa-plus"></i> Tambah Hero Baru
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Subtitle</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Button Text</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($heroes as $hero)
                                    <tr>
                                        <td>
                                            @if ($hero->image_url)
                                                <img src="{{ route('tenant.asset', ['path' => $hero->image_url]) }}"
                                                    alt="{{ $hero->title }}" class="img-fluid rounded"
                                                    style="max-width: 100px;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                    style="width: 100px; height: 60px;">
                                                    <i class="fa fa-picture-o fa-2x text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="user-info">
                                                <h6>{{ $hero->title ?? '-' }}</h6>
                                            </div>
                                        </td>
                                        <td>{{ $hero->subtitle ?? '-' }}</td>
                                        <td>{{ $hero->link ?? '-' }}</td>
                                        <td>{{ $hero->button_text ?? '-' }}</td>
                                        <td>
                                            @if ($hero->is_active)
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-secondary">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="editHero({{ $hero->id }})" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteHero({{ $hero->id }})" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <h5 class="f-light">Belum ada hero.</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Hero Modal -->
    <div class="modal fade" id="addHeroModal" tabindex="-1" aria-labelledby="addHeroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addHeroModalLabel">Tambah Hero Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addHeroForm" action="{{ route('tenant.admin.store-heroes.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add_image" class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="add_image" name="image"
                                accept="image/jpeg,image/png,image/webp" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="add_title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="add_subtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="add_subtitle" name="subtitle">
                        </div>
                        <div class="mb-3">
                            <label for="add_link" class="form-label">Link (URL)</label>
                            <input type="url" class="form-control" id="add_link" name="link">
                        </div>
                        <div class="mb-3">
                            <label for="add_button_text" class="form-label">Button Text</label>
                            <input type="text" class="form-control" id="add_button_text" name="button_text">
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="add_is_active" name="is_active"
                                    value="1" checked>
                                <label class="form-check-label" for="add_is_active">Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Hero</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Hero Modal -->
    <div class="modal fade" id="editHeroModal" tabindex="-1" aria-labelledby="editHeroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHeroModalLabel">Edit Hero</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editHeroForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit_hero_id" name="hero_id">
                        <div class="mb-3">
                            <label for="edit_image" class="form-label">Ganti Image</label>
                            <input type="file" class="form-control" id="edit_image" name="image"
                                accept="image/jpeg,image/png,image/webp">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar.</div>
                        </div>
                        <div id="currentImagePreview" class="mb-3">
                            <label class="form-label">Image Saat Ini</label>
                            <div><img id="current_hero_image" src="" class="img-fluid rounded"
                                    style="max-height: 100px;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="edit_subtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="edit_subtitle" name="subtitle">
                        </div>
                        <div class="mb-3">
                            <label for="edit_link" class="form-label">Link (URL)</label>
                            <input type="url" class="form-control" id="edit_link" name="link">
                        </div>
                        <div class="mb-3">
                            <label for="edit_button_text" class="form-label">Button Text</label>
                            <input type="text" class="form-control" id="edit_button_text" name="button_text">
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active"
                                    value="1">
                                <label class="form-check-label" for="edit_is_active">Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Hero</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#table-1').DataTable({
                responsive: true,
                paging: true,
                info: true,
                searching: true
            });
        });

        const showUrlTemplate = '{{ route('tenant.admin.store-heroes.show', ['store_hero' => ':id']) }}';
        const updateUrlTemplate = '{{ route('tenant.admin.store-heroes.update', ['store_hero' => ':id']) }}';
        const destroyUrlTemplate = '{{ route('tenant.admin.store-heroes.destroy', ['store_hero' => ':id']) }}';

        function editHero(heroId) {
            const fetchUrl = showUrlTemplate.replace(':id', heroId);

            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const hero = data.hero;
                        const form = document.getElementById('editHeroForm');

                        form.action = updateUrlTemplate.replace(':id', heroId);
                        form.querySelector('#edit_hero_id').value = hero.id;
                        form.querySelector('#edit_title').value = hero.title;
                        form.querySelector('#edit_subtitle').value = hero.subtitle;
                        form.querySelector('#edit_link').value = hero.link;
                        form.querySelector('#edit_button_text').value = hero.button_text; // Added
                        form.querySelector('#edit_is_active').checked = hero.is_active;

                        const assetBaseUrl = "{{ url('tenancy/assets') }}/";
                        const img = document.getElementById('current_hero_image');

                        if (hero.image_url) {
                            img.src = assetBaseUrl + hero.image_url;
                        } else {
                            img.src = ''; // Clear image if no image_url
                        }

                        new bootstrap.Modal(document.getElementById('editHeroModal')).show();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching hero data:', error);
                    alert('Gagal memuat data hero. Silakan coba lagi.');
                });
        }

        function deleteHero(heroId) {
            if (confirm('Anda yakin ingin menghapus hero ini? Tindakan ini tidak dapat dibatalkan.')) {
                const form = document.getElementById('deleteForm');
                form.action = destroyUrlTemplate.replace(':id', heroId);
                form.submit();
            }
        }

        // Handle form submissions via AJAX
        document.getElementById('addHeroForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // Reload page to see changes
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
        });

        document.getElementById('editHeroForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const heroId = form.querySelector('#edit_hero_id').value;

            // Append _method for PUT request
            formData.append('_method', 'PUT');

            fetch(form.action, {
                    method: 'POST', // Use POST for FormData with _method spoofing
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // Reload page to see changes
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
        });

        // Reset add form on modal close
        document.getElementById('addHeroModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('addHeroForm').reset();
            // Clear validation messages if any
            document.querySelectorAll('#addHeroForm .is-invalid').forEach(el => el.classList.remove('is-invalid'));
            document.querySelectorAll('#addHeroForm .invalid-feedback').forEach(el => el.remove());
        });
    </script>
@endpush
