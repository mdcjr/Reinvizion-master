@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <link rel="stylesheet" type="text/css" href="/css/user-settings.css">
  <script src="/js/users-profile.js"></script>
  <script src="/js/users-settings.js"></script>
</head>
<div class="settings-header text-center">
  <p>
    <span class="active" value="contact">Contact Info</span>
    <span value="notif">Notifications</span>
    <?php if($current_user->confirmation_code != null): ?>
      <button data-toggle="modal" data-target="#emailConfirmationModal">Subscription</button>
    <?php else: ?>
      <span class="subsc" value="subsc">Subscription</span>
    <?php endif; ?>
  </p>
</div>
<div class="settings-containers">
  <div class="contact container text-center" style="display:block;">
    <h1>CONTACT INFO</h1>
    <div class="col-lg-6">
      <p class="text-left profile-content"> EMAIL</p>
      <input id="email" value="<?php echo $current_user->email; ?>"></input>
      <p class="text-left profile-content"> PHONE</p>
      <input id="phone" value="<?php echo $current_user->phone; ?>"></input>
      <p class="text-left profile-content"> ADDRESS</p>
      <input id="addr" value="<?php echo $current_user->addr; ?>"></input>
      <div class="col-lg-12">
        <div class="col-lg-5">
          <p class="text-left profile-content"> CITY </p>
          <input id="city" value="<?php echo $current_user->city; ?>"></input>
        </div>
        <div class="col-lg-5" style="float:right;">
          <p class="text-left profile-content"> STATE </p>
          <input id="state" value="<?php echo $current_user->state; ?>"></input>
        </div>
      </div>
      <p class="card" style="padding:0;">
        <button>SAVE</button>
      </p>
    </div>
  </div>
  <div class="notif container text-center">
    <h1>NOTIFICATIONS</h1>
    <div class="col-lg-6">
      <p class="email">EMAIL</p>
      <div class="agree-term">
        <div class="checkbox direct <?php if($settings->direct) { echo "enabled"; } ?>"><span class="x-button">X</span></div>
        <p>WHEN I GET A NEW DIRECT MESSAGE</p>
      </div>
      <div class="agree-term">
        <div class="checkbox feedback <?php if($settings->feedback) { echo "enabled"; } ?>"><span class="x-button">X</span></div>
        <p>WHEN I GET A NEW FEEDBACK</p>
      </div>
      <div class="agree-term">
        <div class="checkbox comment <?php if($settings->comment) { echo "enabled"; } ?>"><span class="x-button">X</span></div>
        <p>A NEW COMMENT IN THE THREAD I'M IN</p>
      </div>
      <div class="agree-term">
        <div class="checkbox connect <?php if($settings->connect) { echo "enabled"; } ?>"><span class="x-button">X</span></div>
        <p>WHEN I GET A NEW CONNECTION</p>
      </div>
      <div class="agree-term">
        <div class="checkbox classmate <?php if($settings->classmate) { echo "enabled"; } ?>"><span class="x-button">X</span></div>
        <p>WHEN I HAVE A NEW CLASSMATE</p>
      </div>
      <p class="save-button" style="padding:0;">
        <button>SAVE</button>
      </p>
    </div>
  </div>
  <?php if($current_user->confirmation_code == null): ?>
    <div class="subsc container text-center">
      <h1>SUBSCRIPTION</h1>
      <p class="sub-title">
        want to keep on learning?<br>
        please choose a subscription below:
      </p>
      <div class="col-lg-6 subsc-cont">
        <p>subscription types:</p>
        @if(Auth::user()->subscriber === 1)
          <p>"You're a subscriber"</p>
        @endif
        <form action="/payment/yearly" method="POST" class="<?php if(Auth::user()->subscription_type === "yearly"){ echo "active";} ?>">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <script
              src="https://checkout.stripe.com/checkout.js" class="stripe-button"
              data-key="{{ getenv('STRIPE_KEY') }}"
              data-amount="101.90"
              data-name="Reinvizion"
              data-panel-label="Subscribe:"
              data-label="YEARLY SUBSCRIPTION"
              data-description="Yearly Subscription"
              data-billing-address="true"
              data-zip-code="true"
              data-image="/images/fav-reinvizion.png"
              data-allow-remember-me="false"
              data-locale="auto">
            </script>
            <p><span>$101.90/year (15% OFF)</span></p>
        </form>
        <form action="/payment/monthly" method="POST" class="second <?php if(Auth::user()->subscription_type === "monthly"){ echo "active";} ?>">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <script
              src="https://checkout.stripe.com/checkout.js" class="stripe-button"
              data-key="{{ getenv('STRIPE_KEY') }}"
              data-amount="999"
              data-name="Reinvizion"
              data-panel-label="Subscribe:"
              data-label="MONTHLY SUBSCRIPTION"
              data-description="Monthly Subscription"
              data-image="/images/fav-reinvizion.png"
              data-allow-remember-me="false"
              data-billing-address="true"
              data-zip-code="true"
              data-locale="auto">
            </script>
          <p><span>$9.99/month</span></p>
        </form>
        <div class="col-lg-12">
          <p class="card">Have a PROMO CODE? Enter below:</p>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input name="coupon" id="coupon">
          <p class="card" style="padding:0;">
            <button class="coupon">ADD</button>
        </div>
          <div class="cancel-container">
          @if(Auth::user()->subscriber === 1)
            <p class="cancel" ><button id="cancel">Cancel subscription </button>
            </p>
          @endif
            <div class="agree-term conditions">
              <p>Read the <span data-toggle="modal" data-target="#termModal">Terms & Conditions</span></p>
            </div>
          </div>
        </p>
      </div>
    </div>
  <?php endif; ?>
</div>
<div class="footer-background"></div>
<div class="modal fade email-confirmation" data-keyboard="false" data-backdrop="static" id="emailConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="emailConfirmationModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">
          To view our latest features,<br>
          please confirm your email
        </h1>
        <p class="text-center main-title third">
          In case you didn't get it the first
          <br>
          time, we will gladly resend another
          <br>
          confirmation email
        </p>
        <div class="text-center">
          <button type="button" class="close done-button">
            Resend confirm email
          </button>
        </div>
      </div>   
    </div>
  </div>
</div>

<div class="modal fade email-confirmation" data-keyboard="false" data-backdrop="static" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="promoModal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">
          Your coupon has been successfully added
        </h1>
        <p class="text-center main-title third">
          Enjoy your 7 days trial. <br>
          You will not be charge until the trial is over.
        </p>
        <div class="text-center">
          <button type="button" class="close done-button" data-dismiss="modal" aria-label="Close">
            OKAY
          </button>
        </div>
      </div>   
    </div>
  </div>
