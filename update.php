
<body>
<?php
{// get input passed from client
			// open the connection
				$sqlConnect=mysqli_connect('localhost','root','','assignment');

				// DIE
				if(!$sqlConnect){
					die();
					echo "\"" . $assignment . "\" <font color=#FF0000>Connection Failed</font>";
					}

					//$sql="SELECT Product_id,Product_name from productinventory";
					$sql="SELECT Product_id,Product_name from productinventory";
					
					echo "<select name=Product_name value=''>Product_name</option>";
					$sqlConnect->query($sql);
					$sqlResult = $sqlConnect -> query($sql);
					
					while($sqlRow = mysqli_fetch_object($sqlResult))
					{//Array or records stored in $row
				
					echo '<option value="'. $sqlRow->Product_id .'/'. $sqlRow->Product_name .'">' . $sqlRow->Product_id .'/'. $sqlRow->Product_name .'</option>';
					
					}
					; 
}

echo "<br/>";
	<html>
<form method="get">
<table>
<tr><td>Product Quantity: </td><td><input type ="number" name="PRODUCT_QUANTITY"></td></tr>
</table>
<input type="submit" value="Submit">
</form>
</html>
					
?>					
					