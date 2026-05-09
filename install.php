<?php
require_once __DIR__ . '/config.php';

// ── Default seed data ─────────────────────────────────────────────────────────

function getDefaultProducts(): array {
    return [
        ['id'=>'p1','nameEn'=>'Gold Whey Protein','nameRo'=>'Proteina Whey Gold','nameRu'=>'Протеин Gold','category'=>'protein','price'=>449,'buyPrice'=>280,'imageBase64'=>'','sales'=>142,'stock'=>20,'stockLow'=>5,'isBox'=>false,'unitsPerBox'=>1,'source'=>'website','batchLayers'=>[]],
        ['id'=>'p2','nameEn'=>'Plant Power Protein','nameRo'=>'Proteina Vegana','nameRu'=>'Растительный протеин','category'=>'protein','price'=>399,'buyPrice'=>250,'imageBase64'=>'','sales'=>87,'stock'=>8,'stockLow'=>5,'isBox'=>false,'unitsPerBox'=>1,'source'=>'website','batchLayers'=>[]],
        ['id'=>'p3','nameEn'=>'PreFire Pre-Workout','nameRo'=>'Pre-Workout PreFire','nameRu'=>'Пред-тренировочный','category'=>'preworkout','price'=>329,'buyPrice'=>190,'imageBase64'=>'','sales'=>215,'stock'=>3,'stockLow'=>5,'isBox'=>false,'unitsPerBox'=>1,'source'=>'website','batchLayers'=>[]],
        ['id'=>'p4','nameEn'=>'Pure Creatine Mono','nameRo'=>'Creatina Monohidrat','nameRu'=>'Чистый Креатин','category'=>'creatine','price'=>199,'buyPrice'=>110,'imageBase64'=>'','sales'=>301,'stock'=>25,'stockLow'=>5,'isBox'=>false,'unitsPerBox'=>1,'source'=>'website','batchLayers'=>[]],
        ['id'=>'p5','nameEn'=>'BCAA Elite Matrix','nameRo'=>'BCAA Elite','nameRu'=>'BCAA Элит','category'=>'recovery','price'=>279,'buyPrice'=>160,'imageBase64'=>'','sales'=>178,'stock'=>15,'stockLow'=>5,'isBox'=>false,'unitsPerBox'=>1,'source'=>'website','batchLayers'=>[]],
        ['id'=>'p6','nameEn'=>'Athlete Multivitamin','nameRo'=>'Multivitamine Sportiv','nameRu'=>'Мультивитамины','category'=>'vitamins','price'=>159,'buyPrice'=>80,'imageBase64'=>'','sales'=>95,'stock'=>30,'stockLow'=>5,'isBox'=>false,'unitsPerBox'=>1,'source'=>'website','batchLayers'=>[]],
        ['id'=>'p7','nameEn'=>'Power Protein Bar 12x65g','nameRo'=>'Baton Proteic 12x65g','nameRu'=>'Батончик 12шт','category'=>'bars','price'=>39,'buyPrice'=>18,'imageBase64'=>'','sales'=>412,'stock'=>60,'stockLow'=>12,'isBox'=>true,'unitsPerBox'=>12,'source'=>'website','batchLayers'=>[]],
    ];
}

function getDefaultTrainers(): array {
    return [
        ['code'=>'TR1','name'=>'Coach Alex','commission'=>10,'paidAmount'=>0],
        ['code'=>'POWER10','name'=>'Elite Trainer Mike','commission'=>10,'paidAmount'=>0],
    ];
}

function getDefaultBlog(): array {
    $now = time() * 1000;
    return [
        ['id'=>'b1','cat'=>'Nutrition','icon'=>'fa-flask',
         'titleEn'=>'The Science of Whey Protein','titleRo'=>'Știința Proteinei Whey','titleRu'=>'Наука о сывороточном протеине',
         'excerptEn'=>'Discover why whey protein is the gold standard for muscle building.',
         'excerptRo'=>'Descoperă de ce proteina whey este standardul de aur.',
         'excerptRu'=>'Узнайте, почему сывороточный протеин — золотой стандарт.',
         'contentEn'=>'<p>Whey protein is derived from milk during the cheese-making process. It is a complete protein containing all essential amino acids. Its rapid digestion rate makes it ideal for post-workout consumption.</p><p>Studies show that consuming 20–40g of whey protein after resistance training significantly accelerates muscle protein synthesis. The leucine content in whey directly triggers muscle-building pathways.</p><p>POWER9 Gold Whey is ultra-filtered to deliver 80% protein per serving with minimal lactose and fat, making it both effective and easy to digest.</p>',
         'contentRo'=>'<p>Proteina whey este derivată din lapte în procesul de fabricare a brânzei. Este o proteină completă care conține toți aminoacizii esențiali.</p>',
         'contentRu'=>'<p>Сывороточный протеин получают из молока в процессе производства сыра. Это полноценный белок, содержащий все незаменимые аминокислоты.</p>',
         'imageBase64'=>'','timestamp'=>$now - 172800000],
        ['id'=>'b2','cat'=>'Performance','icon'=>'fa-fire',
         'titleEn'=>'Pre-Workout: Maximize Every Rep','titleRo'=>'Pre-Antrenament: Maximizează Fiecare Repetare','titleRu'=>'Пред-тренировка: Максимум каждого повтора',
         'excerptEn'=>'Learn how the right pre-workout formula transforms your sessions.',
         'excerptRo'=>'Află cum formula potrivită îți poate transforma antrenamentele.',
         'excerptRu'=>'Узнайте, как правильная пред-тренировка изменит занятия.',
         'contentEn'=>'<p>Pre-workout supplements enhance energy, focus, and endurance. Key evidence-based ingredients include caffeine, beta-alanine, citrulline malate, and creatine.</p><p>POWER9 PreFire combines clinical doses in one powerful formula.</p>',
         'contentRo'=>'<p>Suplimentele pre-antrenament îmbunătățesc energia, concentrarea și rezistența.</p>',
         'contentRu'=>'<p>Пред-тренировочные добавки повышают энергию, концентрацию и выносливость.</p>',
         'imageBase64'=>'','timestamp'=>$now - 86400000],
        ['id'=>'b3','cat'=>'Recovery','icon'=>'fa-heartbeat',
         'titleEn'=>'BCAA & Recovery: Train More, Hurt Less','titleRo'=>'BCAA & Recuperare: Antrenează-te Mai Mult','titleRu'=>'BCAA и восстановление: больше тренировок',
         'excerptEn'=>'Understand how BCAAs speed up recovery and prevent muscle breakdown.',
         'excerptRo'=>'Înțelege cum BCAA-urile accelerează recuperarea.',
         'excerptRu'=>'Разберитесь, как BCAA ускоряют восстановление.',
         'contentEn'=>'<p>BCAAs — leucine, isoleucine, and valine — account for ~35% of essential amino acids in muscle proteins. They are metabolized directly in the muscle.</p><p>POWER9 BCAA Elite uses a 2:1:1 ratio.</p>',
         'contentRo'=>'<p>BCAA-urile reprezintă ~35% din aminoacizii esențiali din proteinele musculare.</p>',
         'contentRu'=>'<p>BCAA составляют ~35% незаменимых аминокислот в мышечных белках.</p>',
         'imageBase64'=>'','timestamp'=>$now],
    ];
}

