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
                                <h2>Issue Books</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                               <form action="" method="post" name="form1">
                              	  <table>
                               	  <tr>
                               	  	  <td>
                               	  	  	 <select name="enr" class="form-control" selectpicker>
                               	  	  	 	<?php
											 $res=mysqli_query($link,"select enrollment from student_registration");
											 while($row=mysqli_fetch_array($res))
											 {
												 echo("<option>");
												 echo($row['enrollment']);
												 echo("</option>");
												 
											 }
											 
											 ?>
                               	  	  	 </select>
                               	  	  </td>
                               	  	  <td>
                               	  	  	<input type='submit' name="submit1" value="Search" class="form-control btn btn-default" style="margin-top: 5px;">
                               	  	  </td>
                               	  </tr>
                               	</table>
                               
                               <?php
								if(isset($_POST['submit1']))
								{
									$enr=$_POST['enr'];
									$res=mysqli_query($link,"select * from student_registration where enrollment='$enr'");
									while($row1=mysqli_fetch_array($res)){
										$firstname=$row1['firstname'];
										$lasttname=$row1['lastname'];
										$username=$row1['username'];
										$_SESSION['username']=$username;
										$email=$row1['email'];
										$contact=$row1['contact'];
										$sem=$row1['sem'];
										$enrollment=$row1['enrollment'];
										$_SESSION['enrollment']=$enrollment;
										
									}
									
									?>
									 <table class="table table-bordered">
                                            <tr>
                                               <td>
                 	                                 <input type="text" class="form-control" name="enrollment" placeholder="Enrollment No" value="<?php echo($enrollment); ?>" disable>
                 	                            </td>
                                             </tr>
                                             
                                             <tr>
                                               <td>
                 	                                 <input type="text" class="form-control" name="studentname" placeholder="Student Name" value="<?php echo($firstname.''.$lasttname); ?>"require>
                 	                            </td>
                                             </tr>
                                             <tr>
                                               <td>
                 	                                 <input type="text" class="form-control" name="studentsem" placeholder="Student Sem" value="<?php echo($sem);?>" require>
                 	                            </td>
                                             </tr>
                                             <tr>
                                               <td>
                 	                                 <input type="text" class="form-control" name="studentcontact" placeholder="Student Contact" value="<?php echo($contact);?>" require>
                 	                            </td>
                                             </tr>
                                             <tr>
                                               <td>
                 	                                 <input type="text" class="form-control" name="studentemail" placeholder="Email" value="<?php echo($email); ?>" require>
                 	                            </td>
                                             </tr>
                                             <tr>
                                             	<td>
                                             		<select name="booksname" class="form-control" selectpicker>
                                            		      <?php
									                      $res=mysqli_query($link,"select books_name from add_books");
									                      while($row=mysqli_fetch_array($res))
														  {
															
														  echo("<option>");
                                            		      
														  echo($row['books_name']);
                                             		      	
                                             		      echo("</option>");
                                             		    
															  
														  }
									                         ?>
                                             		      
                                             			
                                             		</select>
                                             	</td>
                                             </tr>
                                              <tr>
                                               <td>
                 	                                 <input type="text" class="form-control" name="studentusername" placeholder="Student User Name" value="<?php echo($username);?>" disable>
                 	                            </td>
                                             </tr>
                                             <tr>
                                               <td>
                 	                                 <input type="text" class="form-control" name="booksissuedate" placeholder="Books Issue Date" value="<?php echo(date('d-M-Y')); ?>" require>
                 	                            </td>
                                             </tr>
                                       
                                             <tr>
                                               <td>
                 	                                 <input type="submit" value="Issue Books" class="form-control btn btn-primary" placeholder="Books Issue Date" style="background-clip: blue;" name="submit2" require>
                 	                            </td>
                                             </tr>
								   </table>
									<?php
								}
								?>
                            </div>
                            </form>
                            <?php
							if(isset($_POST['submit2'])){
								
								$id2=0;
								$enrollment2=$_POST['enrollment'];
								//$enrollment2=$_SESSION['enrollment'];
								$studentname2=$_POST['studentname'];
								$sem2=$_POST['studentsem'];
								$contact2=$_POST['studentcontact'];
								$email2=$_POST['studentemail'];
								$booksname2=$_POST['booksname'];
								$booksissuedt2=$_POST['booksissuedate'];
								$booksrdt2='';
								//$username2=$_SESSION['enrollment'];
								$username2=$_POST['studentusername'];
								$qty=0;
								$res1=mysqli_query($link,"select * from add_books where books_name='$booksname2'");
								while($row2=mysqli_fetch_array($res1)){
									$qty=$row2['available_qty'];
								
								}
								if($qty==0){
							?><h5 style="color: red" width='250px' height='30px'>Books are not available in stock.</h5>
								
								<?php
									
								}else{
									
								
								$res=mysqli_query($link,"insert into issue_books values('$id2','$enrollment2','$studentname2','$sem2','$contact2','$email2','$booksname2','$booksissuedt2','$booksrdt2','$username2')");
								$res=mysqli_query($link,"update add_books set available_qty=(available_qty-1) where books_name='$booksname2' ");
								?>
								<script type="text/javascript">
							    alert("Books Issued Successfully");
									window.location.href=window.location.href
								
							    </script>
								<?php
								}
							}
							?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
<?php
include("footer.php");
?>