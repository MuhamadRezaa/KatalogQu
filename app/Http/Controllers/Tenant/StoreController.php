<?php

namespace App\Http\Controllers\Tenant;

use App\Models\StoreProduct;
use App\Models\ProductCategory;
use App\Models\UserStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreHero; // Added
use App\Models\PriceRange; // Added
use Illuminate\Support\Facades\Cache;
// Add ProductSubCategory model
use App\Models\ProductSubCategory;


class StoreController extends Controller
{
    /**
     * Display the main store page with products
     */
    public function index(Request $request)
    {
        // Get current store info
        $userStore = $this->getCurrentStore();

        $featuredProducts = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where('is_featured', true)
            ->with(['category', 'subCategory', 'brand', 'images'])
            ->take(8)
            ->get();

        // Get new products
        $newProducts = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where('is_new', true)
            ->with(['category', 'subCategory', 'brand', 'images'])
            ->take(8)
            ->get();

        // Get all products for main listing
        $query = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->with(['category', 'subCategory', 'images']); // Add 'subCategory' here

        // Apply filters
        if ($request->has('category') && $request->category) {
            $query->where('product_category_id', $request->category);
        }

        // Add sub category filter
        if ($request->has('subcategory') && $request->subcategory) {
            $query->where('sub_category_id', $request->subcategory);
        }

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('sku', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('brand_ids')) {
            $ids = collect(explode(',', $request->brand_ids))
                ->filter()->map('intval')->all();
            if (!empty($ids)) {
                $query->whereIn('brand_id', $ids);
            }
        }

        // Sort products
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);

        // Get categories with product counts
        $categories = ProductCategory::query()
            ->where('is_active', true)
            ->whereHas('products', function ($q) use ($userStore) {
                $q->where('user_store_id', $userStore->id)
                    ->where('is_active', true);
            })
            ->withCount(['products as products_count' => function ($q) use ($userStore) {
                $q->where('is_active', true)
                    ->where('user_store_id', $userStore->id);
            }])
            ->orderBy('name')
            ->get();

