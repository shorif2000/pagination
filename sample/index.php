<?php
use Pagination\Paginator;

$conn = new mysqli('127.0.0.1', 'sample', 'sample', 'world');

$limit = (isset($_GET['limit'])) ? $_GET['limit'] : 25;
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$links = (isset($_GET['links'])) ? $_GET['links'] : 7;
$query = "SELECT * FROM `country` WHERE 1";

$Paginator = new Paginator($conn, $query);

$results = $Paginator->getData($page, $limit);
?>
<!DOCTYPE html>
<head>
<title>PHP Pagination</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="col-md-10 col-md-offset-1">
			<h1>PHP Pagination</h1>
			<table
				class="table table-striped table-condensed table-bordered table-rounded">
				<thead>
					<tr>
						<th width="20%">name</th>
						<th width="20%">nicename</th>
						<th width="25%">iso3</th>
						<th>numcode</th>
					</tr>
				</thead>
				<tbody>
                        <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
        <tr>
						<td><?php echo $results->data[$i]['name']; ?></td>
						<td><?php echo $results->data[$i]['nicename']; ?></td>
						<td><?php echo $results->data[$i]['iso3']; ?></td>
						<td><?php echo $results->data[$i]['numcode']; ?></td>
					</tr>
<?php endfor; ?>
                        </tbody>
			</table>
		</div>
	</div>
        <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?> 
        
        </body>
</html>