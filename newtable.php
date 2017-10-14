<HTML>
	<head>
		<Title>New ariving product form!</title>
		</head>
		<body>
			<h2>New ariving product form.</h2>
			<form method="get">
				<table>
					<tr><td>Product code: (Optional) </td><td> <input type ="number" name="PRODUCT_ID"> </td></tr>
					<tr><td>Product name: </td><td> <input type ="text" name="PRODUCT_NAME"> </td></tr>
					<tr><td>Product price: </td><td><input type = "number" name="PRODUCT_PRICE"> </td></tr>
					<tr><td>Product Quantity: </td><td><input type ="number" name="PRODUCT_QUANTITY"></td></tr>
				</table>
				<input type="submit" value="Add new product">
			</form>

			<?php
			// get input passed from client
			if(isset($_GET['PRODUCT_ID'])&&($_GET['PRODUCT_NAME'])&&($_GET['PRODUCT_QUANTITY'])&&($_GET['PRODUCT_PRICE']))
			{if(!(empty($_GET['PRODUCT_NAME']) || empty($_GET['PRODUCT_QUANTITY']) || empty($_GET['PRODUCT_PRICE'])))
				{
					$PRODUCT_ID=$_GET['PRODUCT_ID'];
					$PRODUCT_NAME=$_GET['PRODUCT_NAME'];
				$PRODUCT_QUANTITY=$_GET['PRODUCT_QUANTITY'];
				$PRODUCT_PRICE=$_GET['PRODUCT_PRICE'];

				// open the connection
				$sqlConnect=mysqli_connect('localhost','root','','assignment');

				// DIE
				if(!$sqlConnect){
					die();
					echo "\"" . $assignment . "\" <font color=#FF0000>Connection Failed</font>";
				}
				//add a row
				$addRow="INSERT INTO PRODUCTINVENTORY(PRODUCT_ID,PRODUCT_NAME,PRODUCT_QUANTITY,PRODUCT_PRICE)
				VALUES('$PRODUCT_ID','$PRODUCT_NAME','$PRODUCT_QUANTITY','$PRODUCT_PRICE')"; 
				//echo $addRow;
				$sqlConnect->query($addRow);

				//display the updated table after insertion
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
				echo "</tr>";}
				echo "Inventory successfully updated! Please check if item is updated.<br>";
				echo "</table>";
				mysqli_close($sqlConnect);
			} 
			//If table details are not fully filled
			else{echo "Please ensure Product Name / Product Quantity / Product price is filled!";}
			}
			?>
		</body>
	</HTML>
