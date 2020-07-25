<?php if($this->session->userdata('is_logged_in')): ?>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-list"></i>
            Classes</div>
        <div class="card-body">

            <div class="d-flex justify-content-start flex-wrap">

                <?php foreach ($data['classes'] as $i => $class): ?>

                    <div class="col-2 form-group my-3">

                        <div class="card">
                            <div class="card-header">
                                <strong>
                                    <?php echo \DateTime::createFromFormat('Y-m-d', $class->date)->format('d M') ?>
                                    <?php echo \DateTime::createFromFormat('H:i:s', $class->time)->format('h:i a') ?>
                                </strong>
                            </div>
                            <div class="card-body">
                                <div>
                                    <strong>Subscribers:</strong>
                                    <?php echo $class->count_subscribers ?> / 8
                                </div>
                                <div>
                                    <strong>Status:</strong>

                                    <?php if ($data['date'] === $class->date && $data['time'] === $class->time): ?>
                                        <span class="text-white bg-info d-inline-block mt-1 px-2 rounded">
                                            <strong>In process</strong>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-white bg-warning d-inline-block mt-1 px-2 rounded">
                                            <strong>Pending</strong>
                                        </span>
                                    <?php endif ?>

                                </div>


                                <div class="mt-5 text-center">

                                    <?php if ($data['date'] === $class->date && $data['time'] === $class->time): ?>
                                        <button class="btn btn-dark" disabled>Edit</button>
                                    <?php else: ?>
                                        <button class="btn btn-dark">
                                            Edit
                                        </button>
                                    <?php endif ?>

                                    <?php if ($class->count_subscribers): ?>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#subscribersModal<?php echo $i ?>">
                                            Subscribers
                                        </button>
                                        <!-- Subscribers modal -->
                                        <div class="modal fade" id="subscribersModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="exampleModalLabel">Subscribers</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-left">Name</th>
                                                                <th>Age/Sex</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($class->members as $member): ?>
                                                                <tr>
                                                                    <td class="text-left">
                                                                        <i class="fa fa-user"></i>
                                                                        <?php echo $member->member_name ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $member->member_age ?> /
                                                                        <?php echo $member->member_sex ?>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <a
                                                                            target="_blank"
                                                                            href="<?php echo base_url(); ?>member_histroy_controller/view_histroy/<?php echo $member->member_reg_id?>"
                                                                        >
                                                                            <strong>Detail</strong>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach ?>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <button class="btn btn-primary" disabled>Subscribers</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php else: ?>
    <?php redirect('login_controller'); ?>
<?php endif; ?>