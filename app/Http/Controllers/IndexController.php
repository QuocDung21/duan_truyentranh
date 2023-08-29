<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    protected $theloai, $danhmuc, $truyen_moicapnhat, $slide_truyen;

    public function __construct()
    {
        $this->slide_truyen = Truyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->take(8)
            ->first();
        $this->danhmuc = DanhmucTruyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->get();
        $this->theloai = Theloai::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->get();
        $this->truyen_moicapnhat = Truyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->take(4)
            ->get();
    }

    public function theloai($slug)
    {
        $theloai_id = Theloai::where('slug_theloai', $slug)->first();
        $truyen = Truyen::with('danhmuctruyen', 'theloai')
            ->orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->where('theloai_id', $theloai_id->id)
            ->get();

        return view('pages.theloai')
            ->with(compact('truyen'))
            ->with('theloai', $this->theloai)
            ->with('danhmuc', $this->danhmuc)
            ->with('theloai_id', $theloai_id);
    }

    public function home()
    {
        $danhMucList = DanhmucTruyen::where('kichhoat', 0)
            ->orderBy('id', 'ASC')
            ->take(5)
            ->get();;
        foreach ($danhMucList as $key => $dm) {
            $danhSachTruyen = Truyen::where('danhmuc_id', $dm->id)
                ->where('kichhoat', 0)
                ->orderBy('id', 'DESC')
                ->take(10)
                ->get();

            if ($danhSachTruyen->isEmpty()) {
                unset($danhMucList[$key]);
            } else {
                $dm->danhSachTruyen = $danhSachTruyen;
            }
        }
        $truyen = Truyen::orderBy('luotxem', 'DESC')
            ->with('theloai')
            ->where('kichhoat', 0)
            ->take(5)
            ->get();
        $truyenmoicapnhat = Truyen::with('danhmuctruyen', 'theloai')
            ->take(5)
            ->orderBy('updated_at', 'desc')
            ->where('kichhoat', 0)
            ->get();
        $truyen_theloai = Truyen::with('thuocnhieutheloaitruyen')
            ->where('kichhoat', 0)
            ->get();
        return view('pages.home')
            ->with(compact('truyen', 'danhMucList', 'truyenmoicapnhat'))
            ->with('danhmuc', $this->danhmuc)
            ->with('theloai', $this->theloai);
    }

    public function danhmuc($slug)
    {
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc', $slug)->first();
        $truyen = Truyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->where('danhmuc_id', $danhmuc_id->id)
            ->get();
        return view('pages.danhmuc')
            ->with(compact('truyen'))
            ->with('theloai', $this->theloai)
            ->with('danhmuc', $this->danhmuc)
            ->with('tendanhmuc', $danhmuc_id->tendanhmuc);
    }

    public function xemtruyen($slug)
    {
        $truyen = Truyen::orderBy('id', 'DESC')
            ->with('danhmuctruyen', 'thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')
            ->where('kichhoat', 0)
            ->where('slug_truyen', $slug)
            ->first();
        $danhMucTruyen = $truyen->thuocnhieudanhmuctruyen;
        $theLoaiTruyen = $truyen->thuocnhieutheloaitruyen;
        $truyenId = Truyen::where('slug_truyen', $slug)->first();
        $chapter = Chapter::with('truyen')
            ->orderBy('id', 'ASC')
            ->where('truyen_id', $truyenId->id)
            ->get();
        $chapter_moi = Chapter::with('truyen')
            ->orderBy('id', 'DESC')
            ->where('truyen_id', $truyenId->id)
            ->take(3)
            ->get();
        $chapter_dau = Chapter::with('truyen')
            ->orderBy('id', 'ASC')
            ->where('truyen_id', $truyenId->id)
            ->first();
        $cungdanhmuc = Truyen::with('danhmuctruyen')
            ->where('danhmuc_id', $truyen->danhmuctruyen->id)
            ->whereNotIn('id', [$truyen->id])
            ->orderBy('id', 'DESC')
            ->get();

        return view('pages.truyen')
            ->with(compact('truyen', 'chapter', 'cungdanhmuc', 'chapter_dau', 'danhMucTruyen', 'theLoaiTruyen', 'chapter_moi'))
            ->with('theloai', $this->theloai)
            ->with('truyen_moicapnhat', $this->truyen_moicapnhat)
            ->with('danhmuc', $this->danhmuc);
    }

    public function xemchapter($slug)
    {
        $truyenId = Chapter::where('slug_chapter', $slug)->first();
        $truyen = Chapter::orderBy('id', 'DESC')
            ->where('slug_chapter', $slug)
            ->first();
        $truyen_breadcrumb = Truyen::with('danhmuctruyen', 'theloai')
            ->where('id', $truyen->id)
            ->first();

        $chapter = Chapter::with('truyen')
            ->orderBy('id', 'ASC')
            ->where('slug_chapter', $slug)
            ->where('truyen_id', $truyenId->truyen_id)
            ->first();
        $all_chapter = Chapter::orderBy('id', 'ASC')
            ->where('truyen_id', $truyenId->truyen_id)
            ->get();
        $next_chapter = Chapter::where('truyen_id', $truyenId->truyen_id)
            ->where('id', '>', $chapter->id)
            ->min('slug_chapter');
        $previous_chapter = Chapter::where('truyen_id', $truyenId->truyen_id)
            ->where('id', '<', $chapter->id)
            ->max('slug_chapter');
        $max_id = Chapter::where('truyen_id', $truyenId->truyen_id)
            ->orderBy('id', 'DESC')
            ->first();
        $min_id = Chapter::where('truyen_id', $truyenId->truyen_id)
            ->orderBy('id', 'ASC')
            ->first();
        $hasViewedKey = 'viewed_truyen_' . $chapter->slug_chapter;
        if (!Session::has($hasViewedKey)) {
            // Tăng lượt xem cho truyện
            $chapter->truyen->luotxem += 1;
            $chapter->truyen->save();
            // Đánh dấu là đã xem trong session
            Session::put($hasViewedKey, true);
        }
        return view('pages.chapter')
            ->with(compact('chapter', 'truyen_breadcrumb', 'all_chapter', 'next_chapter', 'previous_chapter', 'max_id', 'min_id', 'truyen'))
            ->with('theloai', $this->theloai)
            ->with('danhmuc', $this->danhmuc);
    }

    public function timkiem()
    {
        $tukhoa = $_GET['tukhoa'];
        $truyen = Truyen::with('danhmuctruyen', 'theloai')
            ->where('tentruyen', 'LIKE', '%' . $tukhoa . '%')
            ->orWhere('tomtat', 'LIKE', '%' . $tukhoa . '%')
            ->orWhere('tacgia', 'LIKE', '%' . $tukhoa . '%')
            ->get();
        return view('pages.timkiem')
            ->with(compact('tukhoa', 'truyen'))
            ->with('theloai', $this->theloai)
            ->with('danhmuc', $this->danhmuc);
    }

    public function phanquyen($id)
    {
        $user = User::find($id);
    }

    public function assignRole($id)
    {
    }

    public function timkiem_ajax(Request $request)
    {
        $data = $request->all();
        if ($data['keywords']) {
            $truyen = Truyen::with('danhmuctruyen', 'theloai')
                ->where('tentruyen', 'LIKE', '%' . $data['keywords'] . '%')
                ->orWhere('tomtat', 'LIKE', '%' . $data['keywords'] . '%')
                ->orWhere('tacgia', 'LIKE', '%' . $data['keywords'] . '%')
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block;">';
            foreach ($truyen as $key => $tr) {
                $output .= '<li class="li_search_ajax"><a href="">' . $tr->tentruyen . '</a></li>';
            }
            $output .= '<li class="li_search_ajax"><a href="#">Tìm kiếm kết quả khác</a></li>';
            $output .= '</ul>';
            echo $output;
        }
    }
}
