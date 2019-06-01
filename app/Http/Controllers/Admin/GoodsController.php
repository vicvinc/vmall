<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\CategoryController;

use App\Http\Requests;
use App\Models\Goods;
use App\Models\Category;
use App\Models\Plate;
use App\Models\Topic;
use Image;
use Log;

class GoodsController extends Controller {
    private $GoodsCategory;

    public function __construct() {
        $this->GoodsCategory = new CategoryController();
    }

    public function index() {
        $query = Goods::paginate(10);
        $cateList = $this->GoodsCategory->getCateList();
        
        return view('admin.product.goods.index')->with([
            'main_title' => '商品管理',
            'sub_title' => '商品管理',
            'card_title' => '商品列表',
            'data' => $query,
            'categories' => $cateList,
        ]);
    }

    // query goods by cate
    public function cateGoods($uid) {

        $data = Goods::where('category_uid', $uid)
            ->paginate(10);

        return view('_common.table.goods')->with([
            'data' => $data,
        ]);
        
    }

    // create goods
    public function create() {

        $categories = Category::where('parent_uid', '>', 0)->orderBy('id', 'desc')->get();
        $plates = Plate::where('status', '=', 'show')->orderBy('id', 'desc')->get();
        $topics = Topic::where('status', '=', 'show')->orderBy('id', 'desc')->get();

        return view('admin.product.goods.create')->with([
                'main_title' => '商品管理',
                'sub_title' => '商品管理',
                'card_title' => '新建商品',
                'categories' => $categories,
                'plates' => $plates,
                'topics' => $topics
            ]);
        
    }

    // save goods
    public function store(Request $request) {

        $goods = new Goods();
        $inputs = $request->all();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/goods/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(600, 400)
                ->save('.' . $filePath . $fileName);
            $inputs['thumbnail'] = $filePath . $fileName;
        }

       $goods->fill($inputs);

        if ($goods->save()) {
            return redirect()->to('admin/product/goods')->withSuccess('新增商品成功！');
        } else {
            return redirect()->to('admin/product/goods')->withError('新增商品失败！');
        }
    }

    public function editorUpload(Request $request) {
        if ($request->hasFile('editorFile') && $request->file('editorFile')->isValid()) {
            $filePath = '/uploads/editor/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('editorFile'))
                ->encode('png')
                ->save('.' . $filePath . $fileName);
            return $filePath . $fileName;
        } else {
            return "error|上传失败！";
        }

    }

    public function show($id) {
        //
    }

    // edit goods
    public function edit($uid) {

        $goods = Goods::where('uid', $uid)->first();

        if (empty($goods)) {
            return redirect()->to('admin/product/goods')->withError('修改商品失败！');
        }

        $categories = Category::where('parent_uid', '>', 0)->orderBy('id', 'desc')->get();

        $plates = Plate::where('status', '=', 'show')->orderBy('id', 'desc')->get();
        $topics = Topic::where('status', '=', 'show')->orderBy('id', 'desc')->get();

        return view('admin.product.goods.edit')->with([
                'main_title' => '商品管理',
                'sub_title' => '商品管理',
                'card_title' => '编辑商品',
                'categories' => $categories,
                'plates' => $plates,
                'topics' => $topics,
                'goods' => $goods,
            ]);
    }

    // update goods
    public function update(Request $request, $uid) {

        $goods = Goods::where('uid', $uid)->first();
        
        if (empty($goods)) {
            return redirect()->to('admin/product/goods')->withError('要修改的商品不存在！');
        }

        $inputs = $request->all();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {

            $filePath = '/uploads/goods/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(600, 400)
                ->save('.' . $filePath . $fileName);
            $inputs['thumbnail'] = $filePath . $fileName;
        }
        
        if ($goods->update($inputs)) {
            return redirect()->to('admin/product/goods')->withSuccess('修改商品成功！');
        } else {
            return redirect()->to('admin/product/goods')->withError('修改商品失败！');
        }
    }

    // delete goods
    public function destroy($uid) {
        
        $goods = Goods::where('uid', $uid)->first();

        if (empty($goods)) {
            return redirect()->to('admin/product/goods')->withError('删除的商品不存在！');
        }
        
        $goods->delete();

        return redirect()->to('admin/product/goods')->withSuccess('删除商品成功！');
    }
}
