<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Theloai;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $theloai, $danhmuc, $truyen, $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $this->theloai = Theloai::orderBy('id', 'DESC')->get();
        $this->truyen = Truyen::orderBy('id', 'DESC')->get();
        $this->user = User::orderBy('id', 'DESC')->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('hom
        e')
            ->with('theloai', $this->theloai)
            ->with('truyen', $this->truyen)
            ->with('user', $this->user)
            ->with('danhmuc', $this->danhmuc);
    }
}
