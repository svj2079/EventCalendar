<?php

    include "header.inc.php";
    include "classes/Event.class.php";
    include "classes/EventTasks.class.php";
    include "classes/EventTaskPerson.class.php";
    HTMLBegin();

    $ItemsCount = 10;
    $SearchCond = "";
    if (isset($_REQUEST["FromRec"]))
    {
        if(is_numeric($_REQUEST["FromRec"]))
            $FromRec = $_REQUEST["FromRec"];
    }
    else
        $FromRec = 0;

    if(isset($_REQUEST["FromDate"]))
    {
        $FromDate = $_REQUEST["FromDate"];
        $ToDate = $_REQUEST["ToDate"];
        $SearchCond = "FromDate=".$FromDate."&ToDate=".$ToDate;
        $s = $e = "";
        if($FromDate!="")
        {
            $s=xdate($_REQUEST["FromDate"]);
            $s= (substr($s , 0 , 4)."-".substr($s , 4 , 2)."-".substr($s , 6 ,2));
        }
        if($ToDate!="")
        {
            $e=xdate($_REQUEST["ToDate"]);
            $e= substr($e , 0 , 4)."-".substr($e , 4 , 2)."-".substr($e , 6 ,2);
        }
        $res = manage_EventTasks::Search($s , $e , $FromRec , $ItemsCount);

    }
    else
    {
        $FromDate = "";
        $ToDate = "";

        $res = manage_EventTasks::GetList($EventID);
    }


?>


<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >


<form id=f2 name=f2 method="post">
    <table class="table table-sm table-stripped table-bordered">
        <tr class="HeaderOfTable">
            <td align="center">
                <b>جستجو رویداد</b>
            </td>
        </tr>
        <tr>
            <table width="100%" border="0">
            <tr>
                <td width="1%" nowrap>
                    <b>از تاریخ</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="text" name="FromDate" id="FromDate" maxlength="45" placeholder="yyyy/mm/dd" value="<? echo $FromDate ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>تا تاریخ</b>
                </td>
                <td nowrap>
                <input class="form-control sadaf-m-input" type="text" name="ToDate" id="ToDate" maxlength="45" placeholder="yyyy/mm/dd" value="<? echo $ToDate ?>">
                </td>
            </tr>
            <tr class="FooterOfTable">
                <td align="center" colspan="2">
                    <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="جستجو">
                </td>
            </tr>
            </table>
        </tr>
    </table>
</form>



<form id=f1 name=f1 method=post>
    <input type="hidden" id="PersonID" name="PersonID" value="<? echo $_REQUEST['PersonID']?>">
    <table class="table table-sm table-stripped table-bordered">
        <tr class="HeaderOfTable">
            <td align="center" colspan="10">
                <b>رویدادهای من</b>
            </td>
        </tr>
        <tr>
            
            <td>
                <b>کد رویداد</b>
            </td>
            <td>
                <b>عنوان رویداد</b>
            </td>
            <td>
                <b>توضیحات رویداد</b>
            </td>
            <td>
                <b>توضیحات</b>
            </td>
            <td>
                <b>ارسال ایمیل</b>
            </td>
            <td>
                <b>ارسال پیامک</b>
            </td>
            <td>
                <b>درخواست کار</b>
            </td>
            <td>
                <b>تاریخ شروع</b>
            </td>
            <td>
                <b>تاریخ پایان</b>
            </td>
        </tr>
        <?
            $res = manage_EventTasks::GetPersonTasks($_REQUEST["PersonID"]);
            if ($res != null)
            {
                for($i=0; $i<count($res); $i++)
                { 
                    $id = $res[$i]->id;
                    echo "<tr>";
                        echo "<td>";
                        echo $res[$i]->EventTaskID;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->EventTitle;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->EventDescription;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->description;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->NotifyByEmail;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->NotifyBySms;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->NotifyByTask;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->StartTime;
                        echo "</td>";
                        echo "<td>";
                        echo $res[$i]->EndTime;
                        echo "</td>";
                    echo "</tr>";
                }
            }
        ?>
        <tr class="FooterOfTable">
        </tr>
        <tr>
            <td colspan="8">
                <?php
                    if(isset($_REQUEST["FromDate"]))
                        $TotalCount = manage_EventTasks::GetCountSearch($FromDate, $ToDate);
                    else
                        $TotalCount = manage_EventTasks::GetCount();
                    for ($p=1 ; $p <= ceil($TotalCount/$ItemsCount) ; $p++)
                    {
                        if(($p-1) * $ItemsCount != $FromRec)
                        {
                            echo "<a href = 'ShowMyEvents.php?FromRec=".(($p-1)*$ItemsCount)."&".$SearchCond."'>";
                            echo $p;
                            echo "</a> ";
                        }
                        else
                            echo "<b>".$p."</b> ";
                    }
                ?>
            </td>
        </tr>
    </table>      
</form>
</div>
    <div class="col-2"></div>
</div>
</div>

<script>
    function ValidateForm(){

        FromDate = document.getElementById('FromDate').value;
        ToDate = document.getElementById('ToDate').value;

        if(FromDate != "")
        {
            if(!(/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/.test(FromDate)) && !(/^[0-9]{4}[\/](0[1-9]|1[0-2])[\/](0[1-9]|[1-2][0-9]|3[0-1])$/.test(FromDate)))
            {
                alert("تاریخ شروع صحیح نیست");
                return;
            }
        }

        if(ToDate != "")
        {
            if(!(/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/.test(ToDate)) && !(/^[0-9]{4}[\/](0[1-9]|1[0-2])[\/](0[1-9]|[1-2][0-9]|3[0-1])$/.test(ToDate)))
            {
                alert("تاریخ پایان صحیح نیست");
                return;
            }
        }

        document.getElementById('f2').submit();
	}
    //document.f2.submit();


        
    
</script>