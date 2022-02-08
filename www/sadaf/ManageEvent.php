<?php
    include "header.inc.php";
    include "classes\Event.class.php";
   
    //include "classes\EventTaskPerson.class.php";
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

    if(isset($_REQUEST["title"]))
    {
        $title = $_REQUEST["title"];
        $FromDate = $_REQUEST["FromDate"];
        $ToDate = $_REQUEST["ToDate"];
        $SearchCond = "title=".$title."&FromDate=".$FromDate."&ToDate=".$ToDate;
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
        $res = manage_Event::Search($title , $s , $e , $FromRec , $ItemsCount);

    }
    else
    {
        $title = "";
        $FromDate = "";
        $ToDate = "";

        $res = manage_Event::GetList("", $FromRec ,$ItemsCount);
    }

    ?>
    
<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >

<form id=f2 name=f2 method="post">
    <table class="table table-sm table-stripped table-bordered">
    <tr class="HeaderOfTable">
    <td align="center"><b>جستجو رویداد</b></td>
    </tr>
    <tr>
    <td>
    <table width="100%" border="0">
    <tr>
        <td width="1%" nowrap>
            <b>عنوان</b>
        </td>
        <td nowrap>
        <input class="form-control sadaf-m-input" type="text" name="title" id="title" maxlength="45" value="<? echo $title ?>">
        </td>
    </tr>
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
</form>
    
    <form id=f1 name=f1 method=post>
        <table class="table table-sm table-stripped table-bordered">
            <tr class="HeaderOfTable">
                <td align="center" colspan="8">
                    <b>رویدادها</b>
                </td>
            </tr>
            <tr>
                    <td>&nbsp;</td>
                    <td>
                        <b>عنوان</b>
                    </td>
                    <td>
                        <b>تاریخ شروع</b>
                    </td>
                    <td>
                        <b>تاریخ پایان</b>
                    </td>
                    <td>
                        <b>مدیران</b>
                    </td>
                    <td>
                        <b>چک لیست</b>
                    </td>
                
            </tr>

            <?
                
                for($i=0; $i<count($res); $i++)
                {
                    $id = $res[$i]->id;
                    $CheckBoxId = "ch_".$id;
                    if(isset($_POST[$CheckBoxId]))
                    {
                        manage_Event::Remove($id);
                    }
                    else
                    {
                        
                        echo "<tr>";

                        echo "<td>";
                        echo "<input type=checkbox name='".$CheckBoxId."'>";
                        echo "</td>";
                        
                        echo "<td>";
                        echo "<a href='NewEvent.php?id=".$id."'>";
                        echo $res[$i]->title; 
                        echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        //echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->ShStartDate;
                        //echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        //echo "<a href='ManageEvent.php?id=".$id."'>";
                        echo $res[$i]->ShEndDate;
                        //echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEventAccess.php?EventID=".$id."'>";
                        echo "<i class='fa fa-users' title='مدیران'></i>";
                        echo "</a>";
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='ManageEventTasks.php?EventID=".$id."'>";
                        echo "<i class='fa fa-tasks' title='چک لیست'></i>";
                        echo "</a>";
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
    <tr>
        <td colspan="8">
            <?php

        

                if(isset($_REQUEST["title"]))
                    $TotalCount = manage_Event::GetCountSearch($title, $FromDate, $ToDate);
                else
                    $TotalCount = manage_Event::GetCount();
                for ($p=1 ; $p <= ceil($TotalCount/$ItemsCount) ; $p++)
                {
                    if(($p-1) * $ItemsCount != $FromRec)
                    {
                        echo "<a href = 'ManageEvent.php?FromRec=".(($p-1)*$ItemsCount)."&".$SearchCond."'>";
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







