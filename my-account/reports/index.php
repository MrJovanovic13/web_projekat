<?php
require_once "../../connection/connection.php";
require("../../vendor/fpdf/fpdf/original/fpdf.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    include("../view/reports.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $inputDateStart = $_POST['dateStart'];
    $inputDateEnd = $_POST['dateEnd'];

    $dateStart = date("Y-m-d", strtotime($inputDateStart));
    $dateEnd = date("Y-m-d", strtotime($inputDateEnd));
    $reportType = $_POST['reportType']; // 1= new users, 2= orders placed, 3= Product stats
    $reportFormat = $_POST['reportFormat']; // 1= PDF, 2= EXCEL
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    if ($reportType == 3) {
        $pdf->Cell(50, 10, 'Product');
        $pdf->Cell(40, 10, 'Price');
        $pdf->Cell(40, 10, 'Sales count');
        $pdf->Cell(40, 10, 'Total revenue');
        $pdf->Ln();

        $maxSold=0;
        $maxSoldName;
        $leastSold=PHP_INT_MAX;
        $leastSoldName;
        $totalRevenue=0;

        $q = "SELECT `id`,`name`,`price` FROM `products`";
        $result = $conn->query($q);
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(50, 10, $row['name']);
            $pdf->Cell(40, 10, $row['price']);
            
            $q1 = "SELECT `amount` from `items` WHERE `product_id` =".$row['id'];
            $result1 = $conn->query($q1);
            $product_total_count =0;
            while($row1 = $result1->fetch_assoc()) {
                $product_total_count += $row1['amount'];
            }
            $pdf->Cell(40, 10, $product_total_count);
            $pdf->Cell(70, 10, $product_total_count*$row['price'].'$');
            $totalRevenue+= $product_total_count*$row['price'];

            if($product_total_count>$maxSold){
                $maxSold=$product_total_count;
                $maxSoldName=$row['name'];
            }

            if($product_total_count<$leastSold){
                $leastSold=$product_total_count;
                $leastSoldName=$row['name'];
            }

            $product_total_count =0;
            $pdf->Ln();
        }

        $pdf->Cell(40, 10, 'Most sought after product:' . $maxSoldName);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Least sought after product:' . $leastSoldName);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Total revenue(all products):' . $totalRevenue . '$');
        $pdf->Ln();

        $pdfName = $dateStart . "-" . $dateEnd . ".pdf";
        $pdf->Output("D", $pdfName);
    }
    if ($reportType == 1) {

        $pdf->Cell(50, 10, 'Name');
        $pdf->Cell(70, 10, 'Email');
        $pdf->Cell(40, 10, 'Location');

        $pdf->Ln();
        $q = "SELECT `name`, `email`, `location`
                FROM `users`";

        $result = $conn->query($q);
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(50, 10, $row['name']);
            $pdf->Cell(70, 10, $row['email']);
            $pdf->Cell(40, 10, $row['location']);
            $pdf->Ln();
        }
        $pdf->Ln();
        $pdf->Cell(40, 10, "New users geographic segmentation:");
        $pdf->Ln();
        $pdf->Cell(40, 10, 'location');
        $pdf->Cell(40, 10, 'count');
        $pdf->Ln();
        $q1 = "SELECT 
        `location`,
        COUNT(*) as `number2`
        FROM `users`
        GROUP BY `location`
        ORDER BY COUNT(*) DESC";
        $result1 = $conn->query($q1);
        while ($row1 = $result1->fetch_assoc()) {
            $pdf->Cell(40, 10, $row1['location']);
            $pdf->Cell(40, 10, $row1['number2']);
            $pdf->Ln();
        }

        $pdf->Ln();
        $pdf->Cell(40, 10, 'Total number of new users:' . mysqli_num_rows($result));


        $pdfName = $dateStart . "-" . $dateEnd . ".pdf";
        $pdf->Output("D", $pdfName);
    }
    if ($reportType == 2) {
        $q = "SELECT `date`,`id` FROM `orders`
    WHERE `date` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'";

        $result = $conn->query($q);

        $orderCount = mysqli_num_rows($result);

        $pdf->Cell(40, 10, 'date');
        $pdf->Cell(40, 10, 'price');
        $pdf->Cell(40, 10, 'status');
        $pdf->Ln();

        $order_total = 0;
        $report_total = 0;
        $not_completed_counter = 0;

        while ($row = $result->fetch_assoc()) {
            $q1 = "SELECT `status_id` FROM `order_status`
        WHERE `date` BETWEEN '" . $dateStart . "' AND '" . $dateEnd . "'";

            $q2 = "SELECT `product_id`, `amount`
                FROM `items`
                WHERE `order_id`=" . $row['id'];
            $result2 = $conn->query($q2);
            while ($row2 = $result2->fetch_assoc()) {
                $q3 = "SELECT `price` 
                    FROM `products`
                    WHERE `products`.`id`=" . $row2['product_id'];
                $result3 = $conn->query($q3);
                while ($row3 = $result3->fetch_assoc()) {
                    $order_total += $row3['price'] * $row2['amount'];
                }
            }

            $q4 = "SELECT `status`.`name`
        FROM `order_status`
        LEFT JOIN status
        ON `order_status`.`status_id` = `status`.`id`
        WHERE `order_status`.`order_id`=" . $row['id'] . "
        ORDER BY `date` DESC, `time` DESC";
            $result4 = $conn->query($q4);
            $row4 = $result4->fetch_assoc();

            $pdf->Cell(40, 10, $row['date']);
            $pdf->Cell(40, 10, $order_total . "$");
            $pdf->Cell(40, 10, $row4['name']);
            $report_total += $order_total;
            $order_total = 0;
            if ($row4['name'] != "Completed") {
                $not_completed_counter++;
            }
            $pdf->Ln();
        }

        $pdf->Cell(40, 10, 'Total number of orders:' . $orderCount);
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Total price of orders:' . $report_total . "$");
        $pdf->Ln();
        $pdf->Cell(40, 10, '% of completed orders:' . $not_completed_counter / $orderCount * 100 . "%");
        $pdf->Ln();

        $pdfName = $dateStart . "-" . $dateEnd . ".pdf";
        $pdf->Output("D", $pdfName);
    }

    //header("Location: ../reports");
}
