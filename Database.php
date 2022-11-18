<?php
session_start();
class Database{
	
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "fos_db"; 
	private $conn = null;
    
	public function __construct(){
		$this->conn = new mysqli($this->host, $this->user, $this->password);
	}
    public function getConnection(){		
		return $this->conn;
    }

	public function select_db(){
		if($this->conn){
			if(!$this->conn->select_db($this->database)){
				// die("Database does not exist");

				// create database
				$this->create_db();
			
			}

		}
	}
	public function create_db(){
		if($this->conn){

			// sql to create database
			if(!mysqli_query($this->conn, "CREATE DATABASE ".$this->database." ;")){
				die("Unable to create database ".$this->database);
			}
			$this->conn->select_db($this->database);
			// Food customer
			$food_customer = "CREATE TABLE IF NOT EXISTS `food_customer` (
				`id` int(11) NOT NULL,
				`name` varchar(255) NOT NULL,
				`email` varchar(255) NOT NULL,
				`password` varchar(50) NOT NULL,
				`phone` varchar(50) NOT NULL,
				`address` text NOT NULL
			  ); ";
			  	if($this->conn->query($food_customer)){
					print("Success in getting into the food customers table");
				}
				else{
					print("An error occurred");
				}
			

			// // Table for food items
			$food_items = "CREATE TABLE IF NOT EXISTS `food_items` (
				`id` int(30) NOT NULL,
				`name` varchar(30) NOT NULL,
				`price` int(30) NOT NULL,
				`description` varchar(200) NOT NULL,
				`images` varchar(200) NOT NULL,
				`status` varchar(10) NOT NULL DEFAULT 'ENABLE'
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			  ";
			  mysqli_query($this->conn, $food_items);

			  //Table for food_orders
			  $food_orders = "CREATE TABLE IF NOT EXISTS `food_orders` (
				`id` int(30) NOT NULL,
				`item_id` int(30) NOT NULL,
				`name` varchar(30) NOT NULL,
				`price` int(30) NOT NULL,
				`quantity` int(30) NOT NULL,
				`order_date` date NOT NULL,
				`order_id` varchar(50) NOT NULL
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			  ";
			  mysqli_query($this->conn, $food_orders);

			//Table for admins
			  $admin = "CREATE TABLE IF NOT EXISTS `admin` (
				`id` int(30) NOT NULL,
				`department` varchar(50) NOT NULL,
				`name` varchar(30) NOT NULL,
				`email` varchar(50) NOT NULL,
				`username` varchar(30) NOT NULL,
				`password` varchar(50) NOT NULL
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			  ";
			  mysqli_query($this->conn, $admin);

			// Table for payment
			$payments = "CREATE TABLE IF NOT EXISTS `payments` (
				`id` int(30) NOT NULL,
				`payment_method` varchar(30) NOT NULL,
				`amount_paid` int(30) NOT NULL,
				`payment_date` varchar(200) NOT NULL
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			  ";
			  mysqli_query($this->conn, $payments);

		

			// Table for payment
			$receipt = "CREATE TABLE IF NOT EXISTS `receipt` (
				`id` int(30) NOT NULL,
				`payment_method` varchar(30) NOT NULL,
				`food_ordered` varchar(30) NOT NULL,
				`food_quantity` int(4) NOT NULL,
				`amount_paid` int(20) NOT NULL,
				`date` date(200) NOT NULL,
				 `time` time(100) TIMESTAMP
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
			  ";
			  mysqli_query($this->conn, $receipt);
			
			$sql_insert = "INSERT INTO `food_customer` (`id`, `name`, `email`, `password`, `phone`, `address`) VALUES
			(1, 'Mark Cooper', 'mcooper@mail.com', '202cb962ac59075b964b07152d234b70', '1234567890', 'A - 1111 Street road, Newyork USA.'),
			(2, 'Samantha Miller', 'sam23@mail.com', '45bff2a14658fc9b21c6e5e9bf75186b', '0913245879', 'My Sample Address'),
			(3, 'Clairy Blake', 'cblake@mail.com', '4744ddea876b11dcb1d169fadf494418', '09654789123', 'Sample Address 101');
			";
			 mysqli_query($this->conn, $food_customer);


			  
			$sql_insert = "INSERT INTO `food_items` (`id`, `name`, `price`, `description`, `images`, `status`) VALUES
			(1, 'Burger', 75, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris dignissim at dolor in posuere. Sed eleifend ipsum in sem placerat, sed semper felis tincidunt.', './images/burger.jfif', 'ENABLE'),
			(2, 'Fries', 50, 'Maecenas eleifend sit amet magna et consequat. Nunc a erat non arcu efficitur semper ut et mauris. Aenean sed faucibus purus. Duis hendrerit diam at leo imperdiet, vel placerat dolor porta.', './images/fries.jfif', 'ENABLE'),
			(3, 'Nachos', 105, 'Nam sagittis fringilla leo, eget eleifend orci vestibulum sed. Proin a sem eu tortor hendrerit sollicitudin. Vivamus tempus ullamcorper nibh vitae viverra.', './images/nachos.jpg', 'ENABLE'),
			(4, 'Pizza', 145, 'Sed sit amet neque fringilla, eleifend libero gravida, tempus nisl.', './images/pizza.jfif', 'ENABLE'),
			(5, 'Fried Chicken', 115, 'Cras vitae commodo sem. Nam viverra augue lacus, ut tempus nulla congue accumsan. Ut mattis ipsum ligula, non dignissim ex scelerisque eu.', './images/fried-chicken.png', 'ENABLE'),
			(6, 'Grilled Chciken', 135, 'Nulla tincidunt varius accumsan. Vivamus ac nunc nibh. Ut maximus nisi sed consectetur dictum.', './images/grilled-chicken.jpg', 'ENABLE'),
			(7, 'Roasted Pork Belly', 475, 'Curabitur bibendum leo sit amet lacinia laoreet. Quisque dapibus rutrum nunc, ac scelerisque elit porta in. Phasellus scelerisque sem in gravida placerat.', './images/roasted-pork-billy.jpg', 'ENABLE');
			";
			 mysqli_query($this->conn, $food_items);

			 
			$sql_insert = "INSERT INTO `food_orders` (`id`, `item_id`, `name`, `price`, `quantity`, `order_date`, `order_id`) VALUES
			(1, 3, 'Nachos', 105, 1, '2022-06-20', '944886993025460519'),
			(2, 2, 'Fries', 50, 1, '2022-06-20', '944886993025460519');
			";
			 mysqli_query($this->conn, $food_orders);

			$sql_insert = "INSERT INTO `payments` (`id`, `payment_method`, `amount_paid`, `payment_date`) VALUES
			(1, 'Cash', 300, 11/12/2022),
			(2, 'Credit card', 4000, 11/12/2022);
			";
			 mysqli_query($this->conn, $payments);

			$sql_insert = "INSERT INTO `receipt` (`id`, `payment_method`, `food_order`, `food_quantity`, `amount_paid`, `date`, `time`) VALUES
			(1, 'Cash', 'Burger', 3, 4000, DATE, TIME ),
			(2, 'Credit card', 'Fries', 2, 200, DATE, TIMES);
			";
			 mysqli_query($this->conn, $receipt);

			$sql_insert = "INSERT INTO `admin` (`id`, `department`, `name`, `email`, `username`, `password`) VALUES
			(1,'Human resource', 'Louis Ochieng', 'louisotieno2001@gmail.com', 'Louis007', 'Louis2001!');
			";
			 mysqli_query($this->conn, $admin);



		  


			  
			  

		}
	}

}

$db = new Database();
// var_dump($db->getConnection());
$db->select_db();

?>