        // Get sub-categories with product counts
        $subCategories = ProductSubCategory::query()
            ->where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->whereHas('products', function ($q) use ($userStore) {
                $q->where('user_store_id', $userStore->id)
                    ->where('is_active', true);
            })
            ->withCount(['products as products_count' => function ($q) use ($userStore) {
                $q->where('is_active', true)
                    ->where('user_store_id', $userStore->id);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get brands
        $brands = \App\Models\StoreBrand::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->get();

        $priceRanges = PriceRange::active()
            ->forStore($userStore->id)
            ->orderBy('min')
            ->get();

        // Load banners from database
        $banners = $userStore->heroes()->where('is_active', true)->orderBy('order')->get();

        // Try to load template-specific view based on catalog template
        $catalogTemplate = $userStore->catalogTemplate;
        $templateView = 'tenant.store.index'; // default fallback

        if ($catalogTemplate) {
            $templateSlug = $catalogTemplate->slug;
            $potentialView = 'tenant.template.' . $templateSlug . '.index';

            if (view()->exists($potentialView)) {
                $templateView = $potentialView;
            } else {
                // Try default template
                $defaultView = 'tenant.template.default.index';
                if (view()->exists($defaultView)) {
                    $templateView = $defaultView;
                }
            }
        }

        // dd($subCategories);

        return view($templateView, compact(
            'userStore',
            'products',
            'featuredProducts',
            'newProducts',
            'categories',
            'subCategories', // Add this
            'brands',
            'priceRanges',
            'banners'
        ));
    }

    /**
     * Get product details (for AJAX)
     */
    public function getProductDetails($productId)
    {
        $userStore = $this->getCurrentStore();

        $product = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where('id', $productId)
            ->with(['category', 'subCategory', 'images'])
            ->firstOrFail();

        return response()->json(['success' => true, 'product' => $product]);
    }

    /**
     * Display a specific product
     */
    public function showProduct(Request $request, $productSlug)
    {
        $userStore = $this->getCurrentStore();



        // Find product by slug or ID
        $product = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where(function ($query) use ($productSlug) {
                $query->where('slug', $productSlug)
                    ->orWhere('id', $productSlug);
            })
            ->with(['category', 'subCategory', 'images']) // Add subCategory
            ->firstOrFail();

        // Get related products (same category, maybe same sub-category is better)
        $relatedProducts = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where('sub_category_id', $product->sub_category_id) // Change to sub-category
            ->where('id', '!=', $product->id)
            ->with('images') // Add images
            ->take(4)
            ->get();

        // If no related products in sub-category, fallback to category
        if ($relatedProducts->isEmpty()) {
            $relatedProducts = StoreProduct::where('user_store_id', $userStore->id)
                ->where('is_active', true)
                ->where('product_category_id', $product->product_category_id)
                ->where('id', '!=', $product->id)
                ->with('images') // Add images
                ->take(4)
                ->get();
        }

        // Get brands
        $brands = \App\Models\StoreBrand::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->get();

        // Load banners from database
        $banners = $userStore->heroes()->where('is_active', true)->orderBy('order')->get();

        // Try to load template-specific view based on catalog template
        $catalogTemplate = $userStore->catalogTemplate;
        $templateView = 'tenant.store.product'; // default fallback

        if ($catalogTemplate) {
            $potentialView = 'tenant.template.' . $catalogTemplate->slug . '.product';
            if (view()->exists($potentialView)) {
                $templateView = $potentialView;
            } else {
                // Try default template
                $defaultView = 'tenant.template.default.product';
                if (view()->exists($defaultView)) {
                    $templateView = $defaultView;
                }
            }
        }

        return view($templateView, compact(
            'userStore',
            'product',
            'relatedProducts',
            'brands',
            'banners'
        ));
    }

    /**
     * Display products by category
     */
    public function showCategory(Request $request, $categorySlug)
    {
        $userStore = $this->getCurrentStore();



        // Find category
        $category = ProductCategory::where('is_active', true)
            ->where(function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug)
                    ->orWhere('id', $categorySlug);
            })
            ->firstOrFail();

        // Get products in this category
        $query = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where('product_category_id', $category->id)
            ->with(['category', 'images']);

        // Apply additional filters
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        // Add subcategory filter
        if ($request->has('subcategory') && $request->subcategory) {
            $query->where('sub_category_id', $request->subcategory);
        }

        // Sort products
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc': // Added this case
                $query->orderBy('name', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);

        // Get all categories for navigation
        $categories = ProductCategory::where('is_active', true)
            ->whereHas('products', function ($query) use ($userStore) {
                $query->where('user_store_id', $userStore->id)->where('is_active', true);
            })
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        // Get sub-categories for this category
        $subCategories = ProductSubCategory::query()
            ->where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->whereHas('products', function ($q) use ($userStore, $category) {
                $q->where('user_store_id', $userStore->id)
                    ->where('is_active', true)
                    ->where('product_category_id', $category->id);
            })
            ->withCount(['products as products_count' => function ($q) use ($userStore, $category) {
                $q->where('is_active', true)
                    ->where('user_store_id', $userStore->id)
                    ->where('product_category_id', $category->id);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get brands
        $brands = \App\Models\StoreBrand::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->get();

        // Get price ranges
        $priceRanges = PriceRange::active()
            ->forStore($userStore->id)
            ->orderBy('min')
            ->get();

        // Load banners from database
        $banners = $userStore->heroes()->where('is_active', true)->orderBy('order')->get();

        // Try to load template-specific view based on catalog template
        $catalogTemplate = $userStore->catalogTemplate;
        $templateView = 'tenant.store.category'; // default fallback

        if ($catalogTemplate) {
            $potentialView = 'tenant.template.' . $catalogTemplate->slug . '.category';
            if (view()->exists($potentialView)) {
                $templateView = $potentialView;
            } else {
                // Try default template
                $defaultView = 'tenant.template.default.category';
                if (view()->exists($defaultView)) {
                    $templateView = $defaultView;
                }
            }
        }

        return view($templateView, compact(
            'userStore',
            'category',
            'products',
            'categories',
            'subCategories', // Add this
            'brands',
            'banners',
            'priceRanges'
        ));
    }

    /**
     * Display products by sub-category
     */
    public function showSubCategory(Request $request, $subCategorySlug)
    {
        $userStore = $this->getCurrentStore();

        // Find sub-category
        $subCategory = ProductSubCategory::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where(function ($query) use ($subCategorySlug) {
                $query->where('slug', $subCategorySlug)
                    ->orWhere('id', $subCategorySlug);
            })
            ->firstOrFail();

        // Get products in this sub-category
        $query = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where('sub_category_id', $subCategory->id)
            ->with(['category', 'images']);

        // Apply additional filters
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        // Sort products
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);

        // Get all categories for navigation
        $categories = ProductCategory::where('is_active', true)
            ->whereHas('products', function ($query) use ($userStore) {
                $query->where('user_store_id', $userStore->id)->where('is_active', true);
            })
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        // Get all sub-categories for navigation
        $subCategories = ProductSubCategory::query()
            ->where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->whereHas('products', function ($q) use ($userStore) {
                $q->where('user_store_id', $userStore->id)
                    ->where('is_active', true);
            })
            ->withCount(['products as products_count' => function ($q) use ($userStore) {
                $q->where('is_active', true)
                    ->where('user_store_id', $userStore->id);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get brands
        $brands = \App\Models\StoreBrand::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->get();

        // Get price ranges
        $priceRanges = PriceRange::active()
            ->forStore($userStore->id)
            ->orderBy('min')
            ->get();

        // Load banners from database
        $banners = $userStore->heroes()->where('is_active', true)->orderBy('order')->get();

        // Try to load template-specific view based on catalog template
        $catalogTemplate = $userStore->catalogTemplate;
        $templateView = 'tenant.store.sub-category'; // default fallback

        if ($catalogTemplate) {
            $potentialView = 'tenant.template.' . $catalogTemplate->slug . '.sub-category';
            if (view()->exists($potentialView)) {
                $templateView = $potentialView;
            } else {
                // Try default template
                $defaultView = 'tenant.template.default.sub-category';
                if (view()->exists($defaultView)) {
                    $templateView = $defaultView;
                }
            }
        }

        return view($templateView, compact(
            'userStore',
            'subCategory',
            'products',
            'categories',
            'subCategories',
            'brands',
            'banners',
            'priceRanges'
        ));
    }

    /**
     * Search products
     */
    public function search(Request $request)
    {
        $userStore = $this->getCurrentStore();



        $searchTerm = $request->get('q', '');
        $products = collect();

        if ($searchTerm) {
            $products = StoreProduct::where('user_store_id', $userStore->id)
                ->where('is_active', true)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%{$searchTerm}%")
                        ->orWhere('description', 'like', "%{$searchTerm}%")
                        ->orWhere('sku', 'like', "%{$searchTerm}%");
                })
                ->with(['category', 'images'])
                ->paginate(12);
        }

        // Get categories for filter
        $categories = ProductCategory::where('is_active', true)
            ->whereHas('products', function ($query) use ($userStore) {
                $query->where('user_store_id', $userStore->id)->where('is_active', true);
            })
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        // Get sub-categories for filter
        $subCategories = ProductSubCategory::query()
            ->where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->whereHas('products', function ($q) use ($userStore) {
                $q->where('user_store_id', $userStore->id)
                    ->where('is_active', true);
            })
            ->withCount(['products as products_count' => function ($q) use ($userStore) {
                $q->where('is_active', true)
                    ->where('user_store_id', $userStore->id);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get brands
        $brands = \App\Models\StoreBrand::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->get();

        // Get price ranges
        $priceRanges = PriceRange::active()
            ->forStore($userStore->id)
            ->orderBy('min')
            ->get();

        // Load banners from database
        $banners = $userStore->heroes()->where('is_active', true)->orderBy('order')->get();

        // Try to load template-specific view based on catalog template
        $catalogTemplate = $userStore->catalogTemplate;
        $templateView = 'tenant.store.search'; // default fallback

        if ($catalogTemplate) {
            $potentialView = 'tenant.template.' . $catalogTemplate->slug . '.search';
            if (view()->exists($potentialView)) {
                $templateView = $potentialView;
            } else {
                // Try default template
                $defaultView = 'tenant.template.default.search';
                if (view()->exists($defaultView)) {
                    $templateView = $defaultView;
                }
            }
        }

        return view($templateView, compact(
            'userStore',
            'products',
            'categories',
            'subCategories', // Add this
            'searchTerm',
            'brands',
            'banners',
            'priceRanges'
        ));
    }

    /**
     * Get current store information
     */
    private function getCurrentStore()
    {
        // Get the current tenant's subdomain
        $subdomain = request()->getHost();
        $subdomain = explode('.', $subdomain)[0]; // Get subdomain part

        // Cache store info for performance
        return Cache::remember("store_{$subdomain}", 3600, function () use ($subdomain) {
            return UserStore::where('subdomain', $subdomain)
                ->where('tenant_created', true)
                ->first();
        });
    }

    /**
     * Show maintenance page
     */
    private function showMaintenancePage($userStore)
    {
        // Get the catalog template slug
        $catalogTemplate = $userStore->catalogTemplate;

        // Try to load template-specific maintenance page
        if ($catalogTemplate) {
            $maintenanceView = 'tenant.template.' . $catalogTemplate->slug . '.maintenance';

            // Check if template maintenance view exists, fallback to default if not
            if (view()->exists($maintenanceView)) {
                return view($maintenanceView, compact('userStore'));
            }
        }

        // Fallback to default maintenance template
        $defaultMaintenanceView = 'tenant.template.default.maintenance';
        if (view()->exists($defaultMaintenanceView)) {
            return view($defaultMaintenanceView, compact('userStore'));
        }

        // Final fallback to original maintenance page
        return view('tenant.store.maintenance', compact('userStore'));
    }

    /**
     * API endpoint to get products (for AJAX)
     */
    public function getProducts(Request $request)
    {
        $userStore = $this->getCurrentStore();



        $query = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->with(['category', 'subCategory', 'images']);

        // Apply filters
        if ($request->has('category') && $request->category) {
            $query->where('product_category_id', $request->category);
        }

        // Add subcategory filter
        if ($request->has('subcategory') && $request->subcategory) {
            $query->where('sub_category_id', $request->subcategory);
        }

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('price_range') && $request->price_range) {
            [$min, $max] = explode('-', $request->price_range);
            if ($min !== '') $query->where('price', '>=', $min);
            if ($max !== '') $query->where('price', '<=', $max);
        }

        // Sort
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);

        return response()->json([
            'success' => true,
            'products' => $products->items(),
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'total' => $products->total()
            ]
        ]);
    }

    /**
     * Get categories (for AJAX)
     */
    public function getCategories()
    {
        $userStore = $this->getCurrentStore();



        $categories = ProductCategory::where('is_active', true)
            ->whereHas('products', function ($query) use ($userStore) {
                $query->where('user_store_id', $userStore->id)->where('is_active', true);
            })
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    /**
     * Get sub-categories (for AJAX)
     */
    public function getSubCategories(Request $request)
    {
        $userStore = $this->getCurrentStore();

        $query = ProductSubCategory::where('is_active', true)
            ->where('user_store_id', $userStore->id)
            ->whereHas('products', function ($query) use ($userStore) {
                $query->where('user_store_id', $userStore->id)->where('is_active', true);
            });

        // if a category is passed, filter subcategories by it
        if ($request->has('category_id') && $request->category_id) {
            $query->whereHas('products', function ($q) use ($request) {
                $q->where('product_category_id', $request->category_id);
            });
        }

        $subCategories = $query->withCount(['products' => function ($query) {
            $query->where('is_active', true);
        }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'subCategories' => $subCategories
        ]);
    }

    /**
     * Display template-specific page
     */
    public function showTemplate(Request $request, $slug)
    {
        $userStore = $this->getCurrentStore();



        // Get the catalog template based on the slug
        $catalogTemplate = $userStore->catalogTemplate;

        if (!$catalogTemplate || $catalogTemplate->slug !== $slug) {
            abort(404, 'Template not found');
        }

        // Load template-specific view based on catalog template slug
        $templateView = 'tenant.template.' . $catalogTemplate->slug . '.index';

        // Check if template view exists, fallback to default if not
        if (!view()->exists($templateView)) {
            // Fallback to default template if specific template doesn't exist
            $templateView = 'tenant.template.default.index';

            // If default template also doesn't exist, fallback to regular store page
            if (!view()->exists($templateView)) {
                return $this->index($request);
            }
        }

        $featuredProducts = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where('is_featured', true)
            ->with(['category', 'images'])
            ->take(8)
            ->get();

        // Get data for the template
        $newProducts = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->where('is_new', true)
            ->with(['category', 'images'])
            ->take(8)
            ->get();

        // Get all products for main listing
        $query = StoreProduct::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->with(['category', 'images']);

        // Apply filters
        if ($request->has('category') && $request->category) {
            $query->where('product_category_id', $request->category);
        }

        // Add subcategory filter
        if ($request->has('subcategory') && $request->subcategory) {
            $query->where('sub_category_id', $request->subcategory);
        }

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('sku', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('price_min') && $request->price_min) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max') && $request->price_max) {
            $query->where('price', '<=', $request->price_max);
        }

        // Sort products
        $sortBy = $request->get('sort', 'newest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc': // Added this case
                $query->orderBy('name', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $products = $query->paginate(12);

        // Get categories with product counts
        $categories = ProductCategory::where('is_active', true)
            ->whereHas('products', function ($query) use ($userStore) {
                $query->where('user_store_id', $userStore->id)->where('is_active', true);
            })
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        // Get sub-categories with product counts
        $subCategories = ProductSubCategory::query()
            ->where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->whereHas('products', function ($q) use ($userStore) {
                $q->where('user_store_id', $userStore->id)
                    ->where('is_active', true);
            })
            ->withCount(['products as products_count' => function ($q) use ($userStore) {
                $q->where('is_active', true)
                    ->where('user_store_id', $userStore->id);
            }])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Get brands
        $brands = \App\Models\StoreBrand::where('user_store_id', $userStore->id)
            ->where('is_active', true)
            ->get();

        // Sample banners data (you might want to load this from database)
        $banners = [
            (object) [
                'image_url' => 'assets/img/temp/banner1.jpg',
                'alt_text' => 'Banner 1',
                'title' => 'Special Offer',
                'subtitle' => 'Up to 50% off on selected items',
                'link' => '#'
            ],
            (object) [
                'image_url' => 'assets/img/temp/banner2.jpg',
                'alt_text' => 'Banner 2',
                'title' => 'New Arrivals',
                'subtitle' => 'Check out our latest products',
                'link' => '#'
            ]
        ];

        return view($templateView, compact(
            'userStore',
            'products',
            'featuredProducts',
            'newProducts',
            'promoProducts',
            'categories',
            'subCategories', // Add this
            'brands',
            'banners'
        ));
    }

    /**
     * Redirect to template-specific page
     */
    public function redirectToTemplate()
    {
        $userStore = $this->getCurrentStore();



        // Get the catalog template slug
        $catalogTemplate = $userStore->catalogTemplate;

        if (!$catalogTemplate) {
            // Fallback to regular store page if no template found
            return $this->index(request());
        }

        // Redirect to template-specific page
        return redirect()->route('tenant.template.show', ['slug' => $catalogTemplate->slug]);
    }
}
