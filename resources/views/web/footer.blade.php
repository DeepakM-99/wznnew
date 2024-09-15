<style>
    /* General Footer Styling */
.footer {
  background-color: white;
  padding: 60px 0;
  border-top: 1px solid #e9ecef;
}

.footer-widget {
  margin-bottom: 30px;
}

.footer-widget p {
  font-size: 16px;
  color: #333;
  font-weight: 500;
}

.footer-widget .footer-links {
  list-style: none;
  padding: 0;
}

.footer-widget .footer-links li {
  margin-bottom: 10px;
  color:black !important;
}

.footer-widget .footer-links li a {
  text-decoration: none;
  color: #6c757d;
  font-weight: 500;
  transition: color 0.3s;
color:black !important;
}

.footer-widget .footer-links li a:hover {
  color: #007bff;
}

/* Newsletter Input */
.newsletter-input {
  display: flex;
  align-items: center;
  border: 1px solid #ced4da;
  border-radius: 25px;
  overflow: hidden;
}

.newsletter-input input {
  width: 80%;
  padding: 10px 15px;
  border: none;
  outline: none;
  font-size: 14px;
}

.newsletter-input .btn-submit {
  background-color: #007bff;
  border: none;
  color: #fff;
  padding: 10px 15px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.newsletter-input .btn-submit:hover {
  background-color: #0056b3;
}

/* Payment Icons */
.gateway {
  text-align: right;
}

.payment-icons img {
  max-width: 40px;
  margin-left: 10px;
}

.gateway span {
  display: block;
  margin-bottom: 10px;
  color: #333;
}

.payment-icons img:hover {
  opacity: 0.8;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
  .gateway {
    text-align: center;
  }

  .payment-icons img {
    max-width: 35px;
  }

  .footer-widget {
    text-align: center;
  }

  .newsletter-input {
    justify-content: center;
  }
}

</style>

<footer class="footer py-5">
  <div class="container">
    <div class="row">
      <!-- Logo Section -->
      <div class="col-sm-3">
        <div class="footer-widget">
          <img src="{{url('/web/images/wznlogo.webp')}}" class="img-footer" alt="Logo" />
        </div>
      </div>

      <!-- Links Section 1 -->
      <div class="col-sm-3">
        <div class="footer-widget">
          <ul class="footer-links">
            <li><a href="{{url('howitworks')}}">HOW IT WORKS</a></li>
            <li><a href="{{url('faq')}}">FAQ</a></li>
            <li><a href="{{url('blogs')}}">BLOG</a></li>
            <li><a href="{{url('privacypolicy')}}">PRIVACY POLICY</a></li>
            <li><a href="{{url('termsofservice')}}">TERMS OF SERVICE</a></li>
            <li><a href="{{url('refundpolicy')}}">REFUND POLICY</a></li>
          </ul>
        </div>
      </div>

      <!-- Links Section 2 -->
      <div class="col-sm-2">
        <div class="footer-widget">
          <ul class="footer-links">
            @php
              $data = session()->get('userData');
            @endphp
            @if($data)
              <li><a href="{{url('my-account')}}">MY ACCOUNT</a></li>
            @endif
            <li><a href="{{url('login')}}">LOGIN</a></li>
            <li><a href="{{url('register')}}">REGISTER</a></li>
            <li><a href="{{url('contactus')}}">CONTACT US</a></li>
          </ul>
        </div>
      </div>

      <!-- Newsletter and Payment Section -->
      <div class="col-sm-4">
        <div class="footer-widget">
          <p>SIGN UP FOR OUR NEWSLETTER</p>
          <div class="newsletter-input">
            <input type="email" placeholder="Enter your Email" />
            <button class="btn-submit"><span class="fas fa-envelope"></span></button>
          </div>
          <div class="gateway text-md-right mt-3">
            <span>Shop securely with</span>
            <div class="payment-icons">
              <img src="https://www.gmdcanberra.com.au/cdn/shop/t/52/assets/icon-visa.svg?v=43396516388255831211718541810" alt="Visa" />
              <img src="https://www.gmdcanberra.com.au/cdn/shop/t/52/assets/icon-master.svg?v=163550031558387206931718541809" alt="MasterCard" />
              <img src="https://www.gmdcanberra.com.au/cdn/shop/t/52/assets/icon-afterpay.svg?v=88671883979466074321718541808" alt="Afterpay" />
              <img src="https://www.gmdcanberra.com.au/cdn/shop/t/52/assets/icon-apple_pay.svg?v=165710395854814583861718541808" alt="Apple Pay" />
              <img src="https://www.gmdcanberra.com.au/cdn/shop/t/52/assets/icon-paypal.svg?v=4905152401789577961718541809" alt="PayPal" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
