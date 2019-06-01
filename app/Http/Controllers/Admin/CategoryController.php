<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Image;

class CategoryController extends Controller {

    public function index() {
        $categories = Category::paginate(10);
        return view('admin.product.category.index')->with([
            'main_title' => '商品管理',
            'sub_title' => '分类管理',
            'card_title' => '分类列表',
            'categories' => $categories
        ]);
    }

    // get all the categories in list
    public function getCateList() {
        $cates = Category::where('type', 'first_cate')
            ->with('children')
            ->orderBy('sequence', 'asc')
            ->get();
            
        return $cates;
    }

    public function create() {

        $parentCategories = Category::where('type', '=', 'first_cate')->get();

        return view('admin.product.category.create')->with([
            'main_title' => '商品管理',
            'sub_title' => '分类管理',
            'card_title' => '新建分类',
            'parentCategories' => $parentCategories
        ]);
    }

    public function store(Request $request) {
        $category = new Category();

        $inputs = $request->all();
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/category/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(120, 120)
                ->save('.' . $filePath . $fileName);

            $inputs['thumbnail'] = $filePath . $fileName;
        }

        $category->fill($inputs);

        if ($category->save()) {
            return redirect()->to('admin/product/category')->withSuccess('新增分类成功！');
        } else {
            return redirect()->to('admin/product/category')->withError('新增分类失败！');
        }
    }

    public function show($id) {
        //
    }

    public function edit($uid) {
        $category = Category::where('uid', $uid)->first();

        $parentCategories = Category::where('type', '=', 'first_cate')->get();

        return view('admin/product/category/edit')->with([
            'main_title' => '商品管理',
            'sub_title' => '分类管理',
            'card_title' => '修改分类',
            'category' => $category,
            'parentCategories' => $parentCategories
        ]);
    }

    public function update(Request $request, $uid) {
        $category = Category::where('uid', $uid)->first();

        $inputs = $request->all();
        
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/category/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(120, 120)
                ->save('.' . $filePath . $fileName);
            $inputs['thumbnail'] = $filePath . $fileName;

        }

        $category->fill($inputs);

        if ($category->save()) {
            return redirect()->to('admin/product/category')->withSuccess('修改分类成功！');
        } else {
            return redirect()->to('admin/product/category')->withError('修改分类失败！');
        }
    }

    public function destroy($uid) {
        $category = Category::where('uid', $uid)->first();
        
        if (empty($category)) {
            return redirect()->to('admin/product/category')->withError('删除的分裂不存在！');
        }

        $category->delete();

        return redirect()->to('admin/product/category')->withSuccess('删除分类成功！');
    }
}
