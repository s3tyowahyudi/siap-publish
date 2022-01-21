<div id="navbar" class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-container" id="navbar-container">
        <button data-target="#menu" data-toggle="collapse" type="button" class="pull-right navbar-toggle collapsed">
            <span class="sr-only">Toggle menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header navbar-left">
            <a href="{{ url('/') }}" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    <span class="light-green">SIAP</span> KAB. PAMEKASAN
                </small>
            </a>
        </div>

        <div class="navbar-header navbar-right" role="navigation">
            <div id="menu" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right" role="tablist">
                    <li>
                        <a href="{{ url('/') }}">Beranda</a>
                    </li>
    
                    <li class="sep visible-md visible-lg">
                        <i class="ace-icon fa fa-circle white"></i>
                    </li>
    
                    <li>
                        <a href="webgis">Web GIS</a>
                    </li>
    
                    <li class="sep visible-md visible-lg">
                        <i class="ace-icon fa fa-circle white"></i>
                    </li>
                    
                    <li>
                        <a href="dokumen">Dokumen</a>
                    </li>

                    <li class="sep visible-md visible-lg">
                        <i class="ace-icon fa fa-circle white"></i>
                    </li>

                    <li>
                        <a href="http://202.157.187.108/manualBook/siap/mobile/index.html" target="_blank">Manual Book</a>
                    </li>
    
                    <li class="sep visible-md visible-lg">
                        <i class="ace-icon fa fa-circle white"></i>
                    </li>

                    @if (Auth::check())
                        <li class="light-blue dropdown-modal">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                {{-- <img class="nav-user-photo" src="assets/ace/images/avatars/user.jpg" alt="Jason's Photo" /> --}}
                                <span class="user-info">
                                    {{ Auth::user()->nama }}
                                </span>
    
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
    
                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="{{ url('settingUser')  }}">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Settings
                                    </a>
                                </li>
                                @if (Auth::user()->level=="Administrator")
                                    <li>
                                        <a href="{{ url('penggunaBaru')  }}">
                                            <i class="ace-icon fa fa-user"></i>
                                            Add User
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('dataUser')  }}">
                                            <i class="ace-icon fa fa-users"></i>
                                            Data User
                                        </a>
                                    </li>
                                @endif
    
                                <li class="divider"></li>
    
                                <li>
                                    <a href="keluar">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="login">
                                {{-- <i class="ace-icon fa fa-envelope"></i> --}}
                                {{-- <i class="ace-icon fa fa-key"></i> --}}
                                Login
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div><!-- /.navbar-container -->
</div>