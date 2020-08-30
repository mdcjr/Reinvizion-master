 
<div class="modal fade tell-yourself business-hub" data-keyboard="false" data-backdrop="static" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="myModalLabel">
          <p class="text-center">BUT FIRST, TELL US A LITTLE ABOUT YOURSELF</p>
        </h4>
      </div>

      <div class="modal-body">
        <p class="text-center">CHOOSE WHAT BEST APPLIES TO YOU<br>
       
          <select id="user_type" name="slct1">
            <!-- <option value="Student">Student</option> -->
{{--             <option value="Aspiring Entrepreneur">Aspiring Entrepreneur</option> --}}
            <!-- <option value="Change of Pace">Change of Pace</option> -->
            <option value="Business Owner">Business Owner</option>
            <option value="Customer">Customer</option>
          </select> 
        </p>
          <p class="text-center">WHAT KIND?<br>
          <input id="user_occupation" placeholder="MAJOR"></input>
        </p>
      </div>

      <div class="modal-footer">
        <p class="text-left button-container">
          <button type="button"  data-dismiss="modal" class="btn btn-primary class"
          data-toggle="modal" data-target="#secondModal" id="save">
            OK, LET'S GO
          </button> 
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade tell-yourself business-academy" data-keyboard="false" data-backdrop="static" id="businessAcademyModal" tabindex="-1" role="dialog" aria-labelledby="businessAcademyModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="businessAcademyModalLabel">
          <p class="text-center">BUT FIRST, TELL US A LITTLE ABOUT YOURSELF</p>
        </h4>
      </div>

      <div class="modal-body">
        <p class="text-center">CHOOSE WHAT BEST APPLIES TO YOU<br>
       
          <select id="user_type" name="slct1">
            <option value="Aspiring Entrepreneur">Aspiring Entrepreneur</option>
          </select> 
        </p>
          <p class="text-center">WHAT KIND?<br>
          <input id="user_occupation" placeholder="OCCUPATION"></input>
        </p>
      </div>

      <div class="modal-footer">
        <p class="text-left button-container">
          <button type="button"  data-dismiss="modal" class="btn btn-primary class"
          data-toggle="modal" data-target="#secondModal" id="save">
            OK, LET'S GO
          </button> 
        </p>
      </div>
    </div>
  </div>
</div>

<!--     second part -->
<div class="modal-open">
  <div class="modal fade video-popup" data-keyboard="false" data-backdrop="static" id="secondModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
          
          <div class="video-container">
            <div class="embed-responsive embed-responsive-16by9" style="background-size: cover;">
              <iframe src="" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen id="video-frame"></iframe>
            </div>
          </div>

          <p class="text-center elevating"></p>
          <h2 style="text-transform:uppercase;">FOR THE <span id="user_type_value">STUDENT</span></h2> 
          <p class="text-center arrow-container">
            <span class="glyphicon glyphicon-triangle-bottom collapsed" aria-hidden="false"></span> 
          </p>
          <p class="others-collapsible collapsible collapsed text-center"  style="display: none;">
            We Reinvizion© a new direction towards building businesses<br>
            through providing innovative education and developing a next<br>
            generation platform for businesses, while helping professionals<br>
            secure financial freedom.
            <br><br>
            Reinvizion is the portal to online entrepreneurial education and<br>
            enrichment. We’re currently setting the groundwork for an inno-<br>
            vative educational web application that will eventually fuse with<br>
            social networking.
            <br><br>
            Our goal is to educate our partners with the fundamentals to suc-<br>
            cess through actual life practices and concepts while achieving<br>
            financial freedom.
          </p>
          <p class="business-owner-collapsible collapsible collapsed text-center" style="display: none;">
            Reinvizion is the premier business social networking platform
            <br>
            that allows business owners to engage with their customers 
            <br>
            without all the noise that comes from your traditional 
            <br>
            networking applications. Our platform will help you build a 
            <br>
            connection and a life long relationship with your customers!
          </p>
          <p class="customer-collapsible collapsible collapsed text-center" style="display: none;">
            We understand the importance of connections, <br>
            allowing you, the customer to stay engaged with<br>
            businesses and organizations that matter to you.<br>
            Come be a part of vastly growing community today!
          </p>
          <p class="text-center">                           
            <button type="button"  data-dismiss="modal"  class="btn btn-primary class" data-toggle="modal" data-target="#termModal">SIGN-UP</button> 
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!--third part -->

<div class="modal fade register-popup" data-keyboard="false" data-backdrop="static" id="thirdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
        @if(count($errors) > 0)
        @endif
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <ul>
          <li class="col-lg-6 background-container mobile text-center">
            
            <h1 class="text-center main-title" style='font-size: '>REGISTER</h1>
            <hr></hr>
            <h1 class="text-center main-title second" style='margin-bottom: 10px;'>YOUR FUTURE STARTS TODAY</h1>
            <p class="text-center main-title third">
              “Success consists of going from
              failure to failure without loss of
              enthusiasm.”<br>
￼￼            <span>- Winston Churchill</span>
            </p>
            <button type="button" data-dismiss="modal" class="btn btn-outlined btn-primary"  data-toggle="modal" data-target="#fourthModal">
              SIGN-IN
            </button>
            <a href="/auth/facebook" style="margin-left:15px;">
              <button class="btn btn-primary button enabled fb">
                FACEBOOK
              </button>
            </a>
          </li>
          <li class="col-lg-6 form-container">
            <!-- <button type="button" class="close register-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button> -->
            @include('auth.register') 
          </li>
          <li class="col-lg-6 background-container text-center">
            
            <h1 class="text-center main-title">REGISTER</h1>
            <hr></hr>
            <h1 class="text-center main-title second">YOUR FUTURE STARTS TODAY</h1>
            <p class="text-center main-title third">
              “Success consists of going from<br>
              failure to failure without loss of<br>
              enthusiasm.”<br>
￼￼            <span>- Winston Churchill</span>
            </p>
            <button type="button" data-dismiss="modal" class="btn btn-outlined btn-primary"  data-toggle="modal" data-target="#fourthModal">
              SIGN-IN
            </button>
            <a href="/auth/facebook" style="margin-left:15px;">
              <button class="btn btn-primary button enabled fb">
                FACEBOOK
              </button>
            </a>
          </li>
        </ul>
      </div>   
    </div>
  </div>
