<?php
session_start();
if(!isset($_SESSION['librarian']))
{
	?>
	<script type="text/javascript">
   window.location="login.php";
</script>
	<?php
	
}

include("header.php");
include("connection.php");
?>
        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Plain Page</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Display Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                               <form action="" method="post" name="form1">
                               	  <input type="text" class="form-control" name="t1" placeholder="Books Name">
                               	  <input type="submit" value="Search Books" name="submit1" class="btn btn-primary" >
                               	  
                               </form>
                                <?php
								if(isset($_POST['submit1']))
								{
									$bname=$_POST['t1'];
							        $res=mysqli_query($link,"select * from add_books where books_name like '$bname%'");
								echo("<table class='tabel table-bordered'>");
								echo("<tr>");
								echo("<th>");echo("ID");echo("</th>");
								echo("<th>");echo("Books Image");echo("</th>");
								echo("<th>");echo("Books");echo("</th>");
								echo("<th>");echo("Auther");echo("</th>");
								echo("<th>");echo("Publication");echo("</th>");
								echo("<th>");echo("Purchase Date");echo("</th>");
								echo("<th>");echo("Price");echo("</th>");
								echo("<th>");echo("Quantity");echo("</th>");
								echo("<th>");echo("Available Qty.");echo("</th>");
								echo("<th>");echo("Delete Books");echo("</th>");
								echo("</tr>");
								
								while($row=mysqli_fetch_array($res))
								{
							    
								echo("<tr>");
								echo("<td>");echo($row['id']);echo("</td>");
								echo("<td>");?><img src="<?php echo($row['books_image']);?>" width="70px" height="70px"> <?php echo("</td>");
								echo("<td>");echo($row['books_name']);echo("</td>");
								echo("<td>");echo($row['books_author_name']);echo("</td>");
								echo("<td>");echo($row['books_publication_name']);echo("</td>");
								echo("<td>");echo($row['books_purchase_date']);echo("</td>");
								echo("<td>");echo($row['books_price']);echo("</td>");
								echo("<td>");echo($row['books_qty']);echo("</td>");
								echo("<td>");echo($row['available_qty']);echo("</td>");
								echo("<td>");?><a href="delete_books.php?id=<?php echo($row['id']);?>">Delete Books</a><?php echo("</td>");	
								echo("</tr>");
									
								}
								}else
								{
									
								
								$res=mysqli_query($link,"select * from add_books");
								echo("<table class='tabel table-bordered'>");
								echo("<tr>");
								echo("<th>");echo("ID");echo("</th>");
								echo("<th>");echo("Books Image");echo("</th>");
								echo("<th>");echo("Books");echo("</th>");
								echo("<th>");echo("Auther");echo("</th>");
								echo("<th>");echo("Publication");echo("</th>");
								echo("<th>");echo("Purchase Date");echo("</th>");
								echo("<th>");echo("Price");echo("</th>");
								echo("<th>");echo("Quantity");echo("</th>");
								echo("<th>");echo("Available Qty.");echo("</th>");
								echo("<th>");echo("Delete Books");echo("</th>");
								echo("</tr>");
								
								while($row=mysqli_fetch_array($res))
								{
							    
								echo("<tr>");
								echo("<td>");echo($row['id']);echo("</td>");
								echo("<td>");?><img src="<?php echo($row['books_image']);?>" width="70px" height="70px"> <?php echo("</td>");
								echo("<td>");echo($row['books_name']);echo("</td>");
								echo("<td>");echo($row['books_author_name']);echo("</td>");
								echo("<td>");echo($row['books_publication_name']);echo("</td>");
								echo("<td>");echo($row['books_purchase_date']);echo("</td>");
								echo("<td>");echo($row['books_price']);echo("</td>");
								echo("<td>");echo($row['books_qty']);echo("</td>");
								echo("<td>");echo($row['available_qty']);echo("</td>");
								echo("<td>");?><a href="delete_books.php?id=<?php echo($row['id']);?>">Delete Books</a><?php echo("</td>");
								echo("</tr>");
									
									
								}
							}
								?>
								</table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<?php
include("footer.php");
?>