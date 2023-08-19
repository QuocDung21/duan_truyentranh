<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Danhmuctruyen;
use Illuminate\Support\Str;

class DanhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmuctruyen = Danhmuctruyen::orderBy('id', 'DESC')->get();
        return view('admincp.danhmuctruyen.index')->with(compact('danhmuctruyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        $danhmuctruyen = Danhmuctruyen::orderBy('id', 'DESC')->get();
        return view('admincp.danhmuctruyen.create')->with(compact('danhmuctruyen'));
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
        $danhmuctruyen = new Danhmuctruyen();
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
        $danhmuc = Danhmuctruyen::find($id);
        return view('admincp.danhmuctruyen.edit')->with(compact('danhmuc'));
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
        $danhmuctruyen = Danhmuctruyen::find($id);
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
     
        Danhmuctruyen::find($id)->delete();
        return redirect()
            ->back()
            ->with('status', 'Xóa danh mục truyện thành công');
    }

    public function getDataDanhmuc(Request $request)
    {
        if ($request->ajax()) {
            $data = Danhmuctruyen::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Sửa</a>';
                    $button .= '   <a type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Xóa</a>';
                    return $button;
                })
                ->make(true);
        }
        return view('admincp.danhmuctruyen.create');
    }
}
