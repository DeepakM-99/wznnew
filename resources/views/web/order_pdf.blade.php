<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Custom Model Receipt - {{ $order->order_id }}</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        h2, h3 {
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td {
            background-color: #fafafa;
        }

        .header {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }

        .header img {
            width: 120px;
        }

        .header h2 {
            font-size: 20px;
            margin-top: 5px;
        }

        .billing-shipping {
            margin-bottom: 30px;
        }

        .billing-shipping h3 {
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .details {
            width: 100%;
        }

        .details td {
            padding: 8px;
        }

        .details th {
            padding: 8px;
            background-color: #f2f2f2;
        }

        /* Order Information */
        .order-info {
            text-align: right;
            margin-top: -80px;
            margin-bottom: 40px;
        }

        .order-info th {
            text-align: left;
        }

        .order-info td {
            text-align: right;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Header Section with Logo -->
    <div class="header">
        <img src="{{url('web/images/wznlogo.webp')}}" alt="WZN Logo">
        <h2>CUSTOM MODEL RECEIPT</h2>
    </div>

    <!-- Billing & Shipping Information -->
    <div class="billing-shipping">
        <h3>Billing & Shipping</h3>
        <table class="details">
            <tr>
                <td>
                    {{ "WZN" }}<br>
                    {{ "Test Address" }}<br>
                    {{ "wzn@gmail.com" }}<br>
                    {{ "+91 1111222232" }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Order Information -->
    <table class="order-info">
        <tr>
            <th>Order Number:</th>
            <td>{{ $order->order_id }}</td>
        </tr>
        <tr>
            <th>Order Date:</th>
            <td>2024-09-25</td>
        </tr>
    </table>

    <!-- Menu Details -->
    <div class="details">
        <h3>Ordered Menu</h3>
        <table>
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Week</th>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menu as $menuItem)
                    <tr>
                        <td>
                            {{ $menuItem->day == 1 ? 'Saturday' : 
                               ($menuItem->day == 2 ? 'Sunday' : 
                               ($menuItem->day == 3 ? 'Monday' : 
                               ($menuItem->day == 4 ? 'Tuesday' : 
                               ($menuItem->day == 5 ? 'Wednesday' : 
                               ($menuItem->day == 6 ? 'Thursday' : 
                               ($menuItem->day == 7 ? 'Friday' : 'Unknown Day')))))) }}
                        </td>
                        <td>{{ $menuItem->week }}</td>
                        <td>{{ $menuItem->menu }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
