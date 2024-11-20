<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
</head>

<body class="<?php echo ($_GET['month'] % 2 == 0) ? 'even-month' : 'odd-month'; ?>">
    <h1>CALENDAR</h1>
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        body.odd-month {
            background-image: url(https://truth.bahamut.com.tw/s01/202405/forum/75400/35e607426bfa870c6a6d524b547808d9.JPG?w=1000);
            background-size: cover;
            /* 背景圖片會覆蓋整個區域 */
            background-position: center center;
            /* 圖片置中 */
            background-attachment: fixed;
            /* 當滾動頁面時背景保持不動 */
            background-size: contain;
        }

        body.even-month {
            background-image: url(https://truth.bahamut.com.tw/s01/202405/forum/75400/631e13fc3b9c3454a7a96646c0c4c0ea.JPG);
            background-size: cover;
            /* 背景圖片會覆蓋整個區域 */
            background-position: center center;
            /* 圖片置中 */
            background-attachment: fixed;
            /* 當滾動頁面時背景保持不動 */
            background-size: contain;
        }

        

        h1 {
            text-align: center;
            font-size: 50px;
            padding: 20px;
            font-family: "Permanent Marker", serif;
            font-style: normal;

        }

        table {
            border-collapse: collapse;
            margin: auto;
            width: 90%;
            max-width: 1000px;
            border: 3px solid skyblue;
            background-color: white;
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

        td:hover {
            background-color: skyblue;
            transition: 1s;
        }

        .holiday {
            color: red;
        }

        .grey-text {
            color: #999;
        }

        .today {
            background: lightskyblue;
            color: white;
            font-weight: bolder;
        }

        .public-holiday {
            background-color: #ff6666;
            /* 國定假日背景紅色 */
            color: red;
            /* 文字顏色設為白色 */
            font-weight: bold;
            /* 文字加粗 */
        }

        .nav {
            width: 688px;
            margin: 20px auto;
            text-align: center;
            border: 3px solid skyblue;
            background-color: lightblue;
            padding-bottom: 10px;
            padding: 10px;
        }

        .nav table td {
            border: 0;
            padding: 0;
        }

        .spDate {
            color: red;
        }

        thead {
            background-color: lightyellow;
        }

        a {
            text-decoration: none;
            color: blue;
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
    '2023-02-05' => "元宵節",
    '2023-04-09' => "復活節",
    '2023-06-22' => "端午節",
    '2023-08-22' => "七夕情人節",
    '2023-08-30' => "中元節",
    '2023-09-29' => "中秋節",
    '2023-10-23' => "重陽節",
    '2023-11-07' => "立冬",
    '2023-11-22' => '小雪',

    '2024-02-09' => "除夕",
    '2024-02-24' => "元宵節",
    '2024-03-31' => "復活節",
    '2024-06-10' => "端午節",
    '2024-08-10' => "七夕情人節",
    '2024-06-18' => "中元節",
    '2024-09-17' => "中秋節",
    '2024-10-11' => "重陽節",
    '2024-11-07' => "立冬",
    '2024-11-22' => '小雪',

    '2025-01-28' => "除夕",
    '2025-02-12' => "元宵節",
    '2025-04-13' => "復活節",
    '2025-05-31' => "端午節",
    '2025-08-29' => "七夕情人節",
    '2025-09-06' => "中元節",
    '2025-10-06' => "中秋節",
    '2025-10-29' => "重陽節",
    '2025-11-07' => "立冬",
    '2025-11-22' => '小雪',

    '2026-06-30' => "端午節",
    '2026-10-07' => "中秋節"
];

$holidays = [
    '01-01' => "元旦",
    '02-10' => "農曆新年",
    '02-28' => "和平紀念日",
    '04-04' => "兒童節",
    '04-05' => "清明節",
    '05-01' => "勞動節",
    '09-28' => "教師節",
    '10-10' => "國慶日",
    '12-25' => "聖誕日"
];

?>

    <div class="nav">
        <form action="calendar.php" class="div_form div_center">
            <div>
                <div>
                    <!-- <td1 style="font-size:40px; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                <?php echo date("{$year}年{$month}月"); ?> -->
                    </td1>
                    <table style="width: 100%" class=''>
                        <tr>
                            <!-- 按鈕功能 -->
                            <td class='beforyear'>
                                <!-- 前年按鈕，年份減少 1 年 -->
                                <a href="calendar.php?year=<?= $year - 1; ?>&month=<?= $month; ?>">
                                    << </a>
                            </td>
                            <td class='currentYear'>
                                <?php echo date("{$year}年"); ?>
                            </td>
                            <td class='afteryear'>
                                <!-- 明年按鈕，年份增加 1 年 -->
                                <a href="calendar.php?year=<?= $year + 1; ?>&month=<?= $month; ?>"> >> </a>
                        </tr>
                        <tr>
                            </td>
                            <td class='beforeMonth'>
                                <a href="calendar.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>">
                                    < </a>
                            </td>
                            <td class='currentMonth'>
                                <?php echo date("F", strtotime("{$year}-{$month}-01")); // 顯示英文月份 ?>
                            </td>
                            <td class='beforeMonth'>
                                <a href="calendar.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>"> > </a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div>
                    <!-- 搜尋年月份 -->
                    <label for="year"></label>
                    <input type="number" name="year" id="year" placeholder="YYYY" pattern="\d{4}" title="請輸入年份（YYYY）">年
                    <label for="month"></label>
                    <input type="number" name="month" id="month" placeholder="MM" pattern="\d{2}" title="請輸入月份（MM）">月
                    <input type="submit" value="送出">
                </div>
            </div>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <td>Sun</td>
                <td>Mon</td>
                <td>Tue</td>
                <td>Wed</td>
                <td>Thu</td>
                <td>Fri</td>
                <td>Sat</td>
            </tr>
        </thead>
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
            echo "<span class='spDate'>";
            echo "<br>{$spDate[date('Y-m-d', $theDayTime)]}";
            echo "</span>";
        }
        if (isset($holidays[date("m-d", $theDayTime)])) {
            echo "<span class='spDate'>";
            echo "<br>{$holidays[date("m-d", $theDayTime)]}";
            echo "</span>";
        }
        echo "</td>";
        
    }
    echo "</tr>";
}

?>
    </table>
</body>

</html>