<?php 
$limit = 5;

$page = $_GET['page'] ?? 1;
if($page < 1) $page = 1;

$start ($page - 1) * $limit







?>


============================================
      <?php
                $limit = 2;
                $page = $_GET['page'] ?? 1;
                if ($page < 1) $page = 1;

                $start = ($page - 1) * $limit;


                $stmt = $conn->prepare("SELECT * FROM users ORDER BY date DESC LIMIT ?, ?");
                $stmt->bind_param("ii", $start, $limit);
                $stmt->execute();
                $GetData = $stmt->get_result();

                while ($row = $GetData->fetch_assoc()):

                ?>

        =================================
         <!-- PAGINATION -->
        <!-- QUERY OF PAGINATION -->
        <?php
        $totalQuery = $conn->prepare("SELECT COUNT(*) as total FROM users");
        $totalQuery->execute();
        $total = $totalQuery->get_result()->fetch_assoc()['total'];

        $totalPages = ceil($total / $limit);

        if ($totalPages > 1):
        ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- END OF PAGINATION -->