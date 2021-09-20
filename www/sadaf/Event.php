<?php
    include "header.inc.php";
    HTMLBegin(); ?>
    
<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >
    
    <form id=f1 name=f1 method=post>
        <table class="table table-sm table-stripped table-bordered">
            <tr class="HeaderOfTable">
                <td align="center">رویدادها</td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0">
            <tr>
                <td width="1%" nowrap>
                    <b>عنوان</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="text" name="description" id="description" maxlength="45" value="<? echo $description ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>تاریخ شروع رویداد</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="date" name="StartDate" id="StartDate" maxlength="45" value="<? echo $StartDate ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>ساعت شروع</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="StartHoure" id="StartHoure" maxlength="45" value="<? echo $StartHoure ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>دقیقه شروع</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="StartMinute" id="StartMinute" maxlength="45" value="<? echo $StartMinute ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>تاریخ پایان رویداد</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="date" name="EndDate" id="EndDate" maxlength="45" value="<? echo $EndDate ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>ساعت پایان</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="EndHoure" id="EndHoure" maxlength="45" value="<? echo $EndHoure ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>دقیقه پایان</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="EndMinute" id="EndMinute" maxlength="45" value="<? echo $EndMinute ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>سطح اهمیت رویداد</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="Level" id="Level" maxlength="45" value="<? echo $Level ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap> 
                    <b>کد دسترسی شخص</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="PersonID" id="PersonID" maxlength="45" value="<? echo $PersonID ?>">
                </td>
            </tr>
            <tr class="FooterOfTable">
                <td align="center" colspan="2">
                    <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="حذف">
                    <input type="button" class="btn " onclick="javascript: document.location='ManageEvent.php';" value="جدید">
                </td>  
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
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->ShStartDate;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->StartDate;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->StartHour;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->StartMinute;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->ShEndDate;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->EndDate;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->EndHour;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->EndMinute;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->description;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->level;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->CreatorID;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->EventTypeID;
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
            ?>
    <tr class="FooterOfTable">
        <td colspan=2 align="center">
            <input type=button class="btn btn-danger" value="حذف" onclick="if(confirm('آیا مطمئن هستید')) document.f1.submit();">
        </td>
    </tr>


        </table>      
    </form>
        
        </div>
    <div class="col-2"></div>
</div>
</div>