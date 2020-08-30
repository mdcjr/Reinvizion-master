<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">

<title>Reinvizion.com</title>


<!-- Bootstrap core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug-->
<!-- <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">  -->

 <!-- Custom styles for this template -->
<!-- <link href="/css/justified-nav.css" rel="stylesheet"> -->

<!-- Custom styles for this template -->
<!-- <link href="/css/signin.css" rel="stylesheet"> -->

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- <script src="/js/ie-emulation-modes-warning.js"></script> -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Custom styles for this template -->
<!-- <link href="/css/carousel.css" rel="stylesheet"> -->
<!-- Bootstrap Core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet" >

<!-- Custom CSS -->

<script src="/js/jquery.min.js"></script>
<script src="/js/jquery-1.9.1.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>


<!-- Custom Fonts -->
<link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script>
function populate(s1,s2){
    var s1 = document.getElementById(s1);
    var s2 = document.getElementById(s2);
    s2.innerHTML = "";
      
   
    if(s1.value == "Student"){
            var optionArray = ["|","HS|HS","College-Major/Minor|College-Major/Minor"];
    }else if(s1.value == "Business Owner"){
        var optionArray = ["|","Field of Business|Field of Business","Occupation|Occupation"];
    }else if(s1.value == "Career Change"){
            var optionArray = ["|","Business|Field of Business","Occupation|Occupation"];
    }else if(s1.value == "Aspiring Entrepreneur"){
            var optionArray = ["|","Field of Business|Field of Business","Occupation|Occupation"];
    } 



    for(var option in optionArray){
        var pair = optionArray[option].split("|");
        var newOption = document.createElement("option");
        newOption.value = pair[0];
        newOption.innerHTML = pair[1];
        s2.options.add(newOption);
    }
}
</script>