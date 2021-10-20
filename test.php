<?php

use Psr\Log\NullLogger;

require './functions.php';
// require 'pages/functions.php';

$id_member = 1;

$sql = "SELECT * FROM vw_booking_inbound WHERE id_member = '$id_member' ORDER BY create_date ASC";

$data = query(1, $sql);

// echo cr_new_inbound('Trucking');

?>
<table>
    <thead>
        <tr>
            <th style="border: 1px solid black;">No</th>
            <th style="border: 1px solid black;">Req Date</th>
            <th style="border: 1px solid black;">In Via</th>
            <th style="border: 1px solid black;">Liner</th>
            <th style="border: 1px solid black;">Q</th>
            <th style="border: 1px solid black;">BN</th>
            <th style="border: 1px solid black;">Exp. date</th>
            <th style="border: 1px solid black;">Status</th>
        </tr>
    </thead>

    <tbody>
        <?php

        $i = 1;

        foreach ($data as $row) :

            $exp_date = $row['expired_date'];
            if ($exp_date == null) {
                $expired_date = '';
            } else {
                $expired_date = date("d-M-Y", strtotime($row['expired_date']));
            }
        ?>
            <tr>
                <td style="border: 1px solid black;"><?= $i; ?></td>
                <td style="border: 1px solid black;"><?= date("d-M", strtotime($row['create_date'])) ?> <br> <?= date("[H:i]", strtotime($row['create_date'])) ?> </td>
                <td style="border: 1px solid black;"><?= $row['in_via']; ?></td>
                <td style="border: 1px solid black;"><?= get_liner('name', $row['id_liner']) ?></td>
                <td style="border: 1px solid black;"><?= $row['quantity'] . " x " . get_cont_code($row['id_type_cont'], 'size'); ?></td>
                <td style="border: 1px solid black;"><?= $row['booking_num']; ?></td>
                <td style="border: 1px solid black;"><?= $expired_date; ?></td>
                <td style="border: 1px solid black;">Status</td>

            </tr>
        <?php $i++;
        endforeach; ?>


    </tbody>

</table>