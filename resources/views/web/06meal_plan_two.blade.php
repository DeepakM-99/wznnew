@extends('web.master')
@section('content')
@include('web.header')

<section class="position-relative bg-dark text-white" style="
            background-image: url('/web/images/balance2_large.webp');
            background-size: cover;
            background-position: center;
          ">
      <div class="text-center py-5 bg-dark bg-opacity-50">
        <h1 class="display-4 fw-bold">TIPS TOWARDS YOUR GOAL</h1>
        <ul class="mt-2 list-unstyled">
          <li>
            • Higher protein intakes can result in increased fat loss and
            assist with lean body mass retention
          </li>
          <li>• Protein suppresses ghrelin (the satiety hormone)</li>
          <li>
            • We suggest carbohydrate cycling to assist with compliance when
            in a deficit
          </li>
          <li>
            • Don’t eat the foods you love every day, just limit them. This
            will assist with compliance
          </li>
          <li>• Have a dedicated treat/cheat day</li>
          <li>
            • Water is important (aim for 3-4 litres a good starting point
            if you are beginning to increase this daily)
          </li>
        </ul>
      </div>
    </section>

    <div class="bg-primary text-white py-4 text-center mb-5">
      <div class="d-flex justify-content-center gap-4">
        <div class="d-flex align-items-center gap-2">
          <span class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center"
            style="width: 2rem; height: 2rem">1</span>
          <span>DETAILS</span>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span
            class="bg-secondary text-secondary-foreground rounded-circle d-flex align-items-center justify-content-center"
            style="width: 2rem; height: 2rem">2</span>
          <span>MEAL PLAN</span>
        </div>
        <div class="d-flex align-items-center gap-2">
          <span
            class="bg-secondary text-secondary-foreground rounded-circle d-flex align-items-center justify-content-center"
            style="width: 2rem; height: 2rem">3</span>
          <span>CHECKOUT</span>
        </div>
      </div>
    </div>

    <section>
      <div class="container">
      @foreach ($results as $day => $data)
        <div class="mb-4">
          <div class="meal-plan-row">
            <h2 class="fw-bold">{{ $day }}</h2>
            <div class="d-flex align-items-center">
              <div class="circle">
                <div>
                  <div class="fs-3 fw-bold" id="calories-{{ $day }}1">{{ $data['calories'] }}</div> <!-- Calories -->
                  <div class="fs-6">CAL</div>
                </div>
              </div>
              <ul>
                <li class="text-center">
                  <div class="fs-5" id="protein-{{ $day }}1">{{ $data['protein'] }}</div> <!-- Protein -->
                  <div class="fs-6">Protein</div>
                </li>
                <li class="text-center">
                  <div class="fs-5" id="carbs-{{ $day }}1">{{ $data['carbs'] }}</div> <!-- Carbs -->
                  <div class="fs-6">Carbs</div>
                </li>
                <li class="text-center">
                  <div class="fs-5" id="fat-{{ $day }}1">{{ $data['fat'] }}</div> <!-- Fat -->
                  <div class="fs-6">Fat</div>
                </li>
              </ul>
            </div>
          </div>


          
          <div class="row mt-4 py-50">
            @foreach ($data['meals'] as $meal)
            <div class="col-md-4 mb-4 pe-5">
              <div class="d-flex align-items-center justify-content-between">
                <h5 class="meals-days-title fw-bold">{{ $meal->menu }}</h5>
                <p class="meals-days-text text-muted">${{ $meal->selling_price }}</p>
              </div>

              <div class="meals-days">
                <img src="{{ $meal->media_file }}" class="meals-days-img-top" alt="{{ $meal->menu }}" />
                <div class="meals-days-body">
                  <p class="meals-days-text">
                    {{ $meal->calories }} CAL / {{ $meal->tdMProt }}g PRO / {{ $meal->tdMCarb }}g CARBS / {{ $meal->tdMFat }}g FAT
                  </p>
                  <div class="d-flex gap-2 mt-2">
                    <button class="btn btn-light w-100 fw-bold">SMALL</button>
                    <button class="btn btn-light w-100 fw-bold">LARGE</button>
                  </div>
                  <div class="d-flex gap-2 mt-2">
                    <button class="btn btn-primary w-100 fw-bold">{{ $meal->sweet_or_salad }}</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            
            
            <div class="col-md-4 pe-5">
              <button class="btn btn-primary w-full fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#AddMoreMeals" data-meal-type="meal" data-day="{{ $day }}1" data-category_id="3" data-gender="{{ $gender }}">Add More Meals</button>
              <div class="meals-meal-{{ $day }}1 mt-3"></div>
              <button class="btn btn-primary w-full fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#AddBreakfast" data-meal-type="breakfast" data-day="{{ $day }}1" data-category_id="2" data-gender="{{ $gender }}">Add Breakfast</button>
              <div class="meals-breakfast-{{ $day }}1 mt-3"></div>
              <button class="btn btn-primary w-full fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#AddSnacks" data-meal-type="snack" data-day="{{ $day }}1" data-category_id="4" data-gender="{{ $gender }}">Add Snacks</button>
              <div class="meals-snack-{{ $day }}1 mt-3"></div>
            </div> 
          </div>
        </div>
      @endforeach
      </div>
    </section>

    <section class="block-section block-social gap-3">
      <div class="row text-center">
        <div class="col-12">
          <div
            class="container d-flex justify-content-center align-items-center"
          >
            <h5 class="follow-us">FOLLOW US:</h5>

            <div class="social-icons">
              <a href="">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- AddMoreMeals Modal -->
