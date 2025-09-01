@extends('tenant.admin.layouts.app')

@section('title', 'Produk')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-no-border">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Manajemen Produk</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                            <i class="fa fa-plus"></i> Tambah Produk Baru
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

                    <div class="table-responsive custom-scrollbar">
                        <table class="display" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>
                                            @if ($product->image)
                                                <img src="{{ route('tenant.asset', ['path' => $product->image]) }}"
                                                    alt="{{ $product->name }}" class="img-fluid rounded"
                                                    style="max-width: 60px;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="fa fa-picture-o fa-2x text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="user-info">
                                                <h6>{{ $product->name }}</h6>
                                                <p class="f-light">SKU: {{ $product->sku ?? 'N/A' }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $product->category->name ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $product->brand->name ?? '-' }}
                                        </td>
                                        <td>
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                            @if ($product->old_price && $product->old_price > $product->price)
                                                <br><small><del>Rp
                                                        {{ number_format($product->old_price, 0, ',', '.') }}</del></small>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $product->stock ?? 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($product->is_active)
                                                <span class="badge badge-light-success">Aktif</span>
                                            @else
                                                <span class="badge badge-light-secondary">Nonaktif</span>
                                            @endif
                                            @if ($product->is_promo)
                                                <span class="badge badge-light-warning">Promo</span>
                                            @endif
                                            @if ($product->is_new)
                                                <span class="badge badge-light-info">Baru</span>
                                            @endif
                                            @if ($product->is_featured)
                                                <span class="badge badge-light-primary">Featured</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="editProduct({{ $product->id }})" title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteProduct({{ $product->id }})" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <h5 class="f-light">Belum ada produk.</h5>
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addProductForm" action="{{ route('tenant.admin.products.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="add_name" class="form-label">Nama Produk <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="add_name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="add_description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="add_description" name="description" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="add_image" class="form-label">Gambar Utama Produk</label>
                                    <input type="file" class="form-control" id="add_image" name="image"
                                        accept="image/jpeg,image/png,image/webp">
                                    <div id="add_image_preview_container" class="mt-2">
                                        <!-- Preview will be inserted here by JS -->
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gambar Tambahan (Maks. 3)</label>
                                    <div id="add_additional_images_fields">
                                        <!-- Dynamic inputs and previews will be added here by JS -->
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        id="add_additional_image_btn"><i class="fa fa-plus"></i> Tambah Gambar</button>
                                </div>
                                <div class="mb-3">
                                    <label for="add_price" class="form-label">Harga <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="add_price" name="price"
                                        min="0" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="add_old_price" class="form-label">Harga Lama (Opsional)</label>
                                    <input type="number" class="form-control" id="add_old_price" name="old_price"
                                        min="0" step="0.01">
                                </div>
                                <div class="mb-3">
                                    <label for="add_stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="add_stock" name="stock"
                                        min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="add_sku" class="form-label">SKU</label>
                                    <input type="text" class="form-control" id="add_sku" name="sku" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="add_product_category_id" class="form-label">Kategori Produk</label>
                                    <select class="form-select" id="add_product_category_id" name="product_category_id">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="add_sub_category_id" class="form-label">Sub Kategori Produk</label>
                                    <select class="form-select" id="add_sub_category_id" name="sub_category_id">
                                        <option value="">Pilih Sub Kategori</option>
                                        @foreach ($subCategories as $subCat)
                                            <option value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="add_brand_id" class="form-label">Brand Produk</label>
                                    <select class="form-select" id="add_brand_id" name="brand_id">
                                        <option value="">Pilih Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Spesifikasi</label>
                                    <div id="add_specification_fields">
                                        <div class="input-group mb-2">
                                            {{-- <input type="text" class="form-control" name="specification[0][key]"
                                                placeholder="Key (e.g., CPU)">
                                            <input type="text" class="form-control" name="specification[0][value]"
                                                placeholder="Value (e.g., i5-12500h)"> --}}
                                            {{-- <button type="button" class="btn btn-outline-danger remove-spec-field"><i
                                                    class="fa fa-times"></i></button> --}}
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        id="add_spec_field_btn"><i class="fa fa-plus"></i> Tambah Spesifikasi</button>
                                </div>
                                <div class="mb-3">
                                    <label for="add_estimasi_waktu" class="form-label">Estimasi Waktu (menit)</label>
                                    <input type="number" class="form-control" id="add_estimasi_waktu"
                                        name="estimasi_waktu" min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="add_sort_order" class="form-label">Urutan Tampilan</label>
                                    <input type="number" class="form-control" id="add_sort_order" name="sort_order"
                                        min="0">
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="add_is_active"
                                            name="is_active" value="1" checked>
                                        <label class="form-check-label" for="add_is_active">Aktif</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="add_is_promo"
                                            name="is_promo" value="1">
                                        <label class="form-check-label" for="add_is_promo">Promo</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="add_is_new" name="is_new"
                                            value="1">
                                        <label class="form-check-label" for="add_is_new">Baru</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="add_is_featured"
                                            name="is_featured" value="1">
                                        <label class="form-check-label" for="add_is_featured">Featured</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="add_is_available"
                                            name="is_available" value="1" checked>
                                        <label class="form-check-label" for="add_is_available">Tersedia</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_name" class="form-label">Nama Produk <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">Ganti Gambar Utama Produk</label>
                                    <input type="file" class="form-control" id="edit_image" name="image"
                                        accept="image/jpeg,image/png,image/webp">
                                    <div id="edit_image_preview_container" class="mt-2">
                                        <!-- Preview of new image will be inserted here by JS -->
                                    </div>
                                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar.</div>
                                </div>
                                <div id="currentImagePreview" class="mb-3" style="display: none;">
                                    <label class="form-label">Gambar Utama Saat Ini</label>
                                    <div><img id="current_image" src="" class="img-fluid rounded"
                                            style="max-height: 100px;"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gambar Tambahan (Maks. 3)</label>
                                    <div id="edit_additional_images_fields_existing">
                                        <!-- Existing images will be loaded here by JS -->
                                    </div>
                                    <div id="edit_additional_images_fields_new">
                                        <!-- Dynamic new inputs and previews will be added here by JS -->
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        id="edit_add_additional_image_btn"><i class="fa fa-plus"></i> Tambah
                                        Gambar</button>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_price" class="form-label">Harga <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="edit_price" name="price"
                                        min="0" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_old_price" class="form-label">Harga Lama (Opsional)</label>
                                    <input type="number" class="form-control" id="edit_old_price" name="old_price"
                                        min="0" step="0.01">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="edit_stock" name="stock"
                                        min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_sku" class="form-label">SKU</label>
                                    <input type="text" class="form-control" id="edit_sku" name="sku">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_product_category_id" class="form-label">Kategori Produk</label>
                                    <select class="form-select" id="edit_product_category_id" name="product_category_id">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_sub_category_id" class="form-label">Sub Kategori Produk</label>
                                    <select class="form-select" id="edit_sub_category_id" name="sub_category_id">
                                        <option value="">Pilih Sub Kategori</option>
                                        @foreach ($subCategories as $subCat)
                                            <option value="{{ $subCat->id }}">{{ $subCat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_brand_id" class="form-label">Brand Produk</label>
                                    <select class="form-select" id="edit_brand_id" name="brand_id">
                                        <option value="">Pilih Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Spesifikasi</label>
                                    <div id="edit_specification_fields">
                                        <!-- Existing specifications will be loaded here by JS -->
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        id="edit_add_spec_field_btn"><i class="fa fa-plus"></i> Tambah
                                        Spesifikasi</button>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_estimasi_waktu" class="form-label">Estimasi Waktu (menit)</label>
                                    <input type="number" class="form-control" id="edit_estimasi_waktu"
                                        name="estimasi_waktu" min="0">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_sort_order" class="form-label">Urutan Tampilan</label>
                                    <input type="number" class="form-control" id="edit_sort_order" name="sort_order"
                                        min="0">
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit_is_active"
                                            name="is_active" value="1">
                                        <label class="form-check-label" for="edit_is_active">Aktif</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit_is_promo"
                                            name="is_promo" value="1">
                                        <label class="form-check-label" for="edit_is_promo">Promo</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit_is_new" name="is_new"
                                            value="1">
                                        <label class="form-check-label" for="edit_is_new">Baru</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit_is_featured"
                                            name="is_featured" value="1">
                                        <label class="form-check-label" for="edit_is_featured">Featured</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="edit_is_available"
                                            name="is_available" value="1">
                                        <label class="form-check-label" for="edit_is_available">Tersedia</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Produk</button>
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

        const showUrlTemplate = '{{ route('tenant.admin.products.show', ['product' => ':id']) }}';
        const updateUrlTemplate = '{{ route('tenant.admin.products.update', ['product' => ':id']) }}';
        const destroyUrlTemplate = '{{ route('tenant.admin.products.destroy', ['product' => ':id']) }}';

        function addSpecField(containerId, index, key = '', value = '') {
            const container = document.getElementById(containerId);
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <input type="text" class="form-control" name="specification[${index}][key]" placeholder="Key (e.g., CPU)" value="${key}">
                <input type="text" class="form-control" name="specification[${index}][value]" placeholder="Value (e.g., i5-12500h)" value="${value}">
                <button type="button" class="btn btn-outline-danger remove-spec-field"><i class="fa fa-times"></i></button>
            `;
            container.appendChild(div);

            div.querySelector('.remove-spec-field').addEventListener('click', function() {
                div.remove();
            });
        }

        let addSpecIndex = 0;
        document.getElementById('add_spec_field_btn').addEventListener('click', function() {
            addSpecField('add_specification_fields', addSpecIndex++);
        });

        function setupImagePreview(inputFileElement, previewContainerElement) {
            inputFileElement.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainerElement.innerHTML =
                            `<img src="${e.target.result}" class="img-fluid rounded mt-2" style="max-height: 100px;">`;
                        previewContainerElement.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewContainerElement.innerHTML = '';
                    previewContainerElement.style.display = 'none';
                }
            });
        }

        // For main image in Add Modal
        setupImagePreview(document.getElementById('add_image'), document.getElementById('add_image_preview_container'));

        // For main image in Edit Modal (update existing preview)
        setupImagePreview(document.getElementById('edit_image'), document.getElementById('edit_image_preview_container'));

        // For additional images in Add Modal
        let addAdditionalImageIndex = 0;
        document.getElementById('add_additional_image_btn').addEventListener('click', function() {
            if (addAdditionalImageIndex < 3) { // Max 3 additional images
                const container = document.getElementById('add_additional_images_fields');
                const div = document.createElement('div');
                div.className = 'mb-2'; // Outer div for spacing
                div.innerHTML = `
                    <div class="input-group">
                        <input type="file" class="form-control additional-image-input" name="additional_images[]" accept="image/jpeg,image/png,image/webp">
                        <button type="button" class="btn btn-outline-danger remove-additional-image"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="additional-image-preview mt-2"></div>
                `;
                container.appendChild(div);

                setupImagePreview(div.querySelector('.additional-image-input'), div.querySelector(
                    '.additional-image-preview'));
                div.querySelector('.remove-additional-image').addEventListener('click', function() {
                    div.remove();
                    addAdditionalImageIndex--;
                });
                addAdditionalImageIndex++;
            } else {
                alert('Maksimal 3 gambar tambahan.');
            }
        });

        function editProduct(productId) {
            const fetchUrl = showUrlTemplate.replace(':id', productId);

            fetch(fetchUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const product = data.product;
                        const form = document.getElementById('editProductForm');

                        form.action = updateUrlTemplate.replace(':id', productId);
                        form.querySelector('#edit_name').value = product.name;
                        form.querySelector('#edit_description').value = product.description;
                        form.querySelector('#edit_image').value = ''; // Clear file input
                        form.querySelector('#edit_price').value = product.price;
                        form.querySelector('#edit_old_price').value = product.old_price;
                        form.querySelector('#edit_stock').value = product.stock;
                        form.querySelector('#edit_sku').value = product.sku;
                        form.querySelector('#edit_product_category_id').value = product.product_category_id || '';
                        form.querySelector('#edit_sub_category_id').value = product.sub_category_id || '';
                        form.querySelector('#edit_brand_id').value = product.brand_id || '';
                        form.querySelector('#edit_estimasi_waktu').value = product.estimasi_waktu;
                        form.querySelector('#edit_sort_order').value = product.sort_order;
                        form.querySelector('#edit_is_active').checked = product.is_active;
                        form.querySelector('#edit_is_promo').checked = product.is_promo;
                        form.querySelector('#edit_is_new').checked = product.is_new;
                        form.querySelector('#edit_is_featured').checked = product.is_featured;
                        form.querySelector('#edit_is_available').checked = product.is_available;

                        // Main image preview
                        const assetBaseUrl = "{{ url('tenancy/assets') }}/";
                        const currentImagePreview = document.getElementById('currentImagePreview');
                        const currentImage = document.getElementById('current_image');
                        if (product.image) {
                            currentImage.src = assetBaseUrl + product.image;
                            currentImagePreview.style.display = 'block';
                        } else {
                            currentImagePreview.style.display = 'none';
                        }
                        document.getElementById('edit_image_preview_container').innerHTML =
                            ''; // Clear new image preview
                        document.getElementById('edit_image_preview_container').style.display = 'none';

                        // Additional images
                        const existingAdditionalImagesContainer = document.getElementById(
                            'edit_additional_images_fields_existing');
                        existingAdditionalImagesContainer.innerHTML = ''; // Clear previous existing images
                        if (product.images && product.images.length > 0) {
                            product.images.forEach(img => {
                                const imgDiv = document.createElement('div');
                                imgDiv.className = 'mb-2'; // Outer div for spacing

                                // Gunakan encodeURIComponent untuk nama file/path agar aman
                                const assetBaseUrl = "{{ url('tenancy/assets') }}/";
                                const safeUrl = assetBaseUrl + encodeURIComponent(img.image_url);

                                imgDiv.innerHTML = `
                                <div class="input-group align-items-center">
                                    <img src="${safeUrl}"
                                        alt="Gambar ${img.id}"
                                        class="img-fluid rounded me-2"
                                        style="max-width: 80px; max-height: 80px;">
                                    <input type="hidden" name="existing_images_ids[]" value="${img.id}">
                                    <button type="button"
                                            class="btn btn-outline-danger remove-existing-image"
                                            data-id="${img.id}">
                                    <i class="fa fa-times"></i> Hapus
                                    </button>
                                </div>
                                `;
                                existingAdditionalImagesContainer.appendChild(imgDiv);

                                imgDiv.querySelector('.remove-existing-image').addEventListener('click',
                                    function() {
                                        imgDiv.remove();
                                    });
                            });
                        }
                        document.getElementById('edit_additional_images_fields_new').innerHTML =
                            ''; // Clear new additional image inputs
                        let editAdditionalImageIndex = 0;
                        document.getElementById('edit_add_additional_image_btn').onclick = function() {
                            if ((product.images ? product.images.length : 0) + editAdditionalImageIndex < 3) {
                                const container = document.getElementById('edit_additional_images_fields_new');
                                const div = document.createElement('div');
                                div.className = 'mb-2'; // Outer div for spacing
                                div.innerHTML = `
                                    <div class="input-group">
                                        <input type="file" class="form-control additional-image-input" name="additional_images[]" accept="image/jpeg,image/png,image/webp">
                                        <button type="button" class="btn btn-outline-danger remove-additional-image"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="additional-image-preview mt-2"></div>
                                `;
                                container.appendChild(div);

                                setupImagePreview(div.querySelector('.additional-image-input'), div.querySelector(
                                    '.additional-image-preview'));
                                div.querySelector('.remove-additional-image').addEventListener('click', function() {
                                    div.remove();
                                });
                                editAdditionalImageIndex++;
                            } else {
                                alert('Maksimal 3 gambar tambahan.');
                            }
                        };

                        // Specifications
                        const specFieldsContainer = document.getElementById('edit_specification_fields');
                        specFieldsContainer.innerHTML = ''; // Clear previous fields
                        let editSpecIndex = 0;
                        if (product.specification && product.specification.length > 0) {
                            product.specification.forEach(spec => {
                                addSpecField('edit_specification_fields', editSpecIndex++, spec.key, spec
                                    .value);
                            });
                        } else {
                            addSpecField('edit_specification_fields',
                                editSpecIndex++); // Add one empty field if no specs
                        }

                        new bootstrap.Modal(document.getElementById('editProductModal')).show();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);
                    alert('Gagal memuat data produk. Silakan coba lagi.');
                });
        }

        document.getElementById('edit_add_spec_field_btn').addEventListener('click', function() {
            addSpecField('edit_specification_fields', document.getElementById('edit_specification_fields').children
                .length);
        });

        function deleteProduct(productId) {
            if (confirm('Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')) {
                const form = document.getElementById('deleteForm');
                form.action = destroyUrlTemplate.replace(':id', productId);
                form.submit();
            }
        }

        document.getElementById('addProductModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('addProductForm').reset();
            document.getElementById('add_specification_fields').innerHTML = ''; // Clear spec fields
            addSpecField('add_specification_fields', 0); // Add one empty spec field
            document.getElementById('add_image_preview_container').innerHTML = ''; // Clear main image preview
            document.getElementById('add_image_preview_container').style.display = 'none';
            document.getElementById('add_additional_images_fields').innerHTML =
                ''; // Clear additional images fields
            addAdditionalImageIndex = 0; // Reset index
        });

        document.getElementById('editProductModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('editProductForm').reset();
            document.getElementById('edit_specification_fields').innerHTML = ''; // Clear spec fields
            document.getElementById('edit_additional_images_fields_existing').innerHTML =
                ''; // Clear existing additional images
            document.getElementById('edit_additional_images_fields_new').innerHTML =
                ''; // Clear new additional images
            document.getElementById('currentImagePreview').innerHTML = ''; // Clear current main image preview
            document.getElementById('currentImagePreview').style.display = 'none';
            document.getElementById('edit_image_preview_container').innerHTML = ''; // Clear new main image preview
            document.getElementById('edit_image_preview_container').style.display = 'none';
        });

        // Initial add spec field for add modal
        addSpecField('add_specification_fields', addSpecIndex++);
    </script>
@endpush
