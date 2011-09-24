<?php if( config_item('individual_accounts_enabled') ): ?>
<?php 
	$this->load->helper( 'text' ); 
	$this->load->helper( config_item('news_strategy_helper') ); 
	$news_items = get_news_items_array();
?>
<div id="cols2-top"></div>

    <div id="cols2" class="box">
    
        <!-- Blog -->
        <div id="col-left">

            <div class="title">
                <h4>Update Logger</h4>
            </div> <!-- /title -->
            
            <ul class="ul-list nomb">
			
			<?php foreach( $news_items as $news_item ): ?>
                <li><span class="f-right"><a href="<?php echo get_news_item_url( $news_item->id ); ?>" class="ico-comment">Read &amp; Comment</a></span> <span class="date"><?php echo format_date( 'Y.m.d', $news_item->created_at );?></span> <a href="<?php echo get_news_item_url( $news_item->id ); ?>" class="article"><?php echo substr( $news_item->text, 0, 60 ) . '...'; ?></a></li>
            <?php endforeach; ?>   
                
            </ul>
        
        </div> <!-- /col-left -->

        <hr class="noscreen" />

        <!-- Testimonials -->
        <div id="col-right">
        
            <h4><span>Testimonials</span></h4>

            <div class="box">
            
                <div class="col-right-img"><img src="#" width="65" height="65" alt="" /></div>
                <div class="col-right-text">

                    <p>I've done my best to make this system as easy to use as possible. If it isn't, I haven't done my job!</p>
                    <p class="high smaller">&ndash; <cite><a target="_blank" href="http://<Site Name>/plumber">joe plumber</a>, Lead Developer of <Site Name></cite></p>

                </div> <!-- /col-right-text -->
            
            </div> <!-- /box -->
        
        </div> <!-- /col-right -->
    
    </div> <!-- /cols2 -->
	
    <div id="cols2-bottom"></div>
    <hr class="noscreen" />
<?php endif; ?>

    <!-- Footer -->
    <div id="footer">

        <!-- Do you want remove this backlinks? Look at www.nuviotemplates.com/payment.php -->
        <p class="f-right">System by <a href="http://plumber.com" target="_blank">plumber LLC</a></p>
        <!-- Do you want remove this backlinks? Look at www.nuviotemplates.com/payment.php -->

        <p>Copyright &copy;&nbsp;2009 <strong><a href="#"><Site Name></a></strong>, All Rights Reserved &reg;</p>

    </div> <!-- /footer -->

</div> <!-- /main -->
</body>
</html>
