<div class="teamtable">
	<table>	
		<?php
			if(!empty($teamData[0])):
				$data = $teamData[0]->dataList;

				foreach($data as $dataEntry):
					print_r($dataEntry);
					?>
						<tr>
							<td><?php echo $dataEntry->gHomeTeam ?></td>
							<td><?php echo $dataEntry->gGuestTeam ?></td>
							<td><?php echo $dataEntry->gHomeGoals ?></td>
							<td><?php echo $dataEntry->gGuestGoals ?></td>
						</tr>
					<?php
				endforeach;	
			endif;
		?>
	</table>
</div>