<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\InfoWebsites;
use App\Models\Truyen_Danhmuc;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    protected $theloai, $danhmuc, $truyen_moicapnhat, $slide_truyen, $truyenmoicapnhat, $info_web;

    public function __construct()
    {
        $this->info_web = InfoWebsites::first();
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
        $this->truyenmoicapnhat = Truyen::with('danhmuctruyen', 'thuocnhieutheloaitruyen')
            ->take(5)
            ->orderBy('updated_at', 'desc')
            ->where('kichhoat', 0)
            ->get();
    }

    public function home()
    {
        $danhMucList = DanhmucTruyen::where('kichhoat', 0)
            ->orderBy('id', 'ASC')
            ->take(5)
            ->get();


        foreach ($danhMucList as $key => $dm) {
            $danhSachTruyen = Truyen::with('thuocnhieudanhmuctruyen')
                ->whereHas('thuocnhieudanhmuctruyen', function ($query) use ($dm) {
                    $query->where('danhmuc_id', $dm->id);
                })
                ->where('kichhoat', 0)
                ->orderBy('id', 'DESC')
                ->take(15)
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

        $truyenmoicapnhat = Truyen::with('danhmuctruyen', 'thuocnhieutheloaitruyen')
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
            ->with('theloai', $this->theloai)
            ->with('info_webs', $this->info_web);
    }

    public function theloai($slug)
    {
        $theloai_id = Theloai::where('slug_theloai', $slug)->first();
        $truyen = Truyen::with('thuocnhieutheloaitruyen')
            ->orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->whereHas('thuocnhieutheloaitruyen', function ($query) use ($theloai_id) {
                $query->where('theloai_id', $theloai_id->id);
            })
            ->get();

        return view('pages.theloai')
            ->with(compact('truyen'))
            ->with('theloai', $this->theloai)
            ->with('danhmuc', $this->danhmuc)
            ->with('truyenmoicapnhat', $this->truyenmoicapnhat)
            ->with('info_webs', $this->info_web)
            ->with('theloai_id', $theloai_id);
    }


    public function danhmuc($slug)
    {
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc', $slug)->first();
        $truyen = Truyen::orderBy('id', 'DESC')
            ->with('danhmuctruyen', 'thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')
            ->where('kichhoat', 0)
            ->whereHas('thuocnhieudanhmuctruyen', function ($query) use ($danhmuc_id) {
                $query->where('danhmuc_id', $danhmuc_id->id);
            })
            ->get();
        return view('pages.danhmuc')
            ->with(compact('truyen'))
            ->with('theloai', $this->theloai)
            ->with('danhmuc', $this->danhmuc)
            ->with('truyenmoicapnhat', $this->truyenmoicapnhat)
            ->with('info_webs', $this->info_web)
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
        $truyenmoicapnhat = Truyen::with('danhmuctruyen', 'thuocnhieutheloaitruyen')
            ->take(5)
            ->orderBy('updated_at', 'desc')
            ->where('kichhoat', 0)
            ->get();
        $chapter_all = Chapter::with('truyen')
            ->orderBy('id', 'ASC')
            ->where('truyen_id', $truyenId->id)
            ->get();
        $chapter = Chapter::with('truyen')
            ->orderBy('id', 'ASC')
            ->where('truyen_id', $truyenId->id)
            ->simplePaginate(10);
        $chapter_moi = Chapter::with('truyen')
            ->orderBy('id', 'DESC')
            ->where('truyen_id', $truyenId->id)
            ->take(6)
            ->get();
        $chapter_dau = Chapter::with('truyen')
            ->orderBy('id', 'ASC')
            ->where('truyen_id', $truyenId->id)
            ->first();

        $tendanhmuc_dau  = $danhMucTruyen->first();

        return view('pages.truyen')
            ->with(compact('truyen', 'chapter','tendanhmuc_dau',  'chapter_dau', 'danhMucTruyen', 'theLoaiTruyen', 'chapter_moi', 'truyenmoicapnhat', 'chapter_all'))
            ->with('theloai', $this->theloai)
            ->with('truyen_moicapnhat', $this->truyen_moicapnhat)
            ->with('info_webs', $this->info_web)
            ->with('danhmuc', $this->danhmuc);
    }

    public function xemchapter($slug)
    {
        $category = DanhmucTruyen::orderBy('id', 'desc')->get();

        //Lấy ra dữ liệu 1 hàng trong bảng chapter THÔNG qua cột slug_chapter
        $truyen = Chapter::where('slug_chapter', $slug)->first();

        // lấy ra dữ liệu của chapter sau
        $chapter_next = Chapter::where('truyen_id', $truyen->truyen_id)->where('id', '>', $truyen->id)->min('id');
        // lấy ra dữ liệu của chapter trước
        $chapter_previous = Chapter::where('truyen_id', $truyen->truyen_id)->where('id', '<', $truyen->id)->max('id');
        //Kết nối với dữ liệu bảng book
        $chapter = Chapter::with('truyen')->where('slug_chapter', $slug)->where('truyen_id', $truyen->truyen_id)->first();
        // Lấy ra số chapter
        $chapter_number = Chapter::with('truyen')->orderBy('id', 'desc')->where('truyen_id', $truyen->truyen_id)->get();

        $truyenId = Chapter::where('slug_chapter', $slug)->first();
        $truyen = Chapter::orderBy('id', 'DESC')
            ->where('slug_chapter', $slug)
            ->first();
        $truyen_breadcrumb = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')
            ->where('id', $truyen->truyen_id)
            ->first();
        $chapter = Chapter::with('truyen')
            ->orderBy('id', 'ASC')
            ->where('slug_chapter', $slug)
            ->where('truyen_id', $truyenId->truyen_id)
            ->first();
        $all_chapter = Chapter::orderBy('id', 'ASC')
            ->where('truyen_id', $truyenId->truyen_id)
            ->get();
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
        $next_chapter = Chapter::find($chapter_next);
        $previous_chapter = Chapter::find($chapter_previous);
        // dd($next_chapter->slug_chapter);


        return view('pages.chapter')
            ->with(compact('chapter', 'truyen_breadcrumb', 'all_chapter', 'next_chapter', 'previous_chapter', 'max_id', 'min_id', 'truyen'))
            ->with('theloai', $this->theloai)
            ->with('info_webs', $this->info_web)
            ->with('danhmuc', $this->danhmuc);
        // ->with('chapter_next ', Chapter::find($chapter_next))
        // ->with('chapter_previous', Chapter::find($chapter_previous));
    }

    public function timkiem()
    {
        $tukhoa = $_GET['keywords'];
        $truyen = Truyen::with('danhmuctruyen', 'theloai')
            ->where('tentruyen', 'LIKE', '%' . $tukhoa . '%')
            ->orWhere('tomtat', 'LIKE', '%' . $tukhoa . '%')
            ->orWhere('tacgia', 'LIKE', '%' . $tukhoa . '%')
            ->orWhere('tag', 'LIKE', '%' . $tukhoa . '%')
            ->get();
        return view('pages.timkiem')
            ->with(compact('tukhoa', 'truyen'))
            ->with('theloai', $this->theloai)
            ->with('info_webs', $this->info_web)
            ->with('truyenmoicapnhat', $this->truyenmoicapnhat)
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
            $keywords = '%' . $data['keywords'] . '%';

            $truyen = Truyen::with('danhmuctruyen', 'theloai')
                ->where('tentruyen', 'LIKE', $keywords)
                ->orWhere('tomtat', 'LIKE', $keywords)
                ->orWhere('tacgia', 'LIKE', $keywords)
                ->orWhere('tag', 'LIKE', $keywords)
                ->get();

            $output = '<ul class="dropdown-menu " style="display:block; width: 400px;">';

            // Check if any books were found
            if ($truyen->count() > 0) {
                foreach ($truyen as $key => $tr) {
                    $imagePath = asset('public/uploads/truyen/' . $tr->hinhanh);
                    $output .= '<li class="li_search_ajax"><a class="d-flex flex-row justify-content-start   " href="/"><div><img loading="lazy"  class="mr-3 object-fit-cover" style="width: 50px;height: 50px" src="' . $imagePath . '" /> </div><div class="d-flex flex-column justify-content-center "><h6 style="font-size: 14px;font-weight: bold" class=""> ' . $tr->tentruyen . '</h6><h6 style="font-size: 14px;font-weight: bold"  >Tác giả: ' . $tr->tacgia . '</h6></div></a></li>';
                    $output .= '<hr/>';
                }
            } else {
                // No books found
                $output .= '<li  class="li_search_ajax font-weight-bold">Không tìm thấy kết quả.</li>';
            }

            $output .= '<li class="li_search_ajax d-flex justify-content-center font-weight-bold"><a href="#">Tìm kiếm kết quả khác</a></li>';
            $output .= '</ul>';
            echo $output;
        }
    }
}
