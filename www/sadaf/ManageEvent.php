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
                <td align="center" colspan="6">رویدادها</td>
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
                        echo $res[$i]->description;
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
                        echo "<a href='ManageEvent.php?=".$id."'>";
                        echo "مدیران";
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
        <td colspan=6 align="center">
            <input type=button class="btn btn-danger" value="حذف" onclick="if(confirm('آیا مطمئن هستید')) document.f1.submit();">
        </td>
    </tr>


        </table>      
    </form>

        
        </div>
    <div class="col-2"></div>
</div>
</div>