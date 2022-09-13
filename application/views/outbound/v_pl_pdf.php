<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Picking List</title>

    <!-- Favicon -->
    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            font-size: 10px;
            /* color: #777; */
        }

        body h1 {
            font-weight: 300;
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
                            <td>
                                <h2>PICKING LIST <?= $header->row()->outbound_no ?></h2>
                                <img height="50" src="<?= base_url('assets/img/warehouse/logo-ibs.png') ?>" alt="">
                            </td>
                            <td style="text-align: right;">
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>DELIVERY TO</b>
                            </td>
                        </tr>
                        <tr>
                            <td style="border:none; padding: 5px">
                                <?= $header->row()->destination ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table class="info" style="border: none;">
            <tr>
                <th style="width: 100px; border: none;">DATE :</th>
                <td style="width: 100px; border: none;"><?= $header->row()->outbound_date ?></td>
                <th style="width: 150px; border: none;">REQUEST NUMBER :</th>
                <td style="border: none;"><?= $header->row()->mr_no ?></td>
            </tr>
            <tr>
                <th style="border: none;">Site ID :</th>
                <td style="border: none;"><?= $header->row()->site_id ?></td>
                <th style="border: none;">Site Name :</th>
                <td style="border: none;"><?= $header->row()->site_name ?></td>
            </tr>
        </table>
        <br>
        <table class="info">
            <tr>
                <th style="width: 80px;">Product Code</th>
                <th style="width: 250px;">Material Name</th>
                <th style="width: 80px;">Serial Number</th>
                <th style="width: 50px;">UoM</th>
                <th style="width: 50px;">Qty</th>
                <th>Remark</th>
            </tr>
            <?php
            foreach ($body->result() as $row) :
            ?>
                <tr>
                    <td><?= $row->product_code ?></td>
                    <td><?= $row->product_name ?></td>
                    <td><?= $row->lot_number ?></td>
                    <td><?= $row->uom ?></td>
                    <td style="text-align:right"><?= $row->qty ?></td>
                    <td></td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
        <br>
        <table border="1">
            <tr>
                <td style="width:150px;text-align:center;">Picker</td>
                <td style="width:150px;text-align:center;">Admin</td>
                <td style="width:150px;text-align:center;">Pic Gudang </td>
            </tr>
            <tr>
                <td>
                    <br><br>
                    <br><br><br>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><br></td>
                <td><br></td>
                <td><br></td>
            </tr>
        </table>
    </div>
</body>

</html>