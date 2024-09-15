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
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>#63005</td>
                    <td>Product name</td>
                    <td>100.00</td>   
                    <td>Pick Up</td>   
                    <td>Pending</td>                    
                    <td>
                      <a class="btn btn-info btn-sm" href="#" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                  </tr>                  
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
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


