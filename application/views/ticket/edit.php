<?php $this->load->view('header') ?>

<div class="col-sm-12">
    <h1>Edit Ticket</h1>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error') ?>
        </div>
    <?php endif ?>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="tid" value="<?php echo $ticket->tid ?>">
        <div class="form-group <?php if(form_error('title')) echo 'has-danger' ?>">
            <label for="">Ticket Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Ticket title" value="<?php echo $ticket->title ?>">
            <?php echo form_error('title') ?>
        </div>
        <div class="form-group <?php if(form_error('description')) echo 'has-danger' ?>">
            <label for="">Ticket Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $ticket->description ?></textarea>
            <?php echo form_error('description') ?>
        </div>
        <div class="form-group <?php if(form_error('category')) echo 'has-danger' ?>">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category->cid ?>" <?php if($ticket->cid == $category->cid) echo 'selected' ?>><?php echo $category->name ?></option>
                <?php endforeach ?>
            </select>
            <?php echo form_error('category') ?>
        </div>
        <div class="form-group <?php if(form_error('status')) echo 'has-danger' ?>">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <?php foreach($statuses as $status): ?>
                    <option value="<?php echo $status->sid ?>" <?php if($ticket->sid == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
                <?php endforeach ?>
            </select>
            <?php echo form_error('status') ?>
        </div>

        <div class="form-group <?php if(form_error('attachments')) echo 'has-danger' ?>">
            <label for="attachments">Attachments</label>
            <input name="attachments[]" id="attachments" type="file" class="form-control" multiple="" />
            <?php echo form_error('attachments') ?>
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
        <a href="<?php echo base_url() ?>ticket/view/<?php echo $ticket->tid ?>" class="btn btn-default">Back</a>
    </form>

    <?php if(!empty($attachments)): ?>
        <h2>Ticket Attachments</h2>
        <div class="row attachments">
            <?php foreach($attachments as $attachment): ?>
                <?php if(!empty($attachment->title)): ?>
                        <div class="col-md-2">
                            <a href="<?php echo base_url("attachment/view/{$attachment->aid}") ?>">
                                <?php if($attachment->is_image == 'Y'): ?>
                                    <div class="attachment-mini" style="background-image:url('<?php echo base_url("attachments/{$attachment->filename}") ?>')"></div>
                                <?php else: ?>
                                    <div class="attachment-mini"><i class="fa fa-file-o" aria-hidden="true"></i></div>
                                <?php endif ?>
                            </a>
                        </div>
                        <div class="col-md-10 attachment-info">
                            <div class="attachment-title"><a href="<?php echo base_url("attachment/view/{$attachment->aid}") ?>" target="_blank"><?php echo $attachment->title ?></a></div>
                            <form method="post" action="<?php echo base_url() ?>/attachment/remove/<?php echo $attachment->tid ?>/<?php echo $attachment->aid ?>">
                                <button type="submit" class="btn-link" onclick="return confirm('Are you sure you want to delete this attachment?')"><i class="fa fa-times" aria-hidden="true"></i> Remove</button>
                            </form>
                        </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>

<?php $this->load->view('footer') ?>