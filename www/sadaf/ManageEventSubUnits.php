<?php
    include "header.inc.php";
    include "classes/EventSubUnits.class.php";
    HTMLBegin(); 

    if(isset($_REQUEST["EduGroupCode"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventTypes::Update($_REQUEST["id"], $_REQUEST["EventID"], $_REQUEST["EduGroupCode"]);
        else
            manage_EventTypes::Add($_REQUEST["EventID"], $_REQUEST["EduGroupCode"]);
    }
    if(isset($_REQUEST["id"]))
    {
        $obj = new be_EventSubUnit();
        $obj->LoadDataFromDatabase($_REQUEST["id"]);
        $EventID = $obj->EventID;
        $EduGroupCode = $obj->EduGroupCode;
    }
    else
        $EventID = "";
        $EduGroupCode = "";
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
    <td align="center">زیرواحد سازمانی هدف</td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
    رویداد
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="text" name="description" id="description" maxlength="45" value="<? echo $description ?>">
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
        <td>رویداد</td>
    </thead>
    <?
        $res = manage_EventSubUnits::GetList();
        for($i=0; $i<count($res); $i++)
        {
            $id = $res[$i]->id;
            $CheckBoxId = "ch_".$id;
            if(isset($_POST[$CheckBoxId]))
            {
                manage_EventSubUnits::Remove($id);
            }
            else
            {
                echo "<tr>";

                echo "<td width='10%'>";
                echo "<input type=checkbox name='".$CheckBoxId."'>";
                echo "</td>";

                echo "<td>";
                echo "<a href='ManageEventSubUnits.php?id=".$id."'>";
                echo $res[$i]->EduGroupCode;
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