@extends('../layout')


@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
    <div class="row ">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <img src=" {{ asset('public/uploads/truyen/download0.png') }}" alt="" srcset="">
                </div>
                <style>
                    .infotruyen {
                        list-style: none;
                        text-decoration: none;
                    }
                </style>
                <div class="col-md-9">
                    <ul class="infotruyen">
                        <li>Tác giả</li>
                        <li>Số chapter : 200</li>
                        <li>Số lượt xem : 200</li>
                        <li><a class="text-decoration-none" href="">Xem mục lục</a></li>
                        <li><a class="text-decoration-none" href="" class="btn btn-primary">Đọc online</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus rerum eos illum minima tenetur quidem
                    totam dolores facere doloribus iure quis id culpa voluptates dolor impedit blanditiis quas minus ad,
                    nemo perspiciatis natus. Quae, laborum quas fugiat, ab perferendis deserunt molestiae obcaecati natus
                    magnam soluta debitis repellat voluptate esse consectetur iure dignissimos beatae ipsam voluptas
                    expedita et dolor optio consequatur! Assumenda delectus voluptatibus pariatur eligendi quibusdam.
                    Voluptatibus doloribus possimus, harum maiores quis suscipit dolores consectetur eligendi quas
                    perferendis illum ea tenetur sapiente expedita. Saepe cupiditate officia sapiente ad quo, consequatur
                    eos ratione voluptate dignissimos quas perspiciatis quisquam repudiandae autem quam dolor corrupti
                    architecto aperiam, deserunt nihil omnis? Sint qui inventore aliquam provident libero iure nostrum
                    aspernatur autem temporibus odit ipsa neque expedita sit accusantium et facere, fugiat dicta vel
                    officiis. Molestiae in numquam ad iure doloremque quasi voluptatem natus facilis minus aliquam
                    distinctio quidem sapiente porro sequi tenetur error voluptatum et eum, alias similique culpa,
                    aspernatur dignissimos quis repellat? In perspiciatis reiciendis suscipit cum accusamus amet optio
                    asperiores sit. Totam voluptatem unde officiis tempore ab aut, dolore minus, repellendus esse sapiente
                    hic maiores quibusdam similique deserunt. Sint consequuntur recusandae id necessitatibus consequatur.
                    Sunt dolorum nobis delectus, iste nesciunt, nemo corrupti dignissimos tempore, nam tenetur
                    necessitatibus. Officia asperiores quibusdam qui esse nesciunt tenetur labore omnis blanditiis vero
                    ipsam a odio tempora cumque maxime recusandae quaerat quis, porro temporibus doloribus reprehenderit
                    cupiditate impedit accusamus laboriosam! Repudiandae, aliquam. Id quae a distinctio molestias quia, ut
                    obcaecati esse odio animi laboriosam nisi consequatur! Dolorem sequi veritatis voluptatem molestiae
                    perspiciatis. Sapiente quae veritatis ut voluptatum impedit saepe culpa. Laudantium incidunt esse eaque,
                    magnam impedit eveniet id voluptas omnis dolore animi, perferendis quam? Aliquid consequuntur quia
                    possimus molestias tempora placeat, enim impedit ea aperiam porro, corporis nihil maiores corrupti.
                    Alias, voluptatem. Laudantium, distinctio? Non, magnam velit!</p>
            </div>
            <hr>
            <h4>Mục lục</h4>
            <ul>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
                <li><a class="text-decoration-none" href="">Phần thứ 1 - CHƯƠNG MỘT</a></li>
            </ul>
            <h4>Sách cùng danh mục</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <a href="" class="text-decoration-none">
                            <img class="card-img-top" src=" {{ asset('public/uploads/truyen/download0.png') }}"
                                alt="">
                            <div class="card-body">
                                <h5>Lorem, ipsum dolor.</h5>
                                <p class="card-text">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum, saepe!
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <a href="" class="text-decoration-none">
                            <img class="card-img-top" src=" {{ asset('public/uploads/truyen/download0.png') }}"
                                alt="">
                            <div class="card-body">
                                <h5>Lorem, ipsum dolor.</h5>
                                <p class="card-text">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum, saepe!
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-4 box-shadow">
                        <a href="" class="text-decoration-none">
                            <img class="card-img-top" src=" {{ asset('public/uploads/truyen/download0.png') }}"
                                alt="">
                            <div class="card-body">
                                <h5>Lorem, ipsum dolor.</h5>
                                <p class="card-text">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum, saepe!
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <h3>Sách hay xem nhiều</h3>
        </div>
    </div>
@endsection