</div>
<?php $old = Session::getOldInput('name');?>
@if(count($errors) > 0 && !empty($old))
  <script type="text/javascript">
    $(document).ready(function(){
      $('#thirdModal').modal('show');
    })
  </script>
@elseif(count($errors)>0 && empty($old))
  <script type="text/javascript">
    $(document).ready(function(){
      $('#fourthModal').modal('show');
    })
  </script>
@endif

<!--fourth-->

<div class="modal fade login-popup" data-keyboard="false" data-backdrop="static" id="fourthModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:700px;">
    <div class="modal-content" style="border-radius: 0;">
      @if(count($errors) > 0)
      @endif
      <div class="modal-header" style="padding:0;border:0;">      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="row row-background">
          <div class="col-lg-5" style="padding-right:0;">
            <style>
              .academy-popup {
                margin: 40px 0;
              }
              .academy-popup h1 {
                color: #fff;
                font-size: 28px;
              }
              .academy-popup h1 small, .academy-popup h4 {
                font-size: 12px;
                color: #fff;
              }
              .academy-popup h4 {
                font-size: 15px;
                font-weight: 200;
                line-height: 21px;
                padding-right: 25px;
              }
              .academy-popup .strong-title {
                margin-top: 10px;
              }
              .modal-header button.close {
                margin: 5px 10px 0 0;
              }
            </style>

            <div class="academy-popup">
              <h1>
                  <small><strong>ELEVATING YOUR TRANSITION IN LIFE</strong></small>
                  <strong class="strong-title">BUSINESS<br>ACADEMY</strong>  
              </h1> 
              <h4>
                      When you join Reinvizion, you have the 
                  ability to qualify for our Business Accelerator
                  Program. <br><br>Reinvizion will have open registrations
                  twice a year for submission into our Accelerator 
                  Program. If your company is selected, you will have the opportunity
                      to pitch Reinvizion for funding.
              </h4> 
            </div>
            <!-- <img src="images/building-gradient.jpg" style="width:100%;"></img> -->
          </div>
          <div class="col-lg-7" style="padding:0;">
            <div>
              @include('auth.login')
            </div>
          </div>
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
          <h1 style="font-size:22px;float: left; width: 100%;">Reinvizion Data & Privacy Policy</h1>
          <br><br>
          <b>Summary</b>
          <br><br>
          Our Website, <b>DOMAIN</b> www.reinvizion.com, and its Software Applications collect some Personal Data from its Users (each, a “User”).
          <br><br>
          <b>
            For Traffic Optimization and Distribution:
            <br><br>
            [<i>Reinvizion uses third party software Sendinblue for email distribution to visitors that sign up for email updates and registered users of our Website</i>]
            <br><br>
            For Visitor Analytics:
            <br><br>
            [<i>Visors IP and cookies and stored within our database. No personal information is stored unless implementby the user into our website.</i>]
            <br><br>
            For Interaction with External Social Networks and Platforms:
            <br><br>
            [<i>Our website uses Facebook integration, allowing users to pull and merge their Facebook setting to sign on to our website, and pulls users profile information.</i>]
            <br><br>
            Data Owner:
            <br><br>
            <p style="margin:0 0 0 30px;">Reinvizion LLC. – 719 Scott Ave Wichita Falls, TX, support@reinvizion.ocm</p>
            <br>
            You, a User of the Site, may expect the following Privacy Rights, Privileges, and Protections:
            <br><br>
            Freedom to Choose What, If Any, Data You Provide.
          </b>
          <br><br>
          <ul>
            <li>You may choose to refuse Cookies.</li>
            <li>You may choose not to provide Personal Identification Information.</li>
            <li>You may choose whether to receive or not receive our newsletters or be contacted by phone, fax, mail, or email.</li>
          </ul>
          <b>Access to and Control Over Your Data.</b>
          <br><br>
          <ul>
            <li>You may request to know what data of yours we hold.</li>
            <li>You may request alteration or deletion of your data.</li>
            <li>You may request a list of all people with direct access to your data.</li>
          </ul>
          <br>
          <b>Handling and Storage of Your Data that is Reasonably Secure.</b>
          <br><br>
          We adopt appropriate and reasonable practices to protect your Personal Identification Information and Data.
          <br><br>
          <b>Notice of any Data Breach.</b>
          <br><br>
          We will notify you in the event that your Personal Identification Information may have been breached.
          <br><br>
          <b>No Exchange of Your Data with Third Parties Without Your Permission.</b>
          <br><br>
          We will not sell, trade, rent, or give away your Personal Identification Information to others without your express permission to do so.
          <br><br>
          In short, you’re not forced to use our site or provide any data, but if you do it’s your choice what to disclose. You can later ask us what 
          data of yours we have, ask us to change or delete it, or tell you who has direct access to it. We’ll be careful to prevent unauthorized access 
          to your data, but if we find your data may have been breached, we will notify you. We won’t spam you; you can opt in and out of mailing lists. 
          We won’t give away or sell your personal data in any way to others.
          <br><br>
          <i>Latest update: <b>5/23/2017</b></i>
          <br><br>
          <b>Full Privacy Agreement</b>
          <br><br>
          Our Website, <b>DOMAIN</b> www.reinvizion.com, and its Software Applications collect some Personal Data from its Users (each, a “User”). The Data are 
          collected and processed for the purposes set out below. This Privacy Policy governs the manner in which <b>Reinvizion LLC</b>. collects, uses, maintains 
          and discloses information collected from Users of the Site. This Privacy Policy applies to the Site and all products and services offered by <b>Reinvizion LLC</b>.
          <br><br>
          <b>Kinds of Data</b>
          <br><br>
          The Data that may be collected by this Site are: Various types of Personal and Non-personal Identification Information, Cookie and Browsing and Usage Data.
          <br><br>
          <b>Personal Identification Information</b>
          <br><br>
          We may collect Personal Identification Information from Users in a variety of ways, including, but not limited to, when Users visit our Site, subscribe to the 
          newsletter, fill out a form, and in connection with other activities, services, features or resources we make available on our Site. The Personal Data may be 
          freely submitted by the User or the Data Subject, or collected automatically when using the Site. Users may be asked for, as appropriate, name, email address, 
          mailing address, phone number. Users may, however, visit our Site anonymously. We will collect Personal Identification Information from Users only if they 
          voluntarily submit such information to us. Users can always refuse to supply personally identification information, except that it may prevent them from engaging 
          in certain Site related activities. The Personal Data collected may regard both the User and third parties whose data the User provides. The User assumes 
          responsibility for the Personal Data of third parties published or shared through the Site and declares that (s)he has the right to communicate or broadcast them, 
          thus relieving the Owner of all responsibility towards third parties.
          <br><br>
          <b>Non-Personal Identification Information</b>
          <br><br>
          We may collect Non-Personal Identification Information about Users whenever they interact with our Site. Non-Personal Identification Information may include the 
          browser name, the type of computer and technical information about Users means of connection to our Site, such as the operating system and the Internet service 
          providers utilized and other similar information.
          <br><br>
          <b>Web Browser Cookies</b>
          <br><br>
          Our Site may use “cookies” to enhance User experience. The User’s web browser places cookies on their hard drive for record-keeping purposes and sometimes to 
          track information about them. Any use of Cookies by the Site or the owners of third party services used by the Site, unless stated otherwise, serves to identify 
          the User and remember his/her preferences for the sole purpose of providing the service required by the User. User may choose to set their web browser to refuse 
          cookies, or to alert them when cookies are being sent to them. Failure to provide certain Personal Data, in particular Navigation Data, by deactivating the Site’s 
          Cookies may make it impossible to use the Site or for the Site to provide its services.
          <br><br>
          <b>How We Use Collected Data and Information</b>
          <br><br>
          We collect and use Users’ or Data Subjects’ Personal and Non-Personal Identification Information and other Data for the following purposes:
          <br><br>
          <ol>
            <li><b>To Personalize User Experience.</b> We may use information in the aggregate to understand how our Users as a group use the services and resources provided on 
              our Site. For such purposes Data are collected for traffic optimization and distribution, analytics, and interaction with external social networks and platforms.</li>
            <li><b>To Improve our Site.</b> We continually strive to improve our website offerings based on the information and feedback we receive from you.</li>
            <li><b>To Improve Customer Service.</b> Your information helps us to more effectively respond to your customer service requests and support needs.</li>
            <li><b>To Administer Content, Promotions, Surveys or Other Site Features.</b> To send Users information they agreed to receive about topics we think will be of interest to them.</li>
            <li><b>To Send Periodic Emails.</b> The email address Users provide will only be used to respond to their inquiries, and/or other requests or questions. If a User decides to 
              opt-in to our mailing list, they will receive emails that may include company news, updates, related product or service information, etc. If at any time the User would 
              like to unsubscribe from receiving future emails, we include unsubscribe instructions at the bottom of each email, or the User may contact us via our Site.</li>
          </ol>
          The use of Data for additional purposes by the Owner, may in some cases, and for legal purposes, require specific consent by the User or the Data Subject.
          <br><br>
          <b>How We Protect Your Information</b>
          <br><br>
          We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration, disclosure or destruction 
          of your personal information, username, password, transaction information and data stored on our Site. In the unfortunate event of a data security breach, we will notify 
          Users whose Personal Identification Information may have been breached.
          <br><br>
          <b>Sharing Your Personal Information</b>
          <br><br>
          We do not sell, trade, or rent Users’ Personal Identification Information to others. We may share generic aggregated demographic information not linked to any Personal 
          Identification Information regarding visitors and users with our business partners, trusted affiliates and advertisers for the purposes outlined above. We may use third 
          party service providers to help us operate our business and the Site or administer activities on our behalf, such as sending out newsletters or surveys. We may share your 
          information with these third parties for those limited purposes provided that you have given us your permission.
          <br><br>
          <b>Third Party Websites</b>
          <br><br>
          Users may find advertising or other content on our Site that link to the sites and services of our partners, suppliers, advertisers, sponsors, licensors and other third 
          parties. We do not control the content or links that appear on these sites and are not responsible for the practices employed by websites linked to or from our Site. In 
          addition, these sites or services, including their content and links, may be constantly changing. These sites and services may have their own privacy policies and customer 
          service policies. Browsing and interaction on any other website, including websites which have a link to our Site, is subject to those websites’ own terms and policies.
          <br><br>
          <b>
            Mode and Place of Processing the Data Obtained
            <br><br>
            Method of Processing
          </b>
          <br><br>
          The Data Controller processes the Data of the Interested Parties and Users in a lawful and proper manner and shall take appropriate security measures to prevent unauthorized 
          access, disclosure, modification or unauthorized destruction of the Data. Processing is carried out using computers and / or telematic means, with organizational methods 
          and logics strictly related to the stated purposes.
          <br><br>
          In addition to the owner, in some cases, access to the Data may be available to external parties (such as third party technical service providers, mail carriers, hosting 
          providers, IT companies, communications agencies). The updated list of Managers may be requested from the Owner at any time.
          <br><br>
          <b>Place</b>
          <br><br>
          The Data are processed at the headquarters of the Data Controller, unless stated otherwise in the rest of this document.
          <br><br>
          <b>Conservation Time</b>
          <br><br>
          The Data are kept for the time necessary to perform the service requested by the User, and the User can always ask for their suspension or removal.
          <br><br>
          <b>
            Detailed Information on the Processing of Personal Data and the Services Provided by Third Parties
            <br><br>
            Traffic Optimization and Distribution
          </b>
          <br><br>
          These services allow the Site to distribute their content using servers located across different countries and to optimize their performance. Which Personal Data are processed 
          depends on the characteristics and the way these services are implemented. Their function is to filter communications between the Site and the User’s browser. Considering the 
          widespread distribution of this system, it is difficult to determine the locations to which the contents that may contain Personal Information User are transferred.
          <br><br>
          <b>
            SERVICE
            <br><br>
            <i>Service Description as it pertains to privacy/data collection/tracking.</i>
          </b>
          <br><br>
          Personal data collected: <b><i>Personal data that is collected by Reinvizion is provided only by you the user.</i></b>
          <br>
          Place of Processing: <b>719 Scott Ave, Wichita Falls TX, 76309</b>
          <br><br>
          <b>...<br><br>Analytics</b>
          <br><br>
          These services enable the Owner to monitor and analyze web traffic and can be used to keep track of User behavior.
          <br><br>
          <b><i>Service Description as it pertains to privacy/data collection/tracking.</i></b>
          <br><br>
          Personal data collected: <b><i>Personal data that is collected by Reinvizion is provided only by you the user.</i></b>
          <br>
          Place of Processing: <b>719 Scott Ave, Wichita Falls TX, 76309</b>
          <br><br>
          <b>...<br><br>Interaction with External Social Networks and Platforms</b>
          <br><br>
          These services allow interaction with social networks or other external platforms directly from the Site’s pages. The interaction and information obtained by this Site are always 
          subject to the User’s privacy settings for each social network. If a service enabling interaction with social networks is installed it may still collect traffic data for the pages 
          where the service is installed, even when Users do not use it.
          <br><br>
          <b><i>Service Description as it pertains to privacy/data collection/tracking.</i></b>
          <br><br>
          Personal data collected: <b><i>Personal data that is collected by Reinvizion is provided only by you the user.</i></b>
          <br>
          Place of Processing: <b>719 Scott Ave, Wichita Falls TX, 76309</b>
          <br><br>
          <b>...<br><br>Additional Information About Data Processing<br><br>Legal Protection</b>
          <br><br>
          The User’s Personal Data may be used for legal purposes by the Owner of the Site in court or in the stages leading to possible legal action arising from its improper use or that of 
          related services by the User.
          <br><br>
          <b>Additional Information</b>
          <br><br>
          Specific information may be shown on the pages of the Site concerning particular services or the processing of Data provided by the User or by the Data Subject.
          <br><br>
          <b>Maintenance</b>
          <br><br>
          The User’s Personal Data may be further used in ways and for purposes required for Site maintenance.
          <br><br>
          <b>System Logs</b>
          <br><br>
          For operation and maintenance purposes, this Site and any third party services it uses may collect system logs, i.e., files that record interaction – including navigation. 
          They may also contain personal data, such as IP addresses.
          <br><br>
          <b>Information Not Contained in this Policy</b>
          <br><br>
          More information on processing Personal Information may be requested from the company at any time.
          <br><br>
          <b>The Rights of Data Subjects</b>
          <br><br>
          Those persons to whom the Data refer have the right, at any time, to know whether their data has been stored and can consult the Data Controller to learn about their contents and 
          origin, to verify their accuracy or to ask for them to be supplemented, cancelled, updated or corrected, or for their transformation into anonymous format or to block any data held 
          in violation of the law, as well as to oppose their treatment for any and all legitimate reasons. Requests should be sent to the Owner of the Processing System.
          <br><br>
          <b>Changes to this Privacy Policy</b>
          <br><br>
          The Site reserves the right to make changes to this Privacy Policy at any time by giving notice to its Users on this page, and by ensuring analogous protection of the Personal 
          nformation in all cases. It is strongly recommended that Site Users review this page often, referring to the date of the last modification listed at the bottom. You acknowledge 
          and agree that it is your responsibility to review this Privacy Policy periodically and become aware of modifications.
          <br><br>
          <b>Your Acceptance of These Terms</b>
          <br><br>
          By using this Site, you signify your acceptance of this policy. If you do not agree to this policy, please do not use our Site. Your continued use of the Site following the posting of 
          changes to this policy will be deemed your acceptance of those changes.
          <br><br>
          <b>Contacting Us</b>
          <br><br>
          If you have any questions about this Privacy Policy, the practices of this site, or your dealings with this site, please contact us at:
          <br><br>
          <b>
            support@reinvizion.com
            <br><br>
            Definitions and Legal References
            <br><br>
            Personal Information or Data
          </b>
          <br><br>
          Any information regarding a natural person, a legal person, an institution or an association, which is, or can be, identified, even indirectly, by reference to any other information, 
          including a personal identification number.
          <br><br>
          <b>Browsing and Usage Data</b>
          <br><br>
          Information collected automatically from the Site, including the IP addresses or domain names of the computers utilized by the users who connect to the site, the URI addresses (Uniform 
          Resource Identifier), the time of the request, the method utilized to submit the request to the server, the size of the file received in response, the numerical code indicating the 
          status of the server’s answer (successful outcome, error, etc.), the country of origin, the features of the browser and the operating system utilized by the visitor, the various time 
          details per visit (e.g., the time spent on each page) and the details about the path followed within the site with special reference to the sequence of pages visited, and other 
          parameters about the operating system and the user’s IT environment.
          <br><br>
          <b>User</b>
          <br><br>
          An individual using the Site’s services or products.
          <br><br>
          <b>Data Subject</b>
          <br><br>
          The legal or natural person to whom the Personal Data refer.
          <br><br>
          <b>Data Processor</b>
          <br><br>
          The natural person, legal person, public administration or any other organization, association or organization designated by the Data Controller for the Personal Data processing system.
          <br><br>
          <b>Data Controller</b>
          <br><br>
          The natural person, legal person, public administration or any other body, association or organization with the right, also jointly with another Data Controller, to make decisions 
          regarding the purposes, and the methods of processing of Personal Data and the means used, including the security measures concerning the operation and use of this Site.
          <br><br>
          <b>Legal Information</b>
          <br><br>
          In compliance with the Childrens’ Online Privacy Protection Act (COPPA) we do not collect Personal Identification Information from any individual under age 13 without parental consent. 
          We do not solicit or want Personal Identification Information from any minor children under age 18.
          <br><br>
          Notice to European Users: This privacy statement has been prepared in fulfillment of the obligations under Art. 10 of EC Directive n. 95/46/EC, and under the provisions of Directive 
          2002/58/EC, as revised by Directive 2009/136/EC, on the subject of Cookies.
          <br><br>
          This privacy statement applies solely and exclusively to the Site and is not meant to refer to other sites whose links are possibly contained therein.
          <br><br>
          <i>Latest update: <b>5/23/2017</b></i>
        </div>
        <div class="terms disabled">
          <div class="input-container">
            <div class="col-lg-3">
              <p class="url-text"> SIGNATURE </p>
            </div>
            <div class="col-lg-9">
              <input id="signature"></input>
            </div>
          </div>
          <div class="agree-term">
            <div class="checkbox enabled"><span class="x-button">X</span></div>
            <p>I agree to the&nbsp;</p>
            <p class="underline">Terms of Service and Privacy Policy.</p>
          </div>
          <p class="text-center submit-button disabled">
            <button  type="button"  data-dismiss="modal"
              data-toggle="modal" data-target="#thirdModal" id="submit" disabled>SUBMIT</button> 
          </p>
        </div>
      </div>   
    </div>
  </div>
