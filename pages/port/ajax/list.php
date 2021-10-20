<?php

require '../../functions.php';

$keyword = $_GET['keyword'];

$query = "SELECT type_code, 
                 vessel_code, 
                 vessel_name, 
                 flag, 
                 voyage, 
                 pol, 
                 td_pol, 
                 eta_prw, 
                 ta_prw, 
                 vessel_plan 
          FROM vw_open_shipment 
          WHERE vessel_code LIKE '%$keyword%' OR
                voyage LIKE '%$keyword%' OR
                pol LIKE '%$keyword%' OR
                vessel_plan LIKE '%$keyword%' ";

$shipment = query(1, $query);

?>



<table id="example2" class="table table-bordered table-hover">
    <thead>
        <tr class="bg-gradient-dark text-center">
            <th class="align-middle">No</th>
            <th class="align-middle">Shipment</th>
            <th class="align-middle">POL</th>
            <th class="align-middle">TD POL</th>
            <th class="align-middle">ETA PRW</th>
            <th class="align-middle">TA PRW</th>
            <th class="align-middle">Plan</th>
            <th class="align-middle">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($shipment as $shp) :

            $vsl = $shp['type_code'] . '. ' . $shp['vessel_name'] . ' V.' . $shp['voyage'];

            $plan = $shp['vessel_plan'];

            if ($plan == 1) {
                $vessel_plan = 'Bongkar';
            } else if ($plan == 2) {
                $vessel_plan = 'Muat';
            } else if ($plan == 3) {
                $vessel_plan = 'Bongkar & Muat';
            }

            if ($shp['ta_prw'] == '') {
                $ta_prw = '';
                $bg_clr = '';
            } else {
                $ta_prw = date("d-M [H:i]", strtotime($shp["ta_prw"]));
                $bg_clr = 'bg-gradient-success';
            }
        ?>
            <tr class="<?= $bg_clr; ?>">
                <td class=" text-center align-middle"><?= $i; ?></td>
                <td class="align-middle"><?= $vsl; ?></td>
                <td class="text-center align-middle"><?= $shp['pol']; ?></td>
                <td class="text-center align-middle"><?= date("d-M [H:i]", strtotime($shp["td_pol"]));; ?></td>
                <td class="text-center align-middle"><?= date("d-M [H:i]", strtotime($shp["eta_prw"])); ?></td>
                <td class="text-center align-middle"><?= $ta_prw; ?></td>
                <td class="align-middle"><?= $vessel_plan; ?></td>
                </td>
                <td class="text-center align-middle">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#information">
                            <a href="">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </button>

                        <button type="button" class="btn btn-default" data-toggle="tooltip" title="Edit">
                            <a href="./info_shipment.php?keyword=">
                                <i class="far fa-edit"></i>
                            </a>
                        </button>

                        <button type="button" class="btn btn-default">
                            <a href="">
                                <i class="fas fa-ship"></i>
                            </a>
                        </button>
                    </div>

                    <!-- MODAL Information -->
                    <div class="modal fade" id="information">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Default Modal</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>One fine body&hellip;</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [AKHIR] MODAL -->
                </td>


            </tr>
        <?php $i++;
        endforeach; ?>
    </tbody>
</table>