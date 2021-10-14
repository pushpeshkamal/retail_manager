<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
    $(document).ready(function(){
        // type_holder
        // <div><label><input type="checkbox" class="types" value="mosque" />Mosque</label></div>

        var types = ['bakery','book_store','convenience_store','department_store','electronics_store','florist','home_goods_store','laundry'];
		var html = '';

        $.each(types, function( index, value ) {
            var name = value.replace(/_/g, " ");
            html += '<div><label><input type="checkbox" class="types" value="'+ value +'" />'+ capitalizeFirstLetter(name) +'</label></div>';
        });

        $('#type_holder').html(html);
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    var map;
    var infowindow;
    var autocomplete;
    var countryRestrict = {'country': 'in'};
    var selectedTypes = [];

    function initialize()
    {
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')), {
            types: ['(regions)'],
           // componentRestrictions: countryRestrict
        });

        var pyrmont = new google.maps.LatLng(19.033049, 73.029663);

        map = new google.maps.Map(document.getElementById('map'), {
            center: pyrmont,
            zoom: 12
        });
    }

    function renderMap()
    {
        // Get the user defined values
        var address = document.getElementById('address').value;
        var radius  = parseInt(document.getElementById('radius').value) * 1000;
        
        // get the selected type
        selectedTypes = [];
        $('.types').each(function(){
            if($(this).is(':checked'))
            {
                selectedTypes.push($(this).val());
            }
        });

        var geocoder    = new google.maps.Geocoder();
        var selLocLat   = 0;
        var selLocLng   = 0;

        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK')
            {
                //console.log(results[0].geometry.location.lat() + ' - ' + results[0].geometry.location.lng());

                selLocLat   = results[0].geometry.location.lat();
                selLocLng   = results[0].geometry.location.lng();

                //var pyrmont = new google.maps.LatLng(52.5666644, 4.7333304);

                var pyrmont = new google.maps.LatLng(selLocLat, selLocLng);

                map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 11
                });

                //console.log(selectedTypes);

                var request = {
                    location: pyrmont,
                    //radius: 5000,
                    radius: radius,
                    types: selectedTypes
                };

                infowindow = new google.maps.InfoWindow();

                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, callback);
            }
            else
            {
                alert('error 404 reason: ' + status);
            }
        });
    }

    function callback(results, status)
    {
        if (status == google.maps.places.PlacesServiceStatus.OK)
        {
            for (var i = 0; i < results.length; i++)
            {
                createMarker(results[i], results[i].icon);
            }
        }
    }

    function createMarker(place, icon) {
        var placeLoc = place.geometry.location;

        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location,
            icon: {
                url: icon,
                scaledSize: new google.maps.Size(20, 20) // pixels
            },
            animation: google.maps.Animation.DROP
        });
        
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(place.name+ '<br>' +place.vicinity);
            infowindow.open(map, this);
        });
    }
    </script>




<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 

	
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <!--<ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/banner1.png" alt="First slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/banner2.png" alt="Second slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/banner3.png" alt="Third slide">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
					-->
						<div style="float: left;">
    					<div id="map" style="width:450px; height:800px;"></div>
						</div>
		            </div>
			
					




<!--div style="float: right; width: 400;">
    <form name="frm_map" id="frm_map">
        <table>
            <tr>
                <th>Types</th>
                <td>
                    <div id="type_holder" style="height: 120px; overflow-y: scroll;">
                        <-- Dynamic Content ->    
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="button" value="Show" id="submit" onclick="renderMap();">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</div-->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCU6bsx-PLT5fW02T5GeiwA8cOOY7l2rU4&libraries=places&callback=initialize" async defer></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>



<!--div class="content-wrapper">
	    <div class="container"-->

		            
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>