</div>


<div class="modal fade forgot-password-popup" data-keyboard="false" data-backdrop="static" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:700px;">
    <div class="modal-content" style="border-radius: 0;">
      <div class="modal-header" style="padding:0;border:0;">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="row">
          <div class="col-lg-5 left-side">
            <style>
              .academy-popup {
                margin: 40px 0;
              }
              .academy-popup h1 {
                color: #fff;
                font-size: 28px;
                font-weight: 500;
                letter-spacing: 3px;
                margin-top: 88px;
                float: left;
                width: 100%;
              }
              .academy-popup h1 small, .academy-popup h4 {
                font-size: 12px;
                color: #fff;
              }
              .academy-popup h4 {
                font-size: 15px;
                font-weight: 200;
                line-height: 21px;
                padding-right: 25px;
              }
              .academy-popup .strong-title {
                margin-top: 10px;
              }
              .modal-header button.close {
                margin: 5px 10px 0 0;
              }
              .forgot-password-popup .left-side {
                margin:0;background-image:url(images/building-gradient.jpg);
                background-size: cover; 
                background-repeat:no-repeat; 
                padding-right:0;
                padding-left: 30px;
              }
              .forgot-password-popup .btn.sign-in {
                margin: 20px 0 50px;
                padding: 3px 37px;
                font-weight: 500;
              }
              .forgot-password-popup .title {
                float: left;
                width: 100%;
                margin: 60px 0 0;
                font-weight: 700;
                color: #f6087d;
                line-height: 33px;
              }
              .forgot-password-popup .form-horizontal .form-group {
                margin: 0;
              }
              .forgot-password-popup .form-horizontal .control-label {
                font-size: 16px;
                font-weight: 200;
                float: left;
                padding: 0;
                color: #000;
                margin: 30px 0 0;
                text-align: left;
                width: auto;
              }
              .forgot-password-popup input.form-control {
                width: 100%;
                float: left;
                height: 40px;
                margin: 10px 0 0;
                font-weight: 500;
                padding: 0 10px;
                font-size: 16px;
                border: 2px solid #d1d1d1;
                overflow: auto;
                outline: none;
                box-shadow: none;
                resize: none;
                border-radius: 0;
                background: transparent;
                -webkit-appearance: none;
              }
              .forgot-password-popup .forgot-button {
                color: #000;
                border-color: #d1d1d1;
                margin: 30px 0 0;
                padding: 5px 37px;
              }
              .forgot-password-popup .alert-success {
                float: left;
                width: 100%;
                margin: 10px 0 0;
              }
            </style>

            <div class="academy-popup">
              <h1>
                OOPS...<br>
                LOOKS LIKE<br>
                YOU NEED HELP<br>
                WITH YOUR<br>
                PASSWORD
              </h1>
              <button type="button" data-dismiss="modal" class="btn btn-outlined btn-primary sign-in"  data-toggle="modal" data-target="#fourthModal">
                SIGN-IN
              </button>
            </div>
            <!-- <img src="images/building-gradient.jpg" style="width:100%;"></img> -->
          </div>
          <div class="col-lg-7" style="padding:0 45px 0;">
            <div>
              <h1 class="modal-title title" id="d2">RESET<br>PASSWORD</h1>
              @include('auth.passwords.email')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<button id="success-password-button" type="button" data-dismiss="modal" class="btn btn-outlined btn-primary"  data-toggle="modal" data-target="#successPassowrdModal" style="display:none;">
  Success Password
