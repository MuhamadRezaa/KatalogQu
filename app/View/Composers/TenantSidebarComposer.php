<?php

namespace App\View\Composers;

use App\Models\Menu;
use App\Models\StoreCategory;
use App\Models\UserStore;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TenantSidebarComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $menus = []; // Initialize as empty array

        // Ensure user is authenticated and has a userStore
        //if (Auth::check() && Auth::user()->userStore) {
        //    $userStore = Auth::user()->userStore;
        $userStore = UserStore::where('tenant_id', tenant('id'))->firstOrFail();
        // Get the store category ID for the current user's store
        $currentStoreCategoryId = $userStore->catalogTemplate->categories_store_id;

        // Fetch the StoreCategory model with its associated menus
        $storeCategory = StoreCategory::find($currentStoreCategoryId);

        if ($storeCategory) {
            // Pluck the 'code' from the associated menus and convert to an array
            $menus = $storeCategory->menus->pluck('code')->toArray();
        }
        //}

        $view->with('menus', $menus);
    }
}
