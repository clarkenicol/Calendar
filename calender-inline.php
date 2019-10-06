<style>
table {
    border-collapse:collapse;
    display:inline-table;
    margin:2px;
}
caption {
    margin:10px 0;
}
th, td {
    border:1px solid black;
}
th {
    height:25px;
    background-color:lightblue;
}
td {
    width:50px;
    height:50px;
    padding:2px;
    vertical-align:top;
    text-align:right;
}
#today {
    background-color:lightyellow;
}
.blank{
    background-color:lightgrey;
}
</style>
<?php
function printCalender($month)
{
    $today = date('jF',strtotime("today"));
    $time = strtotime($month);

    $numDay = date('d', $time);
    $numMonth = date('m', $time);
    $numYear = date('Y', $time);
    $firstDay = mktime(0,0,0,$numMonth,1,$numYear);
    $daysInMonth = cal_days_in_month(0, $numMonth, $numYear);
    $dayOfWeek = date('w', $firstDay);

    $monthOffset = (7 - (($daysInMonth + $dayOfWeek) % 7));

    if($monthOffset == 7){
        $monthOffset = $daysInMonth;
    } else {
        $monthOffset = (7 - (($daysInMonth + $dayOfWeek) % 7)) + $daysInMonth;
    }
    ?>
    <table>
        <caption>
            <h3><?PHP echo $month; ?></h3>
        </caption>
        <thead>
            <tr>
                <th abbr="Sunday" scope="col" title="Sunday">S</th>
                <th abbr="Monday" scope="col" title="Monday">M</th>
                <th abbr="Tuesday" scope="col" title="Tuesday">T</th>
                <th abbr="Wednesday" scope="col" title="Wednesday">W</th>
                <th abbr="Thursday" scope="col" title="Thursday">T</th>
                <th abbr="Friday" scope="col" title="Friday">F</th>
                <th abbr="Saturday" scope="col" title="Saturday">S</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <?PHP
            if(0 != $dayOfWeek) {
                for($i = 0; $i < $dayOfWeek; $i++){
                    echo '<td class="blank"></td>';
                }
            }
            for($i=1;$i <= $monthOffset;$i++) {
                if($i <= $daysInMonth){
                    echo ($i.$month == $today) ? '<td id="today">' : '<td>';

                    echo $i;
                    echo "</td>";
                    
                    if(date('w', mktime(0,0,0,$numMonth, $i, $numYear)) == 6) {
                        echo "</tr><tr>" ;                      
                    }
                } else {
                    echo '<td class="blank"></td>';
                }
            }
            ?>
        </tr>
        </tbody>
    </table>
<?PHP
}
?>
<div style="width:80%;margin:0 auto;">
<?PHP
$months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];

foreach($months as $month){
    printCalender($month);
}
?>