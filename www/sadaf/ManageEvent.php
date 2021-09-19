<?php
    include "header.inc.php";
    include "classes/Event.class.php";
    HTMLBegin();
    $s="1 400-06-28";
    $d=xdate($s);
    $d = substr($d , 0 , 4)."-".substr($d , 4 , 2)."-".substr($d , 6 ,2);
    echo $d;
    manage_Event::Add("2021-09-09 10:05","2021-09-10 10:05","test","1","1","1");
    manage_Event::Update(1,"2021-11-12 10:05", "2022-10-01 11:00","test1", 1 , 2 , 2);
    die();

   /* if(isset($_REQUEST["description"]))
    {
        if(isset($_REQUEST["id"]))
            manage_EventTypes::Update($_REQUEST["id"], $_REQUEST["description"]);
        else
            manage_EventTypes::Add($_REQUEST["description"]);
    }*/
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
    
        <table class="table-sm table-borderd" style="direction: dir=ltr">
            <form action="" method="$_POST">
                <tr>
                    <td>
                        <b>توضیح</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="Description" value="توضیح مختصر رویداد">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>تاریخ شروع</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="date" name="StartDate" value="تاریخ شروع رویداد (سال-ماه-روز)">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>ساعت</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="StartHoure" value="ساعت شروع رویداد">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>دقیقه</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="StartMinute" value="دقیقه شروع رویداد">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>تاریخ پایان</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="date" name="EndDate" value="تاریخ پایان رویداد (سال-ماه-روز)">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>ساعت</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="EndHoure" value="ساعت پایان رویداد">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>دقیقه</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="EndMinute" value="دقیقه پایان رویداد">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>سطح رویداد </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="Level" value="سطح اهمیت رویداد" class="btn btn-info">
                    </td>   
                </tr>
                <tr>
                    <td>
                        <b>کد شخص</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="PersonID" value="کد دسترسی شخص" class="btn btn-info">
                    </td>  
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="EventID" value="رویداد" location="localhost:href='EventType.php'">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="Edit" value="ویرایش">
                    </td>  
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="Delete" value="حذف">
                    </td>  
                </tr>      
            </form>
        </table>
    </body>
</html>
 