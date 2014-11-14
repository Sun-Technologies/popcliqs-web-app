<html>
	<head>
		<title>my title.</title>
         <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
	</head>
	<body>
	<?php if(isset($status)) {?>
			<h3 class="notice"><?php echo $status; }?></h3>


		<form action="" method="POST">

		<UL>

			<li>
				<label for="event_title">EVENT NAME</label>
				<textarea name="event_title" id="event_title"></textarea>
			</li>

			<li>
				<label for="description">DISCRIPTION</label>
				
				<textarea name="description" id="discription"></textarea>
				</li>
                     <br/>
			<li>
				<label for="category_id">category:</label>
				<select name="category_id" id="category_id" > 
        		    <option value="">category</option>
        			<option value="1">sports</option>
        			<option value="2">professional</option>
        			<option value="3">education</option>
        			<option value="4">support group</option>
        			<option value="5">Arts</option>
        			<option value="6">Outdoor</option>
        			<option value="7">Party</option>
        		</select>
			</li>

			<li>
			<label for="location">location:</label>
			<input type="text" name="location" value="">
			</li>

			<li>
			<label for="address">Address:</label>
			<input type="text" name="address" value="">
			</li>

			<li>
			<label for="city">city:</label>
			<input type="text" name="city" value="">
			</li>

			<li>
			<label for="state">state:</label>
			<input type="text" name="state" value="">
			</li>

			<li>
			<label for="postal_code">Zip code</label>
			<input type="text" name="postal_code" value="">
			</li>

			<li>
			<input type="radio" name="age_limit" value="1">anyone<br/>
            <input type="radio" name="age_limit" value="2">above-18<br/>
            <input type="radio" name="age_limit" value="3">above-21<br/>
            </li>

            <li>
            	<label for="capacity">capacity limit</label>
            	<input type="text" name="capacity" value="">
            </li>
                   <p>Enter as mm/dd/yy</p>
            <li>
            	<label for="start_date">start date:</label>
			    <input type="text" name="start_date" value="">
			    <select name="start_time" id="start_time">
			    	<option value="">time</option>
			    	<option value="00:00">12:00 am</option>
        <option value="00:30">12:30 am</option>
        <option value="01:00">1:00 am</option>
        <option value="01:30">1:30 am</option>
        <option value="02:00">2:00 am</option>  
        <option value="02:30">2:30 am</option>  
        <option value="03:00">3:00 am</option>
        <option value="03:30">3:30 am</option>
        <option value="04:00">4:00 am</option>
        <option value="04:30">4:30 am</option>
        <option value="05:00">5:00 am</option>  
        <option value="05:30">5:30 am</option>   
        <option value="06:00">6:00 am</option>
        <option value="06:30">6:30 am</option>
        <option value="07:00">7:00 am</option>
        <option value="07:30">7:30 am</option>
        <option value="08:00">8:00 am</option>   
        <option value="08:30">8:30 am</option>   
        <option value="09:00">9:00 am</option>
        <option value="09:30">9:30 am</option>   
        <option value="10:00">10:00 am</option>
        <option value="10:30">10:30 am</option>
        <option value="11:00">11:00 am</option>
        <option value="11:30">11:30 am</option>
        <option value="12:00">12:00 pm</option> 
        <option value="12:30">12:30 pm</option>  
        <option value="13:00">1:00 pm</option>
        <option value="13:30">1:30 pm</option>
        <option value="14:00">2:00 pm</option>
        <option value="14:30">2:30 pm</option>
        <option value="15:00">3:00 pm</option>
        <option value="15:30">3:30 pm</option>
        <option value="16:00">4:00 pm</option>
        <option value="16:30">4:30 pm</option>
        <option value="17:00">5:00 pm</option>
        <option value="17:30">5:30 pm</option>
        <option value="18:00">6:00 pm</option>
        <option value="18:30">6:30 pm</option>
        <option value="19:00">7:00 pm</option>
        <option value="19:30">7:30 pm</option>
        <option value="20:00">8:00 pm</option>
        <option value="20:30">8:30 pm</option>
        <option value="21:00">9:00 pm</option> 
        <option value="21:30">9:30 pm</option>
        <option value="22:00">10:00 pm</option>
        <option value="22:30">10:30 pm</option>
        <option value="23:00">11:00 pm</option>
        <option value="23:30">11:30 pm</option>
			    </select>
            </li>
               <p>Enter as mm/dd/yy</p>
            <li>
            	
    	<label for="end_date">end_date:</label>
	    <input type="text" name="end_date" value="">
    	<select name="end_time" id="end_time">
	    <option value="">end-time</option>
	    <option value="00:30">12:30 am</option>
        <option value="01:00">1:00 am</option>
        <option value="01:30">1:30 am</option>
        <option value="02:00">2:00 am</option>  
        <option value="02:30">2:30 am</option>  
        <option value="03:00">3:00 am</option>
        <option value="03:30">3:30 am</option>
        <option value="04:00">4:00 am</option>
        <option value="04:30">4:30 am</option>
        <option value="05:00">5:00 am</option>  
        <option value="05:30">5:30 am</option>   
        <option value="06:00">6:00 am</option>
        <option value="06:30">6:30 am</option>
        <option value="07:00">7:00 am</option>
        <option value="07:30">7:30 am</option>
        <option value="08:00">8:00 am</option>   
        <option value="08:30">8:30 am</option>   
        <option value="09:00">9:00 am</option>
        <option value="09:30">9:30 am</option>   
        <option value="10:00">10:00 am</option>
        <option value="10:30">10:30 am</option>
        <option value="11:00">11:00 am</option>
        <option value="11:30">11:30 am</option>
        <option value="12:00">12:00 pm</option> 
        <option value="12:30">12:30 pm</option>  
        <option value="13:00">1:00 pm</option>
        <option value="13:30">1:30 pm</option>
        <option value="14:00">2:00 pm</option>
        <option value="14:30">2:30 pm</option>
        <option value="15:00">3:00 pm</option>
        <option value="15:30">3:30 pm</option>
        <option value="16:00">4:00 pm</option>
        <option value="16:30">4:30 pm</option>
        <option value="17:00">5:00 pm</option>
        <option value="17:30">5:30 pm</option>
        <option value="18:00">6:00 pm</option>
        <option value="18:30">6:30 pm</option>
        <option value="19:00">7:00 pm</option>
        <option value="19:30">7:30 pm</option>
        <option value="20:00">8:00 pm</option>
        <option value="20:30">8:30 pm</option>
        <option value="21:00">9:00 pm</option> 
        <option value="21:30">9:30 pm</option>
        <option value="22:00">10:00 pm</option>
        <option value="22:30">10:30 pm</option>
        <option value="23:00">11:00 pm</option>
        <option value="23:30">11:30 pm</option>
			    </select>
            </li>

            <li>
            <input type="submit" value="GO!">
            </li>
		</UL>
			
		</form>
	</body>
</html>