<?php
    include "header.inc.php";
    include "classes/Event.class.php";
    include "classes/EventTypes.class.php";
    include "classes/EventAccess.class.php";
    include "classes/EventUnits.class.php";

    if (isset($_REQUEST["GetSubUnits"]))
    {
        echo manage_EventUnits::CreateSubUnitSelectOptions("SubUnitID", $_REQUEST["GetSubUnits"] ,0);
        die();
    }


    HTMLBegin();

    $UnitID=0;
    $SubUnitID=0;
    $ForProf="NO";
    $ForStudent="NO";
    $ForStaff="NO";

    if(isset($_REQUEST["StartDate"]))
    {
        if(isset($_REQUEST["ForProf"]))
        {
            $ForProf="YES";
        }
        if(isset($_REQUEST["ForStudent"]))
        {
            $ForStudent="YES";
        }
        if(isset($_REQUEST["ForStaff"]))
        {
            $ForStaff="YES";
        }

        $StartHour = $_REQUEST["StartHour"];
        if($StartHour == "")
        {
            $StartHour = 0;
        }
        $StartMinute = $_REQUEST["StartMinute"];
        if($StartMinute == "")
        {
            $StartMinute = 0;
        }
       
        $s=xdate($_REQUEST["StartDate"]);
        $s= substr($s , 0 , 4)."-".substr($s , 4 , 2)."-".substr($s , 6 ,2)." ".$StartHour.":".$StartMinute;

        $EndHour = $_REQUEST["EndHour"];
        if ($EndHour == "")
        {
            $EndHour = 23;
        }
        $EndMinute = $_REQUEST["EndMinute"];
        if ($EndMinute == "")
        {
            $EndMinute = 59;
        }
        $e=xdate($_REQUEST["EndDate"]);
        $e= substr($e , 0 , 4)."-".substr($e , 4 , 2)."-".substr($e , 6 ,2)." ".$EndHour.":".$EndMinute;

        if(isset($_REQUEST["id"]))
            manage_Event::Update($_REQUEST["id"], $s, $e, $_REQUEST["description"], $_REQUEST["level"], $_REQUEST["EventTypeID"], $_REQUEST["title"], $ForProf, $ForStudent, $ForStaff, $_REQUEST["UnitID"], $_REQUEST["SubUnitID"]);
        else
            manage_Event::Add($s, $e, $_REQUEST["description"], $_REQUEST["level"], $_SESSION["PersonID"], $_REQUEST["EventTypeID"], $_REQUEST["title"], $ForProf, $ForStudent, $ForStaff, $_REQUEST["UnitID"], $_REQUEST["SubUnitID"]);
            //echo "<script>document.location='ManageEvent.php';</script>";
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
        $ForProf = $obj->ForProf;
        $ForStudent = $obj->ForStudent;
        $ForStaff = $obj->ForStaff;
        $UnitID = $obj->UnitID;
        $SubUnitID = $obj->SubUnitID;
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
        $ForProf = "";
        $ForStudent = "";
        $ForStaff = "";
        $UnitID = "";
        $SubUnitID = "";
    }
    
    ?>


