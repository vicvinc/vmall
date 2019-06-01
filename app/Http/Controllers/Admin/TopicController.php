<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Topic;
use Image;

class TopicController extends Controller {

    public function index() {
        $topics = Topic::paginate(10);

        return view('admin.product.topic.index')->with([
            'main_title' => '商品管理',
            'sub_title' => '专题管理',
            'card_title' => '专题列表',
            'topics' => $topics
        ]);
    }

    public function create() {
        return view('admin.product.topic.create')->with([
            'main_title' => '商品管理',
            'sub_title' => '专题管理',
            'card_title' => '新建专题',
        ]);
    }

    public function store(Request $request) {
        $topic = new Topic();

        $inputs = $request->all();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/topic/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(120, 120)
                ->save('.' . $filePath . $fileName);
            $inputs['thumbnail'] = $filePath . $fileName;
        } else {
            return redirect()->to('admin/product/topic')->withError('图片不合法！');
        }
        
        $topic->fill($inputs);

        if ($topic->save()) {
            return redirect()->to('admin/product/topic')->withSuccess('新增专题成功！');
        } else {
            return redirect()->to('admin/product/topic')->withError('新增专题失败！');
        }

    }

    public function show($id) {

    }

    public function edit($uid) {
        $topic = Topic::where('uid', $uid)->first();

        return view('admin.product.topic.edit')->with([
            'main_title' => '商品管理',
            'sub_title' => '专题管理',
            'card_title' => '修改专题',
            'topic' => $topic
        ]);
    }

    public function update(Request $request, $uid) {

        $topic = Topic::where('uid', $uid)->first();

        if (empty($topic)) {
            return redirect()->to('admin/product/topic')->withError('修改的主题不存在！');
        }

        $inputs = $request->all();

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $filePath = '/uploads/topic/';
            $fileName = str_random(10) . '.png';
            Image::make($request->file('thumbnail'))
                ->encode('png')
                ->resize(120, 120)
                ->save('.' . $filePath . $fileName);
            $inputs['thumbnail'] = $filePath . $fileName;
        }

        if ($topic->update($inputs)) {
            return redirect()->to('admin/product/topic')->withSuccess('新增修改成功！');
        } else {
            return redirect()->to('admin/product/topic')->withError('新增修改失败！');
        }

    }

    public function destroy($uid) {
        $topic = Topic::where('uid', $uid)->first();

        if (empty($topic)) {
            return redirect()->to('admin/product/topic')->withSuccess('删除的专题不存在！');
        }

        $topic->delete();
        
        return redirect()->to('admin/product/topic')->withSuccess('专题删除成功！');
    }
}
