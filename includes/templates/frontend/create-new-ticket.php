
<div class="enzaime-support">
    <?php
        global $post;

        $user = wp_get_current_user();
    ?>
    
   
    <div class="support__table-content">
        <div class="btn">
        	<a class="create_new_ticket" href="<?php echo site_url($post->post_name . '?action=helpscout-ticket-list');?>"> Support</a>
        </div>
        
		<div class="enzaime__support-ticket-section">
		    <div class="enzaime__support-ticket-message">
		        <!-- <p><?php printf( 'Hello %s, what can we help you with today?', $user->first_name ); ?></p> -->
		        <p><?php echo _e('Hello <label>'.$user->first_name.'</label>, what can we help you with today?'); ?></p>
		    </div>

		    <!-- support status -->

		    <div class="support-status clearfix enzaime__support-status">
		        <div class="enzaime__office-hour">
		            <p class="office-hour">
		            <strong>Office Hour:</strong> <br> Monday - Friday <br>/ 8am - 5pm (GMT+6)
		            </p>
		        </div>
		        <div class="enzaime_our-time" id="time-diff">
		            <p class="our-time-wrap">
		                <strong>Our time:</strong> <span class="our-time"><?php echo date( 'g:i A' ); ?></span>
		            </p>
		        </div>
		        <div class="enzaime_your-time" id="time-diff">
		            <p class="your-time-wrap">
		                <strong>Your time:</strong><span class="local-time"><?php echo date( 'g:i A' ); ?></span>
		            </p>
		        </div>
		    </div>

		</div>


        <div class="support__inner-table">
            <?php echo do_shortcode('[weforms id="93"]'); ?>
        </div>
    </div>
</div>


<script type="text/javascript">
    function wds_visitor_clock() {
        var currentTime = new Date ( );
        var currentHours = currentTime.getHours ( );
        var currentMinutes = currentTime.getMinutes ( );
        var currentSeconds = currentTime.getSeconds ( );

        // Pad the minutes and seconds with leading zeros, if required
        currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
        currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

        // Choose either "AM" or "PM" as appropriate
        var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

        // Convert the hours component to 12-hour format if needed
        currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

        // Convert an hours component of "0" to "12"
        currentHours = ( currentHours == 0 ) ? 12 : currentHours;

        // Compose the string for display
        var currentTimeString = currentHours + ":" + currentMinutes + " " + timeOfDay;


        jQuery("#time-diff .local-time").html(currentTimeString);

    }

    function wds_our_clock () {
        Date.withOffset = function (offset) {
            d = new Date();
            utc = d.getTime() + (d.getTimezoneOffset() * 60000);
            nd = new Date(utc + (3600000 * offset));
            return nd;
        };
        var currentTime = Date.withOffset(6);
        var currentHours = currentTime.getHours();
        var currentMinutes = currentTime.getMinutes();
        var currentSeconds = currentTime.getSeconds();
        currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
        currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
        var timeOfDay = (currentHours < 12) ? "AM" : "PM";
        currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;
        currentHours = (currentHours == 0) ? 12 : currentHours;
        var currentTimeString = currentHours + ":" + currentMinutes + " " + timeOfDay;

        jQuery("#time-diff .our-time").html(currentTimeString);
    }

    jQuery(document).ready(function() {
       setInterval('wds_visitor_clock()', 1000);
       setInterval('wds_our_clock()', 1000);
    });
</script>

