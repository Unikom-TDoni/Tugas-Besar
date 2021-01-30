<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        {{-- <link rel="shortcut icon" href="{{URL::asset('assets')}}/icon_abd.png"> --}}

        <title>Admin</title>

        <!-- Base Css Files -->
        <link href="{{URL::asset('assets/admin')}}/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="{{URL::asset('assets/admin')}}/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets/admin')}}/assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets/admin')}}/css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="{{URL::asset('assets/admin')}}/css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="{{URL::asset('assets/admin')}}/css/waves-effect.css" rel="stylesheet">

        <!-- DataTables -->
        <link href="{{URL::asset('assets/admin')}}/assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

        <!-- sweet alerts -->
        <link href="{{URL::asset('assets/admin')}}/assets/sweet-alert/sweet-alert.min.css" rel="stylesheet">

        <!--venobox lightbox-->
        <link rel="stylesheet" href="{{URL::asset('assets/admin')}}/assets/magnific-popup/magnific-popup.css"/>
        
        <!-- Dropzone css -->
        <link href="{{URL::asset('assets/admin')}}/assets/dropzone/dropzone.css" rel="stylesheet" type="text/css" />

        <!-- Plugins css-->
        <link href="{{URL::asset('assets/admin')}}/assets/tagsinput/jquery.tagsinput.css" rel="stylesheet" />
        <link href="{{URL::asset('assets/admin')}}/assets/toggles/toggles.css" rel="stylesheet" />
        <link href="{{URL::asset('assets/admin')}}/assets/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets/admin')}}/assets/timepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link href="{{URL::asset('assets/admin')}}/assets/colorpicker/colorpicker.css" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/admin')}}/assets/jquery-multi-select/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/admin')}}/assets/select2/select2.css" rel="stylesheet" type="text/css" />

        <!-- Custom Files -->
        <link href="{{URL::asset('assets/admin')}}/css/helper.css" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('assets/admin')}}/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{URL::asset('assets/admin')}}/js/modernizr.min.js"></script>
        
    </head>

    <body class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        {{-- <a href="{{url('admin')}}" class="logo"><span><img src="{{URL::asset('assets')}}/logo_abd2.png" style="height: 55px; width: 130px;"> </span></a> --}}
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <div class="pull-left">
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="md md-notifications"></i> <span class="badge badge-xs badge-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="text-center notifi-title">Notification</li>
                                        <li class="list-group">
                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-user-plus fa-2x text-info"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">New user registered</div>
                                                    <p class="m-0">
                                                       <small>You have 10 unread messages</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                           <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-diamond fa-2x text-primary"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">New settings</div>
                                                    <p class="m-0">
                                                       <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                            </a>
                                            <!-- list item-->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left">
                                                    <em class="fa fa-bell-o fa-2x text-danger"></em>
                                                 </div>
                                                 <div class="media-body clearfix">
                                                    <div class="media-heading">Updates</div>
                                                    <p class="m-0">
                                                       <small>There are
                                                          <span class="text-primary">2</span> new updates available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                            </a>
                                           <!-- last list item -->
                                            <a href="javascript:void(0);" class="list-group-item">
                                              <small>See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="md md-crop-free"></i></a>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="md md-chat"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="{{URL::asset('images/users/default.png')}}" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-toggle="modal" data-target="#ubah-pw"><i class="fa fa-lock"></i> Ubah Password</a></li>
                                        <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
         


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <div class="user-details">
                        <div class="pull-left">
                            <img src="{{URL::asset('images/users/default.png')}}" alt="" class="thumb-md img-circle">
                        </a>
                        </div>
                        <div class="user-info">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle">{{ Auth::user()->name }}</a>                                
                            </div>

                            <p class="text-muted m-0">Administrator</p>
                        </div>
                    </div>
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{ Route('dashboard') }}" class="waves-effect  {{{ (Request::is('admin') ? 'active' : '') }}}"><i class="md md-dashboard"></i> Dashboard</a>
                            </li>

                            <li>
                                <a href="{{ Route('cabang') }}" class="waves-effect  {{{ (Request::is('admin/cabang') ? 'active' : '') }}}"><i class="md md-home"></i> Cabang</a>
                            </li>

                            <li>
                                <a href="{{ Route('kendaraan') }}" class="waves-effect  {{{ (Request::is('admin/kendaraan') ? 'active' : '') }}}"><i class="fa fa-bicycle"></i> Kendaraan</a>
                            </li>

                            <li>
                                <a href="{{ Route('pelanggan') }}" class="waves-effect  {{{ (Request::is('admin/pelanggan') ? 'active' : '') }}}"><i class="fa fa-user"></i> Pelanggan</a>
                            </li>

                            <li>
                                <a href="{{ Route('transaksi') }}" class="waves-effect  {{{ ((Request::segment(2) == 'transaksi') ? 'active' : '') }}}"><i class="fa fa-cart-plus"></i> Transaksi</a>
                            </li>

                            <li>
                                <a href="{{ Route('users') }}" class="waves-effect  {{{ (Request::is('admin/users') ? 'active' : '') }}}"><i class="fa fa-users"></i> Users</a>
                            </li>

                             {{-- <li>
                                <a href="{{url('admin/gallery')}}" class="waves-effect  {{{ (Request::is('admin/gallery') ? 'active' : '') }}}"><i class="md md-image"></i><span> Gallery </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="#" class="waves-effect 
                                {{ ( ((Request::is('admin/web'))||(Request::is('admin/users'))||(Request::is('admin/account')) ) ? 'active' : '') }} ">

                                    <i class="md md-settings"></i><span> Setting </span><span class="pull-right"><i class="md   md-add"></i></span>
                                </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{url('admin/account')}}"><i class="md md-account-box"></i>Account</a></li>
                                    <li><a href="{{url('admin/users')}}"><i class="md md-account-child"></i>Users</a></li>
                                    <li><a href="{{url('admin/web')}}"><i class="md md-account-balance"></i>Web</a></li>
                                </ul>
                            </li> --}}

                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->
            
            {{-- MODAL UBAH PASSWORD --}}
            <div id="ubah-pw" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog"> 
                    <div class="modal-content"> 
                        <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                            <h4 class="modal-title">Ubah Password</h4> 
                        </div> 
                        
                        <form action="{{ Route('users.password') }}" method="post" enctype="multipart/form-data" id="modalform">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="row"> 
                                    <div class="col-md-12"> 
                                        <div class="form-group"> 
                                            <label for="field-7" class="control-label">Password Lama</label> 
                                            <input type="password" class="form-control" id="old_password" name="old_password" value="" required>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row"> 
                                    <div class="col-md-12"> 
                                        <div class="form-group"> 
                                            <label for="field-7" class="control-label">Password</label> 
                                            <input type="password" class="form-control" id="new_password" name="new_password" value="" required>
                                        </div> 
                                    </div> 
                                </div> 
                                <div class="row"> 
                                    <div class="col-md-12"> 
                                        <div class="form-group"> 
                                            <label for="field-7" class="control-label">Konfirmasi Password</label> 
                                            <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" value="" required>
                                        </div> 
                                    </div> 
                                </div> 
                            </div>
                            <div class="modal-footer"> 
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup <i class="fa fa-close"></i></button> 
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="ubahPassword()">Simpan <i class="fa fa-save"></i></button> 
                            </div> 
                        </form>
                    </div> 
                </div>
            </div><!-- /.modal -->

            @yield('content')

                <footer class="footer primary text-center">
                    <marquee><b>Copyright © 2021</b></marquee>
                </footer>

            </div>
        </div>
        <!-- END wrapper -->

        <script type="text/javascript">
            function ubahPassword()
            {
                if($("#old_password").val() == "")
                {
                    alert("Harap isi password lama");
                    return false;
                }

                if($("#new_password").val() == "")
                {
                    alert("Harap isi password baru");
                    return false;
                }

                if($("#new_password").val() != $("#confirm_new_password").val())
                {
                    alert("Konfirmasi password tidak sesuai!");
                    return false;
                }

                $.ajax(
                {
                    url: "{{ Route('users.password') }}",
                    type: 'POST',
                    data: 
                    {
                        old_password: $("#old_password").val(),
                        password: $("#new_password").val(),
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response)
                    {
                        if(response.status != "OK")
                        {
                            alert(response.pesan);
                            return false;
                        }
                        else
                        {
                            swal({
                                title: "Berhasil!",
                                text: "Password berhasil diubah!",
                                type: "success"
                            }, function() {
                                location.reload();
                            });
                        }
                    }
                });
                
                return false;
            }
        </script>
    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  --> 
        <script src="{{URL::asset('assets/admin')}}/js/jquery.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/js/bootstrap.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/js/waves.js"></script>
        <script src="{{URL::asset('assets/admin')}}/js/wow.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="{{URL::asset('assets/admin')}}/js/jquery.scrollTo.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/chat/moment-2.2.1.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/jquery-detectmobile/detect.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/fastclick/fastclick.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/jquery-blockui/jquery.blockUI.js"></script>

        <!-- sweet alerts -->
        <script src="{{URL::asset('assets/admin')}}/assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/sweet-alert/sweet-alert.init.js"></script>
        
        <!-- Page Specific JS Libraries -->
        <script src="{{URL::asset('assets/admin')}}/assets/dropzone/dropzone.min.js"></script>

        <!-- Examples -->
        <script src="{{URL::asset('assets/admin')}}/assets/magnific-popup/magnific-popup.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/jquery-datatables-editable/jquery.dataTables.js"></script> 
        <script src="{{URL::asset('assets/admin')}}/assets/datatables/dataTables.bootstrap.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/jquery-datatables-editable/datatables.editable.init.js"></script>

        <!-- flot Chart -->
        <script src="{{URL::asset('assets/admin')}}/assets/flot-chart/jquery.flot.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/flot-chart/jquery.flot.time.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/flot-chart/jquery.flot.resize.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/flot-chart/jquery.flot.pie.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/flot-chart/jquery.flot.selection.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/flot-chart/jquery.flot.stack.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/flot-chart/jquery.flot.crosshair.js"></script>

        <!-- Counter-up -->
        <script src="{{URL::asset('assets/admin')}}/assets/counterup/waypoints.min.js" type="text/javascript"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        
        <!-- CUSTOM JS -->
        <script src="{{URL::asset('assets/admin')}}/js/jquery.app.js"></script>

        <!-- Dashboard -->
        <script src="{{URL::asset('assets/admin')}}/js/jquery.dashboard.js"></script>

        <!-- Chat -->
        <script src="{{URL::asset('assets/admin')}}/js/jquery.chat.js"></script>

        <!-- Todo -->
        <script src="{{URL::asset('assets/admin')}}/js/jquery.todo.js"></script>

         <!--Data Table -->
        <script src="{{URL::asset('assets/admin')}}/assets/datatables/jquery.dataTables.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/datatables/dataTables.bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
        </script>

        <script src="{{URL::asset('assets/admin')}}/assets/tagsinput/jquery.tagsinput.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/toggles/toggles.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/timepicker/bootstrap-timepicker.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/timepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets/admin')}}/assets/colorpicker/bootstrap-colorpicker.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets/admin')}}/assets/jquery-multi-select/jquery.multi-select.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets/admin')}}/assets/jquery-multi-select/jquery.quicksearch.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{URL::asset('assets/admin')}}/assets/spinner/spinner.min.js"></script>
        <script src="{{URL::asset('assets/admin')}}/assets/select2/select2.min.js" type="text/javascript"></script>


        <script>
            jQuery(document).ready(function() {
                    
                // Tags Input
                jQuery('.tags').tagsInput({width:'auto'});

                // Form Toggles
                jQuery('.toggle').toggles({on: true});

                // Time Picker
                jQuery('#timepicker').timepicker({defaultTIme: false});
                jQuery('#timepicker2').timepicker({showMeridian: false});
                jQuery('#timepicker3').timepicker({minuteStep: 15});

                // Date Picker
                jQuery('#datepicker').datepicker();
                jQuery('#datepicker-inline').datepicker();
                jQuery('#datepicker-multiple').datepicker({
                    numberOfMonths: 3,
                    showButtonPanel: true
                });
                //colorpicker start

                $('.colorpicker-default').colorpicker({
                    format: 'hex'
                });
                $('.colorpicker-rgba').colorpicker();


                //multiselect start

                $('#my_multi_select1').multiSelect();
                $('#my_multi_select2').multiSelect({
                    selectableOptgroup: true
                });

                $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });

                //spinner start
                $('#spinner1').spinner();
                $('#spinner2').spinner({disabled: true});
                $('#spinner3').spinner({value:0, min: 0, max: 10});
                $('#spinner4').spinner({value:0, step: 5, min: 0, max: 200});
                //spinner end

                // Select2
                jQuery(".select2").select2({
                    width: '100%'
                });
            });
        </script>

        <script type="text/javascript">
            /* ==============================================
            Counter Up
            =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>

         <script type="text/javascript" src="{{URL::asset('assets/admin')}}/assets/gallery/isotope.js"></script>
        <script type="text/javascript" src="{{URL::asset('assets/admin')}}/assets/magnific-popup/magnific-popup.js"></script> 
          
        <script type="text/javascript">
            $(window).load(function(){
                var $container = $('.portfolioContainer');
                $container.isotope({
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });

                $('.portfolioFilter a').click(function(){
                    $('.portfolioFilter .current').removeClass('current');
                    $(this).addClass('current');

                    var selector = $(this).attr('data-filter');
                    $container.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'linear',
                            queue: false
                        }
                    });
                    return false;
                }); 
            });
            $(document).ready(function() {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    mainClass: 'mfp-fade',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
            });
        </script>

        @if(Session::has('alert_swal'))
            <script type="text/javascript">{!! session('alert_swal') !!}</script>
        @endif
    

    </body>
</html>