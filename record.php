<?php
$con  = mysqli_connect("localhost","root","","sonda");
if (!$con) {
    # code...
    echo "Problem in database connection! Contact administrator!" . mysqli_error();
}else{
    $sql ="SELECT * FROM info";
    $result = mysqli_query($con,$sql);
    $chart_data="";
    while ($row = mysqli_fetch_array($result)) {

        $productname[]  = $row['Product']  ;
        $sales[] = $row['TotalSales'];
    }

}
?>