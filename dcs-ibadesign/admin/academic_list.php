<?php include '../db/config.php' ?>
<div class="col-md-12">
    <form action="" id="manage-academic">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" class="form-control" name="year" value="<?php echo isset($year) ? $year : '' ?>">
        </div>
        <div class="form-group">
            <label for="semester">Semester</label>
            <input type="text" class="form-control" name="semester" value="<?php echo isset($semester) ? $semester : '' ?>">
        </div>
        <div class="form-group">
            <label for="is_default">System Default</label>
            <select class="form-control" name="is_default">
                <option value="0" <?php echo isset($is_default) && $is_default == 0 ? 'selected' : '' ?>>No</option>
                <option value="1" <?php echo isset($is_default) && $is_default == 1 ? 'selected' : '' ?>>Yes</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Evaluation Status</label>
            <select class="form-control" name="status">
                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Not yet Started</option>
                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Starting</option>
                <option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Closed</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Save</button>
        </div>
    </form>
</div>
<script>
    $('#manage-academic').submit(function (e) {
        e.preventDefault()
        start_load()
        $.ajax({
            url: 'ajax.php?action=save_academic',
            method: 'POST',
            data: $(this).serialize(),
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully saved", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)
                }
            }
        })
    })
</script>
