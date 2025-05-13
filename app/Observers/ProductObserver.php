<?php

namespace App\Observers;

use App\Models\SgoProduct;
use Illuminate\Support\Facades\Artisan;

class ProductObserver
{
    /**
     * Gọi lệnh cập nhật sitemap khi có sản phẩm mới.
     */
    public function created(SgoProduct $product)
    {
        Artisan::call('sitemap:generate');
    }

    /**
     * Gọi lệnh cập nhật sitemap khi sản phẩm được chỉnh sửa.
     */
    public function updated(SgoProduct $product)
    {
        $changes = $product->getChanges();

        // Kiểm tra nếu chỉ có view_count thay đổi, thì không chạy Artisan
        if (count($changes) === 1 && array_key_exists('view_count', $changes)) {
            return;
        }
        Artisan::call('sitemap:generate');
    }   

    /**
     * Gọi lệnh cập nhật sitemap khi sản phẩm bị xóa.
     */
    public function deleted(SgoProduct $product)
    {
        Artisan::call('sitemap:generate');
    }
}
