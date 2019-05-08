<div id="site-index">
    <div class="panel panel-default" style="margin-top: 20px;">
        <div class="panel-heading">Option Panel</div>
        <div class="panel-body" style="display: flex;flex-direction: row;">
            <div class="input-group" style="width: 400px;">
                <span class="input-group-addon" id="basic-addon1">keyword</span>
                <input type="text" class="form-control" v-model="keyword" placeholder="app name" aria-describedby="basic-addon1">
            </div>
            <button type="button" class="btn btn-primary" style="margin-left: 20px;" @click="search">Search</button>
            <button type="button" class="btn btn-primary" style="margin-left: 20px;" @click="toAddPage">Create</button>
        </div>
    </div>
    <div class="table-responsive" style="background: white;">
        <table id="dataTable" class="table table-bordered">
            <thead>
            <tr>
                <td>No</td>
                <td>Name</td>
                <td>Image</td>
                <td>Version</td>
                <td>Link</td>
                <td>Created Time</td>
                <td>Option</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item,index) in appList" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.image }}</td>
                <td>{{ item.version }}</td>
                <td>{{ item.link }}</td>
                <td>{{ item.created_at }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" @click="appDelete(item.id,index)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="javascript:;" aria-label="Previous" @click="pagination(-1,true)">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li v-for="item in pages">
                <a href="javascript:;" @click="pagination(item)">{{ item }}</a>
            </li>
            <li>
                <a href="javascript:;" aria-label="Next" @click="pagination(-1,false,true)">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<script>
    new Vue({
        el: '#site-index',
        data: {
            keyword: '',
            page: 1,
            size: 10,
            total:0,
            pages:[],
            appList:[]
        },
        methods:{

            toAddPage(){
                location.href = '/index.php?r=site/app-create';
            },

            search(){
                this.page = 1;
                this.getList(this.page);
            },

            pagination(page,left,right){
                if(page != -1){
                    this.getList(page);
                }

                if(left){
                    page = this.page -1 > 0?this.page -1:0;
                    this.getList(page);
                }

                if(right){
                    page = this.page + 1 > this.pages.length? this.pages.length:this.page + 1;
                    this.getList(page);
                }
            },

            getList(page){
                var _self = this;
                $.get('/index.php?r=apps/list', {
                    keyword: _self.keyword,
                    page: page,
                    size: _self.size
                }).then(function (response) {
                    if(response.code == 200){
                        _self.appList = response.data.apps;
                        _self.total = response.data.total;

                        var p = Math.ceil(_self.total / _self.size);
                        _self.pages = [];
                        for(var i=0;i<p;i++){
                            _self.pages.push(i + 1);
                        }
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            },

            appDelete(uid,index){
                var _self = this;
                layer.confirm('confirm delete？', {
                    title:'Tip',
                    btn: ['Yes']
                }, function(){
                    $.post('/index.php?r=apps/delete', {
                        uid:uid
                    }).then(function (response) {
                        console.log(response);
                        if(response.code == 200){
                            _self.appList.splice(index,1);
                            layer.msg('Success');
                        }else{
                            layer.msg('Fail');
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                });
            }
        },
        mounted(){
            this.getList();
            localStorage.setItem('domId','appMenu');
        }
    })
</script>