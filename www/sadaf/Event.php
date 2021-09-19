<?php
    include "header.inc.php";
    HTMLBegin(); ?>
    
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
                        <input type="submit" name="Save" value="ثبت">
                    </td>  
                </tr>      
            </form>
        </table>
    </body>
</html>
 