<?php
    global $wpdb;
    $res = $wpdb->get_results('SELECT * from yd ORDER BY ID DESC LIMIT 0,50');
?>

<div class="wrap">
    <h1 class="wp-heading-inline">
        订单系统
    </h1>
   
    <table class="wp-list-table widefat fixed striped posts" style="margin-top:1rem;">

        <thead>
            <tr>
                <th class="manage-column">ID</th>
                <th class="manage-column">名称</th>
                <th class="manage-column">电话或微信</th>
                <th class="manage-column">计划</th>
                <th class="manage-column">来源</th>
                <th class="manage-column">下单时间</th>
            </tr>
        </thead>

        <tbody class="the-list">
            <?php 
            foreach ($res as $r) {
                echo '<tr>';
                    echo '<td>'.$r->ID.'</td>';
                    echo '<td>'.$r->yd_name.'</td>';
                    echo '<td>'.$r->yd_phone.'</td>';
                    echo '<td>'.$r->yd_jihua.'</td>';
                    echo '<td>'.$r->yd_url.'</td>';
                    echo '<td>'.$r->yd_date.'</td>';
                echo '</tr>';
            }?>
        </tbody>

    </table>
</div>

<?php 
$wpdb->flush();
$wpdb->close();
?>