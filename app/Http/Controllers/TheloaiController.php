<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Theloai;
use Illuminate\Support\Str;

class TheloaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:publish genre|edit genre|delete genre|add genre|publish genre|public', ['only' => ['index', 'show']]);
        $this->middleware('permission:add genre|public|publish genre', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit genre|public|publish genre', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        return view('admincp.theloai.index')->with(compact('theloai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.theloai.create');
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
        return view('admincp.theloai.edit');
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
