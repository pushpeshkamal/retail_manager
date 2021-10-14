<body>
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

</script>




<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Trending Today</b></h3>
	  	</div>
	  	<div class="box-body">
	  		<ul id="trending">
	  		<?php
	  			$now = date('Y-m-d');
	  			$conn = $pdo->open();

	  			$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
	  			$stmt->execute(['now'=>$now]);
	  			foreach($stmt as $row){
	  				echo "<li><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  			$pdo->close();
	  		?>
	    	<ul>
	  	</div>
	</div>
</div>
<link href="style.css">
<script src="nearby.js"></script>



<div class="row">
<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Nearby Radar</b></h3>
			</div>
			<div class="box-body">
			
			<form name="frm_map" id="frm_map">
            <table>
			
            <p>Nearby stores in radius (km)</p>
			<select id="radius">
			<option value="select"> -SELECT-</option>
                <option value="5km"> 5 </option>
                <option value="10km"> 10 </option>
                <option value="15km"> 15 </option>
			
			</select>

			<br>
			<p><b>Address</b></p>
                <td>
                    <input type="text" name="address" id="address" value="Navi Mumbai">
                </td>
				<tr></tr>
                <tr>
                    <th>Category</th>
                    <td>
                        <div id="type_holder" style="height: 120px; overflow-y: scroll;">
						<input type="checkbox" id="category1" name="category1" value="category">
								<label for="vehicle1"> Bakery</label><br>
								<input type="checkbox" id="category1" name="category1" value="category">
						
								<label for="vehicle1"> Book store</label><br>
								<input type="checkbox" id="category1" name="category1" value="category">
								<label for="vehicle1"> Convenience store</label><br>
								<input type="checkbox" id="category1" name="category1" value="category">
								<label for="vehicle1"> Department store</label><br>
								<input type="checkbox" id="category1" name="category1" value="category">
								<label for="vehicle1"> Electronics store</label><br>
								<input type="checkbox" id="category1" name="category1" value="category">
								<label for="vehicle1"> Florist</label><br>
								<input type="checkbox" id="category1" name="category1" value="category">
								<label for="vehicle1"> Home goods store</label><br>
								<input type="checkbox" id="category1" name="category1" value="category">
								<label for="vehicle1"> Laundry</label><br>


                            <!-- Dynamic Content -->    
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
	  	</div>
	  	<div class="box-body">

	  	</div>
	</div>
</div>			  

<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Subscribe for newletter</b></h3>
	  	</div>
	  	<div class="box-body">
	    	<p>Get free updates on the latest products and discounts, straight to your inbox.</p>
	    	<form method="POST" action="">
		    	<div class="input-group">
	                <input type="text" class="form-control">
	                <span class="input-group-btn">
	                    <button type="button" class="btn btn-info btn-flat"><i class="fa fa-envelope"></i> </button>
	                </span>
	            </div>
		    </form>
	  	</div>
	</div>
</div>

<div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUOeOifFyiLPQYANrBtqGnfk3CCjxMQKo&libraries=places&callback=initMap" async defer></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


</body>