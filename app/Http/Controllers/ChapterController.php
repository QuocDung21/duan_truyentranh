<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Truyen;
use App\Models\Chapter;
use Illuminate\Support\Str;
use App\Models\InfoWebsites;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ChapterController extends Controller
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
        $this->middleware('permission:publish chapter|edit chapter|delete chapter|add chapter', ['only' => ['index', 'show']]);
        $this->middleware('permission:add chapter|publish chapter|public', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit chapter|publish chapter|public', ['only' => ['edit', 'update']]);
        $this->info_web = InfoWebsites::first();
        // $this->middleware('permission:view chapter|publish chapter | public', ['only' => ['index']]);
    }
    public function index()
    {
        $chapter = Chapter::with('truyen')
            ->orderBy('id', 'DESC')
            ->get();
        return view('admincp.chapter.index')
            ->with('info_websites', $this->info_web)
            ->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.create')
            ->with('info_websites', $this->info_web)

            ->with(compact('truyen'));
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
                'tieude' => 'required|unique:chapter|max:255',
                'noidung' => 'required',
                'kichhoat' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'tieude.unique' => 'Tên chapter đã tổn tại',
                'tieude.required' => 'Tên chapter không được trống',
                'noidung.required' => 'Nội dung không được trống',
            ],
        );
        $slug = Str::slug($data['tieude']);
        $chapter = new Chapter();
        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $slug;
        $chapter->noidung = $data['noidung'];
        $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $chapter->kichhoat = 1;
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->save();
        return redirect()
            ->back()
            ->with('status', 'Thêm thành công');
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
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.edit')
            ->with('info_websites', $this->info_web)
            ->with(compact('chapter', 'truyen'));
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
                'tieude' => 'required|:chapter|max:255',
                'noidung' => 'required',
                'kichhoat' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'tieude.unique' => 'Tên chapter đã tổn tại',
                'tieude.required' => 'Tên chapter không được trống',
                'noidung.required' => 'Nội dung không được trống',
            ],
        );
        $slug = Str::slug($data['tieude']);
        $chapter = Chapter::find($id);
        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $slug;
        $chapter->noidung = $data['noidung'];
        // $chapter->kichhoat = 1;
        $chapter->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->save();
        return redirect()
            ->back()
            ->with('status', 'Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()
            ->back()
            ->with('status', 'Xóa chapter truyện thành công');
    }
}