</button>
<div class="modal fade success-password" data-keyboard="false" data-backdrop="static" id="successPassowrdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">FORGOT PASSWORD EMAIL SENT</h1>
        <p class="text-center main-title third">
          PLEASE CHECK YOUR EMAIL TO
          <br>
          RESET YOUR PASSWORD
        </p>
        <div class="text-center">
          <button type="button" class="close done-button" data-dismiss="modal" aria-label="Close">
            DONE
          </button>
        </div>
      </div>   
    </div>
  </div>
</div>

<button id="success-register-button" type="button" data-dismiss="modal" class="btn btn-outlined btn-primary"  data-toggle="modal" data-target="#successRegisterModal" style="display:none;">
  Success Register
</button>
<div class="modal fade success-register" data-keyboard="false" data-backdrop="static" id="successRegisterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">EMAIL CONFIRMATION SENT</h1>
        <p class="text-center main-title third">
          PLEASE CHECK YOUR EMAIL TO
          <br>
          COMPLETE YOUR REGISTRATION
        </p>
        <div class="text-center">
          <a href="/profile">
            <button type="button" class="close done-button">
              NEXT
            </button>
          </a>
        </div>
      </div>   
    </div>
  </div>
</div>

@if(Session::has('alert-success'))
  <!-- <p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p> -->
  <script>
    $("#success-register-button").trigger("click");
  </script>
