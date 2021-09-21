<?php
     include "header.inc.php";
     include "classes/EventTypes.class.php";
     HTMLBegin(); 
     if(isset($_REQUEST["EventTaskID"]))
     {
         if(isset($_REQUEST["id"]))
             manage_EventTaskPerson::Update($_REQUEST["id"], $_REQUEST["EventTaskID"], $_REQUEST["CreatorID"]);
         else
             manage_EventTaskPerson::Add($_REQUEST["EventTaskID"], $_REQUEST["Creator"]);
     }
     if(isset($_REQUEST["CreatorID"]))
     {
         if(isset($_REQUEST["id"]))
             manage_EventTaskPerson::Update($_REQUEST["id"], $_REQUEST["EventTaskID"], $_REQUEST["CreatorID"]);
         else
             manage_EventTaskPerson::Add($_REQUEST["EventTaskID"], $_REQUEST["Creator"]);
     }
     if(isset($_REQUEST["id"]))
     {
         $obj = new be_EventType();
         $obj->LoadDataFromDatabase($_REQUEST["id"]);
         $EventTaskID = $obj->EventTaskID;
         $CreatorID = $obj->CreatorID;
     }
     else
         $description = "";


?>

<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >

<form id=f2 name=f2 method="post">
    <?
        if(isset($_REQUEST["id"]))
            echo "<input type=hidden id=id name=id value='".$_REQUEST["id"]."'>";
    ?>
    <table class="table table-sm table-stripped table-bordered">
    <tr class="HeaderOfTable">
    <td align="center">ایجاد/ویرایش دسترسی افراد رویداد</td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
    کد فعالیت های رویداد
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="number" name="EventTaskID" id="EventTaskID" maxlength="45" value="<? echo $EventTaskID ?>">
        </td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
    کد شخص  
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="number" name="CreatorID" id="CreatorID" maxlength="45" value="<? echo $CreatorID ?>">
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
<table class="table table-sm table-stripped table-bordered">
    <thead>
        <td>&nbsp;</td>
        <td>کد فعالیت های رویداد</td>
        <td>کد شخص</td>
    </thead>
    <?
        $res = manage_EventTaskPerson::GetList();
        for($i=0; $i<count($res); $i++)
        {
            $id = $res[$i]->id;
            $CheckBoxId = "ch_".$id;
            if(isset($_POST[$CheckBoxId]))
            {
                manage_EventTaskPerson::Remove($id);
            }
            else
            {
                echo "<tr>";

                echo "<td>";
                echo "<input type=checkbox name='".$CheckBoxId."'>";
                echo "</td>";

                echo "<td>";
                echo "<a href='ManageEventTaskPerson.php?id=".$id."'>";
                echo $res[$i]->EventTaskID;
                echo "</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='ManageEventTaskPerson.php?id=".$id."'>";
                echo $res[$i]->CreatorID;
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

<script>
	function ValidateForm()
	{
		document.f2.submit();
	}
</script>