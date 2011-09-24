<?php include fe_view_path() . 'includes/header.php'; ?>

<?php $this->load->helper('string'); ?>
    <!-- Promo -->
    <div id="col-top"></div>
    <div id="col" class="box">
    <style type="text/css">
		table tr td { padding:5px; }
	</style>
      <div id="col-text2">
	  <h1><?= config_item('customer_name') ?> (North Arlington, NJ) Websites</h1>
			<?php if( $search_results || $keyword): ?>
				<p>We found <?= sizeof( $search_results ) ?> website<?= (sizeof( $search_results ) == 1 ? '' : 's') ?> matching 
				'<strong><?= $keyword ?></strong>'. Click <a href="<?= config_item('base_url') ?>">here</a> 
				to clear these results.</p>
				<?php if( sizeof( $search_results ) > 0 ): ?>
				<table style="width:100%">
					<tr style="font-size: 15px;" class="row-a">
						<td><strong>Last Name</strong></td>
						<td><strong>First Name</strong></td>
						<td><strong>Email</strong></td>
						<td><strong>Website<strong></td>
					</tr>
				<?php endif; ?>
				<?php foreach( $search_results as $result ): ?>
					<tr class="<?= alternator('row-b', 'row-a') ?>">
						<td><?= ($result->last_name == '' ? "Unlisted" : $result->last_name) ?></td>
						<td><?= ($result->first_name == '' ? "Unlisted" : $result->first_name) ?></td>
						<td><?= ($result->email == '' ? "Unlisted" : $result->email) ?></td>
						<td>
							<a href="<?= base_url() ?><?= $result->site_name ?>"><?= base_url() ?><?= $result->site_name ?></a>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php if( sizeof( $search_results ) > 0 ): ?>
				</table>
				<?php endif; ?>
			<?php else: ?>
				<p>Below is a list of the faculty websites at <?= config_item('customer_name') ?>.
				You can also search for teachers using the search box on the upper-right portion of this page!</p>
				
				<table style="width:100%">
					<tr style="font-size: 15px;" class="row-a">
						<td><strong>Last Name</strong></td>
						<td><strong>First Name</strong></td>
						<td><strong>Email</strong></td>
						<td><strong>Website<strong></td>
					</tr>
				<?php foreach( $users as $user ): ?>
					<tr class="<?= alternator('row-b', 'row-a') ?>">
						<td><?= ($user->last_name == '' ? "Unlisted" : $user->last_name) ?></td>
						<td><?= ($user->first_name == '' ? "Unlisted" : $user->first_name) ?></td>
						<td><?= ($user->email == '' ? "Unlisted" : $user->email) ?></td>
						<td>
							<a href="<?= base_url() ?><?= $user->site_name ?>"><?= base_url() ?><?= $user->site_name ?></a>
						</td>
					</tr>
				<?php endforeach; ?>
				</table>
				
			<?php endif; ?>
      </div> <!-- /col-text -->
    
    </div> <!-- /col -->
    <div id="col-bottom"></div>
    
    <hr class="noscreen" />

 <?php include fe_view_path() . 'includes/footer.php'; ?>