<div class="modal fade" id="AddMoreMeals" tabindex="-1" aria-labelledby="AddMoreMealsLabel" aria-hidden="true" data-meal-type="meal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AddMoreMealsLabel">Add More Meals</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="meal-options" class="list-group"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-meal" data-meal-type="meal">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- AddBreakfast Modal -->
<div class="modal fade" id="AddBreakfast" tabindex="-1" aria-labelledby="AddBreakfastLabel" aria-hidden="true" data-meal-type="breakfast">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AddBreakfastLabel">Add Breakfast</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="breakfast-options" class="list-group"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-meal" data-meal-type="breakfast">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- AddSnacks Modal -->
<div class="modal fade" id="AddSnacks" tabindex="-1" aria-labelledby="AddSnacksLabel" aria-hidden="true" data-meal-type="snack">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="AddSnacksLabel">Add Snacks</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="snack-options" class="list-group"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-meal" data-meal-type="snack">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  // Set up AJAX with CSRF token
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // Event listener for showing modals
  $('.modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var mealType = button.data('meal-type');
    var day = button.data('day');

    var categoryId = button.data('category_id');
    var gender = button.data('gender');
    var modal = $(this);

    fetchMealOptions(mealType, day, categoryId, gender, modal);
  });

  $('#AddMoreMeals, #AddBreakfast, #AddSnacks').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var day = button.data('day'); // Extract the day value from the triggering button
    var mealType = button.data('meal-type'); // Extract meal type

    // Store the day and meal type in the modal's save button or elsewhere if needed
    $(this).find('.save-meal').data('day', day);
    $(this).find('.save-meal').data('meal-type', mealType);
  });

  // Function to fetch meal options
  function fetchMealOptions(mealType, day, categoryId, gender, modal) {
    $.ajax({
      url: '{{ url('meal-options') }}', // Update with your route
      method: 'POST',
      data: {
        meal_type: mealType,
        day: day,
        category_id: categoryId,
        gender: gender
      },
      success: function(response) {
         console.log(response); // Check if this logs the expected data
         var optionsContainer = modal.find('.list-group');
         optionsContainer.empty();
         response.forEach(function(option) {
           optionsContainer.append(
             '<div class="form-check">' +
             '<input class="form-check-input" type="checkbox" value="' + option.id + '" id="' + mealType + '-' + option.id + '" data-calories="' + option.calories + '" data-protein="' + option.tdMProt + '" data-carbs="' + option.tdMCarb + '" data-fat="' + option.tdMFat + '">' +
             '<label class="form-check-label" for="' + mealType + '-' + option.id + '">' +
             '<img src="' + option.media_file + '" alt="' + option.menu + '" style="width:50px;height:50px;"> ' +
             option.menu + ' - $' + option.selling_price +
             '</label>' +
             '</div>'
           );
         });
       },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  }

  // Save selected meal options
  // Save selected meal options
$('.save-meal').click(function() {
    var mealType = $(this).data('meal-type');
    var modal = $(this).closest('.modal');
    var selectedMeals = modal.find('input:checked');
    var day = $(this).data('day'); // Get the day value dynamically
    var mealsContainer = $('.meals-' + mealType + '-' + day);

    // Initialize total nutritional values based on existing ones
    let currentCalories = parseFloat($('#calories-' + day).text()) || 0;
    let currentProtein = parseFloat($('#protein-' + day).text()) || 0;
    let currentCarbs = parseFloat($('#carbs-' + day).text()) || 0;
    let currentFat = parseFloat($('#fat-' + day).text()) || 0;

    selectedMeals.each(function() {
        var mealId = $(this).val();
        var mealLabel = $(this).siblings('label').html();

        var mealCalories = parseFloat($(this).data('calories'));
        var mealProtein = parseFloat($(this).data('protein'));
        var mealCarbs = parseFloat($(this).data('carbs'));
        var mealFat = parseFloat($(this).data('fat'));

        // Add to current values
        currentCalories += mealCalories;
        currentProtein += mealProtein;
        currentCarbs += mealCarbs;
        currentFat += mealFat;

        var mealBlock = `
            <div class="meal-item">
                ${mealLabel}
            </div>
        `;

        mealsContainer.append(mealBlock);
    });

    // Update the day totals
    updateNutritionalValues(day, currentCalories, currentProtein, currentCarbs, currentFat);

    // Close the modal
    modal.modal('hide');
});


  // Function to update the nutritional values for the day
  function updateNutritionalValues(day, calories, protein, carbs, fat) {
    $('#calories-' + day).text(calories.toFixed(0)); // Update calories
    $('#protein-' + day).text(protein.toFixed(1)); // Update protein
    $('#carbs-' + day).text(carbs.toFixed(1)); // Update carbs
    $('#fat-' + day).text(fat.toFixed(1)); // Update fat
    console.log("Updated nutritional values for " + day + ": Calories=" + calories + ", Protein=" + protein + ", Carbs=" + carbs + ", Fat=" + fat);
}



  // Utility function to capitalize the first letter
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
});


  // Utility function to capitalize the first letter
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }
</script>

@endsection