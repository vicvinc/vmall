<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Plate;
use Image;

class PlateController extends Controller {

    public function index() {
        $plates = Plate::paginate(10);
        return view('admin.product.plate.index')->with([
            'main_title' => '商品管理',
            'sub_title' => '板块管理',
            'card_title' => '板块列表',
            'plates' => $plates
        ]);
    }

    public function create() {
        return view('admin.product.plate.create')->with([
            'main_title' => '商品管理',
            'sub_title' => '板块管理',
            'card_title' => '新建板块',
        ]);
    }

    public function store(Request $request) {
        $plate = new Plate();
        
        $inputs = $request->all();
        
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/plate/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(600, 400)
                ->save('.' . $filePath . $fileName);

            $inputs['thumbnail'] = $filePath . $fileName;

        } else {
            return redirect()->to('admin/product/plate')->withError('图片不合法！');
        }

        $plate->fill($inputs);

        if ($plate->save()) {
            return redirect()->to('admin/product/plate')->withSuccess('新增板块成功！');
        } else {
            return redirect()->to('admin/product/plate')->withError('新增板块失败！');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($uid) {
        $plate = Plate::where('uid', $uid)->first();

        return view('admin.product.plate.edit')->with([
            'main_title' => '商品管理',
            'sub_title' => '板块管理',
            'card_title' => '修改板块',
            'plate' => $plate
        ]);
    }

    public function update(Request $request, $uid) {

        $plate = Plate::where('uid', $uid)->first();

        if (empty($plate)) {
            return redirect()->to('admin/product/plate')->withError('修改板块不存在！');
        }

        $inputs = $request->all();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/plate/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(600, 400)
                ->save('.' . $filePath . $fileName);
            $inputs['thumbnail'] = $filePath . $fileName;
        }

        $plate->fill($inputs);

        if ($plate->save()) {
            return redirect()->to('admin/product/plate')->withSuccess('修改板块成功！');
        } else {
            return redirect()->to('admin/product/plate')->withError('修改板块失败！');
        }
    }

    public function destroy($uid) {
        $plate = Plate::where('uid', $uid)->first();

        if (empty($plate)) {
            return redirect()->to('admin/product/plate')->withError('删除失败！');
        }

        $plate->delete();
        return redirect()->to('admin/product/plate')->withSuccess('删除板块成功！');
    }
}
