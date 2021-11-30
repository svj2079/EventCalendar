<?php
    include "header.inc.php";
    include "classes/EventUnits.class.php";
    HTMLBegin(); 

    if(isset($_REQUEST["UnitID"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventUnits::Update($_REQUEST["id"], $_REQUEST["EventID"], $_REQUEST["UnitID"], $_REQUEST["SubUnitID"]);
        else
            manage_EventUnits::Add($_REQUEST["EventID"], $_REQUEST["UnitID"], $_REQUEST["SubUnitID"]);
    }
    if(isset($_REQUEST["id"]))
    {
        
        $obj = new be_EventUnit();
        $obj->LoadDataFromDatabase($_REQUEST["id"]);
        $EventID = $obj->EventID;
        $UnitID = $obj->UnitID;
        $SubUnitID = $obj->SubUnitID;
    }
    else
    {
        $EventID = "";
        $UnitID = "";
        $SubUnitID = "";
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
    <td align="center">واحدهای مرتبط</td>
    </tr>
    </table>
</form>

<form id=f1 name=f1 method=post>
<table class="table table-sm table-stripped table-bordered">
    <thead>
        <td>&nbsp;</td>
        <td>واحد سازمانی</td>
        <td>زیر واحد سازمانی</td>
    </thead>
    <?
        $res = manage_EventUnits::GetList();
        for($i=0; $i<count($res); $i++)
        {
            $id = $res[$i]->id;
            $CheckBoxId = "ch_".$id;
            if(isset($_POST[$CheckBoxId]))
            {
                manage_EventUnits::Remove($id);
            }
            else
            {
                echo "<tr>";

                echo "<td width='5%'>";
                echo "<input type=checkbox name='".$CheckBoxId."'>";
                echo "</td>";

                echo "<td>";
                echo "<a href='ManageEventUnits.php?id=".$id."'>";
                echo $res[$i]->UnitID;
                echo "</a>";
                echo "</td>";
                echo "<td>";
                echo "<a href='ManageEventUnits.php?id=".$id."'>";
                echo $res[$i]->SubUnitID;
                echo "</a>";
                echo "</td>";
                echo "</tr>";
            }
        }
    ?>
    <tr class="FooterOfTable">
        <td colspan=3 align="center">
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