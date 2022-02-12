<?php
    include "header.inc.php";
    include "classes\Event.class.php";
    include "classes/calendar.class.php";
    //include "classes\EventTaskPerson.class.php";
    $list = manage_Event::GetList($_REQUEST["CurDate"]);
    
    HTMLBegin();
?>



<div class="container-fluid">
<div class="row">
<form id=f1 name=f1 method=post>
        <table class="table table-sm table-stripped table-bordered">
            <tr class="HeaderOfTable">
                <td align="center" colspan="10">
                    <b>رویداد</b>
                </td>
            </tr>

            <?  
                $res = manage_Event::GetList($_REQUEST["CurDate"]);
                if ($res != null)
                {
                    for($i=0; $i<count($res); $i++)
                    {
                        $id = $res[$i]->id;
                        
                        echo "<tr>";
                        echo "<td>";
                        echo "<b>عنوان:</b> ";
                        echo $res[$i]->title; 
                        echo "<br>";
                        echo "<b>توضیحات:</b> ";
                        echo str_replace("\n" , "<br>" , $res[$i]->description) ; 
                        echo "<br>";
                        echo "<b>تاریخ شروع:</b> ";
                        echo $res[$i]->ShStartDate;
                        echo "<br>";
                        echo "<b>تاریخ پایان:</b>";
                        echo $res[$i]->ShEndDate;
                        echo "<br>";
                        echo "<b>سطح اهمیت:</b> ";
                        echo $res[$i]->level;
                        echo "  ";
                        echo "<a href='ManageEventTasks.php?EventID=".$id."'>";
                        echo "<i class='fa fa-tasks' title='چک لیست'></i>";
                        echo "</a>";
                        echo "<br>";
                        echo "<b>واحد سازمانی:</b> ";
                        echo $res[$i]->UnitName;
                        echo "<br>";
                        echo "<b>زیر واحد سازمانی:</b> ";
                        echo $res[$i]->SubUnitName;
                        echo "</td>";
                        echo "</tr>";
                        
                    }
                }
                else
                {
                    echo "<table class='table table-sm table-stripped table-bordered' border=0>
                                <tr>
                                    <td align='center'>
                                        <b>!</b>
                                        <b>رویدادی ثبت نشده است</b>
                                        <b>!</b>
                                    </td>
                                </tr>
                            </table>";
                }
            ?>
    <tr class="FooterOfTable"></tr>
    </table>      
    </form>
</div>
</div>



