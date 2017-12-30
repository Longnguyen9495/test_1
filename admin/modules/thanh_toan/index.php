<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        /* Css chung */
        body {
            background: #020202;
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }

        img {
            max-width: 100%;
        }

        a {
            text-decoration: none;
            color: #717171;
        }

        a:active {
            color: #f5f5f5 !important;
            background-color: transparent !important;
        }

        a:focus {
            background-color: transparent !important;
            border: none !important;
            color: #b2060f;
        }

        a:hover {
            transition: all 0.5s;
            color: #b2060f;
            background-color: transparent !important;
            text-decoration: none;
        }

        .nav > li > a:focus:hover {
            transition: all 0.5s;
            color: #b2060f;
            background-color: transparent !important;
        }

        .container {
            width: 1200px;
        }

        /* header */
        #header {
            margin-top: 20px;
        }

        .banner_header .carousel-inner img {
            height: 400px !important;
        }

        .logo_header {
            width: 20%;
            float: left;
        }

        .menu_login_header {
            width: 80%;
            float: right;
        }

        .menu_login_header .glyphicon-search {
            line-height: 20px;
        }

        .menu_login_header .navbar li a {
            padding-left: 20px;
            color: #f5f5f5;
            font-weight: 500;
            background-color: transparent !important;
        }

        .menu_login_header .navbar li a:focus:hover {
            transition: all 0.5s;
            color: #b2060f;
            background-color: transparent !important;
        }

        .information_detail_mixset {
            overflow: hidden;
        }

        .menu_nav_header li a {
            text-decoration: none;
            color: #f5f5f5;
            background-color: transparent !important;
        }

        .banner_header .carousel-inner img {
            margin: 0 auto;
        }

        /* End css header */

        /* Content CSS */
        .detail_mixset_content {
            width: 100%;
        }

        .information_detail_mixset .img_track_mixset img {
            border-radius: 4px;
        }

        .information_detail_mixset .img_track_mixset img:hover {
            transition: 300ms;
            opacity: 0.5;
        }

        .title_content_left a:focus:hover {
            transition: all 0.5s;
            color: #b2060f;
            text-decoration: none;
        }

        .detail_information_mixset .information_detail_mixset {
            width: 20%;
            float: left;
            padding: 0px 3px;
        }

        .detail_track_mixset a {
            text-decoration: none;
            color: #f5f5f5;
            font-size: 16px;
            font-weight: 500;
        }

        .user_posted a {
            text-decoration: none;
            font-size: 11px;
            color: #f5f5f5;
        }

        .title_content .title_content_left {
            width: 10%;
            float: left;
        }

        .title_content .title_content_right {
            width: 85%;
            float: right;
            margin: 0 10px;
        }

        .content_detail_left {
            width: 75%;
            float: left;
            padding: 0;
        }

        .content_detail_right {
            width: 25%;
            float: right;
            padding-right: 0;
        }

        .title_content_right li {
            float: left;
        }

        .nav_title_content_right {
            float: right;
        }

        .nav_title_content_right li a {
            padding-top: 25px;
        }

        .poster_advertisement {
            margin-bottom: 20px;
        }

        .poster_advertisement img {
            width: 100%;
            height: 250px;
        }

        .more {
            text-align: center;
            margin: 15px 0;
        }

        .user_list_poster {
            display: inline-block;
        }

        .more h3 {
            text-transform: uppercase;
            display: inline-block;
            padding: 6px 33px;
            color: #707070;
            border: 1px solid #333;
            border-radius: 20px;
            font-size: 13px;
        }

        .img_poster img {
            width: 100%;
            height: auto;
        }

        .more h3:hover {
            border-color: #b2060f;
            color: #b2060f !important;
        }

        .detail_list_album {
            width: 100%;
            float: left;
        }

        .share_list_album .user-action li a {
            text-transform: uppercase;
            display: inline-block;
            padding: 6px 33px;
            color: #707070;
            border: 1px solid #333;
            border-radius: 20px;
            font-size: 13px;
        }

        .share_list_album .user-action {
            text-align: right;
        }

        .detail_list_album .img_album a .img_album_logo {
            width: 80px;
            height: 80px;
            display: block;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top center;
            border-radius: 4px;
        }

        .img_album_logo:hover {
            transition: 300ms;
            opacity: 0.5;
        }

        .img_album {
            width: 10%;
            float: left;
        }

        .product_album {
            width: 70%;
            float: left;
            padding-left: 10px;
        }

        .share_list_album {
            width: 20%;
            float: right;
        }

        .detail_list_album {
            margin-bottom: 15px;
        }

        .detail_list_album .product_album .user_posted a {
            margin-top: 25px;
            display: inline-block;
            color: #707070;
            font-size: 13px;
        }

        .detail_list_album .product_album .h1_content_detail a {
            color: #f5f5f5;
            font-family: inherit;
            font-weight: 600;
            line-height: 1.1;
        }

        .h1_content_detail {
            margin-top: 5px;
        }

        .block_sidebar {
            border-radius: 5px;
            background: #121212;
            margin-bottom: 25px;
        }

        .block_sidebar .header {
            padding: 15px 17px 0 17px;
            overflow: hidden;
        }

        .block_sidebar .type span {
            float: left;
            font-size: 15px;
            color: #d6d6d6;
            text-transform: uppercase;
        }

        .block_sidebar .type a {
            float: right;
            display: inline-block;
            margin-top: 0px;
            color: #717171;
            font-size: 12px;
        }

        .media .rank-up-down {
            color: #fff;
        }

        .widget-song-list .media .ratings {
            font-size: 12px;
        }

        .widget-song-list .media span {
            display: block;
        }

        .widget-song-list .media span {
            display: block;
        }

        .rank-up-down .arrow {
            display: inline-block;
            width: 11px;
            height: 6px;
            background: url("https://st.mix166.com/html/images/arrow-point.png") no-repeat;
            background-size: cover;
        }

        .media {
            margin: 10px 0;
        }

        .widget-song-list .media-body {
            width: auto;
        }

        .media-left, .media-body, .media-right {
            vertical-align: middle;
            display: table-cell;
        }

        .media-left {
            width: 10%;
            float: left;
            transform: translateX(35%) translateY(0);
            margin-top: 15px;
        }

        .media-body {
            width: 25%;
            float: left;
        }

        .media-body .global-figure .global-image a img {
            width: 60px;
            height: 60px;
            border-radius: 4px;
            position: relative;
        }

        .list_video_detail .global-figure .global-image .hover_video:before {
            position: absolute;
            content: '';
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            -webkit-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
        }
        .list_video_detail .global-figure .global-image .hover_video:hover:before {
            right: 50%;
            left: 50%;
            width: 0;
            background: rgba(255, 255, 255, 0.3);
        }
        .list_video_detail .global-figure .global-image .hover_video:after {
            position: absolute;
            content: '';
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            -webkit-transition: all 0.5s ease-in-out;
            transition: all 0.5s ease-in-out;
            -moz-transition: all 0.5s ease-in-out;
            -ms-transition: all 0.5s ease-in-out;
            -o-transition: all 0.5s ease-in-out;
        }
        .list_video_detail .global-figure .global-image .hover_video:hover:after {
            height: 0;
            top: 50%;
            bottom: 50%;
            background: rgba(255, 255, 255, 0.3);
        }

        .media-body .global-figure .global-image a img:hover {
            transition: 300ms;
            opacity: 0.5;
        }

        .global-author, .global-name {
            margin-top: 10px;
        }

        .media-right {
            width: 65%;
            float: left;
        }

        .widget-song-list .global-name {
            margin-top: 10px;
        }

        .global-name a {
            color: #f5f5f5;
            font-size: 13px;
        }

        .global-author {
            font-size: 12px;
        }

        .block_sidebar .header {
            padding: 15px 17px 0 17px;
            overflow: hidden;
        }

        .block_sidebar .type span {
            float: left;
            font-size: 15px;
            color: #d6d6d6;
            text-transform: uppercase;
        }

        .block_sidebar .type a {
            float: right;
            display: inline-block;
            margin-top: 0px;
            color: #717171;
            font-size: 12px;
        }

        .block_sidebar .list_song_album .media .media-body {
            width: 90%;
        }

        .block_sidebar .list_song_album .media .media-body .global-tag {
            margin-top: 10px;
            font-size: 16px;
        }

        .block_sidebar .list_song_album .media .media-left {
            margin-top: 7px;
        }

        .list_video_detail .list-video .global-action {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 10;
        }

        .list_video_detail .list-video .video-play .flaticon-arrows {
            position: absolute;
            top: 11px;
            left: 18px;
            color: #fff;
        }

        .list_video_detail .video-time {
            font-size: 11px;
            position: absolute;
            bottom: 0;
            right: 0px;
            z-index: 1;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.53);
            display: block;
            padding: 1px 4px;
        }

        .list_video_detail .list-video .video-play {
            background: #000;
            opacity: 0.5;
            width: 50px;
            height: 50px;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -25px;
            margin-top: -25px;
            border-radius: 50%;
        }

        .list_video_detail .global-figure {
            position: relative;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            z-index: 1;
        }

        .list_video_detail .global-image {
            width: 100%;
            position: relative;
            background-color: #000;
            display: block;
            z-index: 2;
            outline: none !important;
        }

        .list_video_detail .home-section {
            padding: 0 3px;
        }

        .list_video_detail .video .global-image img {
            border-radius: 0;
        }

        .list_video_detail .global-image img {
            width: 100%;
            display: block;
            background-size: cover;
            border-radius: 4px;
        }

        /*footer*/
        #footter {
            font-size: 12px;
            position: relative;
            padding: 30px 0;
            margin-top: 60px;
            font-weight: 300;
        }

        #footter:after {
            height: 5px;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            content: "";
            background-color: red;
            background: -webkit-linear-gradient(right, #000, #ed1b35);
            background: -o-linear-gradient(right, #000, #ed1b35);
            background: -moz-linear-gradient(right, #000, #ed1b35);
            background: linear-gradient(to right, #000, #ed1b35);
        }

        #footter ul li a {
            color: #adadad;
        }

        #footter ul li {
            margin-top: 10px;
        }

        #footter .logo {
            margin: 10px 0;
        }

        #footter .list-inline a {
            font-size: 20px;
            border: 1px solid white;
            display: inline-block;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            color: #b2060f;
            background-color: white;
            text-align: center;
            padding: 5px 0px;
            font-weight: 600;
        }

        #footter .title a {
            color: white;
        }
    </style>
