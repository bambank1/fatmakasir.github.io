<div class="table-responsive-sm">
	<div class="card-block">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th style="width:1% !important;">No.</th>
					<th>IP</th>
					<th>Browser</th>
					<th>OS</th>
					<th>Create Date</th>
					<th>Update Date</th>
					<th style="width:1%;">Counter</th>
				</tr>
			</thead>
			<?php 
				if(!empty($posts)) {
					$no=$start + 1;
					foreach($posts AS $row){
					?>
					
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?=$row["ip"];?></td>
						<td><?=kata($row["browser"],12);?></td>
						<td><?=$row["os"];?></td>
						<td><?=date_time($row["create_date"]);?></td>
						<td><?=date_time($row["update_date"]);?></td>
						<td align="center"><?=$row["counter"];?></td>
					</tr>
					
				<?php }}else{ ?>
				<tr><th colspan="9">Data belum ada</th></tr> 
			<?php }?>
		</table>
	</div>
	<nav aria-label="Page navigation example" class="p-2">
		<?php echo $this->ajax_pagination->create_links(); ?>
	</nav>
</div>