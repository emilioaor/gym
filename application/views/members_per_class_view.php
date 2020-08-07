<?php if($this->session->userdata('is_logged_in') && $this->session->userdata('role') === 'admin'): ?>
    <!-- DataTables  -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Classes
            From: <?php echo (new \DateTime($this->input->post('i_from')))->format('d-m-Y')  ?>
            To: <?php echo (new \DateTime($this->input->post('i_to')))->format('d-m-Y')  ?>
        </div>
        <div class="card-body p-0 ">
            <?php   if($data['classes']): ?>
            <div class="table-responsive">
                <table class="table table-bordered m-0"  width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Members</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Members</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($data['classes'] as $class): ?>
                            <tr>
                                <td><?php echo (new \DateTime($class['date']))->format('d M Y') ?></td>
                                <td><?php echo \DateTime::createFromFormat('H:i:s', $class['time'])->format('H:i') ?></td>
                                <td><?php echo $class['count'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer"><strong>Total Classes in This Date Range : <?php echo count($data['classes']) ?></strong></div>
        <?php else: ?>
            <p class="pl-4 pt-2" > No Data Available</p>
        <?php endif; ?>
    </div>
<?php else: ?>
    <?php redirect('login_controller'); ?>
<?php endif; ?>