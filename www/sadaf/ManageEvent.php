<?php
    include "header.inc.php";
    include "classes\Event.class.php";
   
    //include "classes\EventTaskPerson.class.php";
    HTMLBegin();
    ?>
    
<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >
    
    <form id=f1 name=f1 method=post>
        <table class="table table-sm table-stripped table-bordered">
            <tr class="HeaderOfTable">
                <td align="center" colspan="8">رویدادها</td>
            </tr>

            <?
                $res = manage_Event::GetList();
                for($i=0; $i<count($res); $i++)
                {
                    $id = $res[$i]->id;
                    $CheckBoxId = "ch_".$id;
                    if(isset($_POST[$CheckBoxId]))
                    {
                        manage_Event::Remove($id);
                    }
                    else
                    {
                        
                        echo "<tr>";

                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        
                        echo "<td>";
                        echo "<a href='NewEvent.php?id=".$id."'>";
                        echo $res[$i]->title; 
                        echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->ShStartDate;
                        echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->ShEndDate;
                        echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEventAccess.php?EventID=".$id."'>";
                        echo "مدیران";
                        echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEventUnits.php?EventID=".$id."'>";
                        echo "واحدهای مرتبط";
                        echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEventTasks.php?EventID=".$id."'>";
                        echo "چک لیست";
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
            ?>
    <tr class="FooterOfTable">
        <td colspan=8 align="center">
            <input type=button class="btn btn-danger" value="حذف" onclick="if(confirm('آیا مطمئن هستید')) document.f1.submit();">
        </td>
    </tr>
    <tr>
        <td colspan="8">
            <?php

                $ItemsCount = 10;
                $FromRec = 0;
                if (isset($_REQUEST["FromRec"]))
                {
                    if(is_numeric($_REQUEST["FromRec"]))
                        $FromRec = $_REQUEST["FromRec"];
                }

                $mysql = pdodb::getInstance();
                $query = "select count(*) as tcount from EventCalendar.events";
                $mysql->Prepare($query);
                $res = $mysql->ExecuteStatement(array($query));
                $rec = $res->fetch();
                $TotalCount = $rec["tcount"];
                for ($p=1 ; $p <= ceil($TotalCount/$ItemsCount) ; $p++)
                {
                    if(($p-1) * $ItemsCount != $FromRec)
                    {
                        echo "<a href = 'ManageEvent.php?FromRec=".(($p-1)*$ItemsCount)."'>";
                        echo $p;
                        echo "</a> ";
                    }
                    else
                        echo "<b>".$p."</b> ";
                }
            ?>
        </td>
    </tr>
        </table>      
    </form>
        </div>
    <div class="col-2"></div>
</div>
</div>