@endif

<div class="modal fade tell-yourself business-services-page" data-keyboard="false" data-backdrop="static" id="webServiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <!-- <h4 class="modal-title" id="myModalLabel">
          <p class="text-center">WEB DESIGN SERVICE </p>
        </h4> -->
        <h1 class="sub-header text-center">WEB DESIGN SERVICE</h1>
        <h2 class="sub-header text-center">TO RECEIVE A QUOTE, SUBMIT YOUR INFORMATION BELOW:</h2>
      </div>

      <div class="modal-body">
        {!! Form::open(array('url' => 'service/business', 'method' => 'post')) !!}
          {{ csrf_field() }}
        <div class="form-group name">
          <p class="text-left profile-content"> NAME</p>
          <input id="fname" placeholder="first name" name="fname"></input>
          @if ($errors->has('fname'))
            <div class="error">{{ $errors->first('fname') }}</div>
          @endif
          <input id="lname" placeholder="last name" name="lname"></input>
          @if ($errors->has('lname'))
            <div class="error">{{ $errors->first('lname') }}</div>
          @endif
        </div>
        <div class="form-group company-name">
          <p class="text-left profile-content"> COMPANY NAME</p>
          <input id="company" placeholder="company name" name="company"></input>
        </div>
        <div class="form-group email">
          <p class="text-left profile-content"> EMAIL</p>
          <input id="email" placeholder="email address" name="email"></input>
          @if ($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
          @endif
        </div>
        <div class="form-group contact">
          <div>
            <p class="text-left profile-content"> PHONE NUMBER</p>
            <input id="phone" placeholder="###-###-####" name="phone"></input>
            @if ($errors->has('phone'))
              <div class="error">{{ $errors->first('phone') }}</div>
            @endif
          </div>
          <div>
            <p class="text-left profile-content"> BEST TIME TO CONTACT?</p>
            <select id="contact_type" name="contact_type">
              <option value="morning">morning</option>
              <option value="afternoon">afternoon</option>
              <option value="night">night</option>
            </select> 
          </div>
        </div>
        <div class="form-group location">
          <div>
            <p class="text-left profile-content"> CITY </p>
            <input id="city" value="San Francisco" name="city"></input>
          </div>
          <div>
            <p class="text-left profile-content"> STATE </p>
            <select id="state_type" name="state_type">
            <option value="Alabama">AL</option>
            <option value="Alaska">AK</option>
            <option value="Arizona">AZ</option>
            <option value="Arkansas">AR</option>
            <option value="California">CA</option>
            <option value="Colorado">CO</option>
            <option value="Connecticut">CT</option>
            <option value="Delaware">DE</option>
            <option value="Florida">FL</option>
            <option value="Georgia">GA</option>
            <option value="Hawaii">HI</option>
            <option value="Idaho">ID</option>
            <option value="Illinois">IL</option>
            <option value="Indiana">IN</option>
            <option value="Iowa">IA</option>
            <option value="Kansas">KS</option>
            <option value="Kentucky">KY</option>
            <option value="Louisiana">LA</option>
            <option value="Maine">ME</option>
            <option value="Maryland">MD</option>
            <option value="Massachusetts">MA</option>
            <option value="Michigan">MI</option>
            <option value="Minnesota">MN</option>
            <option value="Misissippi">MS</option>
            <option value="Missouri">MO</option>
            <option value="Montana">MT</option>
            <option value="Nebraska">NE</option>
            <option value="Nevada">NV</option>
            <option value="New_Hampshire">NH</option>
            <option value="New_Jersey">NJ</option>
            <option value="New_Mexico">NM</option>
            <option value="New_York">NY</option>
            <option value="North_Carolina">NC</option>
            <option value="North_Dakota">ND</option>
            <option value="Ohio">OH</option>
            <option value="Oklahoma">OK</option>
            <option value="Oregon">OR</option>
            <option value="Pennsylvania">PA</option>
            <option value="Rhode_Island">RI</option>
            <option value="South_Carolina">SC</option>
            <option value="South_Dakota">SD</option>
            <option value="Tennessee">TN</option>
            <option value="Texas">TX</option>
            <option value="Utah">UT</option>
            <option value="Vermont">VT</option>
            <option value="Virginia">VA</option>
            <option value="Washington">WA</option>
            <option value="West_Virginia">WV</option>
            <option value="Wisconson">WI</option>
            <option value="Wyoming">WY</option>
            </select>
          </div>
        </div>
        <div class="form-group zip-code">
          <p class="text-left profile-content"> ZIP CODE </p>
          <input id="zipcode" placeholder="#####" name="zipcode"></input>
        </div>            
        <div class="form-group business-goal">
          <p class="text-left profile-content"> WHAT IS YOUR BUSINESS GOAL FOR A WEBSITE? </p>
          <textarea id="information" name="information"></textarea>
          @if ($errors->has('information'))
            <div class="error">{{ $errors->first('information') }}</div>
          @endif
        </div>            
      </div>

      <div class="modal-footer">
        <p class="text-left button-container">
          <button type="submit" class="btn btn-primary class" id="save">
            SUBMIT QUOTE
          </button> 
        </p>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="modal fade tell-yourself business-services-page" data-keyboard="false" data-backdrop="static" id="apparelServiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <!-- <h4 class="modal-title" id="myModalLabel">
          <p class="text-center">APPAREL DESIGN SERVICE</p>
        </h4> -->
        <h1 class="sub-header text-center">APPAREL DESIGN SERVICE</h1>
      </div>

      <div class="modal-body">
        {!! Form::open(array('url' => 'service/business', 'method' => 'post')) !!}
          {{ csrf_field() }}
        <div class="form-group name">
          <p class="text-left profile-content"> NAME</p>
          <input id="fname" placeholder="first name" name="fname"></input>
          @if ($errors->has('fname'))
            <div class="error">{{ $errors->first('fname') }}</div>
          @endif
          <input id="lname" placeholder="last name" name="lname"></input>
          @if ($errors->has('lname'))
            <div class="error">{{ $errors->first('lname') }}</div>
          @endif
        </div>
        <div class="form-group company-name">
          <p class="text-left profile-content"> COMPANY NAME</p>
          <input id="company" placeholder="company name" name="company"></input>
        </div>
        <div class="form-group email">
          <p class="text-left profile-content"> EMAIL</p>
          <input id="email" placeholder="email address" name="email"></input>
          @if ($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
          @endif
        </div>
        <div class="form-group contact">
          <div>
            <p class="text-left profile-content"> PHONE NUMBER</p>
            <input id="phone" placeholder="###-###-####" name="phone"></input>
            @if ($errors->has('phone'))
              <div class="error">{{ $errors->first('phone') }}</div>
            @endif
          </div>
          <div>
            <p class="text-left profile-content"> BEST TIME TO CONTACT?</p>
            <select id="contact_type" name="contact_type">
              <option value="morning">morning</option>
              <option value="afternoon">afternoon</option>
              <option value="night">night</option>
            </select> 
          </div>
        </div>
        <div class="form-group location">
          <div>
            <p class="text-left profile-content"> CITY </p>
            <input id="city" value="San Francisco" name="city"></input>
          </div>
          <div>
            <p class="text-left profile-content"> STATE </p>
            <select id="state_type" name="state_type">
            <option value="Alabama">AL</option>
            <option value="Alaska">AK</option>
            <option value="Arizona">AZ</option>
            <option value="Arkansas">AR</option>
            <option value="California">CA</option>
            <option value="Colorado">CO</option>
            <option value="Connecticut">CT</option>
            <option value="Delaware">DE</option>
            <option value="Florida">FL</option>
            <option value="Georgia">GA</option>
            <option value="Hawaii">HI</option>
            <option value="Idaho">ID</option>
            <option value="Illinois">IL</option>
            <option value="Indiana">IN</option>
            <option value="Iowa">IA</option>
            <option value="Kansas">KS</option>
            <option value="Kentucky">KY</option>
            <option value="Louisiana">LA</option>
            <option value="Maine">ME</option>
            <option value="Maryland">MD</option>
            <option value="Massachusetts">MA</option>
            <option value="Michigan">MI</option>
            <option value="Minnesota">MN</option>
            <option value="Misissippi">MS</option>
            <option value="Missouri">MO</option>
            <option value="Montana">MT</option>
            <option value="Nebraska">NE</option>
            <option value="Nevada">NV</option>
            <option value="New_Hampshire">NH</option>
            <option value="New_Jersey">NJ</option>
            <option value="New_Mexico">NM</option>
            <option value="New_York">NY</option>
            <option value="North_Carolina">NC</option>
            <option value="North_Dakota">ND</option>
            <option value="Ohio">OH</option>
            <option value="Oklahoma">OK</option>
            <option value="Oregon">OR</option>
            <option value="Pennsylvania">PA</option>
            <option value="Rhode_Island">RI</option>
            <option value="South_Carolina">SC</option>
            <option value="South_Dakota">SD</option>
            <option value="Tennessee">TN</option>
            <option value="Texas">TX</option>
            <option value="Utah">UT</option>
            <option value="Vermont">VT</option>
            <option value="Virginia">VA</option>
            <option value="Washington">WA</option>
            <option value="West_Virginia">WV</option>
            <option value="Wisconson">WI</option>
            <option value="Wyoming">WY</option>
            </select>
          </div>
        </div>
        <div class="form-group zip-code">
          <p class="text-left profile-content"> ZIP CODE </p>
          <input id="zipcode" placeholder="#####" name="zipcode"></input>
        </div>            
        <div class="form-group business-goal">
          <p class="text-left profile-content"> WHAT IS YOUR BUSINESS GOAL FOR APPAREL DESIGN? </p>
          <textarea id="information" name="information"></textarea>
          @if ($errors->has('information'))
            <div class="error">{{ $errors->first('information') }}</div>
          @endif
        </div>            
      </div>

      <div class="modal-footer">
        <p class="text-left button-container">
          <button type="submit" class="btn btn-primary class" id="save">
            SUBMIT QUOTE
          </button> 
        </p>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="modal fade tell-yourself business-services-page" data-keyboard="false" data-backdrop="static" id="socialServiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <!-- <h4 class="modal-title" id="myModalLabel">
          <p class="text-center">SOCIAL MEDIA SERVICE</p>
        </h4> -->        
        <h1 class="sub-header text-center">SOCIAL MEDIA SERVICE</h1>
      </div>
      <div class="modal-body">
        {!! Form::open(array('url' => 'service/business', 'method' => 'post')) !!}
          {{ csrf_field() }}
        <div class="form-group name">
          <p class="text-left profile-content"> NAME</p>
          <input id="fname" placeholder="first name" name="fname"></input>
          @if ($errors->has('fname'))
            <div class="error">{{ $errors->first('fname') }}</div>
          @endif
          <input id="lname" placeholder="last name" name="lname"></input>
          @if ($errors->has('lname'))
            <div class="error">{{ $errors->first('lname') }}</div>
          @endif
        </div>
        <div class="form-group company-name">
          <p class="text-left profile-content"> COMPANY NAME</p>
          <input id="company" placeholder="company name" name="company"></input>
        </div>
        <div class="form-group email">
          <p class="text-left profile-content"> EMAIL</p>
          <input id="email" placeholder="email address" name="email"></input>
          @if ($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
          @endif
        </div>
        <div class="form-group contact">
          <div>
            <p class="text-left profile-content"> PHONE NUMBER</p>
            <input id="phone" placeholder="###-###-####" name="phone"></input>
            @if ($errors->has('phone'))
              <div class="error">{{ $errors->first('phone') }}</div>
            @endif
          </div>
          <div>
            <p class="text-left profile-content"> BEST TIME TO CONTACT?</p>
            <select id="contact_type" name="contact_type">
              <option value="morning">morning</option>
              <option value="afternoon">afternoon</option>
              <option value="night">night</option>
            </select> 
          </div>
        </div>
        <div class="form-group location">
          <div>
            <p class="text-left profile-content"> CITY </p>
            <input id="city" value="San Francisco" name="city"></input>
          </div>
          <div>
            <p class="text-left profile-content"> STATE </p>
            <select id="state_type" name="state_type">
            <option value="Alabama">AL</option>
            <option value="Alaska">AK</option>
            <option value="Arizona">AZ</option>
            <option value="Arkansas">AR</option>
            <option value="California">CA</option>
            <option value="Colorado">CO</option>
            <option value="Connecticut">CT</option>
            <option value="Delaware">DE</option>
            <option value="Florida">FL</option>
            <option value="Georgia">GA</option>
            <option value="Hawaii">HI</option>
            <option value="Idaho">ID</option>
            <option value="Illinois">IL</option>
            <option value="Indiana">IN</option>
            <option value="Iowa">IA</option>
            <option value="Kansas">KS</option>
            <option value="Kentucky">KY</option>
            <option value="Louisiana">LA</option>
            <option value="Maine">ME</option>
            <option value="Maryland">MD</option>
            <option value="Massachusetts">MA</option>
            <option value="Michigan">MI</option>
            <option value="Minnesota">MN</option>
            <option value="Misissippi">MS</option>
            <option value="Missouri">MO</option>
            <option value="Montana">MT</option>
            <option value="Nebraska">NE</option>
            <option value="Nevada">NV</option>
            <option value="New_Hampshire">NH</option>
            <option value="New_Jersey">NJ</option>
            <option value="New_Mexico">NM</option>
            <option value="New_York">NY</option>
            <option value="North_Carolina">NC</option>
            <option value="North_Dakota">ND</option>
            <option value="Ohio">OH</option>
            <option value="Oklahoma">OK</option>
            <option value="Oregon">OR</option>
            <option value="Pennsylvania">PA</option>
            <option value="Rhode_Island">RI</option>
            <option value="South_Carolina">SC</option>
            <option value="South_Dakota">SD</option>
            <option value="Tennessee">TN</option>
            <option value="Texas">TX</option>
            <option value="Utah">UT</option>
            <option value="Vermont">VT</option>
            <option value="Virginia">VA</option>
            <option value="Washington">WA</option>
            <option value="West_Virginia">WV</option>
            <option value="Wisconson">WI</option>
            <option value="Wyoming">WY</option>
            </select>
          </div>
        </div>
        <div class="form-group zip-code">
          <p class="text-left profile-content"> ZIP CODE </p>
          <input id="zipcode" placeholder="#####" name="zipcode"></input>
        </div>            
        <div class="form-group business-goal">
          <p class="text-left profile-content"> WHAT IS YOUR BUSINESS GOAL FOR SOCIAL MEDIA MARKETING? </p>
          <textarea id="information" name="information"></textarea>
          @if ($errors->has('information'))
            <div class="error">{{ $errors->first('information') }}</div>
          @endif
        </div>            
      </div>

      <div class="modal-footer">
        <p class="text-left button-container">
          <button type="submit" class="btn btn-primary class" id="save">
            SUBMIT QUOTE
          </button> 
        </p>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="modal fade tell-yourself business-services-page" data-keyboard="false" data-backdrop="static" id="businessServiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <!-- <h4 class="modal-title" id="myModalLabel">
          <p class="text-center">BUSINESS ACCELERATOR SERVICE</p>
        </h4> -->
        <h1 class="sub-header text-center">BUSINESS ACCELERATOR SERVICE</h1>
      </div>

      <div class="modal-body">
        {!! Form::open(array('url' => 'service/business', 'method' => 'post')) !!}
          {{ csrf_field() }}
        <div class="form-group name">
          <p class="text-left profile-content"> NAME</p>
          <input id="fname" placeholder="first name" name="fname"></input>
          @if ($errors->has('fname'))
            <div class="error">{{ $errors->first('fname') }}</div>
          @endif
          <input id="lname" placeholder="last name" name="lname"></input>
          @if ($errors->has('lname'))
            <div class="error">{{ $errors->first('lname') }}</div>
          @endif
        </div>
        <div class="form-group company-name">
          <p class="text-left profile-content"> COMPANY NAME</p>
          <input id="company" placeholder="company name" name="company"></input>
        </div>
        <div class="form-group email">
          <p class="text-left profile-content"> EMAIL</p>
          <input id="email" placeholder="email address" name="email"></input>
          @if ($errors->has('email'))
            <div class="error">{{ $errors->first('email') }}</div>
          @endif
        </div>
        <div class="form-group contact">
          <div>
            <p class="text-left profile-content"> PHONE NUMBER</p>
            <input id="phone" placeholder="###-###-####" name="phone"></input>
            @if ($errors->has('phone'))
              <div class="error">{{ $errors->first('phone') }}</div>
            @endif
          </div>
          <div>
            <p class="text-left profile-content"> BEST TIME TO CONTACT?</p>
            <select id="contact_type" name="contact_type">
              <option value="morning">morning</option>
              <option value="afternoon">afternoon</option>
              <option value="night">night</option>
            </select> 
          </div>
        </div>
        <div class="form-group location">
          <div>
            <p class="text-left profile-content"> CITY </p>
            <input id="city" value="San Francisco" name="city"></input>
          </div>
          <div>
            <p class="text-left profile-content"> STATE </p>
            <select id="state_type" name="state_type">
            <option value="Alabama">AL</option>
            <option value="Alaska">AK</option>
            <option value="Arizona">AZ</option>
            <option value="Arkansas">AR</option>
            <option value="California">CA</option>
            <option value="Colorado">CO</option>
            <option value="Connecticut">CT</option>
            <option value="Delaware">DE</option>
            <option value="Florida">FL</option>
            <option value="Georgia">GA</option>
            <option value="Hawaii">HI</option>
            <option value="Idaho">ID</option>
            <option value="Illinois">IL</option>
            <option value="Indiana">IN</option>
            <option value="Iowa">IA</option>
            <option value="Kansas">KS</option>
            <option value="Kentucky">KY</option>
            <option value="Louisiana">LA</option>
            <option value="Maine">ME</option>
            <option value="Maryland">MD</option>
            <option value="Massachusetts">MA</option>
            <option value="Michigan">MI</option>
            <option value="Minnesota">MN</option>
            <option value="Misissippi">MS</option>
            <option value="Missouri">MO</option>
            <option value="Montana">MT</option>
            <option value="Nebraska">NE</option>
            <option value="Nevada">NV</option>
            <option value="New_Hampshire">NH</option>
            <option value="New_Jersey">NJ</option>
            <option value="New_Mexico">NM</option>
            <option value="New_York">NY</option>
            <option value="North_Carolina">NC</option>
            <option value="North_Dakota">ND</option>
            <option value="Ohio">OH</option>
            <option value="Oklahoma">OK</option>
            <option value="Oregon">OR</option>
            <option value="Pennsylvania">PA</option>
            <option value="Rhode_Island">RI</option>
            <option value="South_Carolina">SC</option>
            <option value="South_Dakota">SD</option>
            <option value="Tennessee">TN</option>
            <option value="Texas">TX</option>
            <option value="Utah">UT</option>
            <option value="Vermont">VT</option>
            <option value="Virginia">VA</option>
            <option value="Washington">WA</option>
            <option value="West_Virginia">WV</option>
            <option value="Wisconson">WI</option>
            <option value="Wyoming">WY</option>
            </select>
          </div>
        </div>
        <div class="form-group zip-code">
          <p class="text-left profile-content"> ZIP CODE </p>
          <input id="zipcode" placeholder="#####" name="zipcode"></input>
        </div>            
        <div class="form-group business-goal">
          <p class="text-left profile-content"> WHAT IS YOUR BUSINESS GOAL? </p>
          <textarea id="information" name="information"></textarea>
          @if ($errors->has('information'))
            <div class="error">{{ $errors->first('information') }}</div>
          @endif
        </div>            
      </div>

      <div class="modal-footer">
        <p class="text-left button-container">
          <button type="submit" class="btn btn-primary class" id="save">
            SUBMIT QUOTE
          </button> 
        </p>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>