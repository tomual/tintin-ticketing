<?php $this->load->view('header') ?>

<div class="col-sm-12">
    <h1>System Settings</h1>
    <form method="post" action="<?php echo base_url() ?>/settings/edit/">
        <div class="form-group">
            <label for="">Custom Styling (CSS)</label>
            <textarea class="form-control" name="css" rows="10"><?php echo $settings->css ?></textarea>
        </div>

        <div class="form-group <?php if(form_error('start_status')) echo 'has-danger' ?>">
            <label for="start_status">Ticket Status on Creation</label>
            <select class="form-control" id="start_status" name="start_status">
                <?php foreach($statuses as $status): ?>
                    <option value="<?php echo $status->sid ?>" <?php if($settings->start_status == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted">When a ticket is created, it is given this status</small>
            <?php echo form_error('start_status') ?>
        </div>

        <div class="form-group <?php if(form_error('work_start_status')) echo 'has-danger' ?>">
            <label for="work_start_status">Ticket Start Status</label>
            <select class="form-control" id="work_start_status" name="work_start_status">
                <?php foreach($statuses as $status): ?>
                    <option value="<?php echo $status->sid ?>" <?php if($settings->work_start_status == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted">Status that indicates the ticket is being worked on</small>
            <?php echo form_error('work_start_status') ?>
        </div>

        <div class="form-group <?php if(form_error('work_complete_status')) echo 'has-danger' ?>">
            <label for="work_complete_status">Ticket Complete Status</label>
            <select class="form-control" id="work_complete_status" name="work_complete_status">
                <?php foreach($statuses as $status): ?>
                    <option value="<?php echo $status->sid ?>" <?php if($settings->work_complete_status == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted">Status that indicates the ticket has been completed</small>
            <?php echo form_error('work_complete_status') ?>
        </div>

        <div class="form-group <?php if(form_error('next_up_statuses')) echo 'has-danger' ?>">
            <label for="next_up_statuses">Home Page "Next Up ..." Statuses</label>
            <select name="next_up_statuses[]" id="next_up_statuses" multiple="multiple" class="form-control">
                <?php foreach($statuses as $status): ?>
                    <option value="<?php echo $status->sid ?>" <?php if(in_array($status->sid, $next_up_statuses)) echo 'selected' ?>><?php echo $status->label ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted">Statuses to mean the ticket is to be worked on</small>
            <?php echo form_error('next_up_statuses') ?>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<?php $this->load->view('footer') ?>