<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\Theloai;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\InfoWebsites;
use App\Models\User;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $theloai, $danhmuc, $truyen, $user, $info_web;
    public function __construct()
    {
        $this->middleware('auth');
        $this->danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        $this->theloai = Theloai::orderBy('id', 'DESC')->get();
        $this->truyen = Truyen::orderBy('id', 'DESC')->get();
        $this->user = User::orderBy('id', 'DESC')->get();
        $this->info_web = InfoWebsites::first();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $info_websites = InfoWebsites::first();
        return view('home')
            // ->with(compact('info_websites'))
            ->with('info_websites', $this->info_web)
            ->with('theloai', $this->theloai)
            ->with('truyen', $this->truyen)
            ->with('user', $this->user)
            ->with('danhmuc', $this->danhmuc);
    }



    public function update_info_websites(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'contact' => 'required',
                'website_info' => 'required',
                'logo' => 'required'
            ],
            [
                'name.required' => 'Tên web không được trống',
                'contact.required' => 'Tên liên hệ không được trống',
                'website_info.required' => 'Thông tin web không được trống',
                'logo.required' => 'Logo không được trống',
            ],
        );
        $info_websites = InfoWebsites::find($id);
        $info_websites->name = $data['name'];
        $info_websites->contact = $data['contact'];
        $info_websites->website_info = $data['website_info'];
        $get_image = $request->logo;
        if ($get_image) {
            $path = 'public/uploads/info/logo/' . $info_websites->logo;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/info/logo/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $info_websites->logo = $new_image;
        }


        // $get_image = $request->logo;
        // $path = base_path() . 'public/uploads/info/logo/';
        // $get_name_image = $get_image->getClientOriginalName();
        // $name_image = current(explode('.', $get_name_image));
        // $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        // $get_image->move($path, $new_image);
        // $info_websites->logo = $new_image;


        $info_websites->save();
        return redirect()
            ->back()
            ->with('status', 'Cập nhật thành công');
    }
}
