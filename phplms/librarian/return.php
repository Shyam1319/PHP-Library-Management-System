<?php
include("connection.php");
$id=$_GET['id'];
$date=date('d-M-Y');
$res=mysqli_query($link,"update issue_books set books_return_date='$date' where id='$id'");
$books_name="";
$res1=mysqli_query($link,"select * from issue_books where id='$id'");
while($row=mysqli_fetch_array($res1))
{
$books_name=$row['books_name'];
}
$res=mysqli_query($link,"update add_books set available_qty=(available_qty+1) where books_name='$books_name' ");
?>
<script type="text/javascript">
window.location="return_book.php";
</script>
