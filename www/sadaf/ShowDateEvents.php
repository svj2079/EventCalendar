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
<div class="col-2" ></div>
<div class="col-8" >


<form id=f1 name=f1 method=post>
        <table class="table table-sm table-stripped table-bordered">
            <tr class="HeaderOfTable">
                <td align="center" colspan="10">
                    <b>رویداد</b>
                </td>
            </tr>
            <tr>
                <td>
                    <b>عنوان</b>
                </td>
                <td>
                    <b>توضیحات</b>
                </td>
                <td>
                    <b>تاریخ شروع</b>
                </td>
                <td>
                    <b>تاریخ پایان</b>
                </td>
                <td>
                    <b>سطح اهمیت</b>
                </td>
                <td>
                    <b>چک لیست</b>
                </td>
                <td>
                    <b>واحد سازمانی</b>
                </td>
                <td>
                    <b>زیر واحد سازمانی</b>
                </td>
                
            </tr>

            <?  
                $res = manage_Event::GetList($_REQUEST["CurDate"]);
                if ($res != null)
                {
                    for($i=0; $i<count($res); $i++)
                    {
                        $id = $res[$i]->id;
                        manage_Event::GetList($id);
                        
                        echo "<tr>";
                        echo "<td>";
                        echo $res[$i]->title; 
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->description; 
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->ShStartDate;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->ShEndDate;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->level;
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEventTasks.php?EventID=".$id."'>";
                        echo "<i class='fa fa-tasks' title='چک لیست'></i>";
                        echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->UnitName;
                        echo "</td>";
                        echo "<td>";
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
    <div class="col-2"></div>
</div>
</div>

