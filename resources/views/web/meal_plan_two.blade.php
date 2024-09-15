@extends('web.master')
@section('content')
@include('web.header')
<style>
.checkout-section {
  background: #17ab52;
  padding: 16px 30px;
}

.checkout-section .tab-btn-checkout {
  background-color: #000;
  border: 1px solid #000;
  color: #fff;
  font-family: DINCond;
  font-size: 1.2rem;
  font-weight: 800;
  width: 100%;
  max-width: 10rem;
  padding: 10px;
  text-align: center;
  text-transform: uppercase;
  overflow: hidden;
}

.checkout-section .final-price-span {
  float: right;
  font-size: 1.2rem;
  font-family: DINPro;
  text-transform: uppercase;
  font-weight: 700;
  top: 10px;
  position: relative;
}
.btn-build-plan {
  background-color: #fff;
  letter-spacing: -1px;
  color: #000;
  border: 1px solid #fff;
  font-size: 18px;
  font-weight: 600;
  position: absolute;
  bottom: 1rem;
  transform: translate(-50%);
}
.meals-text {
  color: #fff;
  font-size: .9rem;
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 4;
  line-clamp: 4;
  -webkit-box-orient: vertical;
}

</style>
<!-- Include SweetAlert CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style type="text/css">
.accordion {
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.accordion:hover {
  background-color: #f0f0f0;
}

.panel {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease-out;
}

.panel.open {
  max-height: 1000px; /* Set a max height larger than the expected content */
}

</style>
   <section class="position-relative bg-dark text-white" style="
    background-image: url('/web/images/balance2_large.webp');
    background-size: cover;
    background-position: center;
">
  <div class="text-center py-5 bg-dark bg-opacity-50">
    <h1 class="fw-bold fonts">MOVE TOWARDS YOUR GOAL</h1>
  </div>
</section>

<style>
  .tips-container {
    height: 120px; /* Control the height of the container */
    overflow: hidden; /* Hide the overflow for the scrolling effect */
    position: relative;
  }

  .tips-list {
    position: absolute;
    animation: scrollTips 12s linear infinite; /* Smooth scrolling */
  }

  @keyframes scrollTips {
    0% {
      top: 100%;
    }
    100% {
      top: -100%;
    }
  }

  .bg-opacity-50 {
    background-color: rgba(0, 0, 0, 0.5);
  }
</style>


    <!-- <div class="bg-primary text-white py-4 text-center mb-5">
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
    </div> -->

    <section>
      <form id="meal-data-form" action="{{url('checkout')}}" method="post">
        @csrf
        <input type="hidden" name="start_date" value={{$start_date}}>
        <input type="hidden" name="end_date" value={{$end_date}}>
        <div class="container">
          <div class="row">
            <!-- <div class="col-md-6">
              <h6 class="fw-bold">Please select the Start date of the subscription plan <span class="fw-bold" style="color: red;">*</span></h6>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Select a date (Min 2 days ahead)" required>          
                </div>
            </div> <br><br>     -->
          <br><br><hr>
          <br>
          @php
              // Mapping the days like 'Saturday1' => 'Day1', 'Sunday1' => 'Day2', etc.
              $dayMapping = [
                  'Saturday1' => 'Day 1',
                  'Sunday1' => 'Day 2',
                  'Monday1' => 'Day 3',
                  'Tuesday1' => 'Day 4',
                  'Wednesday1' => 'Day 5',
                  'Thursday1' => 'Day 6',
                  'Friday1' => 'Day 7',
                  'Saturday2' => 'Day 1',
                  'Sunday2' => 'Day 2',
                  'Monday2' => 'Day 3',
                  'Tuesday2' => 'Day 4',
                  'Wednesday2' => 'Day 5',
                  'Thursday2' => 'Day 6',
                  'Friday2' => 'Day 7',
              ];
          @endphp
          @php
              use Carbon\Carbon;
              
              // Starting date
              $currentDate = Carbon::parse($start_date);
          @endphp
          @foreach ($results as $day => $data)
          @php
              // Use the mapped day if it exists, otherwise fallback to the original day
              $mappedDay = isset($dayMapping[$day]) ? $dayMapping[$day] : $day;
          @endphp
          @php
              // Use the mapped day if it exists, otherwise fallback to the original day
              $mappedDay = isset($dayMapping[$day]) ? $dayMapping[$day] : $day;

              // Skip if the current date is a Friday
              while ($currentDate->isFriday()) {
                  $currentDate->addDay();
              }

              // Store the formatted date for display
              $displayDate = $currentDate->format('F j, Y');

              // Increment the date for the next iteration
              $currentDate->addDay();
          @endphp
              <div class="mb-4">
                  <div class="meal-plan-row accordion">                    

                  <h2 class="fw-bold">{{ $mappedDay }}<br>
            <button type="button" style="font-size: 12px; padding: 2px 6px; border-radius: 4px;">{{ $displayDate }}</button>
        </h2>                                  <div class="d-flex align-items-center">
                          <div class="circle">
                              <div>
                                  <div class="fs-3 fw-bold" id="calories-{{ $day }}">{{ $data['calories'] }}</div> <!-- Calories -->
                                  <div class="fs-6">CAL</div>
                              </div>
                          </div>
                          <ul>
                              <li class="text-center">
                                  <div class="fs-5" id="protein-{{ $day }}">{{ $data['protein'] }}</div> <!-- Protein -->
                                  <div class="fs-6">Protein</div>
                              </li>
                              <li class="text-center">
                                  <div class="fs-5" id="carbs-{{ $day }}">{{ $data['carbs'] }}</div> <!-- Carbs -->
                                  <div class="fs-6">Carbs</div>
                              </li>
                              <li class="text-center">
                                  <div class="fs-5" id="fat-{{ $day }}">{{ $data['fat'] }}</div> <!-- Fat -->
                                  <div class="fs-6">Fat</div>
                              </li>
                          </ul>
                      </div>
                  </div>

                  <div class="panel">
                      <div class="row mt-4 py-50">
                        <!-- Display meals with category_id 3 in the first row -->
                        <div class="row">                          
                          @foreach ($data['meals']->where('category_id', 3) as $meal)
                              <div class="col-md-3 my-5 pe-5" id="meal-{{ $meal->menu_id }}">
                                  <div class="d-flex align-items-center justify-content-between">
                                      <h5 class="meals-days-title fw-bold">{{ $meal->menu }}</h5>
                                  </div>

                                  <div class="meals-days" style="background-color: 'white'">
                                      <img src="{{ $meal->media_file }}" class="meals-days-img-top" alt="{{ $meal->menu }}" />
                                      <div class="meals-days-body">
                                          <p class="meals-days-text">
                                              {{ $meal->calories }} CAL / {{ $meal->tdMProt }}g PRO / {{ $meal->tdMCarb }}g CARBS / {{ $meal->tdMFat }}g FAT
                                          </p>
                                          <!-- Display allergy warning -->
                                          <div class="allergy-warning">
                                              @if ($meal->hasAllergy)
                                                  <p style="color: red; font-weight: bold;">
                                                      This item contains {{ implode(', ', $meal->allergyNames) }}
                                                  </p>
                                              @endif
                                          </div>

                                          <div class="d-flex gap-2 mt-2">
                                              <button 
                                                  class="btn btn-light w-100 fw-bold replace-meal-btn" 
                                                  data-bs-toggle="modal"
                                                  data-bs-target="#ReplaceMeal"
                                                  data-day="{{ $day }}" 
                                                  data-meal-id="{{ $meal->menu_id }}" 
                                                  data-meal-type="{{ $meal->category_name }}"
                                                  data-category_id="{{ $meal->category_id }}" 
                                                  data-calories="{{ $meal->calories }}" 
                                                  data-protein="{{ $meal->tdMProt }}" 
                                                  data-carbs="{{ $meal->tdMCarb }}" 
                                                  data-fat="{{ $meal->tdMFat }}"
                                              >
                                                  Replace
                                              </button>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Hidden inputs for meal data -->
                                  <input type="hidden" name="meals[{{ $day }}][{{ $meal->menu_id }}][menu_id]" value="{{ $meal->menu_id }}">
                              </div>
                          @endforeach
                      </div>


                          <!-- Display meals with category_id 4 in the second row -->
                          <div class="row">
                              @foreach ($data['meals']->where('category_id', 4) as $meal)
                                  <div class="col-md-3 my-5 pe-5" id="meal-{{ $meal->menu_id }}">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="meals-days-title fw-bold">{{ $meal->menu }}</h5>
                                    </div>
                                    <div class="meals-days" style="background-color: 'white'">
                                        <img src="{{ $meal->media_file }}" class="meals-days-img-top" alt="{{ $meal->menu }}" />
                                        <div class="meals-days-body">
                                            <p class="meals-days-text">
                                                {{ $meal->calories }} CAL / {{ $meal->tdMProt }}g PRO / {{ $meal->tdMCarb }}g CARBS / {{ $meal->tdMFat }}g FAT
                                            </p>
                                          @if ($meal->hasAllergy)
                                              <p style="color: red; font-weight: bold;">
                                                  This item contains 
                                                  {{ implode(', ', $meal->allergyNames) }}
                                              </p>
                                          @endif

                                            <div class="d-flex gap-2 mt-2">
                                                <button 
                                                    class="btn btn-light w-100 fw-bold replace-meal-btn" 
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#ReplaceMeal"
                                                    data-day="{{ $day }}" 
                                                    data-meal-id="{{ $meal->menu_id }}" 
                                                    data-meal-type="{{ $meal->category_name }}"
                                                    data-category_id="{{ $meal->category_id }}" 
                                                    data-calories="{{ $meal->calories }}" 
                                                    data-protein="{{ $meal->tdMProt }}" 
                                                    data-carbs="{{ $meal->tdMCarb }}" 
                                                    data-fat="{{ $meal->tdMFat }}"
                                                >
                                                    Replace
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hidden inputs for meal data -->
                                    <input type="hidden" name="meals[{{ $day }}][{{ $meal->menu_id }}][menu_id]" value="{{ $meal->menu_id }}">
                                </div>
                              @endforeach
                              
                            <!-- Display the "Add More" buttons and other meal buttons -->
                            <div class="col-md-4 pe-5">
                                <button type="button" class="btn btn-primary w-full fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#AddMoreMeals" data-meal-type="meal" data-day="{{ $day }}" data-category_id="3">Add More Meals</button>
                                <div class="meals-meal-{{ $day }} mt-3"></div>
                                <button type="button" class="btn btn-primary w-full fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#AddBreakfast" data-meal-type="breakfast" data-day="{{ $day }}" data-category_id="2">Add Breakfast</button>
                                <div class="meals-breakfast-{{ $day }} mt-3"></div>
                                <button type="button" class="btn btn-primary w-full fw-bold mb-3" data-bs-toggle="modal" data-bs-target="#AddSnacks" data-meal-type="snack" data-day="{{ $day }}" data-category_id="4">Add Snacks</button>
                                <div class="meals-snack-{{ $day }} mt-3"></div>
                            </div> 
                          </div>

                      </div>
                  </div>
              </div>
          @endforeach

         <section class="sticky-checkout">
    <div class="container">
        <button name="submit" class="tab-btn-checkout" type="submit">
            CHECKOUT <i class="fas fa-arrow-right arrow"></i>
        </button>
        <span class="final-price-span">Total QR<b class="final-price">{{$meal_price}}</b></span>
    </div>
</section>

<style>
  .sticky-checkout {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100vw; /* Full viewport width */
      background-color: #fff;
      box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
      padding: 15px 0;
      z-index: 1000;
  }

  .sticky-checkout .container {
      max-width: 100vw; /* Ensures the content inside also stretches */
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px; /* Add padding to keep content away from edges */
  }

  .tab-btn-checkout {
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      align-items: center;
  }

  .tab-btn-checkout .arrow {
      margin-left: 5px;
      font-size: 1.2em; /* Adjust size as needed */
  }

  .final-price-span {
      font-size: 1.1em;
  }

  @media (min-width: 769px) {
      .final-price {
          margin-left: 5px;
          margin-right: 70px;
      }

      .tab-btn-checkout {
          margin-left: 70px;
      }
  }

  @media (max-width: 768px) {
      .sticky-checkout .container {
          flex-direction: column;
          align-items: stretch;
          padding: 0 10px; /* Adjust padding for smaller screens */
      }

      .tab-btn-checkout, .final-price-span {
          width: 100%;
          margin-bottom: 10px;
          text-align: center;
      }
  }
</style>
          <!-- Hidden fields for additional data -->
          <div id="dynamic-fields"></div>

          <!-- Hidden fields for additional data -->
        <input type="hidden" id="hidden-meal_id" name="meal_id" value="">
        <input type="hidden" id="hidden-meal_type" name="meal_type" value="">
        <input type="hidden" id="hidden-calories" name="calories" value="">
        <input type="hidden" id="hidden-protein" name="protein" value="">
        <input type="hidden" id="hidden-carbs" name="carbs" value="">
        <input type="hidden" id="hidden-fat" name="fat" value="">

          <!-- <a href="{{ url('checkout') }}" class="btn btn-success" style="margin-left: 33rem;">Checkout</a> -->
        </div>
          <input type="hidden" name="meal_id" value="{{ $meal_id }}">
          <input type="hidden" name="day" value="{{ $days }}">
      </form>      
    </section>

   
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

  <!-- ReplaceMeal Modal -->
  <div class="modal fade" id="ReplaceMeal" tabindex="-1" aria-labelledby="ReplaceMealLabel" aria-hidden="true" data-meal-type="meal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ReplaceMealLabel">Replace Meals</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="meal-options" class="list-group"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary replace-meal-submit" data-meal-type="meal">Replace</button>
        </div>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function() {

    var accordions = document.querySelectorAll('.accordion');

    accordions.forEach(function (accordion) {
      accordion.addEventListener('click', function () {
        this.classList.toggle('active');

        var panel = this.nextElementSibling;

        // Toggle the "open" class
        if (panel.classList.contains('open')) {
          panel.classList.remove('open');
          panel.style.maxHeight = null; // Set maxHeight to null when closing
        } else {
          panel.classList.add('open');
          panel.style.maxHeight = panel.scrollHeight + "px"; // Set maxHeight to the scrollHeight of the panel content
        }
      });
    });
    // Set up AJAX with CSRF token
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    // Event listener for showing modals
    $('.modal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        console.log('Raw event:', event);
        var mealType = button.data('meal-type');
        var day = button.data('day'); 
        var categoryId = button.data('category_id'); // Use 'category-id' here        

        var modal = $(this);

        if (mealType == 'meal') {
            mealType = 3;
        }
        if (mealType == 'snack') {
            mealType = 4;
        }

        // Convert day
        switch (day) {
            case 'Saturday1':
            case 'Saturday2':
                day = 1;
                break;
            case 'Sunday1':
            case 'Sunday2':
                day = 2;
                break;
            case 'Monday1':
            case 'Monday2':
                day = 3;
                break;
            case 'Tuesday1':
            case 'Tuesday2':
                day = 4;
                break;
            case 'Wednesday1':
            case 'Wednesday2':
                day = 5;
                break;
            case 'Thursday1':
            case 'Thursday2':
                day = 6;
                break;
            default:
                day = null; // Or handle unexpected values as needed
        }

        console.log('Meal Type:', mealType);
        console.log('Day:', day);
        console.log('Category ID:', categoryId);

        fetchMealOptions(mealType, day, categoryId, modal);
    });


    $('#AddMoreMeals, #AddBreakfast, #AddSnacks').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var day = button.data('day'); // Extract the day value from the triggering button
      var mealType = button.data('meal-type'); // Extract meal type

      // Store the day and meal type in the modal's save button or elsewhere if needed
      $(this).find('.save-meal').data('day', day);
      $(this).find('.save-meal').data('meal-type', mealType);
    });

    // Save selected meal options
    $('.save-meal').click(function() {
        event.preventDefault();
        // The existing logic will work as the fetched data is in a similar format
        var mealType = $(this).data('meal-type');
        var modal = $(this).closest('.modal');
        var selectedMeals = modal.find('input:checked');
        var day = $(this).data('day');
        var mealsContainer = $('.meals-' + mealType + '-' + day);

        // Initialize total nutritional values
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
                <div class="meal-item" data-meal-id="${mealId}">
                    ${mealLabel}
                    <input type="hidden" name="meals[${day}][${mealId}][menu_id]" value="${mealId}">
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

  $(document).on('click', '.replace-meal-btn', function() {
    event.preventDefault();
      var mealType = $(this).data('meal-type');
      var day = $(this).data('day');
      var categoryId = $(this).data('category_id');
      var modal = $('#ReplaceMeal'); // Modal ID
      var mealElement = $(this).closest('.col-md-3'); // Store the meal element to replace

      // Convert mealType
      mealType = mealType === 'Meals' ? 3 : 4;

      // Convert day
      switch (day) {
          case 'Saturday1':
          case 'Saturday2': day = 1; break;
          case 'Sunday1':
          case 'Sunday2': day = 2; break;
          case 'Monday1':
          case 'Monday2': day = 3; break;
          case 'Tuesday1':
          case 'Tuesday2': day = 4; break;
          case 'Wednesday1':
          case 'Wednesday2': day = 5; break;
          case 'Thursday1':
          case 'Thursday2': day = 6; break;
          default: day = null;
      }

      console.log('Meal Type =', mealType);
      console.log('Day =', day);
      console.log('Category ID =', categoryId);

      // Open the modal
      modal.modal('show');

      // Fetch meal options and pass mealElement to the success callback
      fetchMealOptions(mealType, day, categoryId, modal, mealElement);
  });

  // Function to fetch meal options
  function fetchMealOptions(mealType, day, categoryId, modal, mealElement) {
    $.ajax({
        url: "{{ url('fetch-generated-plans') }}", // Update with your new route
        method: 'POST',
        data: {
            meal_type: mealType,
            day: day,
            category_id: categoryId
        },
        success: function(response) {
            console.log(response); // Check if this logs the expected data
            var optionsContainer = modal.find('.list-group');
            optionsContainer.empty();

            response.forEach(function(plan) {
                optionsContainer.append(
                    '<div class="form-check">' +
                    '<input class="form-check-input" type="radio" name="selectedMeal" value="' + plan.menu_id + '" id="' + mealType + '-' + plan.menu_id + '" data-calories="' + plan.calories + '" data-protein="' + plan.tdMProt + '" data-carbs="' + plan.tdMCarb + '" data-fat="' + plan.tdMFat + '" data-menu="' + plan.menu + '" data-media_file="' + plan.media_file + '">' +
                    '<label class="form-check-label" for="' + mealType + '-' + plan.menu_id + '">' +
                    '<img src="' + plan.media_file + '" alt="' + plan.menu + '" style="width:50px;height:50px;"> ' +
                    plan.menu +
                    '</label>' +
                    '</div>'
                );
            });

            // Bind click event to replace the meal 
            modal.find('.replace-meal-submit').off('click').on('click', function() {
                var selectedMeal = optionsContainer.find('input[name="selectedMeal"]:checked');
                if (selectedMeal.length > 0) {
                    var newMealId = selectedMeal.val();
                    var mealContainerId = mealElement.attr('id'); // Get the ID of the meal element

                    // Make an AJAX request to fetch the meal details, including allergies
                    $.ajax({
                        url: "{{ url('/get-meal-data') }}/" + newMealId,
                        method: 'GET',
                        success: function(response) {
                          console.log("Full Response:", response);
                            if (response.status === 'success') {
                                var meal = response.meal;
                                var mealAllergies = meal.allergy_id ? meal.allergy_id.split(',').map(function(id) {
                                    return id.trim(); // Trim each allergy ID
                                }) : [];                                

                                var userAllergies = "{{ $allergy_ids }}".split(',').map(function(id) {
                                    return id.trim(); // Trim each user allergy ID
                                });                                

                                // Check if there's a match between meal allergies and user's selected allergies
                                var matchedAllergies = mealAllergies.filter(function(allergyId) {
                                    return userAllergies.includes(allergyId);
                                });

                                // Update the meal in the UI
                                mealElement.find('.meals-days-title').text(meal.menu);
                                mealElement.find('.meals-days-img-top').attr('src', meal.media_file).attr('alt', meal.menu);
                                mealElement.find('.meals-days-text').text(`${meal.calories} CAL / ${meal.tdMProt}g PRO / ${meal.tdMCarb}g CARBS / ${meal.tdMFat}g FAT`);
                                // Update allergy warning
                                if (matchedAllergies.length > 0) {
                                    // Fetch the names of the matched allergies
                                    var matchedAllergyNames = matchedAllergies.map(function(allergyId) {
                                        return response.allergy_name; // Assuming allergy_names is an object mapping allergy IDs to names
                                    });

                                    mealElement.find('.allergy-warning').html(`
                                        <p style="color: red; font-weight: bold;">
                                            This item contains ${matchedAllergyNames.join(', ')}
                                        </p>
                                    `);
                                } else {
                                    mealElement.find('.allergy-warning').html('');
                                }

                                // Update hidden input with new meal_id
                                var hiddenInput = $('#' + mealContainerId).find('input[type="hidden"]');
                                hiddenInput.val(newMealId);

                                // Close the modal
                                modal.modal('hide');
                            } else {
                                alert('Failed to fetch meal details');
                            }
                        },
                        error: function() {
                            alert('An error occurred while fetching meal details');
                        }
                    });
                } else {
                    alert('Please select a meal to replace.');
                }
            });

        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}



    // Handle the replacement confirmation
    $(document).on('click', '.confirm-replace-meal', function() {
      var modal = $('#ReplaceMeal');
      var selectedMeal = modal.find('input[name="replace-meal-option"]:checked');

      if (selectedMeal.length == 0) {
        alert('Please select a meal to replace.');
        return;
      }

      var day = modal.data('day');
      var mealId = modal.data('meal-id');
      var currentCalories = parseFloat(modal.data('calories')) || 0;
      var currentProtein = parseFloat(modal.data('protein')) || 0;
      var currentCarbs = parseFloat(modal.data('carbs')) || 0;
      var currentFat = parseFloat(modal.data('fat')) || 0;

      var selectedMealId = selectedMeal.val();
      var selectedMealCalories = parseFloat(selectedMeal.data('calories')) || 0;
      var selectedMealProtein = parseFloat(selectedMeal.data('protein')) || 0;
      var selectedMealCarbs = parseFloat(selectedMeal.data('carbs')) || 0;
      var selectedMealFat = parseFloat(selectedMeal.data('fat')) || 0;

      // Update the meal in the container
      var mealContainer = $('.meals-' + day);
      mealContainer.find('.meal-item').each(function() {
        if ($(this).data('meal-id') == mealId) {
          $(this).html(
            selectedMeal.data('menu') + ' - $' + selectedMeal.data('price') +
            '<img src="' + selectedMeal.data('media') + '" alt="' + selectedMeal.data('menu') + '" style="width:50px;height:50px;">'
          );
        }
      });

      // Update the nutritional values
      var newCalories = currentCalories - parseFloat($('#calories-' + day).text()) + selectedMealCalories;
      var newProtein = currentProtein - parseFloat($('#protein-' + day).text()) + selectedMealProtein;
      var newCarbs = currentCarbs - parseFloat($('#carbs-' + day).text()) + selectedMealCarbs;
      var newFat = currentFat - parseFloat($('#fat-' + day).text()) + selectedMealFat;

      updateNutritionalValues(day, newCalories, newProtein, newCarbs, newFat);

       // Update the mealData object
        if (mealData[day] && mealData[day][mealId]) {
            // Remove old meal data
            delete mealData[day][mealId];
        }

        // Add new meal data
        mealData[day][selectedMealId] = {
            menu: selectedMeal.data('menu'),
            calories: selectedMealCalories,
            protein: selectedMealProtein,
            carbs: selectedMealCarbs,
            fat: selectedMealFat
        };

        console.log("Updated mealData:", mealData);

      modal.modal('hide');
    });
  });
</script>
<script>
        $(document).ready(function() {
            // Calculate the date 2 days after the current date
            var currentDate = new Date();
            currentDate.setDate(currentDate.getDate() + 2);

            // Initialize the date picker with the minDate and beforeShowDay to disable Fridays
            $("#start_date").datepicker({
                minDate: currentDate,
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [day !== 5, ""]; // 5 corresponds to Friday
                },
                dateFormat: "yy-mm-dd"
            });
        });
    </script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Get the form element
    var form = document.getElementById('meal-data-form');

    // Collect data into arrays
    var mealData = {};

    // Collect hidden input values
    var inputs = form.querySelectorAll('input[type="hidden"]');
    inputs.forEach(function(input) {
        var name = input.name;
        var value = input.value;

        // Extract day and meal_id from input name
        var match = name.match(/meals\[(\w+)\]\[(\d+)\]\[menu_id\]/);
        if (match) {
            var day = match[1];
            var mealId = match[2];

            // Initialize array for day if not already
            if (!mealData[day]) {
                mealData[day] = [];
            }

            // Add meal_id to the array for the day
            if (!mealData[day].includes(mealId)) {
                mealData[day].push(mealId);
            }
        }
    });

    console.log(mealData);
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
