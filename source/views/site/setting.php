<div id="setting-index" style="width: 500px;margin-left: 10px;">
    <div >
        <div class="form-group">
            <label for="name" >Old Password</label>
            <input type="text" class="form-control" v-model="oldPassword">
        </div>
        <div class="form-group">
            <label for="name" >New Password</label>
            <input type="text" class="form-control" v-model="newPassword">
        </div>
        <div class="form-group">
            <label for="name" >New Password Confirm</label>
            <input type="text" class="form-control"  v-model="newPasswordConfirm">
        </div>

        <button class="btn btn-default" @click="reset">Submit</button>
    </div>
</div>

<script>
    new Vue({
        el: '#setting-index',
        data: {
            oldPassword: '',
            newPassword: '',
            newPasswordConfirm: ''
        },
        methods:{
            reset(){
                if(!this.oldPassword){
                    layer.msg('please input old password', {icon: 1});
                    return;
                }

                if(!this.newPassword){
                    layer.msg('please input new password', {icon: 1});
                    return;
                }

                if(this.newPassword != this.newPasswordConfirm){
                    layer.msg('two passwords are inconsistent', {icon: 1});
                    return;
                }

                $.post('/index.php?r=site/reset-password', {
                    oldPassword: this.oldPassword,
                    newPassword: this.newPassword
                }).then(function (response) {
                    if(response.code == 200){
                        layer.msg('reset success', {icon: 1});
                    }else{
                        layer.msg('reset fail', {icon: 5});
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }
    })
</script>