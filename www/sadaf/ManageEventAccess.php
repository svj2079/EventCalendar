<?php
    include "header.inc.php";
    include "classes/EventAccess.class.php";
    HTMLBegin(); 

    /*if(isset($_REQUEST["PersonID"]))
    {
        echo manage_EventAccess::CheckUserAccessToThisEvent($EventID,$PersonID);
    }*/

    if (isset($_REQUEST["GetPersons"]))
    {
        echo manage_EventAccess::GetPersons($_REQUEST["GetPersons"]);
        die();
    }

    $EventID=$_REQUEST["EventID"];
    
    if(isset($_REQUEST["PersonID"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventAccess::Update($_REQUEST["id"], $_REQUEST["PersonID"], $_REQUEST["AccessType"], $EventID);
        else
            manage_EventAccess::Add($_REQUEST["PersonID"], $_REQUEST["AccessType"], $EventID);
    }
    if(isset($_REQUEST["id"]))
    {
        $obj = new be_EventAccess();
        $obj->LoadDataFromDatabase($_REQUEST["id"]);
        $PersonID = $obj->PersonID;
        $AccessType = $obj->AccessType;
    }
    else
    {
        $PersonID = "";
        $AccessType = "";
    }
    ?>

<div class="container-fluid">
<div class="row">
<div class="col-2"></div>
<div class="col-8">

<form id=f2 name=f2 method="post">
    <?
        if(isset($_REQUEST["id"]))
            echo "<input type=hidden id=id name=id value='".$_REQUEST["id"]."'>";
    ?>
    <input type=hidden id=EventID name=EventID value='<? echo $EventID?>'>
    <table class="table table-sm table-stripped table-bordered">
    <tr class="HeaderOfTable">
    <td align="center"><b>ایجاد/ویرایش نوع دسترسی</b></td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
            <b>نام و نام خانوادگی</b>
        </td>
        <td nowrap>
            <input class="form-control sadaf-m-input" type="text" name="PersonName" id="PersonName" maxlength="45" oninput="javascript: SetPersons()">
            <span id="SpanPersonID"></span>
        </td>
    </tr>
    <tr>
        <td width="1%" nowrap>
            <b>نوع دسترسی</b>
        </td>
        <td nowrap>
              <select name="AccessType" id="AccessType">
                <option <? if($AccessType =="WRITE") echo"selected" ?> value="WRITE">کامل</option>
                <option <? if($AccessType =="READ") echo"selected" ?> value="READ">فقط خواندنی</option>
              </select>
        </td>
    </tr>
    <tr class="FooterOfTable">
    <td align="center" colspan="2">
        <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="ذخیره">
        <input type="button" class="btn " onclick="javascript: document.location='ManageEventAccess.php?EventID=<? echo $_REQUEST['EventID']?>';" value="جدید">
    </td>
    </tr>
    </table>
</form>
<?
// in line 81: 
//         <input type="button" class="btn " onclick="javascript: document.location='ManageEventAccess.php';" value="جدید">
?>

<form id=f1 name=f1 method=post>
<input type=hidden id=EventID name=EventID value='<? echo $EventID?>'>
<table class="table table-sm table-stripped table-bordered">
<thead>
        <td>&nbsp;</td>
        <td>
            <b>نام و نام خانوادگی</b>
        </td>
        <td>
            <b>نوع دسترسی</b>
        </td>
    </thead>
    <?
        $res = manage_EventAccess::GetList($EventID);
        if ($res != null)
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
                //echo "<a href='ManageEventAccess.php?id=".$id."'>";
                echo $res[$i]->FullName;
                //echo "</a>";
                echo "</td>";
                echo "<td>";
                //echo "<a href='ManageEventAccess.php?id=".$id."&EventID=".$_REQUEST['EventID']."'>";
                if($res[$i]->AccessType == "WRITE") echo "کامل"; 
                else echo "فقط خواندنی";
                //echo "</a>";
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

    function SetPersons()
    {
        
        PersonName = document.getElementById('PersonName');
        console.log(PersonName.value);
        if (PersonName.value.length < 3)
        {
            document.getElementById ('SpanPersonID').innerHTML = "<select id = 'PersonID' name = 'PersonID'></select>";
            return;
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById ('SpanPersonID').innerHTML = "<select id = 'PersonID' name = 'PersonID'>"+this.responseText+"</select>";
            }
        };
        xmlhttp.open("GET", "ManageEventAccess.php?GetPersons="+PersonName.value, true);
        xmlhttp.send(); 
    }
</script>