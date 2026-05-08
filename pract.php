

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>


<!-- ========================================== -->

<?php 


$limit = 4; 
// 👉 Ilan ang ipapakita per page (4 users per page)

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
// 👉 Kunin kung anong page ka ngayon (galing URL)
// Example: admin.php?page=2
// kung walang page → default = 1

if($page < 1) $page = 1; 
// 👉 Safety check: kung negative or 0 ang page, gawing 1

$start = ($page - 1) * $limit; 
// 👉 Computation kung saan magsisimula sa database

// Example:
// page 1 → (1-1)*4 = 0 → start sa 0
// page 2 → (2-1)*4 = 4 → start sa 4
// page 3 → (3-1)*4 = 8 → start sa 8

$stmt = $conn->prepare("SELECT * FROM users ORDER BY date DESC LIMIT ?, ?");
// 👉 Kunin users sa database
// ORDER BY date DESC = latest muna
// LIMIT ?, ? = start at limit (pagination)

$stmt->bind_param("ii", $start, $limit);
// 👉 Ipasok values:
// $start = saan magsisimula
// $limit = ilan kukunin (4 users per page)

$stmt->execute();
// 👉 run query sa database

$GetAllUser = $stmt->get_result();
// 👉 kunin result ng query

if($GetAllUser->num_rows > 0):
// 👉 kung may laman ang database

while($row = $GetAllUser->fetch_assoc()):
// 👉 loop lahat ng users isa isa

?>


<?php 

$totalQuery = $conn->prepare("SELECT COUNT(*) as total FROM users");
// 👉 bilangin lahat ng users sa database

$totalQuery->execute();
// 👉 run query

$totalRow = $totalQuery->get_result()->fetch_assoc();
// 👉 kunin result (isang row lang: total count)

$total = $totalRow['total'];
// 👉 actual number ng users (hal: 25 users)

$totalpages = ceil($total / $limit);
// 👉 compute ilang pages lahat

// Example:
// 25 users / 4 per page = 6.25 → ceil = 7 pages
// ceil = pataas rounding
?>


<?php if($total > $limit): ?>
// 👉 kung mas marami sa 4 users, show pagination
// kung 4 or less → wag ipakita (isang page lang)

<nav aria-label="Page navigation example" style="margin-left: 81%;">
// 👉 HTML container ng pagination (Bootstrap style)

<ul class="pagination">
// 👉 list ng page buttons

<li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
// 👉 kung nasa page 1 ka → disable "Previous"
// kasi wala ka na babalikan

<a class="page-link" href="?page=<?= $page - 1; ?>">
// 👉 kapag click mo → bumaba ng 1 page
// example: page 3 → page 2

<?php for($i = 1; $i <= $totalpages; $i++ ): ?>
// 👉 gumawa ng buttons 1 hanggang last page

<li class="page-item <?= ($i == $page ) ? 'active' : '' ?>">
// 👉 highlight current page
// example: nasa page 2 → 2 naka-blue (active)

<a class="page-link" href="?page=<?= $i; ?>">
// 👉 kapag click mo number → pupunta sa page na yun

<li class="page-item <?= ($page >= $totalpages) ? 'disabled' : '' ?>">
// 👉 kung nasa last page ka → disable "Next"

<a class="page-link" href="?page=<?= $page + 1 ?>">
// 👉 next page (page + 1)


| Part  | Meaning                  |
| ----- | ------------------------ |
| LIMIT | ilan per page            |
| page  | nasaan ka ngayon         |
| start | saan magsisimula         |
| COUNT | total users              |
| ceil  | round up pages           |
| loop  | gumagawa ng page numbers |
