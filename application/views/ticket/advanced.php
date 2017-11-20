<?php $this->load->view('header') ?>

<div class="col-md-12">
    <h1><?php echo $title ?></h1>

    <div class="container advanced-search">
        <div class="form-group row">
            <form class="form-horizontal" method="get">

                <div class="form-group row">
                    <label for="category" class="col-md-2 col-form-label">Last Modified</label>
                    <div class="col-md-1 text-center">
                        <label for="category" class="col-form-label">between</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="modified_from" id="modified_from" class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="col-md-1">
                        <label for="category" class="col-form-label">and</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="modified_to" id="modified_to" class="form-control" placeholder="dd/mm/yyyy">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-2 col-form-label">Created</label>
                    <div class="col-md-1 text-center">
                        <label for="category" class="col-form-label">between</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="created_from" id="created_from" class="form-control" placeholder="dd/mm/yyyy">
                    </div>

                    <div class="col-md-1">
                        <label for="category" class="col-form-label">and</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="created_to" id="created_to" class="form-control" placeholder="dd/mm/yyyy">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-2 col-form-label">Category</label>
                    <div class="col-md-4">
                        <select name="category[]" id="category" multiple="multiple" class="form-control">
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->cid ?>" <?php if($this->input->get('category') == $category->cid) echo 'selected' ?>><?php echo $category->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="col-form-label form-check-label"><input type="checkbox" name="exclude[]" class="form-check-input" value="category"> Not</label>
                    </div>
                </div>

                <div class="form-group row" id="category-and-select" style="display:none">
                    <label for="and-category" class="col-md-2 col-form-label text-right">and ...</label>
                    <div class="col-md-4">
                        <select name="and-category[]" id="and-category" multiple="multiple" class="form-control">
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->cid ?>" <?php if($this->input->get('category') == $category->cid) echo 'selected' ?>><?php echo $category->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-2 col-form-label">Project</label>
                    <div class="col-md-4">
                        <select name="project[]" id="project" multiple="multiple" class="form-control">
                            <?php foreach($projects as $project): ?>
                                <option value="<?php echo $project->pid ?>" <?php if($this->input->get('project') == $project->pid) echo 'selected' ?>><?php echo $project->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="col-form-label form-check-label"><input type="checkbox" name="exclude[]" class="form-check-input" value="project"> Not</label>
                    </div>
                </div>

                <div class="form-group row" id="project-and-select" style="display:none">
                    <label for="and-project" class="col-md-2 col-form-label text-right">and ...</label>
                    <div class="col-md-4">
                        <select name="and-project[]" id="and-project" multiple="multiple" class="form-control">
                            <?php foreach($projects as $project): ?>
                                <option value="<?php echo $project->pid ?>" <?php if($this->input->get('project') == $project->pid) echo 'selected' ?>><?php echo $project->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="author" class="col-md-2 col-form-label">Author</label>
                    <div class="col-md-4">
                        <select name="author[]" id="author" multiple="multiple" class="form-control">
                            <?php foreach($users as $user): ?>
                                <option value="<?php echo $user->uid ?>" <?php if($this->input->get('author') == $user->uid) echo 'selected' ?>><?php echo $user->username ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="col-form-label form-check-label"><input type="checkbox" name="exclude[]" class="form-check-input" value="author"> Not</label>
                    </div>
                </div>

                <div class="form-group row" id="author-and-select" style="display:none">
                    <label for="and-author" class="col-md-2 col-form-label text-right">and ...</label>
                    <div class="col-md-4">
                        <select name="and-author[]" id="and-author" multiple="multiple" class="form-control">
                            <?php foreach($users as $user): ?>
                                <option value="<?php echo $user->uid ?>" <?php if($this->input->get('author') == $user->uid) echo 'selected' ?>><?php echo $user->username ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="worker" class="col-md-2 col-form-label">Worker</label>
                    <div class="col-md-4">
                        <select name="worker[]" id="worker" multiple="multiple" class="form-control">
                            <?php foreach($users as $user): ?>
                                <option value="<?php echo $user->uid ?>" <?php if($this->input->get('worker') == $user->uid) echo 'selected' ?>><?php echo $user->username ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="col-form-label form-check-label"><input type="checkbox" name="exclude[]" class="form-check-input" value="worker"> Not</label>
                    </div>
                </div>

                <div class="form-group row" id="worker-and-select" style="display:none">
                    <label for="and-worker" class="col-md-2 col-form-label text-right">and ...</label>
                    <div class="col-md-4">
                        <select name="and-worker[]" id="and-worker" multiple="multiple" class="form-control">
                            <?php foreach($users as $user): ?>
                                <option value="<?php echo $user->uid ?>" <?php if($this->input->get('worker') == $user->uid) echo 'selected' ?>><?php echo $user->username ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-md-2 col-form-label">Status</label>
                    <div class="col-md-4">
                        <select name="status[]" id="status" multiple="multiple" class="form-control">
                            <?php foreach($statuses as $status): ?>
                                <option value="<?php echo $status->sid ?>" <?php if($this->input->get('status') == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
                            <?php endforeach ?>
                            <option value="-1">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="col-form-label form-check-label"><input type="checkbox" name="exclude[]" class="form-check-input" value="status"> Not</label>
                    </div>
                </div>

                <div class="form-group row" id="status-and-select" style="display:none">
                    <label for="and-status" class="col-md-2 col-form-label text-right">and ...</label>
                    <div class="col-md-4">
                        <select name="and-status[]" id="and-status" multiple="multiple" class="form-control">
                            <?php foreach($statuses as $status): ?>
                                <option value="<?php echo $status->sid ?>" <?php if($this->input->get('status') == $status->sid) echo 'selected' ?>><?php echo $status->label ?></option>
                            <?php endforeach ?>
                            <option value="-1">Cancelled</option>
                        </select>
                    </div>
                </div>

                <input type="submit" value="Search" class="btn btn-primary">

            </form>
            <br>
        </div>
    </div>
    <?php if(!empty($tickets) || !empty($this->input->get())): ?>
        <?php if($this->router->fetch_class() == 'report'): ?>
            <div class="create-report">
                <h2>Save Report</h2>
                <form action="<?php echo base_url('report/add') ?>" method="post">
                    <div class="form-group">
                        <label for="">Report Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Report Title" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Report Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Report Description" value="">
                    </div>
                    <input type="hidden" name="query" value="<?php echo htmlspecialchars(json_encode($this->input->get())) ?>">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <br>
            </div>
        <?php endif ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $tickets as $ticket ): ?>
                    <tr>
                        <td><?php echo $ticket->tid ?></td>
                        <td><a href="<?php echo base_url() ?>ticket/view/<?php echo $ticket->tid ?>"><?php echo $ticket->title ?></a></td>
                        <td><?php echo $ticket->label ?></td>
                        <td><?php echo $ticket->username ?></td>
                        <td><?php echo date('d/m/Y', strtotime($ticket->created)) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php $this->load->view('ticket/pagination') ?>
    <?php endif ?>
</div>

<?php $this->load->view('footer') ?>