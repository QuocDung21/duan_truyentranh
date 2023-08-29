<style>

</style>

<section class="mt-5">
    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="section-title">
                <h4>Truyện hay nên đọc</h4>
            </div>
        </div>
        <div class="owl-carousel owl-theme mt-5">
            @foreach ($truyen as $tr)
                <div class="custom-product-comment-item " style="width:200px;height: 100%;">
                    <div class="custom-product-comment-item-pic" style="width:200px;height: 100%;">
                        <img style="border-radius: 5px" src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}"
                            alt="">
                    </div>
                    <div class="custom-product-comment-item-text">
                        <h5 style="font-size: 10px"><a style="color: white;font-size: 12px;text-align: center"
                                href="{{ route('xem-truyen', [$tr->slug_truyen]) }}">{{ $tr->tentruyen }}</a></h5>
                        <span><i class="fa fa-eye"></i> {{ $tr->luotxem }} lượt xem</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
