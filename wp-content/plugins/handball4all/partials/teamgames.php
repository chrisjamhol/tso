<div class="teamtable">
    <table class="tablepress ">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Heim</th>
                <th>Gast</th>
                <th>Halbzeit</th>
                <th>Ergebnis</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(!empty($teamData[0])):
                $data = $teamData[0]->dataList;
                $data = array_reverse($data);

                $dateToday = date('m/d/Y', time());
                $today = strtotime($dateToday);
                foreach($data as $index => $dataEntry):
                    $gameTime = strtotime($dataEntry->gDate);
                    if($gameTime < $dateToday)
                        continue;
                ?>
                    <tr class="<?php echo $index % 2 > 0 ? 'odd' : 'even'?>">
                        <td><?php echo $dataEntry->gDate ?><br /><?php echo $dataEntry->gTime ?></td>
                        <td><?php echo $dataEntry->gHomeTeam ?></td>
                        <td><?php echo $dataEntry->gGuestTeam ?></td>
                        <td>
                            <?php if($dataEntry->gHomeGoals_1 > 0 || $dataEntry->gGuestGoals_1 > 0) { ?>
                                <?php echo $dataEntry->gHomeGoals_1 ?>:<?php echo $dataEntry->gGuestGoals_1 ?>
                            <?php } ?>
                        </td>
                        <td><?php echo $dataEntry->gHomeGoals ?>:<?php echo $dataEntry->gGuestGoals ?></td>
                    </tr>
                <?php endforeach;
            endif;
            ?>
        </tbody>
    </table>
</div>