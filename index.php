<?php

// Reset the forward cookie if reset flag is present.
if ((isset($_GET['c'])) && ($_GET['c'] == 1)){
    unset($_COOKIE['ie_district_url']);
    setcookie('ie_district_url', null, -1, '/');
// Forward user if district url cookie is set.
} else if (isset($_COOKIE['ie_district_url'])) {
    $district_url = $_COOKIE['ie_district_url'];
    header('Location: http://'.$district_url);
    exit;
}

?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Illuminate Education Home Connection Portal</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="chosen.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <link href="https://code.jquery.com/ui/1.11.4/themes/flick/jquery-ui.css" rel="stylesheet">
        <script src="./js/jquery.cookie.js"></script>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        <script>
            $(function() {
                $('#site-list-autocomplete').autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            dataType: "json",
                            data: {
                                term: request.term,
                            },
                            type: 'get',
                            contentType: 'application/json; charset=utf-8',
                            xhrFields: {
                                withCredentials: true
                            },
                            crossDomain: true,
                            cache: true,
                            url: './site_list.json',
                            success: function (data) {
                                console.log(data);
                                var array = $.map(data, function (item) {
                                    return {
                                        label: item.label,
                                        value: item.value
                                    }
                                });

                                // call the filter here
                                response($.ui.autocomplete.filter(array, request.term));
                            },
                            error: function (data) {

                            }
                        });
                    },
                    select: function(event, ui) {
                        $.cookie('ie_distruct_url', ui.item.value, { expires: 365, path: '/' });

                        window.location = 'https://' + ui.item.value.replace('illuminateed', 'illuminatehc') + '#from_app=1';
                    },
                    minLength: 3
                });
            });
        </script>
    </head>

    <body>

        <!-- Top content -->
        <div class="content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <img src = "assets/img/logo.png">
                    
                            <div class="description">
                            	<p>
	                            	Welcome to the Illuminate Home Connection Portal.
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-container">

                            <div class="form-box">
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
                                        <input id="site-list-autocomplete" placeholder="Enter Your School District / Org" type="text"  class="form-control chzn-select" />
			                     
			                        </div>
			                        
			                    </form>
		                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                        	<h3>More Instructions</h3>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

 
   

        <script src="assets/js/scripts.js"></script>
     
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>