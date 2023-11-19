<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$getRequestedCountry = trim(filter_var(htmlspecialchars($_GET['country']), FILTER_SANITIZE_STRING));
$countryQuery = $conn->query("SELECT * FROM countries WHERE name LIKE '%$getRequestedCountry%'");
$countryData = $countryQuery->fetchAll(PDO::FETCH_ASSOC);

$getContext = trim(filter_var(htmlspecialchars($_GET['context']), FILTER_SANITIZE_STRING));
$citiesQuery = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON countries.code = cities.country_code WHERE countries.name LIKE '%$getRequestedCountry%'");
$citiesData = $citiesQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if (isset($_GET['country']) && !isset($_GET['context'])): ?>
    <table>
        <tr>
            <th> Country Name</th>
            <th> Continent</th>
            <th> Independence Year</th>
            <th> Head of State</th>
        </tr>

        <tbody>
        <?php foreach ($countryData as $country): ?>
            <tr>
                <td> <?= $country['name']; ?></td>
                <td> <?= $country['continent']; ?></td>
                <td> <?= $country['independence_year']; ?></td>
                <td> <?= $country['head_of_state']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php elseif (isset($_GET['country']) && isset($_GET['context'])): ?>
    <table>
        <tr>
            <th> Name </th>
            <th> District </th>
            <th> Population </th>
        </tr>

        <tbody>
        <?php foreach ($citiesData as $city): ?>
            <tr>
                <td> <?= $city['name']; ?></td>
                <td> <?= $city['district']; ?></td>
                <td> <?= $city['population']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
