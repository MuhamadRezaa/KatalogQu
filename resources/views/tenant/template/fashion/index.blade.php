<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if ($userStore && $userStore->store_logo)
        <link rel="icon" href="{{ route('tenant.asset.domain', ['path' => ltrim($userStore->store_logo, '/')]) }}">
        <link rel="shortcut icon" href="{{ route('tenant.asset.domain', ['path' => ltrim($userStore->store_logo, '/')]) }}">
    @else
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @endif
    <title>{{ $userStore->store_name ?? 'E-Katalog Fashion' }}</title>

    <meta name="description" content="Demo katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini">
    <meta name="keywords" content="fashion, clothing, style, trends, catalog, online shopping, apparel, accessories">
    <meta name="author" content="Fashion E-Catalog">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Fashion E-Catalog Demo">
    <meta property="og:description" content="Demo katalog fashion dengan koleksi lengkap pakaian dan aksesoris terkini">
    <meta property="og:type" content="website">
    <meta property="og:image" content="images/og-image.jpg">


    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/demo/fashion/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="nav-brand">
                <div class="brand-icon">
                    @if ($userStore && $userStore->store_logo)
                        <img class="brand-logo"
                            src="{{ route('tenant.asset.domain', ['path' => ltrim($userStore->store_logo, '/')]) }}"
                            alt="{{ $userStore->store_name ?? 'Store Logo' }}" loading="lazy" decoding="async">
                    @else
                        <img class="brand-logo" src="{{ asset('assets/images/no-image-icon.png') }}"
                            alt="{{ $userStore->store_name ?? 'Fashion Store Logo' }}" loading="lazy" decoding="async">
                    @endif
                </div>
                <span class="brand-text">{{ $userStore->store_name ?? 'Fashion Store' }}</span>
            </a>
            <div class="nav-actions">
            </div>
        </div>
    </nav>

    <style>
        .brand-logo {
            height: 40px;
            width: 40px;
            object-fit: contain;
        }

        @media (min-width: 640px) {
            .brand-logo {
                height: 50px;
                width: 50px;
            }
        }

        .hero-tagline {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 1rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            transition: opacity 0.5s ease-in-out;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            transition: opacity 0.5s ease-in-out;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            font-weight: 400;
            opacity: 0.8;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);
            transition: opacity 0.5s ease-in-out;
        }

        @media (max-width: 768px) {
            .hero-tagline {
                font-size: 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }
        }

        .hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swiper-container {
            width: 100%;
            height: 100vh;
            position: relative;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 3;
            text-align: center;
            color: white;
            width: 90%;
            max-width: 800px;
            padding: 2rem;
        }

        .swiper-pagination {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 4;
        }

        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
            width: 12px;
            height: 12px;
            margin: 0 6px;
        }

        .swiper-pagination-bullet-active {
            background: #808080;
            transform: scale(1.2);
        }

        .swiper-button-prev,
        .swiper-button-next {
            color: white !important;
            background: rgba(0, 0, 0, 0.5) !important;
            width: 50px !important;
            height: 50px !important;
            border-radius: 50% !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            z-index: 10 !important;
            margin-top: -25px !important;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .swiper-button-prev:hover,
        .swiper-button-next:hover {
            color: white !important;
            background: rgba(128, 128, 128, 0.9) !important;
            transform: scale(1.1);
            border-color: rgba(128, 128, 128, 0.8);
        }

        .swiper-button-prev::after,
        .swiper-button-next::after {
            font-size: 16px !important;
            font-weight: bold;
        }

        .swiper-button-prev {
            left: 20px !important;
        }

        .swiper-button-next {
            right: 20px !important;
        }

        @media (max-width: 768px) {
            .swiper-container {
                height: 60vh;
            }

            .hero-content {
                padding: 1rem;
            }

            .swiper-button-prev,
            .swiper-button-next {
                display: none;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .swiper-container {
                height: 80vh;
            }
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .bg-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }

        .bg-image::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(0, 0, 0, 0.3) 100%);
            opacity: 0.8;
        }

        /* Category Grid - Locked Dimensions with Responsive Layout */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Category Card - Fixed Dimensions - Override External CSS */
        .category-card {
            background: linear-gradient(135deg, #f8f9fa 0%, rgba(255, 255, 255, 0.95) 100%) !important;
            border: 2px solid #e9ecef !important;
            border-radius: 16px !important;
            padding: 2rem 1.5rem !important;
            text-align: center !important;
            cursor: pointer !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative !important;
            overflow: hidden !important;
            
            /* Locked dimensions - Override external max-width */
            min-height: 180px !important;
            max-height: 180px !important;
            height: 180px !important;
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            
            /* Flexbox for consistent content alignment */
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            align-items: center !important;
            
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #d4af37 0%, #e8b86d 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .category-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: #d4af37;
        }

        .category-card:hover::before {
            opacity: 0.1;
        }

        .category-card.active {
            background: #d4af37;
            color: #2c3e50;
            border-color: #d4af37;
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(212, 175, 55, 0.3);
        }

        .category-card.active::before {
            opacity: 1;
        }

        .category-name {
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            
            /* Text overflow handling */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
        }

        .category-description {
            font-size: 0.9rem;
            color: #6c757d;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            
            /* Multi-line text handling */
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            line-height: 1.4;
            max-height: 2.8rem;
        }

        .category-card:hover .category-name,
        .category-card:hover .category-description {
            color: #d4af37;
            transform: translateY(-2px);
        }

        .category-card.active .category-name,
        .category-card.active .category-description {
            color: #2c3e50;
        }

        /* Responsive Breakpoints */
        
        /* Tablet (768px - 1024px) */
        @media (max-width: 1024px) and (min-width: 769px) {
            .category-grid {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 1.25rem !important;
            }
            
            .category-card {
                min-height: 160px !important;
                max-height: 160px !important;
                height: 160px !important;
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 1.5rem 1rem !important;
            }
            
            .category-name {
                font-size: 1.1rem !important;
            }
            
            .category-description {
                font-size: 0.85rem !important;
            }
        }

        /* Mobile (max-width: 768px) */
        @media (max-width: 768px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 1rem !important;
                padding: 0 0.5rem !important;
            }
            
            .category-card {
                min-height: 140px !important;
                max-height: 140px !important;
                height: 140px !important;
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 1.25rem 0.75rem !important;
            }
            
            .category-name {
                font-size: 1rem !important;
                margin-bottom: 0.25rem !important;
            }
            
            .category-description {
                font-size: 0.8rem !important;
                -webkit-line-clamp: 2 !important;
                max-height: 2.4rem !important;
            }
        }

        /* Small Mobile (max-width: 480px) */
        @media (max-width: 480px) {
            .category-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.75rem !important;
                padding: 0 0.25rem !important;
            }
            
            .category-card {
                min-height: 120px !important;
                max-height: 120px !important;
                height: 120px !important;
                width: 100% !important;
                max-width: none !important;
                margin: 0 !important;
                padding: 1rem 0.5rem !important;
            }
            
            .category-name {
                font-size: 0.9rem !important;
                margin-bottom: 0.25rem !important;
            }
            
            .category-description {
                font-size: 0.75rem;
                -webkit-line-clamp: 1;
                max-height: 1.2rem;
            }
        }

        /* Legacy category styling overrides */
        .category-grid.category-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .category-grid.category-carousel {
            display: flex;
            overflow-x: auto;
            gap: 1rem;
            padding-bottom: 0.5rem;
        }

        .category-rounded .category-card {
            border-radius: 12px;
        }

        .category-square .category-card {
            border-radius: 4px;
        }

        .category-circle .category-card {
            border-radius: 50%;
            aspect-ratio: 1;
        }

        .product-image-rounded {
            border-radius: 12px;
        }

        .product-image-square {
            border-radius: 4px;
        }

        .product-image-circle {
            border-radius: 50%;
            aspect-ratio: 1;
            object-fit: cover;
        }

        .pagination-links {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 12px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination li.active span {
            background-color: #333;
            color: #fff;
            border-color: #333;
        }

        .pagination li.disabled span {
            color: #aaa;
            background-color: #f5f5f5;
        }

        .footer-brand-container {
            height: 50px;
            width: 50px;
        }

        .footer-logo {
            height: 100%;
            width: 100%;
            object-fit: contain;
        }

        .product-image {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        .no-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            color: #666;
            font-size: 1rem;
            border-radius: 8px;
        }

        .modal-product-image {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 12px;
            background: #f8f9fa;
        }

        .modal-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
        }

        .modal-product-image .no-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
            color: #999;
            font-size: 1.2rem;
            border-radius: 12px;
        }

        .product-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease-out;
            padding: 2rem;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .product-modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
        }

        .modal-container {
            position: fixed;
            background-color: #fff;
            border-radius: 16px;
            width: 100%;
            max-width: 1000px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            margin: auto;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
            transition: color 0.2s ease;
        }

        .modal-close:hover,
        .modal-close:focus {
            color: #000;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .product-modal {
                padding: 1rem;
            }

            .modal-container {
                margin: 10px;
                width: calc(100% - 20px);
            }

            .modal-close {
                top: 10px;
                right: 15px;
                font-size: 24px;
            }
        }

        .modal-product-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 2rem;
        }

        .modal-product-category {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 0.5rem;
        }

        .category-name {
            font-weight: 600;
            color: #555;
        }

        .subcategory-name {
            color: #888;
            font-weight: 400;
        }

        .modal-product-sku {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.3rem;
        }

        .modal-product-brand {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .modal-product-name {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .price-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .modal-product-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: #e74c3c;
        }

        /* Promo badge di area harga */
        .promo-badge {
            display: inline-block;
            background: #ff6f00;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 4px 8px;
            border-radius: 999px;
            letter-spacing: 0.5px;
        }

        /* Promo badge di pojok kiri atas modal */
        .modal-promo-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #ff6f00;
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            padding: 6px 10px;
            border-radius: 6px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
            z-index: 10;
        }

        .modal-product-old-price {
            font-size: 1.2rem;
            color: #999;
            text-decoration: line-through;
            font-weight: 400;
        }

        /* Harga di kartu produk */
        .product-price {
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .product-old-price {
            color: #999;
            text-decoration: line-through;
            font-weight: 400;
            margin-right: 8px;
            white-space: nowrap;
        }

        .product-current-price {
            color: #333;
            font-weight: 700;
            white-space: nowrap;
        }

        .modal-section {
            margin-bottom: 1.5rem;
        }

        .modal-section h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .modal-section p {
            line-height: 1.6;
            color: #555;
        }

        .sizes-list, .colors-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        /* Animasi ringan untuk konten modal */
        .modal-product-details,
        .modal-product-image,
        .modal-product-info,
        .similar-card {
            animation: slideIn 0.45s ease both;
        }
        .similar-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .similar-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.12);
        }

        .size-tag, .color-tag {
            background: #f0f0f0;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid #ddd;
        }

        .stock-info.in-stock { color: #28a745; }
        .stock-info.low-stock { color: #ffc107; }
        .stock-info.out-of-stock { color: #dc3545; }

        .image-gallery {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .gallery-thumbnails {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            padding: 0.5rem 0;
        }

        .gallery-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .gallery-thumb:hover {
            border-color: #007bff;
            opacity: 0.8;
        }

        .gallery-thumb.active {
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        .modal-error {
            text-align: center;
            padding: 3rem 2rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .error-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .modal-error h3 {
            color: #dc3545;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .modal-error p {
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-retry {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-retry:hover {
            background: #0056b3;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-contact {
            flex: 1;
            background: linear-gradient(135deg, #25d366, #128c7e);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 2px 8px rgba(37, 211, 102, 0.2);
            text-decoration: none;
            width: 100%;
            margin-bottom: 12px;
        }

        .btn-contact:hover {
            background: linear-gradient(135deg, #128c7e, #25d366);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
        }

        .btn-contact i {
            font-size: 1.2rem;
        }

        .modal-product-actions {
            margin-top: 2rem;
        }

        /* Produk Serupa (Modal) */
        .modal-similar-section {
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px dashed #e6e6e6;
        }

        .modal-similar-section h3 {
            font-size: 1.1rem;
            margin: 0 0 12px 0;
            color: #2c3e50;
        }

        .similar-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
        }

        .similar-card {
            cursor: pointer;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            background: #fff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .similar-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .similar-image {
            height: 100px;
            background: #f8f8f8;
        }

        .similar-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .similar-info {
            padding: 8px;
        }

        .similar-name {
            font-size: 0.85rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .similar-price {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .modal-product-details {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 1rem;
            }

            .modal-product-name {
                font-size: 1.5rem;
            }

            .modal-product-price {
                font-size: 1.4rem;
            }

            /* Harga pada kartu produk, kecilkan di mobile */
            .product-current-price { font-size: 0.95rem; }
            .product-old-price { font-size: 0.85rem; }

            /* Heading responsif di mobile */
            .hero-title { font-size: 1.75rem; }
            .hero-subtitle { font-size: 1rem; }
            .section-title h2 { font-size: 1.4rem; }
            .section-title p { font-size: 0.95rem; }

            .main-image {
                height: 250px;
            }

            .modal-actions {
                flex-direction: column;
            }
        }

        /* Gaya paginasi Laravel agar konsisten seperti pagination numerik */
        .pagination-links nav { display: flex; justify-content: center; margin-top: 16px; }
        .pagination-links ul.pagination { display: flex; gap: 8px; }
        .pagination-links a, .pagination-links span {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-weight: 600;
            color: #374151;
            text-decoration: none;
            background: #fff;
        }
        .pagination-links a:hover { background: #f9fafb; }
        .pagination-links span[aria-current="page"], .pagination-links .active span {
            background: #111;
            color: #fff;
            border-color: #111;
        }
    </style>

    {{-- Hero Section dengan Swiper.js --}}
    <section class="hero">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @forelse ($banners as $banner)
                    <div class="swiper-slide">
                        <div class="bg-image"
                            style="background-image: url('{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}');">
                        </div>
                        <div class="hero-overlay"></div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="bg-image" style="background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);">
                        </div>
                        <div class="hero-overlay"></div>
                    </div>
                @endforelse
            </div>

            {{-- Hero Content --}}
            <div class="hero-content">
                <h1 id="heroTitle"
                    class="text-4xl md:text-6xl lg:text-8xl font-bold mb-4 hero-title transition-opacity duration-500">
                    {!! $banners->first()->title ?? ($userStore->store_name ?? 'Fashion Store') !!}
                </h1>
                <p id="heroSubtitle"
                    class="text-xl md:text-2xl lg:text-3xl mb-8 hero-subtitle transition-opacity duration-500">
                    {!! $banners->first()->subtitle ?? 'Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti' !!}
                </p>
                @if ($banners->first() && $banners->first()->link)
                    <a id="heroButton" href="{{ $banners->first()->link }}"
                        class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-4 px-8 rounded-lg transition-all duration-300 text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                        {{ $banners->first()->button_text ?? 'Lihat Koleksi' }}
                    </a>
                @endif
            </div>

            {{-- Navigation Buttons --}}
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            {{-- Pagination --}}
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <main class="container">
        <section class="section">
            <div class="section-title">
                <h2 id="categoryTitle">Kategori</h2>
                <p id="categorySubtitle">Pilih kategori produk yang Anda inginkan</p>
            </div>

            <div class="category-grid" id="categoryGrid">
                <div class="category-card active" data-category-id="all">
                    <div class="category-name">Semua Produk</div>
                    <div class="category-description">Lihat semua produk yang tersedia</div>
                </div>
                @foreach ($categories as $category)
                    <div class="category-card" data-category-id="{{ $category->id }}">
                        <div class="category-name">{{ $category->name }}</div>
                        <div class="category-description">{{ $category->description }}</div>
                    </div>
                @endforeach
            </div>

            <div class="subcategory-section" id="subcategorySection" style="display: none;">
                <div class="section-title">
                    <h3>Sub Kategori</h3>
                    <p>Pilih sub kategori untuk filter lebih spesifik</p>
                </div>
                <div class="subcategory-grid" id="subcategoryGrid">
                    {{-- Subkategori akan dimuat di sini oleh jQuery --}}
                </div>
            </div>

            <div id="searchContainer" class="search-container">
                <div class="search-and-filters-wrapper">
                    <div class="search-wrapper">
                        <input type="text" id="searchInput" placeholder="Cari produk...">
                    </div>

                    <div class="filters-section">
                        <div class="filter-group">
                            <label for="sortPrice">Urutkan Harga:</label>
                            <select id="sortPrice">
                                <option value="">-- Pilih --</option>
                                <option value="price_low">Harga Terendah</option>
                                <option value="price_high">Harga Tertinggi</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortName">Urutkan Nama:</label>
                            <select id="sortName">
                                <option value="">-- Pilih --</option>
                                <option value="name">A - Z</option>
                                <option value="name_desc">Z - A</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="sortDate">Urutkan Tanggal:</label>
                            <select id="sortDate">
                                <option value="">-- Pilih --</option>
                                <option value="newest">Terbaru</option>
                                <option value="oldest">Terlama</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="priceRange">Rentang Harga:</label>
                            <select id="priceRange">
                                <option value="">-- Semua Harga --</option>
                                @foreach (($priceRanges ?? []) as $range)
                                    @php
                                        $min = $range->min;
                                        $max = $range->max;
                                        $label = $range->name;
                                        $value = ($min !== null ? $min : '') . '-' . ($max !== null ? $max : '');
                                    @endphp
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="section-title">
                <h2 id="productTitle">Semua Produk</h2>
                <p id="productSubtitle">Jelajahi koleksi lengkap kami</p>
            </div>

            {{-- Menggunakan Blade untuk render produk dari server --}}
            <div class="products-grid" id="productsGrid" style="transition: opacity 0.25s ease;">
                @forelse ($products as $product)
                    @php
                        $imagePath = $product->image ?? ($product->productImages->first()->image_path ?? null);
                        $imageUrl = $imagePath
                            ? url('tenancy/assets') . '/' . trim($imagePath, '/')
                            : 'https://via.placeholder.com/200?text=No+Image';
                        $formattedPrice = 'Rp ' . number_format($product->price, 0, ',', '.');
                        $oldPrice = $product->old_price ? ('Rp ' . number_format($product->old_price, 0, ',', '.')) : null;
                        $showOldPrice = $product->old_price && $product->old_price > $product->price;
                        $isPromo = (bool) $product->is_promo;
                        $brandName = optional($product->brand)->name;
                    @endphp
                    <div class="product-card" data-product-id="{{ $product->id }}" data-brand="{{ $brandName }}"
                        onclick="showProductDetails({{ $product->id }})">
                        <div class="product-image" style="position: relative;">
                            @if ($isPromo)
                                <div class="modal-promo-badge">PROMO</div>
                            @endif
                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" loading="lazy"
                                onerror="this.onerror=null; this.src='https://via.placeholder.com/200?text=No+Image'; this.style.opacity='1';"
                                onload="this.style.opacity='1';" style="opacity: 0; transition: opacity 0.3s ease;">
                        </div>
                        <div class="product-info">
                            <div class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                            <div class="product-name">{{ $product->name }}</div>
                            @if(!empty($brandName))
                                <div class="product-brand" style="font-size: 0.85rem; color: #6b7280; margin-top: 2px;">Brand: {{ $brandName }}</div>
                            @endif
                            <div class="product-price">
                                @if ($showOldPrice)
                                    <span class="product-old-price">{{ $oldPrice }}</span>
                                @endif
                                <span class="product-current-price">{{ $formattedPrice }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div id="noResults" class="no-results" style="display: block; grid-column: 1 / -1;">
                        <h3>Produk yang Anda cari tidak ditemukan</h3>
                        <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
                    </div>
                @endforelse
            </div>

            {{-- Tombol Lihat Selengkapnya untuk tampilan bertahap --}}
            <!-- Progressive show-more dihapus, gunakan paginasi server -->
            <div class="show-more-container" style="display:none;"></div>

            {{-- Link paginasi --}}
            <div class="pagination-links">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </section>

    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left-content">
                <div class="footer-logo-section">
                    <div class="footer-brand-container">
                        @if ($userStore && $userStore->store_logo)
                            <img id="footerStoreLogo" class="footer-logo"
                                src="{{ route('tenant.asset.domain', ['path' => ltrim($userStore->store_logo, '/')]) }}"
                                alt="{{ $userStore->store_name ?? 'Store Logo' }}" loading="lazy" decoding="async">
                        @else
                            <img id="footerStoreLogo" class="footer-logo"
                                src="{{ asset('assets/demo/fashion/img/temp/logo-fashion.png') }}"
                                alt="{{ $userStore->store_name ?? 'Fashion Store Logo' }}" loading="lazy" decoding="async">
                        @endif
                    </div>
                </div>
                <div class="footer-section footer-text-content">
                    <h3 id="footerStoreName">{{ $userStore->store_name ?? 'Fashion Store' }}</h3>
                    <p id="footerStoreDescription">
                        {{ $userStore->store_description ?? 'A place to find your best fashion.' }}
                    </p>
                </div>
            </div>
            <div class="footer-middle-space">
            </div>
            <div class="footer-section footer-contact">
                <h3>Informasi Kontak</h3>
                <div class="contact-item">
                    <i class="contact-icon">📞</i>
                    <span id="footerStorePhone">{{ $userStore->store_phone ?? 'Nomor Telepon Tidak Tersedia' }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">✉</i>
                    <span id="footerStoreEmail">{{ $userStore->store_email ?? 'Alamat Email Tidak Tersedia' }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">📍</i>
                    <span id="footerStoreAddress">{{ $userStore->store_address ?? 'Alamat Tidak Tersedia' }}</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
    <p>© 2025 Powered by PT. Era Cipta Digital</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const grid = document.getElementById('productsGrid');
            if (!grid) return;
            const cards = Array.from(grid.querySelectorAll('.product-card'));
            const btn = document.getElementById('tenantShowMoreBtn');
            let visibleCount = 20;

            const applyVisibility = () => {
                cards.forEach((card, idx) => {
                    card.style.display = idx < visibleCount ? '' : 'none';
                });
                if (cards.length > visibleCount) {
                    btn.style.display = 'inline-flex';
                } else {
                    btn.style.display = 'none';
                }
            };

            applyVisibility();
            if (btn) {
                btn.addEventListener('click', () => {
                    visibleCount += 20;
                    applyVisibility();
                    grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            }
        });
    </script>

    <!-- Product Modal -->
    <div id="productModal" class="product-modal">
        <div class="modal-container">
            <span class="modal-close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <div id="loadingOverlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <p>Memuat data...</p>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        // ===== KONFIGURASI YANG DAPAT DIKUSTOMISASI OLEH ADMIN =====

        // Konfigurasi Hero Section - Menggunakan data banner dari database
        const heroConfig = {
            slides: [
                @forelse ($banners as $banner)
                    {
                        title: "{{ $banner->title ?? ($userStore->store_name ?? 'Fashion Store') }}",
                        subtitle: "{{ $banner->subtitle ?? 'Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti' }}",
                        background: "{{ route('tenant.asset.domain', ['path' => $banner->image_url]) }}"
                    }{{ !$loop->last ? ',' : '' }}
                @empty
                    {
                        title: "{{ $userStore->store_name ?? 'Fashion Store' }}",
                        subtitle: "Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti",
                        background: "https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                    }
                @endforelse
            ]
        };

        // Konfigurasi Informasi Toko
        const storeConfig = {
            name: "{{ $userStore->store_name ?? 'Fashion Store' }}",
            description: "{{ $userStore->store_description ?? 'Temukan koleksi fashion terbaru dan terbaik untuk gaya hidup Anda.' }}",
            phone: "{{ $userStore->store_phone ?? '+62 123 456 789' }}",
            email: "{{ $userStore->store_email ?? 'info@fashionstore.com' }}",
            address: "{{ $userStore->store_address ?? 'Jakarta, Indonesia' }}",
            logo: "{{ $userStore->store_logo ? route('tenant.asset.domain', ['tenant' => $userStore->tenant_id, 'path' => $userStore->store_logo]) : '' }}",
            logoPath: "{{ $userStore->store_logo ?? '' }}"
        };

        // Konfigurasi Kategori yang Dapat Dikustomisasi
        const categoryConfig = {
            showAllCategory: {{ $storeSettings->show_all_category ?? 'true' }},
            allCategoryText: "{{ $storeSettings->all_category_text ?? 'Semua Kategori' }}",
            categoryDisplayStyle: "{{ $storeSettings->category_display_style ?? 'grid' }}",
            maxCategoriesPerRow: {{ $storeSettings->max_categories_per_row ?? 4 }},
            showCategoryIcons: {{ $storeSettings->show_category_icons ?? 'true' }},
            categoryIconStyle: "{{ $storeSettings->category_icon_style ?? 'rounded' }}"
        };

        // Konfigurasi Produk yang Dapat Dikustomisasi
        const productConfig = {
            productsPerPage: {{ $storeSettings->products_per_page ?? 12 }},
            showProductPrice: {{ $storeSettings->show_product_price ?? 'true' }},
            showProductDescription: {{ $storeSettings->show_product_description ?? 'true' }},
            productImageStyle: "{{ $storeSettings->product_image_style ?? 'rounded' }}",
            enableProductModal: {{ $storeSettings->enable_product_modal ?? 'true' }},
            showContactSeller: {{ $storeSettings->show_contact_seller ?? 'true' }},
            contactButtonText: "{{ $storeSettings->contact_button_text ?? 'Hubungi Penjual' }}"
        };

        // Data dari Blade disiapkan untuk JavaScript
        const allCategories = @json($categories);
        const allSubcategories = @json($subCategories);
        const allProducts = @json($products->items());

        // Current filter state
        let currentCategoryId = 'all';
        let currentSubcategoryId = null;
        let currentSearchTerm = '';

        // Tenant Asset Helper Function
        const tenantAssetBase = "{{ url('tenancy/assets') }}/";

        const tenantAssetUrl = (p) => {
            let path = (p || '')
                .replace(/^storage\/+/i, '')
                .replace(/^\/+/, '')
                .replaceAll('\\', '/');
            return tenantAssetBase + encodeURI(path);
        };

        const ASSET_URL = tenantAssetBase;

        // Loading overlay functions menggunakan jQuery
        function showLoadingOverlay() {
            $('#loadingOverlay').fadeIn(300);
        }

        function hideLoadingOverlay() {
            $('#loadingOverlay').fadeOut(300);
        }

        $(document).ready(function() {
            // --- FUNGSI-FUNGSI UTAMA ---

            // Helper: smooth scroll dengan durasi dan offset
            function smoothScrollTo(targetEl, offset = 0, duration = 600) {
                if (!targetEl) return;
                const start = window.scrollY || window.pageYOffset;
                const target = (targetEl.getBoundingClientRect().top + start) + offset;
                const distance = target - start;
                const startTime = performance.now();

                const easeInOutQuad = (t) => (t < 0.5) ? (2 * t * t) : (1 - Math.pow(-2 * t + 2, 2) / 2);

                function step(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const eased = easeInOutQuad(progress);
                    window.scrollTo(0, start + distance * eased);
                    if (progress < 1) requestAnimationFrame(step);
                }

                requestAnimationFrame(step);
            }

            // Fungsi untuk menerapkan filter TANPA reload penuh (AJAX only update products)
            async function applyFilterAndReload(page = 1) {
                const baseUrl = "{{ url()->current() }}";
                const params = new URLSearchParams();

                // Kategori
                const activeCategory = $('.category-card.active');
                if (activeCategory.length && activeCategory.data('category-id') !== 'all') {
                    params.set('category', activeCategory.data('category-id'));
                }

                // Subkategori
                const activeSubcategory = $('.subcategory-card.active');
                if (activeSubcategory.length && activeSubcategory.data('subcategory-id')) {
                    params.set('subcategory', activeSubcategory.data('subcategory-id'));
                }

                // Pencarian
                const searchTerm = $('#searchInput').val();
                if (searchTerm) {
                    params.set('search', searchTerm);
                }

                // Urutan
                const sortPrice = $('#sortPrice').val();
                const sortName = $('#sortName').val();
                const sortDate = $('#sortDate').val();

                if (sortPrice) params.set('sort', sortPrice);
                else if (sortName) params.set('sort', sortName);
                else if (sortDate) params.set('sort', sortDate);

                // Rentang harga dari controller (admin dapat unggah)
                const rangeVal = $('#priceRange').val();
                if (rangeVal) {
                    const [min, max] = rangeVal.split('-');
                    if (min !== undefined && min !== '') params.set('price_min', min);
                    if (max !== undefined && max !== '') params.set('price_max', max);
                } else {
                    params.delete('price_min');
                    params.delete('price_max');
                }

                // Tambahkan page jika ada
                if (page && Number(page) > 0) {
                    params.set('page', Number(page));
                }

                // Update URL tanpa reload agar user bisa share link
                try {
                    history.replaceState(null, '', `${baseUrl}?${params.toString()}`);
                } catch (e) { /* noop */ }

                // Muat produk via AJAX
                await loadProductsAjax(params);
            }

            // Ambil data produk dari server dan render ke grid tanpa reload
            async function loadProductsAjax(params) {
                const $grid = $('#productsGrid');
                const $pagination = $('.pagination-links');
                if (!$grid.length) return;

                // Efek loading ringan pada grid saja
                $grid.css('opacity', 0.4);
                try {
                    const url = `${window.location.origin}/filter-products?${params.toString()}`;
                    const resp = await fetch(url, { headers: { 'Accept': 'application/json' } });
                    if (!resp.ok) throw new Error('Gagal memuat produk');
                    const data = await resp.json();

                    const items = data.data || data.products || [];
                    renderAjaxProducts(items);

                    // Perbarui pagination jika ada struktur links
                    if (data.links) {
                        renderAjaxPagination(data);
                    } else if (data.pagination) {
                        renderSimplePagination(data.pagination);
                    }
                } catch (err) {
                    $grid.html(`
                        <div id="noResults" class="no-results" style="display: block; grid-column: 1 / -1;">
                            <h3>Terjadi kesalahan saat memuat produk</h3>
                            <p>Silakan coba lagi.</p>
                        </div>
                    `);
                } finally {
                    $grid.css('opacity', 1);
                }
            }

            function renderAjaxProducts(items) {
                const $productsGrid = $('#productsGrid');
                if (!items || items.length === 0) {
                    $productsGrid.html(`
                        <div id="noResults" class="no-results" style="display: block; grid-column: 1 / -1;">
                            <h3>Produk yang Anda cari tidak ditemukan</h3>
                            <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
                        </div>
                    `);
                    return;
                }

                const productsHTML = items.map(p => {
                    const imageUrl = p.image_url || 'https://via.placeholder.com/200?text=No+Image';
                    const formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(Number(p.price) || 0);
                    const showOldPrice = p.old_price && Number(p.old_price) > Number(p.price);
                    const oldPriceFormatted = showOldPrice ? ('Rp ' + new Intl.NumberFormat('id-ID').format(Number(p.old_price) || 0)) : '';
                    const categoryName = p.category?.name || 'Uncategorized';
                    const promoBadge = p.is_promo ? '<div class="modal-promo-badge">PROMO</div>' : '';

                    return `
                        <div class="product-card" data-product-id="${p.id}" onclick="showProductDetails(${p.id})">
                            <div class="product-image" style="position: relative;">
                                ${promoBadge}
                                <img src="${imageUrl}" alt="${p.name}" loading="lazy"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/200?text=No+Image'; this.style.opacity='1';"
                                    onload="this.style.opacity='1';" style="opacity: 0; transition: opacity 0.3s ease;">
                            </div>
                            <div class="product-info">
                                <div class="product-category">${categoryName}</div>
                                <div class="product-name">${p.name}</div>
                                <div class="product-price">
                                    ${showOldPrice ? `<span class="product-old-price">${oldPriceFormatted}</span>` : ''}
                                    <span class="product-current-price">${formattedPrice}</span>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');

                $productsGrid.html(productsHTML);
            }

            function renderAjaxPagination(data) {
                const $pagination = $('.pagination-links');
                if (!$pagination.length) return;
                const links = Array.isArray(data.links) ? data.links : [];
                const html = links.map(l => {
                    const disabled = !l.url ? ' disabled' : '';
                    const active = l.active ? ' active' : '';
                    // Ekstrak page dari URL jika ada
                    let pageParam = null;
                    try {
                        const u = new URL(l.url);
                        pageParam = u.searchParams.get('page');
                    } catch (e) { /* noop */ }
                    return `<a href="#" class="pagination-link${active}${disabled}" data-page="${pageParam || ''}">${l.label}</a>`;
                }).join('');
                $pagination.html(html);
            }

            function renderSimplePagination(p) {
                const $pagination = $('.pagination-links');
                if (!$pagination.length) return;
                const curr = Number(p.current_page) || 1;
                const last = Number(p.last_page) || 1;
                let html = '';
                for (let i = 1; i <= last; i++) {
                    html += `<a href="#" class="pagination-link${i === curr ? ' active' : ''}" data-page="${i}">${i}</a>`;
                }
                $pagination.html(html);
            }

            // Fungsi untuk menampilkan subkategori yang relevan
            function showSubcategoriesForCategory(categoryId) {
                const $subcategoryGrid = $('#subcategoryGrid');
                const $subcategorySection = $('#subcategorySection');
                $subcategoryGrid.empty();

                // Jika kategori "Semua Kategori", sembunyikan subkategori
                if (categoryId === 'all') {
                    $subcategorySection.hide();
                    return;
                }

                // Filter subkategori berdasarkan kategori dan produk yang tersedia
                const relevantSubcategories = allSubcategories.filter(sub => {
                    return allProducts.some(product =>
                        product.product_category_id == categoryId &&
                        product.sub_category_id == sub.id
                    );
                });

                if (relevantSubcategories.length === 0) {
                    $subcategorySection.hide();
                    return;
                }

                const $allSubCard = $('<div>')
                    .addClass('subcategory-card active')
                    .html('<div class="subcategory-name">Semua Sub Kategori</div>')
                    .on('click', function() {
                        selectSubcategory(null, $(this));
                    });
                $subcategoryGrid.append($allSubCard);

                $.each(relevantSubcategories, function(index, sub) {
                    const $subCard = $('<div>')
                        .addClass('subcategory-card')
                        .data('subcategory-id', sub.id)
                        .html(`<div class="subcategory-name">${sub.name}</div>`)
                        .on('click', function() {
                            selectSubcategory(sub.id, $(this));
                        });
                    $subcategoryGrid.append($subCard);
                });

                $subcategorySection.show();
            }

            function selectSubcategory(subcategoryId, $element) {
                $('.subcategory-card').removeClass('active');
                $element.addClass('active');
                currentSubcategoryId = subcategoryId;
                // Update URL params untuk auto-redirect feel
                try {
                    const params = new URLSearchParams(window.location.search);
                    if (currentCategoryId && currentCategoryId !== 'all') {
                        params.set('category', currentCategoryId);
                    } else {
                        params.delete('category');
                    }
                    if (subcategoryId) {
                        params.set('subcategory', subcategoryId);
                    } else {
                        params.delete('subcategory');
                    }
                    history.pushState(null, '', `?${params.toString()}`);
                } catch (e) { /* noop */ }
                // Muat dari server agar konsisten
                applyFilterAndReload();
            }

            // Function to filter products without page reload
            function filterProductsByCategory(categoryId) {
                currentCategoryId = categoryId;

                let filteredProducts = allProducts;

                // Filter by category
                if (categoryId !== 'all') {
                    filteredProducts = filteredProducts.filter(product =>
                        product.product_category_id == categoryId
                    );
                }

                // Filter by subcategory if selected
                if (currentSubcategoryId) {
                    filteredProducts = filteredProducts.filter(product =>
                        product.sub_category_id == currentSubcategoryId
                    );
                }

                // Filter by search term if exists
                if (currentSearchTerm) {
                    filteredProducts = filteredProducts.filter(product =>
                        product.name.toLowerCase().includes(currentSearchTerm.toLowerCase()) ||
                        (product.description && product.description.toLowerCase().includes(currentSearchTerm.toLowerCase()))
                    );
                }

                // Update URL params (auto redirect behaviour)
                try {
                    const params = new URLSearchParams(window.location.search);
                    if (categoryId && categoryId !== 'all') {
                        params.set('category', categoryId);
                    } else {
                        params.delete('category');
                    }
                    if (currentSubcategoryId) {
                        params.set('subcategory', currentSubcategoryId);
                    } else {
                        params.delete('subcategory');
                    }
                    history.pushState(null, '', `?${params.toString()}`);
                } catch (e) { /* noop */ }

                const gridEl = document.getElementById('productsGrid');
                if (gridEl) {
                    gridEl.style.opacity = '0';
                    setTimeout(() => {
                        renderProducts(filteredProducts);
                        gridEl.style.opacity = '1';
                        // Scroll ke produk saat subkategori dipilih atau kategori 'all'
                        const shouldScrollToProducts = !!currentSubcategoryId || categoryId === 'all';
                        if (shouldScrollToProducts) {
                            smoothScrollTo(gridEl, -16, 600);
                        }
                    }, 150);
                } else {
                    renderProducts(filteredProducts);
                }
            }

            // Helper untuk mengurutkan produk secara client-side
            function getSortedProducts(products) {
                const sortPrice = $('#sortPrice').val();
                const sortName = $('#sortName').val();
                const sortDate = $('#sortDate').val();

                const sorted = [...products];

                if (sortPrice === 'low-high') {
                    sorted.sort((a, b) => (a.price ?? 0) - (b.price ?? 0));
                } else if (sortPrice === 'high-low') {
                    sorted.sort((a, b) => (b.price ?? 0) - (a.price ?? 0));
                } else if (sortName === 'a-z') {
                    sorted.sort((a, b) => (a.name || '').localeCompare(b.name || ''));
                } else if (sortName === 'z-a') {
                    sorted.sort((a, b) => (b.name || '').localeCompare(a.name || ''));
                } else if (sortDate === 'newest') {
                    sorted.sort((a, b) => new Date(b.created_at || b.updated_at || 0) - new Date(a.created_at || a.updated_at || 0));
                } else if (sortDate === 'oldest') {
                    sorted.sort((a, b) => new Date(a.created_at || a.updated_at || 0) - new Date(b.created_at || b.updated_at || 0));
                }

                return sorted;
            }

            // Function to render products menggunakan jQuery
            function renderProducts(products) {
                const $productsGrid = $('#productsGrid');

                if (products.length === 0) {
                    $productsGrid.html(`
                        <div id="noResults" class="no-results" style="display: block; grid-column: 1 / -1;">
                            <h3>Produk yang Anda cari tidak ditemukan</h3>
                            <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
                        </div>
                    `);
                    return;
                }

                const sortedProducts = getSortedProducts(products);
                const productsHTML = sortedProducts.map(product => {
                    const imagePath = product.image || (product.product_images && product.product_images[0] ? product.product_images[0].image_path : null);
                    const imageUrl = imagePath ?
                        `${window.location.origin}/tenancy/assets/${imagePath.replace(/^\//, '')}` :
                        'https://via.placeholder.com/200?text=No+Image';
                    const formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(product.price);
                    const categoryName = allCategories.find(cat => cat.id == product.product_category_id)?.name || 'Uncategorized';

                    return `
                        <div class="product-card" data-product-id="${product.id}">
                            <div class="product-image">
                                <img src="${imageUrl}" alt="${product.name}" loading="lazy"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/200?text=No+Image'; this.style.opacity='1';"
                                    onload="this.style.opacity='1';" style="opacity: 0; transition: opacity 0.3s ease;">
                            </div>
                            <div class="product-info">
                                <div class="product-category">${categoryName}</div>
                                <div class="product-name">${product.name}</div>
                                <div class="product-price">${formattedPrice}</div>
                            </div>
                        </div>
                    `;
                }).join('');

                $productsGrid.html(productsHTML);

                // Tambahkan badge PROMO dan harga lama pada kartu yang relevan
                sortedProducts.forEach(product => {
                    const $card = $productsGrid.find(`.product-card[data-product-id="${product.id}"]`);
                    if (!$card.length) return;

                    const formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(product.price ?? 0);
                    const oldPriceFormatted = (product.old_price && Number(product.old_price) > Number(product.price))
                        ? ('Rp ' + new Intl.NumberFormat('id-ID').format(product.old_price))
                        : '';

                    const $imgWrap = $card.find('.product-image');
                    $imgWrap.css('position', 'relative');
                    if (product.is_promo) {
                        // Hindari duplikasi badge
                        if ($imgWrap.find('.modal-promo-badge').length === 0) {
                            $imgWrap.append('<div class="modal-promo-badge">PROMO</div>');
                        }
                    }

                    const $price = $card.find('.product-price');
                    if ($price.length) {
                        const priceHtml = `${oldPriceFormatted ? `<span class=\"product-old-price\">${oldPriceFormatted}</span>` : ''}` +
                            `<span class="product-current-price">${formattedPrice}</span>`;
                        $price.html(priceHtml);
                    }
                });

                // Bind click event untuk product cards
                $('.product-card').on('click', function() {
                    const productId = $(this).data('product-id');
                    showProductDetails(productId);
                });
            }

            // --- EVENT LISTENERS menggunakan jQuery ---

            // Use event delegation for category cards
            $(document).on('click', '.category-card', function() {
                const categoryId = $(this).data('category-id');
                
                // Update current category ID
                currentCategoryId = categoryId;

                // Update active state
                $('.category-card').removeClass('active');
                $(this).addClass('active');

                // Reset subcategory selection
                currentSubcategoryId = null;

                // Show subcategories only if not "Semua Kategori"
                if (categoryId === 'all') {
                    $('.subcategory-section').hide();
                } else {
                    showSubcategoriesForCategory(categoryId);
                    $('.subcategory-section').show();
                }

                // Auto-redirect: update URL dan scroll ke sub kategori
                try {
                    const params = new URLSearchParams(window.location.search);
                    if (categoryId && categoryId !== 'all') {
                        params.set('category', categoryId);
                    } else {
                        params.delete('category');
                    }
                    params.delete('subcategory'); // reset sub kategori
                    history.pushState(null, '', `?${params.toString()}`);
                } catch (e) { /* noop */ }

                const subEl = document.getElementById('subcategorySection');
                if (subEl && categoryId !== 'all') {
                    smoothScrollTo(subEl, -16, 600);
                }

                // Tetap filter agar list produk relevan, dengan animasi fade internal
                // Gunakan server-side agar pagination & rentang harga konsisten
                applyFilterAndReload();
            });

            // Event listener untuk filter
            $('#searchInput').on('keypress', function(e) {
                if (e.key === 'Enter') {
                    currentSearchTerm = $(this).val();
                    applyFilterAndReload();
                }
            });

            $('#searchInput').on('input', function() {
                currentSearchTerm = $(this).val();
                // Tidak reload setiap ketik untuk performa; gunakan Enter
            });

            $('#sortPrice, #sortName, #sortDate, #priceRange').on('change', function() {
                applyFilterAndReload();
            });

            // Intersep klik pagination agar tidak reload penuh
            $('.pagination-links').on('click', 'a.pagination-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                applyFilterAndReload(page || 1);
            });

            // --- FUNGSI KUSTOMISASI ADMIN ---

            // Fungsi untuk menerapkan konfigurasi hero section
            function applyHeroConfiguration() {
                const $bgSlides = $('.bg-slide');
                $bgSlides.each(function(index) {
                    if (heroConfig.slides[index]) {
                        const slideData = heroConfig.slides[index];
                        const $bgImage = $(this).find('.bg-image');
                        if ($bgImage.length) {
                            $bgImage.css({
                                'background-image': `url('${slideData.background}')`,
                                'background-size': 'cover',
                                'background-position': 'center',
                                'background-repeat': 'no-repeat'
                            });
                        }
                    }
                });

                updateHeroContent(0);
            }

            // Fungsi untuk update konten hero berdasarkan slide aktif
            function updateHeroContent(slideIndex) {
                const $heroTitle = $('.hero-title');
                const $heroSubtitle = $('.hero-subtitle');

                if (heroConfig.slides[slideIndex]) {
                    const slideData = heroConfig.slides[slideIndex];

                    if ($heroTitle.length) {
                        $heroTitle.css('opacity', '0');
                        setTimeout(() => {
                            $heroTitle.text(slideData.title).css('opacity', '1');
                        }, 200);
                    }
                    if ($heroSubtitle.length) {
                        $heroSubtitle.css('opacity', '0');
                        setTimeout(() => {
                            $heroSubtitle.text(slideData.subtitle).css('opacity', '1');
                        }, 300);
                    }
                }
            }

            // Fungsi untuk menerapkan konfigurasi footer
            function applyFooterConfiguration() {
                const $footerStoreName = $('.footer h3').first();
                if ($footerStoreName.length) $footerStoreName.text(storeConfig.name);

                const $footerDescription = $('.footer p').first();
                if ($footerDescription.length) $footerDescription.text(storeConfig.description);

                const $contactItems = $('.contact-item span');
                if ($contactItems.eq(0).length) $contactItems.eq(0).text(storeConfig.phone);
                if ($contactItems.eq(1).length) $contactItems.eq(1).text(storeConfig.email);
                if ($contactItems.eq(2).length) $contactItems.eq(2).text(storeConfig.address);

                const computedLogo = storeConfig.logo || (storeConfig.logoPath ? tenantAssetUrl(storeConfig.logoPath) : '');
                if (computedLogo) {
                    const $brandIcon = $('.brand-icon');
                    if ($brandIcon.length) {
                        $brandIcon.html(`<img src="${computedLogo}" alt="${storeConfig.name}" style="width: 40px; height: 40px; object-fit: contain;">`);
                    }
                    const $footerLogo = $('#footerStoreLogo');
                    if ($footerLogo.length) {
                        $footerLogo.attr('src', computedLogo).attr('alt', storeConfig.name);
                    }
                }
            }

            // Fungsi untuk menerapkan konfigurasi kategori
            function applyCategoryConfiguration() {
                const $allCategoryCard = $('.category-card[data-category-id="all"] .category-name');
                if ($allCategoryCard.length && categoryConfig.allCategoryText) {
                    $allCategoryCard.text(categoryConfig.allCategoryText);
                }

                const $categoryGrid = $('.category-grid');
                if ($categoryGrid.length) {
                    $categoryGrid.attr('class', `category-grid category-${categoryConfig.categoryDisplayStyle}`);
                    $categoryGrid.css('--max-categories-per-row', categoryConfig.maxCategoriesPerRow);
                }

                $('.category-card').each(function() {
                    $(this).addClass(`category-${categoryConfig.categoryIconStyle}`);
                });
            }

            // Fungsi untuk menerapkan konfigurasi produk
            function applyProductConfiguration() {
                const $contactButtons = $('.contact-seller-btn');
                if (productConfig.contactButtonText) {
                    $contactButtons.text(productConfig.contactButtonText);
                }

                $('.product-image').each(function() {
                    $(this).addClass(`product-image-${productConfig.productImageStyle}`);
                });

                if (!productConfig.showProductPrice) {
                    $('.product-price').hide();
                }

                if (!productConfig.showProductDescription) {
                    $('.product-description').hide();
                }

                if (!productConfig.showContactSeller) {
                    $('.contact-seller-btn').hide();
                }
            }

            // --- INISIALISASI ---
            const currentUrlParams = new URLSearchParams(window.location.search);
            const currentCategory = currentUrlParams.get('category') || 'all';
            const currentSubcategory = currentUrlParams.get('subcategory');

            // Set global variables
            currentCategoryId = currentCategory;
            currentSubcategoryId = currentSubcategory;

            // Terapkan semua konfigurasi saat halaman dimuat
            applyHeroConfiguration();
            applyFooterConfiguration();
            applyCategoryConfiguration();
            applyProductConfiguration();

            // Atur state aktif untuk kategori
            $('.category-card').removeClass('active');
            const $activeCategoryCard = $(`.category-card[data-category-id="${currentCategory}"]`);
            if ($activeCategoryCard.length) {
                $activeCategoryCard.addClass('active');
            } else {
                const $allCategoryCard = $('.category-card[data-category-id="all"]');
                if ($allCategoryCard.length) {
                    $allCategoryCard.addClass('active');
                }
            }

            // Tampilkan dan atur state aktif untuk subkategori
            if (currentCategory !== 'all') {
                showSubcategoriesForCategory(currentCategory);
                if (currentSubcategory) {
                    $('.subcategory-card').removeClass('active');
                    const $activeSubCard = $(`.subcategory-card[data-subcategory-id="${currentSubcategory}"]`);
                    if ($activeSubCard.length) $activeSubCard.addClass('active');
                }
            } else {
                $('#subcategorySection').hide();
            }

            // Make functions globally accessible
            window.showSubcategoriesForCategory = showSubcategoriesForCategory;
            window.filterProductsByCategory = filterProductsByCategory;
            window.updateHeroContent = updateHeroContent;
        });

        // Product Modal Functions (Global scope untuk onclick handler)
        async function showProductDetails(productId) {
            const $productModal = $('#productModal');
            const $modalContent = $('#modalContent');

            // Show modal immediately
            $productModal.fadeIn(300).addClass('show');
            $('body').css('overflow', 'hidden');

            $modalContent.html(`
                <div class="modal-loading">
                    <div class="loading-spinner"></div>
                    <p>Memuat detail produk...</p>
                </div>
            `);

            try {
                let product = allProducts.find(p => p.id == productId);

                if (!product) {
                    const response = await fetch(`/api/products/${productId}`);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const data = await response.json();

                    if (!data.success) {
                        throw new Error(data.message || 'Failed to fetch product details');
                    }

                    product = data;
                }

                if (!product) {
                    throw new Error('Product not found');
                }

                // Handle multiple images
                const images = [];
                if (product.image) {
                    images.push(product.image);
                }
                if (product.product_images && product.product_images.length > 0) {
                    product.product_images.forEach(img => {
                        const imgPath = img.image_path || img;
                        if (imgPath && !images.includes(imgPath)) {
                            images.push(imgPath);
                        }
                    });
                }
                if (product.images && product.images.length > 0) {
                    product.images.forEach(img => {
                        const imgPath = img.image_path || img;
                        if (imgPath && !images.includes(imgPath)) {
                            images.push(imgPath);
                        }
                    });
                }

                const primaryImageUrl = images.length > 0 ?
                    `${window.location.origin}/tenancy/assets/${images[0].replace(/^\//, '')}` :
                    'https://via.placeholder.com/400x400?text=No+Image';

                const formattedPrice = 'Rp ' + new Intl.NumberFormat('id-ID').format(product.price);
                const oldPriceFormatted = product.old_price ?
                    'Rp ' + new Intl.NumberFormat('id-ID').format(product.old_price) : null;

                const material = product.specification?.material || product.material || '';
                const sizes = product.specification?.sizes || product.sizes || [];
                const colors = product.specification?.colors || product.colors || [];
                let brand = product.brand?.name || product.brand || '';
                // Fallback: ambil brand dari atribut data pada kartu produk jika tidak tersedia dari API
                if (!brand) {
                    const cardEl = document.querySelector(`.product-card[data-product-id="${productId}"]`);
                    if (cardEl && cardEl.dataset && cardEl.dataset.brand) {
                        brand = cardEl.dataset.brand;
                    }
                }
                const sku = product.sku || '';

                // Generate image gallery HTML
                let imageGalleryHTML = '';
                if (images.length > 1) {
                    imageGalleryHTML = `
                        <div class="image-gallery">
                            ${images.map((img, index) => {
                                const imgUrl = `${window.location.origin}/tenancy/assets/${img.replace(/^\//, '')}`;
                                return `<img src="${imgUrl}" alt="${product.name} ${index + 1}" class="gallery-thumb ${index === 0 ? 'active' : ''}" onclick="changeMainImage('${imgUrl}', this)">`;
                            }).join('')}
                        </div>
                    `;
                }

                // Ukuran tersedia: ambil dari spesifikasi jika ada, fallback ke S–XXL
                let sizesHTML = '';
                let sizeItems = [];
                if (Array.isArray(sizes) && sizes.length > 0) {
                    sizeItems = sizes;
                } else {
                    sizeItems = ['S','M','L','XL','XXL'];
                }
                if (sizeItems.length > 0) {
                    sizesHTML = `
                        <div class=\"modal-section\">
                            <h4>Ukuran Tersedia:</h4>
                            <div class=\"sizes-list\">
                                ${sizeItems.map(s => `<span class=\\\"size-tag\\\">${s}</span>`).join('')}
                            </div>
                        </div>
                    `;
                }

                let colorsHTML = '';
                if (colors && colors.length > 0) {
                    colorsHTML = `
                        <div class="modal-section">
                            <h4>Warna Tersedia:</h4>
                            <div class="colors-list">
                                ${colors.map(color => `<span class="color-tag">${color}</span>`).join('')}
                            </div>
                        </div>
                    `;
                }

                // Jika ukuran kosong, tampilkan info stok
                let stockHTML = '';
                if (!sizes || sizes.length === 0) {
                    const rawStock = typeof product.stock === 'number' ? product.stock : null;
                    const availability = typeof product.isAvailable === 'boolean' ? product.isAvailable : null;
                    let stockClass = 'out-of-stock';
                    let stockText = 'Stok Habis';
                    let stockCountText = '';

                    if (rawStock !== null) {
                        if (rawStock > 10) {
                            stockClass = 'in-stock';
                            stockText = 'Stok Banyak';
                        } else if (rawStock > 0) {
                            stockClass = 'low-stock';
                            stockText = 'Stok Terbatas';
                        } else {
                            stockClass = 'out-of-stock';
                            stockText = 'Stok Habis';
                        }
                        stockCountText = ` (${rawStock})`;
                    } else if (availability !== null) {
                        if (availability) {
                            stockClass = 'in-stock';
                            stockText = 'Tersedia';
                        } else {
                            stockClass = 'out-of-stock';
                            stockText = 'Stok Habis';
                        }
                    } else {
                        stockClass = 'low-stock';
                        stockText = 'Ketersediaan stok tidak diketahui';
                    }

                    stockHTML = `
                        <div class="modal-section">
                            <h4>Ketersediaan Stok:</h4>
                            <p class="stock-info ${stockClass}">${stockText}${stockCountText}</p>
                        </div>
                    `;
                }

                // Produk serupa berdasarkan kategori
                const similarProducts = getSimilarProducts(product, 6);
                let similarProductsHTML = '';
                if (similarProducts.length > 0) {
                    similarProductsHTML = `
                        <div class="modal-similar-section">
                            <h3>Produk Serupa</h3>
                            <div class="similar-grid">
                                ${similarProducts.map(sp => {
                                    const imagePath = sp.image || (sp.product_images && sp.product_images[0] ? sp.product_images[0].image_path : null);
                                    const imgUrl = imagePath ? `${window.location.origin}/tenancy/assets/${String(imagePath).replace(/^\//,'')}` : 'https://via.placeholder.com/140?text=No+Image';
                                    const spPriceStr = 'Rp ' + new Intl.NumberFormat('id-ID').format(Number(sp.price) || 0);
                                    return `
                                        <div class="similar-card" onclick="showProductDetails(${sp.id})">
                                            <div class="similar-image">
                                                <img src="${imgUrl}" alt="${sp.name}">
                                            </div>
                                            <div class="similar-info">
                                                <div class="similar-name">${sp.name}</div>
                                                <div class="similar-price">${spPriceStr}</div>
                                            </div>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                    `;
                }

                const isPromo = !!(product.is_promo || product.isPromo);
                $modalContent.html(`
                    <div class="modal-product-details" style="position: relative;">
                        ${isPromo ? `<div class=\"modal-promo-badge\">PROMO</div>` : ''}
                        <div class="modal-product-image">
                            <img id="mainProductImage" src="${primaryImageUrl}" alt="${product.name}"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                 style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px;">
                            <div class="no-image" style="display: none; height: 400px; background: #f0f0f0; border-radius: 12px; align-items: center; justify-content: center; font-size: 1.2rem; color: #999;">📷 Image Not Available</div>
                            ${imageGalleryHTML}
                        </div>
                        <div class="modal-product-info">
                            <div class="modal-product-header">
                                <div class="modal-product-category">
                                    <span class="category-name">${product.category?.name || 'Uncategorized'}</span>
                                    ${product.sub_category?.name || product.subcategory?.name ? `<span class="subcategory-name"> > ${product.sub_category?.name || product.subcategory?.name}</span>` : ''}
                                </div>

                            </div>
                            <h2 class="modal-product-name">${product.name}</h2>
                            <div class="modal-product-pricing">
                                <div class="price-container">
                                    <div class="modal-product-price">${formattedPrice}</div>
                                    ${oldPriceFormatted ? `<div class="modal-product-old-price">${oldPriceFormatted}</div>` : ''}

                                </div>
                            </div>
                            <div class="modal-product-description">
                                <h4>Deskripsi:</h4>
                                <p>${product.description || 'Tidak ada deskripsi tersedia untuk produk ini.'}</p>
                            </div>
                            ${brand ? `<div class="modal-section"><h4>Brand:</h4><p class="spec-value">${brand}</p></div>` : ''}
                            <div class="modal-product-specs">
                                ${material ? `<div class=\"modal-section\"><h4>Material:</h4><p class=\"spec-value\">${material}</p></div>` : ''}

                                ${colorsHTML}

                            </div>
                            <div class="modal-product-actions">
                                <button class="btn-contact contact-seller-btn" onclick="contactSeller('${product.name}')">
                                    <i class="fab fa-whatsapp"></i> Hubungi
                                </button>
                            </div>
                            ${similarProductsHTML}
                        </div>
                    </div>
                `);

                $productModal.addClass('show');
                $('body').css('overflow', 'hidden');

            } catch (error) {
                console.error('Error fetching product details:', error);
                hideLoadingOverlay();
                $modalContent.html(`
                    <div class="modal-error">
                        <div class="error-icon">⚠️</div>
                        <h3>Gagal Memuat Detail Produk</h3>
                        <p>Terjadi kesalahan saat memuat detail produk. Silakan coba lagi.</p>
                        <button class="btn-retry" onclick="showProductDetails(${productId})">Coba Lagi</button>
                    </div>
                `);
                $productModal.fadeIn(300);
            }
        }

        // Ambil produk serupa berdasarkan kategori yang sama
        function getSimilarProducts(currentProduct, max = 6) {
            try {
                const categoryId = currentProduct.product_category_id || currentProduct.category?.id;
                if (!categoryId) return [];
                const candidates = (Array.isArray(allProducts) ? allProducts : []).filter(p => {
                    const pCategoryId = p.product_category_id || p.category?.id;
                    return p.id != currentProduct.id && pCategoryId == categoryId;
                });
                return candidates.slice(0, max);
            } catch (e) {
                console.warn('getSimilarProducts error:', e);
                return [];
            }
        }

        function changeMainImage(imageUrl, thumbElement) {
            $('#mainProductImage').attr('src', imageUrl);
            $('.gallery-thumb').removeClass('active');
            $(thumbElement).addClass('active');
        }

        function contactSeller(productName) {
            const storePhone = "{{ $userStore->store_phone ?? ($userStore->phone ?? '') }}";
            if (!storePhone) {
                alert('Nomor kontak tidak tersedia. Silakan hubungi admin untuk informasi lebih lanjut.');
                return;
            }

            const storeName = "{{ $userStore->store_name ?? 'Toko' }}";
            const message = `Halo ${storeName},\n\nSaya tertarik dengan produk "${productName}" yang ada di katalog Anda.\n\nBisakah Anda memberikan informasi lebih lanjut mengenai:\n- Ketersediaan stok\n- Detail produk\n- Harga dan cara pemesanan\n\nTerima kasih!`;

            const cleanPhone = storePhone.replace(/[^0-9]/g, '');
            const formattedPhone = cleanPhone.startsWith('62') ? cleanPhone : '62' + cleanPhone.replace(/^0/, '');
            const whatsappUrl = `https://wa.me/${formattedPhone}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        function closeModal() {
            const $productModal = $('#productModal');
            if ($productModal.length) {
                $productModal.removeClass('show').fadeOut(300);
                $('body').css('overflow', 'auto');
                $('#modalContent').empty();
            }
        }

        // Close modal events menggunakan jQuery
        $(document).ready(function() {
            // Close button click
            $('.modal-close').on('click', closeModal);

            // Click outside modal
            $('#productModal').on('click', function(event) {
                if ($(event.target).is('#productModal')) {
                    closeModal();
                }
            });

            // Escape key
            $(document).on('keydown', function(event) {
                if (event.key === 'Escape' && $('#productModal').hasClass('show')) {
                    closeModal();
                }
            });
        });

        // ===== BANNER SLIDER MENGGUNAKAN SWIPER.JS =====
        @php
            $bannerData = $banners->map(function ($banner) {
                return [
                    'title' => $banner->title ?? 'Fashion Store',
                    'subtitle' => $banner->subtitle ?? 'Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti',
                    'link' => $banner->link,
                    'button_text' => $banner->button_text ?? 'Lihat Koleksi',
                ];
            });
        @endphp

        const bannerData = @json($bannerData);

        // Function to update hero content menggunakan jQuery
        function updateHeroContentSwiper(index) {
            const banner = bannerData[index] || bannerData[0];
            const $titleElement = $('#heroTitle');
            const $subtitleElement = $('#heroSubtitle');
            const $buttonElement = $('#heroButton');

            if ($titleElement.length && $subtitleElement.length) {
                // Fade out
                $titleElement.css('opacity', '0');
                $subtitleElement.css('opacity', '0');

                setTimeout(() => {
                    // Update content
                    $titleElement.text(banner.title);
                    $subtitleElement.text(banner.subtitle);

                    // Update button
                    if ($buttonElement.length && banner.link) {
                        $buttonElement.attr('href', banner.link).text(banner.button_text).show();
                    } else if ($buttonElement.length) {
                        $buttonElement.hide();
                    }

                    // Fade in
                    $titleElement.css('opacity', '1');
                    $subtitleElement.css('opacity', '1');
                }, 250);
            }
        }

        // Initialize Swiper for banner slider
        $(document).ready(function() {
            console.log('Initializing Swiper...');
            const swiper = new Swiper(".swiper-container", {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                speed: 800,
                on: {
                    slideChange: function() {
                        const realIndex = this.realIndex;
                        console.log('Slide changed to:', realIndex);
                        updateHeroContentSwiper(realIndex);
                    },
                    init: function() {
                        console.log('Swiper initialized successfully');
                        console.log('Navigation buttons:', $('.swiper-button-prev, .swiper-button-next'));
                    }
                }
            });

            console.log('Swiper instance:', swiper);

            // Initialize hero content on page load
            updateHeroContentSwiper(0);
        });
    </script>

</body>

</html>
