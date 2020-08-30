$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  newExpCount = 0;

  var dtToday = new Date();

  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();

  if(month < 10)
      month = '0' + month.toString();
  if(day < 10)
      day = '0' + day.toString();

  var maxDate = year + '-' + month + '-' + day;    
  $(".edit-profile #birthdate").attr('max', maxDate);
  $(".prof-exp-popup #startDate").attr('max', maxDate);
  $(".prof-exp-popup #endDate").attr('max', maxDate);
  
  height = $(".container-fluid").height();
  $(".sidebar .sidebar-header").height(height);

  $(".sidebar-header button").bind("click", function(e){
    e.preventDefault();
    $(".sidebar li:first").animate({ 'margin-left': '-' + $('.sidebar li:first').width() + 'px' }, 350);
  });
  $(".sidebar .text-container p").bind("click", function(e){
    e.preventDefault();

    $(".sidebar li:first").animate({ 'margin-left': '0px' }, 350);
  });

  $("#header_user_name").bind("click", function(e) {
    e.preventDefault();
    $(".profile-dropdown").animate({height:'toggle'},350);
  });
  $(".user-notif-count").bind("click", function(e) {
    e.preventDefault();
    $(".notif-dropdown").animate({height:'toggle'},350);
  });

  $(".edit-profile button#save").bind('click', function(){
    email= $(".edit-profile #email");
    user_name= $(".edit-profile #user_name");
    occupation= $(".edit-profile #occupation");
    profession= $(".edit-profile #profession");
    school= $(".edit-profile #school");
    degree= $(".edit-profile #degree");
    birthdate= $(".edit-profile #birthdate");
    city= $(".edit-profile #city");
    state= $(".edit-profile #state");
    website= $(".edit-profile #website");
    phone= $(".edit-profile #phone");
    addr= $(".edit-profile #addr");
    bio= $(".edit-profile #bio");

    user_obj = {
      email: email.val(),
      user_name: user_name.val(),
      occupation: occupation.val(),
      profession: profession.val(),
      school: school.val(),
      degree: degree.val(),
      birthdate: birthdate.val(),
      city: city.val(),
      state: state.val(),
      website: website.val(),
      phone: phone.val(),
      addr: addr.val(),
      bio: bio.val()
    };
    $.ajax({
      type: "POST",
      url: '/updateUser',
      data: user_obj,
      success: function( msg ) {
        // console.log(msg);
        location.reload();
      }
    });
  });

$('.prof-exp-popup .save-button #save').bind('click', function() {
    divs = $(".prof-exp-popup .experience-container").map(function(){return $(this).attr("id");}).get();
    newDivs = $(".prof-exp-popup .new-exp-container").map(function(){return $(this).attr("id");}).get();

    ids = [];
    $.each(divs, function(i, div) {
      parent = ".experience-" + div;
      ids.push({
        id: div,
        title: $(parent + " #title").val(),
        field: $(parent + " #field").val(),
        comp_name: $(parent + " #comp_name").val(),
        start_date: $(parent + " #startDate").val(),
        end_date: $(parent + " #endDate").val()
      });
    });

    newExps = [];
    $.each(newDivs, function(i, div) {
      parent = ".new-exp-" + div;
      newExps.push({
        id: div,
        title: $(parent + " #title").val(),
        field: $(parent + " #field").val(),
        comp_name: $(parent + " #comp_name").val(),
        start_date: $(parent + " #startDate").val(),
        end_date: $(parent + " #endDate").val()
      });
    });

    exp_obj = {
      ids:ids,
      newExps:newExps
    };

    $.ajax({
      type: "POST",
      url: '/saveUpdateExperience',
      data: exp_obj,
      success: function( msg ) {
        location.reload();
      }
    });
  });

  $(".prof-exp-popup .add-exp span").bind('click',function(){
    addExpDiv = $(this);
    cloneDiv = $(".default-exp-container").clone();
    cloneDiv.removeClass("default-exp-container");
    cloneDiv.addClass("new-exp-container");
    cloneDiv.addClass("new-exp-" + newExpCount);
    cloneDiv.attr("id", newExpCount);

    cloneDiv.insertBefore($(".prof-exp-popup .add-exp"));
    $('<hr class="hr-main"></hr>').insertBefore($(".prof-exp-popup .add-exp"));

    $(".new-exp-" + newExpCount + " #endDate").val(maxDate);
    $(".new-exp-" + newExpCount + " #startDate").val(maxDate);

    $(".new-exp-" + newExpCount + " #current").attr("row", "new-exp-" + newExpCount);

    newExpCount = newExpCount + 1;
  });

  $(document).on("change", ".prof-exp-popup #current", function () {
    parent = "." + $(this).attr("row");
    if($(this).is(":checked")) {
      $(parent + " #endDate").prop("disabled", true);
      $(parent + " #endDate").addClass('disabled');
      $(parent + " #endDate").val(maxDate);
    }
    else {
      $(parent + " #endDate").prop("disabled", false);
      $(parent + " #endDate").removeClass('disabled');
    }
  });
});