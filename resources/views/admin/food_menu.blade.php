@extends('layouts.app')
@section('style')
<!-- CSS -->
<style>
  .custom-margin {
    margin-left: 10px; /* Adjust the value as needed */
}
</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Food Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Food Menu</li>
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
              <h3 class="card-title">Food Menu Details</h3>
            </div>
          <br>
          <a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#myModal" style="margin-left:25px;width: 70px;"><i class="fas fa-plus"></i> Add</a>
              
            <!-- /.card-header -->
            <div class="card-body" style="overflow:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Menu Name</th>
                  <th>Calories</th>
                  <!-- <th>Selling Price</th>
                  <th>Day</th> -->
                  <!-- <th>Category</th> -->
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $menu)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $menu->menu}}</td>
                      <td>{{ $menu->calories }}</td>
                      <!-- <td>{{ $menu->selling_price }}</td>
                      <td>{{ $menu->day }}</td> -->
                      <!-- <td>{{ $menu->category_name }}</td> -->
                      <td>
                        <button type="button" class="btn btn-sm btn-{{ $menu->is_active ? 'success' : 'danger' }} toggle-status-btn" data-menu-id="{{ $menu->menu_id }}" data-active="{{ $menu->is_active ? 'true' : 'false' }}">
                            {{ $menu->is_active ? 'Active' : 'Inactive' }}
                        </button>                      
                      </td>
                      <!-- <td>
                        <a class="btn btn-info btn-sm" href="#" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-sm" href="#" title="Delete"><i class="fas fa-trash"></i></a>
                      </td> -->
                      <td>
                          <a href="#" class="btn btn-info btn-sm edit-button"
                              data-id="{{ $menu->menu_id }}"
                              data-menu="{{ $menu->menu }}"
                              data-menu_arabic="{{ $menu->menu_arabic }}"
                              data-category_id="{{ $menu->category_id }}"
                              data-calories="{{ $menu->calories }}"
                              data-cooking_instruction="{{ $menu->cooking_instruction }}"
                              data-allergy_id="{{ $menu->allergy_id }}"
                              data-type="{{ $menu->type }}"
                              data-item_id="{{ $menu->item_id }}"
                              data-tdMCarb="{{ $menu->tdMCarb }}"
                              data-tdMFat="{{ $menu->tdMFat }}"
                              data-tdMFiber="{{ $menu->tdMFiber }}"
                              data-tdMProt="{{ $menu->tdMProt }}"
                              data-english_text="{{ $menu->english_text }}"
                              data-arabic_text="{{ $menu->arabic_text }}"
                              data-english_description="{{ $menu->english_description }}"
                              data-arabic_description="{{ $menu->arabic_description }}"
                              data-is_active="{{ $menu->is_active }}"
                              data-media_file="{{ $menu->media_file }}">
                                <i class="fas fa-pencil-alt"></i> Update
                            </a>
                                  @php
                                    $parameter= encrypt($menu->menu_id);
                                  @endphp
                        <a href="{{ url('admin/deletefoodmenu', $parameter) }}" class="btn btn-danger btn-sm Confirm"><i class="fas fa-trash"></i> Delete</a>
                  
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

      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog" style="max-width: 60%;"
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add/Update Food Menu</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="menuForm" action="{{ route('admin.food-menu') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="menu_id" name="menu_id">
              <input type="hidden" id="existing_media_file" name="existing_media_file">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label>Category: *</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="category_id" name="category_id" required>
                        <option selected>Nothing Selected</option>
                        @foreach ($category as $cat)
                          <option value="{{ $cat->category_id }}">{{ $cat->category_name }}</option>
                        @endforeach
                      </select>                  
                    </div>
                  </div>  
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Menu Item Name: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="menu" name="menu" required>               
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-3">
                      <label>Menu Item Name (Arabic): *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="menu_arabic" name="menu_arabic" required>               
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-md-3">
                      <label>Ingredients: *</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="item_id" name="item_id[]" required multiple>
                        <option selected>Nothing Selected</option>
                        @foreach ($inventory as $item)
                        {{ $item->item_id }}
                          <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                        @endforeach
                      </select>                  
                    </div>
                  </div>  
                  <br>
                 {{-- <div class="row">
                    <div class="col-md-3">
                      <label>Allergy: *</label>
                    </div>
                    <div class="col-md-9">
                      <select class="form-control" id="allergy_id" name="allergy_id[]" required multiple>
                        <option selected>Nothing Selected</option>
                        @foreach ($allergy as $item)
                          <option value="{{ $item->allergy_id }}">{{ $item->allergy_name }}</option>
                        @endforeach
                      </select>                  
                    </div>
                  </div> --}}
                  <br>
    
                  <div class="row">
                    <div class="col-md-12">
                    <label>KCAL per gram: </label>
                    <div id="Gendertable" class="form-group row m-b-10">
                            <table width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Calories ( Kcal )</th>
                                        <th class="text-nowrap">Carbs (g)</th>
                                        <th class="text-nowrap">Fat (g)</th>
                                        <th class="text-nowrap">Protien (g)</th>
                                        <th class="text-nowrap">Fiber (g)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="with-form-control"><input type="text" id="calories" name="calories" class="form-control" data-parsley-type="number"></td>
                                        <td class="with-form-control"><input type="text" id="tdMCarb" name="tdMCarb" class="form-control" data-parsley-type="number"></td>
                                        <td class="with-form-control"><input type="text" id="tdMFat" name="tdMFat" class="form-control" data-parsley-type="number"></td>
                                        <td class="with-form-control"><input type="text" id="tdMProt" name="tdMProt" class="form-control" data-parsley-type="number"></td>
                                        <td class="with-form-control"><input type="text" id="tdMFiber" name="tdMFiber" class="form-control" data-parsley-type="number"></td>
                                    </tr>
                                    
                                </tbody>

                            </table>
                        </div>
                  </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                      <label>English Text: *</label>
                    </div>
                    <div class="col-md-9">
                      <textarea type="text" class="form-control" id="english_text" name="english_text" required></textarea>             
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                      <label>Arabic Text: *</label>
                    </div>
                    <div class="col-md-9">
                      <textarea type="text" class="form-control" id="arabic_text" name="arabic_text" required></textarea>               
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                      <label>English Description: *</label>
                    </div>
                    <div class="col-md-9">
                    <textarea type="text" class="form-control" id="english_description" name="english_description" required></textarea> 
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                      <label>Arabic Description: *</label>
                    </div>
                    <div class="col-md-9">
                      <textarea type="text" class="form-control" id="arabic_description" name="arabic_description" required></textarea>
                    </div>
                </div>
                <br>
                
                <div class="row">
                    <div class="col-md-3">
                      <label>Cooking instructions: *</label>
                    </div>
                    <div class="col-md-9">
                      <textarea type="text" class="form-control" id="cooking_instruction" name="cooking_instruction" required></textarea>             
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                      <label>Media File: *</label>
                    </div>
                    <div class="col-md-9">
                      <input type="file" class="form-control" id="media_file" name="media_file">  
                      <img id="image_preview" src="" alt="Image Preview" style="display:none; max-height: 100px;">             
                    </div>
                  </div>
                <br>
                <div class="row">
                    
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <button type="button" name="cancel" class="btn btn-primary" style="margin-left: 10px;" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
              </form> 
              </div>
            </div>           
          </div> 
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  
@endsection

