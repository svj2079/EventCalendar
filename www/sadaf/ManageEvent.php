<?php
    include "header.inc.php";
    include "classes/Event.class.php";
    HTMLBegin();

   /* $s="1 400-06-28";
    $d=xdate($s);
    $d = substr($d , 0 , 4)."-".substr($d , 4 , 2)."-".substr($d , 6 ,2);
    echo $d;
    manage_Event::Add("2021-09-09 10:05","2021-09-10 10:05","test","1","1","1");
    manage_Event::Update(1,"2021-11-12 10:05", "2022-10-01 11:00","test1", 1 , 2 , 2);
    die();
*/
    if(isset($_REQUEST["ShStartDate"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["ShStartDate"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["ShStartDate"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["StartDate"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["ShStartDate"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["StartDate"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["StartHour"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["StartHour"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["StartHour"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["StartMinute"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["StartMinute"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["StartMinute"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["ShEndDate"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["ShEndDate"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["ShEndDate"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["EndDate"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["EndDate"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["EndDate"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["EndHour"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["EndHour"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["EndHour"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["EndMinute"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["EndMinute"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["EndMinute"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["description"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["description"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["description"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["level"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["level"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["level"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["CreatorID"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["CreatorID"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["CreatorID"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
    }

    if(isset($_REQUEST["EventTypeID"]))
    {
        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $_REQUEST["EventTypeID"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
        else
            manage_Event::Add($_REQUEST["EventTypeID"], $_REQUEST["ShEndDate"], $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["CreatorID"], $_REQUEST["EventTypeID"]);
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
    }
    else
        $description = "";
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
                    <b>تاریخ شروع رویداد</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="date" name="StartDate" id="StartDate" maxlength="45" value="<? echo $StartDate ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>ساعت شروع</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="StartHoure" id="StartHoure" maxlength="45" value="<? echo $StartHoure ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>دقیقه شروع</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="StartMinute" id="StartMinute" maxlength="45" value="<? echo $StartMinute ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>تاریخ پایان رویداد</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="date" name="EndDate" id="EndDate" maxlength="45" value="<? echo $EndDate ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>ساعت پایان</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="EndHoure" id="EndHoure" maxlength="45" value="<? echo $EndHoure ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>دقیقه پایان</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="EndMinute" id="EndMinute" maxlength="45" value="<? echo $EndMinute ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>سطح اهمیت رویداد</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="Level" id="Level" maxlength="45" value="<? echo $Level ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap> 
                    <b>کد دسترسی شخص</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="number" name="PersonID" id="PersonID" maxlength="45" value="<? echo $PersonID ?>">
                </td>
            </tr>
            <tr class="FooterOfTable">
                <td align="center" colspan="2">
                    <input type="submit" name="EventID" value="صفحه رویدادها" location="localhost:href='EventType.php'">
                </td>
            </tr>
            <tr class="FooterOfTable">
                <td align="center" colspan="2">
                    <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="ذخیره">
                    
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
 