<?php

require '../../functions.php';


$keyword = $_GET['keyword'];


$query = "SELECT * FROM user_member 
                    WHERE user_id LIKE '%$keyword%' OR
                          email LIKE '%$keyword%' OR
                          last_name LIKE '%$keyword%' OR
                          first_name LIKE '%$keyword%' OR 
                          comp_tipe LIKE '%$keyword%' OR 
                          company LIKE '%$keyword%'
                          ";

$data_user = query(1, $query);
// $data = mysqli_query($conn, $query);

// if (mysqli_num_rows($data) > 0) {
//     $data_user = mysqli_fetch_assoc($data);
// } else {
//     $data_user = '';
// }

?>

<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr class="bg-gradient-dark text-center">
            <th class="align-middle">No</th>
            <th class="align-middle">User ID</th>
            <th class="align-middle">Email</th>
            <th class="align-middle">Name</th>
            <th class="align-middle">Phone</th>
            <th class="align-middle">Type</th>
            <th class="align-middle">City</th>
            <th class="align-middle">Status</th>
            <th class="align-middle">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($data_user as $row) :

            $stat = $row['aktif'];

            if ($stat == 1) {
                $remark = "Active";
                $stat = "text-success";
            } else if ($stat == 0) {
                $remark = "Non Active";
                $stat = "text-danger";
            }

        ?>
            <tr>
                <td class="text-center align-middle"><?= $i; ?></td>
                <td class="align-middle"><?= $row['user_id']; ?></td>
                <td class="align-middle"><?= $row['email']; ?></td>
                <td class="align-middle"><?= $row['first_name'] . " " . $row['last_name']; ?></td>
                <td class="align-middle"><?= $row['phone']; ?></td>
                <td class=" text-center align-middle"><?= $row['comp_tipe']; ?></td>
                <td class="align-middle"><?= $row['city']; ?></td>
                <td class="text-center align-middle" data-toggle="tooltip" title="<?= $remark; ?>"><i class="fas fa-circle <?= $stat; ?>"></i></td>
                <td class="text-center align-middle">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">
                            <a href="">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </button>

                        <button type="button" class="btn btn-default">
                            <a href="">
                                <i class="far fa-edit"></i>
                            </a>
                        </button>

                        <button type="button" class="btn btn-default">
                            <a href="">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </button>
                    </div>
                </td>
            </tr>
        <?php $i++;
        endforeach; ?>
    </tbody>
</table>