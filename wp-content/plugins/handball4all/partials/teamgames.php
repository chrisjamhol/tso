<div class="teamtable">
    <table class="tablepress ">
        <thead>
            <tr>
                <th class="hidden-xs">Datum</th>
                <th>
                    <span class="hidden-xs">Heim</span>
                    <span class="visible-xs">Manschaften</span>
                </th>
                <th>
                    <span class="hidden-xs">Gast</span>
                    <span class="visible-xs">Info</span>
                </th>
                <th class="hidden-xs">Halbzeit</th>
                <th class="hidden-xs">Ergebnis</th>
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
                        <td class="hidden-xs">
                            <?php echo $dataEntry->gDate ?><br /><?php echo $dataEntry->gTime ?> Uhr
                        </td>
                        <td>
                            <?php echo $dataEntry->gHomeTeam ?>
                            <span class="visible-xs">
                                <?php echo $dataEntry->gGuestTeam ?>
                            </span>
                        </td>
                        <td>
                            <span class="hidden-xs"><?php echo $dataEntry->gGuestTeam ?></span>
                            <span class="visible-xs">
                                <strong>Ergebnis: <?php echo $dataEntry->gHomeGoals ?>:<?php echo $dataEntry->gGuestGoals ?></strong><br />
                                <?php echo $dataEntry->gDate ?><br /><?php echo $dataEntry->gTime ?> Uhr
                            </span>
                        </td>
                        <td class="hidden-xs">
                            <?php if($dataEntry->gHomeGoals_1 > 0 || $dataEntry->gGuestGoals_1 > 0) { ?>
                                <?php echo $dataEntry->gHomeGoals_1 ?>:<?php echo $dataEntry->gGuestGoals_1 ?>
                            <?php } ?>
                        </td>
                        <td class="hidden-xs">
                            <?php echo $dataEntry->gHomeGoals ?>:<?php echo $dataEntry->gGuestGoals ?>
                        </td>
                    </tr>
                <?php endforeach;
            endif;
            ?>
        </tbody>
    </table>
</div>