<div class="container-fluid">
<div class="row">
<div class="col-1" ></div>
<div class="col-10" >
    
    <form id=f2 name=f2 method="Get">
            <?
                if(isset($_REQUEST["id"]))
                    echo "<input type=hidden id=id name=id value='".$_REQUEST["id"]."'>";
            ?>
        <table class="table table-sm table-stripped table-bordered">
            <tr class="HeaderOfTable">
                <td align="center"><b>??????????/???????????? ????????????</b></td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0">
                <tr>
                <td width="1%" nowrap>
                    <span style="color: red;">*</span>
                    <b>??????????</b>
                </td>
                <td nowrap>
                    <input required class="form-control sadaf-m-input" type="text" name="title" id="title" maxlength="45" value="<? echo $title ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>??????????????</b>
                </td>
                <td nowrap>
                    <textarea id="description" name="description" rows="5" cols="100"><?php echo $description; ?></textarea>
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>??????</b>
                </td>
                <td nowrap>
                    <?echo manage_EventTypes::CreateSelectBoxOptions("EventTypeID",$EventTypeID);?>
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <span style="color: red;">*</span>
                    <b>?????????? ???????? ????????????</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="text" name="StartDate" id="StartDate" maxlength="45" placeholder="yyyy/mm/dd" value="<? echo $ShStartDate ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>???????? ????????</b>
                </td>
                <td nowrap>
                    <input type="text" name="StartHour" id="StartHour" size="2" maxlength="2" value="<? echo $StartHour ?>">:<input type="text" name="StartMinute" id="StartMinute" size="2" maxlength="2" value="<? echo $StartMinute ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <span style="color: red;">*</span>
                    <b>?????????? ?????????? ????????????</b>
                </td>
                <td nowrap>
                    <input class="form-control sadaf-m-input" type="text" name="EndDate" id="EndDate" maxlength="45" placeholder="yyyy/mm/dd" value="<? echo $ShEndDate ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>???????? ??????????</b>
                </td>
                <td nowrap>
                    <input class="" type="text" name="EndHour" id="EndHour" size="2" maxlength="2" value="<? echo $EndHour ?>">:<input class="" type="text" name="EndMinute" id="EndMinute" size="2" maxlength="2" value="<? echo $EndMinute ?>">
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>?????? ?????????? ????????????</b>
                </td>
                <td nowrap>
                    <select name="level" id="level">
                        <option <? if($level =="1") echo"selected" ?> value="1">1</option>
                        <option <? if($level =="2") echo"selected" ?> value="2">2</option>
                        <option <? if($level =="3") echo"selected" ?> value="3">3</option>
                        <option <? if($level =="4") echo"selected" ?> value="4">4</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>???????? ??????????????</b>
                </td>
                <td nowrap>
                    <?echo manage_EventUnits::CreateUnitSelectOptions("UnitID",$UnitID);?>
                </td>
            </td>
            </tr>
            <tr>
                <td width="1%" nowrap>
                    <b>?????????????? ??????????????</b>
                </td>
                <td nowrap>
                    <span id="SpanSubUnitID">
                        <?echo manage_EventUnits::CreateSubUnitSelectOptions("SubUnitID", $UnitID ,$SubUnitID);?>
                    </span>
                </td>
            </tr>
            <tr>
                <td width="1%" nowrap> 
                    <b>???????? ??????</b>
                </td>
                <td nowrap>
                <input type="checkbox" id="ForProf" name="ForProf" value="????????????" <?php if($ForProf == "YES") echo "checked"; ?>>
                    <label for="ForProf">????????????</label><br>
                <input type="checkbox" id="ForStudent" name="ForStudent" value="??????????????????" <?php if($ForStudent == "YES") echo "checked"; ?>>
                    <label for="ForStudent">??????????????????</label><br>
                <input type="checkbox" id="ForStaff" name="ForStaff" value="????????????????" <?php if($ForStaff == "YES") echo "checked"; ?>>
                    <label for="ForStaff">????????????????</label>
                </td>
            </tr>
            <tr class="FooterOfTable">
                <td align="center" colspan="2">
                    <input type="button" class="btn btn-info" onclick="javascript: ValidateForm();" value="??????????">
                    <input type="button" class="btn " onclick="javascript: document.location='NewEvent.php';" value="????????">
                </td>  
            </tr>
        </table>      
    </form>
        
        </div>
    <div class="col-1"></div>
</div>
</div>

<script>
	function ValidateForm()
	{
        startDate = document.getElementById('StartDate').value;
        EndDate = document.getElementById('EndDate').value;
        if(document.getElementById('title').value == "")
        {
            alert("???????? ?????????? ???? ???????? ????????");
            return;
        }
        
        if(startDate == "")
        {
            alert("???????? ?????????? ???????? ???? ???????? ????????");
            return;
        }

        if(!(/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/.test(startDate)) && !(/^[0-9]{4}[\/](0[1-9]|1[0-2])[\/](0[1-9]|[1-2][0-9]|3[0-1])$/.test(startDate)))
        {
            alert("?????????? ???????? ???????? ????????");
            return;
        }

        if(EndDate == "")
        {
            alert("???????? ?????????? ?????????? ???? ???????? ????????");
            return;
        }

        if(!(/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/.test(EndDate)) && !(/^[0-9]{4}[\/](0[1-9]|1[0-2])[\/](0[1-9]|[1-2][0-9]|3[0-1])$/.test(EndDate)))
        {
            alert("?????????? ?????????? ???????? ????????");
            return;
        }

		document.f2.submit();
    
	}

    function SetUnit()
    {
        UnitID = document.getElementById('UnitID');
       
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById ('SpanSubUnitID').innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "NewEvent.php?GetSubUnits="+UnitID.value, true);
        xmlhttp.send(); 
    }
</script>


 
 