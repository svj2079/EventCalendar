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
<div class="col-2" ></div>
<div class="col-8" >


<form id=f2 name=f2 method="Get">
<table class="table table-sm table-stripped table-bordered col-11 mx-auto" align="center">
<tr>
    <td align=center>
        <input type="button" class="btn btn-info" onclick="javascript: document.location='calendar.php?SelectedYear=<? echo $PrevYear ?>'" value="قبل" id="before">
    </td>
    <td align=center>
        <? echo $SelectedYear ?>
    </td>
    <td align=center>
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
    <td align=center>
        <input type="button" class="btn btn-info" onclick="javascript: document.location='calendar.php?SelectedYear=<? echo $PrevYear ?>'" value="قبل" id="before">
    </td>
    <td align=center>
        <? echo $SelectedYear ?>
    </td>
    <td align=center>
        <input type="button" class="btn btn-info" onclick="javascript: document.location='calendar.php?SelectedYear=<? echo $NextYear ?>'" value="بعد" id="next">
    </td>
</tr>









</div>
    <div class="col-2"></div>
</div>
</div>