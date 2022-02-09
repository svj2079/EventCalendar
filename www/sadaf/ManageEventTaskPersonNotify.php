<?php 

    include "header.inc.php";
    include "classes/EventTaskPersonNotify.class.php";
    HTMLBegin();


    if(isset($_REQUEST["NotifyType"]))
    {
        if(isset($_REQUEST["EventTaskPersonNotifyID"]))
            manage_EventTaskPersonNotify::Update($_REQUEST["EventTaskPersonNotifyID"], $_REQUEST["NotifyType"], $_REQUEST["SendDate"]);
        else
            manage_EventTaskPersonNotify::Add($_REQUEST["NotifyType"], $_REQUEST["SendDate"]);
    }

    if(isset($_REQUEST["EventTaskPersonNotifyID"]))
    {
        $obj = new be_EventTaskPersonNotify();
        $obj->LoadDataFromDatabase($_REQUEST["EventTaskPersonNotifyID"]);
        $NotifyType = $obj->NotifyType;
        $SendDate = $obj->SendDate;
    }
    else
    {
        $NotifyType = "";
        $SendDate = "";
    }
?>

<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >

<form id=f1 name=f1 method=post>
<input type=hidden id=EventTaskPersonNotifyID name=EventTaskPersonNotifyID value='<? echo $_REQUEST["EventTaskPersonNotifyID"]?>'>
<table class="table table-sm table-stripped table-bordered">
    <thead>
        <td>&nbsp;</td>
        <td>
            <b>نوع اطلاع رسانی</b>
        </td>
        <td>
            <b>تاریخ ارسال</b>
        </td>
    </thead>
    <?
        $res = manage_EventTaskPersonNotify::GetList($_REQUEST["EventTaskPersonNotifyID"]);
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
                    echo "<a href='ManageEventTaskPersonNotify.php?id=".$id."&EventTaskPersonNotifyID=".$_REQUEST['EventTaskPersonNotifyID']."'>";
                    echo $res[$i]->NotifyType;
                    echo "</a>";
                    echo "</td>";

                    echo "<td>";
                    echo $res[$i]->SendDate;
                    echo "</td>";

                echo "</tr>";
            }
        }
    ?>
    <tr class="FooterOfTable">
        <td colspan=8 align="center">
            <input type=button class="btn btn-danger" value="حذف" onclick="if(confirm('آیا مطمئن هستید')) document.f1.submit();">
        </td>
    </tr>
</table>
</form>





</div>
    <div class="col-2"></div>
</div>
</div>