</div>

<div class="modal fade email-confirmation" data-keyboard="false" data-backdrop="static" id="promoError" tabindex="-1" role="dialog" aria-labelledby="promoError">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">
          You entered the wrong promo code.
        </h1>
        <div class="text-center">
          <button type="button" class="close done-button" data-dismiss="modal" aria-label="Close">
            OKAY
          </button>
        </div>
      </div>   
    </div>
  </div>
</div>

<div class="modal fade email-confirmation" data-keyboard="false" data-backdrop="static" id="succesPayment" tabindex="-1" role="dialog" aria-labelledby="successPayment">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">
          You are now a subscriber!
        </h1>
        <div class="text-center">
          <button type="button" class="close done-button" data-dismiss="modal" aria-label="Close">
            OKAY
          </button>
        </div>
      </div>   
    </div>
  </div>
</div>

<div class="modal fade email-confirmation" data-keyboard="false" data-backdrop="static" id="successCancel" tabindex="-1" role="dialog" aria-labelledby="successCancel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">
          You have cancel your subscription.
        </h1>
        <div class="text-center">
          <button type="button" class="close done-button" data-dismiss="modal" aria-label="Close">
            OKAY
          </button>
        </div>
      </div>   
    </div>
  </div>
</div>

<div class="modal fade term-modal" data-keyboard="false" data-backdrop="static" id="termModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">
        <div class="term-container">
          <div class="text-center">REINVIZION ONLINE MEMBERSHIP AGREEMENT</div><br>

          This Reinvizion Online Membership Agreement (“Agreement”) is between you, individually, (hereinafter referred to as “you” or “your(s)”), 
          and Reinvizion, LLC, a Texas limited liability company (“Reinvizion” or “we” or “our”) and govern your access to and use of any Reinvizion 
          website, mobile application (such as for iPhone or Android) or content, or products and/or services made available through www.reinvizion.com 
          (collectively, the “Site”).
          <br><br>
          Please read this Agreement carefully before proceeding, as you agree that by clicking the “Submit” button below, you agree to be bound 
          by the terms of this Agreement. THESE TERMS CONTAIN AN ARBITRATION AGREEMENT AND CLASS ACTION WAIVER THAT REQUIRE YOU TO ARBITRATE ALL 
          DISPUTES YOU HAVE WITH REINVIZION ON AN INDIVIDUAL BASIS. Please see Section 21 for more information about the Arbitration Agreement 
          and class action waiver.
          <br><br>
          <div class="terms-index">
            1.  <b>Terms of Use.</b>
            <br>
            <div class="terms-index">
              <div class="col-lg-1"> a. </div> 
              <div class="col-lg-11">
                <u>Acceptance of Agreement.</u> By accessing and/or using the Site, you accept and agree to be bound by this Agreement, 
                just as if you had agreed to this Agreement in writing. 
                <br><br>
              </div>
              <div class="col-lg-1"> b. </div>
              <div class="col-lg-11"> 
                <u>Amendment of Agreement.</u> Reinvizion, in its sole discretion, may amend this Agreement from time to time. All amendments 
                will be effective upon posting of such updated Agreement. Your continued access to or use of the Site after such posting 
                constitutes your consent to be bound by the Agreement, as amended.
                <br><br>
              </div>
              <div class="col-lg-1"> c. </div>
              <div class="col-lg-11"> 
                <u>Additional Agreement.</u> In addition to this Agreement, when using particular courses, offers, services, or features, you 
                will also be subject to any additional posted terms, or rules applicable to such courses, offers, services, or features, 
                which may be posted and modified from time to time. All such additional terms are hereby incorporated by reference into the Agreement, 
                provided that in the event of any conflict between such additional terms and the Agreement, the Agreement shall control.
                <br><br>
              </div>
            </div>
            2.  <b>Reinvizion Platform.</b>
            <br>
            <div class="terms-index">
              <div class="col-lg-1"> a. </div> 
              <div class="col-lg-11"> 
                <u>Reinvizion Platform.</u> Reinvizion is a monthly subscription membership that enables Reinvizion members to access a wide range 
                of educational courses (“Reinvizion Courses”) and business services offered and operated by Reinvizion or other third parties that 
                partner with Reinvizion (“Alternative Learning Instructors”) for the sole purpose of increasing your knowledge in entrepreneurship, 
                business management, or alternative careers. Through the Reinvizion Platform you can access third party products and services. 
                Reinvizion shall not be liable for any third party products and services, including Alternative Learning Instructors, used by you, 
                regardless of whether you access such third party products and services through the Site.
                <br><br>
              </div>
              <div class="col-lg-1"> b. </div> 
              <div class="col-lg-11"> 
                <u>Membership Term.</u> Your Reinvizion membership starts on the date that you sign up for a subscription and submit payment via a 
                valid Payment Method. Your membership shall be for a one (1) month term, and will automatically renew each month until your membership 
                is cancelled or terminated. 
                <br><br>
              </div>
              <div class="col-lg-1"> c. </div>
              <div class="col-lg-11"> 
                <u>Membership Fee.</u> The Membership Fee shall be $9.99 per month. The Membership Fee only includes access to the Reinvizion Courses 
                (as listed on the Site). The Membership Fee does not include any separate business and marketing services or Alternative Learning 
                Instructor services (collectively, “Additional Services”) offered on the Site. The Additional Services shall be available to you for 
                an additional fee as listed on the Site. By accessing the Additional Services, you agree that Reinvizion may automatically bill you 
                the applicable fees for the Additional Services through the Payment Method (defined hereinafter) you provided for your Reinvizion membership. 
                <br><br>
              </div>
              <div class="col-lg-1"> d. </div> 
              <div class="col-lg-11"> 
                <u>Reinvizion Courses.</u> You may access the Reinvizion Courses at any time and complete in any order. Reinvizion reserves 
                the right to change from time to time the number of Reinvizion Courses you can take per month. Reinvizion may also change the 
                Reinvizion Courses available to you without notice; provided that you are able to complete in a timely manner any courses you have 
                enrolled and proceeded to complete. Reinvizion does not guarantee the availability of particular courses or other business services, 
                and such availability may change over time, including during the course of any given Membership Term. The type and availability of 
                Reinvizion Courses, Additional Services, and Alternative Learning Instructors are determined by Reinvizion in its sole discretion.
                <br><br>
              </div>
              <div class="col-lg-1"> e. </div> 
              <div class="col-lg-11"> 
                <u>Use of Reinvizion.</u> Your Reinvizion membership is personal to you and you agree not to create more than one account. 
                You cannot transfer or gift Reinvizion Courses, Additional Services, or services enrolled under Alternative Learning Instructors, 
                to third parties, including other Reinvizion members. Reinvizion may not be used for commercial purposes. To use your Reinvizion 
                membership you must have access to the Internet through the use of the following browsers: (1) Safari, (2) Mozilla, (3) Internet Explorer, 
                (4) Google Chrome, or (5) Opera. We continually update and test various aspects of the Reinvizion platform. We reserve the right to do so 
                without notice to you, and by using our service you agree that we may, include you in or exclude you from these updates and tests without notice.
                <br><br>
              </div>
            </div>
            3.  <b>Billing.</b>
            <br>
            <div class="terms-index">
              <div class="col-lg-1"> a. </div> 
              <div class="col-lg-11"> 
                <u>Recurring Billing.</u> By starting your Reinvizion membership, you authorize us to charge you the Membership Fee on a monthly basis 
                during the Term of this Agreement. You agree to provide us with a current, valid, accepted method of payment (which we may update from 
                time to time, “Payment Method”) for the Membership Fee, and any Additional Services. We will automatically bill the Membership Fee on 
                a monthly basis to your Payment Method each month until your subscription is cancelled or terminated. You acknowledge that the amount 
                billed each month may vary for reasons that may include differing amounts due to your selection of Additional Services, and you authorize 
                us to charge your Payment Method for such varying amounts, which may be billed monthly in one or more charges. You also authorize us to 
                charge you any other fees you may incur in connection with your use of the Site, such as any applicable sign-up fee, taxes and cancellation 
                or late fees, as further explained below. 
                <br><br>
              </div>
              <div class="col-lg-1"> b. </div> 
              <div class="col-lg-11"> 
                <u>Billing Cycle.</u> Once you click “Submit” below to accept the terms of this Agreement, your first month’s Membership Fee will be billed 
                immediately. This Agreement will automatically renew each month and you will be billed on the same date each month, unless billed earlier 
                due to such date not being available in a given month. We reserve the right to change the timing of our billing without notice. 
                <br><br>
              </div>
              <div class="col-lg-1"> c. </div> 
              <div class="col-lg-11"> 
                <u>Refunds.</u> Membership Fees, and any other charges assessed to you during the term of this Agreement, are nonrefundable. 
                <br><br>
              </div>
              <div class="col-lg-1"> d. </div> 
              <div class="col-lg-11"> 
                <u>Price Changes.</u> We reserve the right to adjust pricing, including, but not limited to, the Membership Fee, at any time. Unless we 
                expressly communicate otherwise, any price changes to your membership will take effect on your next billing cycle upon notice communicated 
                through a posting on the Reinvizion website or mobile application or such other means as we may deem appropriate from time to time, such as email.
                <br><br>
              </div>
              <div class="col-lg-1"> e. </div> 
              <div class="col-lg-11"> 
                <u>Payment Methods.</u> You may edit your Payment Method information by logging online and editing it by clicking under “Profile” → “Your Account” 
                → “Billing Account → “Manage Payment Options”. If a payment is not successfully funded, due to expiration, insufficient funds or otherwise, 
                you will remain responsible for any uncollected amounts and authorize us to continue billing the Payment Method, as it may be updated, 
                including in the event you attempt to create a new account. This may result in a change to your payment billing dates. If we cannot charge your 
                Payment Method, we reserve the right, but are not obligated, to terminate your access to our Site or any portion thereof.
                <br><br>
              </div>
              <div class="col-lg-1"> f. </div> 
              <div class="col-lg-11"> 
                <u>Cancellation of Membership.</u> You may terminate this Agreement at any time with ten (10) days’ notice by going into your account 
                settings on the Reinvizion website and canceling. Following any termination, you will continue to have access to your subscription through 
                the end of your current prepaid billing period.
                <br><br>
              </div>
            </div>
            4.  <b>Termination or Modification by Reinvizion.</b>
            <br>
            <div class="terms-index">
              <div class="col-lg-1"> a. </div> 
              <div class="col-lg-11"> 
                <u>Termination or Modification.</u> You understand and agree that, at any time and without prior notice Reinvizion may (1) terminate, cancel, 
                deactivate and/or suspend your membership, any Additional Services placed, or your access to or use of the Site or your membership (or any 
                portion thereof, including your access to any or all Alternative Learning Instructors or services) and/or (2) discontinue, modify or alter 
                any aspect, feature or policy of the Site or your subscription. This includes the right to terminate or modify any membership prior to the 
                end of any pre-paid or committed period. Upon any termination, we may immediately deactivate your account and all related information and/or 
                bar any further access to your account information and the Site. Upon any such termination by us without cause, as your sole recourse, we will 
                issue you a pro rata refund of the prepaid portion of your Membership Fee and other applicable charges for unused services (less any fees 
                or costs for services already used). If we determine that you have violated this Agreement or otherwise engaged in illegal or improper use of 
                your membership or the Site, you will not be entitled to any refund and you agree that we will not be responsible to pay any such refund. You 
                agree that Reinvizion will not be liable to you or any third party for any termination or modification to the service regardless of the reason 
                for such termination or modification. You acknowledge that your only right with respect to any dissatisfaction with any modification or 
                discontinuation of service made by us is to cancel or terminate your membership.
                <br><br>
              </div>
              <div class="col-lg-1"> b. </div> 
              <div class="col-lg-11"> 
                <u>Infringing or Fraudulent Activity.</u> Reinvizion does not permit copyright infringing activities and reserves the right to terminate access 
                to the Site and remove all content submitted by any persons who are found to be infringers. Any suspected fraudulent, abusive, or illegal 
                activity that may be grounds for termination of your use of the Site may be referred to appropriate law enforcement authorities. These remedies 
                are in addition to any other remedies Reinvizion may have at law or in equity.
                <br><br>
              </div>
            </div>
            5.  <b>Eligibility; Registration Information and Password; Site Access.</b>
            <br>
            <div class="terms-index">
              <div class="col-lg-1"> a. </div> 
              <div class="col-lg-11"> 
                <u>Eligibility Criteria.</u> The availability of all or part of our Site may be limited based on geographic, age, or other criteria as we may 
                establish from time to time. You understand and agree we may disallow you from subscribing to Reinvizion or may terminate your membership at 
                any time based on the following criteria: you must be (1) 18 years of age or older to use this Site or to purchase a Reinvizion membership, 
                and (2) a resident of the United States, and (3) authorized to use the Payment Method selected for payment of your Membership Fee, Additional 
                Services, or services provided by Alternative Learning Instructors. THESE TERMS ARE ONLY APPLICABLE TO USERS IN THE U.S. AND SEPARATE TERMS 
                MAY APPLY TO USERS IN OTHER JURISDICTIONS. THE SITE IS NOT AVAILABLE TO ANY USERS SUSPENDED OR REMOVED FROM THE SITE BY REINVIZION. BY USING 
                THE SITE, YOU REPRESENT THAT YOU ARE AT LEAST 18 YEARS OLD, A RESIDENT OF THE UNITED STATES, AND HAVE NOT BEEN PREVIOUSLY SUSPENDED OR REMOVED 
                FROM THE SITE. THOSE WHO CHOOSE TO ACCESS THE SITE DO SO AT THEIR OWN INITIATIVE AND ARE RESPONSIBLE FOR COMPLIANCE WITH ALL LOCAL LAWS AND 
                REGULATIONS, INCLUDING, WITHOUT LIMITATION, LAWS AND REGULATIONS ABOUT THE INTERNET, DATA, EMAIL OR OTHER ELECTRONIC MESSAGING, OR PRIVACY.
                <br><br>
              </div>
              <div class="col-lg-1"> b. </div> 
              <div class="col-lg-11"> 
                <u>Account Information.</u> You agree that the information you provide to Reinvizion at any time will be true, accurate, current, and complete. 
                You also agree that you will ensure that this information is kept accurate and up-to-date at all times. When you register, you will be asked 
                to create a password. You are solely responsible for maintaining the confidentiality of your account and password and for restricting access 
                to your computer, and you agree to accept responsibility for all activities that occur under your account.
                <br><br>
              </div>
            </div>
            <div class="col-lg-1"> 6. </div> 
            <div class="col-lg-11"> 
              <b>Privacy.</b> Your privacy is important to Reinvizion. The Reinvizion Privacy Policy is hereby incorporated into this Agreement by reference. 
              Please read the privacy policy carefully for information relating to Reinvizion’ collection, use, and disclosure of your personal information. 
              When you obtain services provided by Alternative Learning Instructors, the applicable Alternative Learning Instructors will have access to certain 
              information about you, such as your name and email address, so it can provide services to you, communicate with you regarding the services you 
              requested and send you other communication that may be of interest to you such as marketing offers. Please see the Privacy Policy for more information.
              <br><br>
            </div>
            7.  <b>Prohibited Conduct.</b> You agree not to:
            <br>
            <div class="terms-index">
              <div class="col-lg-1"> a. </div> 
              <div class="col-lg-11"> 
                Sell, offer for resale,  reproduce, copy, or distribute the Reinvizion Courses, and/or the Additional Services; 
                <br>
              </div>
              <div class="col-lg-1"> b. </div> 
              <div class="col-lg-11"> 
                Harass, threaten, disrupt or defraud members or employees of Reinvizion or Alternative Learning Instructors or 
                otherwise create or contribute to an unsafe, harassing, threatening or disruptive environment;
                <br>
              </div>
              <div class="col-lg-1"> c. </div> 
              <div class="col-lg-11"> 
                Make unsolicited offers, advertisements, proposals, or send junk mail or “spam” to employees of Reinvizion or Alternative 
                Learning Instructors;
                <br>
              </div>
              <div class="col-lg-1"> d. </div> 
              <div class="col-lg-11"> 
                Impersonate another person or access another member’s account;
                <br>
              </div>
              <div class="col-lg-1"> e. </div> 
              <div class="col-lg-11"> 
                Share Reinvizion-issued passwords with any third party or encourage any other member to do so;
                <br>
              </div>
              <div class="col-lg-1"> f. </div> 
              <div class="col-lg-11"> 
                Permit anyone to use any Reinvizion Courses or services enrolled under your own membership, including other members;
                <br>
              </div>
              <div class="col-lg-1"> g. </div> 
              <div class="col-lg-11"> 
                Reserve or cancel any services with the Alternative Learning Instructor directly with the Alternative Learning Instructors, 
                rather than through the Site,
                <br>
              </div>
              <div class="col-lg-1"> h. </div> 
              <div class="col-lg-11"> 
                Misrepresent the source, identity, or content of information transmitted via the Site, including deleting the copyright or 
                other proprietary rights;
                <br>
              </div>
              <div class="col-lg-1"> i. </div> 
              <div class="col-lg-11"> 
                Upload material (e.g. virus) that is damaging to computer systems or data of Reinvizion or members of the Site;
                <br>
              </div>
              <div class="col-lg-1"> j. </div> 
              <div class="col-lg-11"> 
                Copy, download, or upload copyrighted material that is not your own or that you do not have the legal right to distribute, 
                display, and otherwise make available to others;
                <br>
              </div>
              <div class="col-lg-1"> k. </div> 
              <div class="col-lg-11"> 
                Use the Site for any purpose that is unlawful or prohibited by these Agreement; 
                <br>
              </div>
              <div class="col-lg-1"> l. </div> 
              <div class="col-lg-11"> 
                Use the Site in any manner that could damage, disable, overburden, or impair it or interfere with any other party’s use and 
                enjoyment of the Site; 
                <br>
              </div>
              <div class="col-lg-1"> m. </div> 
              <div class="col-lg-11"> 
                Attempt to gain unauthorized access to the Site, or any part of the Site, other accounts, computer systems or networks connected 
                to the Site, or any part of them, through hacking, password mining, or any other means or interfere or attempt to interfere with the 
                proper working of the Site or any activities conducted on the Site; 
                <br>
              </div>
              <div class="col-lg-1"> n. </div> 
              <div class="col-lg-11"> 
                Remove, circumvent, disable, damage or otherwise interfere with security-related features of the Site, any features that prevent 
                or restrict use or copying of any content accessible through the Site, or any features that enforce limitations on the use of the Site 
                or the content therein;
                <br>
              </div>
              <div class="col-lg-1"> o. </div> 
              <div class="col-lg-11"> 
                Obtain or attempt to obtain any materials or information through any means not intentionally made available through the Site;
                <br>
              </div>
              <div class="col-lg-1"> p. </div> 
              <div class="col-lg-11"> 
                Modify the Site in any manner or form, nor to use modified versions of the Site, including (without limitation) for the purpose 
                of obtaining unauthorized access to the Site; or
                <br>
              </div>
              <div class="col-lg-1"> q. </div> 
              <div class="col-lg-11"> 
                Use any robot, spider, scraper, or other automated means to access the Site for any purpose without our express written permission.
                <br><br>
              </div>
            </div>
            Reinvizion reserves the right to refuse service, terminate accounts, remove or edit content, or cancel services in their sole discretion.
            <br><br>
            <div class="col-lg-1"> 8. </div> 
            <div class="col-lg-11"> 
              <b>Ownership; Proprietary Rights.</b> The Reinvizion website and mobile applications are owned and operated by Reinvizion. The visual 
              interfaces, graphics, design, compilation, information, computer code, products, software (including any downloadable software), content, 
              services, and all other elements of the Site provided by Reinvizion (“Materials”) are protected by the copyright, trade dress, patent, and 
              trademark laws of the United States and other countries, international conventions, and all other relevant intellectual property and 
              proprietary rights, and applicable laws. Except for any content provided by Alternative Learning Instructors, all Materials contained on 
              the Site are the copyrighted property of Reinvizion or its subsidiaries or affiliated companies and/or third-party licensors. All trademarks, 
              service marks, and trade names are proprietary to Reinvizion or its affiliates and/or third-party licensors. Except as expressly authorized 
              by Reinvizion, you agree not to sell, license, distribute, copy, modify, publicly perform or display, transmit, publish, edit, adapt, create 
              derivative works from, or otherwise make unauthorized use of the Materials. Reinvizion does not grant you any right or license to use the 
              Reinvizion Courses or Additional Services except as authorized under this Agreement.
              <br><br>
            </div>
            <div class="col-lg-1"> 9. </div> 
            <div class="col-lg-11"> 
              <b>Third-Party Sites, Products and Services; Links.</b> The Site may include links or access to other web sites or services (“Linked Sites”) 
              solely as a convenience to members. Reinvizion does not endorse any such Linked Sites or the information, material, products, or services 
              contained on other linked sites or accessible through other Linked Sites. Furthermore, Reinvizion makes no express or implied warranties with 
              regard to the information, material, products, or services that are contained on or accessible through linked sites. ACCESS AND USE OF LINKED 
              SITES, INCLUDING THE INFORMATION, MATERIAL, PRODUCTS, AND SERVICES ON LINKED SITES OR AVAILABLE THROUGH LINKED SITES, IS SOLELY AT YOUR OWN RISK. 
              Your correspondence or business dealings with, or participation in promotions of, advertisers found on or through the Site are solely between you 
              and such advertiser. YOU AGREE THAT REINVIZION WILL NOT BE RESPONSIBLE OR LIABLE FOR ANY LOSS OR DAMAGE OF ANY SORT INCURRED AS THE RESULT OF ANY 
              SUCH DEALINGS OR AS THE RESULT OF THE PRESENCE OF SUCH ADVERTISERS ON THE SITE.
              <br><br>
            </div>
            <div class="col-lg-1"> 10. </div>
            <div class="col-lg-11"> 
              <b>Notice.</b> Except as explicitly stated otherwise, legal notices will be served, with respect to Reinvizion, on Reinvizion’ Texas registered 
              agent, and, with respect to you, to the email address you provide to Reinvizion during the registration process. Notice will be deemed given 24 
              hours after email is sent, unless the sending party is notified that the email address is invalid. Alternatively, we may give you legal notice by 
              mail to the address provided during the registration process. In such case, notice will be deemed given three (3) days after the date of mailing.
              <br><br>
            </div>
            <div class="col-lg-1"> 11. </div>
            <div class="col-lg-11"> 
              <b>Electronic Signatures and Agreements.</b> You acknowledge and agree that by clicking on the button labeled "SUBMIT", "DOWNLOAD", “PLACE MY 
              ORDER”, "I ACCEPT", “CONFIRM PURCHASE”, or such similar links as may be designated by Reinvizion to accept the terms and conditions of this 
              Agreement, you are submitting a legally binding electronic signature and are entering into a legally binding contract. You acknowledge that your 
              electronic submissions constitute your agreement and intent to be bound by this Agreement. Pursuant to any applicable statutes, regulations, rules, 
              ordinances or other laws, including without limitation the United States Electronic Signatures in Global and National Commerce Act, P.L. 106-229 
              (the "E-Sign Act") or other similar statutes, YOU HEREBY AGREE TO THE USE OF ELECTRONIC SIGNATURES, CONTRACTS, ORDERS AND OTHER RECORDS AND TO 
              ELECTRONIC DELIVERY OF NOTICES, POLICIES AND RECORDS OF TRANSACTIONS INITIATED OR COMPLETED THROUGH THE SITE OR SERVICES OFFERED BY REINVIZION. 
              Further, you hereby waive any rights or requirements under any statutes, regulations, rules, ordinances or other laws in any jurisdiction which 
              require an original signature or delivery or retention of non-electronic records, or to payments or the granting of credits by other than electronic 
              means.
              <br><br>
            </div>
            <div class="col-lg-1"> 12. </div>
            <div class="col-lg-11"> 
              <b>DISCLAIMERS; NO WARRANTIES.</b> COURSES, SERVICES, AND OTHER SERVICES OFFERED BY ALTERNATIVE LEARNING INSTRUCTORS VIA THE SITE ARE OFFERED 
              AND PROVIDED TO YOU SOLELY AT YOUR OWN RISK, AND TO THE FULLEST EXTENT PERMISSIBLE PURSUANT TO APPLICABLE LAW, YOUR ENROLLMENT AND PARTICIPATION 
              IN THESE COURSES, AND YOUR USE OF THESE SERVICES IS SOLELY AT YOUR OWN RISK. IN NO EVENT SHALL REINVIZION BE LIABLE FOR ANY ACT, ERROR OR OMISSION 
              BY REINVIZION OR ANY THIRD PARTY, INCLUDING, WITHOUT LIMITATION, ANY WHICH ARISES OUT OF OR IS ANY WAY CONNECTED WITH A MEMBER’S USE OF OR 
              PARTICIPATION IN A COURSE OR SERVICE MADE THROUGH THE SITE, OR THE PERFORMANCE OR NON-PERFORMANCE OF ANY ALTERNATIVE LEARNING INSTRUCTOR IN 
              CONNECTION WITH THE SERVICES. REINVIZION IS NOT AN AGENT OF ANY ALTERNATIVE LEARNING INSTRUCTOR.
              <br><br>
              THE SITE AND ANY DOWNLOADABLE SOFTWARE, CONTENT, SERVICES, OR APPLICATIONS MADE AVAILABLE IN CONJUNCTION WITH OR THROUGH THE SITE ARE PROVIDED “AS 
              IS” AND “AS AVAILABLE” WITHOUT WARRANTIES OF ANY KIND EITHER EXPRESS OR IMPLIED. TO THE FULLEST EXTENT PERMISSIBLE PURSUANT TO APPLICABLE LAW, 
              REINVIZION, ON BEHALF OF ITSELF AND ITS SUPPLIERS AND PARTNERS, DISCLAIMS AND EXCLUDES ALL WARRANTIES, WHETHER STATUTORY, EXPRESS OR IMPLIED, 
              INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT OF PROPRIETARY RIGHTS.
              <br><br>
              WITHOUT LIMITING THE FOREGOING, REINVIZION DOES NOT WARRANT OR MAKE ANY REPRESENTATIONS (I) THAT THE SITE AND ANY DOWNLOADABLE SOFTWARE, CONTENT, 
              SERVICES, OR APPLICATIONS MADE AVAILABLE IN CONJUNCTION WITH OR THROUGH THE SITE WILL BE UNINTERRUPTED OR ERROR-FREE, THAT DEFECTS WILL BE 
              CORRECTED, OR THAT THE SITE AND ANY DOWNLOADABLE SOFTWARE, CONTENT, SERVICES, OR APPLICATIONS MADE AVAILABLE IN CONJUNCTION WITH OR THROUGH THE 
              SITE OR THE SERVER THAT MAKES THEM AVAILABLE ARE FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS, OR (II) REGARDING THE USE OF THE SITE AND ANY 
              DOWNLOADABLE SOFTWARE, CONTENT, SERVICES, OR APPLICATIONS MADE AVAILABLE IN CONJUNCTION WITH OR THROUGH THE SITE IN TERMS OF CORRECTNESS, ACCURACY, 
              RELIABILITY, OR OTHERWISE. ANY MATERIAL OR DATA THAT YOU DOWNLOAD OR OTHERWISE OBTAIN THROUGH THE SITE IS AT YOUR OWN RISK. YOU ARE SOLELY 
              RESPONSIBLE FOR ANY DAMAGES TO YOUR COMPUTER SYSTEM OR LOSS OF DATA RESULTING FROM THE DOWNLOAD OF SUCH MATERIAL OR DATA.
              <br><br>
              CERTAIN STATE LAWS DO NOT ALLOW LIMITATIONS ON IMPLIED WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE LAWS APPLY TO YOU, 
              SOME OR ALL OF THE DISCLAIMERS, EXCLUSIONS, OR LIMITATIONS SET FORTH IN THESE TERMS MIGHT NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS.
              <br><br>
            </div>
            <div class="col-lg-1"> 13. </div>
            <div class="col-lg-11"> 
              <b>Indemnification; Hold Harmless.</b> You agree to indemnify and hold Reinvizion, its parent, subsidiaries or affiliated entities, and each 
              of their respective officers, directors, members, employees, consultants, contract employees, representatives and agents, and each of their 
              respective successors and assigns, from any and all claims, losses, damages, liabilities, including attorneys’ fees, arising out of your use or 
              misuse of the Site, violation of this Agreement, violation of the rights of any other person or entity, or any breach of your representations, 
              warranties, and covenants set forth in these Agreement.
              <br><br>
            </div>
            <div class="col-lg-1"> 14. </div>
            <div class="col-lg-11"> 
              <b>LIMITATION OF LIABILITY AND DAMAGES.</b> UNDER NO CIRCUMSTANCES WILL REINVIZION OR ITS AFFILIATES, CONTRACTORS, EMPLOYEES, AGENTS, 
              ALTERNATIVE LEARNING INSTRUCTORS, OR THIRD-PARTY PARTNERS OR SUPPLIERS BE LIABLE FOR ANY SPECIAL, INDIRECT, INCIDENTAL, OR CONSEQUENTIAL DAMAGES 
              UNDER ANY THEORY OF LIABILITY, WHETHER BASED IN CONTRACT, TORT (INCLUDING NEGLIGENCE AND PRODUCT LIABILITY), OR OTHERWISE, EVEN IF REINVIZION HAS 
              BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. APPLICABLE LAW MAY NOT ALLOW THE LIMITATION OR EXCLUSION OF LIABILITY OR INCIDENTAL OR 
              CONSEQUENTIAL DAMAGES, SO THE ABOVE LIMITATION OR EXCLUSION MAY NOT APPLY TO YOU. IN SUCH CASES, REINVIZION’S LIABILITY WILL BE LIMITED TO THE 
              FULLEST EXTENT PERMITTED BY APPLICABLE LAW.
              <br><br>
              REINVIZION’ LIABILITY TO YOU IS LIMITED TO THE LESSER OF (1) $50, OR (2) THE AMOUNTS, IF ANY, PAID BY YOU TO REINVIZION UNDER THIS AGREEMENT IN 
              THE SIX (6) MONTHS IMMEDIATELY PRIOR TO THE EVENT FIRST GIVING RISE TO THE CLAIM. THE FOREGOING LIMITATIONS WILL APPLY TO THE MAXIMUM EXTENT 
              PERMITTED BY APPLICABLE LAW, REGARDLESS OF WHETHER REINVIZION HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES AND REGARDLESS OF WHETHER ANY 
              REMEDY FAILS OF ITS ESSENTIAL PURPOSE.
              <br><br>
            </div>
            <div class="col-lg-1"> 15. </div>
            <div class="col-lg-11"> 
              <b>Alternative Learning Instructors Waivers and Agreement.</b> Members obtaining services from the Alternative Learning Instructors agree 
              to the liability waivers of the individual Alternative Learning Instructors. Your use or participation in any service provided by the 
              Alternative Learning Instructor may be subject to additional policies, rules or conditions of the applicable Alternative Learning Instructors 
              and you understand and agree that you may not be permitted to use such services if you do not comply with this Agreement or the policies of the 
              Alternative Learning Instructors. If you have questions about the Alternative Learning Instructors’s waiver or other terms, please contact the 
              Alternative Learning Instructors directly.
              <br><br>
            </div>
            16. <b>Arbitration Agreement.</b> PLEASE READ THE FOLLOWING CAREFULLY:
            <br>
            <div class="terms-index">
              <div class="col-lg-1"> a. </div> 
              <div class="col-lg-11"> 
                <u>Purpose.</u> This Arbitration Agreement facilitates the prompt and efficient resolution of any disputes that may arise between you and 
                Reinvizion. Arbitration is a form of private dispute resolution in which parties to a contract agree to submit their disputes and potential 
                disputes to a neutral third person (called an arbitrator) for a binding decision, instead of having such dispute(s) decided in a lawsuit, in 
                court, by a judge or jury trial. Please read this Arbitration Agreement carefully. It provides that all disputes between you and Reinvizion 
                shall be resolved by binding arbitration. Arbitration replaces the right to go to court. In the absence of this arbitration agreement, you may 
                otherwise have a right or opportunity to bring claims in a court, before a judge or jury, and/or to participate in or be represented in a case 
                filed in court by others (including, but not limited to, class actions). Entering into this Arbitration Agreement constitutes a waiver of your 
                right to litigate claims in court and all opportunity to be heard by a judge or jury. There is no judge or jury in arbitration, and court review 
                of an arbitration award is limited. The arbitrator must follow this Arbitration Agreement and can award the same damages and relief as a court 
                (including attorney’s fees).
                <br><br>
                For the purpose of this Arbitration Agreement, “Reinvizion” means Reinvizion and its parents, subsidiaries, and affiliated companies, and each 
                of their respective officers, directors, employees, and agents. The term “Dispute” means any dispute, claim, or controversy between you and 
                Reinvizion regarding any aspect of your relationship with Reinvizion, whether based in contract, statute, regulation, ordinance, tort (including, 
                but not limited to, fraud, misrepresentation, fraudulent inducement, negligence, gross negligence or reckless behavior), or any other legal or 
                equitable theory, and includes the validity, enforceability or scope of this Arbitration Agreement (with the exception of the enforceability of 
                the Class Action Waiver clause below). “Dispute” is to be given the broadest possible meaning that will be enforced.
                <br><br>
                WE EACH AGREE THAT, EXCEPT AS PROVIDED BELOW, ANY AND ALL DISPUTES, AS DEFINED ABOVE, WHETHER PRESENTLY IN EXISTENCE OR BASED ON ACTS OR OMISSIONS 
                IN THE PAST OR IN THE FUTURE, WILL BE RESOLVED EXCLUSIVELY AND FINALLY BY BINDING ARBITRATION RATHER THAN IN COURT IN ACCORDANCE WITH THIS 
                ARBITRATION AGREEMENT.
                <br><br>
              </div>
              <div class="col-lg-1"> b. </div> 
              <div class="col-lg-11"> 
                <u>Pre-Arbitration Dispute Resolution.</u> Before initiating any Dispute, whether in court or arbitration, you must first give Reinvizion an 
                opportunity to resolve the Dispute by mailing written notification to Reinvizion, Attn: Dispute Resolution Department, 719 Scott Ave, Wichita Falls 
                Texas, 76301. That written notification must include (1) your name, (2) your address, (3) a written description of the Dispute, and (4) a 
                description of the specific relief you seek. If Reinvizion does not resolve the Dispute to your satisfaction within 45 days after it receives your 
                written notification, you may pursue your Dispute in arbitration.
                <br><br>
              </div>
              <div class="col-lg-1"> c. </div> 
              <div class="col-lg-11"> 
                <u>Arbitration Procedures.</u> If the Dispute is not resolved as provided above in the Pre-Arbitration Dispute Resolution section, either you or 
                Reinvizion may initiate arbitration proceedings. The American Arbitration Association (“AAA”), www.adr.org, will arbitrate all Disputes, and the 
                arbitration will be conducted before a single arbitrator. The arbitration shall be commenced as an individual arbitration, and shall in no event 
                be commenced as a class arbitration. All issues shall be for the arbitrator to decide, including the scope of this Arbitration Agreement. For 
                arbitration before the AAA, for Disputes in which less than $75,000 is at issue, the AAA’s Supplementary Procedures for Consumer-Related Disputes 
                will apply; for Disputes involving $75,000 or more, the AAA’s Commercial Arbitration Rules will apply. In either instance, the AAA’s Optional Rules 
                For Emergency Measures Of Protection shall apply. The AAA rules are available at www.adr.org or by calling 1-800-778-7879. In the event that this 
                Arbitration Agreement conflicts with the applicable arbitration rules, this Arbitration Agreement shall govern. Under no circumstances will class 
                action procedures or rules apply to the arbitration. In the event your agreement with Reinvizion, involves  interstate commerce, the Federal 
                Arbitration Act (“FAA”) shall govern the arbitrability of all Disputes; otherwise, the Texas General Arbitration Act (“TGAA”) shall govern the 
                arbitrability of all Disputes. However, the arbitrator will apply applicable substantive law consistent with the TGAA and the applicable statute of 
                limitations or condition precedent to suit.
                <br><br>
              </div>
              <div class="col-lg-1"> d. </div> 
              <div class="col-lg-11"> 
                <u>Arbitration Award.</u> The arbitrator may award on an individual basis any relief that would be available pursuant to applicable law, and will 
                not have the power to award relief to, against or for the benefit of any person who is not a party to the proceeding. The arbitrator shall make any 
                award in writing but need not provide a statement of reasons unless requested by a party. Such award by the arbitrator will be final and binding on 
                the parties, except for any right of appeal provided by applicable federal law, if applicable, including but not limited to the Federal Arbitration Act 
                (“the FAA”), and may be entered in any court having jurisdiction over the parties for purposes of enforcement.
                <br><br>
              </div>
              <div class="col-lg-1"> e. </div> 
              <div class="col-lg-11"> 
                <u>Location of Arbitration.</u> Arbitration shall take place in Wichita County, Texas, but it may proceed by telephone if you so choose.
                <br><br>
              </div>
              <div class="col-lg-1"> f. </div> 
              <div class="col-lg-11"> 
                <u>Payment of Arbitration Fees and Costs.</u> All arbitration filing fees and arbitrator’s costs and expenses shall be shared equally among the 
                parties. Both parties are responsible for all additional fees and costs that incurred separately by such party in the arbitration, including, but not 
                limited to, attorneys or expert witnesses. Fees and costs may be awarded as provided pursuant to applicable law.
                <br><br>
              </div>
              <div class="col-lg-1"> g. </div>
              <div class="col-lg-11">  
                <u>Class Action Waiver.</u> Any Disputes arising out of or relating to any purchase you make on or through the Site, any information you provide 
                via the Site, this Agreement (including the formation, performance, or alleged breach), and your use of the Site shall be submitted individually by 
                you and will not be subject to any class action or representative status. The arbitrator may not consolidate more than one person’s claims, and may 
                not otherwise preside over any form of a class or representative proceeding or claims (such as a class action, representative action, consolidated 
                action or private attorney general action). Neither you, nor any other Member of Reinvizion services, can be a class representative, class member, or 
                otherwise participate in a class, representative, consolidated or private attorney general proceeding with respect to the matters set forth in the 
                first sentence of this paragraph. You agree that this Class Action Waiver is material and essential to the arbitration of any dispute between you and 
                Reinvizion and is nonseverable from the Arbitration Agreement. If any portion of this Class Action Waiver is limited, voided, or cannot be enforced, 
                then the Arbitration Agreement shall be null and void. You understand that by agreeing to this Class Action Waiver, you may only pursue Dispute against 
                Reinvizion in an individual capacity and not as a plaintiff or class member in any purported class action or representative proceeding.
                <br><br>
              </div>
              <div class="col-lg-1"> h. </div> 
              <div class="col-lg-11"> 
                <u>Limitation of Procedural Rights.</u> You understand and agree that, by entering into this Arbitration Agreement, you and Reinvizion are each 
                agreeing to arbitration instead of the right to a trial before a judge or jury in a public court. In the absence of this Arbitration Agreement, you 
                and Reinvizion might otherwise have a right or opportunity to bring Disputes in a court, before a judge or jury, and/or to participate or be 
                represented in a case filed in court by others (including class actions). By using the Reinvizion Site and services, you are entering into this 
                Arbitration Agreement, and you give up those procedural rights. Other rights that you would have if you went to court, such as the right to appeal 
                and to certain types of discovery, may be more limited in arbitration. The right to appellate review of an arbitrator’s decision is much more limited 
                than in court, and in general an arbitrator’s decision may not be appealed for errors of fact or law.
                <br><br>
              </div>
              <div class="col-lg-1"> i. </div> 
              <div class="col-lg-11"> 
                <u>Severability.</u> If any clause within this Arbitration Agreement, other than the Class Action Waiver clause above, is found to be illegal or 
                unenforceable, that clause will be severed from this Arbitration Agreement, and the remainder of this Arbitration Agreement will be given full force 
                and effect. If the Class Action Waiver clause is found to be illegal or unenforceable, then this entire Arbitration Agreement will be unenforceable 
                and the Dispute will be decided by a court of competent jurisdiction.
                <br><br>
              </div>
              <div class="col-lg-1"> j. </div> 
              <div class="col-lg-11"> 
                <u>Continuation.</u> This Arbitration Agreement shall survive the termination of your Agreement with Reinvizion and your use of the Reinvizion 
                Site and services.
                <br><br>
              </div>
            </div>
            17. <b>Miscellaneous.</b>
            <br>
            <div class="terms-index">
              <div class="col-lg-1"> a. </div> 
              <div class="col-lg-11"> 
                <u>Choice of Law; Forum.</u> This Agreement shall be governed in all respects by the laws of the State of Texas, without regard to conflict of law 
                provisions.
                <br>
              </div>
              <div class="col-lg-1"> b. </div> 
              <div class="col-lg-11"> 
                <u>Assignment.</u> We may assign our rights and obligations under this Agreement without notice. You may not assign your rights and obligations 
                under this Agreement without written consent of Reinvizion. The Agreement will inure to the benefit of our successors, assigns and licensees.
                <br>
              </div>
              <div class="col-lg-1"> c. </div> 
              <div class="col-lg-11"> 
                <u>Severability.</u> If any provision of this Agreement shall be unlawful, void, or for any reason unenforceable, then that provision will be 
                deemed severable from these Agreement and will not affect the validity and enforceability of any remaining provisions.
                <br>
              </div>
              <div class="col-lg-1"> d. </div> 
              <div class="col-lg-11"> 
                <u>Headings.</u> The heading references herein are for convenience purposes only, do not constitute a part of this Agreement, and will not be 
                deemed to limit or affect any of the provisions hereof.
                <br>
              </div>
              <div class="col-lg-1"> e. </div> 
              <div class="col-lg-11"> 
                <u>Entire Agreement.</u> This Agreement represents the entire agreement between you and Reinvizion relating to the subject matter herein.
                <br>
              </div>
              <div class="col-lg-1"> f. </div> 
              <div class="col-lg-11"> 
                <u>Claims; Statute of Limitations.</u> YOU AND REINVIZION AGREE THAT ANY CAUSE OF ACTION ARISING OUT OF OR RELATED TO THESE TERMS OR THE SITE 
                MUST COMMENCE WITHIN ONE (1) YEAR AFTER THE CAUSE OF ACTION ACCRUES. OTHERWISE, SUCH CAUSE OF ACTION IS PERMANENTLY BARRED.
                <br>
              </div>
              <div class="col-lg-1"> g. </div> 
              <div class="col-lg-11"> 
                <u>Disclosures.</u> The services hereunder are offered by Reinvizion, LLC, located at: 712 8th Street, Floor 2, Wichita Falls, Texas 76301 and 
                email: customerservice@reinvizion.com. You may have a copy of this Agreement emailed, or paper copy mailed, to you by sending a letter to the 
                foregoing address with your email or mailing address and a request for this information.
                <br>
              </div>
              <div class="col-lg-1"> h. </div> 
              <div class="col-lg-11"> 
                <u>Waiver.</u> No waiver of any of this Agreement by Reinvizion is binding unless authorized in writing by an executive officer of Reinvizion. 
                In the event that Reinvizion waives a breach of any provision of this Agreement, such waiver will not be construed as a continuing waiver of other 
                breaches of the same nature or other provisions of this Agreement and will in no manner affect the right of Reinvizion to enforce the same at a 
                later time.
                <br>
              </div>
            </div>
          </div>
        </div>
        <p class="text-center submit-button">
          <button  type="button" data-dismiss="modal" aria-label="Close">DONE</button> 
        </p>
      </div>   
    </div>
  </div>
</div>
<style>
.modal-backdrop {
  background-color: #f50c79;
}
</style>
@if(Session::has('stripe-payment-success'))
  <script>
    $("#successPayment").bind("click", function(){
      $('#succesPayment').modal('show');
    });
  </script>
@endif 
@if(Session::has('stripe-cancel-success'))
  <script>
    $("#successCancel").bind("click", function(){
      $('#successCancel').modal('show');
    });
  </script>
@endif
@stop
