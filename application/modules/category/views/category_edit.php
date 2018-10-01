<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Category</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div style="float: right;">
                            <button type="submit" form="formSubmit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Update</button>
                            <a href="<?php echo site_url('at-admin/category') ?>">
                                <span class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> Back to list</span>
                            </a>
                        </div>
                    </div>
                    <?php echo form_open_multipart('at-admin/category/update/'.$category->id, 'id="formSubmit"') ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name', $category->name) ?>" placeholder="First Name">
                                <?php echo form_error('name', '<div class="help-block">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <?php echo form_error('image', '<div class="help-block">', '</div>') ?>
                                <input type="hidden" name="active_image" value="<?php echo $category->category_image ?>">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="<?php echo set_value('slug', $category->slug) ?>" placeholder="Last Name">
                                <i class="help-block">
                                    The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.<br>
                                    example: wonderful-indonesia
                                </i>
                                <?php echo form_error('slug', '<div class="help-block">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value=""></option>
                                    <option value="published"
                                    <?php
                                        if ($category->status == 'published') {
                                            echo "selected";
                                        }
                                    ?>
                                    >Published</option>
                                    <option value="not published"
                                    <?php
                                        if ($category->status == 'not published') {
                                            echo "selected";
                                        }
                                    ?>
                                    >Not Published</option>
                                </select>
                                <?php echo form_error('status', '<div class="help-block">', '</div>') ?>
                            </div>
                        </div>
                        <div class="box-footer">
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>