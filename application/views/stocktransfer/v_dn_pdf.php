<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Delivery Note</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            font-size: 9px;
            /* color: #777; */
        }

        body h1 {
            font-weight: 500;
            margin-bottom: 0px;
            padding-bottom: 0px;
            /* color: #000; */
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            /* padding: 30px; */
            /* border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
            font-size: 13px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            /* padding: 5px; */
            vertical-align: top;
        }

        /* .invoice-box table tr.information td:nth-child(2) {
            text-align: right;
        } */

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 10px;
            width: 50%;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 30px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .info {
            border-collapse: collapse;
        }

        .info td,
        th {
            padding: 2px;
            border: 1px solid black;
        }

        .info th {
            text-align: left;
        }
    </style>
</head>

<body>
  
    <div class="invoice-box">
        <table>
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td style="text-align: left;">
                                <img height="50" src="<?= base_url('assets/img/warehouse/logo-able.png') ?>" alt="">
                            </td>
                            <td style="text-align: right;">
                                <img height="50" src="<?= base_url('assets/img/warehouse/fiberhome-logo.png') ?>" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;">
                                <h1>DELIVERY NOTE</h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 5px; width:80%">
                                <p>
                                    <b>PT FIBER HOME (WAREHOUSE WAINGAPU)</b><br>
                                    <b>Jl. Umbu Tipuk Marisi, Matawai, Kota Waingapu, Kabupaten Sumba Timur, Nusa Tenggara Timur</b>
                                </p>
                            </td>
                            <td style="border: 1px solid black; padding: 5px" rowspan="2">
                                <span style="width:100px;">Order Number</span> : <?= $header->row()->stock_transfer_no ?> <br>
                                <span style="width:100px;">Order Date</span> : <?= $header->row()->stock_transfer_date ?> <br>
                                <span style="width:100px;">Delivery Date</span> :  <br><br>
                                <span style="width:100px;">Warehouse Origin</span> : <?= $header->row()->warehouse_origin ?> <br>
                                <span style="width:100px;">Warehouse Destination</span> : <?= $header->row()->warehouse_destination ?><br>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black; padding: 5px">
                                <span style="width:100px;">Project Name</span> : <?= $header->row()->project_name ?> <br>
                            </td>
                        </tr>
                        
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table class="info">
            <thead>
                <tr>
                    <th style="width: 20px;">NO</th>
                    <th style="width: 50px;">PRODUCT CODE</th>
                    <th style="width: 180px;">DESCRIPTION</th>
                    <th style="width: 20px;">UOM</th>
                    <th style="width: 20px;">QTY</th>
                    <th style="width: 50px;">REMARK</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i = 1;
                foreach ($body->result() as $row) :
                    $cbm = $row->qty * $row->cbm;
                    $weight = $row->qty * $row->weight;
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= trim($row->product_code) ?></td>
                        <td><?= $row->product_name ?></td>
                        <td><?= $row->uom ?></td>
                        <td style="text-align:center"><?= $row->qty ?></td>
                        <td></td>
                    </tr>
                <?php
                    $i++;
                endforeach;
                ?>
            </tbody>
            </tbody>
        </table>
        <br>
        <table border="1">
            <tr>
                <td style="width:150px;text-align:center;">Checker</td>
                <td style="width:150px;text-align:center;">Receiver</td>
                <td style="width:150px;text-align:center;">Driver</td>
                <td style="width:150px;text-align:center;">Supervisor</td>
            </tr>
            <tr>
                <td>
                    <br><br><br><br><br><br>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    Full Name : <br>
                    Company : <br>
                    Date : <br>
                </td>
                <td>
                    Full Name : <br>
                    Company : <br>
                    Date : <br>
                </td>
                <td>
                    Full Name : <br>
                    Company : <br>
                    Date : <br>
                </td>
                <td>
                    Full Name : <br>
                    Company : <br>
                    Date : <br>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>