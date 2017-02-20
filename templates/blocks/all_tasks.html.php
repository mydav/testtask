
<?php if(isset($success)): ?>
  <div class="container">
    <p class=""><?= $success ?></p>
  </div>

<?php endif ?>
<br>
<div class="container">
  <form action="/tasks/all" method="post" >
      <label class="radio-inline">
          <input type="radio" name="sort" id="inlineCheckbox1" value="user_name asc"> User name
      </label>
      <label class="radio-inline">
          <input type="radio" name="sort" id="inlineCheckbox2" value="email asc"> Email
      </label>
      <label class="radio-inline">
          <input type="radio" name="sort" id="inlineCheckbox3" value="status desc"> Status
      </label>
      <div class="radio-inline">
          <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Sort</button>
          </div>
      </div>
  </form>

<div class="row">

    <br>
    <?php foreach($allTask as $task): ?>

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="col-md-3">
                        <a href="#" class="thumbnail"><img src="<?= $task['img'] ?>" alt=""></a>
                    </div>
                    <p><?= $task['text'] ?></p>

                </div>
                <div class="panel-footer">
                    <span class="glyphicon glyphicon-user" id="start"></span> <label id="started">By</label> <a href="#" id="startedby"><?= $task['user_name'] ?></a> |
                    <span class="glyphicon glyphicon glyphicon-time" id="visit"></span> <a href="#" id="visited"><?= $task['created_at'] ?></a> |
                    <?php if(!empty($task['status'])): ?><span style="color: rgba(16,104,67,0.61);">Complete</span><?php endif ?>

                    <?php if ( isset($_SESSION['admin']) ): ?>
                        <a class="btn btn-blog pull-right marginBottom10" href="/tasks/edit/<?= $task['id'] ?>"><span class="label label-info">Edit</span></a>
                        <a class="btn btn-blog pull-right marginBottom10" href="/tasks/delete/<?= $task['id'] ?>"><span class="label label-info">Delete</span></a><br>
                    <?php endif ?>

                </div>
            </div>
        </div>

    <?php endforeach ?>
</div>
</div>
