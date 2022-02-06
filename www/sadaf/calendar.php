<?php
    include "header.inc.php";
    include "classes\Event.class.php";
    include "classes/calendar.class.php";
    //include "classes\EventTaskPerson.class.php";
    HTMLBegin();
    
    ?>

<div class="container-fluid">
<div class="row">
<div class="col-2" ></div>
<div class="col-8" >


<form id=f2 name=f2 method="Get">
<table class="table table-sm table-stripped table-bordered">
<tr>
    <td align="center" colspan="2">
        <?php 
            ShowCalendar();
        ?>
    </td>
</tr>
<tr>
    <td>
        <input type="button" class="btn" onclick="" value="ذخیره">
    </td>
</tr>









</div>
    <div class="col-2"></div>
</div>
</div>