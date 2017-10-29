<?php $this->load->view('header') ?>
<div class="col-sm-12 ticket">
    <h2>Ticket ID: <?php echo $ticket->tid ?></h2>

    <a href="<?php echo base_url() ?>ticket/edit/<?php echo $ticket->tid ?>" class="btn btn-default pull-right edit">Edit</a>

    <?php if(!$ticket->subscribed): ?>
        <form method="post" class="notifications-form" action="<?php echo base_url() ?>/notification/subscribe/<?php echo $ticket->tid ?>">
            <button type="submit" class="btn btn-link pull-right edit"><i class="fa fa-bell-o" aria-hidden="true"></i></button>
        </form>
    <?php else: ?>
        <form method="post" class="notifications-form" action="<?php echo base_url() ?>/notification/unsubscribe/<?php echo $ticket->tid ?>">
            <button type="submit" class="btn btn-link pull-right edit"><i class="fa fa-bell-slash-o" aria-hidden="true"></i></button>
        </form>
    <?php endif ?>

    <h1><?php echo $ticket->title ?></h1>

    <table class="table">
        <tr>
            <th width="100">Created</th>
            <td><?php echo date('d/m/Y h:mA', strtotime($ticket->created)) ?></td>
        </tr>
        <tr>
            <th width="100">Modified</th>
            <?php if(isset($versions[0])): ?>
                <td><?php echo date('d/m/Y h:mA', strtotime($versions[0]->created)) ?></td>
            <?php else: ?>
                <td><?php echo date('d/m/Y h:mA', strtotime($ticket->created)) ?></td>
            <?php endif ?>
        </tr>
        <tr>
            <th>Author</th>
            <td><?php echo $ticket->author ?></td>
        </tr>
        <tr>
            <th>Worker</th>
            <td><?php echo $ticket->worker ? $ticket->worker : '<i class="text-muted">-</i>' ?></td>
        </tr>
        <tr>
            <th>Category</th>
            <td><?php echo $ticket->category ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo $ticket->status ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <b>Description</b><br /><br />
                <div class="description"><?php echo $ticket->description ?></div>
                
            </td>
        </tr>
    </table>
    <br />

    <?php if(!empty($attachments)): ?>
        <h2>Attachments</h2>
        <div class="row attachments">
            <?php foreach($attachments as $attachment): ?>
                <?php if(!empty($attachment->title)): ?>
                        <div class="col-md-3">
                            <a href="<?php echo base_url("attachment/view/{$attachment->aid}") ?>">
                                <?php if($attachment->is_image == 'Y'): ?>
                                    <div class="attachment-preview" style="background-image:url('<?php echo base_url("/attachments/{$attachment->filename}") ?>')"></div>
                                <?php else: ?>
                                    <div class="attachment-preview"><i class="fa fa-file-o" aria-hidden="true"></i></div>
                                <?php endif ?>
                            </a>
                        </div>
                        <div class="col-md-3 attachment-info">
                            <a href="<?php echo base_url("attachment/view/{$attachment->aid}") ?>">
                                <div class="attachment-title"><?php echo $attachment->title ?></div>
                                <div class="attachment-description"><?php echo $attachment->description ? $attachment->description : 'No description' ?></div>
                            </a>
                        </div>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>

    <div class="update">
        <h2>Update</h2>

        <?php if($this->session->has_userdata('username')): ?>
        <form method="post">
            <input type="hidden" name="tid" value="<?php echo $ticket->tid ?>">
            <div class="form-check">
                <fieldset>
                  <div class="switch-toggle alert alert-light">
                        <?php foreach($statuses as $status): ?>
                            <input id="<?php echo $status->sid ?>" name="status" value="<?php echo $status->sid ?>" type="radio" <?php if($ticket->sid == $status->sid) echo 'checked' ?> <?php if($ticket->sid > $status->sid || $ticket->sid == -1) echo 'disabled' ?>>
                            <label for="<?php echo $status->sid ?>"><?php echo $status->label ?></label>
                        <?php endforeach ?>
                        <input id="-1" name="status" value="-1" type="radio" <?php if($ticket->sid == -1) echo 'checked' ?>>
                        <label for="-1">Cancel</label>
                    <a class="btn btn-primary"></a>
                  </div>
                </fieldset>

            </div>

            <div class="form-group">
                <label for="">Ticket Worker</label>
                <select name="worker" class="form-control">
                    <option value="">No one</option>
                    <?php foreach($users as $user): ?>
                        <option value="<?php echo $user->uid ?>" <?php if($ticket->uid == $user->uid || (!$ticket->uid && $user->uid == $this->session->userdata('uid'))) echo 'selected' ?>><?php echo $user->username ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Comments</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <?php else: ?>
            <p>Please <a href="<?php echo base_url() ?>login">log in</a> to make edits to tickets.</p>
        <?php endif ?>
    </div>
    <div class="changes">
        <h2>Changes</h2>
        <table class="table">
            <?php foreach($versions as $version): ?>
                    <tr>
                        <td>
                            <?php echo date('d/m/y h:iA', strtotime($version->created)) ?> by <?php echo $version->username ?><br />
                            <?php foreach(json_decode($version->difference) as $key=>$value): ?>
                                <b><?php echo ucfirst($key) ?></b> <i class="text-muted">changed from</i> <?php echo $value->before ? $value->before : "Nothing" ?> <i class="text-muted">to</i> <?php echo $value->after ? $value->after : "Nothing" ?><br />
                            <?php endforeach ?>
                            <br />
                            <?php if(!empty($version->comment)): ?>
                                <?php echo $version->comment ?>
                            <?php endif ?>
                        </td>
                    </tr>
            <?php endforeach ?>
        </table>
    </div>

</div>

<?php $this->load->view('footer') ?>