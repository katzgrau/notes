<?php include fe_view_path() . 'includes/header.php'; ?>

    <!-- Promo -->
    <div id="col-top"></div>
    <div id="col" class="box">
        
      <div id="col-text2">

			<form action="" method="get" id="contactform">
				<p>
					<label for="subject">Subject</label><br />
         		<select id="subject" name="subject" tabindex="1">
           			<option value="1">Technical Support</option>
          			<option value="2">Billing</option>
          	 		<option value="3">Comments & Suggestions</option>
					<option value="3">Other</option>
         		</select>

				</p>	
			
				<p>	
					<label for="name">Your Name</label><br />
					<input id="name" name="name" value="Your Name" onclick="this.value='';" type="text" tabindex="2" />
				</p>
			
				<p>
					<label for="email">Your Email Address</label><br />
					<input id="email" name="email" value="Your Email" onclick="this.value='';" type="text" tabindex="3" />
				</p>

					
				<p>
					<label for="message">Your Message</label><br />
					<textarea id="message" name="message" rows="10" cols="20" tabindex="4"></textarea>
				</p>	
			
				<p class="no-border">
					<input class="button" type="submit" value="Submit" tabindex="5" />
         		<input class="button" type="reset" value="Reset" tabindex="6" />	
				</p>
					
			</form>	

        </div> <!-- /col-text -->
    
    </div> <!-- /col -->
    <div id="col-bottom"></div>
    
    <hr class="noscreen" />
    

<?php include fe_view_path() . 'includes/footer.php'; ?>