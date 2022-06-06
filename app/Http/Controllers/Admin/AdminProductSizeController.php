<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProductSizeController extends Controller {
    //
    function list($id, Request $request) {
        $status = $request->status;
        $list_act = array(
            'delete' => 'Xóa tạm thời',
        );
        if ($status == "trash") {
            $list_act = [
                'active' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            $productSizes = ProductSize::onlyTrashed()->where('product_id', $id)->paginate(5);
        } else if ($status == "public") {
            $list_act = [
                'pending' => 'Chờ duyệt',
                'delete' => 'Xóa tạm thời',

            ];
            $productSizes = ProductSize::where([
                ['status', '=', 1],
                ['product_id', '=', $id]
            ])->paginate(5);
        } else if ($status == 'pending') {
            $list_act = [
                'public' => 'Công khai',
                'delete' => 'Xóa tạm thời',
            ];
            $productSizes = ProductSize::where([
                ['status', '=', 0],
                ['product_id', '=', $id]
            ])->paginate(5);
        } else {
            $productSizes = ProductSize::where('product_id', $id)->paginate(5);
        }

        $count['all'] = ProductSize::where('product_id', $id)->count();
        $count['public'] = ProductSize::where([
            ['status', '=', 1],
            ['product_id', '=', $id]
        ])->count();
        $count['pending'] = ProductSize::where([
            ['status', '=', 0],
            ['product_id', '=', $id]
        ])->count();
        $count['trash'] = ProductSize::onlyTrashed()->where('product_id', $id)->count();
        $product_id = $id;
        return view('admin.size.list', compact('productSizes', 'count', 'list_act', 'product_id'));
    }

    function postAdd($id, Request $request) {
        $request->validate([
            'name_size' => 'required|alpha',
           
        ], [
            'required' => ':attribute không được bỏ trống',
            
        ], [
            'name_size' => 'Màu sản phẩm',
            
        ]);

        try {
            DB::beginTransaction();
            //Insert data color
            $sizeCreate = Size::firstOrCreate(['name' => $request->name_size]);
            $sizeId = $sizeCreate->id;
            ProductSize::updateOrCreate([
                'size_id' => $sizeId,
                'product_id' => $id,
            ]);

            //Inset data product_colors
            
            DB::commit();
            return back()->with('status', 'Bạn đã thêm hoặc cập nhật size sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    function action(Request $request) {
        $list_check = $request->list_check;
        $action = $request->act;
        if (!empty($list_check)) {
            if (!empty($action)) {
                if ($action == 'delete') {
                    ProductSize::destroy($list_check);
                    return back()->with('status', 'Bạn đã xóa tạm bản ghi thành công');
                } else if ($action == 'active') {
                    ProductSize::onlyTrashed()->whereIn('id', $list_check)->restore();
                    return back()->with('status', 'Bạn đã khôi phục bản ghi thành công');
                } else if ($action == 'forceDelete') {
                    ProductSize::onlyTrashed()->whereIn('id', $list_check)->forceDelete();
                    return back()->with('status', 'Bạn đã xóa vĩnh viễn bản ghi thành công');
                } else if ($action == 'public') {
                    ProductSize::whereIn('id', $list_check)->update([
                        'status' => 1
                    ]);
                    return back()->with('status', 'Bạn đã chuyển thành công bản ghi thành công khai');
                } else {
                    ProductSize::whereIn('id', $list_check)->update([
                        'status' => 0
                    ]);
                    return back()->with('status', 'Bạn đã chuyển thành công bản ghi thành chờ duyệt');
                }
            } else {
                return back()->with('error', 'Bạn vui lòng chọn thao tác thực hiện bản ghi');
            }
        } else {
            return back()->with('error', 'Bạn vui lòng chọn bản ghi để thực hiện');
        }
    }

    function delete($id) {
        ProductSize::find($id)->delete();
        return back()->with('status', 'Bạn đã xóa tạm bản ghi thành công');
    }
}
