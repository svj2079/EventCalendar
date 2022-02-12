<?php
    include "header.inc.php";
    include "classes\Event.class.php";
    include "classes/calendar.class.php";
    //include "classes\EventTaskPerson.class.php";
    HTMLBegin();
    if(isset($_REQUEST["SelectedYear"]))
    {
        $SelectedYear = $_REQUEST["SelectedYear"];
    }
    else
    {
        $now = date("Ymd");
        $yy = substr($now,0,4);
        $mm = substr($now,4,2);
        $dd = substr($now,6,2);
        list($dd,$mm,$yy) = ConvertX2SDate($dd,$mm,$yy);
        $SelectedYear = $yy;
    }
    $PrevYear = $SelectedYear-1;
    $NextYear = $SelectedYear+1;

    ?>


<div class="container-fluid">
<div class="row">
<div class="col-5" >
    <div id="DivShowEvent" style="background-color: white; "></div>
</div>
<div class="col-7">


<form id=f2 name=f2 method="Get">
<table class="table table-sm table-stripped table-bordered " align="center" style="border-color: gray;">
<tr>
    <td align=right>
        <input type="button" class="btn btn-info" onclick="javascript: document.location='calendar.php?SelectedYear=<? echo $PrevYear ?>'" value="قبل" id="before">
    </td>
    <td align=center>
        <? echo "<b>".$SelectedYear."</b>" ?>
    </td>
    <td align=left>
        <input type="button" class="btn btn-info" onclick="javascript: document.location='calendar.php?SelectedYear=<? echo $NextYear ?>'" value="بعد" id="next">
    </td>
</tr>
<tr>
    <td align="center" colspan=3>
        <?php 
            ShowCalendar($SelectedYear);
        ?>
    </td>
</tr>
<tr>
    <td align=right>
        <input type="button" class="btn btn-info" onclick="javascript: document.location='calendar.php?SelectedYear=<? echo $PrevYear ?>'" value="قبل" id="before">
    </td>
    <td align=center>
        <? echo "<b>".$SelectedYear."</b>" ?>
    </td>
    <td align=left>
        <input type="button" class="btn btn-info" onclick="javascript: document.location='calendar.php?SelectedYear=<? echo $NextYear ?>'" value="بعد" id="next">
    </td>
</tr>

</table>

</div>

</div>
</div>



<script>
    function HideEvent()
    {
        myDiv = document.getElementById ('DivShowEvent');
        myDiv.innerHTML = "";        
    }

    function ShowEvent(SelectedDateMiladi, y, x)
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                myDiv = document.getElementById ('DivShowEvent');
                myDiv.innerHTML = this.responseText;
                //myDiv.style.backgroundColor = "red";
                //myDiv.style.top = y*200+"px";
                //myDiv.style.left = x*100+"px";
                //console.log(myDiv.style.top, myDiv.style.left)
                //myDiv.style.height = "200px";
            }
        };
        xmlhttp.open("GET", "ShowDateEvents.php?CurDate="+ SelectedDateMiladi, true);
        xmlhttp.send();
    }
    


</script>
