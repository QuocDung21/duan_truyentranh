<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\Theloai;
use App\Models\Danhmuctruyen;
use App\Models\Chapter;
use App\Models\Truyen;
use App\Models\User;
use Illuminate\Support\Str;

class apiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        //Start category
        $this->middleware('permission:publish category|edit category|delete category|add category', ['only' => ['index', 'show']]);
        $this->middleware('permission:add category', ['only' => ['create', 'store']]);
        $this->middleware('permission:delete category', ['only' => ['destroyDanhmucApi']]);
        //End category
        $this->middleware('permission:delete genre', ['only' => ['destroyTheloaiApi']]);
        $this->middleware('permission:delete chapter', ['only' => ['destroyChapterApi']]);
        $this->middleware('permission:delete articles', ['only' => ['destroyTruyenApi']]);

        $this->middleware('permission:check chapter', ['only' => ['getDataCheckTruyen','checkTruyen']]);
        $this->middleware('permission:check articles', ['only' => ['getDataCheckChapter','checkChapter']]);




        $this->middleware('role:admin', ['only' => ['destroyUserApi']]);
    }
    public function destroyTheloaiApi($id)
    {
        $data = Theloai::findOrFail($id);
        $data->delete();
    }

    public function getDataCheckTruyen(Request $request)
    {
        if ($request->ajax()) {
            $data = Truyen::with('danhmuctruyen', 'theloai')
                ->orderBy('id', 'DESC')
                ->where("kichhoat", 1)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('danhmuc', function ($data) {
                    $danhmuc = '';
                    foreach ($data->thuocnhieudanhmuctruyen as $dt) {
                        $danhmuc .= $dt->tendanhmuc . ' ' . '/';
                    }
                    return $danhmuc;
                })
                ->addColumn('theloai', function ($data) {
                    $theloai = '';
                    foreach ($data->thuocnhieutheloaitruyen as $dt) {
                        $theloai .= $dt->tentheloai . ' ' . '/';
                    }
                    return $theloai;
                })
                ->addColumn('hinhanh', function ($data) {
                    return asset('public/uploads/truyen/' . $data->hinhanh);
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex gap-1">';
                    $button .= '<a type="button" href=' . route('truyen.duyet', [$data->id]) . '  name="duyet" id="' . $data->id . '" class="duyet btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Phê duyệt</a>';
                    $button .= '   <a type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Từ chối</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->make(true);
        }
        return view('admincp.check.truyen');
    }

    public function getDataCheckChapter(Request $request)
    {
        if ($request->ajax()) {
            $data = Chapter::with('truyen')
                ->orderBy('id', 'DESC')
                ->where('kichhoat', 1)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('thuoctruyen', function ($data) {
                    // return $data->truyen->tentruyen;
                    return $data->truyen->tentruyen;
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex gap-1">';
                    $button .= '<a type="button" href=' . route('chapter.duyet', [$data->id]) . '  name="duyet" id="' . $data->id . '" class="duyet btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Phê duyệt</a>';
                    $button .= '   <a type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Từ chối</a>';
                    $button .= '   <a type="button" href=' . route('chapter.view', [$data->id]) . ' name="view"  id="' . $data->id . '" class="view btn btn-info btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Xem nội dung</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->make(true);
        }
        return view('admincp.check.chapter');
    }

    public function getTheloaiApi(Request $request)
    {
        if ($request->ajax()) {
            $data = Theloai::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href=' . route('danhmuc.edit', [$data->id]) . ' type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Sửa</a>';
                    $button .= '   <a  type="button"  name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Xóa</a>';
                    return $button;
                })
                ->make(true);
        }
        return view('admincp.theloai.index');
    }

    public function getDataDanhmuc(Request $request)
    {
        if ($request->ajax()) {
            $data = Danhmuctruyen::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<a href=' . route('danhmuc.edit', [$data->id]) . ' type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Sửa</a>';
                    $button .= '   <a  type="button"  name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Xóa</a>';
                    return $button;
                })
                ->make(true);
        }
        return view('admincp.danhmuctruyen.index');
    }

    public function destroyDanhmucApi($id)
    {
        $data = Danhmuctruyen::findOrFail($id);
        $data->delete();
    }

    public function destroyUserApi($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }

    public function getTruyensApi(Request $request)
    {
        if ($request->ajax()) {
            $data = Truyen::with('danhmuctruyen', 'theloai')
                ->orderBy('id', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('danhmuc', function ($data) {
                    $danhmuc = '';
                    foreach ($data->thuocnhieudanhmuctruyen as $dt) {
                        $danhmuc .= $dt->tendanhmuc . ' ' . '/';
                    }
                    return $danhmuc;
                })
                ->addColumn('theloai', function ($data) {
                    $theloai = '';
                    foreach ($data->thuocnhieutheloaitruyen as $dt) {
                        $theloai .= $dt->tentheloai . ' ' . '/';
                    }
                    return $theloai;
                })
                ->addColumn('hinhanh', function ($data) {
                    return asset('public/uploads/truyen/' . $data->hinhanh);
                })
                ->addColumn('action', function ($data) {
                    $button = '<a href=' . route('truyen.edit', [$data->id]) . ' type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Sửa</a>';
                    $button .= '   <a  type="button"  name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Xóa</a>';
                    return $button;
                })
                ->make(true);
        }
        return view('admincp.truyen.index');
    }

    // Api
    public function destroyChapterApi($id)
    {
        try {
            $data = Chapter::findOrFail($id);
            $data->delete();
        } catch (Exception $e) {
        }
    }
    public function destroyTruyenApi($id)
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
    }
    public function getChaptersApi(Request $request)
    {
        if ($request->ajax()) {
            $data = Chapter::with('truyen')
                ->orderBy('id', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('thuoctruyen', function ($data) {
                    // return $data->truyen->tentruyen;
                    return $data->truyen->tentruyen;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a type="button" href=' . route('chapter.edit', [$data->id]) . '  name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Sửa</a>';
                    $button .= '   <a type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Xóa</a>';
                    return $button;
                })
                ->make(true);
        }
        return view('admincp.chapter.index');
    }

    public function getListUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<div class="btn-group d-flex flex-column " role="group">';
                    // $button .= '<a type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm m-1"> <i class="bi bi-pencil-square"></i>Sửa</a>';
                    $button .= '<a type="button" name="edit" id="' . $data->id . '" class="deletes btn btn-danger btn-sm m-1"> <i class="bi bi-backspace-reverse-fill"></i> Xóa</a>';
                    $button .= '<a href=' . route('vai-tro', [$data->id]) . ' type="button" name="edit" id="' . $data->id . '" class="delete btn btn-info btn-sm m-1"> <i class="bi bi-backspace-reverse-fill"></i> vai trò</a>';
                    $button .= '<a href=' . route('phan-quyen', [$data->id]) . ' type="button" name="edit" id="' . $data->id . '" class="delete btn btn-primary btn-sm m-1"> <i class="bi bi-backspace-reverse-fill"></i> Phân quyền</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->addColumn('quyen', function ($data) {
                    $quyen = '';
                    foreach ($data->roles as $user) {
                        $quyen .= $user->name;
                    }
                    return $quyen;
                })
                ->addColumn('vaitro', function ($data) {
                    $vaitro = '';
                    foreach ($data->getPermissionsViaRoles() as $user) {
                        $vaitro .= ' ' . $user->name . ' ';
                    }
                    return $vaitro;
                })
                ->make(true);
        }
        return view('admincp.users.index');
    }

    public function viewChapter($id)
    {
        $chapter = Chapter::find($id);
        $truyen = Truyen::orderBy('id', 'DESC')->get();
        return view('admincp.chapter.view')->with(compact('chapter', 'truyen'));
    }

    public function checkChapter($id)
    {
        $chapter = Chapter::find($id);
        $chapter->kichhoat = 0;
        $chapter->save();
        return redirect()
            ->back()
            ->with('status', 'Duyệt thành công');
    }

    public function checkTruyen($id)
    {
        $truyen = Truyen::find($id);
        $truyen->kichhoat = 0;
        $truyen->save();
        return redirect()
            ->back()
            ->with('status', 'Duyệt thành công');
    }
}
