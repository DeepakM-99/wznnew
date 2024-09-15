@extends('web.master')
@section('content')
@include('web.header')
<!-- Include SweetAlert CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Meals box style */
    .meals-days {
        border: 1px solid #e0e0e0;
        padding: 15px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
        border-radius: 4px; /* Updated to 4px */
    }
    .meals-days:hover {
        transform: translateY(-5px);
    }

    /* Image styling */
    .meals-days-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 4px; /* Updated to 4px */
        margin-bottom: 10px;
    }

    /* Box text alignment */
    .meals-days-body {
        text-align: left;
    }

    /* Category button spacing */
    .nav-tabs .nav-item {
        margin-right: 10px; /* Updated spacing */
    }

    /* Responsive layout */
    @media (max-width: 768px) {
        .meals-days {
            margin-bottom: 20px;
        }
    }

    /* Two columns per row on mobile */
    @media (max-width: 576px) {
        .col-md-4 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    /* Adjust spacing between the tab categories and boxes */
    .tab-content {
        margin-top: 20px; /* Consistent spacing between categories and boxes */
    }
</style>

<div class="container mt-5">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs gap-3 border-0" id="myTab" role="tablist">
        @foreach ($categories as $index => $category)
            <li class="nav-item" role="presentation">
                <button class="btn btn-light {{ $index == 0 ? 'active' : '' }}" id="category-{{ $category->category_id }}-tab" data-bs-toggle="tab" data-bs-target="#category-{{ $category->category_id }}" type="button"
                  role="tab" aria-controls="category-{{ $category->category_id }}" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                  {{ $category->category_name }}
                </button>
            </li>
        @endforeach
    </ul><br>

    <!-- Tab panes -->
    <div class="tab-content" id="myTabContent">
        @foreach ($categories as $index => $category)
            <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="category-{{ $category->category_id }}" role="tabpanel" aria-labelledby="category-{{ $category->category_id }}-tab">
                <section>
                    <div class="container">
                        <div class="row mt-4">
                            @foreach ($food_menus as $food_menu)
                                @if ($food_menu->category_id == $category->category_id)
                                    <div class="col-md-4 mb-4">
                                        <div class="meals-days" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                                             data-menu="{{ $food_menu->menu }}" 
                                             data-english_description="{{ $food_menu->english_description }}" 
                                             data-calories="{{ $food_menu->calories }}" 
                                             data-protein="{{ $food_menu->tdMProt }}" 
                                             data-carbs="{{ $food_menu->tdMCarb }}" 
                                             data-fat="{{ $food_menu->tdMFat }}" 
                                             data-image="{{ $food_menu->media_file }}" 
                                             data-selling_price="{{ $food_menu->selling_price }}"
                                             data-sweet-or-salad="{{ $food_menu->sweet_or_salad }}"
                                             data-english_text="{{ $food_menu->english_text }}"
                                             data-menu_id="{{ $food_menu->menu_id }}">
                                            <img src="{{ $food_menu->media_file }}" class="meals-days-img-top" alt="{{ $food_menu->menu }}" />
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="meals-days-title fw-bold">{{ $food_menu->menu }}</h5>
                                                <p class="meals-days-text text-muted">{{ $food_menu->selling_price }}</p> <!-- Removed $ symbol -->
                                            </div>
                                            <div class="meals-days-body">
                                                <p class="meals-days-text">
                                                    {{ $food_menu->calories }} CAL / {{ $food_menu->tdMProt }}g PRO / {{ $food_menu->tdMCarb }}g CARBS / {{ $food_menu->tdMFat }}g FAT
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </div>
</div><br><br>

<section class="bg-dark text-white py-4" style="background-color:black !important;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <h5 class="mb-0">Follow Us</h5>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var menu = button.data('menu');
        var english_description = button.data('english_description');
        var calories = button.data('calories');
        var protein = button.data('protein');
        var carbs = button.data('carbs');
        var fat = button.data('fat');
        var image = button.data('image');
        var selling_price = button.data('selling_price');
        var sweetOrSalad = button.data('sweet-or-salad');
        var english_text = button.data('english_text');
        var menu_id = button.data('menu_id');

        var modal = $(this);
        modal.find('#modalMenuTitle').text(menu);
        modal.find('#modalMenuDescription').text(english_description);
        modal.find('#modalProtein').text(protein + 'g');
        modal.find('#modalCarbs').text(carbs + 'g');
        modal.find('#modalFat').text(fat + 'g');
        modal.find('#modalImage').attr('src', image);
        modal.find('#modalMenuTitle2').text(menu);
        modal.find('#modalPrice').text(selling_price); // Removed $ symbol
        modal.find('#modalNutrients').text(calories + ' CAL / ' + protein + 'g PRO / ' + carbs + 'g CARBS / ' + fat + 'g FAT');
        modal.find('#modalSweetOrSalad').text(sweetOrSalad);
        modal.find('#modalIngredients').text(english_text);
        modal.find('#modalMenuId').val(menu_id);
    });
});
</script>
<script>
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}'
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}'
    });
@endif
</script>
@endsection