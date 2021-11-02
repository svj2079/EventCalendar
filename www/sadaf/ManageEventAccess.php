<?php
    include "header.inc.php";
    include "classes/EventAccess.class.php";
    HTMLBegin(); 
    
    if(isset($_REQUEST["CreatorID"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventTypes::Update($_REQUEST["id"], $_REQUEST["CreatorID"], $_REQUEST["AccessType"], $_REQUEST["EventID"]);
        else
            manage_EventTypes::Add($_REQUEST["CreatorID"], $_REQUEST["AccessType"], $_REQUEST["EventID"]);
    }
    if(isset($_REQUEST["AccessType"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventTypes::Update($_REQUEST["id"], $_REQUEST["CreatorID"], $_REQUEST["AccessType"], $_REQUEST["EventID"]);
        else
            manage_EventTypes::Add($_REQUEST["CreatorID"], $_REQUEST["AccessType"], $_REQUEST["EventID"]);
    }
    if(isset($_REQUEST["EventID"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventTypes::Update($_REQUEST["id"], $_REQUEST["CreatorID"], $_REQUEST["AccessType"], $_REQUEST["EventID"]);
        else
            manage_EventTypes::Add($_REQUEST["CreatorID"], $_REQUEST["AccessType"], $_REQUEST["EventID"]);
    }
    if(isset($_REQUEST["id"]))
    {
        $obj = new be_EventAccess();
        $obj->LoadDataFromDatabase($_REQUEST["id"]);
        $CreatorID = $obj->CreatorID;
        $AccessType = $obj->AccessType;
        $EventID = $obj->EventID;
    }
    else
    {
        $CreatorID = "";
        $AccessType = "";
        $EventID = "";
    }
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
    <td align="center">ایجاد/ویرایش نوع دسترسی</td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
    نوع دسترسی
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="text" name="AccessType" id="AccessType" maxlength="45" value="<? echo $AccessType ?>">
        </td>
        <td width="1%" nowrap>
    کد شخص 
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="number" name="CreatorID" id="CreatorID" maxlength="45" value="<? echo $CreatorID ?>">
        </td>
        <td width="1%" nowrap>
    کد رویداد 
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="number" name="EventID" id="EventID" maxlength="45" value="<? echo $EventID ?>">
        </td>
    </tr>
    <tr class="FooterOfTable">
    <td align="center" colspan="2">
        <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="ذخیره">
        <input type="button" class="btn " onclick="javascript: document.location='ManageEventAccess.php';" value="جدید">
    </td>
    </tr>
    </table>
</form>


<form id=f1 name=f1 method=post>
<table class="table table-sm table-stripped table-bordered">
    <thead>
        <td>&nbsp;</td>
        <td>شرح</td>
    </thead>
    <?
        $res = manage_EventAccess::GetList();
        for($i=0; $i<count($res); $i++)
        {
            $id = $res[$i]->id;
            $CheckBoxId = "ch_".$id;
            if(isset($_POST[$CheckBoxId]))
            {
                manage_EventAccess::Remove($id);
            }
            else
            {
                echo "<tr>";

                echo "<td>";
                echo "<input type=checkbox name='".$CheckBoxId."'>";
                echo "</td>";

                echo "<td>";
                echo "<a href='ManageEventTypes.php?id=".$id."'>";
                echo $res[$i]->AccessType;
                echo "</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='ManageEventTypes.php?id=".$id."'>";
                echo $res[$i]->CreatorID;
                echo "</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='ManageEventTypes.php?id=".$id."'>";
                echo $res[$i]->EventID;
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