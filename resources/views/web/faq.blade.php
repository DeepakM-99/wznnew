@extends('web.master')
@section('content')
@include('web.header')
<div class="block-page-faq py-50">
      <div class="container">
        <header class="text-center mb-5">
          <img
            src="{{url('/web/images/faqicon.png')}}"
            alt="bulb light"
            class="icon-tube"
          />
          <h1>FAQ</h1>
        </header>
        <nav class="gap-down">
          <ul>
            <li><a class="btn btn-light" href="#section-1">Food</a></li>
            <li><a class="btn btn-light" href="#section-2">Meal plans &amp; subscriptions</a></li>
            <li><a class="btn btn-light" href="#section-3">Pickup &amp; delivery</a></li>
            <li><a class="btn btn-light" href="#section-4">Packaging</a></li>
            <li><a class="btn btn-light" href="#section-5">Chef special</a></li>
          </ul>
        </nav>

        <div id="shopify-section-food-faq-section" class="shopify-section">
          <section class="gap-2-down">
            <div id="section-1" class="__hos"></div>
            <h2>Food</h2>
            <div class="accordion" id="accordionFood">
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingFood1">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFood1"
                    aria-expanded="true"
                    aria-controls="collapseFood1"
                  >
                    WHAT IS THE NUTRITIONAL INFORMATION FOR YOUR MEALS?
                  </button>
                </h4>
                <div
                  id="collapseFood1"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFood1"
                  data-bs-parent="#accordionFood"
                >
                  <div class="accordion-body">
                    <p>
                      You can find full nutritional panels under the product
                      description of each meal. The basic nutritional
                      information is also on your meals packaging.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingFood2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFood2"
                    aria-expanded="false"
                    aria-controls="collapseFood2"
                  >
                    DO YOUR MEALS CONTAIN ANY PRESERVATIVES?
                  </button>
                </h4>
                <div
                  id="collapseFood2"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFood2"
                  data-bs-parent="#accordionFood"
                >
                  <div class="accordion-body">
                    <p>
                      We strive to use the freshest local ingredients for all
                      our meals and therefore use no added preservatives.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingFood3">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFood3"
                    aria-expanded="false"
                    aria-controls="collapseFood3"
                  >
                    DO YOUR MEALS HAVE A USEBY/BEST BEFORE DATE?
                  </button>
                </h4>
                <div
                  id="collapseFood3"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFood3"
                  data-bs-parent="#accordionFood"
                >
                  <div class="accordion-body">
                    <p>
                      Meals have up to a 7-day shelf life. Best before dates are
                      located on the packaging. Some meals and snacks have a
                      longer shelf life. Always check the Use By date before
                      consumption.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingFood4">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFood4"
                    aria-expanded="false"
                    aria-controls="collapseFood4"
                  >
                    CAN YOUR MEALS BE FROZEN?
                  </button>
                </h4>
                <div
                  id="collapseFood4"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFood4"
                  data-bs-parent="#accordionFood"
                >
                  <div class="accordion-body">
                    <p>
                      We prefer our meals to be consumed fresh for the full Gym
                      Meals Direct experience when the meals are at their
                      highest nutritional and flavour quality. However, all our
                      meals can be frozen if you so wish.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingFood5">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFood5"
                    aria-expanded="false"
                    aria-controls="collapseFood5"
                  >
                    ARE YOUR MEALS HALAL?
                  </button>
                </h4>
                <div
                  id="collapseFood5"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFood5"
                  data-bs-parent="#accordionFood"
                >
                  <div class="accordion-body">
                    <p>
                      We source Halal certified meat for all our meals except
                      for pork.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingFood6">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFood6"
                    aria-expanded="false"
                    aria-controls="collapseFood6"
                  >
                    DO YOU CATER TO VEGANS?
                  </button>
                </h4>
                <div
                  id="collapseFood6"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFood6"
                  data-bs-parent="#accordionFood"
                >
                  <div class="accordion-body">
                    <p>
                      Yes, we have a range of meals and snacks suitable for
                      vegans. You can find these in the Gym Meals Direct Vegan
                      range on our menu page.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingFood7">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFood7"
                    aria-expanded="false"
                    aria-controls="collapseFood7"
                  >
                    HOW DO I HEAT UP MY MEALS?
                  </button>
                </h4>
                <div
                  id="collapseFood7"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFood7"
                  data-bs-parent="#accordionFood"
                >
                  <div class="accordion-body">
                    <p>
                      Our meals are packaged in microwaveable containers.
                      Alternatively, you can transfer the meal into an oven-safe
                      dish. Always refer to the heating instructions on your
                      meal's packaging.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div
          id="shopify-section-meal-plans-subscription-faq"
          class="shopify-section"
        >
          <section class="gap-2-down">
            <div id="section-2" class="__hos"></div>
            <h2>Meal plans &amp; subscriptions</h2>
            <div class="accordion" id="accordionMealPlans">
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingMealPlans1">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseMealPlans1"
                    aria-expanded="true"
                    aria-controls="collapseMealPlans1"
                  >
                    HOW DO I SIGN UP FOR A SUBSCRIPTION?
                  </button>
                </h4>
                <div
                  id="collapseMealPlans1"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingMealPlans1"
                  data-bs-parent="#accordionMealPlans"
                >
                  <div class="accordion-body">
                    <p>
                      You can sign up for a subscription by selecting a meal
                      plan on our website and following the prompts to create an
                      account and choose your meal preferences.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingMealPlans2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseMealPlans2"
                    aria-expanded="false"
                    aria-controls="collapseMealPlans2"
                  >
                    CAN I CANCEL MY SUBSCRIPTION AT ANY TIME?
                  </button>
                </h4>
                <div
                  id="collapseMealPlans2"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingMealPlans2"
                  data-bs-parent="#accordionMealPlans"
                >
                  <div class="accordion-body">
                    <p>
                      Yes, you can cancel your subscription at any time by
                      logging into your account and following the cancellation
                      process.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingMealPlans3">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseMealPlans3"
                    aria-expanded="false"
                    aria-controls="collapseMealPlans3"
                  >
                    WHAT MEAL PLANS DO YOU OFFER?
                  </button>
                </h4>
                <div
                  id="collapseMealPlans3"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingMealPlans3"
                  data-bs-parent="#accordionMealPlans"
                >
                  <div class="accordion-body">
                    <p>
                      We offer a variety of meal plans to suit different dietary
                      needs and preferences, including vegan, vegetarian, keto,
                      and balanced meal plans.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div id="shopify-section-pickup-delivery-faq" class="shopify-section">
          <section class="gap-2-down">
            <div id="section-3" class="__hos"></div>
            <h2>Pickup &amp; delivery</h2>
            <div class="accordion" id="accordionPickupDelivery">
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingPickupDelivery1">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsePickupDelivery1"
                    aria-expanded="true"
                    aria-controls="collapsePickupDelivery1"
                  >
                    WHERE DO YOU DELIVER?
                  </button>
                </h4>
                <div
                  id="collapsePickupDelivery1"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingPickupDelivery1"
                  data-bs-parent="#accordionPickupDelivery"
                >
                  <div class="accordion-body">
                    <p>
                      We deliver to various locations within our service area.
                      Please enter your postcode on our website to check if we
                      deliver to your area.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingPickupDelivery2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsePickupDelivery2"
                    aria-expanded="false"
                    aria-controls="collapsePickupDelivery2"
                  >
                    WHAT ARE YOUR DELIVERY CHARGES?
                  </button>
                </h4>
                <div
                  id="collapsePickupDelivery2"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingPickupDelivery2"
                  data-bs-parent="#accordionPickupDelivery"
                >
                  <div class="accordion-body">
                    <p>
                      Delivery charges vary based on your location and the size
                      of your order. Please refer to our delivery information
                      page for detailed pricing.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingPickupDelivery3">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsePickupDelivery3"
                    aria-expanded="false"
                    aria-controls="collapsePickupDelivery3"
                  >
                    CAN I CHANGE MY DELIVERY ADDRESS AFTER PLACING AN ORDER?
                  </button>
                </h4>
                <div
                  id="collapsePickupDelivery3"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingPickupDelivery3"
                  data-bs-parent="#accordionPickupDelivery"
                >
                  <div class="accordion-body">
                    <p>
                      Yes, you can change your delivery address by logging into
                      your account and updating your delivery details before the
                      order is dispatched.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div id="shopify-section-packaging-faq" class="shopify-section">
          <section class="gap-2-down">
            <div id="section-4" class="__hos"></div>
            <h2>Packaging</h2>
            <div class="accordion" id="accordionPackaging">
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingPackaging1">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsePackaging1"
                    aria-expanded="true"
                    aria-controls="collapsePackaging1"
                  >
                    HOW IS YOUR PACKAGING ENVIRONMENTALLY FRIENDLY?
                  </button>
                </h4>
                <div
                  id="collapsePackaging1"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingPackaging1"
                  data-bs-parent="#accordionPackaging"
                >
                  <div class="accordion-body">
                    <p>
                      We use recyclable and compostable packaging materials
                      wherever possible to minimize our environmental impact.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingPackaging2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsePackaging2"
                    aria-expanded="false"
                    aria-controls="collapsePackaging2"
                  >
                    CAN I RECYCLE YOUR PACKAGING?
                  </button>
                </h4>
                <div
                  id="collapsePackaging2"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingPackaging2"
                  data-bs-parent="#accordionPackaging"
                >
                  <div class="accordion-body">
                    <p>
                      Yes, most of our packaging can be recycled. Please refer
                      to the recycling symbols and guidelines on our packaging
                      for more details.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

        <div id="shopify-section-chef-special-faq" class="shopify-section">
          <section class="gap-2-down">
            <div id="section-5" class="__hos"></div>
            <h2>Chef special</h2>
            <div class="accordion" id="accordionChefSpecial">
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingChefSpecial1">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseChefSpecial1"
                    aria-expanded="true"
                    aria-controls="collapseChefSpecial1"
                  >
                    WHAT MAKES YOUR CHEF SPECIAL MEALS UNIQUE?
                  </button>
                </h4>
                <div
                  id="collapseChefSpecial1"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingChefSpecial1"
                  data-bs-parent="#accordionChefSpecial"
                >
                  <div class="accordion-body">
                    <p>
                      Our Chef Special meals are crafted with unique recipes and
                      premium ingredients, providing a gourmet experience that
                      stands out from our regular meal offerings.
                    </p>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h4 class="accordion-header" id="headingChefSpecial2">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseChefSpecial2"
                    aria-expanded="false"
                    aria-controls="collapseChefSpecial2"
                  >
                    HOW OFTEN DO YOU RELEASE NEW CHEF SPECIAL MEALS?
                  </button>
                </h4>
                <div
                  id="collapseChefSpecial2"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingChefSpecial2"
                  data-bs-parent="#accordionChefSpecial"
                >
                  <div class="accordion-body">
                    <p>
                      We release new Chef Special meals periodically to provide
                      our customers with fresh and exciting dining options.
                      Follow us on social media or sign up for our newsletter to
                      stay updated on new releases.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>

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
@endsection