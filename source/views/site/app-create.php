<div style="width: 500px;margin-left: 10px;">
    <form action="/index.php?r=apps/create" method="post" enctype="multipart/form-data" onsubmit="return checkForm()">
        <div class="form-group">
            <label for="name" >Name</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="version">Version</label>
            <input type="text" class="form-control" name="version" id="version">
        </div>
        <div class="form-group">
            <label for="icon" >App Image</label>
            <input type="file" name="icon" id="icon" accept="image/gif,image/jpeg,image/jpg,image/png">
        </div>
        <div class="form-group">
            <label for="app">App File</label>
            <input type="file" name="app" id="app" accept=".apk">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>

<script>
    function checkForm() {
        var name = $("#name").val();
        if(!name){
            layer.msg('please input name');
            return false;
        }

        var version = $("#version").val();
        if(!version){
            layer.msg('please input version');
            return false;
        }

        var icon = $("#icon").val();
        if(!icon){
            layer.msg('please select icon file');
            return false;
        }

        var app = $("#app").val();
        if(!app){
            layer.msg('please select app file');
            return false;
        }

    }
</script>