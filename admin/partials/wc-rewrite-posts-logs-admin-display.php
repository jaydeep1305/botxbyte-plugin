<h1>Rewrite Posts Logs</h1>

<table id="bxb-rp-logs-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Record ID</th>
            <th>Time</th>
            <th>Post ID</th>
            <th>Change Type</th>
            <th>Old Value</th>
            <th>New Value</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($records as $record) {
                ?>
                    <tr>
                        <td> <?php echo $record->id; ?></td>
                        <td> <?php echo $record->timeofchange; ?></td>
                        <td> <?php echo $record->post_id; ?></td>
                        <td> <?php echo $record->change_type; ?></td>
                        <td> <?php echo $record->old_value; ?></td>
                        <td> <?php echo $record->new_value; ?></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>