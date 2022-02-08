<?php

function ShowCalendar($SelectedYear)
{

    $FromMonth=1;
    $now = date("Ymd");
    $yy = substr($now,0,4);
    $mm = substr($now,4,2);
    $dd = substr($now,6,2);
    list($dd,$mm,$yy) = ConvertX2SDate($dd,$mm,$yy);
    
    if(strlen($mm)==1)
        $mm = "0".$mm;
    if(strlen($dd)==1)
        $dd = "0".$dd;
    $list = "";
    $CurYear = $yy;


    $list .= "<tr>";
    for($month=$FromMonth; $month<13; $month++)
    {
        
        $list .= "<td>";
        $list .= "<table width=100% border=0 >";
        $list .= "<tr>";
        $list .= "<td colspan=7 align=center class=HeaderOfTable>";
        $list .= GetMonthName($month);
        $list .= "</td>";
        $list .= "</tr>";
        $RowCount = 0;
        $list .= "<tr>";

        $CurDateMiladi = GetMiladiDate($CurYear, $month, 1);
        $CurDate2  = mktime(0, 0, 0, substr($CurDateMiladi, 4, 2), substr($CurDateMiladi, 6, 2), substr($CurDateMiladi, 0, 4));

        $SelectedDateMiladi = GetMiladiDate($SelectedYear, $month, 1);
        $SelectedDate = mktime(0, 0, 0, substr($SelectedDateMiladi, 4, 2), substr($SelectedDateMiladi, 6, 2), substr($SelectedDateMiladi, 0, 4));
        $FirstDayLoc = FarsiDayNumberInWeek(date("l", $SelectedDate));
        for($i=1; $i<$FirstDayLoc; $i++)
        {
            $list .= "<td width=3% align=center>&nbsp;</td>";
        }

        for($day=1; $day<31; $day++) 
        {
            $list .= CreateDayCellInCalendar($SelectedYear, $CurYear, $month, $day, $dd, $mm);
            if(($day+$FirstDayLoc-1)%7==0)
            {
                $list .= "</tr><tr>";
                $RowCount++;
            }
        }
        if($month<7)
        {
            $day = 31;
            $list .= CreateDayCellInCalendar($SelectedYear, $CurYear, $month, $day, $dd, $mm);
            $list .= "</td></tr>";
        }
        else
        {
            $list .= "<td width=3% align=center>";
            $list .= "&nbsp;";
            $list .= "</td></tr>";
        }
        $list .= "</tr>";
        if($RowCount<5)
            $list .= "<tr><td colspan=7>&nbsp;</td></tr>";
        $list .= "</table>";
        $list .= "</td>";
        if($month%3==0)
        {
            $list .= "</tr>";
            $list .= "<tr>";
        }

    }
    echo "<table width=98% align=center '>";
    echo "<tr>";
    echo "<td width=60%>";
    echo "<table width='500px' align=center border=1 cellspacing=0>";
    echo $list;

    echo "</table>";
    echo "</td>";
    
    echo "</tr>";
    echo "</table>";
    echo "<br>";
    echo "<div style='overflow: auto; max-height: 200px; width: 700px; font-size: 11px' id=TaskInfo name=TaskInfo></div>";
}





    // با گرفتن سال و ماه و روز تاریخ میلادی می سازد به صورت رشته ای
    function GetMiladiDate($Year, $Month, $Day) {
        if ($Month < 10 && strlen($Month) == 1)
            $Month = "0" . $Month;
        if ($Day < 10 && strlen($Day) == 1)
            $Day = "0" . $Day;
        $date=$Year . "/" . $Month . "/" . $Day;
      $date = DateModules::shamsi_to_miladi($date);
      $date = str_replace("/", "", $date);
        return $date;
    }


    function GetMonthName($month) {
        if ($month == 1)
            return "فروردین";
        if ($month == 2)
            return "اردیبهشت";
        if ($month == 3)
            return "خرداد";
        if ($month == 4)
            return "تیر";
        if ($month == 5)
            return "مرداد";
        if ($month == 6)
            return "شهریور";
        if ($month == 7)
            return "مهر";
        if ($month == 8)
            return "آبان";
        if ($month == 9)
            return "آذر";
        if ($month == 10)
            return "دی";
        if ($month == 11)
            return "بهمن";
        if ($month == 12)
            return "اسفند";
        return "";
    }



    function FarsiDayNumberInWeek($EnglishDayName) {
        if ($EnglishDayName == "Friday")
            return 7;
        if ($EnglishDayName == "Thursday")
            return 6;
        if ($EnglishDayName == "Wednesday")
            return 5;
        if ($EnglishDayName == "Tuesday")
            return 4;
        if ($EnglishDayName == "Monday")
            return 3;
        if ($EnglishDayName == "Sunday")
            return 2;
        if ($EnglishDayName == "Saturday")
            return 1;
    }


    // آیا تاریخ ذکر شده در تعطیلات آخر هفته قرار دارد؟
    // فرمت تاریخ: 20090512
    function IsEndWeekVacation($CurDate) {
        $CurDate2 = mktime(0, 0, 0, substr($CurDate, 4, 2), substr($CurDate, 6, 2), substr($CurDate, 0, 4));
        if (date("l", $CurDate2) == "Friday" || date("l", $CurDate2) == "Thursday")
            return true;
        else
            return false;
    }


function CreateDayCellInCalendar($SelectedYear, $CurYear, $month, $day, $dd, $mm)
{
    $list = "";
    $EStyle = "";
    $SelectedDateMiladi = GetMiladiDate($SelectedYear, $month, $day);
    $SelectedDate2 = substr($SelectedDateMiladi,0,4)."-".substr($SelectedDateMiladi,4,2)."-".substr($SelectedDateMiladi,6,2);
    
    if(manage_Event::GetCountSearch('',$SelectedDate2,$SelectedDate2) > 0)
    {
        $EStyle = "style= 'border: 2px solid blue;'";
    }
    
    $link = "<a href='ShowDateEvents.php?CurDate=".$SelectedDateMiladi."'>";

    if(IsEndWeekVacation($SelectedDateMiladi))
    {
        if($mm==$month && $dd==$day)
            $list .= "<td ".$EStyle." width=3% align=center bgcolor='#7fff00'><b>".$day."</b></td>";
        else
            $list .= "<td ".$EStyle." width=3% align=center bgcolor=#eeeeee><b>".$day."</b></td>";
    }
    else
    {
        $TdStyle = "";
        if($mm==$month && $dd==$day)
            $list .= "<td ".$EStyle." width=3% align=center bgcolor='#7fff00' ".$TdStyle.">";
        else {
            
            $list .= "<td ".$EStyle." width=3% align=center onmouseover= 'javascript: ShowEvent(".$SelectedDateMiladi.", ".($month%4).", ".round($month/4).")'".$TdStyle.">".$link;
        }
        $IsHodiday = false;
        if($IsHodiday)
            $list .= "<span style=\"color: red; \"><b>";

        $list .= $day;
        
        if($IsHodiday)
            $list .= "</b></span>";

        $list .= "</a>";
        $list .= "</td>";
    }
    return $list;
}

