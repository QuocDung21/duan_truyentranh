<style>
    .custom-product-comment-item {
        position: relative;
    }
    .custom-product-comment-item-pic {
        position: relative;
        display: inline-block;
        width: 100px;
    }
    .custom-product-comment-item-pic img {
        max-width: 100%;
        height: auto;
    }
    .custom-product-comment-item-text {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .custom-product-comment-item:hover .custom-product-comment-item-text {
        opacity: 1;
    }
    .custom-product-comment-item-text ul,
    .custom-product-comment-item-text h5,
    .custom-product-comment-item-text span {
        margin: 5px;
    }
</style>

<section class="mt-5">
    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="section-title">
                <h4>Truyện hay nên đọc</h4>
            </div>
        </div>
        <div class="owl-carousel owl-theme mt-5" >
            @foreach ($truyen as $tr)
                <div class="custom-product-comment-item "  style="width:200px;height: 100%;">
                    <div class="custom-product-comment-item-pic" style="width:200px;height: 100%;">
                        <img style="border-radius: 5px" src="{{ asset('public/uploads/truyen/' . $tr->hinhanh) }}" alt="">
                    </div>
                    <div class="custom-product-comment-item-text">
                        <h5 style="font-size: 10px"><a href="#">{{ $tr->tentruyen }}</a></h5>
                        <span><i class="fa fa-eye"></i> 19.141 Views</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
