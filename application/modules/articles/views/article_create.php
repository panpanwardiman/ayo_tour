<div class="content-wrapper">
    <section class="content-header">
        <h1>New Articles</h1>
    </section>
    <section class="content">
        <?php if ($this->session->userdata('message') !== NULL ): ?>
            <?php echo $this->session->userdata('message') ?>
        <?php endif ?>
        <?php echo form_open_multipart('at-admin/article/store') ?>
            <div class="row">
                <div class="col-xs-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            Title
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="<?php echo set_value('title') ?>" placeholder="Title">
                                <?php echo form_error('title', '<div class="help-block">', '</div>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            Post
                        </div>
                        <div class="box-body pad">
                            <textarea id="editor1" name="content" rows="10" cols="80"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div style="float: right;">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                                <a href="<?php echo site_url('at-admin/article') ?>">
                                    <span class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> Back to list</span>
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control select2" name="category_id" id="category_id" style="width: 100%">
                                    <option value=""></option>
                                <?php foreach ($categories->result() as $category): ?>
                                    <option value="<?php echo $category->id ?>"><?php echo ucwords($category->name) ?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tag">Tag</label>
                                <select class="form-control select2" name="tag[]" id="tag" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                <?php foreach ($tags->result() as $tag): ?>
                                    <option value="<?php echo $tag->slug ?>"><?php echo ucwords($tag->name) ?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="published" selected>Published</option>
                                    <option value="not published">Not Published</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image">
                                <div class="help-block">
                                    <i>Format Image should be JPG|JPEG|PNG</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>