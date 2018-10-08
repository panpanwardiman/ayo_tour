<div class="content-wrapper">
    <section class="content-header">
        <h1>New Packages</h1>
    </section>
    <section class="content">
        <?php if ($this->session->userdata('message') !== NULL ): ?>
            <?php echo $this->session->userdata('message') ?>
        <?php endif ?>
        <div class="row">
            <div class="col-xs-12">
                <?php echo form_open_multipart('', 'id="formSubmit"') ?>
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#packages" data-toggle="tab">Packages</a></li>
                        <li><a href="#inclutions_exclutions" data-toggle="tab">Inclutions & Exclutions</a></li>
                        <li><a href="#itinerary" data-toggle="tab">Itinerary</a></li>
                        <li><a href="#gallery" data-toggle="tab">Gallery</a></li>
                        <div style="float: right; margin-top:5px; margin-right:5px;">
                            <button type="submit" form="formSubmit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                            <a href="<?php echo site_url('at-admin/package') ?>">
                                <span class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> Back to list</span>
                            </a>
                        </div>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="packages">
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="package_name">Package Name</label>
                                        <input type="text" name="package_name" id="package_name" class="form-control" value="<?php echo set_value('package_name') ?>">
                                        <?php echo form_error('package_name', '<div class="help-block">', '</div>') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="package_name">Content</label>
                                        <textarea id="editor1" name="content" rows="10" cols="80" value="<?php echo set_value('package_name') ?>"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-4">
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
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="trip_duration_days">Trip Duration Days</label>
                                                <input type="text" name="trip_duration_days" id="trip_duration_days" class="form-control" value="<?php echo set_value('trip_duration_days') ?>">
                                                <?php echo form_error('trip_duration_days', '<div class="help-block">', '</div>') ?>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="trip_duration_nights">Trip Duration Nights</label>
                                                <input type="text" name="trip_duration_nights" id="trip_duration_nights" class="form-control" value="<?php echo set_value('trip_duration_nights') ?>">
                                                <?php echo form_error('trip_duration_nights', '<div class="help-block">', '</div>') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="inclutions_exclutions">
                            <div class="form-group">
                                <label for="inclutions">Inclutions</label>
                                <textarea name="inclutions" id="inclutions" class="form-control" cols="30" rows="4"></textarea>
                                <div class="help-block">
                                    Note: Gunakan tanda ( | ) yang ada di dalam kurung sebagai pemisah. ex: paket tidak termasuk tiket pulang pergi | transportasi full AC
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exclutions">Exclutions</label>
                                <textarea name="exclutions" id="exclutions" class="form-control" cols="30" rows="4"></textarea>
                            </div>
                            <div class="help-block">
                                Note: Gunakan tanda ( | ) yang ada di dalam kurung sebagai pemisah. ex: paket tidak termasuk tiket pulang pergi | transportasi full AC
                            </div>
                        </div>
                        <div class="tab-pane" id="itinerary">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box box-default box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Days - 1</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="itinerary_title">Itinerary Title</label>
                                                <input type="text" name="itinerar_title" class="form-control" value="<?php echo set_value('itinerary_title') ?>">
                                                <?php echo form_error('itinerary_title', '<div class="help-block">', '</div>') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="itinerary_content">Itinerary Content</label>
                                                <textarea name="itinerary_content[]" id="itinerary_content" class="form-control" cols="30" rows="4"></textarea>
                                                <?php echo form_error('itinerary_content', '<div class="help-block">', '</div>') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-primary">Add Itinerary</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="gallery">
                            <div class="form-group">
                                <label for="image"></label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
</div>