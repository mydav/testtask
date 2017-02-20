<?php if (isset($error)): ?>
    <p class="bg-danger"><?= $error?></p>
<?php endif ?>

<form role="form" action="/user/login" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Logi</label>
        <input type="text" name="login" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Пароль</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>