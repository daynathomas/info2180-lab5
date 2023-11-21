<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$stmt = $conn->query("SELECT * FROM countries");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



$getCountry=trim(filter_var(htmlspecialchars($_GET['country']), FILTER_SANITIZE_STRING));
$country= $conn->query("SELECT * FROM countries WHERE name LIKE '%$getCountry%'");
$country_x= $country->fetchAll(PDO::FETCH_ASSOC);

$getContext =trim(filter_var(htmlspecialchars($_GET['context']), FILTER_SANITIZE_STRING)); 
$cities= $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries  ON countries.code = cities.country_code WHERE countries.name LIKE '%$getCountry%'");
$cities_x= $cities->fetchAll(PDO::FETCH_ASSOC);

?>

  <?php if (isset($_GET['country']) && !isset($_GET['context'])):  ?>
    <table>
        <tr>
          <th> Country Name</th>  
          <th> Continent</th>  
          <th> Independence Year</th>  
          <th> Head of State</th>  
        </tr>
        
        <tbody>
        <?php foreach ($country_x as $cntry): ?>
            <tr>
                <td> <?= $cntry['name']; ?></td>  
                <td> <?= $cntry['continent']; ?></td>  
                <td> <?= $cntry['independence_year']; ?></td>  
                <td> <?= $cntry['head_of_state']; ?></td>  
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
        
    <?php elseif (isset($_GET['country']) && isset($_GET['context'])):?>
      <table>
        <tr>
          <th> Name </th>  
          <th> District </th>  
          <th> Population </th>  
        </tr>
    
        <tbody>
        <?php foreach ($cities_x as $cty): ?>
            <tr>
                <td> <?= $cty['name']; ?></td>  
                <td> <?= $cty['district']; ?></td>  
                <td> <?= $cty['population']; ?></td>  
            </tr>
        <?php endforeach; ?>
       </tbody>
    </table>
  <?php endif; ?>