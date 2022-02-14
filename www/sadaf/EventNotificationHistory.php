<?php 

    include "header.inc.php";
    include "classes/EventNotificationHistory.class.php";
    HTMLBegin();

?>

<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >

<form id=f1 name=f1 method=post>
<table class="table table-sm table-stripped table-bordered">
        <tr class="HeaderOfTable">
            <td align="center" colspan="3">
                <b>تاریخچه</b>
            </td>
        </tr>
        <tr>
            <td>
                <b>نام و نام خانوادگی</b>
            </td>
            <td>
                <b>تاریخ ارسال</b>
            </td>
            <td>
                <b>نوع اطلاع رسانی</b>
            </td>
        </tr>
    <?
        $res = manage_EventNotificationHistory::GetList($_REQUEST["EventTaskID"]);
        if ($res != null)
        for($i=0; $i<count($res); $i++)
        {
            
            echo "<tr>";
                echo "<td>";
                echo $res[$i]->FullName;
                echo "</td>";
                echo "<td>";
                echo $res[$i]->SendDate;
                echo "</td>";
                echo "<td>";
                echo $res[$i]->NotifyType;
                echo "</td>";
            echo "</tr>";
            
        }
    ?>
    <tr class="FooterOfTable">
    </tr>
</table>
</form>





</div>
    <div class="col-2"></div>
</div>
</div>


