<?php
session_start();
if (!isset($_SESSION['staff_id'])) {
    header('Location: login.php');
    exit;
}
require_once 'db.php';

$apptRef = $db->collection('appointments');

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_id'], $_POST['status'])) {
    $aid    = $_POST['appointment_id']; // Firestore document ID (string)
    $status = $_POST['status'];
    $apptRef->document($aid)->set(['Status' => $status], ['merge' => true]);
    header('Location: dashboard.php');
    exit;
}

// Fetch all appointments
$appointments = [];
foreach ($apptRef->documents() as $doc) {
    if ($doc->exists()) {
        $data = $doc->data();
        $data['AppointmentID'] = $doc->id();
        $appointments[] = $data;
    }
}

// Sort by date/time descending (Firestore doesn't guarantee multi-field order without a composite index,
// so we sort here in PHP instead)
usort($appointments, function ($a, $b) {
    return strcmp($b['AppDate'] . ' ' . $b['AppTime'], $a['AppDate'] . ' ' . $a['AppTime']);
});

// Count stats
$total    = count($appointments);
$pending  = count(array_filter($appointments, fn($a) => $a['Status'] === 'Pending'));
$confirmed = count(array_filter($appointments, fn($a) => $a['Status'] === 'Confirmed'));
$cancelled = count(array_filter($appointments, fn($a) => $a['Status'] === 'Cancelled'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — Glamour Cuts</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --cream:#FAF7F2; --sand:#F0EAE0; --blush:#E8D5C4; --rose:#C4957A;
    --bark:#8B6651; --espresso:#3D2B1F; --charcoal:#1A1410; --white:#FFFFFF;
    --gray-soft:#9A8E84;
    --serif:'Cormorant Garamond',Georgia,serif;
    --sans:'DM Sans',system-ui,sans-serif;
  }
  body { font-family: var(--sans); background: var(--sand); color: var(--charcoal); min-height: 100vh; }
  .topbar { background: var(--espresso); padding: 1rem 2.5rem; display: flex; align-items: center; justify-content: space-between; }
  .topbar-logo { font-family: var(--serif); font-size: 1.4rem; font-weight: 300; color: var(--cream); }
  .topbar-logo span { color: var(--rose); font-style: italic; }
  .topbar-right { display: flex; align-items: center; gap: 1.5rem; }
  .topbar-name { font-size: 0.85rem; color: var(--blush); }
  .btn-logout { background: transparent; border: 1px solid var(--rose); color: var(--rose); padding: 0.4rem 1rem; font-family: var(--sans); font-size: 0.78rem; letter-spacing: 0.1em; text-transform: uppercase; cursor: pointer; text-decoration: none; }
  .btn-logout:hover { background: var(--rose); color: var(--cream); }
  .main { padding: 2.5rem; }
  .page-title { font-family: var(--serif); font-size: 2rem; font-weight: 300; color: var(--espresso); margin-bottom: 0.3rem; }
  .page-sub { font-size: 0.85rem; color: var(--gray-soft); margin-bottom: 2rem; }
  .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2.5rem; }
  .stat-card { background: var(--white); padding: 1.5rem; border-top: 3px solid var(--blush); }
  .stat-card.pending { border-color: #f59e0b; }
  .stat-card.confirmed { border-color: #22c55e; }
  .stat-card.cancelled { border-color: #ef4444; }
  .stat-card.total { border-color: var(--rose); }
  .stat-num { font-family: var(--serif); font-size: 2.2rem; font-weight: 300; color: var(--espresso); }
  .stat-label { font-size: 0.75rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--gray-soft); margin-top: 0.3rem; }
  .table-wrap { background: var(--white); overflow-x: auto; }
  .table-header { padding: 1.5rem 2rem; border-bottom: 1px solid var(--blush); display: flex; justify-content: space-between; align-items: center; }
  .table-title { font-family: var(--serif); font-size: 1.3rem; color: var(--espresso); font-weight: 300; }
  table { width: 100%; border-collapse: collapse; }
  thead th { background: var(--sand); padding: 0.9rem 1.2rem; text-align: left; font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--bark); font-weight: 500; }
  tbody td { padding: 1rem 1.2rem; border-bottom: 1px solid var(--sand); font-size: 0.88rem; color: var(--charcoal); vertical-align: middle; }
  tbody tr:hover { background: var(--cream); }
  .badge { display: inline-block; padding: 0.25rem 0.75rem; font-size: 0.72rem; letter-spacing: 0.08em; text-transform: uppercase; font-weight: 500; border-radius: 2px; }
  .badge-pending { background: #fef3c7; color: #92400e; }
  .badge-confirmed { background: #dcfce7; color: #166534; }
  .badge-cancelled { background: #fee2e2; color: #991b1b; }
  .status-form { display: flex; gap: 0.5rem; align-items: center; }
  .status-select { padding: 0.35rem 0.6rem; border: 1px solid var(--blush); font-family: var(--sans); font-size: 0.8rem; color: var(--charcoal); background: white; outline: none; }
  .btn-update { padding: 0.35rem 0.8rem; background: var(--espresso); color: var(--cream); border: none; font-family: var(--sans); font-size: 0.75rem; letter-spacing: 0.08em; text-transform: uppercase; cursor: pointer; }
  .btn-update:hover { background: var(--rose); }
  .empty { padding: 3rem; text-align: center; color: var(--gray-soft); font-size: 0.9rem; }
</style>
</head>
<body>

<div class="topbar">
  <p class="topbar-logo"><span>Glamour</span> Cuts</p>
  <div class="topbar-right">
    <span class="topbar-name">Welcome, <?= htmlspecialchars($_SESSION['staff_name']) ?></span>
    <a class="btn-logout" href="logout.php">Logout</a>
  </div>
</div>

<div class="main">
  <h1 class="page-title">Appointments Dashboard</h1>
  <p class="page-sub">Manage and update all salon bookings</p>

  <div class="stats">
    <div class="stat-card total"><p class="stat-num"><?= $total ?></p><p class="stat-label">Total Bookings</p></div>
    <div class="stat-card pending"><p class="stat-num"><?= $pending ?></p><p class="stat-label">Pending</p></div>
    <div class="stat-card confirmed"><p class="stat-num"><?= $confirmed ?></p><p class="stat-label">Confirmed</p></div>
    <div class="stat-card cancelled"><p class="stat-num"><?= $cancelled ?></p><p class="stat-label">Cancelled</p></div>
  </div>

  <div class="table-wrap">
    <div class="table-header">
      <p class="table-title">All Appointments</p>
    </div>
    <?php if (empty($appointments)): ?>
      <p class="empty">No appointments yet.</p>
    <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Client</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Service</th>
          <th>Price</th>
          <th>Date</th>
          <th>Time</th>
          <th>Status</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($appointments as $a):
            $dateObj = DateTime::createFromFormat('Y-m-d', $a['AppDate']);
            $timeObj = DateTime::createFromFormat('H:i', $a['AppTime']);
        ?>
        <tr>
          <td><?= htmlspecialchars(substr($a['AppointmentID'], 0, 6)) ?></td>
          <td><?= htmlspecialchars($a['FirstName'] . ' ' . $a['LastName']) ?></td>
          <td><?= htmlspecialchars($a['Phone'] ?? '—') ?></td>
          <td><?= htmlspecialchars($a['Email'] ?? '—') ?></td>
          <td><?= htmlspecialchars($a['ServiceName']) ?></td>
          <td>R<?= number_format($a['Price'], 2) ?></td>
          <td><?= $dateObj ? $dateObj->format('d M Y') : htmlspecialchars($a['AppDate']) ?></td>
          <td><?= $timeObj ? $timeObj->format('H:i') : htmlspecialchars($a['AppTime']) ?></td>
          <td><span class="badge badge-<?= strtolower($a['Status']) ?>"><?= $a['Status'] ?></span></td>
          <td>
            <form class="status-form" method="POST">
              <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($a['AppointmentID']) ?>">
              <select class="status-select" name="status">
                <option <?= $a['Status']==='Pending'   ? 'selected' : '' ?>>Pending</option>
                <option <?= $a['Status']==='Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                <option <?= $a['Status']==='Cancelled' ? 'selected' : '' ?>>Cancelled</option>
              </select>
              <button class="btn-update" type="submit">Save</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>
</div>
</body>
</html>