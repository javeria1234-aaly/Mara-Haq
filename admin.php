<?php
require_once __DIR__ . '/header.php';

// Handle status update
if (isset($_POST['update_status'])) {
    $inq_id = intval($_POST['inquiry_id']);
    $new_status = safe($_POST['status']);
    $up_stmt = $pdo->prepare("UPDATE inquiries SET status = ? WHERE id = ?");
    $up_stmt->execute([$new_status, $inq_id]);
}

// Fetch stats
$total_inquiries = $pdo->query("SELECT COUNT(*) FROM inquiries")->fetchColumn();
$total_ngos = $pdo->query("SELECT COUNT(*) FROM ngos")->fetchColumn();
$total_sections = $pdo->query("SELECT COUNT(*) FROM legal_sections")->fetchColumn();

// Fetch inquiries
$inquiries = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC")->fetchAll();
?>

<div class="container" style="padding: 40px 20px 60px;">
    <div class="section-head">
        <span class="section-tag"><i class="fa fa-user-shield"></i> ایڈمن ڈیش بورڈ</span>
        <h1 class="section-title">
            <?php echo $lang === 'ur' ? 'شہری قانونی درخواستوں کا ڈیش بورڈ' : 'Citizen Assistance Inquiries Dashboard'; ?>
        </h1>
        <p class="section-desc">
            <?php echo $lang === 'ur' ? 'پورٹل کے ذریعے موصول ہونے والے وراثتی و قانونی تنازعات کے کوائف اور این جی او ریکارڈ' : 'Manage citizen case inquiries, status updates, and directory metrics.'; ?>
        </p>
    </div>

    <!-- Metrics Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 35px;">
        <div style="background: #ffffff; border-radius: var(--radius-md); padding: 22px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); text-align: center;">
            <i class="fa fa-inbox" style="font-size: 30px; color: var(--primary); margin-bottom: 8px;"></i>
            <h3 style="font-size: 28px; font-weight: 800; color: var(--navy);"><?php echo $total_inquiries; ?></h3>
            <span style="font-size: 13.5px; color: var(--text-muted);"><?php echo $lang === 'ur' ? 'موصولہ قانونی درخواستیں' : 'Total Inquiries'; ?></span>
        </div>

        <div style="background: #ffffff; border-radius: var(--radius-md); padding: 22px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); text-align: center;">
            <i class="fa fa-hands-holding-child" style="font-size: 30px; color: var(--gold-dark); margin-bottom: 8px;"></i>
            <h3 style="font-size: 28px; font-weight: 800; color: var(--navy);"><?php echo $total_ngos; ?></h3>
            <span style="font-size: 13.5px; color: var(--text-muted);"><?php echo $lang === 'ur' ? 'تصدیق شدہ این جی اوز' : 'Verified NGOs'; ?></span>
        </div>

        <div style="background: #ffffff; border-radius: var(--radius-md); padding: 22px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); text-align: center;">
            <i class="fa fa-book" style="font-size: 30px; color: var(--navy); margin-bottom: 8px;"></i>
            <h3 style="font-size: 28px; font-weight: 800; color: var(--navy);"><?php echo $total_sections; ?></h3>
            <span style="font-size: 13.5px; color: var(--text-muted);"><?php echo $lang === 'ur' ? 'قانونی مراحل و رہنما مضامین' : 'Legal Guide Sections'; ?></span>
        </div>
    </div>

    <!-- Inquiries Table -->
    <div style="background: #ffffff; border-radius: var(--radius-lg); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); padding: 25px; overflow-x: auto;">
        <h3 style="font-size: 18px; color: var(--navy); margin-bottom: 16px;">
            <i class="fa fa-list"></i> <?php echo $lang === 'ur' ? 'حالیہ قانونی درخواستیں' : 'Recent Inquiries'; ?>
        </h3>

        <?php if (empty($inquiries)): ?>
            <p style="text-align: center; color: var(--text-muted); padding: 30px;">
                <?php echo $lang === 'ur' ? 'ابھی تک کوئی درخواست موصول نہیں ہوئی۔' : 'No citizen inquiries registered yet.'; ?>
            </p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;">
                <thead>
                    <tr style="background: var(--bg-alt); border-bottom: 2px solid var(--border-color);">
                        <th style="padding: 12px 14px;">ID</th>
                        <th style="padding: 12px 14px;"><?php echo $lang === 'ur' ? 'شہری کا نام' : 'Citizen Name'; ?></th>
                        <th style="padding: 12px 14px;"><?php echo $lang === 'ur' ? 'رابطہ نمبر' : 'Phone'; ?></th>
                        <th style="padding: 12px 14px;"><?php echo $lang === 'ur' ? 'شہر' : 'City'; ?></th>
                        <th style="padding: 12px 14px;"><?php echo $lang === 'ur' ? 'مسئلے کی نوعیت' : 'Case Type'; ?></th>
                        <th style="padding: 12px 14px;"><?php echo $lang === 'ur' ? 'تفصیلات' : 'Details'; ?></th>
                        <th style="padding: 12px 14px;"><?php echo $lang === 'ur' ? 'تاریخ' : 'Date'; ?></th>
                        <th style="padding: 12px 14px;"><?php echo $lang === 'ur' ? 'اسٹیٹس' : 'Status'; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inq): ?>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 12px 14px; font-weight: 700; color: var(--primary);">#<?php echo $inq['id']; ?></td>
                            <td style="padding: 12px 14px; font-weight: 700;"><?php echo safe($inq['citizen_name']); ?></td>
                            <td style="padding: 12px 14px;"><a href="tel:<?php echo safe($inq['phone']); ?>"><?php echo safe($inq['phone']); ?></a></td>
                            <td style="padding: 12px 14px;"><span class="city-badge"><?php echo safe($inq['city']); ?></span></td>
                            <td style="padding: 12px 14px;"><span class="category-badge"><?php echo safe($inq['case_type']); ?></span></td>
                            <td style="padding: 12px 14px; max-width: 250px; font-size: 13px;"><?php echo safe($inq['details']); ?></td>
                            <td style="padding: 12px 14px; font-size: 12px; color: var(--text-muted);"><?php echo safe($inq['created_at']); ?></td>
                            <td style="padding: 12px 14px;">
                                <form method="POST" style="display: flex; gap: 6px;">
                                    <input type="hidden" name="inquiry_id" value="<?php echo $inq['id']; ?>">
                                    <select name="status" onchange="this.form.submit()" style="padding: 4px 8px; border-radius: 4px; font-size: 12px; border: 1px solid var(--border-color);">
                                        <option value="New" <?php echo $inq['status'] === 'New' ? 'selected' : ''; ?>>New</option>
                                        <option value="In Progress" <?php echo $inq['status'] === 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                                        <option value="Referred to NGO" <?php echo $inq['status'] === 'Referred to NGO' ? 'selected' : ''; ?>>Referred to NGO</option>
                                        <option value="Resolved" <?php echo $inq['status'] === 'Resolved' ? 'selected' : ''; ?>>Resolved</option>
                                    </select>
                                    <input type="hidden" name="update_status" value="1">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
