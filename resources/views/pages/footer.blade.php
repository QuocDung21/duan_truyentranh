 <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><i class="fa-solid fa-arrow-up"></i></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                    <div class="footer__nav">
                        <ul>
                            <li class="active"><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a title="Liên hệ" href="#">Liên hệ</a></li>
                        </ul>
                        <p>
                            {{ $info_webs->website_info }}
                        </p>
                        <p>
                            @Contact : {{ $info_webs->contact }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                </div>
            </div>
        </div>
    </footer>
