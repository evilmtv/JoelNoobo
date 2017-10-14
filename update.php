<html>
<head>
	<Title>Purchase form</title>
	</head>
	<body>
		<h2>Customer information.</h2>
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

				//$sql="SELECT Product_id,Product_name from productinventory";
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
				<tr><td>Product Quantity: </td><td><input type ="number" name="PRODUCT_QUANTITY"></td></tr>
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
		if(!(empty($_GET['USERNAME']) || empty($_GET['CUSTOMER_ADDRESS']) || empty($_GET['PHONE_NUMBER']) || empty($_GET['PRODUCT_QUANTITY'])))
		{
			$USERNAME=$_GET['USERNAME'];
			$CUSTOMER_ADDRESS=$_GET['CUSTOMER_ADDRESS'];
			$PHONE_NUMBER=$_GET['PHONE_NUMBER'];
			$PRODUCT_QUANTITY=$_GET['PRODUCT_QUANTITY'];
			$PRODUCT_ID=$_GET['PRODUCT_ID'];

			//Query for checking inventory quantity
			$sqlQuery="Select Product_quantity FROM productinventory P WHERE P.Product_id='$PRODUCT_ID'";
			$sqlResult = $sqlConnect -> query($sqlQuery);
			$data = mysqli_fetch_array($sqlResult);
			$returnedQuantity = $data[0];
			if ($returnedQuantity >= $PRODUCT_QUANTITY) {
				;
				//Print out a successful confirmation about the user's order and the total
				//insert transaction information to database

				//Check against database for customer
			if (/*customer does not exist*/) {
				//If new customer INSERT information when successful purchase
			}
		} else {
			Echo "Ordered quantity exceed number available in inventory, please reduce xadkjaslkdjalsdkjas";

		}

	} else {
		echo "unfilled";
	}

	?>
	</html>
