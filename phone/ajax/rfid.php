<?php

session_start();
require '../koneksi.php';

$keyword = $_GET['keyword'];

$key =  substr($keyword, 0, 2);

// Code 16  Container Number, 11 Truck Code, 
if ($key == '16') {
    // echo "Container Number";
    $sql = "SELECT * FROM container WHERE rfid_code = '$keyword'";
    $data = mysqli_query($conn, $sql);
    $cont_data = mysqli_fetch_assoc($data);
    var_dump($cont_data);
} else if ($key == '11') {
    echo "Truck ID";
    $sql = "SELECT * FROM truck WHERE rfid_code = '$keyword'";
    $data = mysqli_query($conn, $sql);
    $truck_data = mysqli_fetch_assoc($data);
    var_dump($truck_data);
} else if ($key == '26') {
    echo "Heavy Equipment";
    $sql = "SELECT * FROM he WHERE rfid_code = '$keyword'";
    $data = mysqli_query($conn, $sql);
    $he_data = mysqli_fetch_assoc($data);
    var_dump($he_data);
}
?>

<div class="col-md-6">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">HEAVY EQUIPMENT</h3>
        </div>
        <div class="card-body">
            <div class="form-group row" style="margin-top: -10px; padding-bottom: -5px;">
                <P class="col-md-3">Equipment</P>
                <p class="col-md-1 text-right">:</p>
                <label class="col-md-8">TPN-12</label>
            </div>

            <div class="form-group row" style="margin-top: -20px;">
                <P class="col-md-3">Operator</P>
                <p class="col-md-1 text-right">:</p>
                <label class="col-md-8">ASEP SURASEP</label>
            </div>

            <div class="form-group row" style="margin-top: -20px;">
                <P class="col-md-3">Remark</P>
                <p class="col-md-1 text-right">:</p>
                <label class="col-md-8">REACH STACKER, KONE CRANES, TOSCA</label>
            </div>

        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">TRANSPORT EQUIPMENT</h3>
        </div>
        <div class="card-body">
            <div class="form-group row" style="margin-top: -10px; padding-bottom: -5px;">
                <P class="col-md-3">Truck ID</P>
                <p class="col-md-1 text-right">:</p>
                <label class="col-md-8">KS-42</label>
            </div>

            <div class="form-group row" style="margin-top: -20px;">
                <P class="col-md-3">Driver</P>
                <p class="col-md-1 text-right">:</p>
                <label class="col-md-8">BAMBANG SUJATMIKO</label>
            </div>

            <div class="form-group row" style="margin-top: -20px;">
                <P class="col-md-3">Remark</P>
                <p class="col-md-1 text-right">:</p>
                <label class="col-md-8">PT. KERJA SAMA, TRAILER, FUSO</label>
            </div>

        </div>
    </div>
</div>

<!-- Card untuk Container -->
<div class="col-md-12">
    <div class="card card-warning">
        <div class="card-header text-center">
            <h3 class="card-title text-center">CONTAINER</h3>
        </div>
        <div class="card-body row">

            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">TEGU 1234567</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row" style="margin-top: -10px; padding-bottom: -5px;">
                            <P class="col-md-3">Liner</P>
                            <p class="col-md-1 text-right">:</p>
                            <label class="col-md-8">TEMAS LINE</label>
                        </div>

                        <div class="form-group row" style="margin-top: -20px;">
                            <P class="col-md-3">SIZE</P>
                            <p class="col-md-1 text-right">:</p>
                            <label class="col-md-8">20GP</label>
                        </div>

                        <div class="form-group row" style="margin-top: -20px;">
                            <P class="col-md-3">Laden</P>
                            <p class="col-md-1 text-right">:</p>
                            <label class="col-md-8">LADEN</label>
                        </div>

                        <div class="form-group row" style="margin-top: -20px;">
                            <P class="col-md-3">Delivery No</P>
                            <p class="col-md-1 text-right">:</p>
                            <label class="col-md-8">2160143356</label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">TEGU 1234567</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row" style="margin-top: -10px; padding-bottom: -5px;">
                            <P class="col-md-3">Liner</P>
                            <p class="col-md-1 text-right">:</p>
                            <label class="col-md-8">TEMAS LINE</label>
                        </div>

                        <div class="form-group row" style="margin-top: -20px;">
                            <P class="col-md-3">SIZE</P>
                            <p class="col-md-1 text-right">:</p>
                            <label class="col-md-8">20GP</label>
                        </div>

                        <div class="form-group row" style="margin-top: -20px;">
                            <P class="col-md-3">Laden</P>
                            <p class="col-md-1 text-right">:</p>
                            <label class="col-md-8">LADEN</label>
                        </div>

                        <div class="form-group row" style="margin-top: -20px;">
                            <P class="col-md-3">DELIVERY NO</P>
                            <p class="col-md-1 text-right">:</p>
                            <label class="col-md-8">2160143356</label>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>