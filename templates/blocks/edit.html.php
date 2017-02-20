<form role="form" action="/tasks/edit" method="post" >
    <input type="text" name="id" value="<?= $oneTask['id'] ?>" hidden>
    <div class="form-group">
        <label for="text-task">Task</label>
        <textarea class="form-control" name="text" id="text-task" rows="3" placeholder="Text"><?= $oneTask['text'] ?></textarea>
    </div>

    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" name="is-end" class="form-check-input" value="1">
            Complete
        </label>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>