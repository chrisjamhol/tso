<div class="teamtable">
	<?php
	if(!empty($teamData[0])):
		$data = $teamData[0]->dataList;

		foreach($data as $index => $dataEntry):?>
			<div class="row <?php echo $index % 2 > 0 ? 'odd' : 'even'?>">

				<div class="col-xs-12 teamtable-wrapper-main">

					<div class="row">
						<div class="col-xs-8">
							<strong><?php echo $dataEntry->gHomeTeam ?> - <?php echo $dataEntry->gGuestTeam ?></strong><br />
							<?php echo $dataEntry->gDate ?> <?php echo $dataEntry->gTime ?>
						</div>
						<div class="col-xs-4 text-right">
							<?php echo $dataEntry->gHomeGoals ?>:<?php echo $dataEntry->gGuestGoals ?>
							<?php if($dataEntry->gHomeGoals_1 > 0 || $dataEntry->gGuestGoals_1 > 0) {?>
								(<?php echo $dataEntry->gHomeGoals_1 ?>:<?php echo $dataEntry->gGuestGoals_1 ?>)
							<?php } ?>
						</div>
					</div>

					<div class="row">

					</div>
				</div>
				<div class="col-xs-12 teamtable-wrapper-info">

				</div>
			</div>
		<?php endforeach;
	endif;
	?>
</div>