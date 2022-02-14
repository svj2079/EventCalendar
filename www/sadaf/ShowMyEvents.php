<?php

    include "header.inc.php";
    include "classes/Event.class.php";
    include "classes/EventTasks.class.php";
    include "classes/EventTaskPerson.class.php";
    HTMLBegin();

  

?>


<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >


<form id=f1 name=f1 method=post>
    <table class="table table-sm table-stripped table-bordered">
        <tr class="HeaderOfTable">
            <td align="center" colspan="10">
                <b>رویدادهای من</b>
            </td>
        </tr>
        <tr>
            <td>
                <b>عنوان رویداد</b>
            </td>
            <td>
                <b>توضیحات رویداد</b>
            </td>
            <td>
                <b>توضحات چک لیست</b>
            </td>
             <td>
                <b>تاریخ و ساعت شروع</b>
            </td>
            <td>
                <b>تاریخ و ساعت پایان</b>
            </td>
        </tr>
        <?
            $res = manage_EventTasks::GetPersonTasks($_SESSION["PersonID"]);
            if ($res != null)
            {
                while($rec = $res->fetch())
                { 
                    $id = $rec[$i]->id;
                    echo "<tr>";                                                                                                                                                     
                        echo "<td>";
                        echo $rec['EventTitle'];
                        echo "</td>";
                        echo "<td>";
                        echo $rec['EventDescription'];
                        echo "</td>";
                        echo "<td>";
                        echo $rec['description'];
                        echo "</td>";
                        echo "<td>";
                        echo $rec['gStartDate'];
                        echo "</td>";
                        echo "<td>";
                        echo $rec['gEndDate'];
                        echo "</td>";
                    echo "</tr>";
                }
            }
        ?>
        
    </table>      
</form>
</div>
    <div class="col-2"></div>
</div>
</div>