// ── Setup functions ───────────────────────────────────────────────────────────

function createTables(PDO $db): void {
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id         INT AUTO_INCREMENT PRIMARY KEY,
        username   VARCHAR(64)  UNIQUE NOT NULL,
        password   VARCHAR(255) NOT NULL,
        role       VARCHAR(16)  NOT NULL DEFAULT 'user',
        email      VARCHAR(128) NOT NULL DEFAULT '',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    $db->exec("CREATE TABLE IF NOT EXISTS data_store (
        `key`      VARCHAR(64) PRIMARY KEY,
        value      LONGTEXT    NOT NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
}

function seedDefaults(PDO $db): void {
    // Users (INSERT IGNORE keeps existing passwords if re-run)
    $adminHash = password_hash('1111', PASSWORD_DEFAULT);
    $userHash  = password_hash('2222', PASSWORD_DEFAULT);
    $db->prepare("INSERT IGNORE INTO users (username, password, role, email) VALUES (?,?,'admin','admin@power9.md')")->execute(['Power9Admin', $adminHash]);
    $db->prepare("INSERT IGNORE INTO users (username, password, role, email) VALUES (?,?,'user','user@power9.md')")->execute(['user', $userHash]);

    // Data store (INSERT IGNORE — won't overwrite existing data)
    $defaults = [
        'power9_products'      => getDefaultProducts(),
        'power9_orders'        => [],
        'power9_trainers'      => getDefaultTrainers(),
        'power9_blog'          => getDefaultBlog(),
        'power9_b2b_selected'  => [],
        'power9_b2b_order'     => [],
        'power9_batches'       => [],
    ];
    $stmt = $db->prepare("INSERT IGNORE INTO data_store (`key`, value) VALUES (?, ?)");
    foreach ($defaults as $key => $val) {
        $stmt->execute([$key, json_encode($val, JSON_UNESCAPED_UNICODE)]);
    }
}

function resetDefaults(PDO $db): void {
    // Clears and re-seeds all data_store rows (keeps users)
    $db->exec("DELETE FROM data_store");
    seedDefaults($db);
}

// ── Web interface (only when accessed directly) ───────────────────────────────
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    $msg = '';
    $ok  = false;
    try {
        $db = getDB();
        createTables($db);
        seedDefaults($db);
        $ok  = true;
        $msg = 'Installation complete! Tables created and defaults seeded.';
    } catch (PDOException $e) {
        $msg = 'Database error: ' . htmlspecialchars($e->getMessage());
    }
    ?><!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>POWER9 – Install</title>
<style>body{font-family:sans-serif;max-width:600px;margin:60px auto;padding:0 20px;}
h1{color:<?= $ok ? '#2f9e44' : '#e03131' ?>;}pre{background:#f4f4f4;padding:12px;border-radius:6px;white-space:pre-wrap;}
a{color:#4361ee;}strong{color:#e03131;}</style></head>
<body>
<h1><?= $ok ? '✅ Done' : '❌ Error' ?></h1>
<p><?= $msg ?></p>
<?php if ($ok): ?>
<p>Default credentials:<br>
Admin: <code>Power9Admin</code> / <code>1111</code><br>
User: <code>user</code> / <code>2222</code></p>
<p><strong>⚠ Delete or restrict access to this file after setup.</strong></p>
<p><a href="index.html">Go to Store</a> &nbsp;|&nbsp; <a href="crm.html">Go to CRM</a></p>
<?php else: ?>
<p>Check your settings in <code>config.php</code> and make sure the database <strong><?= DB_NAME ?></strong> exists.</p>
<pre>CREATE DATABASE <?= DB_NAME ?> CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;</pre>
<?php endif; ?>
</body></html>
<?php
}
