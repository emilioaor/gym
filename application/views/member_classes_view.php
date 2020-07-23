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

                                    <?php if ($class->subscribed): ?>
                                        <form action="<?php echo base_url('class_controller/unsubscribe');?>" method="post">
                                            <input type="hidden" name="date" value="<?php echo $class->date ?>">
                                            <input type="hidden" name="class_id" value="<?php echo $class->id ?>">

                                            <?php if (($data['date'] === $class->date && $data['time'] === $class->time)): ?>
                                                <button class="btn btn-danger" disabled>Unsubscribe</button>
                                            <?php else: ?>
                                                <button class="btn btn-danger">Unsubscribe</button>
                                            <?php endif ?>

                                        </form>
                                    <?php else: ?>
                                        <form action="<?php echo base_url('class_controller/subscribe');?>" method="post">
                                            <input type="hidden" name="date" value="<?php echo $class->date ?>">
                                            <input type="hidden" name="class_id" value="<?php echo $class->id ?>">

                                            <?php if ($data['date'] === $class->date && $data['time'] === $class->time): ?>
                                                <button class="btn btn-info" disabled>
                                                    Closed
                                                </button>
                                            <?php elseif($class->count_subscribers >= 8 || in_array($class->date, $data['subscribed_dates'])): ?>
                                                <button class="btn btn-primary" disabled>Subscribe</button>
                                            <?php else: ?>
                                                <button class="btn btn-primary">Subscribe</button>
                                            <?php endif ?>

                                        </form>
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