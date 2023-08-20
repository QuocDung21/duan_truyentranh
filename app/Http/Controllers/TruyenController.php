<?php

namespace App\Http\Controllers;
use App\Models\Danhmuctruyen;
use App\Models\Truyen;
use App\Models\Theloai;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TruyenController extends Controller
{
    protected $theloai, $danhmuc;

    public function __construct()
    {
        $this->danhmuc = DanhmucTruyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->get();
        $this->theloai = Theloai::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->get();
    }
    public function index()
    {
        $truyen = Truyen::with('danhmuctruyen', 'theloai')
            ->orderBy('id', 'DESC')
            ->get();
        return view('admincp.truyen.index')->with(compact('truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = Danhmuctruyen::orderBy('id', 'DESC')->get();
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        return view('admincp.truyen.create')->with(compact('danhmuc', 'theloai'));
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
                'tentruyen' => 'required|unique:truyen|max:255',
                'hinhanh' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
                'tomtat' => 'required|max:255',
                'kichhoat' => 'required',
                'theloai_id' => 'required',
                'tacgia' => 'required',
                'danhmuc_id' => 'required',
            ],
            [
                'tentruyen.unique' => 'Tên danh mục đã tổn tại',
                'tentruyen.required' => 'Tên danh mục không được trống',
                'tomtat.required' => 'Mô tả không được trống',
                'hinhanh.required' => 'Hình ảnh không được trống',
                'tacgia.required' => 'Tác giả không được trống',
            ],
        );
        $slug = Str::slug($data['tentruyen']);
        $truyen = new Truyen();
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->slug_truyen = $slug;
        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->danhmuc_id = $data['danhmuc_id'];
        $truyen->theloai_id = $data['theloai_id'];
        $get_image = $request->hinhanh;
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $truyen->hinhanh = $new_image;
        $truyen->save();
        return redirect()
            ->back()
            ->with('status', 'Thêm truyện thành công');
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
        $truyen = Truyen::find($id);
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        return view('admincp.truyen.edit')->with(compact('truyen', 'danhmuc'));
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
                'tentruyen' => 'required|max:255',
                'tacgia' => 'required|max:255',
                'hinhanh' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
                'tomtat' => 'required|max:255',
                'kichhoat' => 'required',
                'danhmuc_id' => 'required',
            ],
            [
                'tentruyen.unique' => 'Tên danh mục đã tổn tại',
                'tacgia.unique' => 'Tác giả không được trống',
                'tentruyen.required' => 'Tên danh mục không được trống',
                'tomtat.required' => 'Mô tả không được trống',
            ],
        );
        $slug = Str::slug($data['tentruyen']);
        $truyen = Truyen::find($id);
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->slug_truyen = $slug;
        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->danhmuc_id = $data['danhmuc_id'];
        $truyen->theloai_id = $data['theloai_id'];
        $get_image = $request->hinhanh;
        if ($get_image) {
            $path = 'public/uploads/truyen/' . $truyen->hinhanh;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $truyen->hinhanh = $new_image;
        }
        $truyen->save();
        return redirect()
            ->back()
            ->with('status', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        $path = 'public/uploads/truyen/' . $truyen->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        Truyen::find($id)->delete();
        return redirect()
            ->back()
            ->with('status', 'Xóa truyện thành công');
    }
}
