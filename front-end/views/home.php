<?php include fe_view_path() . 'includes/header.php'; ?>

    <!-- Promo -->
    <div id="col-top"></div>
    <div id="col" class="box">
    
        <div id="ribbon"></div> <!-- /ribbon (design/ribbon.gif) -->
        
        <!-- Screenshot in browser (replace tmp/browser.gif) -->
		<!--  -->
        <div id="col-browser"><div style="border: 1px solid #cccccc; background-color: #ffffff; height: 264px; width: 390px; top: 0px; left: 0px;"><img src="<?= fe_resource_base() ?>tmp/writing.jpg" style="position: relative; left: 5px; top:5px;" width="380" /></div></div>
        
        <div id="col-text">

            <h2 id="slogan"><span></span></h2>
            
            <p><strong><Site Name></strong> is a website building tool for teachers.
                        Building a website used to be a chore for even advanced users, but with <Site Name>,
                        you can craft a <a href="<?= base_url() ?>ms-green">beautiful, professional website</a> for your classroom in minutes. With
                        <a href="<?= base_url() ?>help">our brand new help section</a>, complete with written and video tutorials, using our service
        `               couldn't be easier. Post notes, announcements, notes, contact information, and keep in touch
                        with parents. <a href="<?= base_url() ?>home/how_it_works">See what <Site Name> can do for you, or your school</a>.</p>

            <p id="btns">
                <a href="<?= base_url(); ?>home/how_it_works"><img src="<?= base_url() ?>public/home/design/btn-tell.gif" alt="" /></a>
                <a href="<?= base_url(); ?>home/trial"><img src="<?= base_url() ?>public/home/design/btn-purchase.gif" alt="" /></a>
                <a href="<?= base_url(); ?>home/register"><img src="<?= base_url() ?>public/home/design/btn-buy.gif" alt="" /></a>
            </p>

        </div> <!-- /col-text -->
    
    </div> <!-- /col -->
    <div id="col-bottom"></div>
    
    <hr class="noscreen" />
    
    <!-- 3 columns -->
    <div id="cols3-top"></div>
    <div id="cols3" class="box">
    
        <!-- Column I. -->
        <div class="col">

            <h3><a href="<?= base_url(); ?>home/how_it_works">Features That Matter</a></h3>
            
            <p class="nom t-center"><a href="<?= base_url(); ?>home/how_it_works"><img src="<?= base_url() ?>public/home/tmp/features2.gif" alt="" /></a></p>

            <div class="col-text">

                <p>We worked hard to make sure that teachers could author websites with no learning curve.</p>
                
                <ul class="ul-01">
                    <li>A short, simple address: <Site Name>/yourname</li>
					<li>An easy-to-use website editor</li>
                    <li>Attach documents and other files to your website</li>
                    <li>Change how your website looks with one click</li>
					<li>Choose from a set of beautiful website designs</li>
                </ul>
<div style="margin-top: 6px;"> </div>
            </div> <!-- /col-text -->

            <div class="col-more"><a href="<?= base_url(); ?>home/how_it_works"><img src="<?= base_url() ?>public/home/design/cols3-more.gif" alt="" /></a></div>

        </div> <!-- /col -->

        <hr class="noscreen" />

        <!-- Column II. -->
        <div class="col">

            <h3><a href="<?= base_url(); ?>home/pricing">Sensible Pricing</a></h3>

            <p class="nom t-center"><a href="<?= base_url(); ?>home/pricing"><img src="<?= base_url() ?>public/home/tmp/features.gif" alt="" /></a></p>

            <div class="col-text">

                <p>We understand that teachers work on a thin budget. We would know; we have a few teachers on our staff!
					With <Site Name>, we promise you'll get a great value.
				</p>

                <ul class="ul-01">
					<li><strong>A free 30 day trial</strong></li>
                    <li><strong>$23 for a year-long subscription</strong></li>
                    <li><strong>Pricing that cannot be matched</strong></li>
                </ul>
			<div style="margin-top: 8px;"> </div>
            </div> <!-- /col-text -->

            <div class="col-more"><a href="<?= base_url(); ?>home/pricing"><img src="<?= base_url() ?>public/home/design/cols3-more.gif" alt="" /></a></div>

        </div> <!-- /col -->

        <hr class="noscreen" />

        <!-- Column III. -->
        <div class="col last">

            <h3><a href="<?= base_url(); ?>home/how_it_works">Take A Tour</a></h3>
			
            <p class="nom t-center"><a href="<?= base_url(); ?>home/how_it_works"><img src="<?= base_url() ?>public/home/tmp/globe.png" alt="" /></a></p>

            <div class="col-text">

                <p>
					We want you to see how simple it is to get started. We worked our hardest to minimize the learning curve.. Click "more" to see how easy it is to:
				</p>

                <ul class="ul-01">
                    <li><strong>Edit your website online, anywhere</strong></li>
                    <li><strong>Create new pages with one click</strong></li>
                    <li><strong>Use a very familiar Word-like text editor</strong></li>
                </ul>
			<div style="margin-top: 8px;"> </div>
            </div> <!-- /col-text -->

            <div class="col-more" style="vertical-align: bottom;"><a href="<?= base_url(); ?>home/how_it_works"><img src="<?= base_url() ?>public/home/design/cols3-more.gif" alt="" /></a></div></div> <!-- /col -->

        <hr class="noscreen" />
    
    </div> <!-- /cols3 -->
    <div id="cols3-bottom"></div>
	
<?php include fe_view_path() . 'includes/footer.php'; ?>
    