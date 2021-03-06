<?php
    include "header.inc.php";
    include "classes/EventUnits.class.php";
    HTMLBegin(); 

    

    function GetUnitCode ($PersonID)
    {
        
        $mysql = pdodb::getInstance();
        $query ="select UnitCode from hrmstotal.staff join hrmstotal.persons on (
            persons.PersonID = staff.PersonID and persons.person_type = staff.person_type)
            where persons.PersonID = ?";

        $mysql->Prepare($query);
        $res = $mysql->ExecuteStatement(array($PersonID));

        if ($rec = $res->fetch())
            return $rec["UnitCode"];
        
        return 0;

    }
    

    if(isset($_REQUEST["UnitID"]))
    {
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
    <td align="center"><b>واحدهای مرتبط</b></td>
    </tr>
    </table>
</form>

<form id=f1 name=f1 method=post>
<table class="table table-sm table-stripped table-bordered">
    <thead>
        <td>&nbsp;</td>
        <td>
            <b>واحد سازمانی</b>
        </td>
        <td>
            <b>زیر واحد سازمانی</b>
        </td>
    </thead>
    <?
        $res = manage_EventUnits::GetList();
        if ($res != null)
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