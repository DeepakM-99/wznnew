@extends('layouts.app')
@section('style')
<!-- CSS -->
@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Orders List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Orders</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Order Details</h3>
            <div class="card-tools">
              <!-- Button for generating CSV of all orders -->
              <a href="{{ url('admin/export-order-csv') }}" class="btn btn-success btn-sm">Export CSV</a>
            </div>
          </div>
          <br>


          <!-- /.card-header -->
          <div class="card-body" style="overflow:scroll;">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>OrderId</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Delivery Type</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
              </tr>
              </thead>
              <tbody>
                @foreach($data as $order)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>#{{ $order->order_id }}</td>
                  <td>{{ $order->meal_name }}</td>
                  <td>{{ $order->order_amount }}</td>
                  <td>{{ $order->status }}</td>
                  <td>{{ $order->order_status }}</td>
                  <!-- <td>
                    <a class="btn btn-info btn-sm" href="{{ url('admin/export-order-pdf', $order->order_id) }}" title="Generate PDF"><i class="fas fa-file-pdf"></i></a>
                  </td> -->
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
