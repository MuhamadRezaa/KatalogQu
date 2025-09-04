
        // JAVASCRIPT FUNCTIONS

        /**
         * Mengatur filter produk berdasarkan kategori yang dipilih.
         * @param {string} category - Kategori produk yang akan ditampilkan ('all', 'case', 'charger', dll.).
         * @param {Event} event - Objek event dari klik tombol.
         */
        function filterProducts(category, event) {
            const products = document.querySelectorAll('.product-card');
            const buttons = document.querySelectorAll('.category-btn');

            // Perbarui status tombol aktif
            buttons.forEach(btn => btn.classList.remove('active', 'bg-teal-500', 'text-white'));
            buttons.forEach(btn => btn.classList.add('bg-white', 'hover:bg-gray-200'));
            event.target.classList.add('active', 'bg-teal-500', 'text-white', 'hover:bg-teal-600');
            event.target.classList.remove('bg-white', 'hover:bg-gray-200');

            // Tampilkan atau sembunyikan produk sesuai kategori
            products.forEach(product => {
                if (category === 'all' || product.dataset.category === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        /**
         * Mencari produk berdasarkan kata kunci dari input pencarian.
         */
        function searchProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const products = document.querySelectorAll('.product-card');

            products.forEach(product => {
                const titleEl = product.querySelector('.product-title');
                const descEl = product.querySelector('.product-description');
                const title = titleEl ? titleEl.textContent.toLowerCase() : '';
                const description = descEl ? descEl.textContent.toLowerCase() : '';
                const category = product.dataset.category ? product.dataset.category.toLowerCase() : '';

                if (
                    title.includes(searchTerm) ||
                    description.includes(searchTerm) ||
                    category.includes(searchTerm)
                ) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        // Fungsionalitas tombol "Tambah ke Keranjang"
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function () {
                const productCard = this.closest('.product-card');
                const productTitle = productCard.dataset.name;

                // Feedback visual pada tombol
                this.textContent = 'Ditambahkan!';
                this.classList.remove('bg-teal-500', 'hover:bg-teal-600');
                this.classList.add('bg-green-500');

                setTimeout(() => {
                    this.textContent = 'Tambah ke Keranjang';
                    this.classList.remove('bg-green-500');
                    this.classList.add('bg-teal-500', 'hover:bg-teal-600');
                }, 1500);

                // console.log(${productTitle} ditambahkan ke keranjang.);

                // Anda bisa menambahkan logika di sini untuk mengirim data produk
                // ke keranjang belanja atau penyimpanan lokal.
            });
        });


        // Memicu fungsi pencarian saat tombol "Enter" ditekan
        document.getElementById('searchInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                searchProducts();
            }
        });

        // Modal universal untuk gambar, deskripsi, dan fitur
        function setupUniversalModal() {
            document.querySelectorAll('.show-modal').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const title = this.getAttribute('data-modal-title') || '';
                    const content = this.getAttribute('data-modal-content') || '';
                    document.getElementById('universalModalTitle').textContent = title;
                    document.getElementById('universalModalContent').innerHTML = content;
                    document.getElementById('universalModal').classList.remove('hidden');
                });
            });
            document.getElementById('closeUniversalModal').addEventListener('click', function () {
                document.getElementById('universalModal').classList.add('hidden');
            });
            document.getElementById('universalModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        }
        document.addEventListener('DOMContentLoaded', setupUniversalModal);

        // Memastikan tombol kategori awal disorot saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            const allButton = document.querySelector('.category-btn[onclick*="all"]');
            if (allButton) {
                allButton.classList.add('active', 'bg-teal-500', 'text-white', 'hover:bg-teal-600');
                allButton.classList.remove('bg-white', 'hover:bg-gray-200');
            }
        });
   