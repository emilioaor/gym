<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-cog"></i>
            Classes setting</div>
        <div class="card-body">

            <?php echo form_open('admin_class_controller/save_setting'); ?>
                <div class="d-flex justify-content-start flex-wrap">
                    <?php foreach ($data['classes'] as $i => $class): ?>

                        <div class="col-2 form-group my-3">

                            <div class="card">
                                <div class="card-header">
                                    <strong>
                                        Class #<?php echo $i+1 ?>
                                    </strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <?php
                                        echo form_input(array(
                                            'class' => 'form-control',
                                            'name' => "classes[{$class->id}][time]",
                                            'placeholder' => 'Time',
                                            'type' => 'time',
                                            'value' => $class->time
                                        ))
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="bg-success text-white d-inline-block px-1 py-1 opacity">
                                            <?php echo form_radio(array(
                                                'name' => "classes[{$class->id}][status]",
                                                'value' => 'active',
                                                'checked' => $class->status === 'active' ? 'checked' : '',
                                            )) ?>
                                            <strong>Active</strong>
                                        </div>

                                        <div class="bg-danger text-white d-inline-block px-1 py-1">
                                            <?php echo form_radio(array(
                                                'name' => "classes[{$class->id}][status]",
                                                'value' => 'inactive',
                                                'checked' => $class->status === 'inactive' ? 'checked' : ''
                                            )) ?>
                                            <strong>Inactive</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="row">
                    <div class="form-group ml-3 col-12">
                        <?php
                        echo form_submit(array(
                            'class' => 'btn btn-primary',
                            'value' => 'Save setting'
                        ))
                        ?>
                    </div>
                </div>
            <?php form_close() ?>
        </div>
    </div>

<?php else: ?>
    <?php redirect('login_controller'); ?>
<?php endif; ?>