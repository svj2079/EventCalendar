<?php
    include "header.inc.php";
    include "classes/Event.class.php";
    include "classes/EventTypes.class.php";
    include "classes/EventAccess.class.php";
    include "classes/EventUnits.class.php";
    HTMLBegin();

    

    if(isset($_REQUEST["StartTime"]))
    {
        
        $s=xdate($_REQUEST["StartTime"]);
        $s= substr($s , 0 , 4)."-".substr($s , 4 , 2)."-".substr($s , 6 ,2)." ".$_REQUEST["StartHour"].":".$_REQUEST["StartMinute"];

        $e=xdate($_REQUEST["EndTime"]);
        $e= substr($e , 0 , 4)."-".substr($e , 4 , 2)."-".substr($e , 6 ,2)." ".$_REQUEST["EndHour"].":".$_REQUEST["EndMinute"];

        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $s, $e, $_REQUEST["description"], $_REQUEST["level"], $_SESSION["PersonID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($s, $e, $_REQUEST["description"], $_REQUEST["level"], $_SESSION["PersonID"], $_REQUEST["EventTypeID"]);
            echo "<script>document.location='ManageEvent.php';</script>";
    }

    if(isset($_REQUEST["id"]))
    {
        $obj = new be_Event();
        $obj->LoadDataFromDatabase($_REQUEST["id"]);
        $ShStartDate = $obj->ShStartDate;
        $StartDate = $obj->StartDate;
        $StartHour = $obj->StartHour;
        $StartMinute = $obj->StartMinute;
        $ShEndDate = $obj->ShEndDate;
        $EndDate = $obj->EndDate;
        $EndHour = $obj->EndHour;
        $EndMinute = $obj->EndMinute;
        $description = $obj->description;
        $level = $obj->level;
        $CreatorID = $obj->CreatorID;
        $EventTypeID = $obj->EventTypeID;
        $title = $obj->title;
    }
    else
    {
        $ShStartDate = "";
        $StartDate = "";
        $StartHour = "";
        $StartMinute = "";
        $ShEndDate = "";
        $EndDate = "";
        $EndHour = "";
        $EndMinute = "";
        $description = "";
        $level = "";
        $CreatorID = "";
        $EventTypeID = "";
        $title = "";
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
                <td align="center">ایجاد/ویرایش رویداد</td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0">
                <tr>
                <td width="1%" nowrap>
                    <b>عنوان</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="text" name="description" id="description" maxlength="45" value="<? echo $description ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>توضیحات</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="text" name="title" id="title" maxlength="45" value="<? echo $title ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>نوع</b>
                </td>
                <td nowrap>
                    <?echo manage_EventTypes::CreateSelectBoxOptions("EventTypeID",$EventTypeID);?>
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>تاریخ شروع رویداد</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="text" name="StartDate" id="StartDate" maxlength="45" placeholder="yyyy/mm/dd" value="<? echo $ShStartDate ?>"> 
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>ساعت شروع</b>
                </td>
                <td nowrap>
                    <input class="" type="text" name="StartHour" id="StartHour" size="2" maxlength="2" value="<? echo $StartHour ?>">:<input class="" type="text" name="StartMinute" id="StartMinute" size="2" maxlength="2" value="<? echo $StartMinute ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>تاریخ پایان رویداد</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="text" name="EndDate" id="EndDate" maxlength="45" placeholder="yyyy/mm/dd" value="<? echo $ShEndDate ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>ساعت پایان</b>
                </td>
                <td nowrap>
                    <input class="" type="text" name="EndHour" id="EndHour" size="2" maxlength="2" value="<? echo $EndHour ?>">:<input class="" type="text" name="EndMinute" id="EndMinute" size="2" maxlength="2" value="<? echo $EndMinute ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>سطح اهمیت رویداد</b>
                </td>
                <td nowrap>
                    <select name="level" id="level">
                        <option <? if($level =="1") echo"selected" ?> id="1">1</option>
                        <option <? if($level =="2") echo"selected" ?> id="2">2</option>
                        <option <? if($level =="3") echo"selected" ?> id="3">3</option>
                        <option <? if($level =="4") echo"selected" ?> id="4">4</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>واحد سازمانی</b>
                </td>
                <td nowrap>
                    <select name="unit" id="unit">
                        <option id="NONE">None</option>
                        <option <? if($unit =="EMAIL") echo"selected" ?> id="EMAIL">Email</option>
                        <option <? if($unit =="SMS") echo"selected" ?> id="SMS">SMS</option>
                        <option <? if($unit =="PORTAL") echo"selected" ?> id="PORTAL">Portal</option>
                    </select>
                </td>
        </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>زیرواحد سازمانی</b>
                </td>
                <td nowrap>
                    <select name="SubUnit" id="SubUnit">
                        <option id="NONE">None</option>
                        <option <? if($SubUnit =="EMAIL") echo"selected" ?> id="EMAIL">Email</option>
                        <option <? if($SubUnit =="SMS") echo"selected" ?> id="SMS">SMS</option>
                        <option <? if($SubUnit =="PORTAL") echo"selected" ?> id="PORTAL">Portal</option>
                    </select>
                </td>
            </tr>
            <tr class="FooterOfTable">
                <td align="center" colspan="2">
                    <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="ذخیره">
                    <input type="button" class="btn " onclick="javascript: document.location='NewEvent.php';" value="جدید">
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


 
 