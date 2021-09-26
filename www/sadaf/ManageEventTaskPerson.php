<?php
    include "header.inc.php";
    include "classes/EventTaskPerson.class.php";
    HTMLBegin(); 
    $EventTaskID=$_REQUEST["EventTaskID"];
    if(isset($_REQUEST["PersonID"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventTaskPerson::Update($_REQUEST["id"], $EventTaskID,$_REQUEST["PersonID"]);
        else
            manage_EventTaskPerson::Add($EventTaskID,$_REQUEST["PersonID"]);
    }
    if(isset($_REQUEST["id"]))
    {
        $obj = new be_EventTaskPerson();
        $obj->LoadDataFromDatabase($_REQUEST["id"]);
        $PersonID = $obj->PersonID;
    }
    else
    {
        $PersonID = "";
    }
    ?>

<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >

<form id=f2 name=f2 method="post">
    <input type=hidden id=EventTaskID name=EventTaskID value='<? echo $EventTaskID?>'>
    
    <table class="table table-sm table-stripped table-bordered">
    <tr class="HeaderOfTable">
    <td align="center">ایجاد دسترسی شخص </td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
    کد دسترسی شخص
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="text" name="PersonID" id="PersonID" maxlength="45" value="<? echo $PersonID ?>">
        </td>
    </tr>
    <tr class="FooterOfTable">
    <td align="center" colspan="2">
        <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="ذخیره">
        <input type="button" class="btn " onclick="javascript: document.location='ManageEventTaskPerson.php?EventTaskID=<? echo $EventTaskID?>';" value="جدید">
    </td>
    </tr>
    </table>
</form>


<form id=f1 name=f1 method=post>
<input type=hidden id=EventTaskID name=EventTaskID value='<? echo $_REQUEST["EventTaskID"]?>'>
<table class="table table-sm table-stripped table-bordered">
    <thead>
        <td>&nbsp;</td>
        <td>کد دسترسی</td>
    </thead>
    <?
        $res = manage_EventTaskPerson::GetList($EventTaskID);
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
                echo $res[$i]->PersonID;
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