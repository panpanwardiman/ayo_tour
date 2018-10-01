<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Articles</h1>
    </section>
    <section class="content">
        <?php echo form_open_multipart('at-admin/article/update/'.$article->id) ?>
            <div class="row">
                <div class="col-xs-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            Title
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" value="<?php echo set_value('title', $article->title) ?>" placeholder="Title">
                                <?php echo form_error('title', '<div class="help-block">', '</div>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            Post
                        </div>
                        <div class="box-body pad">
                            <textarea id="editor1" name="content" rows="10" cols="80">
                                <?php echo $article->content ?>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div style="float: right;">
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Update</button>
                                <a href="<?php echo site_url('at-admin/article') ?>">
                                    <span class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> Back to list</span>
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control select2" name="category_id">
                                <?php foreach ($categories->result() as $category): ?>
                                    <option value="<?php echo $category->id ?>"
                                    <?php 
                                        if ($article->category_id === $category->id) {
                                            echo "selected";
                                        } else {
                                            echo "";
                                        }
                                    ?>                                  
                                    ><?php echo ucwords($category->name) ?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tag">Tag</label>
                                <select class="form-control select2" name="tag[]" id="tag" multiple="multiple" data-placeholder="Select a State"
                                        style="width: 100%;">
                                <?php foreach ($tags->result() as $tag): ?> 
                                        <option value="<?php echo $tag->slug ?>"
                                        <?php 
                                            $article_tag = explode(',', $article->tag);
                                            foreach ($article_tag as $key => $value) {
                                                if ($tag->slug === $article_tag[$key]) {
                                                    echo "selected";
                                                } else {
                                                    echo "";
                                                }
                                            }
                                        ?>
                                        ><?php echo ucwords($tag->name) ?></option>
                                <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value=""></option>
                                    <option value="published"
                                    <?php
                                        if ($article->status === 'published') {
                                            echo "selected";
                                        }
                                    ?>
                                    >Published</option>
                                    <option value="not published"
                                    <?php
                                        if ($article->status === 'not published') {
                                            echo "selected";
                                        }
                                    ?>
                                    >Not Published</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" name="image">
                                <div class="help-block">
                                    Format Image should be JPG|JPEG|PNG
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                        <h3 class="box-title">Tags</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        </div>
                        <!-- <div class="box-body" style="display:block; width:100%; height:150px; overflow:auto;"> -->
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