</head>
<body style="">
<div id="header">
    <div class="container">
        <div class="header-contact clearfix">
            <div class="logo_header">
                <a href=""><img class="img-responsive" src="https://st.mix166.com/html/images/logo.png" alt=""></a>
            </div>
            <div class="menu_login_header">
                <nav class="navbar">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">TRACK</a></li>
                            <li><a href="#">MIXSET</a></li>
                            <li><a href="#">VIDEO</a></li>
                            <li><a href="#">CHART</a></li>
                            <li><a href="#">TOP DJ</a></li>
                        </ul>
                        <form class="navbar-form navbar-left" action="../../../home/index.php">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="banner_header">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <a href="">
                            <img class="img-responsive"
                                 src="https://st-cdn.mix166.com/images/edm_home_featured/2017/04/19/1492595663-ready-for-the-summer.jpg">
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img class="img-responsive"
                                 src="https://st-cdn.mix166.com/images/edm_home_featured/2017/10/03/1507025127-hiihi.jpg">
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img class="img-responsive"
                                 src="https://st-cdn.mix166.com/images/edm_home_featured/2017/10/31/1509433925-cover.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="content_detail_left col-sm-9">
            <div class="detail_information_mixset clearfix">
                <div class="title_content clearfix">
                    <div class="title_content_left">
                        <h3><a href="">MIXSET</a></h3>
                    </div>
                    <div class="title_content_right">
                        <ul class="nav navbar-nav nav_title_content_right">
                            <li class="active"><a href="#misset_fetured" data-toggle="tab">Featured</a></li>
                            <li><a href="#misset_newest" data-toggle="tab">Newest</a></li>
                        </ul>
                    </div>
                </div>
                <?
                $product_mixset = [
                    [
                        'name' => "Vui đi em",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000270947999-pfawvc-t200x200.jpg"
                    ],
                    [
                        'name' => "Grow Up",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000270947999-pfawvc-t200x200.jpg"
                    ],
                    [
                        'name' => "Grow Up",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000207554508-0ntmqq-t200x200.jpg"
                    ],
                    [
                        'name' => "Anh trai mưa",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000244088489-hf661u-t200x200.jpg"
                    ],
                    [
                        'name' => "Grow Up",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000258050972-t6ajqy-t200x200.jpg"
                    ],
                    [
                        'name' => "Grow Up",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000244955626-5pf1af-t200x200.jpg"
                    ],
                    [
                        'name' => "Grow Up",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000270947999-pfawvc-t200x200.jpg"
                    ],
                    [
                        'name' => "Shine Your Light",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000218940523-qc6jz7-t200x200.jpg"
                    ],
                    [
                        'name' => "Grow Up",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000242327139-kqwjeh-t200x200.jpg"
                    ],
                    [
                        'name' => "GOODBYE",
                        'imgMixset' => "https://i1.sndcdn.com/artworks-000198210913-d8g6wb-t200x200.jpg"
                    ],
                ];
                ?>
                <div class="detail_mixset_content">
                    <?php foreach ($product_mixset as $key => $value) { ?>
                        <div class="information_detail_mixset">
                            <a href="" class="img_track_mixset">
                                <img class="img-responsive" src="<? echo $value['imgMixset'] ?>" alt="">
                            </a>
                            <h4 class="detail_track_mixset">
                                <a href=""><? echo $value['name'] ?></a>
                            </h4>
                            <p class="user_posted user_list_poster"><a href="">Long Nguyễn</a></p>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="more">
                <h3><a href="">More</a></h3>
            </div>
            <div class="img_poster">
                <a href=""><img class="img-responsive"
                                src="https://st.mix166.com/html/images/topdj/ads-glee-banner-scroll-166-810x100.jpg"
                                alt=""></a>
            </div>
            <div class="detail_track_list clearfix">
                <div class="title_content clearfix">
                    <div class="title_content_left">
                        <h3><a href="">TRACKS</a></h3>
                    </div>
                    <div class="title_content_right">
                        <ul class="nav navbar-nav nav_title_content_right">
                            <li class="active"><a href="#misset_fetured" data-toggle="tab">Featured</a></li>
                            <li><a href="#misset_newest" data-toggle="tab">Newest</a></li>
                        </ul>
                    </div>
                </div>
                <?
                $list_track = [
                    [
                        'name' => "Grow Up [Remake] - ft Phương Shi Phu",
                        'list_track' => "https://st-cdn.mix166.com/images/edm_songs/2017/12/20/1513748279-cung-anh-kynbb.jpg"
                    ],
                    [
                        'name' => "N G A Y D O - E.N.E.S.T.Y x Mây",
                        'list_track' => "https://i1.sndcdn.com/artworks-000270947999-pfawvc-t200x200.jpg"
                    ],
                    [
                        'name' => "Ta Đã Quên Nhau Chưa - Chính Nguyễn",
                        'list_track' => "https://i1.sndcdn.com/artworks-000207554508-0ntmqq-t200x200.jpg"
                    ],
                    [
                        'name' => "Vui Đi Em - Long Ng. Ft Mây ( Pro. By Hieu Pham )",
                        'list_track' => "https://i1.sndcdn.com/artworks-000244088489-hf661u-t200x200.jpg"
                    ],
                    [
                        'name' => "Anh Trai Mưa Cover - Harry Nguyễn",
                        'list_track' => "https://i1.sndcdn.com/artworks-000258050972-t6ajqy-t200x200.jpg"
                    ],
                ];
                ?>
                <?php foreach ($list_track as $key => $value) { ?>
                    <div class="detail_list_album">
                        <div class="img_album">
                            <a href="">
                                <img class="img_album_logo img-responsive" src="<? echo $value['list_track'] ?>" alt="">
                            </a>
                        </div>
                        <div class="product_album">
                            <div class="h1_content_detail">
                                <a href=""><? echo $value['name'] ?></a>
                            </div>
                            <p class="user_posted"><a href="">Long Nguyễn</a></p>
                        </div>
                        <div class="share_list_album">
                            <div class="action">
                                <ul class="user-action list-inline">
                                    <li><a href="javascript:void(0)" title="Share" class="btn-share">share</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
            <div class="more">
                <h3><a href="">More</a></h3>
            </div>
            <div class="video_detail_content">
                <div class="title_content clearfix">
                    <div class="title_content_left">
                        <h3><a href="">VIDEOS</a></h3>
                    </div>
                    <div class="title_content_right">
                        <ul class="nav navbar-nav nav_title_content_right">
                            <li class="active"><a href="#misset_fetured" data-toggle="tab">Featured</a></li>
                            <li><a href="#misset_newest" data-toggle="tab">Newest</a></li>
                        </ul>
                    </div>
                </div>
                <div class="list_video_detail">
                    <?
                    $list_video = [
                        [
                            'name' => "Grow Up [Remake] - ft Phương Shi Phu",
                            'list_track' => "https://st-cdn.mix166.com/images/edm_songs/2017/12/20/1513748279-cung-anh-kynbb.jpg",
                            'user_list' => "LONG THEME"
                        ],
                        [
                            'name' => "N G A Y D O - E.N.E.S.T.Y x Mây",
                            'list_track' => "https://i1.sndcdn.com/artworks-000270947999-pfawvc-t200x200.jpg",
                            'user_list' => "LONG THEME"
                        ],
                        [
                            'name' => "Ta Đã Quên Nhau Chưa - Chính Nguyễn",
                            'list_track' => "https://i1.sndcdn.com/artworks-000207554508-0ntmqq-t200x200.jpg",
                            'user_list' => "LONG THEME"
                        ],
                        [
                            'name' => "Vui Đi Em - LONG THEME Ng. Ft Mây ( Pro. By Hieu Pham )",
                            'list_track' => "https://i1.sndcdn.com/artworks-000244088489-hf661u-t200x200.jpg",
                            'user_list' => "LONG THEME"
                        ],
                        [
                            'name' => "Anh Trai Mưa Cover - Harry Nguyễn",
                            'list_track' => "https://i1.sndcdn.com/artworks-000258050972-t6ajqy-t200x200.jpg",
                            'user_list' => "LONG THEME"
                        ],
                        [
                            'name' => "N G A Y D O - E.N.E.S.T.Y x Mây",
                            'list_track' => "https://i1.sndcdn.com/artworks-000270947999-pfawvc-t200x200.jpg",
                            'user_list' => "LONG THEME"
                        ],
                        [
                            'name' => "Ta Đã Quên Nhau Chưa - Chính Nguyễn",
                            'list_track' => "https://i1.sndcdn.com/artworks-000207554508-0ntmqq-t200x200.jpg",
                            'user_list' => "LONG THEME"
                        ],
                        [
                            'name' => "Vui Đi Em - LONG THEME Ng. Ft Mây ( Pro. By Hieu Pham )",
                            'list_track' => "https://i1.sndcdn.com/artworks-000244088489-hf661u-t200x200.jpg",
                            'user_list' => "LONG THEME"
                        ],
                    ];
                    ?>
                    <?php foreach ($list_video as $key => $value) { ?>
                        <div class="col-sm-3 home-section">
                            <div class="img_video">
                                <div class="thumb">
                                    <div class="global-figure">
                                        <div class="global-image">
                                            <a class="hover_video" href="" title="">
                                                <img src="<? echo $value['list_track'] ?>"
                                                     alt="">
                                            </a>
                                            <span class="video-time">03:56</span>
                                        </div>
                                    </div>
                                    <a href="" title="" class="global-action">
                                      <span class="video-play">
                                        <i class="flaticon-arrows"></i>
                                      </span>
                                    </a>

                                </div>
                            </div>
                            <div class="action">
                                <div class="title_video">
                                    <h3 class="global-author" style="font-weight: 600; font-size: 13px;"><a
                                                style="color: white" href=""><? echo $value['name'] ?></a></h3>
                                </div>
                                <div class="user_action_video">
                                    <h3 class="global-author"><a href="">JustaTee</a> - <a href="">Phương Ly</a></h3>
                                </div>
                                <div class="view_video">
                                    <p><a href="">1,002,412 View</a></p>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
            <div class="more">
                <h3><a href="">More</a></h3>
            </div>
        </div>
        <div class="content_detail_right col-sm-3">
            <h3 class="title_content_left"><a href="">VIDEO</a></h3>
            <div class="poster_advertisement">
                <a href="">
                    <img class="img-responsive"
                         src="https://scontent.fhan2-1.fna.fbcdn.net/v/t1.0-9/25593828_318108295359219_3432627263710028888_n.jpg?oh=f059c4e2762011167d4ddc2f3c743440&oe=5AB745B6"
                         alt="">
                </a>
            </div>
            <div class="block_sidebar">
                <div class="header">
                    <a href="#" title="">
                        <img class="img-responsive" src="https://st.mix166.com/html/images/right-logo.png">
                    </a>
                    <div class="type">
                        <span>top mixsets</span>
                        <a href="" title="View all">View all</a>
                    </div>
                </div>
                <?
                $top_mixset = [
                    [
                        'name' => "Grow Up [Remake] - ft Phương Shi Phu",
                        'list_track' => "https://st-cdn.mix166.com/images/edm_songs/2017/12/20/1513748279-cung-anh-kynbb.jpg",
                        'user_list' => "LONG THEME"
                    ],
                    [
                        'name' => "N G A Y D O - E.N.E.S.T.Y x Mây",
                        'list_track' => "https://i1.sndcdn.com/artworks-000270947999-pfawvc-t200x200.jpg",
                        'user_list' => "LONG THEME"
                    ],
                    [
                        'name' => "Ta Đã Quên Nhau Chưa - Chính Nguyễn",
                        'list_track' => "https://i1.sndcdn.com/artworks-000207554508-0ntmqq-t200x200.jpg",
                        'user_list' => "LONG THEME"
                    ],
                    [
                        'name' => "Vui Đi Em - LONG THEME Ng. Ft Mây ( Pro. By Hieu Pham )",
                        'list_track' => "https://i1.sndcdn.com/artworks-000244088489-hf661u-t200x200.jpg",
                        'user_list' => "LONG THEME"
                    ],
                    [
                        'name' => "Anh Trai Mưa Cover - Harry Nguyễn",
                        'list_track' => "https://i1.sndcdn.com/artworks-000258050972-t6ajqy-t200x200.jpg",
                        'user_list' => "LONG THEME"
                    ],
                ];
                ?>
                <?php foreach ($top_mixset as $key => $value) { ?>
                    <div class="media">
                        <div class="media-left media-middle">
                            <div class="rank-up-down">
                            <span class="ratings">
                                1                            </span>
                                <span><span class="arrow"></span></span>
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="thumb">
                                <div class="global-figure">
                                    <div class="global-image">
                                        <a href="" title="Vintage Mix 9">
                                            <img src="<? echo $value['list_track'] ?>"
                                                 alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="media-right">
                            <h2 class="global-name"><a href="" title="Vintage Mix 9"><? echo $value['name'] ?></a></h2>
                            <h3 class="global-author">
                                <a href=""><? echo $value['user_list'] ?></a>
                            </h3>
                        </div>
                    </div>
                <? } ?>
            </div>
            <div class="block_sidebar">
                <div class="header">
                    <a href="#" title="">
                        <img class="img-responsive" src="https://st.mix166.com/html/images/right-logo.png">
                    </a>
                    <div class="type">
                        <span>top mixsets</span>
                        <a href="" title="View all">View all</a>
                    </div>
                </div>
                <div class="list_song_album">
                    <?
                    $top_track = [
                        [
                            'name' => "Grow Up [Remake] - ft Phương Shi Phu",
                            'user_list' => "#Long Theme"
                        ],
                        [
                            'name' => "N G A Y D O - E.N.E.S.T.Y x Mây",
                            'user_list' => "#Long Theme"
                        ],
                        [
                            'name' => "Ta Đã Quên Nhau Chưa - Chính Nguyễn",
                            'user_list' => "#Long Theme"
                        ],
                        [
                            'name' => "Vui Đi Em - LongNg . Ft Mây ( Pro. By Hieu Pham )",
                            'user_list' => "#Long Theme"
                        ],
                        [
                            'name' => "Anh Trai Mưa Cover - Harry Nguyễn",
                            'user_list' => "#Long Theme"
                        ],
                    ];
                    ?>
                    <?php foreach ($top_track as $key => $value) { ?>
                        <div class="media">
                            <div class="media-left"><span class="ratings">1</span></div>
                            <div class="media-body">
                                <h2 class="global-name"><a href=""
                                                           title="Mặt Trời Của Em (Rhymastic Remix)"><? echo $value['name'] ?></a>
                                </h2>
                                <h3 class="global-author">
                                    <a href="">JustaTee</a>
                                    - <a href="">Phương Ly</a>
                                </h3>
                                <h3 class="global-tag">
                                    <a href="">#Dance</a>
                                </h3>
                            </div>
                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footter">
    <div class="container">
        <div class="col-sm-2">
            <div class="logo">
                <a href=""><img src="https://st.mix166.com/html/images/logo.png" alt=""></a>
            </div>
            <div class="logo_appStore">
                <a href=""><img src="https://st.mix166.com/html/images/app-store.png" alt=""></a>
            </div>
        </div>
        <div class="col-sm-2">
            <h4 class="title"><a href="">ABOUT</a></h4>
            <ul class="list-unstyled">
                <li><a href="#">Company</a></li>
                <li><a href="#">Terms and Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Feedback</a></li>
            </ul>
        </div>
        <div class="col-sm-2">
            <h4 class="title"><a href="">MENU</a></h4>
            <ul class="list-unstyled">
                <li><a href="#">Track</a></li>
                <li><a href="#">Mixset</a></li>
                <li><a href="#">Video</a></li>
                <li><a href="#">Chart</a></li>
            </ul>
        </div>
        <div class="col-sm-6">
            <h4 class="title"><a href="">SOCIAL NETWORK</a></h4>
            <ul class="list-inline social">
                <li class="facebook"><a target="_blank" href=""><i class="ion-social-facebook"></i></a>
                </li>
                <li class="twitter"><a target="_blank" href=""><i class="ion-social-twitter"></i></a></li>
                <li class="youtube"><a target="_blank" href=""><i class="ion-social-youtube"></i></a></li>
                <li class="instagram"><a target="_blank" href=""><i class="ion-social-instagram"></i></a>
                </li>
                <li class="google"><a target="_blank" href=""><i class="ion-social-googleplus"></i></a></li>

            </ul>
        </div>
    </div>
</div>
</body>
</html>

<script>

</script>