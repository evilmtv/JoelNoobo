<html>
<head>
<body>
<h2>Current available items in inventory</h2>
</html>
<?php
{


				// open the connection
				$sqlConnect=mysqli_connect('localhost','root','','assignment');

				// DIE
				if(!$sqlConnect){
					die();
					echo "\"" . $assignment . "\" <font color=#FF0000>Connection Failed</font>";
				}
				$sqlQuery="Select * from PRODUCTINVENTORY";
				$sqlResult = $sqlConnect -> query($sqlQuery);
				//Formating the table
				echo "<table border='1'><tr><th>Product Code</th><th>Product name</th><th>Product Price</th><th>Product Quantity</th></tr>";
				while($sqlRow = mysqli_fetch_object($sqlResult))
				{
					$row=$sqlRow->Product_id;
					$productName=$sqlRow->Product_name;
					$productPrice=$sqlRow->Product_price;
					$productQuantity=$sqlRow->Product_quantity;
				 
				echo "<tr>";
				echo "<td>" .$row."</td>"; 
				echo "<td>" .$productName."</td>";
				echo "<td>" .$productPrice."</td>"; 
				echo "<td>" .$productQuantity. "</td>";
				echo "</tr>";
				}
				echo "</table>";
				mysqli_close($sqlConnect);
			}
?>			
<html>
<head>
	<Title>Purchase form</title>
	</head>
	<body>
	<h1>Purchase form</h1>
		<h2>Customer information (Please fill all fields)</h2>
		<form method="get">
			<table>
				<tr><td>Username: </td><td><input type ="text" name="USERNAME"></td></tr>
				<tr><td>Customer Address: </td><td><input type ="text" name="CUSTOMER_ADDRESS"></td></tr>
				<tr><td>Phone Number: </td><td><input type ="number" name="PHONE_NUMBER"></td></tr>

			</table>
			<br>
			<b>What do you wish to purchase?</b>
			<br>
			</html>

			<?php
			{// get input passed from client
				// open the connection
				$sqlConnect=mysqli_connect('localhost','root','','assignment');

				// DIE
				if(!$sqlConnect){
					die();
					echo "\"" . $assignment . "\" <font color=#FF0000>Connection Failed</font>";
				}
				//Displaying current available inventory
				
				//RETREIVING DROP DOWN LIST
				$sql="SELECT Product_id,Product_name from productinventory";

				echo '<table>';
				echo "<select name=PRODUCT_ID value=''>";
				$sqlConnect->query($sql);
				$sqlResult = $sqlConnect -> query($sql);

				while($sqlRow = mysqli_fetch_object($sqlResult))
				{//Array or records stored in $row

					echo '<option value="'. $sqlRow->Product_id .'/'. $sqlRow->Product_name .'">' . $sqlRow->Product_id .'/'. $sqlRow->Product_name .'</option>';

				};

				echo '</table>';
			}

			?>
			<html>
			<div id="submit">
				<tr><td>Product Quantity: </td><td><input type ="number" min="0" name="PRODUCT_QUANTITY"></td></tr>
				<br>
				<input type="submit" value="Submit">
			</form>
		</div>

		<?php
		// open the connection
		$sqlConnect=mysqli_connect('localhost','root','','assignment');

		// DIE
		if(!$sqlConnect){
			die();
			echo "\"" . $assignment . "\" <font color=#FF0000>Connection Failed</font>";
		}
		// get input passed from client
		//if(isset($_GET['USERNAME'])&&($_GET['CUSTOMER_ADDRESS'])&&($_GET['PHONE_NUMBER'])&&($_GET['PRODUCT_QUANTITY']))
			$USERNAME=$_GET['USERNAME'];
			$CUSTOMER_ADDRESS=$_GET['CUSTOMER_ADDRESS'];
			$PHONE_NUMBER=$_GET['PHONE_NUMBER'];
			$PRODUCT_QUANTITY=$_GET['PRODUCT_QUANTITY'];
			$PRODUCT_ID=$_GET['PRODUCT_ID'];	
		if(!(empty($_GET['USERNAME']) || empty($_GET['CUSTOMER_ADDRESS']) || empty($_GET['PHONE_NUMBER']) || empty($_GET['PRODUCT_QUANTITY'])))
		{
			

			//Query for checking inventory quantity
			$sqlQuery="Select Product_quantity FROM productinventory P WHERE P.Product_id='$PRODUCT_ID'";
			$sqlResult = $sqlConnect -> query($sqlQuery);
			$data = mysqli_fetch_array($sqlResult);
			$returnedQuantity = $data[0];
			if ($returnedQuantity >= $PRODUCT_QUANTITY) {
				//Print out a successful confirmation about the user's order and the total
				$sqlQuery="Select (Product_price*$PRODUCT_QUANTITY) AS TOTALCOST from productinventory where Product_id='$PRODUCT_ID'";
				$sqlResult = $sqlConnect -> query($sqlQuery);
				while($sqlRow = mysqli_fetch_array($sqlResult))
					{
					Echo "Transaction successful! The final price comes to be $";
						Echo $sqlRow[0];
					//need to find a way to break this line away.
					
					}
					
				
				
				
				//Check against database for customer
			$sqlQuery="Select * FROM customerinfo WHERE username='$USERNAME' AND CUSTOMER_ADDRESS='$CUSTOMER_ADDRESS' AND PHONE_NUMBER='$PHONE_NUMBER'";
			// REMEMBER TO ADD MORE ANDS TO SQL
			$sqlResult = $sqlConnect -> query($sqlQuery);
			$data = mysqli_fetch_array($sqlResult);
			$returnedUsername = $data[0];
			if ($returnedUsername == 0) {
				echo "Hello new customer! Your records have been added";
				//If new customer INSERT information when successful purchase
				$sqlQuery = "INSERT INTO customerinfo(username,customer_address,phone_number) VALUES ('$USERNAME','$CUSTOMER_ADDRESS','$PHONE_NUMBER')";
				$sqlConnect->query($sqlQuery);
			
			}
			//insert transaction information to database
				$sqlQuery1="SELECT ID FROM customerinfo where username='$USERNAME'";
				$sqlRow= $sqlConnect -> query($sqlQuery1);
				$customeridtemp = mysqli_fetch_array($sqlRow);
				$customerid = $customeridtemp[0];
				$sqlQuery="INSERT INTO transaction(Customer_id,Product_id,Quantity_ordered) VALUES ('$customerid','$PRODUCT_ID','$PRODUCT_QUANTITY')";
				$sqlConnect ->query($sqlQuery);
			//Updating product inventory
				$sqlQuery2="Update productinventory set PRODUCT_QUANTITY=(PRODUCT_QUANTITY - $PRODUCT_QUANTITY) WHERE Product_id='$PRODUCT_ID'";
				$sqlConnect ->query($sqlQuery2);
		} else {
			Echo "Ordered quantity exceed number available in inventory, please order within quantity available";

		}

	} else {
		echo "Please ensure all data is filled";
	}

	?>
	</html>
