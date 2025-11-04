<div style="line-height: 1; margin-bottom: 0;">
    <div class="title" style="margin-bottom: 4px;">PAYMENT CONFIRMATION / RECEIPT</div>
    <div class="paid-label" style="margin-top: 0;font-weight: bold">**PAID**</div>
</div>

<div>
    <table>
        <tr>
            <th width="60%" style="font-weight: bold">
                Company Info:
            </th>
            <th width="40%" style="font-weight: bold">
                Receipt Details:
            </th>
        </tr>
        <tr>
            <td>
                Private Health Services Regulatory Council
            </td>
            <td>
                Receipt Number: <?php echo $receipt_number; ?>
            </td>
        </tr>
        <tr>
            <td>
                Ministry of Health
            </td>
            <td>
                Date Issued: <?php echo date("F j, Y", strtotime($receipt_created_at)); ?>
            </td>
        </tr>
        <tr>
            <td>
                No. 2A, CBM House, 4th Floor, Lake Drive,
            </td>
            <td>
                Time Issued: <?php echo date("h:i A", strtotime($receipt_created_at)); ?>
            </td>
        </tr>
        <tr>
            <td>
                Colombo 08.
            </td>
            <td>
                Payment Status: <?php echo $result; ?>
            </td>
        </tr>
        <tr>
            <td>
                +94 011 2672 911 / 2672 912
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                phsrc2015@gmail.com
            </td>
            <td>
            </td>
        </tr>
    </table>
</div>

<div>
    <table>
        <tr>
            <th width="60%" style="font-weight: bold">
                Payment Received From:
            </th>
            <th width="40%" style="font-weight: bold">
            </th>
        </tr>
        <tr>
            <td>
                <?php echo $full_name; ?>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                <?php echo $email; ?>
            </td>
            <td>

            </td>
        </tr>

    </table>
</div>



<div>
    <table>
        <tr>
            <th colspan="4" width="100%" style="font-weight: bold">
                Payment Summary
            </th>
        </tr>
        <tr>
            <th width="40%" style="font-weight: bold">
                Description
            </th>
            <th width="20%" style="font-weight: bold">
                Quantity
            </th>
            <th width="20%" style="font-weight: bold">
                Unit Price (<?php echo strtoupper($currency); ?>)
            </th>
            <th width="20%" style="font-weight: bold">
                Line Total (<?php echo strtoupper($currency); ?>)
            </th>
        </tr>
        <tr>
            <td width="40%" >
                <?php echo $product_name; ?>
            </td>
            <td width="20%" >
                1.00
            </td>
            <td width="20%" >
                <?php echo number_format($product_fees, 2); ?>
            </td>
            <td width="20%" >
                <?php echo number_format($product_fees , 2); ?>
            </td>
        </tr>
        <tr>
            <th colspan="3" width="80%" style="font-weight: bold">
                TOTAL PAID (<?php echo strtoupper($currency); ?>)
            </th>
            <th colspan="4" width="20%" style="font-weight: bold">
                <?php echo number_format($amount, 2); ?>
            </th>
        </tr>
    </table>
</div>

<div>
    <table>
        <tr>
            <th width="60%" style="font-weight: bold">
                Transaction Details:
            </th>
            <th width="40%" style="font-weight: bold">
            </th>
        </tr>
        <tr>
            <td>
                Payment Method : Credit / Debit Card
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                Order ID : <?php echo $order_Id; ?>
            </td>
            <td>

            </td>
        </tr>
        <tr>
            <td>
                Date of Payment : <?php echo date("F j, Y", strtotime($last_updated_time)); ?>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                Amount (<?php echo $currency; ?>) : <?php echo number_format($amount, 2); ?>
            </td>
            <td>
            </td>
        </tr>
    </table>
</div>

<div>
    <table>
        <tr>
            <th width="100%">
                Thank you for your payment !
            </th>

        </tr>
    </table>
</div>

<div>
    <table>
        <tr>
            <th width="100%">
                Need help? Contact our support team at:
            </th>
        </tr>
        <tr>
            <td>
                +94 011 2672 911 / 2672 912
            </td>
        </tr>
        <tr>
            <td >
                phsrc2015@gmail.com
            </td>
        </tr>
    </table>
</div>


