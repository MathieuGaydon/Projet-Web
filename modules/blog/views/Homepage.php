<?php
namespace blog\views;

use PDO;

class Homepage {
    private \PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function cell(mixed $value): string {
        if($value == null || $value == '' || !is_scalar($value)) {
            return '-';
        }
        return htmlspecialchars((string) $value);
    }

    public function show(): void {
        $title = "PFAS-Explorer - Accueil";
        $description = "PFAS-Explorer est une application web cartographique permettant d'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.";
        $sm_title = "PFAS-Explorer - Accueil";
        $sm_description = "PFAS-Explorer est une application web cartographique permettant d'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.";
        $sm_image = "https://pfas-explorer.alwaysdata.net/_assets/images/Logo_PFAS.webp";
        $sm_url = "https://pfas-explorer.alwaysdata.net/";
        $info_button_1 = "inscription";
        $button_1 = "S'inscrire";
        $info_button_2 = "connexion";
        $button_2 = "Se Connecter";
        $button_3 = "Se Déconnecter";

        // -Pagination-
        $totalDatas=0;
        $dataPerPage = 25;
        $stmt = $this->pdo->query("SELECT COUNT(*) AS total FROM PFAS_Data");

        if($stmt !== false){
            $total = $stmt->fetchColumn();
            if (is_numeric($total)){
                $totalDatas = (int) $total;
            }
        }

        $totalPages=ceil($totalDatas / $dataPerPage);
        
        // Gestion des pages inférieures à 1 et supérieures au max
        $pageParam = $_GET['page'] ?? null;
        $actualPage = is_numeric($pageParam) ? (int) $pageParam : 1;
        if ($actualPage < 1) $actualPage = 1;
        if ($actualPage > $totalPages && $totalPages > 0) $actualPage = $totalPages;

        $offset = ($actualPage -1) * $dataPerPage;
        $sql = "SELECT * FROM PFAS_Data LIMIT 25 OFFSET :offset";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ob_start();
        ?>
        <div class="home">
                <h2>Accueil</h2>
                <p>PFAS-Explorer est une application web cartographique permettant d'explorer les contaminations aux PFAS et de gérer des espaces de travail et des données environnementales.</p>
        </div>
        <div class="pagination">
            <table class="table-container">
                <caption>
                    Tableau des données PFAS
                </caption>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Ville</th>
                        <th>Pays</th>
                        <th>Matrice</th>
                        <th>Somme PFAS</th>
                        <th>Année</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $row): ?>
                            <?php if (!is_array($row)) continue; ?>
                                <tr>
                                    <td><?= $this->cell($row['name'] ?? null) ?></td>
                                    <td><?= $this->cell($row['category'] ?? null) ?></td>
                                    <td><?= $this->cell($row['city'] ?? null) ?></td>
                                    <td><?= $this->cell($row['country'] ?? null) ?></td>
                                    <td><?= $this->cell($row['matrix'] ?? null) ?></td>
                                    <td><?= $this->cell($row['pfas_sum'] ?? null) ?></td>
                                    <td><?= $this->cell($row['year'] ?? null) ?></td>
                                </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Aucune donnée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="buttons_pagination">
            <nav>
                <?php if ($actualPage > 1): ?>
                    <a href="index.php?page=<?= $actualPage - 1 ?>" class="prev">Précédent</a>
                <?php endif; ?>

                <?php
                $range = 2;

                for ($i = 1; $i <= $totalPages; $i++):
                    if ($i == 1 || $i == $totalPages || ($i > $actualPage - $range && $i <= $actualPage + $range)):
                        if ($i == $actualPage):?>
                            <span class="current"><?= $i ?></span>
                        <?php else: ?>
                            <a href="index.php?page=<?= $i ?>"><?= $i ?></a>
                        <?php endif; ?>
                    <?php elseif ($i == 2 && $actualPage - $range > 2): ?>
                        <span>...</span>
                    <?php elseif ($i == $totalPages - 1 && $actualPage + $range < $totalPages - 1): ?>
                        <span>...</span>
                    <?php endif;
                endfor;
                ?>
                <?php if ($actualPage < $totalPages): ?>
                    <a href="index.php?page=<?= $actualPage + 1 ?>" class="next">Suivant</a>
                <?php endif; ?>
                <div class="form">
                    <form action="index.php" method="GET" class="choose_page">
                        <?php if (is_string($_GET['action'] ?? null)): ?>
                            <input type="hidden" name="action" value="<?= htmlspecialchars($_GET['action']) ?>">
                        <?php endif; ?>
                        <label for="page-input">Aller à la page :</label>
                        <input 
                            type="number" 
                            id="page-input" 
                            name="page" 
                            min="1" 
                            max="<?= $totalPages ?>" 
                            value="<?= $actualPage ?>"
                            required>
                        <input type="submit" value="Ok">
                    </form>
                </div>
            </nav>
        </div>
        <h2>Sources</h2>
        <div class="sources">
            <a href="https://pdh.cnrs.fr/fr/map/">PFAS Data Hub</a>
            <a href="https://zenodo.org/records/17761605">Article de recherche sur les PFAS (Anglais)</a>
        </div>

        <?php
        $content = ob_get_clean();

        (new Layout($title, $description, $sm_title, $sm_description, $sm_image, $sm_url, $info_button_1, $button_1, $info_button_2, $button_2, $content, $button_3))->show();
    }
}