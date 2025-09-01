<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ App\Models\Setting::get('website_title', 'Fashion E-Catalog') }}</title>

    <meta name="description" content="{{ App\Models\Setting::get('website_description', 'Discover the latest fashion trends and styles in our comprehensive e-catalog. Browse through our curated collection of clothing, accessories, and fashion items.') }}">
    <meta name="keywords" content="fashion, clothing, style, trends, catalog, online shopping, apparel, accessories">
    <meta name="author" content="{{ App\Models\Setting::get('website_title', 'Fashion E-Catalog') }}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="en">
    <meta name="revisit-after" content="7 days">

    <meta property="og:title" content="{{ App\Models\Setting::get('website_title', 'Fashion E-Catalog') }}">
    <meta property="og:description" content="{{ App\Models\Setting::get('website_description', 'Discover the latest fashion trends and styles in our comprehensive e-catalog.') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta property="og:site_name" content="{{ App\Models\Setting::get('website_title', 'Fashion E-Catalog') }}">
    <meta property="og:locale" content="en_US">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ App\Models\Setting::get('website_title', 'Fashion E-Catalog') }}">
    <meta name="twitter:description" content="{{ App\Models\Setting::get('website_description', 'Discover the latest fashion trends and styles in our comprehensive e-catalog.') }}">
    <meta name="twitter:image" content="{{ asset('images/twitter-card.jpg') }}">

    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    <meta name="theme-color" content="{{ App\Models\Setting::get('theme_color', '#2C3E50') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $primaryFont = App\Models\Setting::get('primary_font', 'Inter');
        $headingFont = App\Models\Setting::get('heading_font', 'Inter');
        $themeColor = App\Models\Setting::get('theme_color', '#2C3E50');
        $secondaryColor = App\Models\Setting::get('secondary_color', '#34495E');
        $accentColor = App\Models\Setting::get('accent_color', '#5D4037');

        // Google Fonts URL
        $fontsToLoad = collect([$primaryFont, $headingFont])->unique()->map(function($font) {
            return str_replace(' ', '+', $font);
        })->implode('|');
    @endphp

    <link href="https://fonts.googleapis.com/css2?family={{ $fontsToLoad }}:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom Properties - Black & White Theme */
        :root {
            --primary-color: #000000;
            --secondary-color: #333333;
            --accent-color: #999999;
            --text-primary: #333333;
            --text-secondary: #555555;
            --text-light: #777777;
            --background-primary: #ffffff;
            --background-secondary: #f8f8f8;
            --background-tertiary: #f0f0f0;
            --border-color: #e0e0e0;
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.12);
            --shadow-heavy: rgba(0, 0, 0, 0.2);
            --gradient-primary: linear-gradient(135deg, #000000 0%, #333333 100%);
            --gradient-accent: linear-gradient(135deg, #666666 0%, #999999 100%);
            --font-primary: '{{ $headingFont }}', serif;
            --font-secondary: '{{ $primaryFont }}', sans-serif;
            --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            --border-radius: 16px;

            /* Spacing Variables */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-2xl: 3rem;
        }

        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        body {
            font-family: var(--font-secondary);
            color: var(--text-primary);
            background-color: var(--background-primary);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Utility Classes for Spacing */
        .p-xs { padding: var(--spacing-xs); }
        .p-sm { padding: var(--spacing-sm); }
        .p-md { padding: var(--spacing-md); }
        .p-lg { padding: var(--spacing-lg); }
        .p-xl { padding: var(--spacing-xl); }
        .p-2xl { padding: var(--spacing-2xl); }

        .px-xs { padding-left: var(--spacing-xs); padding-right: var(--spacing-xs); }
        .px-sm { padding-left: var(--spacing-sm); padding-right: var(--spacing-sm); }
        .px-md { padding-left: var(--spacing-md); padding-right: var(--spacing-md); }
        .px-lg { padding-left: var(--spacing-lg); padding-right: var(--spacing-lg); }
        .px-xl { padding-left: var(--spacing-xl); padding-right: var(--spacing-xl); }

        .py-xs { padding-top: var(--spacing-xs); padding-bottom: var(--spacing-xs); }
        .py-sm { padding-top: var(--spacing-sm); padding-bottom: var(--spacing-sm); }
        .py-md { padding-top: var(--spacing-md); padding-bottom: var(--spacing-md); }
        .py-lg { padding-top: var(--spacing-lg); padding-bottom: var(--spacing-lg); }
        .py-xl { padding-top: var(--spacing-xl); padding-bottom: var(--spacing-xl); }

        .m-xs { margin: var(--spacing-xs); }
        .m-sm { margin: var(--spacing-sm); }
        .m-md { margin: var(--spacing-md); }
        .m-lg { margin: var(--spacing-lg); }
        .m-xl { margin: var(--spacing-xl); }
        .m-2xl { margin: var(--spacing-2xl); }

        .mx-auto { margin-left: auto; margin-right: auto; }
        .my-xs { margin-top: var(--spacing-xs); margin-bottom: var(--spacing-xs); }
        .my-sm { margin-top: var(--spacing-sm); margin-bottom: var(--spacing-sm); }
        .my-md { margin-top: var(--spacing-md); margin-bottom: var(--spacing-md); }
        .my-lg { margin-top: var(--spacing-lg); margin-bottom: var(--spacing-lg); }
        .my-xl { margin-top: var(--spacing-xl); margin-bottom: var(--spacing-xl); }
        .my-2xl { margin-top: var(--spacing-2xl); margin-bottom: var(--spacing-2xl); }

        .mb-xs { margin-bottom: var(--spacing-xs); }
        .mb-sm { margin-bottom: var(--spacing-sm); }
        .mb-md { margin-bottom: var(--spacing-md); }
        .mb-lg { margin-bottom: var(--spacing-lg); }
        .mb-xl { margin-bottom: var(--spacing-xl); }
        .mb-2xl { margin-bottom: var(--spacing-2xl); }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0.75rem 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(229, 227, 224, 0.3);
            transition: var(--transition);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .icon-inner {
            width: 16px;
            height: 16px;
            background: var(--accent-color);
            border-radius: 4px;
        }

        .brand-text {
            font-family: var(--font-primary);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
        }

        /* Category Cards */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-xl);
            margin: var(--spacing-xl) 0;
            padding: 0 var(--spacing-md);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .category-card {
            background: linear-gradient(135deg, var(--background-secondary) 0%, rgba(255, 255, 255, 0.95) 100%);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: var(--spacing-lg);
            text-align: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--accent-color) 0%, #e8b86d 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        /* Enhanced card hover effects */
        .category-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: var(--accent-color);
        }

        .category-card:hover::before {
            opacity: 0.1;
        }

        .category-card:hover .category-name,
        .category-card:hover .category-description {
            color: var(--accent-color);
            transform: translateY(-2px);
        }

        .subcategory-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--accent-color);
        }

        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 48px var(--shadow-medium);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px var(--shadow-medium);
        }

        /* Enhanced active card states */
        .category-card.active {
            background: var(--accent-color);
            color: var(--primary-color);
            border-color: var(--accent-color);
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(212, 175, 55, 0.3);
        }

        .category-card.active::before {
            opacity: 1;
        }

        .subcategory-card.active {
            background: var(--accent-color);
            color: var(--primary-color);
            border-color: var(--accent-color);
        }
        
        /* Loading Spinner Styles */
        .loading-spinner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            color: var(--text-color);
        }
        
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--accent-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .subcategory-loading {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100px;
            width: 100%;
        }
        
        /* Product Grid Transition */
        .products-grid {
            transition: opacity 0.3s ease;
        }
        
        /* Enhanced category transition */
        .category-card {
            transition: all 0.3s ease;
        }

        .category-icon {
            width: 32px;
            height: 32px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .category-card.active .category-icon {
            background: var(--primary-color);
            color: var(--accent-color);
        }

        .category-name {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-primary);
            line-height: 1.3;
            text-align: center;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .category-card.active .category-name {
            color: var(--primary-color);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .category-description {
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.4;
            text-align: center;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            max-width: 90%;
        }

        .category-card.active .category-description {
            color: var(--primary-color);
            opacity: 0.95;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Enhanced Subcategory Section */
        .subcategory-section {
            margin: var(--spacing-xl) 0;
            padding: var(--spacing-xl);
            background: linear-gradient(135deg, var(--background-secondary) 0%, rgba(255, 255, 255, 0.98) 100%);
            border-radius: 20px;
            border: 2px solid var(--border-color);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .subcategory-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }

        .subcategory-card {
            background: var(--background-primary);
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: var(--spacing-lg);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            position: relative;
            overflow: hidden;
        }

        .subcategory-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--accent-color) 0%, #e8b86d 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        /* Removed - consolidated above */

        .subcategory-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
            border-color: var(--accent-color);
        }

        .subcategory-card:hover::before {
            opacity: 0.08;
        }

        .subcategory-card:hover .subcategory-name,
        .subcategory-card:hover .subcategory-description {
            color: var(--accent-color);
            transform: translateY(-1px);
        }

        .subcategory-card.active {
            background: var(--accent-color);
            color: var(--primary-color);
            border-color: var(--accent-color);
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(212, 175, 55, 0.25);
        }

        .subcategory-card.active::before {
            opacity: 1;
        }

        .subcategory-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--text-primary);
            line-height: 1.3;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
            text-align: center;
        }

        .subcategory-card.active .subcategory-name {
            color: var(--primary-color);
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .subcategory-description {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.4;
            text-align: center;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            max-width: 90%;
        }

        .subcategory-card.active .subcategory-description {
            color: var(--primary-color);
            opacity: 0.95;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Search and Filters Horizontal Layout */
        .search-and-filters-horizontal {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-xl);
            flex-wrap: wrap;
            width: 100%;
        }

        .search-wrapper {
            flex: 0 0 auto;
            width: 350px;
        }

        /* Horizontal Filters */
        .filters-horizontal {
            display: flex;
            gap: var(--spacing-md);
            align-items: center;
            flex: 0 0 auto;
        }

        .filters-horizontal select {
            padding: 0.6rem 0.8rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--background-primary);
            color: var(--text-primary);
            font-size: 0.85rem;
            cursor: pointer;
            transition: var(--transition);
            width: 150px;
            font-weight: 500;
        }

        .filters-horizontal select:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(93, 64, 55, 0.1);
        }

        .filters-horizontal select:hover {
            border-color: var(--accent-color);
        }

        /* Search input styling */
        .search-wrapper input {
            width: 100%;
            padding: 0.6rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.9rem;
            background: var(--background-primary);
            transition: var(--transition);
            font-weight: 500;
        }

        .search-wrapper input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(93, 64, 55, 0.1);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 0;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--background-secondary) 0%, var(--background-tertiary) 100%);
            z-index: -2;
        }

        /* Slider Container */
        .slider-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .slider-wrapper {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .slide {
            min-width: 100%;
            height: 100%;
            flex-shrink: 0;
        }

        /* Slider Navigation */
        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
            backdrop-filter: blur(10px);
        }

        .slider-nav:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-50%) scale(1.1);
        }

        .slider-nav.prev {
            left: 30px;
        }

        .slider-nav.next {
            right: 30px;
        }

        .slider-nav svg {
            width: 20px;
            height: 20px;
            fill: white;
            filter: drop-shadow(1px 1px 2px rgba(0, 0, 0, 0.3));
        }

        /* Slider Indicators */
        .slider-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .slider-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.6);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-indicator.active {
            background: white;
            transform: scale(1.2);
        }

        .slider-indicator:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        .hero-content {
            text-align: center;
            z-index: 1;
        }

        .hero-title {
            font-family: var(--font-primary);
            font-size: 4rem;
            font-weight: 700;
            color: white;
            margin-bottom: var(--spacing-md);
            line-height: 1.1;
            position: relative;
            display: inline-block;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .hero-title::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -50px;
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
            border-radius: 50%;
            animation: sparkle 3s ease-in-out infinite;
        }

        .hero-title::after {
            content: '';
            position: absolute;
            top: -20px;
            right: -50px;
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes sparkle {
            0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.7; }
            50% { transform: scale(1.2) rotate(180deg); opacity: 1; }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .hero-subtitle {
            font-size: 1.4rem;
            color: white;
            margin-bottom: var(--spacing-xl);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            font-style: italic;
            position: relative;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        .hero-tagline {
            font-size: 1rem;
            color: #FFD700;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: var(--spacing-md);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        /* Common Layout Components - Consolidated */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-xl);
        }

        .section {
            margin: var(--spacing-3xl) 0;
            padding: var(--spacing-xl) 0;
        }

        .main {
            padding-top: var(--spacing-2xl);
        }

        .section-title {
            text-align: center;
            margin-bottom: var(--spacing-2xl);
            position: relative;
            padding: var(--spacing-lg) 0;
        }

        .section-title h2 {
            font-family: var(--font-primary);
            font-size: 2.8rem;
            color: var(--primary-color);
            margin-bottom: var(--spacing-md);
            font-weight: 800;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .section-title h3 {
            font-family: var(--font-primary);
            font-size: 2.2rem;
            color: var(--primary-color);
            margin-bottom: var(--spacing-sm);
            font-weight: 700;
            letter-spacing: 0.5px;
            position: relative;
        }

        /* Enhanced decorative underline */
        .section-title h2::after,
        .section-title h3::after,
        #subCategoryTitle::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color) 0%, #e8b86d 100%);
            border-radius: 3px;
            box-shadow: 0 2px 8px rgba(212, 175, 55, 0.3);
        }

        #subCategoryTitle::after {
            bottom: -10px;
            width: 60px;
            height: 3px;
        }

        .section-title p {
            font-size: 1.2rem;
            color: var(--text-secondary);
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-xl);
            margin-top: var(--spacing-xl);
            padding: 0 var(--spacing-md);
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        @media (min-width: 1200px) {
            .products-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 768px) and (max-width: 1199px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 767px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-md);
            }
        }

        .product-card {
            background: var(--background-primary);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 32px var(--shadow-light);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            border: 2px solid var(--border-color);
            height: auto;
            min-height: 420px;
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: none;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 48px rgba(0, 0, 0, 0.15);
            border-color: var(--accent-color);
        }

        /* Removed - consolidated above */

        .product-image {
            width: 100%;
            height: 250px;
            background: var(--background-tertiary);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
            min-height: 250px;
            max-height: 250px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        /* Image Loading States */
        .product-image {
            position: relative;
        }

        .product-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            z-index: 1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-image img[style*="opacity: 0"] + .no-image,
        .product-image img[style*="opacity: 0"]::before {
            opacity: 1;
        }

        @keyframes loading {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        /* Image Fallback Styles */
        .image-fallback {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px dashed #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: #6c757d;
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            transition: all 0.3s ease;
        }

        .image-fallback:hover {
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            border-color: #adb5bd;
        }

        .product-card:hover .product-image img {
            transform: scale(1.08);
        }

        .product-image .no-image {
            color: #6c757d;
            font-size: 1.2rem;
        }

        .product-info {
            padding: var(--spacing-md);
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 250px;
            max-height: 250px;
            height: 250px;
        }

        .product-category {
            color: var(--secondary-color);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: var(--spacing-sm);
        }

        .product-name {
            font-family: var(--font-primary);
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: var(--spacing-sm);
            line-height: 1.4;
            word-wrap: break-word;
            hyphens: auto;
            max-width: 15ch; /* Limit to 15 characters */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-family: var(--font-primary);
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 0.75rem;
        }



        .product-tags {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
        }

        .tag {
            background: var(--background-tertiary);
            color: var(--secondary-color);
            padding: 0.4rem var(--spacing-md);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .tag:hover {
            background: var(--accent-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }



        .no-products {
            text-align: center;
            padding: var(--spacing-2xl);
            color: #999;
        }

        .no-products h3 {
            font-size: 1.5rem;
            margin-bottom: var(--spacing-md);
        }

        .admin-link {
            position: fixed;
            bottom: var(--spacing-xl);
            right: var(--spacing-xl);
            background: linear-gradient(135deg, #8B4513 0%, #DAA520 100%);
            color: white;
            padding: var(--spacing-md) var(--spacing-lg);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s;
        }

        .admin-link:hover {
            transform: translateY(-2px);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-xl);
            margin: var(--spacing-2xl) 0;
            padding: 0 var(--spacing-md);
        }

        .stat-card {
            background: var(--background-primary);
            padding: var(--spacing-xl);
            border-radius: var(--border-radius);
            text-align: center;
            box-shadow: 0 8px 32px var(--shadow-light);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-accent);
        }

        /* Removed - consolidated above */

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: var(--spacing-sm);
            font-family: var(--font-primary);
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Search Bar Styles */
        .search-container {
            position: relative;
            z-index: 100;
            background: transparent;
            padding: var(--spacing-2xl) 0 0;
            margin: 0 auto;
            max-width: 1200px;
            transition: transform 0.3s ease, opacity 0.3s ease;
            width: 100%;
        }

        /* Search container in section context */
        .section .search-container {
            background: var(--background-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            padding: var(--spacing-xl);
            margin: var(--spacing-xl) 0;
        }

        .search-container.hidden {
            transform: translateY(-100%);
            opacity: 0;
            pointer-events: none;
        }

        .search-wrapper {
            position: relative;
            max-width: 400px;
            margin: 0 auto;
        }

        .search-wrapper input {
            width: 100%;
            padding: 0.8rem var(--spacing-md);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            font-size: 0.9rem;
            background: rgba(255, 255, 255, 0.9);
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .search-wrapper input:focus {
            outline: none;
            border-color: #FFD700;
            box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.3);
            background: rgba(255, 255, 255, 1);
        }

        /* Footer Styles */
        .footer {
            background: var(--gradient-primary);
            color: white;
            padding: var(--spacing-2xl) 0 var(--spacing-lg);
            margin-top: var(--spacing-2xl);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: var(--spacing-xl);
            align-items: flex-start;
        }

        .footer-section h3 {
            font-family: var(--font-primary);
            font-size: 1.3rem;
            margin-bottom: var(--spacing-md);
            color: var(--accent-color);
            font-weight: 600;
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            line-height: 1.6;
            transition: var(--transition);
            margin-bottom: var(--spacing-sm);
        }

        .footer-section a:hover {
            color: var(--accent-color);
        }

        .footer-contact {
            background: rgba(255, 255, 255, 0.05);
            padding: var(--spacing-lg);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
            padding: var(--spacing-sm);
            border-radius: 8px;
            transition: var(--transition);
        }

        .contact-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-icon {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
            opacity: 0.9;
        }

        .contact-item span {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .footer-bottom {
            text-align: center;
            padding-top: var(--spacing-lg);
            margin-top: var(--spacing-lg);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.6);
        }

        .footer-logo-section {
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-md);
        }

        .footer-left-content {
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-md);
        }

        .footer-text-content h3 {
            margin-top: 0;
        }

        .footer-brand-icon {
            width: 80px;
            height: 80px;
            background: var(--accent-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(44, 24, 16, 0.6);
            backdrop-filter: blur(10px);
            padding: var(--spacing-sm);
        }

        .modal-content {
            background-color: var(--background-primary);
            margin: 2% auto;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 450px;
            height: auto;
            max-height: 85vh;
            overflow: hidden;
            box-shadow: 0 32px 80px var(--shadow-heavy);
            animation: modalSlideIn 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 1px solid var(--border-color);
        }



        /* No Results Message */
        .no-results {
            text-align: center;
            padding: var(--spacing-2xl) var(--spacing-md);
            color: var(--text-secondary);
            display: none;
        }

        .no-results h3 {
            font-size: 1.3rem;
            margin-bottom: var(--spacing-sm);
            color: var(--primary-color);
        }

        .no-results p {
            font-size: 1rem;
            opacity: 0.8;
        }

        /* Login styles removed - katalog hanya untuk menampilkan produk */

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Sub Category Styles - Removed duplicate selectors */

        #subCategoryTitle {
            color: var(--primary-color);
            font-family: var(--font-primary);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: var(--spacing-lg);
            text-align: center;
            position: relative;
        }

        /* Removed - consolidated above */

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-60px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .close {
            color: var(--primary-color);
            position: absolute;
            right: var(--spacing-lg);
            top: var(--spacing-lg);
            font-size: 2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--background-secondary);
            border: 2px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(44, 24, 16, 0.15);
            z-index: 1000;
        }

        .close:hover,
        .close:focus {
            color: white;
            background: var(--accent-color);
            transform: rotate(90deg) scale(1.1);
            border-color: var(--accent-color);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
        }

        @media (max-width: 1024px) and (min-width: 769px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.2rem;
            }

            .product-card {
                height: 450px;
            }

            .product-image {
                height: 180px;
            }

            .product-info {
                padding: var(--spacing-md);
            }

            .product-name {
                font-size: 1.1rem;
                max-width: 15ch; /* Limit to 15 characters */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }


        }

        /* Consolidated Mobile Responsive Styles */
        @media (max-width: 768px) {
            /* Improve mobile viewport */
            body {
                overflow-x: hidden;
            }

            /* Hero Section - Full Screen on Mobile */
            .hero {
                min-height: 100vh;
                height: 100vh;
                padding: 0;
            }

            /* Header and Typography */
            .header {
                padding: var(--spacing-sm) 0;
            }

            .header h1 {
                font-size: 1.8rem;
                line-height: 1.2;
            }

            .section-title h2 {
                font-size: 1.8rem;
                line-height: 1.3;
            }

            .hero-title {
                font-size: 2.2rem;
                line-height: 1.2;
                margin-bottom: var(--spacing-sm);
            }

            .hero-title::before,
            .hero-title::after {
                display: none;
            }

            .hero-subtitle {
                font-size: 1rem;
                padding: 0 var(--spacing-md);
                line-height: 1.4;
            }

            .hero-tagline {
                font-size: 0.85rem;
                letter-spacing: 1px;
                margin-bottom: var(--spacing-md);
            }

            .nav-brand .brand-text {
                font-size: 1.1rem;
            }

            /* Improve navigation */
            .nav-container {
                padding: var(--spacing-sm) var(--spacing-md);
            }

            .nav-actions {
                gap: var(--spacing-sm);
            }

            /* Layout and Grid */
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-md);
            }

            .category-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: var(--spacing-md);
            }

            .subcategory-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: var(--spacing-md);
            }

            /* Enhanced Mobile Category Card Adjustments */
            .category-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-md);
                padding: 0 var(--spacing-sm);
            }

            .category-card {
                padding: var(--spacing-md);
                min-height: 140px;
                border-radius: 12px;
            }

            .category-name {
                font-size: 1rem;
                margin-bottom: 6px;
                line-height: 1.2;
                letter-spacing: 0.3px;
            }

            .category-description {
                font-size: 0.8rem;
                line-height: 1.3;
                -webkit-line-clamp: 3;
            }

            .subcategory-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-md);
            }

            .subcategory-card {
                padding: var(--spacing-md);
                min-height: 120px;
                border-radius: 10px;
            }

            .subcategory-name {
                font-size: 0.95rem;
                margin-bottom: 4px;
                line-height: 1.2;
                letter-spacing: 0.2px;
            }

            .subcategory-description {
                font-size: 0.75rem;
                line-height: 1.3;
                -webkit-line-clamp: 2;
            }

            .subcategory-section {
                padding: var(--spacing-lg);
                border-radius: 16px;
            }

            .stats {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: var(--spacing-md);
            }

            /* Footer Mobile Improvements */
            .footer {
                padding: var(--spacing-xl) 0 var(--spacing-md);
                margin-top: var(--spacing-xl);
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: var(--spacing-lg);
                text-align: center;
                padding: 0 var(--spacing-md);
            }

            .footer-left-content {
                flex-direction: column;
                align-items: center;
                gap: var(--spacing-md);
                margin-bottom: var(--spacing-lg);
            }

            .footer-logo-section {
                justify-content: center;
            }

            .footer-section h3 {
                font-size: 1.1rem;
                margin-bottom: var(--spacing-sm);
            }

            .footer-section p,
            .footer-section a {
                font-size: 0.9rem;
                line-height: 1.5;
            }

            .footer-contact {
                padding: var(--spacing-md);
                margin: 0;
            }

            .contact-item {
                justify-content: center;
                text-align: left;
                padding: var(--spacing-sm) var(--spacing-md);
            }

            .contact-item span {
                font-size: 0.9rem;
            }

            .footer-bottom {
                padding-top: var(--spacing-md);
                margin-top: var(--spacing-md);
                font-size: 0.8rem;
            }

            .footer-brand-icon {
                width: 60px;
                height: 60px;
                border-radius: 10px;
            }

            /* Product Cards */
            .product-card {
                height: 430px;
            }

            .product-image {
                height: 160px;
            }

            .product-info {
                padding: 0.8rem;
            }

            .product-name {
                font-size: 1rem;
                margin-bottom: 0.4rem;
                word-wrap: break-word;
                hyphens: auto;
                max-width: 15ch; /* Limit to 15 characters */
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }



            .product-price {
                font-size: 1.1rem;
                margin-bottom: var(--spacing-sm);
            }

            /* Container and Layout */
            .container {
                padding: 0 var(--spacing-md);
            }

            .stat-number {
                font-size: 2rem;
            }

            /* Category Filters */
            .category-filters {
                gap: var(--spacing-sm);
                margin: var(--spacing-md) 0;
            }

            .category-btn {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            /* Search Components - Responsive */
            .search-container {
                padding: var(--spacing-xl);
                margin: var(--spacing-lg) 0;
            }

            .search-and-filters-horizontal {
                flex-direction: column;
                gap: var(--spacing-md);
                align-items: center;
                justify-content: center;
            }

            .search-wrapper {
                width: 100%;
                max-width: 350px;
                order: 1;
            }

            .search-wrapper input {
                padding: 0.7rem 0.8rem;
                font-size: 0.85rem;
                width: 100%;
            }

            .filters-horizontal {
                flex-direction: column;
                gap: var(--spacing-sm);
                order: 2;
                width: 100%;
                max-width: 350px;
                align-items: center;
            }

            .filters-horizontal select {
                width: 100%;
                max-width: 350px;
                padding: 0.7rem 0.8rem;
            }

            /* Modal Styles */
            .modal {
                padding: var(--spacing-xs);
            }

            .modal-content {
                width: 95%;
                margin: 5% auto;
                max-height: 90vh;
                border-radius: var(--spacing-sm);
            }

            .login-modal-content {
                margin: 15% auto;
                width: 95%;
                padding: var(--spacing-xl);
            }

            /* Touch-friendly improvements */
            .category-btn,
            .btn {
                min-height: 44px;
                touch-action: manipulation;
            }

            .close {
                min-width: 44px;
                min-height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Improve text readability */
            .product-card {
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }

            /* Better spacing for small screens */
            .hero {
                padding: var(--spacing-lg) 0;
            }

            .section {
                padding: var(--spacing-lg) 0;
            }

            /* Mobile Slider Navigation */
            .slider-nav {
                width: 40px;
                height: 40px;
            }

            .slider-nav.prev {
                left: 15px;
            }

            .slider-nav.next {
                right: 15px;
            }

            .slider-nav svg {
                width: 16px;
                height: 16px;
            }

            .slider-indicators {
                bottom: 20px;
                gap: 8px;
            }

            .slider-indicator {
                width: 10px;
                height: 10px;
            }

            /* Product Modal */
            #productModal {
                padding: 0.1rem;
            }

            #productModal .modal-content {
                width: 95% !important;
                max-width: 400px !important;
                margin: 2% auto !important;
            }

            #productModal .modal-layout {
                flex-direction: column !important;
                gap: 0.1rem !important;
                padding: 0.3rem !important;
            }

            #productModal .image-container {
                min-height: 250px !important;
                height: 250px !important;
                margin-bottom: 0.1rem !important;
            }

            #productModal .content-container {
                padding: 0.1rem 0 !important;
                margin: 0 !important;
            }

            #productModal .content-container h3 {
                margin: 0.1rem 0 !important;
                font-size: 1.1rem !important;
            }

            #productModal .content-container p {
                margin: 0.05rem 0 !important;
                line-height: 1.2 !important;
            }

            #productModal .button-container {
                flex-direction: column !important;
                gap: 0.1rem !important;
                margin-top: 0.1rem !important;
            }

            #productModal .button-container button {
                padding: 0.4rem 0.7rem !important;
                font-size: 0.75rem !important;
                border-radius: 10px !important;
                margin: 0 !important;
            }
        }

            /* Mobile Kecil - Lebih Rapat */
            @media (max-width: 480px) {
                #productModal {
                    padding: 0.05rem;
                }

                #productModal .modal-content {
                    width: 98% !important;
                    max-width: 350px !important;
                    margin: 1% auto !important;
                }

                #productModal .modal-layout {
                    padding: 0.25rem !important;
                    gap: 0.05rem !important;
                }

                #productModal .image-container {
                    min-height: 200px !important;
                    height: 200px !important;
                    margin-bottom: 0.05rem !important;
                }

                #productModal .content-container {
                    padding: 0.05rem 0 !important;
                }

                #productModal .content-container h3 {
                    margin: 0.05rem 0 !important;
                    font-size: 1rem !important;
                }

                #productModal .content-container p {
                    margin: 0.02rem 0 !important;
                    font-size: 0.85rem !important;
                    line-height: 1.1 !important;
                }

                #productModal .button-container {
                    gap: 0.05rem !important;
                    margin-top: 0.05rem !important;
                }

                #productModal .button-container button {
                    padding: 0.35rem 0.6rem !important;
                    font-size: 0.65rem !important;
                }
            }

            /* Extra Small Mobile Devices */
            @media (max-width: 480px) {
                /* Hero Section - Full Screen on Extra Small Mobile */
                .hero {
                    min-height: 100vh;
                    height: 100vh;
                    padding: 0;
                }

                .hero-title {
                    font-size: 1.8rem;
                }

                .products-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: var(--spacing-sm);
                }

                .product-card {
                    height: 380px;
                    margin: 0 auto;
                    max-width: 280px;
                }

                .nav-container {
                    padding: var(--spacing-xs) var(--spacing-sm);
                }

                .container {
                    padding: 0 var(--spacing-sm);
                }

                .footer-content {
                    padding: 0 var(--spacing-sm);
                }

                .search-container {
                    width: 95% !important;
                    padding: var(--spacing-xs) var(--spacing-sm);
                }

                .category-filters {
                    flex-wrap: wrap;
                    justify-content: center;
                }

                .stats {
                    grid-template-columns: 1fr;
                    gap: var(--spacing-sm);
                }
            }

            /* Desktop - Layout Horizontal */
            @media (min-width: 769px) {
                #productModal .modal-content {
                    width: 80% !important;
                    max-width: 500px !important;
                }

                #productModal .modal-layout {
                    flex-direction: row !important;
                    gap: 1rem !important;
                    padding: 1rem !important;
                }

                #productModal .image-container {
                    flex: 1 !important;
                    min-height: 300px !important;
                    height: 300px !important;
                }

                #productModal .content-container {
                    flex: 1 !important;
                    padding: 0.5rem !important;
                }

                #productModal .button-container {
                    flex-direction: row !important;
                    gap: 0.5rem !important;
                    justify-content: center !important;
                }

                #productModal .button-container button {
                    padding: 0.7rem 1.2rem !important;
                    font-size: 0.9rem !important;
                }
            }
    </style>

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "WebSite",
        "name": "{{ App\Models\Setting::get('website_title', 'Fashion E-Catalog') }}",
        "description": "{{ App\Models\Setting::get('website_description', 'Discover the latest fashion trends and styles in our comprehensive e-catalog.') }}",
        "url": "{{ url('/') }}",
        "potentialAction": {
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "{{ url('/') }}?search={search_term_string}"
            },
            "query-input": "required name=search_term_string"
        },
        "publisher": {
            "@type": "Organization",
            "name": "{{ App\Models\Setting::get('website_title', 'Fashion E-Catalog') }}",
            "url": "{{ url('/') }}"
        }
    }
    </script>

    @if(isset($products) && $products->count() > 0)
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Fashion Products",
        "description": "Latest fashion products and trends",
        "numberOfItems": {{ $products->count() }},
        "itemListElement": [
            @foreach($products as $index => $product)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "Product",
                    "name": {!! json_encode($product->name) !!},
                    "description": {!! json_encode($product->description ?? '') !!},
                    "image": "{{ $product->main_image ? asset('storage/' . $product->main_image) : asset('images/placeholder.jpg') }}",
                    "url": "{{ url('/product/' . $product->id) }}",
                    "brand": {
                        "@type": "Brand",
                        "name": {!! json_encode(App\Models\Setting::get('website_title', 'Fashion E-Catalog')) !!}
                    },
                    "category": {!! json_encode($product->category ? $product->category : 'Fashion') !!},
                    "offers": {
                        "@type": "Offer",
                        "price": "{{ $product->price }}",
                        "priceCurrency": "IDR",
                        "availability": "https://schema.org/InStock",
                        "url": "{{ url('/product/' . $product->id) }}"
                    }
                }
            }
            @if(!$loop->last),@endif
            @endforeach
        ]
    }
    </script>
    @endif

    @if(isset($categories) && $categories->count() > 0)
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            }
            @foreach($categories as $index => $category)
            ,{
                "@type": "ListItem",
                "position": {{ $index + 2 }},
                "name": {!! json_encode($category->name) !!},
                "item": "{{ url('/category/' . $category->id) }}"
            }
            @endforeach
        ]
    }
    </script>
    @endif
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-brand">
                @php
                    $storeIcon = App\Models\Setting::get('store_icon');
                @endphp

                @if($storeIcon)
                    <div class="brand-icon">
                        <img src="{{ asset($storeIcon) }}" alt="Store Icon" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                    </div>
                @else
                    <div class="brand-icon">
                        <div class="icon-inner"></div>
                    </div>
                @endif
                <span class="brand-text">{{ App\Models\Setting::get('header_text', 'Fashion E-Catalog') }}</span>
            </a>
            <div class="nav-actions">
                </div>
        </div>
    </nav>

    <section class="hero">
        @php
            $backgroundImage = App\Models\Setting::get('background_image');
        @endphp
        
        @if($sliderImages->count() > 0)
        <!-- Slider Container -->
        <div class="slider-container" id="slider-container">
            <div class="slider-wrapper" id="slider-wrapper">
                @foreach($sliderImages as $index => $slide)
                <div class="slide" style="background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('{{ asset('storage/' . $slide->image_path) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
                @endforeach
            </div>
        </div>
        @else
        <!-- Static Background -->
        <div class="hero-bg" style="
            @if($backgroundImage)
                background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('{{ asset('storage/' . $backgroundImage) }}');
            @else
                background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('');
            @endif
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        "></div>
        @endif
        
        @if($sliderImages->count() > 1)
        <!-- Slider Navigation Buttons -->
        <button class="slider-nav prev" onclick="previousSlide()">
            <svg viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
            </svg>
        </button>
        <button class="slider-nav next" onclick="nextSlide()">
            <svg viewBox="0 0 24 24">
                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
            </svg>
        </button>
        
        <!-- Slider Indicators -->
        <div class="slider-indicators" id="slider-indicators">
            @foreach($sliderImages as $index => $slide)
                <div class="slider-indicator {{ $index === 0 ? 'active' : '' }}" onclick="goToSlide({{ $index }})"></div>
            @endforeach
        </div>
        @endif
        
        <div class="hero-content">
            <div class="hero-tagline">{{ App\Models\Setting::get('hero_tagline', 'Temukan Gaya Anda') }}</div>
            <h1 class="hero-title">{{ App\Models\Setting::get('hero_text', 'Katalog Fashion') }}</h1>
            <p class="hero-subtitle">{{ App\Models\Setting::get('hero_subtitle', 'Dimana Setiap Benang Menceritakan Kisah, dan Setiap Kisah Memiliki Arti') }}</p>


        </div>
    </section>





    <main class="container">
        <section class="section">
            <div class="section-title">
                <h2>Kategori</h2>
                <p>Pilih kategori produk yang Anda inginkan</p>
            </div>

            <div class="category-grid">
                <div class="category-card" onclick="filterProducts('all', event)" data-category-id="all">
                    <div class="category-name">Semua Produk</div>
                    <div class="category-description">Lihat semua produk yang tersedia</div>
                </div>

                <div class="category-card" onclick="filterProducts('new', event)" data-category-id="new">
                    <div class="category-name">New Item</div>
                    <div class="category-description">Produk terbaru dalam 3 hari terakhir</div>
                </div>

                @foreach($categories as $category)
                <div class="category-card" onclick="filterProducts('{{ $category->id }}', event)" data-category-id="{{ $category->id }}">
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
                    </div>
            </div>

            <!-- Search and Filters Section -->
            <div id="searchContainer" class="search-container">
                <div class="search-and-filters-horizontal">
                    <div class="search-wrapper">
                        <input type="text" id="searchInput" placeholder="Cari produk..." onkeyup="searchProducts()">
                    </div>
                    
                    <div class="filters-horizontal">
                        <select id="sortPrice" onchange="sortProducts(this.value)">
                            <option value="">-- Pilih --</option>
                            <option value="low-high">Harga Terendah</option>
                            <option value="high-low">Harga Tertinggi</option>
                        </select>

                        <select id="sortName" onchange="sortProducts(this.value)">
                            <option value="">-- Pilih --</option>
                            <option value="a-z">A - Z</option>
                            <option value="z-a">Z - A</option>
                        </select>

                        <select id="sortDate" onchange="sortProducts(this.value)">
                            <option value="">-- Pilih --</option>
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                        </select>
                    </div>
                </div>
            </div>

        </section>

        <section class="section">
            <div class="section-title">
                <h2>All Products</h2>
                <p>Browse our complete collection</p>
            </div>

            @if($products->count() > 0)
                <div class="products-grid">
                    @foreach($products as $product)
                    <div class="product-card" data-category="{{ strtolower($product->category) }}" data-product-id="{{ $product->id }}" onclick="showProductDetails({{ $product->id }})">
                        <div class="product-image">
                            @if($product->main_image)
                                <img src="{{ asset('storage/' . $product->main_image) }}"
                                     alt="{{ $product->name }}"
                                     loading="lazy"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                     onload="this.style.opacity='1';"
                                     style="opacity: 0; transition: opacity 0.3s ease;">
                                <div class="no-image" style="display: none;">📷 Image Not Available</div>
                            @else
                                <div class="no-image">📷 No Image</div>
                            @endif
                        </div>

                        <div class="product-info">
                            <div class="product-category">{{ $product->category }}@if($product->sub_category) - {{ $product->sub_category }}@endif</div>
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">Rp. {{ number_format($product->price, 0, ',', '.') }}</div>

                            @if($product->tags && count($product->tags) > 0)
                            <div class="product-tags">
                                @foreach(array_slice($product->tags, 0, 3) as $tag)
                                    <span class="tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="no-products">
                    <h3>No Products Available</h3>
                    <p>Check back later for new arrivals!</p>
                </div>
            @endif
        </section>

        <div id="noResults" class="no-results">
            <h3>Produk yang Anda cari tidak ditemukan</h3>
            <p>Coba gunakan kata kunci yang berbeda atau lihat semua produk kami.</p>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left-content">
                <div class="footer-logo-section">
                    @php
                        $storeIcon = App\Models\Setting::get('store_icon');
                    @endphp

                    @if($storeIcon)
                        <div class="footer-brand-icon">
                            <img src="{{ asset($storeIcon) }}" alt="Store Icon" style="width: 100%; height: 100%; object-fit: cover; object-position: center; border-radius: 8px;">
                        </div>
                    @else
                        <div class="footer-brand-icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 5L25 15H35L27.5 22.5L30 32.5L20 27.5L10 32.5L12.5 22.5L5 15H15L20 5Z" fill="white" opacity="0.9"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="footer-section footer-text-content">
                    <h3>{{ $settings['header_text'] }}</h3>
                    <p>{{ $settings['footer_text'] }}</p>
                </div>
            </div>
            <div class="footer-middle-space">
                <!-- Space kosong di tengah untuk tampilan yang rapi -->
            </div>
            <div class="footer-section footer-contact">
                <h3>Informasi Kontak</h3>
                <div class="contact-item">
                    <i class="contact-icon">📞</i>
                    <span>{{ $settings['contact_phone'] }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">✉️</i>
                    <span>{{ $settings['contact_email'] }}</span>
                </div>
                <div class="contact-item">
                    <i class="contact-icon">📍</i>
                    <span>{{ $settings['contact_address'] }}</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} Powered by PT. Era Cipta Digital</p>
        </div>
    </footer>



    <div id="productModal" class="product-modal">
        <div class="modal-container">
            <span onclick="closeModal()" class="modal-close">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <style>
        .product-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 1000;
            padding: 1rem;
            box-sizing: border-box;
        }

        .modal-container {
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            max-width: 900px;
            width: 100%;
            border-radius: 16px;
            overflow: hidden;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            color: #999;
            cursor: pointer;
            z-index: 1001;
            background: rgba(255, 255, 255, 0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: none;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 1);
            color: #333;
            transform: scale(1.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .product-modal {
                padding: 0.5rem;
            }
            
            .modal-container {
                max-width: 100%;
                width: 100%;
                max-height: 95vh;
                border-radius: 12px;
            }
            
            .modal-close {
                top: 10px;
                right: 15px;
                width: 35px;
                height: 35px;
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .product-modal {
                padding: 0.25rem;
            }
            
            .modal-container {
                border-radius: 8px;
                max-height: 98vh;
            }
            
            .modal-close {
                top: 8px;
                right: 12px;
                width: 32px;
                height: 32px;
                font-size: 20px;
            }
        }
    </style>

    <script>
        let currentProduct = null;
        let currentCategoryId = 'all';
        let currentSubcategoryId = null;

        // Search functionality
        function searchProducts() {
            const searchInput = document.getElementById('searchInput');
            if (!searchInput) {
                console.error('Search input not found');
                return;
            }

            const searchTerm = searchInput.value.toLowerCase().trim();
            
            // If search is empty, reapply current category/subcategory filter
            if (!searchTerm) {
                applyProductFilter();
                return;
            }

            // Show loading state
            showProductsLoading();

            // Build search parameters including current filters
            const params = new URLSearchParams();
            params.append('search', searchTerm);
            
            // Include current category filter if active
            if (currentCategoryId && currentCategoryId !== 'all') {
                params.append('category_id', currentCategoryId);
            }
            
            // Include current subcategory filter if active
            if (currentSubcategoryId && 
                currentSubcategoryId !== null && 
                currentSubcategoryId !== 'all' && 
                currentSubcategoryId !== '') {
                params.append('subcategory_id', currentSubcategoryId);
            }

            // Add timestamp to prevent caching
            params.append('_t', Date.now());

            const requestUrl = `/filter-products?${params.toString()}`;
            console.log('Searching products with URL:', requestUrl);

            fetch(requestUrl, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status} - ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(products => {
                    hideProductsLoading();
                    
                    // Validate response
                    if (!Array.isArray(products)) {
                        console.error('Invalid search response format:', products);
                        throw new Error('Format response pencarian tidak valid');
                    }
                    
                    // Filter products by search term on client side for better UX
                    const filteredProducts = products.filter(product => {
                        const productName = product.name.toLowerCase();
                        const categoryName = product.category_relation ? product.category_relation.name.toLowerCase() : '';
                        const subcategoryName = product.subcategory_relation ? product.subcategory_relation.name.toLowerCase() : '';
                        
                        return productName.includes(searchTerm) ||
                               categoryName.includes(searchTerm) ||
                               subcategoryName.includes(searchTerm);
                    });
                    
                    console.log(`Found ${filteredProducts.length} products matching search: "${searchTerm}"`);
                    updateProductDisplay(filteredProducts);
                })
                .catch(error => {
                    console.error('Error searching products:', error);
                    hideProductsLoading();
                    showErrorMessage('Gagal mencari produk. Silakan coba lagi.');
                });
        }

        // Scroll behavior dihapus - search bar akan tetap terlihat

        function showProductDetails(productId) {
            // Validate productId
            if (!productId || isNaN(productId)) {
                showErrorMessage('Invalid product ID');
                return;
            }

            // Show loading state
            showLoadingModal();

            fetch(`/product/${productId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(product => {
                    if (!product) {
                        throw new Error('Product data is empty');
                    }
                    currentProduct = product;
                    const modal = document.getElementById('productModal');
                    const content = document.getElementById('modalContent');

                    let imageHtml = '';
                    if (product.images && product.images.length > 0) {
                        const mainImage = product.images.find(img => img.is_primary) || product.images[0];
                        imageHtml = `
                            <div class="image-gallery" style="width: 100%; max-width: 1000px; margin: 0 auto;">
                                <div class="main-image-container" style="position: relative; margin-bottom: 1rem;">
                                    <img id="mainImage"
                                         src="/storage/${mainImage.image_path}"
                                         alt="${mainImage.alt_text || product.name}"
                                         loading="lazy"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                         onload="this.style.opacity='1'; this.nextElementSibling.style.display='none';"
                                         style="width: 100%; max-height: 500px; height: auto; object-fit: contain; border-radius: 8px; display: block; opacity: 0; transition: opacity 0.3s ease;">
                                    <div class="image-fallback" style="width: 100%; height: 300px; background: #f8f9fa; display: none; align-items: center; justify-content: center; color: #6c757d; font-size: 1rem; border-radius: 8px; border: 2px dashed #dee2e6;">📷 Image Not Available</div>
                                    ${mainImage.is_primary ? '<span class="primary-badge" style="position: absolute; top: 10px; left: 10px; background: #28a745; color: white; padding: 0.3rem 0.6rem; border-radius: 15px; font-size: 0.7rem; font-weight: 600;">Primary</span>' : ''}
                                </div>
                                ${product.images.length > 1 ? `
                                    <div class="image-thumbnails" style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                        ${product.images.map((img, index) => `
                                            <img src="/storage/${img.image_path}"
                                                 alt="${img.alt_text || product.name}"
                                                 loading="lazy"
                                                 onclick="changeMainImageModal('${img.image_path}', '${img.alt_text || product.name}', ${img.is_primary})"
                                                 onerror="this.style.display='none';"
                                                 onload="this.style.opacity='1';"
                                                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px; cursor: pointer; border: 2px solid ${img.is_primary ? '#28a745' : '#ddd'}; transition: all 0.3s ease; opacity: 0;"
                                                 onmouseover="this.style.borderColor='#007bff'"
                                                 onmouseout="this.style.borderColor='${img.is_primary ? '#28a745' : '#ddd'}'">
                                        `).join('')}
                                    </div>
                                ` : ''}
                            </div>
                        `;
                    } else {
                        imageHtml = `<div style="width: 100%; height: 200px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 0.9rem; border-radius: 8px;">No Image Available</div>`;
                    }

                    const tagsHtml = product.tags && product.tags.length > 0
                         ? `<div style="margin: 0.8rem 0;"><strong style="color: var(--primary-color); font-weight: 600; font-size: 0.9rem;">Tags:</strong> ${product.tags.map(tag => `<span style="background: var(--background-tertiary); color: var(--secondary-color); padding: 0.3rem 0.8rem; border-radius: 15px; font-size: 0.7rem; margin: 0 0.2rem; font-weight: 600; border: 1px solid var(--border-color);">${tag}</span>`).join('')}</div>`
                         : '';

                    const featuredBadge = product.featured
                        ? `<span style="background: linear-gradient(135deg, #ffd700, #ffed4e); color: #333; padding: 0.3rem 0.8rem; border-radius: 15px; font-size: 0.7rem; font-weight: 600; margin-left: 0.5rem;">⭐ Featured</span>`
                        : '';

                    content.innerHTML = `
                        <div class="modal-layout">
                            <!-- Image Section -->
                            <div class="image-container">
                                ${imageHtml}
                            </div>
                            
                            <!-- Content Section -->
                            <div class="content-container">
                                <div class="product-header">
                                    <h2 class="product-title">${product.name}</h2>
                                    <p class="product-category-text">${product.category}${product.sub_category ? ` - ${product.sub_category}` : ''}</p>
                                    <div class="product-price-text">Rp. ${new Intl.NumberFormat('id-ID').format(product.price)}</div>
                                </div>
                                
                                <div class="product-details">
                                    <h3 class="details-title">Detail Produk</h3>
                                    <p class="product-description-text">${product.description}</p>
                                    
                                    <div class="stock-info">
                                        <div class="stock-row">
                                            <span class="stock-label">Stok Tersedia:</span>
                                            <span class="stock-value ${product.stock > 0 ? 'in-stock' : 'out-of-stock'}">
                                                ${product.stock > 0 ? `${product.stock}` : 'Habis'}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    ${tagsHtml}
                                </div>
                                
                                <div class="button-container">
                                    <button id="whatsappBtn" class="whatsapp-btn">Hubungi Penjual</button>
                                </div>
                            </div>
                        </div>
                        <style>
                            .modal-layout {
                                display: flex;
                                gap: 2rem;
                                padding: 2rem;
                                background: white;
                                min-height: 400px;
                                width: 100%;
                                box-sizing: border-box;
                                overflow: hidden;
                            }

                            .image-container {
                                flex: 1;
                                max-width: 450px;
                                min-width: 300px;
                            }

                            .image-container img {
                                width: 100%;
                                height: auto;
                                border-radius: 12px;
                                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
                            }

                            .content-container {
                                flex: 1;
                                display: flex;
                                flex-direction: column;
                                gap: 1.5rem;
                                padding-left: 1rem;
                                min-width: 0;
                                overflow: hidden;
                            }

                            .product-header {
                                border-bottom: 1px solid #eee;
                                padding-bottom: 1rem;
                            }

                            .product-title {
                                font-family: var(--font-primary, 'Arial', sans-serif);
                                font-size: 1.8rem;
                                margin-bottom: 0.5rem;
                                font-weight: 600;
                                color: #333;
                                line-height: 1.3;
                                word-wrap: break-word;
                                overflow-wrap: break-word;
                                hyphens: auto;
                            }

                            .product-category-text {
                                font-size: 1rem;
                                color: #666;
                                margin-bottom: 0.8rem;
                                text-transform: uppercase;
                                letter-spacing: 0.5px;
                                font-weight: 500;
                            }

                            .product-price-text {
                                font-family: var(--font-primary, 'Arial', sans-serif);
                                font-size: 1.8rem;
                                font-weight: 700;
                                color: #e74c3c;
                                margin-bottom: 0;
                            }

                            .product-details {
                                flex: 1;
                            }

                            .details-title {
                                color: #333;
                                margin-bottom: 1rem;
                                font-size: 1.3rem;
                                font-weight: 600;
                                border-left: 4px solid #3498db;
                                padding-left: 1rem;
                            }

                            .product-description-text {
                                color: #555;
                                line-height: 1.7;
                                font-size: 1rem;
                                margin-bottom: 1.5rem;
                                text-align: justify;
                                word-wrap: break-word;
                                overflow-wrap: break-word;
                                white-space: pre-wrap;
                                hyphens: auto;
                            }

                            .stock-info {
                                background: linear-gradient(135deg, #f8f9fa, #e9ecef);
                                padding: 1.2rem;
                                border-radius: 12px;
                                margin-bottom: 1.5rem;
                                border: 1px solid #dee2e6;
                                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                            }

                            .stock-row {
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                            }

                            .stock-label {
                                font-weight: 600;
                                color: #333;
                                font-size: 1.1rem;
                            }

                            .stock-value {
                                font-weight: 700;
                                font-size: 1.2rem;
                                padding: 0.3rem 0.8rem;
                                border-radius: 20px;
                                text-transform: uppercase;
                                letter-spacing: 0.5px;
                            }

                            .stock-value.in-stock {
                                color: #27ae60;
                                background: rgba(39, 174, 96, 0.1);
                                border: 1px solid rgba(39, 174, 96, 0.3);
                            }

                            .stock-value.out-of-stock {
                                color: #e74c3c;
                                background: rgba(231, 76, 60, 0.1);
                                border: 1px solid rgba(231, 76, 60, 0.3);
                            }

                            .button-container {
                                margin-top: auto;
                                padding-top: 1rem;
                            }

                            .whatsapp-btn {
                                background: linear-gradient(135deg, #25D366, #20b358);
                                color: white;
                                border: none;
                                padding: 1rem 2rem;
                                border-radius: 12px;
                                cursor: pointer;
                                font-size: 1.1rem;
                                font-weight: 600;
                                transition: all 0.3s ease;
                                width: 100%;
                                max-width: 350px;
                                box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
                                text-transform: uppercase;
                                letter-spacing: 0.5px;
                            }

                            .whatsapp-btn:hover {
                                background: linear-gradient(135deg, #20b358, #1da851);
                                transform: translateY(-2px);
                                box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
                            }

                            .whatsapp-btn:active {
                                transform: translateY(0);
                            }

                            /* Responsive Design */
                            @media (max-width: 768px) {
                                .modal-layout {
                                    flex-direction: column;
                                    gap: 1.5rem;
                                    padding: 1.5rem;
                                }
                                
                                .image-container {
                                    max-width: 100%;
                                    min-width: auto;
                                }
                                
                                .content-container {
                                    padding-left: 0;
                                }
                                
                                .product-title {
                                    font-size: 1.5rem;
                                }
                                
                                .product-price-text {
                                    font-size: 1.5rem;
                                }
                                
                                .details-title {
                                    font-size: 1.2rem;
                                }
                                
                                .product-description-text {
                                    font-size: 0.95rem;
                                }
                                
                                .whatsapp-btn {
                                    font-size: 1rem;
                                    padding: 0.9rem 1.5rem;
                                    max-width: none;
                                }
                            }

                            @media (max-width: 480px) {
                                .modal-layout {
                                    padding: 1rem;
                                    gap: 1rem;
                                }
                                
                                .product-title {
                                    font-size: 1.3rem;
                                }
                                
                                .product-price-text {
                                    font-size: 1.4rem;
                                }
                                
                                .details-title {
                                    font-size: 1.1rem;
                                }
                                
                                .product-description-text {
                                    font-size: 0.9rem;
                                }
                                
                                .stock-info {
                                    padding: 1rem;
                                }
                                
                                .stock-label {
                                    font-size: 1rem;
                                }
                                
                                .stock-value {
                                    font-size: 1.1rem;
                                }
                                
                                .whatsapp-btn {
                                    font-size: 0.95rem;
                                    padding: 0.8rem 1.2rem;
                                }
                            }
                        </style>
                    `;

                    // Setup WhatsApp button
                    const whatsappBtn = document.getElementById('whatsappBtn');
                    whatsappBtn.onclick = function() {
                        const message = `Halo saya tertarik dengan "${product.name}"`;
                        const whatsappUrl = `https://wa.me/6281375307821?text=${encodeURIComponent(message)}`;
                        window.open(whatsappUrl, '_blank');
                    };

                    modal.style.display = 'block';
                    hideLoadingModal();
                })
                .catch(error => {
                    console.error('Error fetching product details:', error);
                    hideLoadingModal();
                    showErrorMessage('Gagal memuat detail produk. Silakan coba lagi.');
                });
        }

        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
        }

        // Login functions removed - admin login melalui URL khusus



        // Global variables for current filter state
        // currentCategoryId and currentSubcategoryId are declared above
        
        // URL routing functions
        function updateURL(categoryId, subcategoryId) {
            const url = new URL(window.location);
            
            if (categoryId) {
                url.searchParams.set('category', categoryId);
            } else {
                url.searchParams.delete('category');
            }
            
            if (subcategoryId && subcategoryId !== 'all') {
                url.searchParams.set('subcategory', subcategoryId);
            } else {
                url.searchParams.delete('subcategory');
            }
            
            // Update URL without page reload
            window.history.pushState({categoryId, subcategoryId}, '', url);
        }
        
        function getURLParams() {
            const urlParams = new URLSearchParams(window.location.search);
            return {
                categoryId: urlParams.get('category'),
                subcategoryId: urlParams.get('subcategory')
            };
        }
        
        function loadFromURL() {
            const params = getURLParams();
            
            if (params.categoryId) {
                // Set category without triggering URL update
                currentCategoryId = parseInt(params.categoryId);
                
                // Update category visual state
                document.querySelectorAll('.category-card').forEach(card => {
                    card.classList.remove('active');
                    if (card.getAttribute('data-category-id') == params.categoryId) {
                        card.classList.add('active');
                    }
                });
                
                // Load subcategories
                loadSubcategories(params.categoryId);
                
                // If subcategory is specified, wait for subcategories to load then select it
                if (params.subcategoryId) {
                    setTimeout(() => {
                        currentSubcategoryId = params.subcategoryId === 'all' ? null : parseInt(params.subcategoryId);
                        
                        // Update subcategory visual state
                        document.querySelectorAll('.subcategory-card').forEach(card => {
                            card.classList.remove('active');
                            const cardSubcategoryId = card.getAttribute('data-subcategory-id');
                            if ((params.subcategoryId === 'all' && cardSubcategoryId === 'all') ||
                                (cardSubcategoryId == params.subcategoryId)) {
                                card.classList.add('active');
                            }
                        });
                        
                        // Apply filter
                        applyProductFilter();
                    }, 500);
                } else {
                    // Apply filter for category only
                    applyProductFilter();
                }
            }
        }
        
        // State management functions
        function resetFilterState() {
            currentCategoryId = 'all';
            currentSubcategoryId = null;
            
            // Clear search input
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.value = '';
            }
            
            // Reset sorting dropdowns
            const sortPrice = document.getElementById('sortPrice');
            const sortName = document.getElementById('sortName');
            const sortDate = document.getElementById('sortDate');
            
            if (sortPrice) sortPrice.value = '';
            if (sortName) sortName.value = '';
            if (sortDate) sortDate.value = '';
            
            // Reset active states
            document.querySelectorAll('.category-card').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.subcategory-card').forEach(btn => btn.classList.remove('active'));
            
            // Set 'Semua Produk' as active
            const allProductsCard = document.querySelector('.category-card[onclick*="all"]');
            if (allProductsCard) {
                allProductsCard.classList.add('active');
            }
        }
        
        function getCurrentFilterState() {
            return {
                categoryId: currentCategoryId,
                subcategoryId: currentSubcategoryId,
                searchTerm: document.getElementById('searchInput')?.value || '',
                sortPrice: document.getElementById('sortPrice')?.value || '',
                sortName: document.getElementById('sortName')?.value || '',
                sortDate: document.getElementById('sortDate')?.value || ''
            };
        }
        
        function validateFilterState() {
            // Ensure currentCategoryId is valid
            if (!currentCategoryId || currentCategoryId === '') {
                currentCategoryId = 'all';
            }
            
            // Ensure currentSubcategoryId is valid when category is 'all' or 'new'
            if (currentCategoryId === 'all' || currentCategoryId === 'new') {
                currentSubcategoryId = null;
            }
            
            return true;
        }

        // Category Filter Functions
        function filterProducts(categoryId, sourceEvent = null) {
            // Validate categoryId
            if (!categoryId) {
                console.error('Invalid category ID');
                return;
            }

            currentCategoryId = categoryId;
            currentSubcategoryId = null; // Reset subcategory when changing category
            
            // Validate the new state
            validateFilterState();

            // Update active state for category cards
            if (sourceEvent && (sourceEvent.target.classList.contains('category-card') || sourceEvent.target.closest('.category-card'))) {
                const buttons = document.querySelectorAll('.category-card');
                buttons.forEach(btn => btn.classList.remove('active'));
                const targetCard = sourceEvent.target.classList.contains('category-card') ? sourceEvent.target : sourceEvent.target.closest('.category-card');
                if (targetCard) {
                    targetCard.classList.add('active');
                }
            }

            // Clear search input and reset sorting when filtering by category
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.value = '';
            }
            
            // Reset all sorting dropdowns
            const sortSelects = ['sortPrice', 'sortName', 'sortDate'];
            sortSelects.forEach(selectId => {
                const select = document.getElementById(selectId);
                if (select) {
                    select.value = '';
                }
            });

            // Update URL
            updateURL(categoryId, null);

            // Load subcategories only if category is not 'all' or 'new'
            if (categoryId !== 'all' && categoryId !== 'new') {
                loadSubcategories(categoryId);
            } else {
                hideSubcategories();
            }

            // Apply filter
            applyProductFilter();
        }

        // Load subcategories for selected category
        function loadSubcategories(categoryId) {
            // Validate categoryId
            if (!categoryId || isNaN(categoryId)) {
                console.error('Invalid category ID');
                hideSubcategories();
                return;
            }

            // Show loading state for subcategories
            showSubcategoryLoading();

            fetch(`/subcategories/${categoryId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(subcategories => {
                    hideSubcategoryLoading();
                    const subcategoryGrid = document.getElementById('subcategoryGrid');
                    const subcategorySection = document.getElementById('subcategorySection');

                    if (subcategories.length > 0) {
                        // Build subcategory cards
                        let subcategoryHTML = `
                            <div class="subcategory-card active" onclick="filterBySubcategory(null, event)" data-subcategory-id="all">
                                <div class="subcategory-name">Semua Sub Kategori</div>
                                <div class="subcategory-description">Tampilkan semua produk dalam kategori ini</div>
                            </div>
                        `;

                        subcategories.forEach(subcategory => {
                            subcategoryHTML += `
                                <div class="subcategory-card" onclick="filterBySubcategory(${subcategory.id}, event)" data-subcategory-id="${subcategory.id}">
                                    <div class="subcategory-name">${subcategory.name}</div>
                                    <div class="subcategory-description">${subcategory.description || ''}</div>
                                </div>
                            `;
                        });

                        subcategoryGrid.innerHTML = subcategoryHTML;
                        subcategorySection.style.display = 'block';
                    } else {
                        hideSubcategories();
                    }
                    hideSubcategoryLoading();
                })
                .catch(error => {
                    console.error('Error loading subcategories:', error);
                    hideSubcategoryLoading();
                    hideSubcategories();
                    showErrorMessage('Gagal memuat sub kategori.');
                });
        }

        // Hide subcategories section
        function hideSubcategories() {
            document.getElementById('subcategorySection').style.display = 'none';
        }



        // Filter by subcategory
        function filterBySubcategory(subcategoryId, sourceEvent = null) {
            // Set subcategoryId to null if 'all' is selected or if subcategoryId is null
            currentSubcategoryId = (subcategoryId === null || subcategoryId === 'all') ? null : subcategoryId;

            // Update active state for subcategory cards
            if (sourceEvent) {
                const buttons = document.querySelectorAll('.subcategory-card');
                buttons.forEach(btn => btn.classList.remove('active'));
                const targetCard = sourceEvent.target.classList.contains('subcategory-card') ? sourceEvent.target : sourceEvent.target.closest('.subcategory-card');
                if (targetCard) {
                    targetCard.classList.add('active');
                }
            }

            // Apply filter
            applyProductFilter();
        }

        // Apply product filter based on current category and subcategory
        function applyProductFilter() {
            // Validate and fix current state
            validateFilterState();
            
            // Double-check state after validation
            if (!currentCategoryId) {
                console.error('No category selected');
                showErrorMessage('Silakan pilih kategori terlebih dahulu.');
                return;
            }

            // Show loading state with smooth animation
            showProductsLoading();
            
            // Add visual feedback to active category
            updateCategoryVisualFeedback();

            // Build request parameters
            const params = new URLSearchParams();
            params.append('category_id', currentCategoryId);
            
            // Only add subcategory_id if it's valid
            if (currentSubcategoryId && 
                currentSubcategoryId !== null && 
                currentSubcategoryId !== 'all' && 
                currentSubcategoryId !== '') {
                params.append('subcategory_id', currentSubcategoryId);
            }

            // Add timestamp to prevent caching
            params.append('_t', Date.now());

            const requestUrl = `/filter-products?${params.toString()}`;
            console.log('Filtering products with URL:', requestUrl);

            fetch(requestUrl, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status} - ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(products => {
                    hideProductsLoading();
                    
                    // Validate response
                    if (!Array.isArray(products)) {
                        console.error('Invalid response format:', products);
                        throw new Error('Format response tidak valid');
                    }
                    
                    console.log(`Loaded ${products.length} products for category ${currentCategoryId}${currentSubcategoryId ? `, subcategory ${currentSubcategoryId}` : ''}`);
                    updateProductDisplay(products);
                })
                .catch(error => {
                    console.error('Error filtering products:', error);
                    hideProductsLoading();
                    
                    // Show user-friendly error message
                    let errorMessage = 'Gagal memuat produk. Silakan coba lagi.';
                    if (error.message.includes('404')) {
                        errorMessage = 'Kategori tidak ditemukan.';
                    } else if (error.message.includes('500')) {
                        errorMessage = 'Terjadi kesalahan server. Silakan coba lagi nanti.';
                    }
                    
                    showErrorMessage(errorMessage);
                });
        }

        // Enhanced loading and visual feedback functions
        function updateCategoryVisualFeedback() {
            // Add pulse effect to active category
            const activeCategory = document.querySelector('.category-card.active');
            if (activeCategory) {
                activeCategory.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    activeCategory.style.transform = 'scale(1)';
                }, 150);
            }
        }
        
        function showProductsLoading() {
            const productGrid = document.querySelector('.products-grid');
            if (productGrid) {
                productGrid.style.opacity = '0.6';
                productGrid.style.pointerEvents = 'none';
                
                // Add loading spinner if not exists
                let loadingSpinner = document.getElementById('productsLoadingSpinner');
                if (!loadingSpinner) {
                    loadingSpinner = document.createElement('div');
                    loadingSpinner.id = 'productsLoadingSpinner';
                    loadingSpinner.innerHTML = `
                        <div class="loading-spinner">
                            <div class="spinner"></div>
                            <p>Memuat produk...</p>
                        </div>
                    `;
                    loadingSpinner.style.cssText = `
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        z-index: 1000;
                        text-align: center;
                    `;
                    productGrid.parentNode.style.position = 'relative';
                    productGrid.parentNode.appendChild(loadingSpinner);
                }
                loadingSpinner.style.display = 'block';
            }
        }
        
        function hideProductsLoading() {
            const productGrid = document.querySelector('.products-grid');
            const loadingSpinner = document.getElementById('productsLoadingSpinner');
            
            if (productGrid) {
                productGrid.style.opacity = '1';
                productGrid.style.pointerEvents = 'auto';
            }
            
            if (loadingSpinner) {
                loadingSpinner.style.display = 'none';
            }
        }
        
        function showSubcategoryLoading() {
            const subcategoryGrid = document.getElementById('subcategoryGrid');
            if (subcategoryGrid) {
                subcategoryGrid.innerHTML = `
                    <div class="subcategory-loading">
                        <div class="loading-spinner">
                            <div class="spinner"></div>
                            <p>Memuat sub kategori...</p>
                        </div>
                    </div>
                `;
            }
        }
        
        function hideSubcategoryLoading() {
            // Loading will be replaced by actual content
        }
        
        function showErrorMessage(message) {
            // Create or update error message
            let errorDiv = document.getElementById('errorMessage');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.id = 'errorMessage';
                errorDiv.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: #ff4757;
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(255, 71, 87, 0.3);
                    z-index: 10000;
                    font-weight: 500;
                    max-width: 300px;
                    transform: translateX(100%);
                    transition: transform 0.3s ease;
                `;
                document.body.appendChild(errorDiv);
            }
            
            errorDiv.textContent = message;
            errorDiv.style.transform = 'translateX(0)';
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                errorDiv.style.transform = 'translateX(100%)';
            }, 5000);
        }

        // Update product display with filtered results
        function updateProductDisplay(products) {
            const productGrid = document.querySelector('.products-grid');
            const noResults = document.getElementById('noResults');

            if (!productGrid) {
                console.error('Product grid not found');
                return;
            }

            // Add fade-in animation
            productGrid.style.opacity = '0';
            
            setTimeout(() => {
                if (products.length === 0) {
                    productGrid.innerHTML = '';
                    if (noResults) {
                        noResults.style.display = 'block';
                    }
                    productGrid.style.opacity = '1';
                    return;
                }

                if (noResults) {
                    noResults.style.display = 'none';
                }

            let productHTML = '';
            products.forEach(product => {
                // Handle image URL with fallback
                const imageUrl = product.images && product.images.length > 0
                    ? `/storage/${product.images[0].image_path}`
                    : '/images/no-image.jpg';

                // Get category and subcategory names properly
                const categoryName = product.category_relation ? product.category_relation.name : 
                                   (product.category || 'Unknown Category');
                const subcategoryName = product.subcategory_relation ? product.subcategory_relation.name : null;
                
                // Display subcategory if available, otherwise show category
                const displayCategory = subcategoryName || categoryName;
                
                // Set data attributes for filtering
                const categoryId = product.category_id || '';
                const subcategoryId = product.subcategory_id || '';

                productHTML += `
                    <div class="product-card" 
                         data-category="${categoryName.toLowerCase()}" 
                         data-category-id="${categoryId}"
                         data-subcategory-id="${subcategoryId}"
                         data-product-id="${product.id}" 
                         onclick="showProductDetails(${product.id})">
                        <div class="product-image">
                            <img src="${imageUrl}" 
                                 alt="${product.name}" 
                                 loading="lazy"
                                 onerror="this.src='/images/no-image.jpg'; this.onerror=null;"
                                 onload="this.style.opacity='1';"
                                 style="opacity: 0; transition: opacity 0.3s ease;">
                        </div>
                        <div class="product-info">
                            <h3 class="product-name">${product.name}</h3>
                            <p class="product-category">${displayCategory}</p>
                            <p class="product-price">Rp ${parseInt(product.price).toLocaleString('id-ID')}</p>
                        </div>
                    </div>
                `;
            });

            productGrid.innerHTML = productHTML;
                
                // Fade in the new content
                productGrid.style.opacity = '1';
                
                // Hide loading spinner
                hideProductsLoading();

                // Add event listeners for product modals
                document.querySelectorAll('.product-card').forEach(card => {
                    card.addEventListener('click', function() {
                        const productId = this.getAttribute('data-product-id');
                        if (productId) {
                            openProductModal(productId);
                        }
                    });
                });
            }, 300); // Small delay for smooth transition
        }



        // Close modal when clicking outside
        document.getElementById('productModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
        
        // Handle browser back/forward buttons
        window.addEventListener('popstate', function(event) {
            if (event.state) {
                // Load state from history
                currentCategoryId = event.state.categoryId;
                currentSubcategoryId = event.state.subcategoryId;
                
                // Update visual states and apply filter
                loadFromURL();
            } else {
                // No state, load from URL parameters
                loadFromURL();
            }
        });
        
        // Load initial state from URL when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Small delay to ensure all elements are loaded
            setTimeout(() => {
                loadFromURL();
            }, 100);
        });

        // Login modal event listeners removed - admin login melalui URL khusus

        // Function to change main image in modal
        function changeMainImageModal(imagePath, altText, isPrimary) {
            const mainImage = document.getElementById('mainImage');
            const primaryBadge = document.querySelector('.primary-badge');
            const imageFallback = document.querySelector('.image-fallback');

            if (mainImage) {
                // Reset image state
                mainImage.style.opacity = '0';
                mainImage.style.display = 'block';
                if (imageFallback) {
                    imageFallback.style.display = 'none';
                }

                // Set new image source
                mainImage.src = '/storage/' + imagePath;
                mainImage.alt = altText;

                // Handle image load success
                mainImage.onload = function() {
                    this.style.opacity = '1';
                    if (imageFallback) {
                        imageFallback.style.display = 'none';
                    }
                };

                // Handle image load error
                mainImage.onerror = function() {
                    this.style.display = 'none';
                    if (imageFallback) {
                        imageFallback.style.display = 'flex';
                    }
                };

                // Update primary badge
                if (primaryBadge) {
                    primaryBadge.style.display = isPrimary ? 'block' : 'none';
                }
            }
        }

        // New Category Filter Functions
        function filterByCategory(category) {
            const products = document.querySelectorAll('.product-card');
            const noResults = document.getElementById('noResults');
            const categoryButtons = document.querySelectorAll('.category-btn');
            let hasResults = false;

            // Update active button
            categoryButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Clear search input and reset sorting
            document.getElementById('searchInput').value = '';
            document.getElementById('sortPrice').value = '';
            document.getElementById('sortName').value = '';
            document.getElementById('sortDate').value = '';

            // Filter products
            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                const productName = product.querySelector('.product-name').textContent.toLowerCase();
                const productElement = product.querySelector('.product-category').textContent.toLowerCase();
                const isNewItem = isProductNew(product); // Check if product is new (created within last 30 days)

                let shouldShow = false;

                if (category === 'semua-produk') {
                    shouldShow = true;
                } else if (category === 'new-items') {
                    shouldShow = isNewItem;
                } else {
                    shouldShow = productCategory === category ||
                               productCategory.includes(category) ||
                               productElement.includes(category);
                }

                if (shouldShow) {
                    product.style.display = 'block';
                    hasResults = true;
                } else {
                    product.style.display = 'none';
                }
            });

            // Show/hide no results message
            noResults.style.display = hasResults ? 'none' : 'block';
        }

        // Check if product is new (created within last 30 days)
        function isProductNew(productElement) {
            // This would need to be implemented based on product creation date
            // Check if product has 'new' in tags
            const productInfo = productElement.querySelector('.product-info');
            const tags = productInfo.querySelector('.product-tags');

            if (tags) {
                const tagElements = tags.querySelectorAll('.tag');
                for (let tag of tagElements) {
                    if (tag.textContent.toLowerCase().includes('new') ||
                        tag.textContent.toLowerCase().includes('baru')) {
                        return true;
                    }
                }
            }

            return false;
        }

        // Sort Products Function
        function sortProducts(sortType) {
            const productsGrid = document.querySelector('.products-grid');
            const products = Array.from(document.querySelectorAll('.product-card:not([style*="display: none"])'));

            // Clear other sort selects
            if (event.target.id === 'sortPrice') {
                document.getElementById('sortName').value = '';
                document.getElementById('sortDate').value = '';
            } else if (event.target.id === 'sortName') {
                document.getElementById('sortPrice').value = '';
                document.getElementById('sortDate').value = '';
            } else if (event.target.id === 'sortDate') {
                document.getElementById('sortPrice').value = '';
                document.getElementById('sortName').value = '';
            }

            if (!sortType) return;

            products.sort((a, b) => {
                switch (sortType) {
                    case 'low-high':
                        const priceA = parseInt(a.querySelector('.product-price').textContent.replace(/[^0-9]/g, ''));
                        const priceB = parseInt(b.querySelector('.product-price').textContent.replace(/[^0-9]/g, ''));
                        return priceA - priceB;

                    case 'high-low':
                        const priceA2 = parseInt(a.querySelector('.product-price').textContent.replace(/[^0-9]/g, ''));
                        const priceB2 = parseInt(b.querySelector('.product-price').textContent.replace(/[^0-9]/g, ''));
                        return priceB2 - priceA2;

                    case 'a-z':
                        const nameA = a.querySelector('.product-name').textContent.toLowerCase();
                        const nameB = b.querySelector('.product-name').textContent.toLowerCase();
                        return nameA.localeCompare(nameB);

                    case 'z-a':
                        const nameA2 = a.querySelector('.product-name').textContent.toLowerCase();
                        const nameB2 = b.querySelector('.product-name').textContent.toLowerCase();
                        return nameB2.localeCompare(nameA2);

                    case 'newest':
                        // Sort by data-product-id (assuming higher ID = newer)
                        const idA = parseInt(a.getAttribute('data-product-id'));
                        const idB = parseInt(b.getAttribute('data-product-id'));
                        return idB - idA;

                    case 'oldest':
                        const idA2 = parseInt(a.getAttribute('data-product-id'));
                        const idB2 = parseInt(b.getAttribute('data-product-id'));
                        return idA2 - idB2;

                    default:
                        return 0;
                }
            });

            // Re-append sorted products to grid
            products.forEach(product => {
                productsGrid.appendChild(product);
            });
        }



        // Image Loading and Performance Functions
        function preloadCriticalImages() {
            // Preload first few product images for better performance
            const firstImages = document.querySelectorAll('.product-image img');
            const imagesToPreload = Array.from(firstImages).slice(0, 6); // Preload first 6 images

            imagesToPreload.forEach(img => {
                if (img.src && !img.complete) {
                    const preloadImg = new Image();
                    preloadImg.src = img.src;
                }
            });
        }

        function initLazyLoading() {
            // Enhanced lazy loading with Intersection Observer
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                            }
                            img.classList.remove('lazy');
                            observer.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '50px 0px',
                    threshold: 0.01
                });

                document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        }

        // Helper functions for loading states and error handling
        function showLoadingModal() {
            const modal = document.getElementById('productModal');
            const content = document.getElementById('modalContent');
            content.innerHTML = `
                <div style="display: flex; justify-content: center; align-items: center; height: 300px; flex-direction: column;">
                    <div class="loading-spinner" style="border: 4px solid #f3f3f3; border-top: 4px solid #5d4037; border-radius: 50%; width: 50px; height: 50px; animation: spin 1s linear infinite;"></div>
                    <p style="margin-top: 1rem; color: #999;">Memuat detail produk...</p>
                </div>
                <style>
                    @keyframes spin {
                        0% { transform: rotate(0deg); }
                        100% { transform: rotate(360deg); }
                    }
                </style>
            `;
            modal.style.display = 'block';
        }

        function hideLoadingModal() {
            // Modal will be updated with content or closed
        }

        // Duplicate functions removed - using the more complete versions above

        function showSubcategoryLoading() {
            const subcategoryGrid = document.getElementById('subcategoryGrid');
            subcategoryGrid.innerHTML = `
                <div style="grid-column: 1 / -1; display: flex; justify-content: center; align-items: center; height: 100px; flex-direction: column;">
                    <div class="loading-spinner" style="border: 3px solid #f3f3f3; border-top: 3px solid #5d4037; border-radius: 50%; width: 30px; height: 30px; animation: spin 1s linear infinite;"></div>
                    <p style="margin-top: 0.5rem; color: #999; font-size: 0.9rem;">Memuat sub kategori...</p>
                </div>
            `;
        }

        function hideSubcategoryLoading() {
            // Subcategories will be updated with actual content
        }

        function showErrorMessage(message) {
            // Create or update error notification
            let errorDiv = document.getElementById('errorNotification');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.id = 'errorNotification';
                errorDiv.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: #dc3545;
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 10000;
                    max-width: 300px;
                    font-size: 0.9rem;
                    transform: translateX(100%);
                    transition: transform 0.3s ease;
                `;
                document.body.appendChild(errorDiv);
            }

            errorDiv.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <span>${message}</span>
                    <button onclick="hideErrorMessage()" style="background: none; border: none; color: white; font-size: 1.2rem; cursor: pointer; margin-left: 1rem;">&times;</button>
                </div>
            `;

            // Show notification
            setTimeout(() => {
                errorDiv.style.transform = 'translateX(0)';
            }, 100);

            // Auto hide after 5 seconds
            setTimeout(() => {
                hideErrorMessage();
            }, 5000);
        }

        function hideErrorMessage() {
            const errorDiv = document.getElementById('errorNotification');
            if (errorDiv) {
                errorDiv.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (errorDiv.parentNode) {
                        errorDiv.parentNode.removeChild(errorDiv);
                    }
                }, 300);
            }
        }

        // Slider functionality
        @if($sliderImages->count() > 1)
        const sliderImages = [
            @foreach($sliderImages as $slide)
                '{{ asset('storage/' . $slide->image_path) }}',
            @endforeach
        ];

        let currentSlideIndex = 0;
        let autoSlideInterval;
        const sliderWrapper = document.getElementById('slider-wrapper');
        const indicators = document.querySelectorAll('.slider-indicator');

        function updateSliderDisplay() {
            if (sliderImages.length > 1) {
                const translateX = -currentSlideIndex * 100;
                sliderWrapper.style.transform = `translateX(${translateX}%)`;
                
                // Update indicators
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentSlideIndex);
                });
            }
        }

        function nextSlide() {
            if (sliderImages.length > 1) {
                currentSlideIndex = (currentSlideIndex + 1) % sliderImages.length;
                updateSliderDisplay();
                resetAutoSlide();
            }
        }

        function previousSlide() {
            if (sliderImages.length > 1) {
                currentSlideIndex = (currentSlideIndex - 1 + sliderImages.length) % sliderImages.length;
                updateSliderDisplay();
                resetAutoSlide();
            }
        }

        function goToSlide(index) {
            if (sliderImages.length > 1 && index >= 0 && index < sliderImages.length) {
                currentSlideIndex = index;
                updateSliderDisplay();
                resetAutoSlide();
            }
        }

        function startAutoSlide() {
            if (sliderImages.length > 1) {
                autoSlideInterval = setInterval(() => {
                    nextSlide();
                }, 5000);
            }
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        // Initialize slider display and start auto-sliding
        updateSliderDisplay();
        startAutoSlide();
        @endif

        // Initialize image loading optimizations
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize filter state management
            validateFilterState();
            
            // Set initial active state for "Semua Produk" category
            const allProductsCard = document.querySelector('.category-card[onclick*="all"]');
            if (allProductsCard) {
                allProductsCard.classList.add('active');
            }
            
            // Initialize lazy loading
            initLazyLoading();

            // Preload critical images after a short delay
            setTimeout(() => {
                preloadCriticalImages();
            }, 100);

            // Add loading states to existing images
            document.querySelectorAll('.product-image img').forEach(img => {
                if (!img.complete) {
                    img.style.opacity = '0';
                    img.addEventListener('load', function() {
                        this.style.opacity = '1';
                    });
                }
            });
            
            // Debug logging for development
            if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
                console.log('Initial filter state:', getCurrentFilterState());
            }
        });
    </script>
</body>
</html>
