<?php

namespace App\Http\Controllers;

use App\Models\Theloai;
use Illuminate\Support\Str;
use App\Models\InfoWebsites;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class TheloaiController extends Controller
{
    protected  $info_web;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->info_web = InfoWebsites::first();
        $this->middleware('permission:publish genre|edit genre|delete genre|add genre|publish genre|public', ['only' => ['index', 'show']]);
        $this->middleware('permission:add genre|public|publish genre', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit genre|public|publish genre', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        return view('admincp.theloai.index')
            ->with('info_websites', $this->info_web)
            ->with(compact('theloai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.theloai.create')
            ->with('info_websites', $this->info_web);
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
                'tentheloai' => 'required|unique:theloai|max:255',
                'mota' => 'required|max:255',
                'kichhoat' => 'required',
            ],
            [
                'tentheloai.unique' => 'Tên thể loại đã tổn tại',
                'tentheloai.required' => 'Tên thể loại không được trống',
                'mota.required' => 'Mô tả không được trống',
            ],
        );
        $slug = Str::slug($data['tentheloai']);
        $theloaitruyen = new Theloai();
        $theloaitruyen->tentheloai = $data['tentheloai'];
        $theloaitruyen->slug_theloai = $slug;
        $theloaitruyen->mota = $data['mota'];
        $theloaitruyen->kichhoat = $data['kichhoat'];
        $theloaitruyen->save();
        return redirect()
            ->back()
            ->with('status', 'Thêm thể loại thành công');
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
        //
        $theloai = Theloai::find($id);
        return view('admincp.theloai.edit')
            ->with(compact('theloai'))
            ->with('info_websites', $this->info_web);
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
        //
        $data = $request->validate(
            [
                'tentheloai' => 'required|max:255',
                'mota' => 'required|max:255',
                'kichhoat' => 'required',
            ],
            [
                'tentheloai.required' => 'Tên thể loại không được trống',
                'mota.required' => 'Mô tả không được trống',
            ],
        );
        $slug = Str::slug($data['tentheloai']);
        $theloaitruyen = Theloai::find($id);
        $theloaitruyen->tentheloai = $data['tentheloai'];
        $theloaitruyen->slug_theloai = $slug;
        $theloaitruyen->mota = $data['mota'];
        $theloaitruyen->kichhoat = $data['kichhoat'];
        $theloaitruyen->save();
        return redirect()
            ->back()
            ->with('status', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
