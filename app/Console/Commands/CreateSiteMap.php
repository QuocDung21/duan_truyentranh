<?php

namespace App\Console\Commands;

use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Truyen;
use App\Models\Chapter;
use App\Models\Theloai;
use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use App\Models\InfoWebsites;
use App\Models\Truyen_Danhmuc;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use DB;
use App;

class CreateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = App::make('sitemap');
        $sitemap->add(route('homepage'), Carbon::now('Asia/Ho_Chi_Minh'), '1.0', 'daily');

        $danhmuc = DanhmucTruyen::orderBy('id', 'Desc')->get();
        $theloai = Theloai::orderBy('id', 'Desc')->get();
        $truyen = Truyen::orderBy('id', 'Desc')->get();

        foreach ($danhmuc as $dmuc) {
            $url = env('APP_URL') . "/danh-muc/{$dmuc->slug_danhmuc}";
            $sitemap->add($url, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

        foreach ($theloai as $tloai) {
            $url = env('APP_URL') . "/the-loai/{$tloai->slug_theloai}";
            $sitemap->add($url, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

        foreach ($truyen as $tr) {
            $url = env('APP_URL') . "/xem-truyen/{$tr->slug_truyen}";
            $sitemap->add($url, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

        $chapter = Chapter::select('slug_chapter')->get();
        foreach ($chapter as $cter) {
            $url = env('APP_URL') . "/xem-chapter/{$cter->slug_chapter}";
            $sitemap->add($url, Carbon::now('Asia/Ho_Chi_Minh'), '0.7', 'daily');
        }

        $sitemap->store('xml', 'sitemap');

        if (File::exists(base_path() . '/sitemap.xml')) {
            File::copy(public_path('sitemap.xml'), base_path('sitemap.xml'));
            File::copy(public_path('sitemap-0.xml'), base_path('sitemap-0.xml'));
            File::copy(public_path('sitemap-1.xml'), base_path('sitemap-1.xml'));
        }
    }
}
