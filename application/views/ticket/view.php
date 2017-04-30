<?php $this->load->view('header') ?>
<div class="col-sm-12 ticket">
    <h2>Ticket ID: <?php echo $ticket->tid ?></h2><a href="/ticket/edit/<?php echo $ticket->tid ?>" class="btn btn-default pull-right edit">Edit</a>
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
    <div class="update">
        <h2>Update</h2>

        <?php if($this->session->has_userdata('username')): ?>
        <form method="post">
            <input type="hidden" name="tid" value="<?php echo $ticket->tid ?>">
            <div class="form-check">
                <label class="form-check-label"><input type="radio" class="form-check-input" name="status" value="<?php echo $ticket->sid ?>" checked> Leave as <?php echo $ticket->status ?></label><br />

                <?php if($ticket->sid != 0): ?>
                    <?php if($next_status): ?>
                        <label class="form-check-label"><input type="radio" class="form-check-input" name="status" value="<?php echo $next_status->sid ?>"> Move to <?php echo $next_status->label ?></label><br />
                    <?php endif ?>
                    <label class="form-check-label"><input type="radio" class="form-check-input" name="status" value="0"> Cancel ticket</label><br />
                <?php else: ?>
                    <?php if(isset($last_status)): ?>
                        <label class="form-check-label"><input type="radio" class="form-check-input" name="status" value="<?php echo $last_status->sid ?>"> Move back to <?php echo $last_status->label ?></label><br />
                    <?php endif ?>
                <?php endif ?>
            </div>

            <div class="form-group">
                <label for="">Ticket Worker</label>
                <select name="worker" class="form-control">
                    <option value="">No one</option>
                    <?php foreach($users as $user): ?>
                        <option value="<?php echo $user->uid ?>" <?php if($ticket->uid == $user->uid) echo 'selected' ?>><?php echo $user->username ?></option>
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
            <p>Please <a href="/login">log in</a> to make edits to tickets.</p>
        <?php endif ?>
    </div>
    <div class="changes">
        <h2>Changes</h2>
        <table class="table">
            <?php foreach($versions as $version): ?>
                    <tr>
                        <td>
                            <?php echo date('d/m/y h:mA', strtotime($version->created)) ?> by <?php echo $version->username ?><br />
                            <?php foreach(json_decode($version->difference) as $key=>$value): ?>
                                <b><?php echo ucfirst($key) ?></b> <i class="text-muted">changed from</i> <?php echo $value->before ? $value->before : "Nothing" ?> <i class="text-muted">to</i> <?php echo $value->after ? $value->after : "Nothing" ?><br />
                            <?php endforeach ?>
                            <br />
                            <?php if(!empty($version->comment)): ?>
                                <?php echo $version->comment ?>
                            <br />
                            <br />
                            <?php endif ?>
                        </td>
                    </tr>
            <?php endforeach ?>
        </table>
    </div>

</div>

<?php $this->load->view('footer') ?>