<?php

    include "header.inc.php";
    include "classes/EventTypes.class.php";
    include "classes/EventTasks.class.php";
    HTMLBegin(); 
    if(isset($_REQUEST["description"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventTasks::Update($_REQUEST["id"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["NotificationType"]);
        else
            manage_EventTasks::Add($_REQUEST["description"], $_REQUEST["level"], $_REQUEST["NotificationType"]);
    }
   
    if(isset($_REQUEST["id"]))
    {
        $obj = new be_EventTask();
        $obj->LoadDataFromDatabase($_REQUEST["id"]);
        $description = $obj->description;
        $level = $obj->level;
        $NotificationType = $obj->NotificationType;
    }
    else
    {
        $description = "";
        $level = "";
        $NotificationType = "";
    }
?>

<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >

<form id=f2 name=f2 method="post">
    <input type=hidden id=id name=id value='<? echo $_REQUEST["EventID"]?>'>
    <?
        if(isset($_REQUEST["id"]))
            echo "<input type=hidden id=id name=id value='".$_REQUEST["id"]."'>";
    ?>
    <table class="table table-sm table-stripped table-bordered">
    <tr class="HeaderOfTable">
    <td align="center">ایجاد/ویرایش فعالیت های رویداد</td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
    عنوان
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="text" name="description" id="description" maxlength="45" value="<? echo $description ?>">
        </td>
    </tr>
    <tr>
        <td width="1%" nowrap>
    سطح اهمیت
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="number" name="level" id="level" maxlength="45" value="<? echo $level ?>">
        </td>
    </tr>
    <tr>
        <td width="1%" nowrap>
    نوع اطلاع رسانی
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="text" name="NotificationType" id="NotificationType" maxlength="45" value="<? echo $NotificationType ?>">
        </td>
    </tr>
    <tr class="FooterOfTable">
    <td align="center" colspan="2">
        <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="ذخیره">
        <input type="button" class="btn " onclick="javascript: document.location='ManageEventTypes.php';" value="جدید">
    </td>
    </tr>
    </table>
</form>


<form id=f1 name=f1 method=post>
<input type=hidden id=id name=id value='<? echo $_REQUEST["EventID"]?>'>
<table class="table table-sm table-stripped table-bordered">
    <thead>
        <td>&nbsp;</td>
        <td>شرح</td>
        <td>سطح اهمیت</td>
        <td>نوع اطلاع رسانی</td>
    </thead>
    <?
        $res = manage_EventTasks::GetList($_REQUEST["EventID"]);
        for($i=0; $i<count($res); $i++)
        {
            $id = $res[$i]->id;
            $CheckBoxId = "ch_".$id;
            if(isset($_POST[$CheckBoxId]))
            {
                manage_EventTasks::Remove($id);
            }
            else
            {
                echo "<tr>";

                echo "<td>";
                echo "<input type=checkbox name='".$CheckBoxId."'>";
                echo "</td>";

                echo "<td>";
                echo "<a href='ManageEventTypes.php?id=".$id."'>";
                echo $res[$i]->description;
                echo "</a>";
                echo "<td>";
                echo $res[$i]->level;
                echo "</td><td>";
                echo $res[$i]->NotificationType;
                echo "</td>";
                echo "</tr>";
            }
        }
    ?>
    <tr class="FooterOfTable">
        <td colspan=4 align="center">
            <input type=button class="btn btn-danger" value="حذف" onclick="if(confirm('آیا مطمئن هستید')) document.f1.submit();">
        </td>
    </tr>
</table>
</form>


</div>
    <div class="col-2"></div>
</div>
</div>

<script>
	function ValidateForm()
	{
		document.f2.submit();
	}
</script>