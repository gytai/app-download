<?php
    $this->context->layout = false;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>App List</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
</head>
<body>
<div class="page-group app-list-box">
    <div class="page page-current">
        <header class="bar bar-nav">
            <h1 class="title">App List</h1>
        </header>
        <div class="content">
            <!-- 你的html代码 -->
            <div class="card demo-card-header-pic" v-for="(item,index) in appList" :key="index">
                <div valign="bottom" class="card-header color-white no-border no-padding">
                    <img class='card-cover' :src="item.image" alt="">
                </div>
                <div class="card-content">
                    <div class="card-content-inner">
                        <p>{{ item.name }}</p>
                        <p class="color-gray">{{ item.created_at }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <span class="link">{{ item.version }}</span>
                    <a :href="item.link" class="link">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script>
    $.init();
    new Vue({
        el: '.app-list-box',
        data: {
            appList:[]
        },
        methods: {
            getList() {
                var _self = this;
                $.get('/index.php?r=apps/list',function (response) {
                    if (response.code == 200) {
                        _self.appList = response.data.apps;
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },

        mounted(){
            this.getList();
        }
    })
</script>
</body>
</html>