<?php

return [
    'default_provider' => env('WHATSVA_DEFAULT_PROVIDER', 'whatsva_id'),
    'providers' => [

        'whatsva_id' => [
            'instance_key' => env('WHATSVA_ID_INSTANCE_KEY'),
            'base_url' => env('WHATSVA_ID_BASE_URL', 'https://whatsva.id/api/sendMessageText'),
        ],

        'whatsva_com' => [
            'instance_key' => env('WHATSVA_COM_INSTANCE_KEY'),
            'base_url' => env('WHATSVA_COM_BASE_URL', 'https://whatsva.com/api/sendMessageText'),
        ],
    ],

    'admin_jids' => [
        env('WHATSVA_ADMIN1_JID'),
        env('WHATSVA_ADMIN2_JID'),
    ],

    'messages' => [
        'pengguna_mendaftar_akun' => <<<'TEXT'
            🌟 Halo {name}!

            Terima kasih telah mendaftar di *KatalogQu*.
            Kami sangat senang menyambut Anda sebagai bagian dari komunitas kami.
            Selamat berjualan dan semoga sukses bersama KatalogQu!
            TEXT,

        'admin_notifikasi_pengguna_baru' => <<<'TEXT'
            👥 [Admin] Pengguna baru telah bergabung dengan KatalogQu.

            *Nama:* {name}
            *Email:* {email}
            *Nomor Telepon:** {phone_number}
            TEXT,

        'setelah_checkout' => <<<'TEXT'
            ✅ Halo {name},

            Pesanan Anda dengan ID *{order_id}* telah *berhasil dibayar*!
            Total pembayaran: *{total_amount}*.
            Anda bisa melanjutkan ke tahap *SETUP TOKO*. Terima kasih telah berbelanja di KatalogQu!
            TEXT,

        'admin_notifikasi_pesanan_baru' => <<<'TEXT'
            🛒 [Admin] Pesanan baru diterima!

            *ID Pesanan:* {order_id}
            *Nama Pelanggan:* {name}
            *Total:* {total_amount}
            TEXT,

        'setup_toko_selesai' => <<<'TEXT'
            🏪 Halo {name},

            Setup toko Anda *{store_name}* telah *berhasil diselesaikan*!
            Mohon menunggu proses aktivasi subdomain toko aktif hingga 1 jam.
            Terima kasih telah bergabung dengan KatalogQu!
            TEXT,

        'admin_notifikasi_toko_baru' => <<<'TEXT'
            🆕 [Admin] Toko baru telah dibuat!

            *Nama Toko:* {store_name}
            *Subdomain:* {subdomain}
            *Pemilik:* {name}
            *Email:* {email}
            TEXT,

        'toko_aktif' => <<<'TEXT'
            🎉 Halo {name},

            Toko Anda *{store_name}* telah *aktif!*
            Masa aktif: {activated_at} — {expires_at}.
            Nikmati berbagai fitur premium dan kelola toko Anda sebaik mungkin!
            TEXT,

        'admin_notifikasi_toko_aktif' => <<<'TEXT'
            ⚙️ [Admin] Aktivasi toko berhasil!

            *Nama Toko:* {store_name}
            *Masa Aktif:* {activated_at} — {expires_at}
            *Pemilik:* {name}
            *Email:* {email}
            TEXT,

        'perpanjangan_berhasil_pengguna' => <<<'TEXT'
            🚀 Halo {name},

            Perpanjangan masa aktif toko *{store_name}* Anda telah *berhasil*!
            Masa aktif baru toko Anda sekarang hingga *{new_expires_at}*.
            Terima kasih telah melanjutkan perjalanan Anda bersama KatalogQu!
            TEXT,

        'admin_notifikasi_perpanjangan_berhasil' => <<<'TEXT'
            ⚙️ [Admin] Perpanjangan toko berhasil.

            *Nama Toko:* {store_name}
            *Pemilik:* {name} ({email})
            *Masa Aktif Baru:* Hingga {new_expires_at}
            TEXT,

        'pengingat_masa_aktif_pengguna_7_hari' => <<<'TEXT'
            ⏰ Halo {name},

            Masa aktif toko *{store_name}* akan berakhir dalam *7 hari* (hingga *{expires_at}*).
            Pastikan untuk memperpanjang masa aktif toko Anda agar tetap bisa diakses pelanggan tanpa gangguan.

            Klik tautan berikut untuk memperpanjang sekarang:
            {renew_link}

            Terima kasih telah menggunakan *KatalogQu*!
            TEXT,

        'pengingat_masa_aktif_admin_7_hari' => <<<'TEXT'
            ⚙️ [Admin Info] Pengingat masa aktif toko.

            Toko *{store_name}* milik *{name} ({email})* akan berakhir dalam *7 hari* (hingga *{expires_at}*).
            Mohon lakukan konfirmasi atau pantau status perpanjangan pengguna di dashboard admin.
            TEXT,

        'pengingat_masa_aktif_pengguna_3_hari' => <<<'TEXT'
            🔔 Halo {name},

            Masa aktif toko *{store_name}* akan berakhir dalam *3 hari* lagi (hingga *{expires_at}*).
            Segera lakukan perpanjangan agar toko Anda tidak dinonaktifkan sementara.

            Lanjutkan proses perpanjangan melalui tautan berikut:
            {renew_link}

            Salam sukses dari tim *KatalogQu*!
            TEXT,

        'pengingat_masa_aktif_admin_3_hari' => <<<'TEXT'
            ⚙️ [Admin Info] Masa aktif toko segera habis.

            Toko *{store_name}* milik *{name} ({email})* akan berakhir dalam *3 hari* (hingga *{expires_at}*).
            Cek status pembayaran atau hubungi pengguna jika belum melakukan perpanjangan.
            TEXT,

        'pengingat_masa_aktif_pengguna_1_hari' => <<<'TEXT'
            ⚠️ Halo {name},

            Masa aktif toko *{store_name}* akan *berakhir besok* (tanggal *{expires_at}*).
            Segera lakukan perpanjangan hari ini untuk menghindari penutupan sementara.

            Perpanjang sekarang melalui tautan berikut:
            {renew_link}

            Terima kasih telah tetap berjualan bersama *KatalogQu*.
            TEXT,

        'pengingat_masa_aktif_admin_1_hari' => <<<'TEXT'
            ⚙️ [Admin Info] Masa aktif toko hampir berakhir.

            Toko *{store_name}* milik *{name} ({email})* akan *berakhir besok* (tanggal *{expires_at}*).
            Pastikan sistem mengirimkan pengingat terakhir dan siapkan tindakan penonaktifan otomatis bila diperlukan.
            TEXT,

        // === PASCA MASA AKTIF (KEDALUWARSA) ===
        'overdue_pengguna_hari_h' => <<<'TEXT'
            ⛔ Halo {name},

            Masa aktif toko *{store_name}* telah *berakhir hari ini* (tanggal {expires_at}) dan toko Anda sementara *dinonaktifkan*.
            Anda masih memiliki waktu *7 hari* untuk memperpanjang sebelum toko dihapus secara permanen.

            Lakukan perpanjangan sekarang melalui tautan berikut:
            {renew_link}

            Salam dari tim *KatalogQu*.
            TEXT,

        'overdue_admin_hari_h' => <<<'TEXT'
            ⚙️ [Admin] Toko telah kedaluwarsa dan dinonaktifkan.

            *Nama Toko:* {store_name}
            *Pemilik:* {name} ({email})
            *Tanggal Kedaluwarsa:* {expires_at}
            *Status:* Dinonaktifkan (masa tenggang 7 hari).
            TEXT,

        'overdue_pengguna_hari_3' => <<<'TEXT'
            ⏳ Halo {name},

            Toko *{store_name}* telah melewati masa aktif selama *{days_overdue} hari* (kedaluwarsa pada {expires_at}) dan masih dinonaktifkan.
            Sisa waktu Anda hanya *{days_left} hari* sebelum toko dihapus secara permanen pada *{deletion_date}*.

            Segera perpanjang masa aktif melalui tautan berikut:
            {renew_link}
            TEXT,

        'overdue_admin_hari_3' => <<<'TEXT'
            ⚙️ [Admin] Toko masih dalam masa tenggang (hari ke-{days_overdue}).

            *Nama Toko:* {store_name}
            *Pemilik:* {name} ({email})
            *Tanggal Kedaluwarsa:* {expires_at}
            *Jadwal Penghapusan:* {deletion_date}
            *Catatan:* Mohon tindak lanjut atau hubungi pengguna bila diperlukan.
            TEXT,

        'overdue_pengguna_hari_6' => <<<'TEXT'
            ⚠️ Peringatan Terakhir, {name}!

            Toko *{store_name}* akan *dihapus secara permanen besok* (tanggal *{deletion_date}*).
            Setelah dihapus, seluruh data toko tidak dapat dipulihkan.

            Perpanjang sekarang sebelum terlambat:
            {renew_link}
            TEXT,

        'overdue_admin_hari_6' => <<<'TEXT'
            ⚙️ [Admin] Peringatan H-1 sebelum penghapusan toko.

            *Nama Toko:* {store_name}
            *Pemilik:* {name} ({email})
            *Jadwal Penghapusan:* {deletion_date}
            *Tindakan Sistem:* Penjadwalan penghapusan dan pembersihan data.
            TEXT,

        'overdue_pengguna_hari_7_terhapus' => <<<'TEXT'
            🗑️ Konfirmasi Penghapusan

            Toko *{store_name}* telah *dihapus secara permanen* pada *{deletion_date}* karena tidak diperpanjang dalam waktu 7 hari setelah masa aktif berakhir (*{expires_at}*).
            Jika penghapusan ini tidak Anda harapkan, silakan hubungi tim bantuan kami.

            Hubungi tim bantuan:
            {support_link}
            TEXT,

        'overdue_admin_hari_7_terhapus' => <<<'TEXT'
            ⚙️ [Admin] Toko telah dihapus secara permanen.

            *Nama Toko:* {store_name}
            *Pemilik:* {name} ({email})
            *Tanggal Kedaluwarsa:* {expires_at}
            *Tanggal Penghapusan:* {deletion_date}
            *Catatan:* Penghapusan berhasil dan dicatat di log sistem.
            TEXT,

    ],

];
