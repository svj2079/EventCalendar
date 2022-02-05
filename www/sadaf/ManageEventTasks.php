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
            manage_EventTasks::Add($_REQUEST["description"], $_REQUEST["level"], $_REQUEST["NotificationType"] , $_REQUEST["EventID"]);
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
    <input type=hidden id=EventID name=EventID value='<? echo $_REQUEST["EventID"]?>'>          
    <?
        if(isset($_REQUEST["id"]))
            echo "<input type=hidden id=id name=id value='".$_REQUEST["id"]."'>";
    ?>
    <table class="table table-sm table-stripped table-bordered">
    <tr class="HeaderOfTable">
    <td align="center"><b>ایجاد/ویرایش فعالیت های رویداد</b></td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
            <span style="color: red;">*</span>
            <b>عنوان</b>
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="text" name="description" id="description" maxlength="45" value="<? echo $description ?>">
        </td>
    </tr>
    <tr>
        <td width="1%" nowrap>
            <b>سطح اهمیت</b>
        </td>
        <td nowrap>
            <select name="level" id="level">
                <option <? if($level =="1") echo"selected" ?> value="1">1</option>
                <option <? if($level =="2") echo"selected" ?> value="2">2</option>
                <option <? if($level =="3") echo"selected" ?> value="3">3</option>
                <option <? if($level =="4") echo"selected" ?> value="4">4</option>
            </select>
        </td>
    </tr>
    <tr>
        <td width="1%" nowrap>
            <b>نوع اطلاع رسانی</b>
        </td>
        <td nowrap>
              <select name="NotificationType" id="NotificationType">
                <option id="NONE">None</option>
                <option <? if($NotificationType =="EMAIL") echo"selected" ?> value="EMAIL">Email</option>
                <option <? if($NotificationType =="SMS") echo"selected" ?> value="SMS">SMS</option>
                <option <? if($NotificationType =="PORTAL") echo"selected" ?> value="PORTAL">Portal</option>
              </select>
        </td>
    </tr>
    <tr class="FooterOfTable">
    <td align="center" colspan="2">
        <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="ذخیره">
        <input type="button" class="btn " onclick="javascript: document.location='ManageEventTasks.php?EventID=<? echo $_REQUEST['EventID']?>';" value="جدید">
    </td>
    </tr>
    </table>
</form>


<form id=f1 name=f1 method=post>
<input type=hidden id=EventID name=EventID value='<? echo $_REQUEST["EventID"]?>'>
<table class="table table-sm table-stripped table-bordered">
    <thead>
        <td>&nbsp;</td>
        <td>
            <b>شرح</b>
        </td>
        <td>
            <b>سطح اهمیت</b>
        </td>
        <td>
            <b>نوع اطلاع رسانی</b>
        </td>
        <td>
            <b>مجریان</b>
        </td>
    </thead>
    <?
        $res = manage_EventTasks::GetList($_REQUEST["EventID"]);
        if ($res != null)
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

                echo "<td width='5%'>";
                echo "<input type=checkbox name='".$CheckBoxId."'>";
                echo "</td>";

                echo "<td>";
                echo "<a href='ManageEventTasks.php?id=".$id."&EventID=".$_REQUEST['EventID']."'>";
                echo $res[$i]->description;
                echo "</a>";
                echo "<td>";
                echo $res[$i]->level;
                echo "</td><td>";
                echo $res[$i]->NotificationType;
                echo "</td>";
                echo "<td>";
                echo "<a href='ManageEventTaskPerson.php?EventTaskID=".$id."'>";
                echo "مجریان";
                echo "</a>";
                echo "</td>";
                echo "</tr>";
            }
        }
    ?>
    <tr class="FooterOfTable">
        <td colspan=6 align="center">
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
        if(document.getElementById('description').value == "")
        {
            alert("لطفا عنوان را وارد کنید");
            return;
        }
		document.f2.submit();
	}
</script>