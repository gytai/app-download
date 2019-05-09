<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/layer/layer.js"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b>App</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
            <div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="User Name" v-model="account">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" v-model="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <button @click="login" class="btn btn-primary btn-block btn-flat" style="width:150px;margin: 0 auto;">Sign In</button>
                </div>
            </div>


        </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script>
    new Vue({
        el: '.login-box',
        data: {
            account: '',
            password: ''
        },
        methods:{
            login(){
                $.post('/index.php?r=site/login', {
                    account: this.account,
                    password: this.password
                }).then(function (response) {

                    if(response.code == 200){
                        layer.msg('login success', {icon: 1});
                        setTimeout(function () {
                            location.href = '/index.php?r=site/apps';
                        },1000);
                    }else{
                        layer.msg('account or password is invalid', {icon: 5});
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }
    })
</script>
</body>
</html>
