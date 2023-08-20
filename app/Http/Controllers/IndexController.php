<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Theloai;
use App\Models\Truyen;
use App\Models\Chapter;

class IndexController extends Controller
{
    protected $theloai, $danhmuc, $truyen, $slide_truyen;

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
    }

    public function theloai($slug)
    {
        $theloai_id = Theloai::where('slug_theloai', $slug)->first();
        if (!$theloai_id) {
            dd('error');
        }
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
        $truyen = Truyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->get();
        return view('pages.home')
            ->with(compact('truyen'))
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
            ->with('danhmuctruyen')
            ->where('kichhoat', 0)
            ->where('slug_truyen', $slug)
            ->first();
        $truyenId = Truyen::where('slug_truyen', $slug)->first();
        $chapter = Chapter::with('truyen')
            ->orderBy('id', 'ASC')
            ->where('truyen_id', $truyenId->id)
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
            ->with(compact('truyen', 'chapter', 'cungdanhmuc', 'chapter_dau'))
            ->with('theloai', $this->theloai)
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
        return view('pages.chapter')
            ->with(compact('chapter', 'truyen_breadcrumb', 'all_chapter', 'next_chapter', 'previous_chapter', 'max_id', 'min_id'))
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