@section('scripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    @if (session('message'))
      $(document).Toasts('create', {
        class: 'bg-success',
        title: 'Success',
        body: '{{ session('message') }}'
      });
    @endif

    $(document).on('click', '.edit-button', function () {
            var menuId = $(this).data("id");
            var menu = $(this).data("menu");
            var menu_arabic = $(this).data("menu_arabic");
            var categoryId = $(this).data("category_id");
            var calories = $(this).data("calories");
            var cookingIns = $(this).data("cooking_instruction");
            var allergy_id = $(this).data("allergy_id");
            var item_id = $(this).data("item_id");
            var type = $(this).data("type");
            // var sweetOrSalad = $(this).data("sweet_or_salad");
            var tdMCarb = $(this).data("tdmcarb");
            var tdMFat = $(this).data("tdmfat");
            var tdMFiber = $(this).data("tdmfiber");
            var tdMProt = $(this).data("tdmprot");
            var englishText = $(this).data("english_text");
            var arabicText = $(this).data("arabic_text");
            var englishDescription = $(this).data("english_description");
            var arabicDescription = $(this).data("arabic_description");
            var media_file = $(this).data('media_file');
            // var isActive = $(this).data("is_active");

            $("#menu_id").val(menuId);
            $("#menu").val(menu);
            $("#menu_arabic").val(menu_arabic);
            $("#category_id").val(categoryId);
            $("#calories").val(calories);
            $("#cooking_instruction").val(cookingIns);

            // Handle allergy_id: check if it's a string and split if needed
		    // if (allergy_id) {
		    //     var allergyArray = String(allergy_id).includes(',') ? allergy_id.split(',') : [allergy_id];
		    //     $("#allergy_id").val(allergyArray);  // Set as array even if single or multiple
		    // } else {
		    //     $("#allergy_id").val([]);  // Clear selection if no allergy_id
		    // }
        if (item_id) {
		        var itemId = String(item_id).includes(',') ? item_id.split(',') : [item_id];
		        $("#item_id").val(itemId);  // Set as array even if single or multiple
		    } else {
		        $("#item_id").val([]);  // Clear selection if no allergy_id
		    }

            // Split comma-separated values and set the selected options
            // var allergyArray = allergy_id.split(',');
            // $("#allergy_id").val(allergyArray);
            // var itemArray = item_id.split(',');
            // $("#item_id").val(itemArray);

            // $("#sweet_or_salad").val(sweetOrSalad);
            $("#tdMCarb").val(tdMCarb);
            $("#type").val(type);
            $("#tdMFat").val(tdMFat);
            $("#tdMFiber").val(tdMFiber);
            $("#tdMProt").val(tdMProt);
            $("#english_text").val(englishText);
            $("#arabic_text").val(arabicText);
            $("#english_description").val(englishDescription);
            $("#arabic_description").val(arabicDescription);
        $('#existing_media_file').val(media_file);
            
            if (media_file) {
            $('#image_preview').attr('src', media_file).show();
        } else {
            $('#image_preview').hide();
        }

          $('#menuForm').attr('action', '{{ route("admin.updatefoodmenu") }}');
          $('#myModal').modal('show');
        });

  document.querySelectorAll('.toggle-status-btn').forEach(button => {
    button.addEventListener('click', function() {
        let isActive = this.getAttribute('data-active') === 'true' ? false : true; // Toggle the current status
        let menuId = this.getAttribute('data-menu-id');

        fetch("{{ route('admin.update-status') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                menu_id: menuId,
                is_active: isActive
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                // Update button appearance
                button.setAttribute('data-active', isActive.toString());
                button.classList.toggle('btn-success');
                button.classList.toggle('btn-danger');
                button.textContent = isActive ? 'Active' : 'Inactive';
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

  $(document).on('click', '.Confirm', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log("Delete URL:", url); // Debugging log

        Swal.fire({
            title: 'Are you sure?',
            text: "It will permanently delete this menu!",
            type: 'warning', // Use 'type' instead of 'icon'
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) { // Use 'result.value' instead of 'result.isConfirmed'
                console.log("Confirmed, redirecting to:", url); // Debugging log
                window.location.href = url;
            }
        });
        
    });
    });
</script>
@endsection

