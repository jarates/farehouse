<?php use App\Components\Theme; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Warehouse</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <link href="{{asset('/')}}/theme/2018/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/css/animate.css" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/css/style.css" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/css/custom.css?v=@php echo time() @endphp" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/css/colors/default.css" id="theme" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet">
    <link href="{{asset('/')}}/theme/2018/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('/')}}/theme/2018/css/dataTables.bootstrap.min.css" rel="stylesheet" />
</head>

<body class="fix-header">

    <div id="pre-loading"></div>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <a class="logo" href="index.html">
                        Happy Warehouse
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="profile-pic" href="#">
                            <b class="hidden-xs">สามารถ จระเทศ</b>
                            (Role)
                        </a>
                    </li>
                    <li>
                        <a class="profile-pic" href="#">
                            <b class="hidden-xs">เปลี่ยนรหัสผ่าน</b>
                        </a>
                    </li>
                    <li>
                        <a class="profile-pic" href="{{ url('logout') }}">
                            <b class="hidden-xs">ออกจากระบบ</b>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 60px 0 0;">
                        <a href="index.html" class="waves-effect"><i class="fa fa-dashboard fa-fw" aria-hidden="true"></i>แดชบอร์ด</a>
                    </li>
                    <li>
                        <a href="profile.html" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Profile</a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-list fa-fw" aria-hidden="true"></i>
                            <span class="hide-menu">สินค้า</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ url('product/create') }}" class="sidebar-link">
                                    <span class="hide-menu">สร้างสินค้า</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-list fa-fw" aria-hidden="true"></i>
                            <span class="hide-menu">คลังสินค้า</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ url('product/management') }}" class="sidebar-link">
                                    <span class="hide-menu">รายการสินค้า</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ url('product/acceptance') }}" class="sidebar-link">
                                    <span class="hide-menu">รับเข้าสินค้า</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ url('product/acceptance/list') }}" class="sidebar-link">
                                    <span class="hide-menu">รายการรับเข้าสินค้า</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
                            <i class="fa fa-cogs fa-fw" aria-hidden="true"></i>
                            <span class="hide-menu">ตั้งค่าระบบ</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <a href="{{ url('setting/company') }}" class="sidebar-link">
                                    <span class="hide-menu">จัดการข้อมูลบริษัท</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ url('setting/supplier') }}" class="sidebar-link">
                                    <span class="hide-menu">จัดการข้อมูลผู้ผลิต</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ url('setting/type-product') }}" class="sidebar-link">
                                    <span class="hide-menu">จัดการประเภทสินค้า</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ url('setting/category-product') }}" class="sidebar-link">
                                    <span class="hide-menu">จัดการหมวดหมู่สินค้า</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ url('setting/brand-product') }}" class="sidebar-link">
                                    <span class="hide-menu">จัดการยี้ห้อสินค้า</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('logout') }}" class="waves-effect"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>ออกจากระบบ</a>
                    </li>

                </ul>
            </div>
            
        </div>

        <div id="page-wrapper">
            <div class="container-fluid">
                
                @yield('content')

            </div>

            <footer class="footer text-center">
                System Happy Warehouse 2019
            </footer>
        </div>

    </div>
    <script src="{{asset('/')}}/theme/2018/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/js/jquery.slimscroll.js"></script>
    <script src="{{asset('/')}}/theme/2018/js/waves.js"></script>
    <script src="{{asset('/')}}/theme/2018/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="{{asset('/')}}/theme/2018/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/js/custom.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <script src="{{asset('/')}}/theme/2018/js/select2.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('/')}}/theme/2018/js/dataTables.bootstrap.min.js"></script>

    @section('scripts')
    @show

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('form').append('{!! csrf_field() !!}');
        function htmlPreLoading(){
            return '<div class="preloader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /></svg></div>';
        }

        $('.g-search').on('click', function(){
            var q = $('input[name=q]').val();
            window.location.href = "?q="+q;
        });

        $('.pagination li a').each(function(){
            var q = getUrlVars()["q"];
            q = decodeURIComponent(q);

            var search_by = getUrlVars()["search_by"];
            search_by = decodeURIComponent(search_by);

            var href = $(this).attr('href');
            var new_href = href+'&q='+q;

            if(search_by != ''){
                new_href += '&search_by='+search_by;
            }
            
            if(q != 'undefined'){
                $(this).attr('href',new_href);
            }
            
        });

        function getUrlVars(){
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }

        function hasWhiteSpace() {
          if(event.keyCode == 32){
            return false;
          }
          return true;
        }
        
    </script>

</body>

</html>
