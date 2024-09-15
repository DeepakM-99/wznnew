@extends('web.master')
@section('content')
@include('web.index_header')
<!-- Include SweetAlert CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<section>
      <div
        id="carouselExampleDark"
        class="carousel carousel-dark slide"
        data-bs-ride="carousel"
      >
        <div class="carousel-indicators cus-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleDark"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleDark"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleDark"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img
              src="{{url('/web/images/banner_new_sm.webp')}}"
              class="d-block w-100"
              alt="..."
            />
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img
              src="{{url('/web/images/banner_new_sm.webp')}}"
              class="d-block w-100"
              alt="..."
            />
          </div>
          <div class="carousel-item">
            <img
              src="{{url('/web/images/banner_new_sm.webp')}}"
              class="d-block w-100"
              alt="..."
            />
          </div>
        </div>
        <button
          class="carousel-control-prev cus-prev"
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next cus-next"
          type="button"
          data-bs-target="#carouselExampleDark"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </section>

    <section class="bg-second text-center py-50">
      <div class="container">
        <h2 class="head-value mb-5">HOW IT WORKS</h2>
        <div class="row justify-content-center">
          <div class="col-sm-3">
            <div class="how-it-work">
              <h3>60+</h3>
              <p>
                A huge and constantly changing menu with two size options, all
                made locally and delivered by us!
              </p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="how-it-work">
              <h3>Save</h3>
              <p>
                The more you order the larger the discount. Save up to 15% off
                all main menu meals.
              </p>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="how-it-work">
              <h3>Easy</h3>
              <p>
                Simply order any time before midnight Thursday and let our chefs
                do the rest! vered by us!
              </p>
            </div>
          </div>
        </div>
        <div class="text-center mt-5">
          <a href="{{url('howitworks')}}" class="btn solid green-lite">More Info</a>
        </div>
      </div>
    </section>

    <section class="cus-gmd">
      <div class="container">
        <h2>WHY WZN?</h2>
        <div class="row justify-content-center">
          <div class="col-md-8 col-sm-10 col-12">
            <p class="text-center">
              When it comes to food, Canberra sets the bar high. We punch well
              above our weight and we don't <br />
              settle for anything less than excellent.<br /><br />100% locally
              owned and operated, WZN is by Canberra for Canberra (and the
              surrounding <br />
              regions). We are proud to add to the local reputation for
              outstanding food by making our meals <br />
              bigger including using more fresh ingredients, more protein and a
              far greater range of flavours <br />
              than our competitors.
            </p>
          </div>
        </div>
      </div>
      <div id="cmd-carousel" class="owl-carousel owl-theme">
        <div class="item">
          <img src="{{url('/web/images/meals/barra_sml_600x469.png')}}" alt="" />
        </div>
        <div class="item">
          <img src="{{url('/web/images/meals/larb_sml_600x469 (1).png')}}" alt="" />
        </div>
        <div class="item">
          <img src="{{url('/web/images/meals/larb_sml_600x469.png')}}" alt="" />
        </div>
        <div class="item">
          <img src="{{url('/web/images/meals/newsoba_sml_600x469.jpg')}}" alt="" />
        </div>
        <div class="item">
          <img src="{{url('/web/images/meals/pepperberry_sml_600x469.png')}}" alt="" />
        </div>
        <div class="item">
          <img src="{{url('/web/images/meals/pokesml_600x469.png')}}" alt="" />
        </div>
        <div class="item">
          <img
            src="{{url('/web/images/meals/steakdiane_400ed23e-3c61-4873-8f01-5b96dcbf9f96_600x469.jpg')}}"
            alt=""
          />
        </div>
        <div class="item">
          <img src="{{url('/web/images/meals/thaibarra_600x469.jpg')}}" alt="" />
        </div>
      </div>
    </section>

    <section class="block-section block-plans text-center py-50">
      <div class="container mt-5">
        <h2 class="text-center">MEAL PLANS</h2>
        <p class="text-center">
          Find a meal plan to build muscle, burn fat, or optimize performance.
          Create your own custom plan <br />
          tailored to suit your goals and calorie requirements.
        </p>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @php $i=1; @endphp
        @foreach($mealPlans as $value)        
          <div class="col">
            <div class="card h-100">
              <img
                  src="{{ url('/web/images/' . $i . '.webp') }}"
                  class="meals-img-top"
                  alt="Plan{{ $i }}"
              />

              <div class="meals-body">
                <h5 class="meals-title">{{ $value->meal_name }}</h5>
                <p class="meals-text">
                  {{ $value->description }}
                </p>
                <div class="meals-caroles">
                  @php                
                  $parameter = encrypt($value->meal_id);
                  $i++;
                  @endphp
                  <p>Calories - {{ $value->meal_calories }}</p>
                  <p>Total - {{ $value->total_amount }}</p>
                  <a href="{{url('mealplans1', $parameter)}}" class="btn btn-build-plan"
                    >BUILD PLAN</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        </div>
        <div class="text-center mt-5">
          <p>Follow a plan or choose from our full menu.</p>
          <a href="{{url('ourmenu')}}" class="btn solid green-lite">View Menu</a>
        </div>
      </div>
    </section>

    <section class="block-section block-reviews py-50-up text-center">
      <div class="container mt-5">
        <h2 class="text-center cus-head">Reviews</h2>
        <div class="row">
          <div class="col-12">
            <div class="contain">
              <div id="reviews-carousel" class="owl-carousel owl-theme">
                <div class="item">
                  <p>
                    "Absolutely stoked receiving the most delicious and
                    wholesome meals today! I have tried several meal deliveries
                    and these are the absolute best!! And a local business too!
                    Looking forward to many more orders!"
                  </p>
                </div>
                <div class="item">
                  <p>
                    "Highly recommend Gym Meal’s Direct!! Genuine local business
                    that produces highly quality &amp; freshly prepared meals
                    for your convenience . A step above any comparable
                    competition by a long mile! "
                  </p>
                </div>
                <div class="item">
                  <p>
                    "We had our first delivery yesterday and imagine my shock
                    when the meals looked just like the photos! I had the pesto
                    chicken zoodles, husband had the garlic chicken and daughter
                    had beef stroganoff tonight. Everyone raved about their
                    first meal. Cannot wait for the rest of the week’s meals.
                    Not just delicious but filling as well."
                  </p>
                </div>
                <div class="item">
                  <p>
                    "Love gym meals direct, they’re the best pre prepared meals
                    I’ve ever ordered and I’ve tried quite a few. The macros are
                    workable for both myself and my husband, able to sub veg for
                    rice etc for our individual goals. And with 2 little kids
                    who has time to prep a weeks worth of balanced lunches?!
                    Total life savers! Thanks guys!!!"
                  </p>
                </div>
                <div class="item">
                  <p>
                    "These guys go absolutely above and beyond for their
                    clients. The meal portions and flavours are the best of any
                    I have tried. I would highly recommend Gym Meals Direct. You
                    are also supporting a local business who cares for their
                    customers."
                  </p>
                </div>
                <div class="item">
                  <p>
                    "Easy online ordering experience, Got my order today
                    delivery driver was friendly came in an insulated container
                    which kept the food nice and chilled. Only takes 90 secs to
                    heat up in the microwave, Excellent tasting food, I will
                    definitely be ordering again. It saves heaps of time cooking
                    dinner and the prices are pretty good"
                  </p>
                </div>
                <div class="item">
                  <p>
                    "If I'm short on time to prep over the weekend - gym meals
                    are my go to to ensure that no matter what my week looks
                    like, at least I'm giving my body the fuel it deserves to
                    perform at its best. Thanks guys"
                  </p>
                </div>
                <div class="item">
                  <p>
                    "Love the food these guy sent out, utilising this as meal
                    prep and doing more fitness this has helped my partner and I
                    to lose nearly 25kgs combined, without this food this
                    process would of been a lot harder to achieve. Keep up the
                    good work guys"
                  </p>
                </div>
                <div class="item">
                  <p>
                    "we tried all your competitors meals over the last 3 years
                    Gym Meals Direct you win hands down !! I wish i found you
                    guys sooner your meals are awesome!!!"
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <figure class="mb-0">
        <img class="img-fluid" src="{{url('/web/images/review_image 1.png')}}" alt="reviews" />
      </figure>
    </section>

    <section class="block-nutri-part py-50">
      <div class="container d-flex align-items-center justify-content-center">
        <h3 class="title-block">Nutritional Partner</h3>
        <div class="Nutritional-logo">
          <img
            class="img-fluid"
            src="{{url('/web/images/raiders-logo.svg')}}"
            alt="Canberra Raiders"
          />
        </div>
      </div>
    </section>

    <section class="block-ackwolegment">
      <div class="container">
        <div class="text-center acknowledgement">
          <h2>ACKNOWLEDGEMENT OF COUNTRY</h2>
          <div class="row justify-content-center">
            <div class="col-md-8 col-sm-10 col-12">
              <p class="acknowledge-para">
                We acknowledge the Traditional Custodians of the ACT, the
                Ngunnawal people. We acknowledge and respect their continuing
                culture and the contribution they make to the life of this city
                and this region.
              </p>
            </div>
          </div>
        </div>
      </div>
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
 