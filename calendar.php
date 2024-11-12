<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
</head>
<body>
<h1>CALENDAR</h1>
<style>
    body {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    h1 {
        text-align: center;
        font-size: 50px;
        padding: 20px;
        font-family:  "Permanent Marker", serif;
        font-style: normal;

    }
    table {
        border-collapse: collapse;
        margin: auto;
        width: 90%;
        max-width: 700px;
    }
    td {
        padding: 10px;
        text-align: center;
        border: 1px solid #999;
        width: 65px;
        height: 5vh;
        font-size: 21px;
        font-weight: 500;
    }
    td1 {
        padding: 35px;
        text-align: center;
        font-size: 20px;
        font-weight: 500;
    }
    .holiday {
        color: red;
    }
    .grey-text {
        color: #999;
    }
    .today {
        background: blue;
        color: white;
        font-weight: bolder;
    }
    .public-holiday {
            background-color: #ff6666; /* 國定假日背景紅色 */
            color: red; /* 文字顏色設為白色 */
            font-weight: bold; /* 文字加粗 */
        }
    .nav {
        width: 688px;
        margin: auto;
        text-align: center;
    }
    .nav table td {
        border: 0;
        padding: 0;
    }
    a {
        text-decoration: none;
        color: black;
        font-weight: 700;
    }

</style>


<?php

if (isset($_GET['month'])) {
    $month = $_GET['month'];
} else {
    $month = date("m");
}
if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date("Y");
}

if ($month - 1 < 1) {
    $prevMonth = 12;
    $prevYear = $year - 1;
} else {
    $prevMonth = $month - 1;
    $prevYear = $year;
}

if ($month + 1 > 12) {
    $nextMonth = 1;
    $nextYear = $year + 1;
} else {
    $nextMonth = $month + 1;
    $nextYear = $year;
}

$spDate = [
    '2024-11-07' => "立冬",
    '2024-06-10' => "端午節",
    '2024-09-17' => "中秋節",
    '2025-06-20' => "端午節",
    '2025-09-27' => "中秋節",
    '2026-06-30' => "端午節",
    '2026-10-07' => "中秋節",
    '2024-11-22' => '小雪'
];

$holidays = [
    '01-01' => "元旦",
    '02-10' => "農曆新年",
    '04-04' => "兒童節",
    '04-05' => "清明節",
    '05-01' => "勞動節",
    '10-10' => "國慶日"
];

?>

<div class="nav">
    <form action="calendar.php" class="div_form div_center">
        <div>
            <div>
            <td1 style="font-size:40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                <?php echo date("{$month}月"); ?>
            </td1>
            </div>
            <div>
                <label for="year"></label>
                <input type="number" name="year" id="year" placeholder="YYYY" pattern="\d{4}" title="請輸入年份（YYYY）">年
                <label for="month"></label>
                <input type="number" name="month" id="month" placeholder="MM" pattern="\d{2}" title="請輸入月份（MM）">月
                <input type="submit" value="送出">
            </div>
        </div>
        </form>
    <table style="width: 100%">
        <tr>
            <td style="text-align:left">
                <!-- 前年按鈕，年份減少 1 年 -->
                <a href="calendar.php?year=<?= $year - 1; ?>&month=<?= $month; ?>">前年</a>
                <a href="calendar.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>">上一個月</a>
            </td>    
            
            <td style="text-align:right">
                <a href="calendar.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>">下一個月</a>
                <!-- 明年按鈕，年份增加 1 年 -->
                <a href="calendar.php?year=<?= $year + 1; ?>&month=<?= $month; ?>">明年</a>
            </td>
        </tr>
    </table>
</div>

<table>
<tr>
    <td>Sun</td>
    <td>Mon</td>
    <td>Tue</td>
    <td>Wed</td>
    <td>Thu</td>
    <td>Fri</td>
    <td>Sat</td>
</tr>
<?php

$firstDay = "{$year}-{$month}-1";
$firstDayTime = strtotime($firstDay);
$firstDayWeek = date("w", $firstDayTime);

for ($i = 0; $i < 6; $i++) {
    echo "<tr>";
    for ($j = 0; $j < 7; $j++) {
        $cell = $i * 7 + $j - $firstDayWeek;
        $theDayTime = strtotime("$cell days" . $firstDay);

        // 所需樣式css判斷
        $theMonth = (date("m", $theDayTime) == date("m", $firstDayTime)) ? '' : 'grey-text';
        $isToday = (date("Y-m-d", $theDayTime) == date("Y-m-d")) ? 'today' : '';
        $w = date("w", $theDayTime);
        $isHoliday = ($w == 0 || $w == 6) ? 'holiday' : '';
        
        echo "<td class='$isHoliday $theMonth $isToday'>";
        echo date("d", $theDayTime);
        
        if (isset($spDate[date('Y-m-d', $theDayTime)])) {
            echo "<br>{$spDate[date('Y-m-d', $theDayTime)]}";
        }
        if (isset($holidays[date("m-d", $theDayTime)])) {
            echo "<br>{$holidays[date("m-d", $theDayTime)]}";
        }
        echo "</td>";
        
    }
    echo "</tr>";
}

?>
</table>
</body>
</html>
