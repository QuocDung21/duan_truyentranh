<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Theloai;
use App\Models\Truyen;
use App\Models\Chapter;

class IndexController extends Controller
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

    public function theloai($slug)
    {
        $theloai_id = Theloai::where('slug_theloai', $slug)->first();
        if (!$theloai_id) {
            dd('error');
            // return redirect()->route('home');
        }
        $truyen = Truyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->where('theloai_id', $theloai_id->id)
            ->get();

        return view('pages.theloai')
            ->with(compact('truyen'))
            ->with('theloai', $this->theloai)
            ->with('danhmuc', $this->danhmuc);
    }

    public function home()
    {
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->get();
        $truyen = Truyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->get();
        return view('pages.home')
            ->with(compact('danhmuc', 'truyen'))
            ->with('theloai', $this->theloai);
    }

    public function danhmuc($slug)
    {
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $danhmuc_id = DanhmucTruyen::where('slug_danhmuc', $slug)->first();
        $truyen = Truyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->where('danhmuc_id', $danhmuc_id->id)
            ->get();
        return view('pages.danhmuc')
            ->with(compact('danhmuc', 'truyen'))
            ->with('theloai', $this->theloai);
    }

    public function xemtruyen($slug)
    {
        $truyen = Truyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->where('slug_truyen', $slug)
            ->first();
        $truyenId = Truyen::where('slug_truyen', $slug)->first();
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')
            ->where('kichhoat', 0)
            ->get();
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
            ->with(compact('danhmuc', 'truyen', 'chapter', 'cungdanhmuc', 'chapter_dau'))
            ->with('theloai', $this->theloai);
    }

    public function xemchapter($slug)
    {
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $truyenId = Chapter::where('slug_chapter', $slug)->first();
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
            ->with(compact('danhmuc', 'chapter', 'all_chapter', 'next_chapter', 'previous_chapter', 'max_id', 'min_id'))
            ->with('theloai', $this->theloai);
    }
}
