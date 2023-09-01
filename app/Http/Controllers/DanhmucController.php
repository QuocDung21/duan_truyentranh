<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\InfoWebsites;
use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use Yajra\Datatables\Datatables;

class DanhmucController extends Controller
{
    protected
        $info_web;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:publish category|edit category|delete category|add category|publish category|public', ['only' => ['index', 'show']]);
        $this->middleware('permission:add category|publish category|public', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit category|publish category|public', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete category|publish category|public', ['only' => ['destroy']]);
        $this->info_web = InfoWebsites::first();
    }
    public function index()
    {
        $danhmuctruyen = DanhmucTruyen::orderBy('id', 'DESC')->get();
        return view('admincp.danhmuctruyen.index')
            ->with('info_websites', $this->info_web)
            ->with(compact('danhmuctruyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        $danhmuctruyen = DanhmucTruyen::orderBy('id', 'DESC')->get();
        return view('admincp.danhmuctruyen.create')
            ->with('info_websites', $this->info_web)
            ->with(compact('danhmuctruyen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tendanhmuc' => 'required|unique:danhmuc|max:255',
                'mota' => 'required|max:255',
                'kichhoat' => 'required',
            ],
            [
                'tendanhmuc.unique' => 'Tên danh mục đã tổn tại',
                'tendanhmuc.required' => 'Tên danh mục không được trống',
                'mota.required' => 'Mô tả không được trống',
            ],
        );
        $slug = Str::slug($data['tendanhmuc']);
        $danhmuctruyen = new DanhmucTruyen();
        $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
        $danhmuctruyen->slug_danhmuc = $slug;
        $danhmuctruyen->mota = $data['mota'];
        $danhmuctruyen->kichhoat = $data['kichhoat'];
        $danhmuctruyen->save();
        return redirect()
            ->back()
            ->with('status', 'Thêm danh mục thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $danhmuc = DanhmucTruyen::find($id);
        return view('admincp.danhmuctruyen.edit')
            ->with('info_websites', $this->info_web)
            ->with(compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'tendanhmuc' => 'required|max:255',
                'mota' => 'required|max:255',
                'kichhoat' => 'required',
            ],
            [
                'tendanhmuc.required' => 'Tên danh mục không được trống',
                'mota.required' => 'Mô tả không được trống',
            ],
        );
        $danhmuctruyen = DanhmucTruyen::find($id);
        $slug = Str::slug($data['tendanhmuc']);
        $danhmuctruyen->slug_danhmuc = $slug;
        $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
        $danhmuctruyen->mota = $data['mota'];
        $danhmuctruyen->kichhoat = $data['kichhoat'];
        $danhmuctruyen->save();
        return redirect()
            ->back()
            ->with('status', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DanhmucTruyen::find($id)->delete();
        return redirect()
            ->back()
            ->with('status', 'Xóa danh mục truyện thành công');
    }
}
