<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminApp | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" >

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/js/jquery-3.4.1.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="/js/bootstrap.min.js" ></script>
    <script src="/dist/js/AdminLTE.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="/layer/layer.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>PP</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>App</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class=" user user-menu">
                        <a href="#" class="dropdown-toggle">
                            <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= $this->params['account'];   ?></span>
                        </a>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="/index.php?r=site/logout" class="dropdown-toggle">
                            <span class="hidden-xs">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?= $this->params['account'];   ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">NAVIGATION</li>
                <li id="appMenu" class="tree-menu active" @click="clickMenu('appMenu')"><a href="/index.php?r=site"><i class="fa fa-circle-o"></i>App Manage</a></li>
                <li id="settingMenu" class="tree-menu" @click="clickMenu('settingMenu')"><a href="/index.php?r=site/setting"><i class="fa fa-circle-o"></i>Setting</a></li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb" >
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><?= $this->params['module'] ?></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" style="padding-top: 30px;">
            <?= $content ?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2019  All rights
            reserved.
    </footer>

</div>
</body>
<script>
    new Vue({
        el: '.sidebar-menu',
        data: {
            account: "<?= $this->params['account'] ?>"
        },

        methods:{
            clickMenu(dom){
                localStorage.setItem('domId',dom);
            }
        },

        mounted(){
            var domId = localStorage.getItem('domId')?localStorage.getItem('domId'):'userMenu';
            $('.tree-menu').removeClass('active');
            $('#'+ domId).addClass('active');
        }
    })
</script>
</html>