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

                    <li>
                        <a href="#">
                            <span class="light-green">Login</span> 
                            &nbsp;
                            <i class="fa fa-user bigger-110 light-green"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- /.navbar-container -->
</div>