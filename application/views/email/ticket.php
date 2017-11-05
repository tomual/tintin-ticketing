<?php if($type == 'new'): ?>A new ticket was created<?php endif ?>
<?php if($type == 'status'): ?>This ticket had a change of status<?php endif ?>
<?php if($type == 'comment'): ?>Someone has commented on this ticket<?php endif ?>
<?php if($type == 'status_comment'): ?>This ticket changed status with a comment<?php endif ?>

<div class="col-sm-12 ticket">
    <h2>Ticket ID: <?php echo $ticket->tid ?></h2>

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

    <div class="changes">
        <h2>Recent Change</h2>
        <table class="table">
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
        </table>
    </div>

</div>

<p>You have received this email because you are subscribed to be notified of changes made to this ticket.</p>
<?php anchor(base_url("notification/unsubscribe/{$ticket->tid}", 'Unsubscribe from this ticket') ) ?>
