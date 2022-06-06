<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserHomeController extends Controller {
    //
    function __construct() {
    }
    function index() {

        $sliders = Slider::where('status', 1)->latest()->get();
        $products = Product::where('featured', 1)->where('status', 1)->latest()->take(8)->get();
        $product_image = ProductImage::all();
        //Product Ịphone
        $catThunFormRong = CategoryProduct::where('parent_id', function ($query) {
            $query->select('id')->from('category_products')->where('slug', '=', 'ao-thun');
        })->get();
        foreach ($catThunFormRong as $item) {
            $catShirtIds[] = $item->id;
        }
        $productShirt1 = Product::whereIn('category_product_id', $catShirtIds)->where('status', 1)->latest()->take(8)->get();

        //Product laptop
        $catSoMi = CategoryProduct::where('parent_id', function ($query) {
            $query->select('id')->from('category_products')->where('slug', '=', 'ao-so-mi');
        })->get();
        foreach ($catSoMi as $item) {
            $catSoMiIds[] = $item->id;
        }
        $productShirt2 = Product::whereIn('category_product_id', $catSoMiIds)->where('status', 1)->latest()->take(8)->get();
        $quanJean = CategoryProduct::where('parent_id', function ($query) {
            $query->select('id')->from('category_products')->where('slug', '=', 'quan-jean');
        })->get();
        foreach ($quanJean as $item) {
            $quanJeanIds[] = $item->id;
        }
        $productQuanJean = Product::whereIn('category_product_id', $quanJeanIds)->where('status', 1)->latest()->take(8)->get();
        return view('user.index', compact('sliders', 'products', 'productShirt1', 'productShirt2','product_image','productQuanJean'));
    }

    function page($id) {
        $page = Page::find($id);
        return view('user.page', compact('page'));
    }
}
