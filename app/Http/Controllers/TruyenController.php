<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Truyen;
use App\Models\Theloai;
use Illuminate\Support\Str;
use App\Models\InfoWebsites;
use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use Intervention\Image\Facades\Image;

class TruyenController extends Controller
{
    protected $theloai, $danhmuc, $info_web;

    public function __construct()
    {
        $this->middleware('permission:publish articles|edit articles|delete articles|add articles', ['only' => ['index', 'show']]);
        $this->middleware('permission:add articles|publish articles', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit articles|publish articles', ['only' => ['edit', 'update']]);
        $this->info_web = InfoWebsites::first();
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
        return view('admincp.truyen.index')
            ->with('info_websites', $this->info_web)
            ->with(compact('truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        return view('admincp.truyen.create')
            ->with('info_websites', $this->info_web)
            ->with(compact('danhmuc', 'theloai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    //
    // 'hinhanh' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tentruyen' => 'required|unique:truyen|max:255',
                'hinhanh' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048|',
                'tomtat_truyen' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required',
                'tacgia' => 'required',
                'trangthai_truyen' => '',
                'tag' => '',
            ],
            [
                'tentruyen.unique' => 'Tên danh mục đã tổn tại',
                'tentruyen.required' => 'Tên danh mục không được trống',
                'tomtat_truyen.required' => 'Mô tả không được trống',
                'hinhanh.required' => 'Hình ảnh không được trống',
                'tacgia.required' => 'Tác giả không được trống',
            ],
        );
        $truyen = new Truyen();
        foreach ($data['danhmuc'] as $key => $dmuc) {
            $truyen->danhmuc_id = $dmuc[0];
        }
        foreach ($data['theloai'] as $key => $tloai) {
            $truyen->theloai_id = $tloai[0];
        }
        $slug = Str::slug($data['tentruyen']);
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tag = $data['tag'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->slug_truyen = $slug;
        $truyen->tomtat = $data['tomtat_truyen'];
        $truyen->kichhoat = 1;
        $truyen->trangthai_truyen = $data['trangthai_truyen'];
        $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $get_image = $request->hinhanh;
        $path = base_path() . '/public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $truyen->hinhanh = $new_image;
        $truyen->save();
        $truyen->thuocnhieudanhmuctruyen()->attach($data['danhmuc']);
        $truyen->thuocnhieutheloaitruyen()->attach($data['theloai']);
        return redirect()
            ->back()
            ->with('status', 'Thêm truyện thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truyen = Truyen::find($id);
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $danhmucCuaTruyen = $truyen->thuocnhieudanhmuctruyen;
        $theloaiCuaTruyen = $truyen->thuocnhieutheloaitruyen;
        return view('admincp.truyen.edit')
            ->with('info_websites', $this->info_web)
            ->with(compact('truyen', 'danhmuc', 'theloai', 'danhmucCuaTruyen', 'theloaiCuaTruyen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'tentruyen' => 'required|max:255',
                'tacgia' => 'required|max:255',
                'hinhanh' => 'image|mimes:png,jpg,jpeg,gif,svg|max:2048|',
                'tomtat_truyen' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required',
                'tag' => '',
                'trangthai_truyen' => '',
                // 'danhmuc_id' => 'required',
            ],
            [
                'tentruyen.unique' => 'Tên danh mục đã tổn tại',
                'tacgia.unique' => 'Tác giả không được trống',
                'tentruyen.required' => 'Tên danh mục không được trống',
                'tomtat_truyen.required' => 'Mô tả không được trống',
            ],
        );
        $slug = Str::slug($data['tentruyen']);
        $truyen = Truyen::find($id);
        foreach ($data['danhmuc'] as $key => $dmuc) {
            $truyen->danhmuc_id = $dmuc[0];
        }
        foreach ($data['theloai'] as $key => $tloai) {
            $truyen->theloai_id = $tloai[0];
        }
        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tag = $data['tag'];
        $truyen->trangthai_truyen = $data['trangthai_truyen'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->slug_truyen = $slug;
        $truyen->tomtat = $data['tomtat_truyen'];
        $truyen->kichhoat = $data['kichhoat'];
        $get_image = $request->hinhanh;
//        if ($get_image) {
//            $path = 'public/uploads/truyen/' . $truyen->hinhanh;
//            if (file_exists($path)) {
//                unlink($path);
//            }
//            $path = 'public/uploads/truyen/';
//            $get_name_image = $get_image->getClientOriginalName();
//            $name_image = current(explode('.', $get_name_image));
//            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
//            $get_image->move($path, $new_image);
//            $truyen->hinhanh = $new_image;
//        }
        if ($get_image) {
            $path = 'public/uploads/truyen/' . $truyen->hinhanh;

            if (file_exists($path)) {
                unlink($path);
            }

            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.webp'; // Đổi định dạng sang WebP
            $get_image->move($path, $new_image);

            // Chuyển đổi hình ảnh sang WebP
            $img = Image::make($path . $new_image)->encode('webp', 75);
            $img->save($path . $new_image);

            $truyen->hinhanh = $new_image;
        }
        $truyen->save();
        $truyen->thuocnhieudanhmuctruyen()->sync($data['danhmuc']);
        $truyen->thuocnhieutheloaitruyen()->sync($data['theloai']);
        return redirect()
            ->back()
            ->with('status', 'Cập nhật truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        $path = 'public/uploads/truyen/' . $truyen->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        $truyen->chapter()->delete();
        $truyen->thuocnhieudanhmuctruyen()->detach();
        $truyen->thuocnhieutheloaitruyen()->detach();
        Truyen::find($id)->delete();
        return redirect()
            ->back()
            ->with('status', 'Xóa truyện thành công');
    }
}
